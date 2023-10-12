<?php
session_start();


if (!isset($_SESSION['loggedin'])) {
    header('Location: ./views/login.php');
    exit();
} else {
    header('Location: ./views/personal-info.php');
    exit();
}
?>