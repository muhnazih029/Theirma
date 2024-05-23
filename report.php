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
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mb-5">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Report Event</h2>
                        <!-- Form untuk pembaruan event -->
                        <form action="config.php?id=<?= $_GET['id'] ?>" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
                            <div class="form-group">
                                <label for="nameEvent">Event Name</label>
                                <input type="text" class="form-control" id="nameEvent" name="nameEvent" value="<?php echo $nameEvent; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="desc" rows="3" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="eventImage">Image</label>
                                <input type="file" class="form-control-file" id="eventImage" name="eventImage">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block" name="reportEvent">Report Event</button>
                            <a href="index.php" class="btn btn-secondary btn-block">Back to Home</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sertakan Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>