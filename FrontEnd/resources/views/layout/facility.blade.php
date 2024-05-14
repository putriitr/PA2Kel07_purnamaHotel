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

        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="service-item rounded pt-3">
                            <div class="p-4">
                                <i class="fa fa-3x fa-user-tie text-primary mb-4"></i>
                                <h5>Umum</h5>
                                <p class="mb-4">
                                    <ul>
                                        <li>Kolam Renang</li>
                                        <li>Taman</li>
                                        <li>Restoran</li>
                                        <li>Area Parkir</li>
                                        <li>WiFi Gratis</li>
                                    </ul>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="service-item rounded pt-3">
                            <div class="p-4">
                                <i class="fa fa-3x fa-utensils text-primary mb-4"></i>
                                <h5>Spa & Sauna</h5>
                                <p class="mb-4">
                                    <ul>
                                        <li>Spa Beauty</li>
                                        <li>Sauna</li>
                                        <li>Mandi Uap</li>
                                        <li>Pijat Relaksasi</li>
                                        <li>Salon</li>
                                    </ul>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="service-item rounded pt-3">
                            <div class="p-4">
                                <i class="fa fa-3x fa-cart-plus text-primary mb-4"></i>
                                <h5>Sports</h5>
                                <p class="mb-4">
                                    <ul>
                                        <li>Speedboat</li>
                                        <li>Kapal</li>
                                        <li>Fitness Center</li>
                                        <li>Gymnastics Area</li>
                                        <li>Darts Area</li>
                                    </ul>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                        <div class="service-item rounded pt-3">
                            <div class="p-4">
                                <i class="fa fa-3x fa-headset text-primary mb-4"></i>
                                <h5>Fasilitas Terdekat</h5>
                                <p class="mb-4">
                                    <ul>
                                        <li>Bank dan ATM</li>
                                        <li>Minimarket</li>
                                        <li>Pasar</li>
                                        <li>...</li>
                                        <li>...</li>
                                    </ul>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                        <div class="service-item rounded pt-3">
                            <div class="p-4">
                                <i class="fa fa-3x fa-bed text-primary mb-4"></i>
                                <h5>Fasilitas Kamar</h5>
                                <p class="mb-4">
                                    <ul>
                                        <li>AC</li>
                                        <li>Televisi</li>
                                        <li>Meja</li>
                                        <li>Lemari</li>
                                        <li>Kamar Mandi</li>
                                    </ul>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                        <div class="service-item rounded pt-3">
                            <div class="p-4">
                                <i class="fa fa-3x fa-headset text-primary mb-4"></i>
                                <h5>Servis Hotel</h5>
                                <p class="mb-4">
                                    <ul>
                                        <li>Resepsionist</li>
                                        <li>Security</li>
                                        <li>Laundry</li>
                                        <li>Staff Multibahasa</li>
                                        <li>Cleaning Service</li>
                                    </ul>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                        <div class="service-item rounded pt-3">
                            <div class="p-4">
                                <i class="fa fa-3x fa-headset text-primary mb-4"></i>
                                <h5>Bisnis</h5>
                                <p class="mb-4">
                                    <ul>
                                        <li>Ruang Rapat</li>
                                        <li>Layanan Sekretarial</li>
                                        <li>Antar-jemput</li>
                                        <li>Sewa Mobil</li>
                                        <li>Makanan</li>
                                    </ul>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                        <div class="service-item rounded pt-3">
                            <div class="p-4">
                                <i class="fa fa-3x fa-headset text-primary mb-4"></i>
                                <h5>Jasa Hotel</h5>
                                <p class="mb-4">
                                    <ul>
                                        <li>Antar-jemput bandara-hotel</li>
                                        <li>Sewa Mobil</li>
                                        <li>....</li>
                                        <li>....</li>
                                        <li>....</li>
                                    </ul>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('partial.footer')

        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    @include('partial.js')
</body>

</html>
