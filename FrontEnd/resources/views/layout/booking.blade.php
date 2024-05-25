<!DOCTYPE html>
<html lang="en">

<head>
    @include('partial.head')
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
                @include('partial.navbar')
            </nav>

            <div class="container-xxl py-5 bg-dark hero-header mb-5">
                <div class="container text-center my-5 pt-5 pb-4">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Booking</h1>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->

        <!-- Booking Form Start -->
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="header-logo">
                        <img src="{{ asset('images/rooms/' . $room->image) }}" alt="Hotel Room"
                            class="img-fluid rounded">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-all">
                        <div class="header-text text-center mb-4">
                            <h1>Hotel Booking</h1>
                            <h5 class="section-title ff-secondary text-primary fw-normal">Nikmati pengalaman menginap di
                                hotel kami</h5>
                        </div>

                        <!-- Display Error Messages -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('bookings.store') }}" method="POST" id="bookingForm">
                            @csrf
                            <div class="mb-3">
                                <label for="first_name">First Name</label>
                                <input type="text" id="first_name" name="first_name" placeholder="First Name"
                                    class="form-control" required>
                                @error('first_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="last_name">Last Name</label>
                                <input type="text" id="last_name" name="last_name" placeholder="Last Name"
                                    class="form-control" required>
                                @error('last_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="email">E-mail</label>
                                    <input type="email" id="email" name="email"
                                        placeholder="example@example.com" class="form-control" required>
                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="phone">Phone Number</label>
                                    <input type="tel" id="phone" name="phone" placeholder="Phone Number"
                                        class="form-control" required>
                                    @error('phone')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="room_id">Room</label>
                                <input type="text" id="room_id" name="room_id" value="{{ $room->id }}"
                                    class="form-control" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="number_of_guests">Number of Guests</label>
                                <input type="number" id="number_of_guests" name="number_of_guests"
                                    placeholder="Number of Guests" class="form-control" required min="1">
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="checkin_date">Check-in Date</label>
                                    <input type="date" id="checkin_date" name="checkin_date" class="form-control"
                                        required min="{{ now()->format('Y-m-d') }}">
                                    @error('checkin_date')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="checkout_date">Check-out Date</label>
                                    <input type="date" id="checkout_date" name="checkout_date" class="form-control"
                                        required>
                                    @error('checkout_date')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="total_payment">Total Payment</label>
                                <input type="text" id="total_payment" class="form-control" readonly>
                            </div>
                            <input type="hidden" name="user_id" value="{{ Auth::guard('customers')->user()->id }}">
                            <input type="hidden" id="room_price" value="{{ $room->price }}">
                            <div class="form-buttons-wrapper text-center mt-4">
                                <button type="submit" class="btn btn-primary submit-button">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Booking Form End -->

        <!-- Footer Start -->
        @include('partial.footer')
        <!-- Footer End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    @include('partial.js')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Set the minimum check-in date to today
            var today = new Date().toISOString().split('T')[0];
            document.getElementById('checkin_date').setAttribute('min', today);
            document.getElementById('checkout_date').setAttribute('min', today);

            document.getElementById('checkin_date').addEventListener('change', function() {
                var checkinDate = document.getElementById('checkin_date').value;
                document.getElementById('checkout_date').setAttribute('min', checkinDate);
            });

            document.getElementById('checkout_date').addEventListener('change', function() {
                calculateTotal();
            });

            document.getElementById('checkin_date').addEventListener('change', function() {
                calculateTotal();
            });
        });

        function calculateTotal() {
            const roomPrice = parseFloat(document.getElementById('room_price').value);
            const checkinDate = new Date(document.getElementById('checkin_date').value);
            const checkoutDate = new Date(document.getElementById('checkout_date').value);

            if (checkinDate && checkoutDate && checkinDate < checkoutDate) {
                const timeDifference = checkoutDate.getTime() - checkinDate.getTime();
                const daysDifference = timeDifference / (1000 * 3600 * 24);
                const totalPayment = roomPrice * daysDifference;
                document.getElementById('total_payment').value = 'Rp ' + totalPayment.toLocaleString('id-ID');
            } else {
                document.getElementById('total_payment').value = '';
            }
        }
    </script>
</body>

</html>

