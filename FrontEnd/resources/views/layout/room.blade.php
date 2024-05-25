<!DOCTYPE html>
<html lang="en">

<head>
    @include('partial.head')
    <style>
        .room-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
            margin-left: 20px;
            max-width: 300px;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .room-card:hover {
            transform: translateY(-5px);
        }

        .room-card img {
            max-width: 100%;
            max-height: 200px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .room-card .details {
            width: 100%;
            text-align: left;
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
    <div class="container bg-white p-0">
        <!-- Navbar & Hero Start -->
        <div class="container position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
                @include('partial.navbar')
            </nav>

            <div class="container py-5 bg-dark hero-header mb-5">
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
                    <a class="nav-link active" data-category="all">All Rooms</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-category="1">Executive Suite</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-category="2">Cozy Bed</a>
                </li>
            </ul>

            <div class="tab-content">
                <div id="room-list" class="row g-4">
                    @foreach ($rooms as $room)
                        <div class="col-md-4">
                            <div class="room-card">
                                <img src="{{ asset('images/rooms/' . $room->image) }}" alt="{{ $room->name }}">
                                <div class="details">
                                    <h2>{{ $room->name }}</h2>
                                    <p><strong>Room Size:</strong> {{ $room->size }} m²</p>
                                    <p><strong>Room Facilities:</strong></p>
                                    <ul>
                                        @foreach (explode(',', $room->facility) as $facility)
                                            <li>{{ $facility }}</li>
                                        @endforeach
                                    </ul>
                                    <p><strong>Available:</strong> {{ $room->available }}</p>
                                    <p><strong>Smoking:</strong> No smoking</p>
                                    <p><strong>Price:</strong> Rp {{ number_format($room->price, 0, ',', '.') }} / night</p>
                                    <a href="{{ route('book.room', ['roomId' => $room->id]) }}" class="btn btn-primary">Book</a>
                                </div>
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
                        card.style.display = 'block';
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
