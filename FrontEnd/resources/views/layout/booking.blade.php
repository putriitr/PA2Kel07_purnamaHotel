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
                        <img src="https://via.placeholder.com/800x400?text=Hotel+Room+Image" alt="Hotel Room" class="img-fluid rounded">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-all">
                        <div class="header-text text-center mb-4">
                            <h1>Hotel Booking</h1>
                            <h5 class="section-title ff-secondary text-primary fw-normal">Nikmati pengalaman menginap di hotel kami</h5>
                        </div>
                        <form action="#" method="POST" id="bookingForm">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="first_105">First Name</label>
                                    <input type="text" id="first_105" name="first_name" placeholder="First Name" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="last_105">Last Name</label>
                                    <input type="text" id="last_105" name="last_name" placeholder="Last Name" class="form-control" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="input_17">E-mail</label>
                                    <input type="email" id="input_17" name="email" placeholder="example@example.com" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="input_phone">Phone Number</label>
                                    <input type="tel" id="input_phone" name="phone" placeholder="Phone Number" class="form-control" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="input_6">Room Type</label>
                                <select id="input_6" name="room_type" class="form-control" required>
                                    <option value="">Please Select</option>
                                    <option value="Standard Room (1 to 2 People)" data-price="500000">Standard Single Bed (1 to 2 People) - Rp 500,000/night</option>
                                    <option value="Family Room (1 to 4 People)" data-price="800000">Standard Twin Bed (1 to 4 People) - Rp 800,000/night</option>
                                    <option value="Private Room (1 to 3 People)" data-price="1000000">Deluxe Balcony Room (1 to 3 People) - Rp 1,000,000/night</option>
                                    <option value="Mix Dorm Room (6 People)" data-price="1200000">Suite Room (5 People) - Rp 1,200,000/night</option>
                                    <option value="Female Dorm Room (6 People)" data-price="1500000">Executive Suite Lake View Room (6 People) - Rp 1,500,000/night</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="input_112">Number of Guests</label>
                                <input type="number" id="input_112" name="number_of_guests" placeholder="Number of Guests" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="checkin_date">Check-in Date</label>
                                <input type="date" id="checkin_date" name="checkin_date" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="checkout_date">Check-out Date</label>
                                <input type="date" id="checkout_date" name="checkout_date" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="input_30">Special Requests</label>
                                <textarea id="input_30" name="special_requests" placeholder="Your requests" class="form-control"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="total_payment">Total Payment</label>
                                <input type="text" id="total_payment" name="total_payment" class="form-control" readonly>
                            </div>
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
        document.getElementById('bookingForm').addEventListener('change', calculateTotal);

        function calculateTotal() {
            const roomTypeElement = document.getElementById('input_6');
            const roomPrice = roomTypeElement.options[roomTypeElement.selectedIndex].getAttribute('data-price');
            const checkinDate = new Date(document.getElementById('checkin_date').value);
            const checkoutDate = new Date(document.getElementById('checkout_date').value);

            if (roomPrice && checkinDate && checkoutDate && checkinDate < checkoutDate) {
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
