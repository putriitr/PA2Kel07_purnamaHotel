<head>
    @include('partial.head')
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <style>
            .img-fluid {
                transform: none !important;
            }
        </style>

        <div class="container-xxl position-relative p-0">
            @include('partial.navbar')
            <div class="container-xxl py-5 bg-dark hero-header mb-5">
                <div class="container my-5 py-5">
                    <div class="row align-items-center g-5">
                        <div class="col-lg-6 text-center text-lg-start">
                            <h3 class="display-10 text-white animated slideInLeft">Selamat Datang @if (Auth::guard('customers')->check()) {{ Auth::guard('customers')->user()->first_name }} {{ Auth::guard('customers')->user()->last_name }}
                                @endif di</h3>
                            <h2 class="display-3 text-white animated slideInLeft">Hotel<br>Purnama Balige</h2>
                            <p class="text-white animated slideInLeft mb-4 pb-2">Bersantai dengan pemandangan indah Danau
                                Toba dan nikmati fasilitas Hotel Purnama Balige yang lengkap dan menarik</p>
                            <a href="{{route('room')}}" class="btn btn-primary py-sm-3 px-sm-5 me-3 animated slideInLeft">Book A
                                Room</a>
                        </div>
                        <div class="col-lg-6 text-center text-lg-end overflow-hidden">
                            <img class="img-fluid" src="{{ asset('/web/img/nav.png') }}" alt=""
                                style="transform: none;">
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- About Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6">
                        <div class="row g-3">
                            <div class="col-6 text-start">
                                <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.1s"
                                    src="{{ asset('/web/img/about-1.jpg') }}">
                            </div>
                            <div class="col-6 text-start">
                                <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.3s"
                                    src="{{ asset('/web/img/about-2.jpg') }}" style="margin-top: 25%;">
                            </div>
                            <div class="col-6 text-end">
                                <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.5s"
                                    src="{{ asset('/web/img/about-3.jpg') }}">
                            </div>
                            <div class="col-6 text-end">
                                <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.7s"
                                    src="{{ asset('/web/img/about-4.jpg') }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h5 class="section-title ff-secondary text-start text-primary fw-normal">About Us</h5>
                        <h1 class="mb-4">Welcome to <br /> Hotel Purnama Balige</h1>
                        <p class="mb-4">Hotel Purnama Balige terletak di Kecamatan Balige di Jalan Pardede Pasir No.
                            10, muncul sebagai destinasi favorit bagi wisatawan yang tertarik dengan keindahan Danau
                            Toba. </p>
                        <p class="mb-4">Dengan pemandangan spektakuler dan layanan yang ramah, hotel ini menjadi
                            tempat istirahat yang sempurna untuk mengeksplorasi pesona alam daerah Toba dan sekitarnya.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->




        <!-- Reservation Start -->
        <div class="container-xxl py-5 px-0 wow fadeInUp" data-wow-delay="0.1s">
            <div class="row g-0">
                <div class="col-md-8">
                    <div class="video">
                        <button type="button" class="btn-play"
                            onclick="window.location.href = 'https://youtu.be/siI0axJ7cag?si=9NM3NtqTjqAeILuj'">
                            <span></span>
                        </button>
                    </div>
                </div>
                <div class="col-md-4 bg-dark d-flex align-items-center">
                    <div class="p-5 wow fadeInUp" data-wow-delay="0.2s">
                        <h5 class="section-title ff-secondary text-start text-primary fw-normal">Reservation</h5>
                        <h1 class="text-white mb-4">Book A Room Online</h1>
                        <form>
                            <div class="row g-3">
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="button"
                                        onclick="window.location.href = '{{route('room')}}'">Book Now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Youtube Video</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- 16:9 aspect ratio -->
                        <div class="ratio ratio-16x9">
                            <iframe class="embed-responsive-item" src="" id="video" allowfullscreen
                                allowscriptaccess="always" allow="autoplay"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Reservation End -->

        <script>
            function playVideo(videoSrc) {
                var videoModal = document.getElementById('videoModal');
                var videoFrame = videoModal.querySelector('iframe');
                videoFrame.src = videoSrc;
                $('#videoModal').modal('show');
            }
        </script>


        <!-- Team Start -->
        <div class="container-xxl pt-5 pb-3">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h5 class="section-title ff-secondary text-center text-primary fw-normal">Our Facilities</h5>
                    <h1 class="mb-5">Enjoy all the facilities</h1>
                </div>
                <div class="row g-4 justify-content-center">
                    <div class="col-lg-3 col-md-6 wow fadeInUp d-flex flex-column align-items-center"
                        data-wow-delay="0.1s">
                        <img class="img-fluid square-img" src="{{ asset('/web/img/kolam.webp') }}" alt="">
                        <br />
                        <center><h5 class="mb-0">Umum</h5></center>
                    </div>
                    <div class="col-lg-3 col-md-6 wow fadeInUp d-flex flex-column align-items-center"
                        data-wow-delay="0.3s">
                        <img class="img-fluid" src="{{ asset('/web/img/sauna3.jpg') }}" alt="">
                        <br />
                        <center><h5 class="mb-0">Spa & Sauna</h5></center>
                    </div>
                    <div class="col-lg-3 col-md-6 wow fadeInUp d-flex flex-column align-items-center"
                        data-wow-delay="0.5s">
                        <img class="img-fluid" src="{{ asset('/web/img/sport2.jpg') }}" alt="">
                        <br />
                        <center><h5 class="mb-0">Sports</h5></center>
                    </div>
                </div><br /><br />
                <div class="row g-4 justify-content-center">
                    <div class="col-lg-3 col-md-6 wow fadeInUp d-flex flex-column align-items-center"
                        data-wow-delay="0.7s">
                        <img class="img-fluid" src="{{ asset('/web/img/bank.jpeg') }}" alt="">
                        <br />
                        <center><h5 class="mb-0">Fasilitas Terdekat</h5></center>
                    </div>
                    <div class="col-lg-3 col-md-6 wow fadeInUp d-flex flex-column align-items-center"
                        data-wow-delay="0.9s">
                        <img class="img-fluid" src="{{ asset('/web/img/lake2.jpg') }}" alt="">
                        <br />
                        <center><h5 class="mb-0">Fasilitas Kamar</h5></center>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Start -->
        @include('partial.footer')
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    @include('partial.js')
</body>
