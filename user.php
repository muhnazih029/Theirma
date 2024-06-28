<?php
include "config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
if ($data_user['role'] == 'guest') {
    echo '<script>alert("Account has not been approved by admin"); window.location.href="login.php";</script>';
    exit();
} else if ($data_user['role'] == 'user' || $data_user['role'] == 'admin') {
    $titleEvent = "My Events";
    $titleReport = "My Reports";
    if ($data_user['role'] == 'admin') {
        $titleEvent = "All Events";
        $titleReport = "All Reports";
    }
}
$reports = allReport($conn);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Theirma - Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/user.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .btn-home {
            background-color: rgb(34, 203, 183);
            /* Warna latar belakang */
            color: white;
            /* Warna teks */
            font-weight: bold;
            text-align: center;
            position: fixed;
            top: 15px;
            right: 15px;
            z-index: 1000;
            /* Pastikan di atas elemen lain */
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease;
            text-decoration: none;
            /* Hapus garis bawah */
        }

        .btn-home:hover {
            background-color: #1d9a85;
        }

        .event-image {
            cursor: pointer;
        }

        .modal-header .modal-title {
            margin-right: auto;
        }

        .modal-header .close {
            margin-left: 20px;
            /* Adjust the margin as needed */
        }
    </style>
</head>

