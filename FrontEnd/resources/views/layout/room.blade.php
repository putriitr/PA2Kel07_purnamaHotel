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
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Room N Suite</h1>
                </div>
            </div>
        </div>

        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h5 class="section-title ff-secondary text-center text-primary fw-normal">Room Booking</h5>
                    <h1 class="mb-5">Room N Suite</h1>
                </div>
                <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
                    <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
                        <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 active" data-bs-toggle="pill"
                                href="#tab-1">
                                <i class="fa fa-bed fa-3x text-primary"></i>
                                <div class="ps-3">
                                    <strong><small class="text-body">Cozy</small></strong>
                                    <h3 class="mt-n1 mb-0">Bed</h3>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 me-0 pb-3" data-bs-toggle="pill"
                                href="#tab-4">
                                <i class="fa fa-home fa-3x text-primary"></i>
                                <div class="ps-3">
                                    <strong><small class="text-body">Executive</small></strong>
                                    <h3 class="mt-n1 mb-0">Suite</h3>
                                </div>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane fade show p-0 active">
                            <div class="row g-4">
                                <div class="container-xxl py-5">
                                    <div class="container">
                                        <div class="row g-5 align-items-center">
                                            <div class="col-lg-6">
                                                <div class="position-relative">
                                                    <img id="slideImg" class="img-fluid rounded w-100 wow zoomIn"
                                                        data-wow-delay="0.1s" src="{{ asset('/web/img/single1.jpg') }}">
                                                    <button id="nextBtn"
                                                        class="btn btn-primary position-absolute top-50 end-0 translate-middle-y">
                                                        <i class="fas fa-chevron-right"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="d-flex align-items-center mb-4">
                                                    <h5
                                                        class="section-title ff-secondary text-start text-primary fw-normal text-left">
                                                        Booking a room
                                                    </h5>
                                                </div>
                                                <h1 class="mb-4 text-start">Single Room</h1>
                                                <div class="mb-4 text-start d-flex align-items-center">
                                                    <i class="fa fa-bed fa-x text-secondary me-3"></i>
                                                    <p class="mb-0"><strong>Room :</strong> Size 16 m²</p>
                                                </div>
                                                <div class="mb-4 text-start d-flex align-items-start">
                                                    <i class="fa fa-bath fa-x text-secondary me-3 mt-1"></i>
                                                    <div>
                                                        <p><strong>In your private bathroom :</strong></p>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <ul>
                                                                    <li>Free Toiletries</li>
                                                                    <li>Shower</li>
                                                                    <li>Bidet</li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <ul>
                                                                    <li>Toilet</li>
                                                                    <li>Toilet paper</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-4 text-start d-flex align-items-start">
                                                    <i class="fa fa-tv fa-x text-secondary me-3 mt-1"></i>
                                                    <div>
                                                        <p><strong>Room Facilities :</strong></p>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <ul>
                                                                    <li>TV</li>
                                                                    <li>Linens</li>
                                                                    <li>Towel</li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <ul>
                                                                    <li>Wake-Up service</li>
                                                                    <li>Air conditioning</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-4 text-start d-flex align-items-start">
                                                    <i class="fa fa-smoking fa-x text-secondary me-3 mt-1"></i>
                                                    <p><strong>Smoking :</strong> No smoking</p>
                                                </div>
                                                <div class="mb-4 text-start d-flex align-items-start">
                                                    <i class="fa fa-money-bill fa-x text-secondary me-3 mt-1"></i>
                                                    <p><strong>Price :</strong> Rp 421.488 / night</p>
                                                </div>
                                                <a href="/book"
                                                    class="btn btn-primary py-sm-2 px-sm-4 me-2 animated slideInLeft">Book</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="tab-2" class="tab-pane fade show p-0 active">
                            <div class="row g-4">
                                <div class="container-xxl py-5">
                                    <div class="container">
                                        <div class="row g-5 align-items-center">
                                            <div class="col-lg-6">
                                                <div class="position-relative">
                                                    <img id="slideImg" class="img-fluid rounded w-100 wow zoomIn"
                                                        data-wow-delay="0.1s" src="{{ asset('/web/img/twin1.jpg') }}">
                                                    <button id="nextBtn"
                                                        class="btn btn-primary position-absolute top-50 end-0 translate-middle-y">
                                                        <i class="fas fa-chevron-right"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="d-flex align-items-center mb-4">
                                                    <h5
                                                        class="section-title ff-secondary text-start text-primary fw-normal text-left">
                                                        Booking a room
                                                    </h5>
                                                </div>
                                                <h1 class="mb-4 text-start">Standard Twin Room</h1>
                                                <div class="mb-4 text-start d-flex align-items-center">
                                                    <i class="fa fa-bed fa-x text-secondary me-3"></i>
                                                    <p class="mb-0"><strong>Room :</strong> Size 16 m²</p>
                                                </div>
                                                <div class="mb-4 text-start d-flex align-items-start">
                                                    <i class="fa fa-bath fa-x text-secondary me-3 mt-1"></i>
                                                    <div>
                                                        <p><strong>In your private bathroom :</strong></p>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <ul>
                                                                    <li>Free Toiletries</li>
                                                                    <li>Shower</li>
                                                                    <li>Bidet</li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <ul>
                                                                    <li>Toilet</li>
                                                                    <li>Toilet paper</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-4 text-start d-flex align-items-start">
                                                    <i class="fa fa-tv fa-x text-secondary me-3 mt-1"></i>
                                                    <div>
                                                        <p><strong>Room Facilities :</strong></p>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <ul>
                                                                    <li>TV</li>
                                                                    <li>Linens</li>
                                                                    <li>Towel</li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <ul>
                                                                    <li>Wake-Up service</li>
                                                                    <li>Air conditioning</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-4 text-start d-flex align-items-start">
                                                    <i class="fa fa-smoking fa-x text-secondary me-3 mt-1"></i>
                                                    <p><strong>Smoking :</strong> No smoking</p>
                                                </div>
                                                <div class="mb-4 text-start d-flex align-items-start">
                                                    <i class="fa fa-money-bill fa-x text-secondary me-3 mt-1"></i>
                                                    <p><strong>Price :</strong> Rp 636.364 / night</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="tab-3" class="tab-pane fade show p-0 active">
                            <div class="row g-4">
                                <div class="container-xxl py-5">
                                    <div class="container">
                                        <div class="row g-5 align-items-center">
                                            <div class="col-lg-6">
                                                <div class="position-relative">
                                                    <img id="slideImg" class="img-fluid rounded w-100 wow zoomIn"
                                                        data-wow-delay="0.1s"
                                                        src="{{ asset('/web/img/deluxe1.jpg') }}">
                                                    <button id="nextBtn"
                                                        class="btn btn-primary position-absolute top-50 end-0 translate-middle-y">
                                                        <i class="fas fa-chevron-right"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="d-flex align-items-center mb-4">
                                                    <h5
                                                        class="section-title ff-secondary text-start text-primary fw-normal text-left">
                                                        Booking a room
                                                    </h5>
                                                </div>
                                                <h1 class="mb-4 text-start">Deluxe Room</h1>
                                                <div class="mb-4 text-start d-flex align-items-center">
                                                    <i class="fa fa-bed fa-x text-secondary me-3"></i>
                                                    <p class="mb-0"><strong>Room :</strong> Size 17 m²</p>
                                                </div>
                                                <div class="mb-4 text-start d-flex align-items-start">
                                                    <i class="fa fa-bath fa-x text-secondary me-3 mt-1"></i>
                                                    <div>
                                                        <p><strong>In your private bathroom :</strong></p>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <ul>
                                                                    <li>Free Toiletries</li>
                                                                    <li>Shower</li>
                                                                    <li>Bidet</li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <ul>
                                                                    <li>Toilet</li>
                                                                    <li>Toilet paper</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-4 text-start d-flex align-items-start">
                                                    <i class="fa fa-sun fa-x text-secondary me-3 mt-1"></i>
                                                    <div>
                                                        <p><strong>Your View :</strong></p>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <ul>
                                                                    <li>Balcony</li>
                                                                    <li>Terrace</li>
                                                                    <li>Lake View</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-4 text-start d-flex align-items-start">
                                                    <i class="fa fa-tv fa-x text-secondary me-3 mt-1"></i>
                                                    <div>
                                                        <p><strong>Room Facilities :</strong></p>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <ul>
                                                                    <li>TV</li>
                                                                    <li>Linens</li>
                                                                    <li>Towel</li>
                                                                    <li>Flat-screen TV</li>
                                                                    <li>Sitting Area</li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <ul>
                                                                    <li>Wardrobe or closet</li>
                                                                    <li>Electric Kettle</li>
                                                                    <li>Wake-Up service</li>
                                                                    <li>Air conditioning</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-4 text-start d-flex align-items-start">
                                                    <i class="fa fa-smoking fa-x text-secondary me-3 mt-1"></i>
                                                    <p><strong>Smoking :</strong> No smoking</p>
                                                </div>
                                                <div class="mb-4 text-start d-flex align-items-start">
                                                    <i class="fa fa-money-bill fa-x text-secondary me-3 mt-1"></i>
                                                    <p><strong>Price :</strong> Rp 702.479 / night</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="tab-4" class="tab-pane fade show p-0">
                            <div class="row g-4">
                                <div class="container-xxl py-5">
                                    <div class="container">
                                        <div class="row g-5 align-items-center">
                                            <div class="col-lg-6">
                                                <div class="position-relative">
                                                    <img id="slideImg" class="img-fluid rounded w-100 wow zoomIn"
                                                        data-wow-delay="0.1s"
                                                        src="{{ asset('/web/img/suite1.jpg') }}">
                                                    <button id="nextBtn"
                                                        class="btn btn-primary position-absolute top-50 end-0 translate-middle-y">
                                                        <i class="fas fa-chevron-right"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="d-flex align-items-center mb-4">
                                                    <h5
                                                        class="section-title ff-secondary text-start text-primary fw-normal text-left">
                                                        Booking a room
                                                    </h5>
                                                </div>
                                                <h1 class="mb-4 text-start">Suite</h1>
                                                <div class="mb-4 text-start d-flex align-items-center">
                                                    <i class="fa fa-bed fa-x text-secondary me-3"></i>
                                                    <p class="mb-0"><strong>Room :</strong> Size 20 m²</p>
                                                </div>
                                                <div class="mb-4 text-start d-flex align-items-start">
                                                    <i class="fa fa-bath fa-x text-secondary me-3 mt-1"></i>
                                                    <div>
                                                        <p><strong>In your private bathroom :</strong></p>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <ul>
                                                                    <li>Free Toiletries</li>
                                                                    <li>Shower</li>
                                                                    <li>Bidet</li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <ul>
                                                                    <li>Toilet</li>
                                                                    <li>Toilet paper</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-4 text-start d-flex align-items-start">
                                                    <i class="fa fa-tv fa-x text-secondary me-3 mt-1"></i>
                                                    <div>
                                                        <p><strong>Room Facilities :</strong></p>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <ul>
                                                                    <li>TV</li>
                                                                    <li>Linens</li>
                                                                    <li>Towel</li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <ul>
                                                                    <li>Wake-Up service</li>
                                                                    <li>Air conditioning</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-4 text-start d-flex align-items-start">
                                                    <i class="fa fa-smoking fa-x text-secondary me-3 mt-1"></i>
                                                    <p><strong>Smoking :</strong> No smoking</p>
                                                </div>
                                                <div class="mb-4 text-start d-flex align-items-start">
                                                    <i class="fa fa-money-bill fa-x text-secondary me-3 mt-1"></i>
                                                    <p><strong>Price :</strong> Rp 933.884 / night</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="tab-5" class="tab-pane fade show p-0 active">
                            <div class="row g-4">
                                <div class="container-xxl py-5">
                                    <div class="container">
                                        <div class="row g-5 align-items-center">
                                            <div class="col-lg-6">
                                                <div class="position-relative">
                                                    <img id="slideImg" class="img-fluid rounded w-100 wow zoomIn"
                                                        data-wow-delay="0.1s" src="{{ asset('/web/img/view.jpg') }}">
                                                    <button id="nextBtn"
                                                        class="btn btn-primary position-absolute top-50 end-0 translate-middle-y">
                                                        <i class="fas fa-chevron-right"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="d-flex align-items-center mb-4">
                                                    <h5
                                                        class="section-title ff-secondary text-start text-primary fw-normal text-left">
                                                        Booking a room
                                                    </h5>
                                                </div>
                                                <h1 class="mb-4 text-start">Suite with Lake View</h1>
                                                <div class="mb-4 text-start d-flex align-items-center">
                                                    <i class="fa fa-bed fa-x text-secondary me-3"></i>
                                                    <p class="mb-0"><strong>Room :</strong> Size 16 m²</p>
                                                </div>
                                                <div class="mb-4 text-start d-flex align-items-start">
                                                    <i class="fa fa-bath fa-x text-secondary me-3 mt-1"></i>
                                                    <div>
                                                        <p><strong>In your private bathroom :</strong></p>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <ul>
                                                                    <li>Free Toiletries</li>
                                                                    <li>Shower</li>
                                                                    <li>Bidet</li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <ul>
                                                                    <li>Toilet</li>
                                                                    <li>Toilet paper</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-4 text-start d-flex align-items-start">
                                                    <i class="fa fa-sun fa-x text-secondary me-3 mt-1"></i>
                                                    <div>
                                                        <p><strong>Your View :</strong></p>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <ul>
                                                                    <li>Balcony</li>
                                                                    <li>Terrace</li>
                                                                    <li>Lake View</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-4 text-start d-flex align-items-start">
                                                    <i class="fa fa-tv fa-x text-secondary me-3 mt-1"></i>
                                                    <div>
                                                        <p><strong>Room Facilities :</strong></p>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <ul>
                                                                    <li>TV</li>
                                                                    <li>Linens</li>
                                                                    <li>Towel</li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <ul>
                                                                    <li>Wake-Up service</li>
                                                                    <li>Air conditioning</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-4 text-start d-flex align-items-start">
                                                    <i class="fa fa-smoking fa-x text-secondary me-3 mt-1"></i>
                                                    <p><strong>Smoking :</strong> No smoking</p>
                                                </div>
                                                <div class="mb-4 text-start d-flex align-items-start">
                                                    <i class="fa fa-money-bill fa-x text-secondary me-3 mt-1"></i>
                                                    <p><strong>Price :</strong> Rp 1.107.438 / night</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Menu End -->

        @include('partial.footer')

        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <script>
        $(document).ready(function() {
            var images = [
                "{{ asset('/web/img/single1.jpg') }}",
                "{{ asset('/web/img/single2.jpg') }}",
                "{{ asset('/web/img/single3.jpg') }}",
                "{{ asset('/web/img/single4.jpg') }}"
            ];
            var currentIndex = 0;

            $("#nextBtn").on("click", function() {
                currentIndex = (currentIndex + 1) % images.length;
                $("#slideImg").attr("src", images[currentIndex]);
            });
        });
    </script>

    @include('partial.js')
</body>

</html>
