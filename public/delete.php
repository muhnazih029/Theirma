<?php 

include 'config.php';

deleteEvent($conn, $_GET['id']);

header('Location: user.php');