<?php

function connectToDatabase()
{
    // $servername = "localhost";
    // $username = "id22244920_nazih";
    // $password = "DragonBallZ123*";
    // $dbname = "id22244920_db_theirma";
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db_theirma";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }

    return $conn;
}

function registerUser($conn, $username, $password, $document, $actor = 'user')
{
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO tb_user (username, password, role, document) VALUES ('$username', '$hashedPassword', '$actor', '$document')";
    // var_dump($sql, $actor);
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        return false;
    }
}

function acceptUser($conn, $id)
{
    $sql = "UPDATE tb_user SET role = 'user' WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        return false;
    }
}

function deleteUser($conn, $id)
{
    mysqli_begin_transaction($conn);

    try {
        $sqlDeleteReports = "DELETE FROM tb_report WHERE user_id = $id";
        if (!mysqli_query($conn, $sqlDeleteReports)) {
            throw new Exception("Error deleting reports: " . mysqli_error($conn));
        }

        $sqlDeleteEvents = "DELETE FROM tb_event WHERE user_id = $id";
        if (!mysqli_query($conn, $sqlDeleteEvents)) {
            throw new Exception("Error deleting events: " . mysqli_error($conn));
        }

        $sqlDeleteUser = "DELETE FROM tb_user WHERE id = $id";
        if (!mysqli_query($conn, $sqlDeleteUser)) {
            throw new Exception("Error deleting user: " . mysqli_error($conn));
        }

        mysqli_commit($conn);

        return true;
    } catch (Exception $e) {
        mysqli_rollback($conn);

        echo "Error: " . $e->getMessage();
        return false;
    }
}

function loginUser($conn, $username, $password)
{
    $sql = "SELECT * FROM tb_user WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            if ($row['role'] == 'guest') {
                echo '<script>alert("Account has not been approved by admin"); window.location.href="login.php"</script>';
            } else if ($row['role'] == 'user') {
                echo '<script>alert("Selamat Datang"); window.location.href="user.php"</script>';
            }
            return $row;
            exit();
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function detailUser($conn, $user_id)
{
    $data = array();
    if (isset($user_id)) {
        $sql = "SELECT * FROM tb_user WHERE id = '$user_id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $data['id'] = $row['id'];
        $data['username'] = $row['username'];
        $data['password'] = $row['password'];
        $data['document'] = $row['document'];
        $data['role'] = $row['role'];
        $data['password'] = $row['password'];
    }
    return $data;
}

function allEvent($conn, $params = 6)
{
    $data = array();

    $sql = "SELECT * FROM tb_event ORDER BY time DESC LIMIT $params";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $event = array(
                'id' => $row['id'],
                'user_id' => $row['user_id'],
                'nameEvent' => $row['name'],
                'pic' => $row['picture'],
                'description' => $row['description'],
                'location' => $row['location'],
                'time' => $row['time'],
                'status' => $row['status']
            );
            $data[] = $event;
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    return $data;
}

function createEvent($conn, $user_id, $nameEvent, $pic, $desc, $location, $time, $status)
{

    $sql = "INSERT INTO tb_event (user_id, name, picture, description, location, time, status) VALUES ('$user_id', '$nameEvent', '$pic', '$desc', '$location', '$time', '$status')";

    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        return false;
    }
}

function detailEventForUser($conn, $user_id)
{
    $data = array();

    $sql = "SELECT * FROM tb_event WHERE user_id = $user_id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $event = array(
                'id' => $row['id'],
                'nameEvent' => $row['name'],
                'description' => $row['description'],
                'pic' => $row['picture'],
                'location' => $row['location'],
                'time' => $row['time'],
                'status' => $row['status'],
                'user_id' => $row['user_id']
            );
            $data[] = $event;
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    return $data;
}

