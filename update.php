<?php
include "config.php";

if (isset($_GET['id'])) {
    $event = detailEvent($conn, $_GET['id']);

    if ($event && $event['id'] == $_GET['id']) {
        $nameEvent = $event['nameEvent'];
        $description = $event['description'];
        $pic = $event['pic'];
        $location = $event['location'];
        $time = $event['time'];
        $status = $event['status'];
    } else {
        header("Location: user.php");
        exit();
    }
} else {
    header("Location: user.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Event</title>
    <!-- Sertakan Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: none;
            border-radius: 10px;
        }

        .card-title {
            background-color: rgb(34, 203, 183);
            color: white;
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

        .image-upload input[type="file"] {
            display: none;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mb-5">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4 py-2">Update Event</h2>
                        <!-- Form untuk pembaruan event -->
                        <form id="updateEventForm" action="config.php?id=<?= $_GET['id'] ?>" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
                            <div class="form-group">
                                <label for="nameEvent">Event Name</label>
                                <input type="text" class="form-control" id="nameEvent" name="nameEvent" value="<?php echo $nameEvent; ?>" placeholder="Masukkan nama event anda..." required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="eventDescription" rows="3" placeholder="Masukkan deskripsi dari event anda..." required><?php echo $description; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text" class="form-control" id="location" name="eventLocation" value="<?php echo $location; ?>" placeholder="Masukkan lokasi anda dengan link gmaps..." required>
                            </div>
                            <div class="form-group">
                                <label for="eventImage">Event Image</label>
                                <div class="image-container">
                                    <div class="image-preview">
                                        <img id="currentEventImage" src="data:image/jpeg;base64,<?= base64_encode($pic) ?>" alt="Current Event Image">
                                    </div>
                                    <div class="image-upload">
                                        <label for="eventImage" class="btn btn-secondary">Upload New Image</label>
                                        <input type="file" class="form-control-file" id="eventImage" name="eventImage">
                                        <small class="form-text text-muted">Masukkan pamflet atau gambar relevan...</small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="time">Time</label>
                                <input type="datetime-local" class="form-control" id="time" name="eventTime" value="<?php echo date('Y-m-d\TH:i', strtotime($time)); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="custom-select" id="status" name="eventStatus" required>
                                    <option value="available" <?php if ($status == 'available') echo 'selected'; ?>>Available</option>
                                    <option value="sold" <?php if ($status == 'sold') echo 'selected'; ?>>Sold</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block" name="updateEvent">Update Event</button>
                            <a href="user.php" class="btn btn-secondary btn-block">Back to Profile</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#eventImage').on('change', function() {
                var file = this.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#currentEventImage').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
</body>

</html>