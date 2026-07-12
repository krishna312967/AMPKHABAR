<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include("database.php");

$result = mysqli_query($conn,"SELECT * FROM contacts ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Contacts</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

<h2 class="mb-4">📩 Contact Messages</h2>

<table class="table table-bordered table-hover">

<thead class="table-dark">

<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Subject</th>
    <th>Message</th>
    <th>Date</th>
    <th>Action</th>
</tr>

</thead>

<tbody>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo htmlspecialchars($row['name']); ?></td>

<td><?php echo htmlspecialchars($row['email']); ?></td>

<td><?php echo htmlspecialchars($row['subject']); ?></td>

<td><?php echo nl2br(htmlspecialchars($row['message'])); ?></td>

<td><?php echo $row['created_at']; ?></td>

<td>

<a href="delete_contact.php?id=<?php echo $row['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Delete this message?')">
Delete
</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

<a href="dashboard.php" class="btn btn-secondary">
⬅ Back Dashboard
</a>

</div>

</body>
</html>