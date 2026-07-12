<?php
session_start();
include("database.php");

if(isset($_POST['login'])){

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM admins WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 1){

        $_SESSION['admin'] = $email;
        header("Location: dashboard.php");
        exit();

    }else{
        $error = "Invalid Email or Password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>AMPKHABAR </title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>

body{
    background:linear-gradient(135deg,#dc3545,#6f42c1);
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    font-family:Arial,Helvetica,sans-serif;
}

.login-card{
    width:420px;
    border:none;
    border-radius:18px;
    overflow:hidden;
}

.card-header{
    background:#dc3545;
    color:white;
    text-align:center;
    padding:25px;
}

.card-header h2{
    margin:0;
    font-weight:bold;
}

.form-control{
    height:50px;
}

.btn-login{
    height:50px;
    font-size:18px;
}

.footer-text{
    font-size:14px;
    color:#666;
}

</style>

</head>

<body>

<div class="card shadow-lg login-card">

<div class="card-header">

<h2>AMPKHABAR</h2>



</div>

<div class="card-body p-4">

<?php
if(isset($error)){
?>

<div class="alert alert-danger">

<i class="bi bi-exclamation-triangle-fill"></i>

<?php echo $error; ?>

</div>

<?php } ?>

<form method="POST">

<div class="mb-3">

<label class="form-label">
Email Address
</label>

<div class="input-group">

<span class="input-group-text">
<i class="bi bi-envelope-fill"></i>
</span>

<input
type="email"
name="email"
class="form-control"
placeholder="Enter Email"
required>

</div>

</div>

<div class="mb-3">

<label class="form-label">
Password
</label>

<div class="input-group">

<span class="input-group-text">
<i class="bi bi-lock-fill"></i>
</span>

<input
type="password"
name="password"
id="password"
class="form-control"
placeholder="Enter Password"
required>

<button
class="btn btn-outline-secondary"
type="button"
onclick="togglePassword()">

<i class="bi bi-eye" id="eyeIcon"></i>

</button>

</div>

</div>

<div class="d-grid">

<button
type="submit"
name="login"
class="btn btn-danger btn-login">

<i class="bi bi-box-arrow-in-right"></i>

Login

</button>

</div>

</form>

<hr>

<div class="text-center footer-text">

© <?php echo date('Y'); ?>

<b>AMPKHABAR</b>

<br>

Developed by Kr Techonologies!-

</div>

</div>

</div>

<script>

function togglePassword(){

let pass=document.getElementById("password");
let icon=document.getElementById("eyeIcon");

if(pass.type==="password"){

pass.type="text";

icon.className="bi bi-eye-slash";

}else{

pass.type="password";

icon.className="bi bi-eye";

}

}

</script>

</body>
</html>