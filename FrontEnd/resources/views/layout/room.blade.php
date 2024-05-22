<!DOCTYPE html>
<html lang="en">

<head>
    @include('partial.head')
    <style>
        .room-card {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 20px;
            align-items: flex-start;
        }

        .room-card img {
            max-width: 30%;
            max-height: 300px;
            object-fit: cover;
            margin-right: 20px;
            margin-left: 50px;
        }

        .room-card .details {
            flex: 1;
            display: flex;
            flex-direction: column;
            margin-right: 20px;
            /* Ubah margin kanan sesuai kebutuhan */
        }

        .room-card .right-details {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin-top: -10px;
            /* Atur margin atas jika perlu */
            margin-left: auto;
            max-width: 40%;
        }

        .room-card .right-details p {
            margin-bottom: 5px;
        }

        .room-card .icon {
            font-size: 16px;
            margin-right: 10px;
        }

        .nav-item a.active {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
                @include('partial.navbar')
            </nav>

            <div class="container-xxl py-5 bg-dark hero-header mb-5">
                <div class="container text-center my-5 pt-5 pb-4">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Room N Suite</h1>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->

        <!-- Room Booking Start -->
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h5 class="section-title ff-secondary text-center text-primary fw-normal">Room Booking</h5>
            <h1 class="mb-5">Room N Suite</h1>
        </div>
        <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
            <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
                <li class="nav-item">
                    <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 active" data-category="all">
                        <i class="fa fa-bed fa-3x text-primary"></i>
                        <div class="ps-3">
                            <strong><small class="text-body">All</small></strong>
                            <h3 class="mt-n1 mb-0">Rooms</h3>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3" data-category="1">
                        <i class="fa fa-home fa-3x text-primary"></i>
                        <div class="ps-3">
                            <strong><small class="text-body">Executive</small></strong>
                            <h3 class="mt-n1 mb-0">Suite</h3>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center text-start mx-3 me-0 pb-3" data-category="2">
                        <i class="fa fa-bed fa-3x text-primary"></i>
                        <div class="ps-3">
                            <strong><small class="text-body">Cozy</small></strong>
                            <h3 class="mt-n1 mb-0">Bed</h3>
                        </div>
                    </a>
                </li>
            </ul>

            <div class="tab-content">
                <div id="room-list" class="row g-4">
                    @foreach ($rooms as $room)
                        <div class="col-md-12 room-card" data-category="{{ $room->category_id }}">
                            <img id="slideImg-{{ $loop->index }}" class="img-fluid rounded wow zoomIn"
                                data-wow-delay="0.1s" src="{{ asset('images/rooms/' . $room->image) }}">
                            <div class="details">
                                <h5 class="section-title ff-secondary text-start text-primary fw-normal">Booking a room
                                </h5>
                                <h1 class="mb-4 text-start">{{ $room->name }}</h1>
                                <div class="text-start d-flex align-items-center">
                                    <i class="fa fa-bed icon text-secondary"></i>
                                    <p class="mb-0"><strong>Room :</strong> Size 16 m²</p>
                                </div>
                                <div class="text-start d-flex align-items-start">
                                    <i class="fa fa-tv icon text-secondary mt-1"></i>
                                    <div>
                                        <p><strong>Room Facilities :</strong></p>
                                        <ul>
                                            <li>TV</li>
                                            <li>Linens</li>
                                            <li>Towel</li>
                                            <li>Wake-Up service</li>
                                            <li>Air conditioning</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="text-start d-flex align-items-start">
                                    <i class="fa fa-bath icon text-secondary mt-1"></i>
                                    <div>
                                        <p><strong>In your private bathroom :</strong></p>
                                        <ul>
                                            <li>Free Toiletries</li>
                                            <li>Shower</li>
                                            <li>Bidet</li>
                                            <li>Toilet</li>
                                            <li>Toilet paper</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="right-details">
                                <div class="text-start d-flex align-items-start">
                                    <i class="fa fa-smoking icon text-secondary mt-1"></i>
                                    <p><strong>Smoking :</strong> No smoking</p>
                                </div>
                                <div class="text-start d-flex align-items-start">
                                    <i class="fa fa-money-bill icon text-secondary mt-1"></i>
                                    <p><strong>Price :</strong> Rp {{ number_format($room->price, 0, ',', '.') }} /
                                        night</p>
                                </div>
                                <a href="{{ route('book.room', ['roomId' => $room->id]) }}"
                                    class="btn btn-primary py-sm-2 px-sm-4 me-2 animated slideInLeft">Book</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Room Booking End -->

        <!-- Footer Start -->
        @include('partial.footer')

        <!-- Footer End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    @include('partial.js')
    <script>
        document.querySelectorAll('.nav-item a').forEach(tab => {
            tab.addEventListener('click', function() {
                const category = this.getAttribute('data-category');
                document.querySelectorAll('.room-card').forEach(card => {
                    if (category === 'all' || card.getAttribute('data-category') === category) {
                        card.style.display = 'flex';
                    } else {
                        card.style.display = 'none';
                    }
                });
                document.querySelectorAll('.nav-item a').forEach(tab => tab.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</body>

</html>
