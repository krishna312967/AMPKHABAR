<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include("database.php");

$setting = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM settings LIMIT 1"));

if(isset($_POST['save'])){

    $site_name = mysqli_real_escape_string($conn,$_POST['site_name']);
    $site_email = mysqli_real_escape_string($conn,$_POST['site_email']);
    $site_phone = mysqli_real_escape_string($conn,$_POST['site_phone']);
    $site_address = mysqli_real_escape_string($conn,$_POST['site_address']);
    $facebook = mysqli_real_escape_string($conn,$_POST['facebook']);
    $instagram = mysqli_real_escape_string($conn,$_POST['instagram']);
    $youtube = mysqli_real_escape_string($conn,$_POST['youtube']);
    $twitter = mysqli_real_escape_string($conn,$_POST['twitter']);
    $meta_title = mysqli_real_escape_string($conn,$_POST['meta_title']);
    $meta_description = mysqli_real_escape_string($conn,$_POST['meta_description']);
    $meta_keywords = mysqli_real_escape_string($conn,$_POST['meta_keywords']);

    mysqli_query($conn,"
    UPDATE settings SET
    site_name='$site_name',
    site_email='$site_email',
    site_phone='$site_phone',
    site_address='$site_address',
    facebook='$facebook',
    instagram='$instagram',
    youtube='$youtube',
    twitter='$twitter'
    meta_title='$meta_title',
    meta_description='$meta_description',
    meta_keywords='$meta_keywords'
    WHERE id=1
    ");

    echo "<script>alert('Settings Updated Successfully'); window.location='settings.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Website Settings</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">

        <div class="card shadow">

            <div class="card-header bg-dark text-white">
                <h3>⚙️ Website Settings</h3>
            </div>

            <div class="card-body">

                <form method="POST">

                    <div class="mb-3">
                        <label>Website Name</label>
                        <input type="text" name="site_name" class="form-control"
                            value="<?php echo $setting['site_name']; ?>">
                    </div>

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="site_email" class="form-control"
                            value="<?php echo $setting['site_email']; ?>">
                    </div>

                    <div class="mb-3">
                        <label>Phone</label>
                        <input type="text" name="site_phone" class="form-control"
                            value="<?php echo $setting['site_phone']; ?>">
                    </div>

                    <div class="mb-3">
                        <label>Address</label>
                        <textarea name="site_address" class="form-control"
                            rows="3"><?php echo $setting['site_address']; ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Facebook Link</label>
                        <input type="text" name="facebook" class="form-control"
                            value="<?php echo $setting['facebook']; ?>">
                    </div>

                    <div class="mb-3">
                        <label>Instagram Link</label>
                        <input type="text" name="instagram" class="form-control"
                            value="<?php echo $setting['instagram']; ?>">
                    </div>

                    <div class="mb-3">
                        <label>YouTube Link</label>
                        <input type="text" name="youtube" class="form-control"
                            value="<?php echo $setting['youtube']; ?>">
                    </div>

                    <div class="mb-3">
                        <label>Twitter (X) Link</label>
                        <input type="text" name="twitter" class="form-control"
                            value="<?php echo $setting['twitter']; ?>">
                    </div>
                    <div class="mb-3">
                        <label>SEO Meta Title</label>
                        <input type="text" name="meta_title" class="form-control"
                            value="<?php echo $setting['meta_title']; ?>">
                    </div>

                    <div class="mb-3">
                        <label>SEO Meta Description</label>
                        <textarea name="meta_description" class="form-control"
                            rows="4"><?php echo $setting['meta_description']; ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label>SEO Meta Keywords</label>
                        <textarea name="meta_keywords" class="form-control"
                            rows="3"><?php echo $setting['meta_keywords']; ?></textarea>
                    </div>

                    <button type="submit" name="save" class="btn btn-success">
                        💾 Save Settings
                    </button>

                    <a href="dashboard.php" class="btn btn-secondary">
                        ⬅ Back Dashboard
                    </a>

                </form>

            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>