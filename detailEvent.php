<?php
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Event Detail - Theirma</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="./assets/img/favicon.png" rel="icon">
    <link href="./assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="./assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="./assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="./assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="./assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Template Main CSS File -->
    <link href="./assets/css/style.css" rel="stylesheet">
    <style>
        .modal-header {
            background-color: rgb(34, 203, 183);
            color: #fff;
        }

        .modal-title {
            font-weight: bold;
            margin-right: auto;
        }

        .modal-body {
            padding: 2rem;
        }

        .form-control,
        .form-control-file {
            border-radius: 5px;
            border: 1px solid #ddd;
            padding: 0.75rem;
            font-size: 1rem;
        }

        .form-group label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: rgb(34, 203, 183);
            border: none;
            font-size: 1.2rem;
            font-weight: bold;
            padding: 0.75rem;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-primary:hover {
            background-color: rgb(28, 165, 149);
            transform: scale(1.05);
        }

        .btn-primary:active {
            transform: scale(0.95);
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
            font-size: 1.2rem;
            font-weight: bold;
            padding: 0.75rem;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            transform: scale(1.05);
        }

        .btn-secondary:active {
            transform: scale(0.95);
        }

        p a {
            color: rgb(34, 203, 183);
            text-decoration: none;
            font-weight: bold;
        }

        p a:hover {
            text-decoration: underline;
        }

        .form-control:focus,
        .form-control-file:focus {
            border-color: rgb(34, 203, 183);
            box-shadow: 0 0 5px rgba(34, 203, 183, 0.5);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .image-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .image-preview {
            width: 200px;
            margin-bottom: 10px;
        }

        .image-preview img {
            max-width: 100%;
            height: auto;
        }

        .image-upload label {
            width: 100%;
            text-align: center;
            padding: 10px;
            cursor: pointer;
            color: #fff;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .image-upload label:hover {
            background-color: rgb(28, 165, 149);
        }
    </style>
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center">
        <div class="container d-flex align-items-center">
            <div class="logo me-auto">
                <h1><a href="index.php">Theirma</a></h1>
            </div>
            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    <li><a class="nav-link scrollto active" href="index.php#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="index.php#about">About</a></li>
                    <li><a class="nav-link scrollto" href="index.php#events">Events</a></li>
                    <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                    <?php if (isset($_SESSION['user_id'])) : ?>
                        <li class="dropdown">
                            <a href="#"><span>Profile</span> <i class="bi bi-chevron-down"></i></a>
                            <ul>
                                <li><a href="user.php">Edit Profile</a></li>
                                <li><a href="logout.php">Logout</a></li>
                            </ul>
                        </li>
                    <?php else : ?>
                        <li><a class="nav-link" href="login.php"><span class="login">Login</span></a></li>
                    <?php endif; ?>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
        </div>
    </header><!-- End Header -->

    <main id="main">
        <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h3>Event Details</h3>
                    <ol>
                        <li><a href="index.php#events">Home</a></li>
                        <li>Event Details</li>
                    </ol>
                </div>
            </div>
        </section><!-- End Breadcrumbs -->

        <!-- ======= Event Details Section ======= -->
        <section id="events-details" class="events-details">
            <div class="container">
                <?php
                // Ambil detail event
                $eventId = mysqli_real_escape_string($conn, $_GET['id']);
                $event = detailEvent($conn, $eventId);
                $totalReports = countReports($conn, $eventId);
                $reports = dataReport($conn, $eventId);
                ?>

                <div class="row gy-4">
                    <div class="col-lg-8">
                        <div class="portfolio-details-slider swiper">
                            <div class="swiper-wrapper align-items-center">
                                <div class="swiper-slide">
                                    <img src="data:image/png|jpg;base64,<?= base64_encode($event['pic']) ?>" alt="Event Image" width="80%">
                                </div>
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="events-info">
                            <h3>Event Information</h3>
                            <ul>
                                <?php $user = selectUser($conn, $event['user_id']); ?>
                                <li><strong>Penyelenggara</strong>: <?= $user['username'] ?></li>
                                <li><strong>Nama Event</strong>: <?= $event['nameEvent'] ?></li>
                                <li><strong>Project date</strong>: <?= $event['time'] ?></li>
                                <li><strong>Project Location</strong>: <a href="<?= $event['location'] ?>"><?= $event['location'] ?></a></li>
                                <li><strong>Status</strong>: <?= $event['status'] ?></li>
                            </ul>
                            <!-- Tombol Report -->
                            <button id="reportBtn" class="btn btn-warning mt-3" data-toggle="modal" data-target="#reportModal">Report</button>
                            <!-- Menampilkan Jumlah Report -->
                            <p>Jumlah Report: <?= $totalReports ?></p>
                        </div>
                        <div class="events-description">
                            <h2>Description</h2>
                            <p><?= $event['description'] ?></p>
                        </div>
                    </div>
                </div>

                <!-- HTML untuk menampilkan semua report -->
                <div class="container mt-5">
                    <h3>Semua Report</h3>
                    <?php if (!empty($reports)) : ?>
                        <div class="row">
                            <?php foreach ($reports as $report) : ?>
                                <div class="col-md-4 mb-4">
                                    <div class="card">
                                        <img src="data:image/jpeg;base64,<?= base64_encode($report['report_picture']) ?>" class="card-img-top" alt="Report Image">
                                        <div class="card-body">
                                            <h5 class="card-text"><?= $report['report_description'] ?></h5>
                                            <p class="card-text"><small class="text-muted">Reported at <?= $report['timestamp'] ?></small></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                        </div>
                    <?php else : ?>
                        <p>Tidak ada report untuk event ini.</p>
                    <?php endif; ?>
                </div>
            </div>
        </section><!-- End Portfolio Details Section -->
    </main><!-- End #main -->

    <!-- Modal Report -->
    <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reportModalLabel">Report Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form Report -->
                    <form id="reportEventForm" action="config.php?id=<?= $_GET['id'] ?>" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="event_id" value="<?= $_GET['id']; ?>">
                        <div class="form-group">
                            <label for="reportImage">Report Image</label>
                            <div class="image-container">
                                <div class="image-preview">
                                    <img id="currentReportImage" src="assets/img/pic.jpeg" alt="Default Event Image" width="300">
                                </div>
                                <div class="image-upload">
                                    <label for="reportImage" class="btn btn-secondary">Upload New Image</label>
                                    <input type="file" class="form-control-file" id="reportImage" name="reportImage" accept="image/*" style="display: none;">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="desc" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" name="reportEvent">Report Event</button>
                        <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- ======= Footer ======= -->
    <footer style="background-color: rgba(29, 161, 146, 1)" class="text-white text-center py-3">
        <div class="container">
            <p>&copy; 2024 Theirma. All rights reserved.</p>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="./assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="./assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="./assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="./assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="./assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="./assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="./assets/js/main.js"></script>

    <!-- Tambahkan JavaScript untuk konfirmasi Report -->
    <script>
        document.getElementById('reportBtn').addEventListener('click', function() {
            const eventId = new URLSearchParams(window.location.search).get('id');
            document.getElementById('eventId').value = eventId;
        });
        $(document).ready(function() {
            $('#reportImage').on('change', function() {
                var file = this.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#currentReportImage').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>

</body>

</html>