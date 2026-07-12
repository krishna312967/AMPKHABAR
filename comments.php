<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

include("database.php");

$result = mysqli_query($conn,"
SELECT comments.*, news.title
FROM comments
JOIN news ON comments.news_id = news.id
ORDER BY comments.id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Comments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

<h2>💬 Manage Comments</h2>

<table class="table table-bordered table-striped">

<tr>
<th>ID</th>
<th>News</th>
<th>Name</th>
<th>Comment</th>
<th>Date</th>
<th>Action</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['id']; ?></td>
<td><?php echo $row['title']; ?></td>
<td><?php echo htmlspecialchars($row['name']); ?></td>
<td><?php echo htmlspecialchars($row['comment']); ?></td>
<td><?php echo $row['created_at']; ?></td>

<td>
<a href="delete_comment.php?id=<?php echo $row['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Delete this comment?')">
Delete
</a>
</td>

</tr>

<?php } ?>

</table>

<a href="dashboard.php" class="btn btn-secondary">Back Dashboard</a>

</div>

</body>
</html>