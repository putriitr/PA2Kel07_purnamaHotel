<!DOCTYPE html>
<html lang="en">
<head>
    @include('partial.head')
    <style>
        .container-xxl {
            margin-left: auto;
            margin-right: auto;
        }

        .row.g-4 {
            margin-left: auto;
            margin-right: auto;
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

        <!-- Room Categories Start -->
        <div class="text-center">
            <button class="btn btn-primary mb-3" onclick="showAllRooms()">Show All</button>
            <!-- Buttons to filter rooms by category -->
            @foreach ($roomCategories as $category)
                <button class="btn btn-primary mb-3 ms-3" onclick="showRoomsByCategory({{ $category->id }})">{{ $category->name }}</button>
            @endforeach
            <!-- Button to view booking history -->
            <a href="{{ route('user.bookings') }}" class="btn btn-secondary mb-3 ms-3">View Booking History</a>
        </div>
        <!-- Room Categories End -->

        <!-- Room Booking Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="section-title text-center text-primary text-uppercase">Our Rooms</h6>
                    <h1 class="mb-5">Explore Our <span class="text-primary text-uppercase">Rooms</span></h1>
                </div>
                <div class="row g-4 justify-content-center" id="roomList">
                    @foreach ($rooms as $room)
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s" data-category="{{ $room->category_id }}">
                            <div class="room-item shadow rounded overflow-hidden">
                                <div class="position-relative">
                                    <img class="img-fluid" src="{{ asset('images/rooms/' . $room->image) }}" alt="{{ $room->name }}" style="height: 250px", width="100%">
                                    <small class="position-absolute start-0 top-100 translate-middle-y bg-primary text-white rounded py-1 px-3 ms-4">
                                        Rp {{ number_format($room->price, 0, ',', '.') }} / Night
                                    </small>
                                </div>
                                <div class="p-4 mt-2">
                                    <div class="d-flex justify-content-between mb-3">
                                        <h5 class="mb-0">{{ $room->name }}</h5>
                                        <div class="ps-2">
                                            @for ($i = 0; $i < 5; $i++)
                                                @if ($i < $room->rating)
                                                    <small class="fa fa-star text-primary"></small>
                                                @else
                                                    <small class="fa fa-star text-secondary"></small>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
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
                                    <div class="d-flex justify-content-between">
                                        <a class="btn btn-sm btn-primary rounded py-2 px-4" href="{{ route('room.show', $room->id) }}">View Detail</a>
                                        <a class="btn btn-sm btn-dark rounded py-2 px-4" href="{{ route('book.room', ['roomId' => $room->id]) }}">
                                            Book Now
                                        </a>
                                    </div>
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
        function showAllRooms() {
            document.querySelectorAll('.room-item').forEach(card => {
                card.style.display = 'block';
            });
        }

        function showRoomsByCategory(categoryId) {
            document.querySelectorAll('.room-item').forEach(card => {
                const cardCategory = card.getAttribute('data-category');
                if (categoryId === 'all' || cardCategory === categoryId.toString()) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>
