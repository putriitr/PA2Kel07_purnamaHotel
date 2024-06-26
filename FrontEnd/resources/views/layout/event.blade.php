<!DOCTYPE html>
<html lang="en">

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

        <!-- Announcements Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h1 class="mb-5">Announcements</h1>
                </div>
                <div class="row align-items-center justify-content-end" style="max-width: 400px;">
                    <div class="col">
                        <!-- Search input -->
                        <div class="input-group" style="margin-left:880px">
                            <input type="text" id="searchInput" class="form-control" placeholder="Search announcements...">
                            <button id="searchButton" class="btn btn-primary" type="button">Search</button>
                        </div>
                    </div>
                </div>
                <br>
                <!-- Buttons to filter announcements -->
                <div class="text-center">
                    <button class="btn btn-primary mb-3" onclick="showAllAnnouncements()">Show All</button>
                    <!-- Buttons to filter announcements by category -->
                    @foreach ($announcementCategories as $category)
                        <button class="btn btn-primary mb-3 ms-3" onclick="showAnnouncementsByCategory({{ $category->id }})">{{ $category->name }}</button>
                    @endforeach
                </div>
                <br><br>
                <div class="row g-5 align-items-center" id="announcementContainer">
                    @foreach ($announcements as $announcement)
                        <div class="col-lg-12 announcement mb-4" data-category="{{ $announcement->category_id }}">
                            <div class="row g-3 align-items-center">
                                <div class="col-md-4 text-center">
                                    <img class="img-fluid rounded wow zoomIn announcement-image" data-wow-delay="0.1s" src="{{ asset('images/announcement/' . $announcement->image) }}" alt="{{ $announcement->title }}">
                                </div>
                                <div class="col-md-8">
                                    <div>
                                        <h5 class="section-title ff-secondary text-start text-primary fw-normal mb-3 announcement-title" style="margin-top: 0;">{{ $announcement->title }}</h5>
                                        <p>{{ $announcement->content }}</p>
                                        <p class="text-muted">Updated at: {{ $announcement->updated_at->format('d M Y H:i:s') }}</p>
                                        <p class="text-muted">Created by: {{ $announcement->creator->name ?? 'Unknown' }}</p>
                                        <p class="text-muted">Updated by: {{ $announcement->updater->name ?? 'Unknown' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
        <!-- Announcements End -->

        <!-- Footer Start -->
        @include('partial.footer')
        <!-- Footer End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    @include('partial.js')

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.getElementById('searchInput');

            // Menambahkan event listener input ke elemen pencarian
            searchInput.addEventListener('input', function() {
                const searchTerm = searchInput.value.trim().toLowerCase();
                filterAnnouncements(searchTerm);
            });
        });

        function filterAnnouncements(searchTerm) {
            const announcements = document.querySelectorAll('#announcementContainer .col-lg-12');

            announcements.forEach(function(announcement) {
                const title = announcement.querySelector('.announcement-title').textContent.toLowerCase();
                const content = announcement.querySelector('p').textContent.toLowerCase();

                if (title.includes(searchTerm) || content.includes(searchTerm)) {
                    announcement.style.display = 'flex';
                } else {
                    announcement.style.display = 'none';
                }
            });
        }

        function showAllAnnouncements() {
            document.querySelectorAll('#announcementContainer .col-lg-12').forEach(function (el) {
                el.style.display = 'flex';
            });
        }

        function showAnnouncementsByCategory(categoryId) {
            document.querySelectorAll('#announcementContainer .col-lg-12').forEach(function (el) {
                el.style.display = 'none';
            });

            document.querySelectorAll('#announcementContainer .col-lg-12').forEach(function (el) {
                if (el.dataset.category == categoryId) {
                    el.style.display = 'flex';
                }
            });
        }
    </script>

</body>

</html>
