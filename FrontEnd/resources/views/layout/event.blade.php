<head>
    @include('partial.head')
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
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Announcement</h1>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->

        <!-- About Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h1 class="mb-5">A N N O U N C E M E N T S</h1>
                </div>
                <!-- Button to show all announcements -->
                <div class="text-center">
                    <button class="btn btn-primary mb-3" onclick="showAllAnnouncements()">Show All</button>

                    <!-- Button to show announcements by category -->
                    @foreach ($announcementCategories as $category)
                        <button class="btn btn-primary mb-3 ms-3" onclick="showAnnouncementsByCategory({{ $category->id }})">{{ $category->name }}</button>
                    @endforeach
                </div>
                <div class="row g-5 align-items-center" id="announcementContainer">
                    @foreach ($announcements as $announcement)
                        <div class="col-lg-12 announcement mb-4" data-category="{{ $announcement->category_id }}">
                            <div class="row g-3 align-items-center">
                                <div class="col-md-4 text-center">
                                    <img class="img-fluid rounded wow zoomIn announcement-image" data-wow-delay="0.1s" src="{{ asset('images/announcement/' . $announcement->image) }}" alt="{{ $announcement->title }}">
                                </div>
                                <div class="col-md-8">
                                    <h5 class="section-title ff-secondary text-start text-primary fw-normal mb-3" style="margin-top: 0;">{{ $announcement->title }}</h5>
                                    <p>{{ $announcement->content }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- About End -->

        <!-- Footer Start -->
        @include('partial.footer')
        <!-- Footer End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    @include('partial.js')
</body>

<style>
    .announcement-image {
        max-width: 70%;
        width: auto;
        height: auto;
    }
</style>

<script>
    function showAllAnnouncements() {
        // Show all announcements
        document.querySelectorAll('#announcementContainer .col-lg-12').forEach(function (el) {
            el.style.display = 'flex';
        });
    }

    function showAnnouncementsByCategory(categoryId) {
        // Hide all announcements
        document.querySelectorAll('#announcementContainer .col-lg-12').forEach(function (el) {
            el.style.display = 'none';
        });

        // Show announcements based on category
        document.querySelectorAll('#announcementContainer .col-lg-12').forEach(function (el) {
            if (el.dataset.category == categoryId) {
                el.style.display = 'flex';
            }
        });
    }
</script>
