<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include("database.php");

// Dashboard Statistics
$totalNews = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM news"))['total'];
$totalCategories = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM categories"))['total'];
$totalFeatured = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM news WHERE featured=1"))['total'];

$totalViews = mysqli_fetch_assoc(mysqli_query($conn,"SELECT SUM(views) AS total FROM news"))['total'];
if($totalViews==NULL){ $totalViews=0; }

$totalComments = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM comments"))['total'];

// Chart Data
$chart=mysqli_query($conn,"
SELECT categories.category_name,
COUNT(news.id) AS total
FROM categories
LEFT JOIN news
ON categories.id=news.category_id
GROUP BY categories.id
");

$labels=[];
$data=[];

while($c=mysqli_fetch_assoc($chart)){
    $labels[]=$c['category_name'];
    $data[]=$c['total'];
}
?>
<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">

<title>AMPKHABAR Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-danger">

<div class="container-fluid">

<span class="navbar-brand fw-bold">
AMPKHABAR ADMIN
</span>

<div>

<span class="text-white me-3">

Welcome,
<?php echo $_SESSION['admin']; ?>

</span>

<a href="logout.php" class="btn btn-light btn-sm">
Logout
</a>

</div>

</div>

</nav>

<div class="container mt-4">

<div class="row">

<div class="col-md-3 mb-3">

<div class="card bg-primary text-white shadow">

<div class="card-body">

<h5>Total News</h5>

<h2><?php echo $totalNews; ?></h2>

</div>

</div>

</div>

<div class="col-md-3 mb-3">

<div class="card bg-success text-white shadow">

<div class="card-body">

<h5>Total Categories</h5>

<h2><?php echo $totalCategories; ?></h2>

</div>

</div>

</div>
<div class="col-md-3 mb-3">

<div class="card bg-warning text-white shadow">

<div class="card-body">

<h5>Featured News</h5>

<h2><?php echo $totalFeatured; ?></h2>

</div>

</div>

</div>

<div class="col-md-3 mb-3">

<div class="card bg-info text-white shadow">

<div class="card-body">

<h5>Total Views</h5>

<h2><?php echo $totalViews; ?></h2>

</div>

</div>

</div>

<div class="col-md-3 mb-3">

<div class="card bg-secondary text-white shadow">

<div class="card-body">

<h5>Total Comments</h5>

<h2><?php echo $totalComments; ?></h2>

</div>

</div>

</div>

</div>

<div class="card shadow mb-4">

<div class="card-header bg-dark text-white">
Quick Menu
</div>

<div class="card-body">

<a href="categories.php" class="btn btn-primary me-2 mb-2">Manage Categories</a>

<a href="news.php" class="btn btn-success me-2 mb-2">Manage News</a>

<a href="comments.php" class="btn btn-warning me-2 mb-2">Manage Comments</a>

<a href="contacts.php" class="btn btn-info me-2 mb-2">Manage Contacts</a>

<a href="breaking_news.php" class="btn btn-info me-2 mb-2">Breaking news</a>

<a href="ads.php" class="btn btn-warning me-2">
📢 Manage Advertisements
</a>
<a href="settings.php" class="btn btn-dark me-2">
⚙️ Website Settings
</a>
<a href="change_password.php" class="btn btn-dark me-2 mb-2">Change Password</a>

<a href="index.php" class="btn btn-secondary me-2 mb-2">View Website</a>

<a href="index.php" class="btn btn-danger mb-2">Logout</a>

</div>

</div>

<div class="card shadow mb-4">

<div class="card-header bg-primary text-white">
📊 News By Category
</div>

<div class="card-body">

<canvas id="newsChart"></canvas>

</div>

</div>

<h4 class="mb-3">📰 Recent News</h4>

<table class="table table-bordered table-striped">

<thead>

<tr>

<th>ID</th>

<th>Title</th>

<th>Views</th>

<th>Featured</th>

</tr>

</thead>

<tbody>

<?php

$recent=mysqli_query($conn,"
SELECT *
FROM news
ORDER BY id DESC
LIMIT 5
");

while($row=mysqli_fetch_assoc($recent))
{

?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['title']; ?></td>

<td><?php echo $row['views']; ?></td>

<td>

<?php
if($row['featured']==1){
echo "<span class='badge bg-success'>Yes</span>";
}else{
echo "<span class='badge bg-danger'>No</span>";
}
?>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx=document.getElementById('newsChart');

new Chart(ctx,{
type:'bar',
data:{
labels:<?php echo json_encode($labels); ?>,
datasets:[{
label:'Total News',
data:<?php echo json_encode($data); ?>,
backgroundColor:[
'#0d6efd',
'#198754',
'#ffc107',
'#dc3545',
'#6f42c1',
'#20c997',
'#fd7e14'
]
}]
},
options:{
responsive:true,
scales:{
y:{
beginAtZero:true
}
}
}
});

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>