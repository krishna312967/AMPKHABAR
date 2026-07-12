<?php
include("database.php");
$setting = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM settings LIMIT 1"));
?>
<footer class="bg-dark text-white mt-5 pt-5 pb-3">

<div class="container">

<div class="row">

<!-- About -->
<div class="col-md-4 mb-4">

<h4 class="text-warning">📰 AMPKHABAR</h4>

<p>
AMPKHABAR is a modern online news portal developed as <B>KR TEAMS</B>
We provide the latest and trusted news from Nepal and around the world.
</p>

</div>

<!-- Quick Links -->
<div class="col-md-4 mb-4">

<h5 class="text-warning">Quick Links</h5>

<ul class="list-unstyled">

<li><a href="index.php" class="text-white text-decoration-none">🏠 Home</a></li>

<li><a href="about.php" class="text-white text-decoration-none">ℹ️ About Us</a></li>

<li><a href="contact.php" class="text-white text-decoration-none">📞 Contact Us</a></li>

<li><a href="search.php" class="text-white text-decoration-none">🔍 Search News</a></li>

</ul>

</div>

<!-- Contact -->
<div class="col-md-4 mb-4">

<h5 class="text-warning">Contact Info</h5>
<p>📧 <?php echo $setting['site_email']; ?></p>

<p>📞 <?php echo $setting['site_phone']; ?></p>

<p>📍 <?php echo $setting['site_address']; ?></p>

<div class="mt-3">

<a href="#" class="text-white fs-4 me-3"><i class="bi bi-facebook"></i></a>

<a href="#" class="text-white fs-4 me-3"><i class="bi bi-instagram"></i></a>

<a href="#" class="text-white fs-4 me-3"><i class="bi bi-youtube"></i></a>

<a href="#" class="text-white fs-4"><i class="bi bi-twitter-x"></i></a>

</div>

</div>

</div>

<hr class="border-secondary">

<div class="text-center">

<p class="mb-1">
© <?php echo date('Y'); ?> <strong>AMPKHABAR</strong>. All Rights Reserved.
</p>

<p class="small text-secondary">
Developed by Kr Teams | 
</p>

</div>

</div>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>