<body>
    <button class="sidebar-toggle">&#9776;</button>
    <div class="d-flex">
        <div class="d-flex flex-column p-3 sidebar">
            <a href="user.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <span class="fs-3">My Profile</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="#" class="nav-link active" aria-current="page" onclick="showContent('home')">
                        Profile
                    </a>
                </li>
                <?php if ($data_user['role'] == 'admin') : ?>
                    <li>
                        <a href="#" class="nav-link" onclick="showContent('dashboard')">
                            Dashboard
                        </a>
                    </li>
                <?php endif; ?>
                <li>
                    <a href="#" class="nav-link" onclick="showContent('orders')">
                        My Events
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link" onclick="showContent('products')">
                        My Reports
                    </a>
                </li>
                <li>
                    <a href="create.php" class="nav-link" onclick="showContent('customers')">
                        Create Event
                    </a>
                </li>
            </ul>
            <a href="index.php" class="btn btn-home">Home</a>
        </div>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 mb-5">
                    <div id="home" class="content-section mt-4">
                        <div class="card">
                            <div class="card-header" style="background-color: rgb(28, 165, 149); color: white">
                                User Profile
                            </div>
                            <div class="card-body">
                                <!-- User Details -->
                                <h5 class="card-title">User Details</h5>
                                <p class="card-text">Username: <?= $data_user['username'] ?></p>
                                <p class="card-text">Role: <?= $data_user['role'] ?></p>
                            </div>
                        </div>
                    </div>

                    <?php if ($data_user['role'] == 'admin') : ?>
                        <div id="dashboard" class="content-section mt-4" style="display: none;">
                            <div class="card">
                                <div class="card-header" style="background-color: rgb(28, 165, 149); color: white">
                                    All Users
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Username</th>
                                                    <th>Role</th>
                                                    <th>Document</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $users = allUser($conn);
                                                if (!empty($users)) : ?>
                                                    <?php foreach ($users as $index => $user) : ?>
                                                        <tr>
                                                            <td><?= $index + 1; ?></td>
                                                            <td><?= $user['username']; ?></td>
                                                            <td><?= $user['role']; ?></td>
                                                            <td>
                                                                <img src="data:image/jpeg;base64,<?= base64_encode($user['document']) ?>" class="event-image" alt="User Image" data-user-image="data:image/jpeg;base64,<?= base64_encode($user['document']) ?>" data-toggle="modal" data-target="#documentUser">
                                                            </td>
                                                            <td>
                                                                <div class="btn-group" role="group" aria-label="User Actions">
                                                                    <?php if ($user['role'] === 'guest') : ?>
                                                                        <button type="button" class="btn btn-primary" onclick="window.location.href='config.php?action=accept&id=<?= $user['id']; ?>'">Accept</button>
                                                                    <?php else : ?>
                                                                        <button type="button" class="btn btn-success" disabled>Accepted</button>
                                                                    <?php endif; ?>
                                                                    <button type="button" class="btn btn-danger" onclick="window.location.href='config.php?action=delete&id=<?= $user['id']; ?>'">Delete</button>
                                                                </div>

                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php else : ?>
                                                    <tr>
                                                        <td colspan="6">No users found.</td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div id="orders" class="content-section mt-4" style="display: none;">
                        <div class="card">
                            <div class="card-header" style="background-color: rgb(28, 165, 149); color: white">
                                <?php echo $titleEvent ?>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Location</< /th>
                                                <th>Time</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($data_user['role'] == 'admin') {
                                                $eventss = $allevents;
                                            } else {
                                                $eventss = detailEventForUser($conn, $_SESSION['user_id']);
                                            }
                                            if (!empty($eventss)) : ?>
                                                <?php foreach ($eventss as $index => $event) : ?>
                                                    <tr>
                                                        <td><?= $index + 1; ?></td>
                                                        <td><?= $event['nameEvent']; ?></td>
                                                        <td><?= $event['description']; ?></td>
                                                        <td><?= $event['location']; ?></td>
                                                        <td><?= $event['time']; ?></td>
                                                        <td><?= $event['status']; ?></td>
                                                        <td>
                                                            <div class="btn-group" role="group" aria-label="Event Actions">
                                                                <button type="button" class="btn btn-primary" onclick="window.location.href='update.php?id=<?= $event['id']; ?>'">Update</button>
                                                                <button type="button" class="btn btn-danger" onclick="window.location.href='config.php?action=deleteEvent&id=<?= $event['id']; ?>'">Delete</button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <tr>
                                                    <td colspan="7">No events found.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="products" class="content-section mt-4" style="display: none;">
                        <div class="card">
                            <div class="card-header" style="background-color: rgb(28, 165, 149); color: white">
                                <?php echo $titleReport ?>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Event Image</th>
                                                <th>User ID</th>
                                                <th>Description</th>
                                                <th>Report Image</th>
                                                <th>Timestamp</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($reports as $index => $report) : ?>
                                                <?php if ($data_user['role'] == 'admin' || $report['user_id'] == $data_user['id']) : ?>
                                                    <?php $picture = EventHasReport($conn, $report['event_id']);
                                                    $pengguna = selectUser($conn, $report['user_id']) ?>
                                                    <tr>
                                                        <td><?= $index + 1; ?></td>
                                                        <td>
                                                            <img src="data:image/jpeg;base64,<?= base64_encode($picture['picture']) ?>" class="event-image" alt="Event Image" data-event-image="data:image/jpeg;base64,<?= base64_encode($picture['picture']) ?>" data-toggle="modal" data-target="#eventImageModal">
                                                        </td>
                                                        <td><?= $pengguna['username']; ?></td>
                                                        <td><?= $report['report_description']; ?></td>
                                                        <td>
                                                            <img src="data:image/jpeg;base64,<?= base64_encode($report['pic']) ?>" class="event-image" alt="Report Image" data-report-image="data:image/jpeg;base64,<?= base64_encode($report['pic']) ?>" data-toggle="modal" data-target="#reportImageModal">
                                                        </td>
                                                        <td><?= $report['timestamp']; ?></td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- User Document  Modal -->
    <div class="modal fade" id="documentUser" tabindex="-1" role="dialog" aria-labelledby="documentUserModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title ms-3" id="documentUserModal">User Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img id="userDocument" src="" class="img-fluid" alt="User Image">
                </div>
            </div>
        </div>
    </div>
    <!-- Event Image Modal -->
    <div class="modal fade" id="eventImageModal" tabindex="-1" role="dialog" aria-labelledby="eventImageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title ms-3" id="eventImageModalLabel">Event Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img id="eventModalImage" src="" class="img-fluid" alt="Event Image">
                </div>
            </div>
        </div>
    </div>

    <!-- Report Image Modal -->
    <div class="modal fade" id="reportImageModal" tabindex="-1" role="dialog" aria-labelledby="reportImageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reportImageModalLabel">Report Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img id="reportModalImage" src="" class="img-fluid" alt="Report Image">
                </div>
            </div>
        </div>
    </div>

    <!-- Custom JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.querySelector('.sidebar');
            const toggleButton = document.querySelector('.sidebar-toggle');
            const mediaQuery = window.matchMedia('(max-width: 1326px)');

            function handleScreenResize(event) {
                if (event.matches) {
                    // Mobile view
                    sidebar.style.width = '0';
                    sidebar.style.marginLeft = '-250px';
                    toggleButton.style.display = 'block';
                } else {
                    // Desktop view
                    sidebar.style.width = '250px';
                    sidebar.style.marginLeft = '0';
                    toggleButton.style.display = 'none';
                }
            }

            // Check the screen size on load
            handleScreenResize(mediaQuery);

            // Listen for screen size changes
            mediaQuery.addEventListener('change', handleScreenResize);

            // Toggle sidebar visibility on mobile
            toggleButton.addEventListener('click', function() {
                if (sidebar.style.width === '0px' || sidebar.style.marginLeft === '-250px') {
                    sidebar.style.width = '250px';
                    sidebar.style.marginLeft = '0';
                    toggleButton.style.transform = 'translateX(250px)';
                } else {
                    sidebar.style.width = '0';
                    sidebar.style.marginLeft = '-250px';
                    toggleButton.style.transform = 'translateX(0)';
                }
            });

            // Function to toggle content sections
            window.showContent = function(sectionId) {
                const sections = document.querySelectorAll('.content-section');
                sections.forEach(section => {
                    if (section.id === sectionId) {
                        section.style.display = 'block';
                    } else {
                        section.style.display = 'none';
                    }
                });

                const navLinks = document.querySelectorAll('.nav-link');
                navLinks.forEach(link => {
                    if (link.getAttribute('onclick').includes(sectionId)) {
                        link.classList.add('active');
                    } else {
                        link.classList.remove('active');
                    }
                });
            }
        });
        $(document).ready(function() {
            $('img.event-image').on('click', function() {
                var imageSrc = $(this).data('user-image');
                $('#eventImageModal').find('.modal-body #userDocument').attr('src', imageSrc);
            });

            $('img.event-image').on('click', function() {
                var imageSrc = $(this).data('event-image');
                $('#eventImageModal').find('.modal-body #eventModalImage').attr('src', imageSrc);
            });

            $('img.report-image').on('click', function() {
                var imageSrc = $(this).data('report-image');
                $('#reportImageModal').find('.modal-body #reportModalImage').attr('src', imageSrc);
            });

            $('#eventImageModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var imageSrc = button.data('event-image');
                var modal = $(this);
                modal.find('.modal-body #eventModalImage').attr('src', imageSrc);
            });

            $('#reportImageModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var imageSrc = button.data('report-image');
                var modal = $(this);
                modal.find('.modal-body #reportModalImage').attr('src', imageSrc);
            });
            $('#documentUser').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var imageSrc = button.data('user-image');
                var modal = $(this);
                modal.find('.modal-body #userDocument').attr('src', imageSrc);
            });
        });
    </script>

</body>

</html>