<!DOCTYPE html>
<html lang="en">

<head>
    @include('partial.head')
    <style>
        .staff-card {
            height: 100%;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            border-radius: 8px;
            position: relative;
        }

        .staff-image {
            height: 300px;
            width: 100%;
            object-fit: cover;
        }

        .staff-details {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
            padding: 16px;
            position: relative;
        }

        .social-links {
            margin-top: 16px;
            display: flex;
            justify-content: center;
            position: absolute;
            bottom: 16px;
            left: 50%;
            transform: translateX(-50%);
        }

        .social-links a {
            margin: 0 5px;
        }
    </style>
</head>

<body>
    <div class="container bg-white p-0">
        <!-- Navbar & Hero Start -->
        <div class="container position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
                @include('partial.navbar')
            </nav>

            <div class="container py-5 bg-dark hero-header mb-5">
                <div class="container text-center my-5 pt-5 pb-4">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Our Team</h1>
                </div>
            </div>
        </div>
        <!-- Navbar End -->

        <!-- Staff List Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="section-title text-center text-primary text-uppercase">Team</h6>
                    <h1 class="mb-5">Meet Our <span class="text-primary text-uppercase">Staffs</span></h1>
                </div>
                <div class="row g-4 justify-content-center">
                    @foreach ($staffMembers as $staff )
                    <div class="col-lg-4 col-md-6 mb-4 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="staff-card rounded shadow mx-auto"> <!-- Tambahkan kelas mx-auto di sini -->
                            <div class="position-relative">
                                <img class="img-fluid staff-image" src="{{ asset('images/staff/' . $staff->image) }}" alt="">
                            </div>
                            <div class="staff-details">
                                <h5 class="fw-bold mb-0">{{$staff->name}}</h5>
                                <small>{{$staff->role}}</small>
                                <br><br>
                                <div class="social-links">
                                    <a class="btn btn-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square btn-primary mx-1" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square btn-primary mx-1" href=""><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Staff List End -->

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
