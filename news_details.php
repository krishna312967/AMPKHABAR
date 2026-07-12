<?php
include("database.php");

$id = (int)$_GET['id'];

// Increase View Count
mysqli_query($conn, "UPDATE news SET views = views + 1 WHERE id='$id'");

// Fetch News
$query = mysqli_query($conn,"
SELECT news.*, categories.category_name
FROM news
JOIN categories
ON news.category_id = categories.id
WHERE news.id='$id'
");

$row = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo htmlspecialchars($row['title']); ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

<a href="index.php" class="btn btn-secondary mb-3">⬅ Back</a>

<h1><?php echo htmlspecialchars($row['title']); ?></h1>

<p>

<b>Category:</b>
<?php echo htmlspecialchars($row['category_name']); ?>

<br>

<b>Date:</b>
<?php echo $row['created_at']; ?>

<br>

<b>Views:</b>
👁️ <?php echo $row['views'] + 1; ?>

<br><br>

<a href="like_news.php?id=<?php echo $row['id']; ?>"
class="btn btn-primary">

👍 Like (<?php echo $row['likes']; ?>)

</a>
<hr>

<h4>📤 Share this News</h4>

<a href="https://www.facebook.com/sharer/sharer.php?u=http://localhost/ampkhabar/news_details.php?id=<?php echo $row['id']; ?>"
target="_blank"
class="btn btn-primary">
Facebook
</a>

<a href="https://wa.me/?text=http://localhost/ampkhabar/news_details.php?id=<?php echo $row['id']; ?>"
target="_blank"
class="btn btn-success">
WhatsApp
</a>

<a href="https://twitter.com/intent/tweet?url=http://localhost/ampkhabar/news_details.php?id=<?php echo $row['id']; ?>"
target="_blank"
class="btn btn-dark">
X (Twitter)
</a>

</p>


<img src="uploads/<?php echo htmlspecialchars($row['image']); ?>"
class="img-fluid rounded mb-4">

<p style="font-size:18px">

<?php echo nl2br(htmlspecialchars($row['description'])); ?>

</p>

<hr>

<h3>Leave a Comment</h3>

<form action="comment_save.php" method="POST">

<input type="hidden" name="news_id" value="<?php echo $row['id']; ?>">

<div class="mb-3">
<input type="text" name="name"
class="form-control"
placeholder="Your Name"
required>
</div>

<div class="mb-3">
<textarea
name="comment"
class="form-control"
rows="4"
placeholder="Write your comment..."
required></textarea>
</div>

<button type="submit"
class="btn btn-danger">
Post Comment
</button>

</form>

<hr>

<h3>Comments</h3>

<?php

$comments = mysqli_query($conn,"
SELECT *
FROM comments
WHERE news_id='".$row['id']."'
ORDER BY id DESC
");

if(mysqli_num_rows($comments)>0){

while($c=mysqli_fetch_assoc($comments)){

?>

<div class="card mb-3">

<div class="card-body">

<h6 class="text-primary">
<?php echo htmlspecialchars($c['name']); ?>
</h6>

<p>
<?php echo nl2br(htmlspecialchars($c['comment'])); ?>
</p>

<small class="text-muted">
<?php echo $c['created_at']; ?>
</small>

</div>

</div>

<?php

}

}else{

echo "<p>No comments yet.</p>";

}

?>
<hr>

<h3 class="mb-4">📰 Related News</h3>

<div class="row">

<?php

$related = mysqli_query($conn,"
SELECT *
FROM news
WHERE category_id='".$row['category_id']."'
AND id!='".$row['id']."'
ORDER BY id DESC
LIMIT 3
");

while($r=mysqli_fetch_assoc($related)){
?>

<div class="col-md-4 mb-3">

<div class="card h-100 shadow">

<img src="uploads/<?php echo $r['image'];?>"
class="card-img-top"
style="height:180px;object-fit:cover;">

<div class="card-body">

<h6>
<?php echo htmlspecialchars($r['title']); ?>
</h6>

<a href="news_details.php?id=<?php echo $r['id'];?>"
class="btn btn-danger btn-sm">
Read More
</a>

</div>

</div>

</div>

<?php } ?>

</div>

</div>

</body>
</html>