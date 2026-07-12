<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include("database.php");

if(isset($_POST['publish'])){

    $category_id = $_POST['category_id'];
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $description = mysqli_real_escape_string($conn,$_POST['description']);

    $breaking = isset($_POST['breaking']) ? 1 : 0;

    $image = $_FILES['image']['name'];
    $temp = $_FILES['image']['tmp_name'];

    move_uploaded_file($temp, __DIR__ . "/uploads/" . $image);

    $sql = "INSERT INTO news(category_id,title,description,image,breaking)
VALUES('$category_id','$title','$description','$image','$breaking')";

    if(mysqli_query($conn,$sql)){
        echo "<script>alert('News Published Successfully');</script>";
    }else{
        echo mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Manage News | AMPKHABAR Admin</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>

body{
    background:#f4f6f9;
}

.page-title{
    font-weight:700;
}

.card{
    border:none;
    border-radius:15px;
}

.table img{
    border-radius:8px;
    object-fit:cover;
}

.badge-featured{
    background:#198754;
}

.badge-breaking{
    background:#dc3545;
}

</style>

</head>

<body>

<div class="container py-4">

<div class="d-flex justify-content-between align-items-center mb-4">

<h2 class="page-title">
📰 Manage News
</h2>

<a href="dashboard.php" class="btn btn-dark">
<i class="bi bi-arrow-left"></i>
Dashboard
</a>

</div>

<div class="card shadow-lg mb-4">

<div class="card-header bg-danger text-white">

<h4 class="mb-0">
Publish News
</h4>

</div>

<div class="card-body">

<form method="POST" enctype="multipart/form-data">

<div class="row">

<div class="col-md-6 mb-3">

<label class="form-label">
Category
</label>

<select name="category_id" class="form-select" required>

<option value="">Select Category</option>

<?php

$result = mysqli_query($conn,"SELECT * FROM categories ORDER BY category_name ASC");

while($row=mysqli_fetch_assoc($result)){
?>

<option value="<?php echo $row['id']; ?>">

<?php echo $row['category_name']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">
News Title
</label>

<input
type="text"
name="title"
class="form-control"
placeholder="Enter News Title"
required>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">
Upload Image
</label>

<input
type="file"
name="image"
class="form-control">

</div>
</div>

<div class="col-12 mb-3">

<label class="form-label">
News Description
</label>

<textarea
name="description"
rows="6"
class="form-control"
placeholder="Write complete news here..."
required></textarea>

</div>

<div class="col-12 mb-3">

<div class="form-check form-switch">

<input
class="form-check-input"
type="checkbox"
name="breaking"
value="1"
id="breakingNews">

<label
class="form-check-label fw-bold"
for="breakingNews">

🔥 Make Breaking News

</label>

</div>

</div>

<div class="col-12">

<button
type="submit"
name="publish"
class="btn btn-danger">

<i class="bi bi-send-fill"></i>

Publish News

</button>

<button
type="reset"
class="btn btn-secondary">

<i class="bi bi-arrow-clockwise"></i>

Reset

</button>

</div>

</div>

</form>

</div>

</div>

<div class="card shadow-lg">

<div class="card-header bg-dark text-white">

<h4 class="mb-0">

📰 All Published News

</h4>

</div>

<div class="card-body">

<div class="table-responsive">

<table class="table table-hover table-bordered align-middle">

<thead class="table-dark">

<tr>

<th>ID</th>

<th>Category</th>

<th>Title</th>

<th>Image</th>

<th>Description</th>

<th>Featured</th>

<th>Breaking</th>

<th>Action</th>

</tr>

</thead>

<tbody>
    <?php

$query = mysqli_query($conn,"
SELECT news.*, categories.category_name
FROM news
JOIN categories
ON news.category_id = categories.id
ORDER BY news.id DESC
");

while($row=mysqli_fetch_assoc($query)){
?>

<tr>

<td><?php echo $row['id']; ?></td>

<td>

<span class="badge bg-primary">

<?php echo $row['category_name']; ?>

</span>

</td>

<td style="min-width:220px;">

<b><?php echo $row['title']; ?></b>

</td>

<td>

<img src="uploads/<?php echo $row['image']; ?>"
width="120"
height="70"
style="object-fit:cover;border-radius:8px;">

</td>

<td style="max-width:280px;">

<?php echo substr($row['description'],0,80); ?>...

</td>

<td>

<?php if($row['featured']==1){ ?>

<span class="badge bg-success">

⭐ Featured

</span>

<?php }else{ ?>

<a href="feature_news.php?id=<?php echo $row['id']; ?>"
class="btn btn-outline-success btn-sm">

Make Featured

</a>

<?php } ?>

</td>

<td>

<?php if($row['breaking']==1){ ?>

<span class="badge bg-danger">

🔥 Breaking

</span>

<br><br>

<a href="remove_breaking.php?id=<?php echo $row['id']; ?>"
class="btn btn-outline-danger btn-sm">

Remove

</a>

<?php }else{ ?>

<a href="breaking_news.php?id=<?php echo $row['id']; ?>"
class="btn btn-outline-warning btn-sm">

Make Breaking

</a>

<?php } ?>

</td>

<td>

<a href="edit_news.php?id=<?php echo $row['id']; ?>"
class="btn btn-warning btn-sm mb-1">

<i class="bi bi-pencil-square"></i>

Edit

</a>

<br>

<a href="delete_news.php?id=<?php echo $row['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Delete this news?')">

<i class="bi bi-trash"></i>

Delete

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
