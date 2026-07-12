<?php
include("database.php");

if(isset($_GET['id'])){

    $id = $_GET['id'];

    mysqli_query($conn, "DELETE FROM categories WHERE id='$id'");

    header("Location: categories.php");
    exit();
}
?>