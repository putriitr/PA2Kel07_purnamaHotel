<!DOCTYPE html>
<html lang="en">

<head>
    @include('partial.head')
    <style>
        .room-image {
            max-height: 500px;
            object-fit: cover;
        }
        .room-details {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .room-info {
            margin-bottom: 1rem;
        }
        .star-rating .fa-star {
            color: #ffd700;
        }
        .star-rating .fa-star-o {
            color: #d3d3d3;
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
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Room Details</h1>
                </div>
            </div>
        </div>
        <!-- Navbar End -->

        <!-- Room Detail Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h1 class="mb-5">{{ $room->name }}</h1>
                </div>
                <div class="row g-4">
                    <div class="col-lg-6 col-md-6">
                        <img class="img-fluid room-image" src="{{ asset('images/rooms/' . $room->image) }}" alt="{{ $room->name }}">
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="room-details shadow rounded p-4">
                            <div class="room-info">
                                <h5 class="mb-3">{{ $room->name }}</h5>
                                <div class="d-flex mb-3">
                                    <small class="border-end me-3 pe-3">
                                        <i class="fa fa-bed text-primary me-2"></i>{{ $room->beds }} Bed
                                    </small>
                                    <small class="border-end me-3 pe-3">
                                        <i class="fa fa-bath text-primary me-2"></i>{{ $room->baths }} Bath
                                    </small>
                                    <small>
                                        <i class="fa fa-wifi text-primary me-2"></i>Wifi
                                    </small>
                                </div>
                                <p class="text-body mb-3">{{ $room->description }}</p>
                                <p class="text-body mb-3">Price: Rp {{ number_format($room->price, 0, ',', '.') }} / Night</p>
                                <p class="text-body mb-3">Capacity: {{ $room->capacity }} persons</p>
                                <p class="text-body mb-3">Facilities: {{ $room->facility }}</p>
                            </div>
                            @if (auth()->guard('customers')->check())
                                            <a class="btn btn-sm btn-dark rounded py-2 px-4"
                                                href="{{ route('book.room', ['roomId' => $room->id]) }}">
                                                Book Now
                                            </a>
                                        @else
                                            <a class="btn btn-sm btn-dark rounded py-2 px-4"
                                                href="{{ route('login') }}">
                                                Login to Book
                                            </a>
                                        @endif
                        </div>
                        <div class="bg-light rounded p-4 mt-4">
                            <h5 class="mb-4">Room Information</h5>
                            <p><strong>Room Number:</strong> {{ $room->room_number }}</p>
                            <p><strong>Size:</strong> {{ $room->size }} m²</p>
                            <p><strong>Category:</strong> {{ $room->category->name }}</p>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Room Detail End -->

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
