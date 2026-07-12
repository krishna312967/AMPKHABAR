<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

include("database.php");

$id = (int)$_GET['id'];

mysqli_query($conn,"DELETE FROM comments WHERE id='$id'");

header("Location: comments.php");
exit();
?>