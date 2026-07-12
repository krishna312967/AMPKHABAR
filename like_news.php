<?php
include("database.php");

$id = (int)$_GET['id'];

mysqli_query($conn,"
UPDATE news
SET likes = likes + 1
WHERE id='$id'
");

header("Location: news_details.php?id=".$id);
exit();
?>