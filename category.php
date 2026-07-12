<?php
include("database.php");
include("includes/header.php");
include("includes/navbar.php");

$id = $_GET['id'];

$result = mysqli_query($conn,"
SELECT news.*, categories.category_name
FROM news
JOIN categories ON news.category_id = categories.id
WHERE category_id='$id'
ORDER BY news.id DESC
");
?>

<div class="container mt-4">

<h2 class="mb-4">Category News</h2>

<div class="row">

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<div class="col-md-4 mb-4">

<div class="card shadow">

<img src="uploads/<?php echo $row['image']; ?>" class="card-img-top">

<div class="card-body">

<span class="badge bg-danger">
<?php echo $row['category_name']; ?>
</span>

<h5 class="mt-2">
<?php echo $row['title']; ?>
</h5>

<p>
<?php echo substr($row['description'],0,100); ?>...
</p>

<a href="news_details.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">
Read More
</a>

</div>

</div>

</div>

<?php } ?>

</div>

</div>

<?php include("includes/footer.php"); ?>