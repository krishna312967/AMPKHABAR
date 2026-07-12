<?php
include("database.php");

$name = mysqli_real_escape_string($conn,$_POST['name']);
$email = mysqli_real_escape_string($conn,$_POST['email']);
$subject = mysqli_real_escape_string($conn,$_POST['subject']);
$message = mysqli_real_escape_string($conn,$_POST['message']);

mysqli_query($conn,"
INSERT INTO contacts(name,email,subject,message)
VALUES('$name','$email','$subject','$message')
");

echo "<script>
alert('Message Sent Successfully!');
window.location='contact.php';
</script>";
?>