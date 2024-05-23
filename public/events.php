<!DOCTYPE html>
<html lang="en">
<?php include 'config.php' ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        /* Custom styles for this page */
        .event-container {
            padding: 50px 0;
        }

        .event-image {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .event-details {
            margin-top: 20px;
        }

        .event-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .event-description {
            font-size: 16px;
            color: #555;
            margin-bottom: 20px;
        }

        .event-info {
            font-size: 14px;
            color: #777;
        }
    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Theirma</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="events.php">Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container event-container">
        <div id="eventCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php foreach ($events as $index => $event) : ?>
                    <div class="carousel-item <?= ($index == 0) ? 'active' : ''; ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="data:image/png|jpg;base64,<?= base64_encode($event['pic']) ?>" class="event-image" alt="Event Image">
                            </div>
                            <div class="col-md-6">
                                <div class="event-details">
                                    <h2 class="event-title"><?= $event['nameEvent'] ?></h2>
                                    <p class="event-description"><?= $event['description'] ?></p>
                                    <div class="event-info">
                                        <p><strong>Time: </strong><?= $event['time'] ?></p>
                                        <p><strong>Location: </strong><?= $event['location'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <a class="carousel-control-prev" href="#eventCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon bg-primary" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#eventCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon bg-primary" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <?php
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $startIndex = ($page - 1) * 3;
    $displayedEvents = array_slice($events, $startIndex, 3);
    ?>
    <?php foreach ($displayedEvents as $event) : ?>
        <div class="container event-container">
            <div class="row">
                <div class="col-md-6">
                    <img src="data:image/png|jpg;base64,<?= base64_encode($event['pic']) ?>" class="event-image" alt="Event Image">
                </div>
                <div class="col-md-6">
                    <div class="event-details">
                        <h2 class="event-title"><?= $event['nameEvent'] ?></h2>
                        <p class="event-description"><?= $event['description'] ?></p>
                        <div class="event-info">
                            <p><strong>Time: </strong><?= $event['time'] ?></p>
                            <p><strong>Location: </strong><?= $event['location'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <!-- Pagination -->
        <nav aria-label="Event Pagination">
            <ul class="pagination justify-content-center mt-4">
                <?php if ($page > 1) : ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $page - 1 ?>">Previous</a>
                    </li>
                <?php endif; ?>
                <?php if (count($events) > $startIndex + 3) : ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $page + 1 ?>">Next</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>