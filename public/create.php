<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event - Theirma</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mb-5">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Create Event</h2>
                        <form action="config.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="nameEvent">Event Name</label>
                                <input type="text" class="form-control" id="nameEvent" name="nameEvent" required>
                            </div>
                            <div class="form-group">
                                <label for="eventDescription">Event Description</label>
                                <textarea class="form-control" id="eventDescription" name="eventDescription" rows="3" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="eventLocation">Location</label>
                                <input type="text" class="form-control" id="eventLocation" name="eventLocation" required>
                            </div>
                            <div class="form-group">
                                <label for="eventImage">Event Image</label>
                                <input type="file" class="form-control-file" id="eventImage" name="eventImage">
                            </div>
                            <div class="form-group">
                                <label for="eventTime">Time</label>
                                <input type="datetime-local" class="form-control" id="eventTime" name="eventTime" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block" name="addEvent">Create Event</button>
                            <a href="user.php" class="btn btn-secondary btn-block">Back to Profile</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>