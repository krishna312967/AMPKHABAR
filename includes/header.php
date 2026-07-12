<?php
include("database.php");

$setting = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM settings LIMIT 1"));

$title = !empty($setting['meta_title']) ? $setting['meta_title'] : $setting['site_name'];
$description = !empty($setting['meta_description']) ? $setting['meta_description'] : "Latest News from Nepal and around the world.";
$keywords = !empty($setting['meta_keywords']) ? $setting['meta_keywords'] : "news, nepal news, breaking news";
$favicon = !empty($setting['favicon']) ? "uploads/".$setting['favicon'] : "assets/images/favicon.png";
?>
<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title><?php echo htmlspecialchars($title); ?></title>

<meta name="description" content="<?php echo htmlspecialchars($description); ?>">
<meta name="keywords" content="<?php echo htmlspecialchars($keywords); ?>">
<meta name="author" content="<?php echo htmlspecialchars($setting['site_name']); ?>">

<!-- Open Graph -->
<meta property="og:title" content="<?php echo htmlspecialchars($title); ?>">
<meta property="og:description" content="<?php echo htmlspecialchars($description); ?>">
<meta property="og:type" content="website">

<link rel="icon" href="<?php echo $favicon; ?>">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="assets/css/style.css">

</head>
<body>