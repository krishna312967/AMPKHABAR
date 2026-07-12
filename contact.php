<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Contact Us | AMPKHABAR</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>

body{
    background:#f8f9fa;
}

.contact-header{
    background:linear-gradient(135deg,#dc3545,#b30000);
    color:white;
    padding:60px 20px;
    border-radius:15px;
    text-align:center;
    margin-bottom:40px;
}

.info-card{
    border:none;
    border-radius:15px;
    transition:.3s;
}

.info-card:hover{
    transform:translateY(-5px);
}

.contact-form{
    border:none;
    border-radius:15px;
}

textarea{
    resize:none;
}

.social a{
    font-size:28px;
    margin:0 10px;
    color:#dc3545;
    text-decoration:none;
}

.social a:hover{
    color:black;
}

</style>

</head>

<body>

<div class="container my-5">

<div class="contact-header">

<h1>📩 Contact </h1>

<p class="mb-0">
We'd love to hear from you. Send us your feedback, suggestions or news tips.
</p>

</div>

<div class="row">

<div class="col-lg-4">

<div class="card shadow info-card mb-4">

<div class="card-body text-center">

<h2>📍</h2>

<h5>Address</h5>

<p>Kathmandu, Nepal</p>

</div>

</div>

<div class="card shadow info-card mb-4">

<div class="card-body text-center">

<h2>📧</h2>

<h5>Email</h5>

<p>info@ampkhabar.com</p>

</div>

</div>

<div class="card shadow info-card">

<div class="card-body text-center">

<h2>📞</h2>

<h5>Phone</h5>

<p>+977-9814837932</p>

</div>

</div>

</div>

<div class="col-lg-8">

<div class="card shadow contact-form">

<div class="card-body p-4">

<h3 class="mb-4">
Send Message
</h3>

<form action="contact_save.php" method="POST">

<div class="row">

<div class="col-md-6 mb-3">

<label class="form-label">

<i class="bi bi-person-fill"></i>

Full Name

</label>

<input
type="text"
name="name"
class="form-control"
placeholder="Enter your name"
required>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

<i class="bi bi-envelope-fill"></i>

Email

</label>

<input
type="email"
name="email"
class="form-control"
placeholder="Enter your email"
required>

</div>

</div>

<div class="mb-3">

<label class="form-label">

<i class="bi bi-chat-left-text-fill"></i>

Subject

</label>

<input
type="text"
name="subject"
class="form-control"
placeholder="Subject"
required>

</div>

<div class="mb-3">

<label class="form-label">

<i class="bi bi-pencil-square"></i>

Message

</label>

<textarea
name="message"
rows="6"
class="form-control"
placeholder="Write your message..."
required></textarea>

</div>

<div class="d-grid gap-2 d-md-flex">

<button
class="btn btn-danger"
type="submit">

<i class="bi bi-send-fill"></i>

Send Message

</button>

<a
href="index.php"
class="btn btn-secondary">

<i class="bi bi-arrow-left"></i>

Back Home

</a>

</div>

</form>

</div>

</div>

</div>

</div>

<hr class="my-5">

<div class="text-center">

<h4>Follow Us</h4>

<div class="social mt-3">

<a href="#"><i class="bi bi-facebook"></i></a>

<a href="#"><i class="bi bi-instagram"></i></a>

<a href="#"><i class="bi bi-twitter-x"></i></a>

<a href="#"><i class="bi bi-youtube"></i></a>

</div>

<p class="mt-4 text-muted">

© <?php echo date('Y'); ?> AMPKHABAR | All Rights Reserved.

</p>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>