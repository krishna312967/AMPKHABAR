<?php
include("database.php");

if(isset($_POST['news_id'])){

    $news_id = (int)$_POST['news_id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);

    $sql = "INSERT INTO comments (news_id, name, comment)
            VALUES ('$news_id', '$name', '$comment')";

    mysqli_query($conn, $sql);

    header("Location: news_details.php?id=".$news_id);
    exit();
}
?>