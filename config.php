<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
include "functions.php";
$conn = connectToDatabase();
$events = allEvent($conn);
$allevents = allEvent($conn, 50);

checkAndUpdateEventStatus($conn);

if (isset($_SESSION['user_id'])) {
    $data_user = detailUser($conn, $_SESSION['user_id']);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $role = 'guest';
    $document = addslashes(file_get_contents($_FILES['document']['tmp_name']));

    $sql = "SELECT * FROM tb_user WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo '<script>alert("Username already exists. Please choose a different username."); window.history.back();</script>';
    } else {
        if (registerUser($conn, $username, $password, $document, $role)) {
            header("Location: login.php");
            exit();
        } else {
            echo '<script>alert("Registration failed. Please try again."); window.history.back();</script>';
        }
    }
}

if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $action = $_GET['action'];

    if ($action == 'accept' && acceptUser($conn, $id)) {
        echo '<script>alert("Accept berhasil dilakukan"); window.location.href="user.php"</script>';
        exit();
    } elseif ($action == 'delete' && deleteUser($conn, $id)) {
        echo '<script>alert("Delete Berhasil Dilakukan"); window.location.href="user.php"</script>';
        exit();
    } elseif ($action == 'deleteEvent' && deleteEvent($conn, $id)) {
        echo '<script>alert("Delete event berhasil dilakukan"); window.location.href="user.php"</script>';
        exit();
    } else {
        echo '<script>alert("Action failed"); window.location.href="user.php"</script>';
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $sql = "SELECT * FROM tb_user WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        $role = $row['role'];
        $_SESSION['user_id'] = $id;

        if (loginUser($conn, $username, $password)) {
            header("Location: user.php");
            exit();
        } else {
            echo '<script>alert("Username or password is incorrect"); window.location.href="login.php"</script>';
        }
    } else {
        echo '<script>alert("Account is not registered"); window.location.href="login.php"</script>';
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
    $desc = $_POST["eventDescription"];
    $location = $_POST["eventLocation"];
    $time = $_POST["eventTime"];
    $status = $_POST["eventStatus"];
    $event_id = $_GET['id'];

    if (isset($_FILES['eventImage']) && $_FILES['eventImage']['size'] > 0) {
    } else {
        if (updateEvent($conn, $event_id, $nameEvent, $pic, $desc, $location, $time, $status)) {
            echo '<script>alert("Event Berhasil Diperbarui"); window.location.href="user.php"</script>';
        } else {
            echo '<script>alert("Error: Gagal Memperbarui Event"); window.location.href="user.php"</script>';
        }
    }
}

try {
    if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['reportEvent'])) {
        $event_id = $_GET['id'];
        $user_id = $_SESSION['user_id'];
        $desc = $_POST['desc'];
        $pic = addslashes(file_get_contents($_FILES['reportImage']['tmp_name']));
        $time = date('Y-m-d H:i:s');

        if (reportEvent($conn, $event_id, $user_id, $desc, $pic, $time)) {
            checkAndUpdateScamStatus($conn);
            echo '<script>alert("Event Berhasil Dilaporkan"); window.location.href="detailEvent.php?id=' . $event_id . '";</script>';
        } else {
            echo '<script>alert("Error: Report Sudah Pernah Dilakukan"); window.location.href="detailEvent.php?id=' . $event_id . '";</script>';
        }
    }
} catch (mysqli_sql_exception $e) {
    echo '<script>alert("Error: ' . $e->getMessage() . '"); window.location.href="index.php";</script>';
}
