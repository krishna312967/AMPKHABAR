<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location:login.php");
    exit();
}

include("database.php");

$id = (int)$_GET['id'];

$ad = mysqli_query($conn,"SELECT * FROM advertisements WHERE id='$id'");
$row = mysqli_fetch_assoc($ad);

if(!$row){
    die("Advertisement not found.");
}

if(isset($_POST['update'])){

    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $link  = mysqli_real_escape_string($conn,$_POST['link']);
    $status = (int)$_POST['status'];

    $image = $row['image'];

    if(!empty($_FILES['image']['name'])){

        $image = time()."_".$_FILES['image']['name'];

        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            "uploads/".$image
        );
    }

    mysqli_query($conn,"
    UPDATE advertisements
    SET
    title='$title',
    link='$link',
    image='$image',
    status='$status'
    WHERE id='$id'
    ");

    echo "<script>
    alert('Advertisement Updated Successfully');
    window.location='ads.php';
    </script>";
}
?>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">

<title>Edit Advertisement</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-warning">

<h3>✏️ Edit Advertisement</h3>

</div>

<div class="card-body">

<form method="POST" enctype="multipart/form-data">

<div class="mb-3">

<label>Title</label>

<input
type="text"
name="title"
class="form-control"
value="<?php echo htmlspecialchars($row['title']); ?>"
required>

</div>

<div class="mb-3">

<label>Link</label>

<input
type="text"
name="link"
class="form-control"
value="<?php echo htmlspecialchars($row['link']); ?>">

</div>

<div class="mb-3">

<label>Current Image</label>

<br>

<img
src="uploads/<?php echo $row['image']; ?>"
width="250"
class="img-thumbnail">

</div>

<div class="mb-3">

<label>Change Image</label>

<input
type="file"
name="image"
class="form-control">

</div>

<div class="mb-3">

<label>Status</label>

<select
name="status"
class="form-select">

<option value="1"
<?php if($row['status']==1) echo "selected"; ?>>
Active
</option>

<option value="0"
<?php if($row['status']==0) echo "selected"; ?>>
Inactive
</option>

</select>

</div>

<button
class="btn btn-success"
name="update">

💾 Update Advertisement

</button>

<a href="ads.php"
class="btn btn-secondary">

⬅ Back

</a>

</form>

</div>

</div>

</div>

</body>
</html>