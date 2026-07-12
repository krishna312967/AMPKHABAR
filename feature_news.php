<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

include("database.php");

$id = (int)$_GET['id'];

// सबै News को featured = 0
mysqli_query($conn,"UPDATE news SET featured=0");

// चयन गरिएको News लाई featured = 1
mysqli_query($conn,"UPDATE news SET featured=1 WHERE id='$id'");

header("Location: news.php");
exit();
?>