<head>
    @include('partial.head')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            @include('partial.navbar')

            <div class="container-xxl py-5 bg-dark hero-header mb-5">
                <div class="container text-center my-5 pt-5 pb-4">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Gallery</h1>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->

        <!-- Menu Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h1 class="mb-5">Beauty of Hotel Purnama Balige</h1>
                </div>
                <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
                    <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
                        <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 active" data-bs-toggle="pill"
                                href="#tab-1">
                                <i class="fa fa-home fa-x text-primary"></i>
                                <div class="ps-3">
                                    <h5 class="mt-n1 mb-0">Building View</h5>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 me-0 pb-3 active" data-bs-toggle="pill"
                                href="#tab-2">
                                <i class="fa fa-home fa-x text-primary"></i>
                                <div class="ps-3">
                                    <h5 class="mt-n1 mb-0">Restaurant</h5>
                                </div>
                            </a>
                        </li>
                        <ul></ul>
                        <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 active" data-bs-toggle="pill"
                                href="#tab-3">
                                <i class="fa fa-home fa-x text-primary"></i>
                                <div class="ps-3">
                                    <h5 class="mt-n1 mb-0">Outdoor</h5>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 me-0 pb-3 active" data-bs-toggle="pill"
                                href="#tab-4">
                                <i class="fa fa-home fa-x text-primary"></i>
                                <div class="ps-3">
                                    <h5 class="mt-n1 mb-0">Spa & Sauna</h5>
                                </div>
                            </a>
                        </li>
                        <ul></ul>
                        <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 active" data-bs-toggle="pill"
                                href="#tab-5">
                                <i class="fa fa-home fa-x text-primary"></i>
                                <div class="ps-3">
                                    <h5 class="mt-n1 mb-0">Sport</h5>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Menu End -->

        <div id="lightbox" class="lightbox">
            <span class="close" onclick="document.getElementById('lightbox').style.display='none'">&times;</span>
            <img class="lightbox-content" id="lightbox-img">
        </div>

        <!-- Building Views Section -->
        <div class="container-xxl pt-5 pb-3">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h5 class="section-title ff-secondary text-center text-primary fw-normal">Hotel Photos</h5>
                    <h1 class="mb-5">Building Views</h1>
                </div>
                <div class="row g-4">
                    @foreach ($buildingViews as $gallery)
                        <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                            <div class="overflow-hidden m-10">
                                <a href="{{ asset('images/gallery/' . $gallery->image) }}" data-lightbox="hotel-photos">
                                    <img class="img-fluid square-img" src="{{ asset('images/gallery/' . $gallery->image) }}"
                                        alt="">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Restaurant Section -->
        <div class="container-xxl pt-5 pb-3">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h5 class="section-title ff-secondary text-center text-primary fw-normal">Hotel Photos</h5>
                    <h1 class="mb-5">Restaurant</h1>
                </div>
                <div class="row g-4">
                    @foreach ($restaurant as $gallery)
                        <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                            <div class="overflow-hidden m-10">
                                <a href="{{ asset('images/gallery/' . $gallery->image) }}" data-lightbox="hotel-photos">
                                    <img class="img-fluid square-img" src="{{ asset('images/gallery/' . $gallery->image) }}"
                                        alt="">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Outdoor Section -->
        <div class="container-xxl pt-5 pb-3">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h5 class="section-title ff-secondary text-center text-primary fw-normal">Hotel Photos</h5>
                    <h1 class="mb-5">Outdoor</h1>
                </div>
                <div class="row g-4">
                    @foreach ($outdoor as $gallery)
                        <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                            <div class="overflow-hidden m-10">
                                <a href="{{ asset('images/gallery/' . $gallery->image) }}" data-lightbox="hotel-photos">
                                    <img class="img-fluid square-img" src="{{ asset('images/gallery/' . $gallery->image) }}"
                                        alt="">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Spa & Sauna Section -->
        <div class="container-xxl pt-5 pb-3">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h5 class="section-title ff-secondary text-center text-primary fw-normal">Hotel Photos</h5>
                    <h1 class="mb-5">Spa & Sauna</h1>
                </div>
                <div class="row g-4">
                    @foreach ($spaAndSauna as $gallery)
                        <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                            <div class="overflow-hidden m-10">
                                <a href="{{ asset('images/gallery/' . $gallery->image) }}" data-lightbox="hotel-photos">
                                    <img class="img-fluid square-img" src="{{ asset('images/gallery/' . $gallery->image) }}"
                                        alt="">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Sports Section -->
        <div class="container-xxl pt-5 pb-3">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h5 class="section-title ff-secondary text-center text-primary fw-normal">Hotel Photos</h5>
                    <h1 class="mb-5">Sports</h1>
                </div>
                <div class="row g-4">
                    @foreach ($sports as $gallery)
                        <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                            <div class="overflow-hidden m-10">
                                <a href="{{ asset('images/gallery/' . $gallery->image) }}" data-lightbox="hotel-photos">
                                    <img class="img-fluid square-img" src="{{ asset('images/gallery/' . $gallery->image) }}"
                                        alt="">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>



        <div id="myModal" class="modal">
            <span class="close" onclick="closeModal()">&times;</span>
            <img class="modal-content" id="img01">
        </div>

        <script>
            function openLightbox(src) {
                document.getElementById('lightbox').style.display = 'block';
                document.getElementById('lightbox-img').src = src;
            }
        </script>
        @include('partial.footer')
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
    @include('partial.js')
</body>
<style>
    .square-img {
        width: 450px;
        height: 250px;
        object-fit: cover;
    }
</style>
