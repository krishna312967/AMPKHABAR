<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include("database.php");

$msg = "";

if (isset($_POST['change'])) {

    $email = $_SESSION['admin'];

    $old = md5($_POST['old_password']);
    $new = md5($_POST['new_password']);
    $confirm = md5($_POST['confirm_password']);

    $check = mysqli_query($conn,
        "SELECT * FROM admins
         WHERE email='$email'
         AND password='$old'");

    if(mysqli_num_rows($check)==1){

        if($new==$confirm){

            mysqli_query($conn,
            "UPDATE admins
             SET password='$new'
             WHERE email='$email'");

            $msg="<div class='alert alert-success'>
            Password Changed Successfully.
            </div>";

        }else{

            $msg="<div class='alert alert-danger'>
            New Password and Confirm Password do not match.
            </div>";

        }

    }else{

        $msg="<div class='alert alert-danger'>
        Old Password is incorrect.
        </div>";

    }

}
?>

<!DOCTYPE html>
<html>
<head>

<title>Change Password</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5" style="max-width:550px;">

<div class="card shadow">

<div class="card-header bg-dark text-white">
<h4>🔒 Change Password</h4>
</div>

<div class="card-body">

<?php echo $msg; ?>

<form method="POST">

<div class="mb-3">
<label>Old Password</label>
<input type="password"
name="old_password"
class="form-control"
required>
</div>

<div class="mb-3">
<label>New Password</label>
<input type="password"
name="new_password"
class="form-control"
required>
</div>

<div class="mb-3">
<label>Confirm Password</label>
<input type="password"
name="confirm_password"
class="form-control"
required>
</div>

<button class="btn btn-success"
name="change">
Change Password
</button>

<a href="dashboard.php"
class="btn btn-secondary">
Back
</a>

</form>

</div>

</div>

</div>

</body>
</html>