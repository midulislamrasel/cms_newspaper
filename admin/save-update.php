<?php
include "../database/dbconfig.php";

// Function to handle file upload errors
function handleFileUploadErrors($errors)
{
    foreach ($errors as $error) {
        echo "<div class='alert alert-danger'>$error</div>";
    }
    die();
}

// Check if a new image is uploaded
if ($_FILES['new-image']['name']) {
    $file_name = $_FILES['new-image']['name'];
    $file_size = $_FILES['new-image']['size'];
    $file_tmp = $_FILES['new-image']['tmp_name'];
    $file_type = $_FILES['new-image']['type'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $allowed_extensions = array("jpeg", "jpg", "png");

    // Validate file extension
    if (!in_array($file_ext, $allowed_extensions)) {
        $errors[] = "Only JPG, JPEG, and PNG files are allowed.";
    }

    // Validate file size
    if ($file_size > 2097152) {
        $errors[] = "File size must be 2MB or lower.";
    }

    if (empty($errors)) {
        $upload_path = "./upload/" . $file_name;
        move_uploaded_file($file_tmp, $upload_path);
    } else {
        handleFileUploadErrors($errors);
    }
} else {
    // If no new image uploaded, use the old image name
    $file_name = $_POST['old_imges']; // Assuming 'old_imges' is correct
}

// Assuming $_POST["post_id"], $_POST["post_title"], $_POST["postdesc"], $_POST["category"] are sanitized and validated
$post_id = $_POST["post_id"];
$post_title = $_POST["post_title"];
$post_desc = $_POST["postdesc"];
$category = $_POST["category"];


// Update the post
$sql = "UPDATE post SET title='$post_title', description='$post_desc', category=$category, post_img='$file_name' WHERE post_id=$post_id";
// Execute SQL statement...




$result = mysqli_query($conn, $sql);

if ($result) {
    header("Location: http://localhost:84/mysite/php/CMS/admin/post.php");
} else {
    echo "Query Failed";
}
