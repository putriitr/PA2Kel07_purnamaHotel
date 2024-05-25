<!DOCTYPE html>
<html lang="en">
<head>
    @include('partial.head')
</head>
<body>
    <div class="container-xxl bg-white p-0">
        <div class="container-xxl position-relative p-0">
            @include('partial.navbar')

            <div class="container-xxl py-5 bg-dark hero-header mb-5">
                <div class="container text-center my-5 pt-5 pb-4">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Facility</h1>
                </div>
            </div>
        </div>

        <div class="container mt-5">
            <h2 class="text-center">Payment</h2>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('payment.process', ['bookingId' => $booking->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="payment_method">Choose Payment Method:</label>
                    <select id="payment_method" name="payment_method" class="form-control" required>
                        <option value="">Select a bank</option>
                        <option value="bank_mandiri">Bank Mandiri</option>
                        <option value="bank_bri">Bank BRI</option>
                        <option value="bank_bca">Bank BCA</option>
                        <option value="bank_btn">Bank BTN</option>
                    </select>
                </div>

                <div id="bank_details" class="mt-3">
                    <h5>Bank Details</h5>
                    <p id="bank_account"></p>
                </div>

                <input type="hidden" id="room_price" value="{{ $booking->room->price }}">
                <input type="hidden" name="booking_id" value="{{ $booking->id }}">

                <div class="form-group mt-3">
                    <label for="total_amount">Total Amount to Pay:</label>
                    <input type="text" id="total_amount" name="total_amount" class="form-control" value="{{ 'Rp ' . number_format($booking->room->price * ((new DateTime($booking->checkout_date))->diff(new DateTime($booking->checkin_date))->days), 0, ',', '.') }}" readonly>
                </div>

                <div class="form-group mt-3">
                    <label for="proof_of_payment">Upload Proof of Payment:</label>
                    <input type="file" id="proof_of_payment" name="proof_of_payment" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Submit Payment</button>
            </form>
        </div>

        @include('partial.footer')

        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    @include('partial.js')

    <script>
        $(document).ready(function() {
            $('#payment_method').change(function() {
                var selectedBank = $(this).val();
                var bankAccount = '';

                switch(selectedBank) {
                    case 'bank_mandiri':
                        bankAccount = 'Bank Mandiri Account: 1234567890';
                        break;
                    case 'bank_bri':
                        bankAccount = 'Bank BRI Account: 0987654321';
                        break;
                    case 'bank_bca':
                        bankAccount = 'Bank BCA Account: 1122334455';
                        break;
                    case 'bank_btn':
                        bankAccount = 'Bank BTN Account: 5566778899';
                        break;
                    default:
                        bankAccount = '';
                }

                $('#bank_account').text(bankAccount);
            });
        });
    </script>
</body>
</html>
