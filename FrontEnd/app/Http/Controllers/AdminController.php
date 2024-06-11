<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Payment;
use App\Notifications\OffersNotification;
use App\Notifications\PaymentNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DashboardExport;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'email' => 'required|email',
                'password' => 'required'
            ];
            $messages = [
                'email.required' => 'Email harus diisi',
                'email.email' => 'Masukkan email yang valid',
                'password.required' => 'Masukkan Password'
            ];
            $this->validate($request, $rules, $messages);

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
        $period = $request->input('period', 'day');
        $year = $request->input('year', date('Y'));
        $month = $request->input('month');
        $week = $request->input('week');
        $groupFormat = '%Y-%m-%d';

        if ($period == 'month') {
            $groupFormat = '%Y-%m';
            $startDate = Carbon::createFromDate($year, $month ?: 1, 1)->startOfMonth();
            $endDate = Carbon::createFromDate($year, $month ?: 12, 1)->endOfMonth();
        } elseif ($period == 'week') {
            $groupFormat = '%Y-%U';
            $startDate = Carbon::createFromDate($year)->startOfYear()->addWeeks($week - 1)->startOfWeek();
            $endDate = $startDate->copy()->endOfWeek();
        } elseif ($period == 'year') {
            $groupFormat = '%Y';
            $startDate = Carbon::createFromDate($year)->startOfYear();
            $endDate = Carbon::createFromDate($year)->endOfYear();
        } else {
            $startDate = Carbon::createFromDate($year)->startOfYear();
            $endDate = $startDate->copy()->endOfYear();
        }

        $revenueData = Payment::where('status', 'approved')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->select(DB::raw("DATE_FORMAT(created_at, '$groupFormat') as date"), DB::raw('SUM(amount) as total'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $dates = $revenueData->pluck('date');
        $totals = $revenueData->pluck('total');

        $bookingData = Booking::whereBetween('created_at', [$startDate, $endDate])
            ->select(DB::raw("DATE_FORMAT(created_at, '$groupFormat') as date"), DB::raw('COUNT(*) as count'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $bookingDates = $bookingData->pluck('date');
        $bookingCounts = $bookingData->pluck('count');

        $registrationData = Customer::whereBetween('created_at', [$startDate, $endDate])
            ->select(DB::raw("DATE_FORMAT(created_at, '$groupFormat') as date"), DB::raw('COUNT(*) as count'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $registrationDates = $registrationData->pluck('date');
        $registrationCounts = $registrationData->pluck('count');

        $admin = Auth::guard('admin')->user();
        $customers = Customer::all();
        foreach ($customers as $customer) {
            $existingNotification = $admin->notifications()->where('data->customer_id', $customer->id)->first();
            if (!$existingNotification) {
                $notification = new OffersNotification($customer);
                $admin->notify($notification);
            }
        }

        $payments = Payment::all();
        foreach ($payments as $payment) {
            $existingNotification = $admin->notifications()->where('data->payment_id', $payment->id)->first();
            if (!$existingNotification) {
                $notification = new PaymentNotification($payment);
                $admin->notify($notification);
            }
        }

        return view('admin.dashboard.index', compact('dates', 'totals', 'bookingDates', 'bookingCounts', 'registrationDates', 'registrationCounts', 'period', 'year', 'month', 'week'));
    }


    public function exportExcel(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'period' => 'required|in:day,week,month,year',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $period = $request->input('period');
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
        $pendingPaymentsCount = Payment::where('status', 'pending')->count();
        return view('admin.partials.sidebar', compact('pendingPaymentsCount'));
    }

    public function showNotifications()
    {
        $admin = auth()->guard('admin')->user();
        if (!$admin) {
            return redirect('/admin/login');
        }

        $notifications = $admin->unreadNotifications;
        return view('admin.notifications', compact('notifications'));
    }

    public function markNotificationAsRead($id)
    {
        $admin = auth()->guard('admin')->user();
        if (!$admin) {
            return redirect('/admin/login');
        }

        $notification = $admin->notifications()->where('id', $id)->first();
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
