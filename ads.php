<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location:login.php");
    exit();
}

include("database.php");

/* Delete Advertisement */

if(isset($_GET['delete'])){

    $id = (int)$_GET['delete'];

    mysqli_query($conn,"
    DELETE FROM advertisements
    WHERE id='$id'
    ");

    header("Location:ads.php");
    exit();
}


/* Upload Advertisement */

if(isset($_POST['save'])){

    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $link  = mysqli_real_escape_string($conn,$_POST['link']);

    $image = "";

    if(!empty($_FILES['image']['name'])){

        $image = time()."_".$_FILES['image']['name'];

        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            "uploads/".$image
        );

    }

    mysqli_query($conn,"
    INSERT INTO advertisements
    (title,image,link,status)
    VALUES
    ('$title','$image','$link',1)
    ");

    header("Location:ads.php");
    exit();
}

$ads = mysqli_query($conn,"
SELECT *
FROM advertisements
ORDER BY id DESC
");
?>

<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<title>Manage Advertisements</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-4">

<div class="card shadow">

<div class="card-header bg-dark text-white">

<h3 class="mb-0">
📢 Manage Advertisements
</h3>

</div>

<div class="card-body">

<form method="POST" enctype="multipart/form-data">

<div class="row">

<div class="col-md-4">

<label class="form-label">
Title
</label>

<input
type="text"
name="title"
class="form-control"
required>

</div>

<div class="col-md-4">

<label class="form-label">
Advertisement Link
</label>

<input
type="text"
name="link"
class="form-control">

</div>

<div class="col-md-4">

<label class="form-label">
Advertisement Image
</label>

<input
type="file"
name="image"
class="form-control"
required>

</div>

</div>

<div class="mt-3">

<button
class="btn btn-success"
name="save">

<i class="bi bi-upload"></i>

Upload Advertisement

</button>

<a href="dashboard.php"
class="btn btn-secondary">

Dashboard

</a>

</div>

</form>

<hr>

<h4>
📋 All Advertisements
</h4>

<div class="table-responsive">

<table class="table table-bordered table-hover align-middle">

<tr class="table-dark">

<th>ID</th>

<th>Preview</th>

<th>Title</th>

<th>Link</th>

<th>Status</th>

<th width="180">
Action
</th>

</tr>
<?php while($row=mysqli_fetch_assoc($ads)){ ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td>

<?php if(!empty($row['image'])){ ?>

<img src="uploads/<?php echo $row['image']; ?>"
style="width:180px;height:80px;object-fit:cover;border-radius:8px;">

<?php }else{ ?>

<span class="text-danger">No Image</span>

<?php } ?>

</td>

<td>

<?php echo htmlspecialchars($row['title']); ?>

</td>

<td>

<?php if(!empty($row['link'])){ ?>

<a href="<?php echo $row['link']; ?>" target="_blank">

<?php echo $row['link']; ?>

</a>

<?php }else{ ?>

-

<?php } ?>

</td>

<td>

<?php if($row['status']==1){ ?>

<span class="badge bg-success">
Active
</span>

<?php }else{ ?>

<span class="badge bg-danger">
Inactive
</span>

<?php } ?>

</td>

<td>

<a href="edit_ad.php?id=<?php echo $row['id']; ?>"
class="btn btn-warning btn-sm">

<i class="bi bi-pencil-square"></i>

Edit

</a>

<a href="ads.php?delete=<?php echo $row['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Delete this advertisement?');">

<i class="bi bi-trash"></i>

Delete

</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>