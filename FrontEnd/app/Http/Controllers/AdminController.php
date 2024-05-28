<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Payment;
use App\Notifications\AdminNotification;
use App\Notifications\BookingNotification;
use App\Notifications\OffersNotification;
use App\Notifications\PaymentNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DashboardExport;


class AdminController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $alert = [
                'email' => 'required|email',
                'password' => 'required'
            ];
            $message = [
                'email.required' => 'Email harus diisi',
                'email.email' => 'Masukkan email yang valid',
                'password' => 'Masukkan Password'
            ];
            $this->validate($request, $alert, $message);
            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
                return redirect('/admin/dashboard');
            } else {
                return redirect()->back()->with('error', 'Tidak Sesuai');
            }
        }
        return view('admin.login.login');

    }


    public function dashboard(Request $request)
    {
        $period = $request->input('period', 'day'); // Default to 'day' if no period is specified

        switch ($period) {
            case 'week':
                $dateFormat = 'Y-W';
                $groupFormat = '%Y-%u';
                break;
            case 'month':
                $dateFormat = 'Y-m';
                $groupFormat = '%Y-%m';
                break;
            case 'year':
                $dateFormat = 'Y';
                $groupFormat = '%Y';
                break;
            case 'day':
            default:
                $dateFormat = 'Y-m-d';
                $groupFormat = '%Y-%m-%d';
                break;
        }

        // Fetch revenue data
        $revenueData = Payment::where('status', 'approved')
            ->select(DB::raw("DATE_FORMAT(created_at, '$groupFormat') as date"), DB::raw('SUM(amount) as total'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $dates = $revenueData->pluck('date');
        $totals = $revenueData->pluck('total');

        // Fetch bookings data
        $bookingData = Booking::select(DB::raw("DATE_FORMAT(created_at, '$groupFormat') as date"), DB::raw('COUNT(*) as count'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $bookingDates = $bookingData->pluck('date');
        $bookingCounts = $bookingData->pluck('count');

        // Fetch registration data
        $registrationData = Customer::select(DB::raw("DATE_FORMAT(created_at, '$groupFormat') as date"), DB::raw('COUNT(*) as count'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $registrationDates = $registrationData->pluck('date');
        $registrationCounts = $registrationData->pluck('count');

        $admin = Auth::guard('admin')->user();
        $customer = Customer::get();
        foreach ($customer as $customerItem) {
            $saveNotifications = $admin->notifications()
                ->where('data->customer_id', $customerItem->id)
                ->first();

            if (!$saveNotifications) {
                $notification = new OffersNotification($customerItem);

                $admin->notify($notification);
            }
        }

        $payment = Payment::get();
        foreach ($payment as $paymentItem) {
            $saveNotifications = $admin->notifications()
                ->where('data->payment_id', $paymentItem->id)
                ->first();

            if (!$saveNotifications) {
                $notification = new PaymentNotification($paymentItem);

                $admin->notify($notification);
            }
        }

        return view('admin.dashboard.index', compact('dates', 'totals', 'bookingDates', 'bookingCounts', 'registrationDates', 'registrationCounts', 'period'));
    }



    public function exportExcel(Request $request)
    {
        // Validate the period input
        $validator = Validator::make($request->all(), [
            'period' => 'required|in:day,week,month,year',
        ]);

        // If validation fails, return error response
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Retrieve validated period
        $period = $request->input('period');

        // Download the Excel file using the DashboardExport class
        return Excel::download(new DashboardExport($period), 'dashboard_data.xlsx');
    }


    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }

    public function showPayments()
    {
        $payments = Payment::with(['booking', 'booking.room'])
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('admin.booking.index', compact('payments'));
    }

    public function getSidebarData()
    {
        // Count the number of pending payments
        $pendingPaymentsCount = Payment::where('status', 'pending')->count();

        return view('admin.partials.sidebar', compact('pendingPaymentsCount'));
    }

    public function showNotifications()
    {
        // Ambil admin yang sedang login
        $admin = auth()->guard('admin')->user();

        // Pastikan admin sudah login
        if (!$admin) {
            return redirect('/admin/login');
        }

        // Ambil notifikasi yang belum dibaca oleh admin
        $notifications = $admin->unreadNotifications;

        // Tampilkan halaman dengan notifikasi
        return view('admin.notifications', compact('notifications'));
    }

    public function markNotificationAsRead($id)
    {
        // Ambil admin yang sedang login
        $admin = auth()->guard('admin')->user();

        // Pastikan admin sudah login
        if (!$admin) {
            return redirect('/admin/login');
        }

        // Temukan notifikasi berdasarkan ID
        $notification = $admin->notifications()->where('id', $id)->first();

        // Tandai notifikasi sebagai sudah dibaca jika ditemukan
        if ($notification) {
            $notification->markAsRead();
        }

        return redirect()->route('showNotifications');
    }


    public function markasread($id)
    {
        if ($id) {
            Auth::guard('admin')->user()->notifications()->where('id', $id)->first()->markAsRead();
        }
        return redirect()->back();
    }

    public function read($id)
    {
        if ($id) {
            Auth::guard('admin')->user()->notifications()->where('id', $id)->first()->markAsRead();
        }

        return redirect()->back();
    }
}


