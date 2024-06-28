<?php include 'config.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Theirma - Events</title>
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
    <link href="./assets/css/style.css" rel="stylesheet">

    <!-- Fancybox CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center">
        <div class="container d-flex align-items-center">

            <div class="logo me-auto">
                <h1><a href="index.php">Theirma</a></h1>
                <!-- <a href="index.html"><img src="assets/img/about.png" alt="" class="img-fluid"></a>-->
            </div>
            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    <li><a class="nav-link scrollto active" href="index.php#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="index.php#about">About</a></li>
                    <li><a class="nav-link scrollto" href="index.php#events">Events</a></li>
                    <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                    <?php
                    if (isset($_SESSION['user_id'])) {
                    ?>
                        <li class="dropdown">
                            <a href="#"><span>Profile</span> <i class="bi bi-chevron-down"></i></a>
                            <ul>
                                <li><a href="user.php">Edit Profile</a></li>
                                <li><a href="logout.php">Logout</a></li>
                            </ul>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li><a class="nav-link" href="login.php"><span class="login">Login</span></a></li>
                    <?php
                    }
                    ?>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
        </div>
    </header><!-- End Header -->
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2>List Events</h2>
                <ol>
                    <li><a href="index.php">Home</a></li>
                    <li>List Events</li>
                </ol>
            </div>
        </div>
    </section><!-- End Breadcrumbs -->

    <?php
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $startIndex = ($page - 1) * 3;
    $displayedEvents = array_slice($allevents, $startIndex, 3);
    ?>
    <div class="container event-container">
        <?php foreach ($displayedEvents as $event) : ?>
            <div class="row mb-5">
                <div class="col-md-6 pb-3">
                    <img src="data:image/png|jpg;base64,<?= base64_encode($event['pic']) ?>" class="img-fluid rounded event-image" alt="Event Image">
                </div>
                <div class="col-md-6">
                    <div class="event-details">
                        <?php $user = selectUser($conn, $event['user_id']) ?>
                        <a style="font-size: 2rem; font-weight: 600;" href="detailEvent.php?id=<?= $event['id'] ?>"><?= $event['nameEvent'] ?></a>
                        <p><strong>Penyelenggara</strong>: <?= $user['username'] ?></p>
                        <p class="event-description"><?= $event['description'] ?></p>
                        <div class="event-info">
                            <p><strong>Time: </strong><?= $event['time'] ?></p>
                            <p><strong>Location: </strong><?= $event['location'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Pagination -->
    <div>
        <nav aria-label="Event Pagination">
            <ul class="pagination justify-content-center mt-4">
                <?php if ($page > 1) : ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $page - 1 ?>">Previous</a>
                    </li>
                <?php endif; ?>
                <?php if (count($allevents) > $startIndex + 3) : ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $page + 1 ?>">Next</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>

    <!-- ======= Footer ======= -->
    <footer style="background-color: rgba(29, 161, 146, 1)" class="text-white text-center py-3">
        <div class="container">
            <p>&copy; 2024 Theirma. All rights reserved.</p>
        </div>
    </footer><!-- End Footer -->


</body>

</html>