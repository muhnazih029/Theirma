<?php

include "functions.php";
$conn = connectToDatabase();
$events = allEvent($conn);

if (isset($_SESSION['user_id'])) {
    $data_user = detailUser($conn, $_SESSION['user_id']);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $role = 'user';
    $document = $_POST["document"];

    if (registerUser($conn, $username, $password, $role, $document)) {
        header("Location: login.php");
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $sql = "SELECT id FROM tb_user WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        $_SESSION['user_id'] = $id;

        if (loginUser($conn, $username, $password)) {
            header("Location: index.php");
            exit();
        } else {
            echo '<script>alert("Username or password was wrong"); window.location.href="login.php"</script>';
        }
    } else {
        header("Location: login.php");
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addEvent'])) {
    $nameEvent = $_POST["nameEvent"];
    $pic = addslashes(file_get_contents($_FILES['eventImage']['tmp_name']));
    $desc = $_POST["eventDescription"];
    $location = $_POST["eventLocation"];
    $time = $_POST["eventTime"];
    $status = 'available';
    $user_id = $_SESSION['user_id'];

    $addEvent = createEvent($conn, $user_id, $nameEvent, $pic, $desc, $location, $time, $status);

    if ($addEvent) {
        echo '<script>alert("Event Berhasil Ditambahkan"); window.location.href="user.php"</script>';
    } else {
        echo '<script>alert("Error: Gagal Menambahkan Event"); window.location.href="user.php"</script>';
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateEvent'])) {
    $nameEvent = $_POST["nameEvent"];
    $pic = addslashes(file_get_contents($_FILES['eventImage']['tmp_name']));
    $desc = $_POST["eventDescription"];
    $location = $_POST["eventLocation"];
    $time = $_POST["eventTime"];
    $status = $_POST["eventStatus"];
    $event_id = $_GET['id'];

    if (updateEvent($conn, $event_id, $nameEvent, $pic, $desc, $location, $time, $status)) {
        echo '<script>alert("Event Berhasil Diperbarui"); window.location.href="user.php"</script>';
    } else {
        echo '<script>alert("Error: Gagal Memperbarui Event"); window.location.href="user.php"</script>';
    }
}

try {
    if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['reportEvent'])) {
        $event_id = $_GET['id'];
        $user_id = $_SESSION['user_id'];
        $desc = $_POST['desc'];
        $pic = addslashes(file_get_contents($_FILES['eventImage']['tmp_name']));
        $time = date('Y-m-d H:i:s');

        if (reportEvent($conn, $event_id, $user_id, $desc, $pic, $time)) {
            echo '<script>alert("Event Berhasil Dilaporkan"); window.location.href="index.php"</script>';
        } else {
            echo '<script>alert("Error: Report Sudah Pernah Dilakukan"); window.location.href="index.php"</script>';
        }
    }
} catch (mysqli_sql_exception $e) {
    echo '<script>alert("Error: Report Sudah Pernah Dilakukan"); window.location.href="index.php";</script>';
}
