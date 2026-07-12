<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include("database.php");

$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM news WHERE id='$id'");
$news = mysqli_fetch_assoc($result);

if (!$news) {
    die("News not found!");
}

if (isset($_POST['update'])) {

    $category_id = $_POST['category_id'];
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $image = $news['image'];

    if (!empty($_FILES['image']['name'])) {

        $image = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];

        move_uploaded_file($tmp, "uploads/" . $image);
    }

    mysqli_query($conn, "UPDATE news SET
        category_id='$category_id',
        title='$title',
        description='$description',
        image='$image'
        WHERE id='$id'");

    header("Location: news.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit News</title>
</head>
<body>

<h2>Edit News</h2>

<form method="POST" enctype="multipart/form-data">

<label>Category</label><br>

<select name="category_id">

<?php
$cat = mysqli_query($conn,"SELECT * FROM categories");

while($row=mysqli_fetch_assoc($cat)){
?>

<option value="<?php echo $row['id']; ?>"
<?php if($row['id']==$news['category_id']) echo "selected"; ?>>

<?php echo $row['category_name']; ?>

</option>

<?php } ?>

</select>

<br><br>

<label>Title</label><br>

<input type="text" name="title"
value="<?php echo $news['title']; ?>" required>

<br><br>

<label>Current Image</label><br>

<img src="uploads/<?php echo $news['image']; ?>" width="150">

<br><br>

<label>Change Image</label><br>

<input type="file" name="image">

<br><br>

<label>Description</label><br>

<textarea name="description" rows="6" cols="60"><?php echo $news['description']; ?></textarea>

<br><br>

<button type="submit" name="update">Update News</button>

</form>

<br>

<a href="news.php">⬅ Back</a>

</body>
</html>