<!DOCTYPE html>
<html lang="en">

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
                            <h2 class="display-3 text-white animated slideInLeft">Hotel<br>Purnama Balige</h2>
                            <p class="text-white animated slideInLeft mb-4 pb-2">Bersantai dengan pemandangan indah Danau
                                Toba dan nikmati fasilitas Hotel Purnama Balige yang lengkap dan menarik</p>
                            <a href="" class="btn btn-primary py-sm-3 px-sm-5 me-3 animated slideInLeft">Book A
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


        <!-- Menu Start -->
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
                                <i class="fa fa-bed fa-2x text-primary"></i>
                                <div class="ps-3">
                                    <small class="text-body">Cozy</small>
                                    <h6 class="mt-n1 mb-0">Bed</h6>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 me-0 pb-3" data-bs-toggle="pill"
                                href="#tab-3">
                                <i class="fa fa-home fa-2x text-primary"></i>
                                <div class="ps-3">
                                    <small class="text-body">Executive</small>
                                    <h6 class="mt-n1 mb-0">Suite</h6>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane fade show p-0 active">
                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="img/menu-1.jpg" alt=""
                                            style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span>Standard Single Bed</span>
                                                <span class="text-primary">Rp 421.488</span>
                                            </h5>
                                            <small class="fst-italic">Kamar dengan fasilitas single bed</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="img/menu-3.jpg" alt=""
                                            style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span>Deluxe Balcony</span>
                                                <span class="text-primary">Rp 702.479</span>
                                            </h5>
                                            <small class="fst-italic">Kamar dengan queen bed dan balkon</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="img/menu-2.jpg" alt=""
                                            style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span>Standard Twin Bed</span>
                                                <span class="text-primary">Rp 636.364</span>
                                            </h5>
                                            <small class="fst-italic">Kamar dengan fasilitas twin bed</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab-3" class="tab-pane fade show p-0">
                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="img/menu-1.jpg"
                                            alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span>Suite</span>
                                                <span class="text-primary">Rp 933.884</span>
                                            </h5>
                                            <small class="fst-italic">Suite dengan 1 king bed</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="img/menu-2.jpg"
                                            alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span>Executive Suite Lake View</span>
                                                <span class="text-primary">Rp 1.107.438</span>
                                            </h5>
                                            <small class="fst-italic">Suite dengan pemandangan Danau Toba dan 1 king
                                                bed</small>
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
                                        onclick="window.location.href = '/book'">Book Now</button>
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
                        <h5 class="mb-0">Outdoor</h5>
                    </div>
                    <div class="col-lg-3 col-md-6 wow fadeInUp d-flex flex-column align-items-center"
                        data-wow-delay="0.3s">
                        <img class="img-fluid" src="{{ asset('/web/img/spa.webp') }}" alt="">
                        <br />
                        <h5 class="mb-0">Spa & Sauna</h5>
                    </div>
                    <div class="col-lg-3 col-md-6 wow fadeInUp d-flex flex-column align-items-center"
                        data-wow-delay="0.5s">
                        <img class="img-fluid" src="{{ asset('/web/img/sport2.jpg') }}" alt="">
                        <br />
                        <h5 class="mb-0">Sports</h5>
                    </div>
                </div><br/><br/>
                <div class="row g-4 justify-content-center">
                    <div class="col-lg-3 col-md-6 wow fadeInUp d-flex flex-column align-items-center"
                        data-wow-delay="0.7s">
                        <img class="img-fluid" src="{{ asset('/web/img/lobi.webp') }}" alt="">
                        <br />
                        <h5 class="mb-0">Lobby</h5>
                    </div>
                    <div class="col-lg-3 col-md-6 wow fadeInUp d-flex flex-column align-items-center"
                        data-wow-delay="0.1s">
                        <img class="img-fluid" src="{{ asset('/web/img/resto2.jpg') }}" alt="">
                        <br />
                        <h5 class="mb-0">Restaurant</h5>
                    </div>
                </div>
            </div>
        </div>
        <!-- Team End -->


        <!-- Testimonial Start -->
        <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container">
                <div class="text-center">
                    <h5 class="section-title ff-secondary text-center text-primary fw-normal">Testimonial</h5>
                    <h1 class="mb-5">Our Clients Say!!!</h1>
                </div>
                <div class="owl-carousel testimonial-carousel">
                    <div class="testimonial-item bg-transparent border rounded p-4">
                        <i class="fa fa-quote-left fa-2x text-primary mb-3"></i>
                        <br /><small>- 1 November 2023 -</small>
                        <p>Spektakuler, satu hari menginap tanggal 27 Oktober - 28 Oktober dan memesan untuk dua kamar dan kemudian mendapat kejutan bahwa kami dapat menaiki speedboat secara gratis di sekitar Danau Toba.</p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded-circle" src="{{ asset('/web/img/ID.png') }}"
                                style="width: 50px; height: 50px;">
                            <div class="ps-3">
                                <h5 class="mb-1">Suprianto</h5>
                                <small>Indonesia</small>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item bg-transparent border rounded p-4">
                        <i class="fa fa-quote-left fa-2x text-primary mb-3"></i>
                        <br /><small>- 23 Juli 2023 -</small>
                        <p>Lokasi yang bagus, pemandangan yang bagus dan staf yang ramah. Kamar akan lebih indah dan pemandangannya lebih spektakuler jika pintu kaca ke teras yang bersih.</p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded-circle" src="{{ asset('/web/img/Nz.png') }}"
                                style="width: 50px; height: 50px;">
                            <div class="ps-3">
                                <h5 class="mb-1">Gillian</h5>
                                <small>New Zealand</small>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item bg-transparent border rounded p-4">
                        <i class="fa fa-quote-left fa-2x text-primary mb-3"></i>
                        <br /><small>- 17 September 2023</small>
                        <p>Salah satu hotel terbaik di daerah Balige dengan pemandangan Danau Toba yang indah dari dermaga, dekat ke Bandara Silangit, dan kapal yang lebih besar untuk berlayar mengelilingi Danau Toba di hari minggu.</p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded-circle" src="{{ asset('/web/img/ID.png') }}"
                                style="width: 50px; height: 50px;">
                            <div class="ps-3">
                                <h5 class="mb-1">Kusnuryono</h5>
                                <small>Indonesia</small>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item bg-transparent border rounded p-4">
                        <i class="fa fa-quote-left fa-2x text-primary mb-3"></i>
                        <br /><small>- 28 Desember 2023</small>
                        <p>Dapat melihat pemandangan Danau Toba secara langsung yang sangat indah dan sarapan yang disediakan lezat. Hotel ini menyediakan makanan lokal, tapi tidak banyak. Tidak terlalu banyak protein, kebanyakan karbohidrat.</p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded-circle" src="{{ asset('/web/img/UK.png') }}"
                                style="width: 50px; height: 50px;">
                            <div class="ps-3">
                                <h5 class="mb-1">Ramos</h5>
                                <small>Inggris Raya</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Testimonial End -->


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
