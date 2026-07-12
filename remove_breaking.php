<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include("database.php");

$id = $_GET['id'];

mysqli_query($conn,"
UPDATE news
SET breaking = 0
WHERE id = '$id'
");

header("Location: news.php");
exit();
?>