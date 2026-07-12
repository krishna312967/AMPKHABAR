<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include("database.php");

$id = $_GET['id'];

// पुरानो category ल्याउने
$result = mysqli_query($conn, "SELECT * FROM categories WHERE id='$id'");
$row = mysqli_fetch_assoc($result);

// Update गर्ने
if(isset($_POST['update'])){

    $category = mysqli_real_escape_string($conn, $_POST['category_name']);

    mysqli_query($conn, "UPDATE categories SET category_name='$category' WHERE id='$id'");

    header("Location: categories.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Edit Category | AMPKHABAR Admin</title>

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

.page-title{
    font-weight:bold;
}

</style>

</head>

<body>

<div class="container py-5">

<div class="row justify-content-center">

<div class="col-lg-7">

<div class="card shadow-lg">

<div class="card-header bg-warning text-dark">

<h3 class="mb-0">

<i class="bi bi-pencil-square"></i>

Edit Category

</h3>

</div>

<div class="card-body">

<form method="POST">

<div class="mb-3">

<label class="form-label fw-bold">

Category Name

</label>

<input
type="text"
name="category_name"
class="form-control form-control-lg"
value="<?php echo htmlspecialchars($row['category_name']); ?>"
placeholder="Enter Category Name"
required>

</div>

<div class="d-flex gap-2">

<button
type="submit"
name="update"
class="btn btn-success">

<i class="bi bi-check-circle-fill"></i>

Update Category

</button>

<a
href="categories.php"
class="btn btn-secondary">

<i class="bi bi-arrow-left"></i>

Back

</a>

<button
type="reset"
class="btn btn-warning">

<i class="bi bi-arrow-clockwise"></i>

Reset

</button>

</div>

</form>

</div>

</div>

</div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>