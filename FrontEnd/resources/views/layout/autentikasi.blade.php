<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Login Page</title>
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
</head>

<body>
    <div class="container" id="container">
        <!-- Sign Up Form -->
        <div class="form-container sign-up">
            <form action="{{ route('customer.register') }}" method="POST">
                @csrf
                <h1>Create Account</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fab fa-google fa-2x" style="color: #DB4437;"></i></a>
                    <a href="#" class="icon"><i class="fab fa-whatsapp fa-2x" style="color: #00bb00;"></i></a>
                    <a href="#" class="icon"><i class="fab fa-facebook-f fa-2x" style="color: #3b5998;"></i></a>
                    <a href="#" class="icon"><i class="fab fa-instagram fa-2x" style="color: #C13584;"></i></a>
                </div>
                <span>or use your email for registration</span>
                <input type="text" name="name" placeholder="Name" value="{{ old('name') }}">
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
                <input type="password" name="password" placeholder="Password">
                <input type="password" name="password_confirmation" placeholder="Confirm Password">
                <button type="submit">Sign Up</button>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </form>
        </div>

        <!-- Sign In Form -->
        <div class="form-container sign-in">
            <form action="{{ route('customer.login') }}" method="POST">
                @csrf
                <h1>Sign In</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fab fa-google fa-2x" style="color: #DB4437;"></i></a>
                    <a href="#" class="icon"><i class="fab fa-whatsapp fa-2x" style="color: #00bb00;"></i></a>
                    <a href="#" class="icon"><i class="fab fa-facebook-f fa-2x" style="color: #3b5998;"></i></a>
                    <a href="#" class="icon"><i class="fab fa-instagram fa-2x" style="color: #C13584;"></i></a>
                </div>
                <span>or use your email account</span>
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
                <input type="password" name="password" placeholder="Password">
                <a href="#">Forgot Your Password?</a>
                <button type="submit">Sign In</button>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
            </form>
        </div>

        <!-- Toggle Panels -->
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Login to the system with an account to be able to use all website features.</p>
                    <button class="hidden" id="login">Login</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hello, Friend!</h1>
                    <p>Register an account to log in to the system and be able to use all website features.</p>
                    <button class="hidden" id="register">Make Account</button>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('/web/js/script.js') }}"></script>
</body>

</html>
