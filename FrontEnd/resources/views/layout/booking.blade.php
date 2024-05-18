<head>
    <meta charset="utf-8">
    <title>Form Booking</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('/web/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/web/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/web/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/web/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/web/css/script.css') }}" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }

        .form-all {
            text-align: left;
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            max-width: 800px;
            width: 100%;
        }

        .header-logo {
            margin-bottom: 20px;
        }

        .header-text h1 {
            text-align: center;
            margin: 0;
            font-size: 40px;
        }

        .header-text h3 {
            text-align: center;
            margin: 0;
            font-size: 20px;
        }
        .header-text .form-subHeader {
            margin: 0;
            font-size: 16px;
            color: gray;
        }

        .form-line {
            display: flex;
            flex-direction: column;
            align-items: left;
            margin-bottom: 20px;
        }

        .form-line-column {
            display: flex;
            flex-direction: column;
            align-items: left;
        }

        .form-line-column input,
        .form-line-column select,
        .form-line-column textarea {
            width: calc(50% - 10px);
            margin: 5px;
        }

        .form-buttons-wrapper {
            text-align: left;
        }

        .form-buttons-wrapper button {
            padding: 10px 20px;
            font-size: 16px;
        }

        .always-hidden {
            display: none;
        }
    </style>
</head>

<body>
    <div class="form-all">
        <div class="header-logo">
            <img src="/web/img/form.jpg" alt="Hotel Booking" width="700">
        </div>
        <div class="header-text">
            <h1>Hotel Booking</h1>
            <div class="form-subHeader">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h5 class="section-title ff-secondary text-center text-primary fw-normal">Nikmati pengalaman menginap di hotel kami</h5>
                </div>
            </div>

        </div>
        <form>
            <div class="form-line form-line-column">
                <label for="first_105">Name</label>
                <div style="display: flex; justify-content: center;">
                    <input type="text" id="first_105" name="q105_name105[first]" placeholder="First Name">
                    <input type="text" id="last_105" name="q105_name105[last]" placeholder="Last Name">
                </div>
            </div>
            <div class="form-line form-line-column">
                <label for="input_17">E-mail</label>
                <div style="display: flex; justify-content: center;">
                    <input type="email" id="input_17" name="q17_email17" placeholder="example@example.com" required>
                    <input type="tel" id="input_phone" name="q17_phone" placeholder="Phone Number" required>
                </div>
            </div>
            <div class="form-line form-line-column">
                <label for="input_6">Room Type</label>
                <div style="display: flex; justify-content: center;">
                    <select id="input_6" name="q6_roomType" required>
                        <option value="">Please Select</option>
                        <option value="Standard Room (1 to 2 People)">Standard Single Bed (1 to 2 People)</option>
                        <option value="Family Room (1 to 4 People)">Standard Twin Bed (1 to 4 People)</option>
                        <option value="Private Room (1 to 3 People)">Deluxe Balcony Room (1 to 3 People)</option>
                        <option value="Mix Dorm Room (6 People)">Suite Room (5 People)</option>
                        <option value="Female Dorm Room (6 People)">Executive Suite Lake View Room (6 People)</option>
                    </select>
                    <input type="number" id="input_112" name="q112_numberOf" placeholder="Number of Guests" required>
                </div>
            </div>
            <div class="form-line form-line-column">
                <label for="lite_mode_22">Arrival Date & Time</label>
                <input type="text" id="lite_mode_22" name="q22_arrivalDate" placeholder="MM-DD-YYYY HH:MM" required>
            </div>
            <div class="form-line form-line-column">
                <label for="input_30">Special Requests</label>
                <textarea id="input_30" name="q30_specialRequests" placeholder="Your requests"></textarea>
            </div>
            <div class="form-buttons-wrapper">
                <button type="submit" class="submit-button">Submit</button>
            </div>
        </form>
    </div>
</body>
