<!DOCTYPE html>
<html lang="en">

<?php
include "config.php";
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
            color: white;
            position: fixed;
        }

        .sidebar .nav-link {
            color: white;
        }

        .sidebar .nav-link.active {
            background-color: #495057;
        }

        .card-header {
            background-color: #343a40;
            color: white;
        }

        .table-responsive {
            margin-top: 20px;
        }

        .event-image {
            max-width: 100px;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <div class="d-flex flex-column p-3 sidebar">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <span class="fs-4">Sidebar</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="#" class="nav-link active" aria-current="page" onclick="showContent('home')">
                        Profile
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link" onclick="showContent('dashboard')">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link" onclick="showContent('orders')">
                        My Events
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link" onclick="showContent('products')">
                        My Report
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link" onclick="showContent('customers')">
                        Create Event
                    </a>
                </li>
            </ul>
            <hr>
            <div class="dropdown" id="dropdown">
                <a href="index.php" class="mt-3 btn" style="background-color: rgb(34, 203, 183);">Back To Home</a>
            </div>
        </div>

        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8 mb-5">
                    <div id="home" class="content-section">
                        <div class="card">
                            <div class="card-header">
                                User Profile
                            </div>
                            <div class="card-body">
                                <!-- User Details -->
                                <h5 class="card-title">User Details</h5>
                                <p class="card-text">Username: <?= $data_user['username'] ?></p>
                            </div>
                        </div>
                    </div>

                    <div id="dashboard" class="content-section" style="display: none;">
                        <div class="card">
                            <div class="card-header">
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
                                                <th>Password</th>
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
                                                        <td><?= $user['password']; ?></td>
                                                        <td><?= $user['document']; ?></td>
                                                        <td>
                                                            <div class="btn-group" role="group" aria-label="User Actions">
                                                                <!-- Update Button -->
                                                                <button type="button" class="btn btn-primary" onclick="window.location.href='update.php?id=<?= $user['id']; ?>'">Accept</button>
                                                                <!-- Delete Button -->
                                                                <button type="button" class="btn btn-danger" onclick="window.location.href='delete.php?id=<?= $user['id']; ?>'">Delete</button>
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

                    <div id="orders" class="content-section" style="display: none;">
                        <div class="card">
                            <div class="card-header">
                                All Events From User
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Location</th>
                                                <th>Time</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $eventss = detailEventForUser($conn, $_SESSION['user_id']);
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
                                                                <!-- Update Button -->
                                                                <button type="button" class="btn btn-primary" onclick="window.location.href='update.php?id=<?= $event['id']; ?>'">Update</button>
                                                                <!-- Delete Button -->
                                                                <button type="button" class="btn btn-danger" onclick="window.location.href='delete.php?id=<?= $event['id']; ?>'">Delete</button>
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

                    <div id="products" class="content-section" style="display: none;">
                        <div class="card">
                            <div class="card-header">
                                All Reports
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Event ID</th>
                                                <th>User ID</th>
                                                <th>Description</th>
                                                <th>Picture</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $reports = allReport($conn);
                                            if (!empty($reports)) : ?>
                                                <?php foreach ($reports as $index => $report) : ?>
                                                    <tr>
                                                        <td><?= $index + 1; ?></td>
                                                        <td><?= $report['event_id']; ?></td>
                                                        <td><?= $report['user_id']; ?></td>
                                                        <td><?= $report['report_description']; ?></td>
                                                        <td><img src="data:image/jpeg;base64,<?= base64_encode($report['pic']) ?>" class="event-image" alt="Event Image"></td>
                                                        <td><?= $report['timestamp']; ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <tr>
                                                    <td colspan="6">No reports found.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="customers" class="content-section" style="display: none;">
                        <!-- Add content for the Customers section here -->
                    </div>

                    <a href="create.php" class="mt-3 btn btn-danger">Create Events</a>
                    <a href="index.php" class="mt-3 btn btn-primary">Back To Home</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
        <!-- Add your create modal content here -->
    </div>

    <!-- Update Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <!-- Add your update modal content here -->
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <!-- Add your delete modal content here -->
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBgOgpaonN1+lLN1p9UvYjH4E6k8ue7+0mE3jf/z2+jD33I2" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-pLWO7Y2g9N5z4Hv0hPMAbuQq3+8jRohdFq5GlJZy4RqiRSRRs6ZIR5BR2l/7xXPC" crossorigin="anonymous"></script>

    <!-- Custom JS -->
    <script>
        function showContent(sectionId) {
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
    </script>
</body>

</html>