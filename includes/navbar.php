<?php
include("database.php");
$setting = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM settings LIMIT 1"));
$categories = mysqli_query($conn, "SELECT * FROM categories ORDER BY category_name ASC");
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-danger sticky-top shadow">
    <div class="container">

        <a class="navbar-brand fw-bold" href="index.php">
            <?php echo $setting['site_name']; ?>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">

            <ul class="navbar-nav me-auto">

                <li class="nav-item">
                    <a class="nav-link active" href="index.php"> Home</a>
                </li>

                <?php while($cat = mysqli_fetch_assoc($categories)){ ?>

                <li class="nav-item">
                    <a class="nav-link" href="category.php?id=<?php echo $cat['id']; ?>">
                        <?php echo $cat['category_name']; ?>
                    </a>
                </li>

                <?php } ?>
                <li class="nav-item">
                    <!-- <a class="nav-link" href="breaking.php"> Breaking</a> -->
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="contact.php"> Contact</a>
                </li>

            </ul>

            <form class="d-flex" action="search.php" method="GET">

                <input class="form-control me-2" type="search" name="search" placeholder="Search News">

                <button class="btn btn-light">
                    Search
                </button>
                <div class="text-white ms-3 me-3 fw-bold" id="liveDateTime"></div>

                <a href="login.php" class="btn btn-warning me-2">
                    Admin
                </a>

            </form>
            <button class="btn btn-dark" id="themeToggle">
                🌙
            </button>


        </div>

    </div>
</nav>
<style>
.dark-mode {
    background: #121212 !important;
    color: white !important;
}

.dark-mode .card {
    background: #1f1f1f !important;
    color: white;
}

.dark-mode .navbar {
    background: #000 !important;
}

.dark-mode .table {
    color: white;
}

.dark-mode .list-group-item {
    background: #1f1f1f;
    color: white;
}
</style>

<script>
window.onload = function() {

    if (localStorage.getItem("theme") == "dark") {
        document.body.classList.add("dark-mode");
        document.getElementById("themeToggle").innerHTML = "☀️";
    }

    document.getElementById("themeToggle").onclick = function() {

        document.body.classList.toggle("dark-mode");

        if (document.body.classList.contains("dark-mode")) {
            localStorage.setItem("theme", "dark");
            this.innerHTML = "☀️";
        } else {
            localStorage.setItem("theme", "light");
            this.innerHTML = "🌙";
        }

    }

}
</script>