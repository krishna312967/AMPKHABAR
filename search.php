<?php
include("database.php");
include("includes/header.php");
include("includes/navbar.php");

$search = "";

if(isset($_GET['search'])){
    $search = mysqli_real_escape_string($conn, $_GET['search']);
}

$result = mysqli_query($conn,"
SELECT news.*, categories.category_name
FROM news
JOIN categories ON news.category_id = categories.id
WHERE title LIKE '%$search%'
   OR description LIKE '%$search%'
ORDER BY news.id DESC
");
?>

<div class="container mt-4">

<h2>Search Result: "<?php echo htmlspecialchars($search); ?>"</h2>

<div class="row">

<?php
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
?>

<div class="col-md-4 mb-4">

<div class="card shadow">

<img src="uploads/<?php echo $row['image']; ?>" class="card-img-top">

<div class="card-body">

<span class="badge bg-danger"><?php echo $row['category_name']; ?></span>

<h5 class="mt-2"><?php echo $row['title']; ?></h5>

<p><?php echo substr($row['description'],0,100); ?>...</p>

<a href="news_details.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">
Read More
</a>

</div>

</div>

</div>

<?php
    }
}else{
    echo "<h4 class='text-center text-danger'>No News Found!</h4>";
}
?>

</div>

</div>

<?php include("includes/footer.php"); ?>