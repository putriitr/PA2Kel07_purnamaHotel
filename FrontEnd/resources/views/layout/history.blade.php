<!DOCTYPE html>
<html lang="en">

<head>
    @include('partial.head')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <style>
        .hero-header-custom {
            background-color: #ff6347;
            /* Change this color to whatever you prefer */
        }

        /* Style for the first row of the table */
        .table thead th {
            background-color: #ff8c00;
            /* Orange color */
            color: white;
            /* Text color */
        }
    </style>
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            @include('partial.navbar')

            <div class="container-xxl py-5 hero-header mb-5 hero-header-custom">
                <div class="container text-center my-5 pt-5 pb-4">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">History Pemesanan</h1>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->

        <!-- Booking History Start -->
        <!-- Booking History Start -->
        <div class="container">
            @if (Auth::guard('customers')->check())
                @if ($bookings->isEmpty())
                    <p>No bookings found for this user.</p>
                @else
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>Status Permohonan</th>
                                <th>Nama Pemohon</th>
                                <th>Tanggal Check-in</th>
                                <th>Tanggal Check-out</th>
                                <th>Jumlah Tamu</th>
                                <th>Aksi</th>
                                <th>Cancel</th> <!-- Kolom baru untuk tombol Cancel -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking)
                                <tr>
                                    <td>{{ $booking->status }}</td>
                                    <td>{{ $booking->first_name }} {{ $booking->last_name }}</td>
                                    <td>{{ $booking->checkin_date }}</td>
                                    <td>{{ $booking->checkout_date }}</td>
                                    <td>{{ $booking->number_of_guests }}</td>
                                    <td>
                                        <!-- Debugging output -->
                                        @if ($booking->isPaid())
                                            <p>Booking is paid</p>
                                        @else
                                            <p>Booking is not paid</p>
                                        @endif

                                        <!-- Tombol Bayar Sekarang -->
                                        @if ($booking->status == 'pending' && !$booking->isPaid())
                                            <a href="{{ route('payment.form', ['bookingId' => $booking->id]) }}"
                                                class="btn btn-sm btn-primary">Bayar Sekarang</a>
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Tombol Cancel -->
                                        @if ($booking->status != 'cancelled' && $booking->status != 'confirmed' && !$booking->isPaid())
                                            <form action="{{ route('booking.cancel', ['bookingId' => $booking->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Cancel</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            @else
                <p>Please log in to view your booking history.</p>
            @endif
        </div>
        <!-- Booking History End -->

        <!-- Booking History End -->

        <!-- Footer Start -->
        @include('partial.footer')
        <!-- Footer End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    @include('partial.js')
</body>

</html>
