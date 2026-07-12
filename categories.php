<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include("database.php");

// Add Category
if (isset($_POST['add_category'])) {

    $category = mysqli_real_escape_string($conn, $_POST['category_name']);

    $sql = "INSERT INTO categories(category_name) VALUES('$category')";

    if (mysqli_query($conn, $sql)) {
        header("Location: categories.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Manage Categories | AMPKHABAR Admin</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>

body{
    background:#f4f6f9;
}

.card{
    border:none;
    border-radius:15px;
}

.table img{
    border-radius:8px;
}

.page-title{
    font-weight:700;
}

</style>

</head>

<body>

<div class="container py-4">

<div class="d-flex justify-content-between align-items-center mb-4">

<h2 class="page-title">
<i class="bi bi-folder-fill text-primary"></i>
Manage Categories
</h2>

<a href="dashboard.php" class="btn btn-dark">
<i class="bi bi-arrow-left"></i>
Dashboard
</a>

</div>

<div class="card shadow-lg mb-4">

<div class="card-header bg-primary text-white">

<h4 class="mb-0">
<i class="bi bi-plus-circle"></i>
Add New Category
</h4>

</div>

<div class="card-body">

<form method="POST">

<div class="row">

<div class="col-md-10">

<input
type="text"
name="category_name"
class="form-control"
placeholder="Enter Category Name"
required>

</div>

<div class="col-md-2 d-grid">

<button
type="submit"
name="add_category"
class="btn btn-primary">

<i class="bi bi-plus-lg"></i>

Add

</button>

</div>

</div>

</form>

</div>

</div>

<div class="card shadow-lg">

<div class="card-header bg-dark text-white">

<h4 class="mb-0">

<i class="bi bi-list-ul"></i>

All Categories

</h4>

</div>

<div class="card-body">

<div class="table-responsive">

<table class="table table-hover table-bordered align-middle">

<thead class="table-dark">

<tr>

<th width="80">ID</th>

<th>Category Name</th>

<th width="220">Action</th>

</tr>

</thead>

<tbody>
    <?php

$result = mysqli_query($conn,"
SELECT *
FROM categories
ORDER BY id DESC
");

while($row=mysqli_fetch_assoc($result)){
?>

<tr>

<td>
<?php echo $row['id']; ?>
</td>

<td>

<span class="fw-semibold">

<i class="bi bi-folder2-open text-primary"></i>

<?php echo htmlspecialchars($row['category_name']); ?>

</span>

</td>

<td>

<a
href="edit_category.php?id=<?php echo $row['id']; ?>"
class="btn btn-warning btn-sm">

<i class="bi bi-pencil-square"></i>

Edit

</a>

<a
href="delete_category.php?id=<?php echo $row['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Are you sure you want to delete this category?');">

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