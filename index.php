<?php
include("database.php");

/* Advertisement */
$ad = mysqli_query($conn,"
SELECT *
FROM advertisements
WHERE status=1
ORDER BY id DESC
LIMIT 1
");
$advertisement = mysqli_fetch_assoc($ad);

/* Trending News */
$trending = mysqli_query($conn,"
SELECT id,title,views
FROM news
ORDER BY views DESC
LIMIT 5
");
?>

<?php include("includes/header.php"); ?>
<?php include("includes/navbar.php"); ?>

<div class="container mt-4">

<!-- Breaking News -->
<div class="alert alert-danger">
<marquee>

<?php

$breaking = mysqli_query($conn,"
SELECT title
FROM news
WHERE breaking=1
ORDER BY id DESC
LIMIT 10
");

while($b=mysqli_fetch_assoc($breaking)){
    echo "🔥 ".$b['title']." &nbsp;&nbsp;&nbsp;&nbsp;";
}

?>

</marquee>
</div>

<!-- Advertisement -->
<?php if($advertisement){ ?>

<div class="card shadow mb-4 border-0">

<a href="<?php echo $advertisement['link']; ?>" target="_blank">

<img src="uploads/<?php echo $advertisement['image']; ?>"
class="img-fluid rounded"
style="width:100%;height:180px;object-fit:cover;">

</a>

</div>

<?php } ?>

<div class="row">
    <?php

$limit = 6;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if($page < 1){
    $page = 1;
}

$start = ($page - 1) * $limit;

$result = mysqli_query($conn,"
SELECT news.*, categories.category_name
FROM news
JOIN categories
ON news.category_id = categories.id
ORDER BY news.id DESC
LIMIT $start, $limit
");

$first = true;

while($row = mysqli_fetch_assoc($result))
{

if($first)
{
?>

<div class="col-lg-8">

<div class="card shadow mb-4">

<img src="uploads/<?php echo $row['image'];?>"
class="card-img-top"
style="height:450px;object-fit:cover;">

<div class="card-body">

<span class="badge bg-danger">
<?php echo $row['category_name'];?>
</span>

<h2 class="mt-3">
<?php echo $row['title'];?>
</h2>

<p>
<?php echo substr($row['description'],0,220);?>...
</p>

<a href="news_details.php?id=<?php echo $row['id'];?>"
class="btn btn-danger">
Read Full News
</a>

</div>

</div>

</div>

<div class="col-lg-4">

<!-- Trending News -->

<div class="card shadow mb-3">

<div class="card-header bg-dark text-white">
🔥 Trending News
</div>

<ul class="list-group list-group-flush">

<?php
while($trend = mysqli_fetch_assoc($trending)){
?>

<li class="list-group-item">

<a href="news_details.php?id=<?php echo $trend['id']; ?>"
class="text-decoration-none">

<?php echo $trend['title']; ?>

</a>

<br>

<small class="text-muted">
👁️ <?php echo $trend['views']; ?> Views
</small>

</li>

<?php } ?>

</ul>

</div>

<?php

$first = false;

continue;

}
?>
<div class="card mb-3 shadow-sm">

<div class="row g-0">

<div class="col-4">

<img src="uploads/<?php echo $row['image'];?>"
class="img-fluid rounded-start"
style="height:120px;width:100%;object-fit:cover;">

</div>

<div class="col-8">

<div class="card-body">

<span class="badge bg-primary">
<?php echo $row['category_name'];?>
</span>

<h6 class="mt-2">
<?php echo $row['title'];?>
</h6>

<a href="news_details.php?id=<?php echo $row['id'];?>">
Read More →
</a>

</div>

</div>

</div>

</div>

<?php } ?>

</div>

</div>

<hr class="my-5">

<h2 class="text-center mb-4">
📰 Latest News
</h2>

<div class="row">

<?php

$latest = mysqli_query($conn,"
SELECT news.*,categories.category_name
FROM news
JOIN categories
ON news.category_id=categories.id
ORDER BY news.id DESC
LIMIT 6
");

while($news=mysqli_fetch_assoc($latest))
{
?>

<div class="col-md-4 mb-4">

<div class="card shadow h-100">

<img src="uploads/<?php echo $news['image'];?>"
class="card-img-top"
style="height:220px;object-fit:cover;">

<div class="card-body">

<span class="badge bg-danger">
<?php echo $news['category_name'];?>
</span>

<h5 class="mt-2">
<?php echo $news['title'];?>
</h5>

<p>
<?php echo substr($news['description'],0,100);?>...
</p>

<a href="news_details.php?id=<?php echo $news['id'];?>"
class="btn btn-danger">
Read More
</a>

</div>

</div>

</div>

<?php } ?>

</div>
<?php

$total_result = mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM news
");

$total_row = mysqli_fetch_assoc($total_result);

$total_news = $total_row['total'];

$total_pages = ceil($total_news / $limit);

?>

<nav aria-label="News Pagination">

<ul class="pagination justify-content-center">

<?php for($i=1; $i<=$total_pages; $i++){ ?>

<li class="page-item <?php echo ($page==$i)?'active':''; ?>">

<a class="page-link"
href="index.php?page=<?php echo $i; ?>">

<?php echo $i; ?>

</a>

</li>

<?php } ?>

</ul>

</nav>

<?php include("includes/footer.php"); ?>ddd