function detailEvent($conn, $event_id)
{
    $data = array();

    $sql = "SELECT * FROM tb_event WHERE id = $event_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $data['id'] = $row['id'];
    $data['nameEvent'] = $row['name'];
    $data['description'] = $row['description'];
    $data['pic'] = $row['picture'];
    $data['location'] = $row['location'];
    $data['time'] = $row['time'];
    $data['status'] = $row['status'];
    $data['user_id'] = $row['user_id'];

    return $data;
}
function updateEvent($conn, $event_id, $nameEvent, $pic, $desc, $location, $time, $status)
{
    if (!empty($pic)) {
        $sql = "UPDATE tb_event SET name = '$nameEvent', picture = '$pic', description = '$desc', location = '$location', time = '$time', status = '$status' WHERE id = $event_id";
    } else {
        $sql = "UPDATE tb_event SET name = '$nameEvent', description = '$desc', location = '$location', time = '$time', status = '$status' WHERE id = $event_id";
    }

    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        return false;
    }
}

function deleteEvent($conn, $event_id)
{
    mysqli_begin_transaction($conn);

    try {
        $sql_reports = "DELETE FROM tb_report WHERE event_id = $event_id";
        if (!mysqli_query($conn, $sql_reports)) {
            throw new Exception("Error deleting reports: " . mysqli_error($conn));
        }

        $sql_event = "DELETE FROM tb_event WHERE id = $event_id";
        if (!mysqli_query($conn, $sql_event)) {
            throw new Exception("Error deleting event: " . mysqli_error($conn));
        }

        mysqli_commit($conn);
        return true;
    } catch (Exception $e) {
        mysqli_rollback($conn);
        echo $e->getMessage();
        return false;
    }
}


function allUser($conn)
{
    $data = array();

    $sql = "SELECT * FROM tb_user ORDER BY id ASC";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $user = array(
                'id' => $row['id'],
                'username' => $row['username'],
                'role' => $row['role'],
                'password' => $row['password'],
                'document' => $row['document'],
            );
            $data[] = $user;
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    return $data;
}

function reportEvent($conn, $event_id, $user_id, $desc, $pic, $time)
{
    $sql = "INSERT INTO tb_report (event_id, user_id, report_description, report_picture, timestamp) VALUES ('$event_id', '$user_id', '$desc', '$pic', '$time')";

    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        return false;
    }
}

function allReport($conn)
{
    $data = array();

    $sql = "SELECT * FROM tb_report";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $event = array(
                'id' => $row['id'],
                'event_id' => $row['event_id'],
                'user_id' => $row['user_id'],
                'report_description' => $row['report_description'],
                'pic' => $row['report_picture'],
                'timestamp' => $row['timestamp'],
            );
            $data[] = $event;
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    return $data;
}

function selectUser($conn, $user_id)
{
    $sql = "SELECT * FROM tb_user WHERE id = $user_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row;
}

function EventHasReport($conn, $idEventReport)
{
    $sql = "SELECT picture FROM tb_event WHERE id = $idEventReport";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row;
}

function dataReport($conn, $idEventReport)
{
    $sql = "SELECT * FROM tb_report WHERE event_id = $idEventReport";
    $result = mysqli_query($conn, $sql);
    $rows = [];

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
    }

    return $rows;
}

function countReports($conn, $idEventReport)
{
    $sql = "SELECT COUNT(*) AS totalReports FROM tb_report WHERE event_id = $idEventReport";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['totalReports'];
}

function updateEventSold($conn, $idEvent)
{
    $sql = "UPDATE tb_event SET status = 'sold' WHERE id = $idEvent";
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        return false;
    }
}

function checkAndUpdateEventStatus($conn)
{
    $sql = "SELECT id, time FROM tb_event WHERE status != 'sold' AND time < NOW() - INTERVAL 1 HOUR";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        while ($event = mysqli_fetch_assoc($result)) {
            $idEvent = $event['id'];
            updateEventSold($conn, $idEvent);
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

function updateEventScam($conn, $event_id)
{
    $sql = "UPDATE tb_event SET status = 'scam' WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $event_id);
    if (mysqli_stmt_execute($stmt)) {
        return true;
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
        return false;
    }
}
function checkAndUpdateScamStatus($conn)
{
    $sql = "SELECT id FROM tb_event WHERE status != 'scam'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        while ($event = mysqli_fetch_assoc($result)) {
            $event_id = $_GET['id'];
            $report_count = countReports($conn, $event_id);
            if ($report_count > 5) {
                updateEventScam($conn, $event_id);
            }
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
