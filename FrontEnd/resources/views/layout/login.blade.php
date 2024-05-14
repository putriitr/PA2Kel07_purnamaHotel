<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap"
        rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link href="{{ asset('/web/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/web/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/web/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <link href="{{ asset('/web/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/web/css/style.css') }}" rel="stylesheet">

    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            flex-direction: column;
        }

        .form-container {
            max-width: 400px;
            width: 100%;
        }

        .form-container .input-box,
        .form-container .forgot-password,
        .form-container .btn {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <div class="container-xxl position-relative p-0">
            <div class="container-xxl py-5 bg-dark hero-header mb-5">
                <div class="container text-center my-5 pt-5 pb-4">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Login Here</h1>
                    <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                        <h5 class="section-title ff-secondary text-center text-primary fw-normal">Book a room with your account</h5><br /><br /><br />
                        <div class="social-icons">
                            <a href="#" style="display: inline-block;"><i class="fa fa-envelope fa-3x text-primary"></i></a>
                            <a href="#" style="display: inline-block;"><i class="fab fa-facebook fa-3x text-primary"></i></a>
                            <a href="#" style="display: inline-block;"><i class="fab fa-twitter fa-3x text-primary"></i></a>
                            <a href="#" style="display: inline-block;"><i class="fab fa-instagram fa-3x text-primary"></i></a>
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="wow fadeInUp" data-wow-delay="0.2s">
                                <form action="">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <h1>Login Here</h1>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="input-box">
                                                <input type="text" class="form-control" id="username"
                                                    placeholder="Username" required>
                                                <i class='bx bxs-user'></i>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="input-box">
                                                <input type="password" class="form-control" id="password"
                                                    placeholder="Password" required>
                                                <i class='bx bxs-lock-alt'></i>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="forgot-password">
                                                <a href="#">Forgot Password?</a>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-warning">Login</button>
                                        </div>
                                        <div class="col-12">
                                            <div class="register-link">
                                                <p>Don't have an account? <a href="/register">Register</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('partial.js')
</body>

</html>
