<?php

function connectToDatabase()
{
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

function registerUser($conn, $username, $password, $role = 'user', $document)
{
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO tb_user (username, password, role, document) VALUES ('$username', '$hashedPassword', '$role', '$document')";

    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
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
            return $row;
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

    $sql = "SELECT * FROM tb_event ORDER BY time ASC LIMIT $params";
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

    $sql = "UPDATE tb_event SET name = '$nameEvent', picture = '$pic', description = '$desc', location = '$location', time = '$time', status = '$status' WHERE id = '$event_id'";

    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        return false;
    }
}

function deleteEvent($conn, $event_id)
{
    $sql = "DELETE FROM tb_event WHERE id = $event_id";

    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
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
