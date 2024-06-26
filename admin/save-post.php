<?php
include "../database/dbconfig.php";
session_start();


// if (isset($_FILES['fileToUpload'])) {
//     $errors = array();

//     $file_name = $_FILES['fileToUpload']['name'];
//     $file_size = $_FILES['fileToUpload']['size'];
//     $file_tmp = $_FILES['fileToUpload']['tmp_name'];
//     $file_type = $_FILES['fileToUpload']['type'];
//     $file_ext = strtolower(end(explode('.', $file_name)));
//     $allowed_extensions = array("jpeg", "jpg", "png");



//     if (!in_array($file_ext, $allowed_extensions)) {
//         $errors[] = "Only JPG, JPEG, and PNG files are allowed.";
//     }

//     if ($file_size > 2097152) {
//         $errors[] = "File size must be 2MB or lower.";
//     }

//     if (!empty($errors)) {

//         move_uploaded_file($file_tmp, "../upload/" . $file_name);
//     } else {
//         foreach ($errors as $error) {
//             echo "<div class='alert alert-danger'>$error</div>";
//         }
//         die();
//     }
// }



// =============== test==========

$newfilename = "newfilename";
if (isset($_FILES['fileToUpload'])) {
    $errors = array();

    $file_name = $_FILES['fileToUpload']['name'];
    $file_size = $_FILES['fileToUpload']['size'];
    $file_tmp = $_FILES['fileToUpload']['tmp_name'];
    $file_type = $_FILES['fileToUpload']['type'];
    $file_ext = strtolower(end(explode('.', $_FILES['fileToUpload']['name'])));
    // $file_ext = strtolower(end(explode('.', $file_name)));

    $allowed_extensions = array("jpeg", "jpg", "png");



    if (in_array($file_ext, $allowed_extensions) === false) {
        $errors[] = "Only JPG, JPEG, and PNG files are allowed.";
    }

    if ($file_size > 2097152) {
        $errors[] = "File size must be 2MB or lower.";
    }

    if (empty($errors) == true) {

        // move_uploaded_file($file_tmp, "../upload/" . $file_name);
        move_uploaded_file($file_tmp, "upload/" . $newfilename . "." . $file_ext);
    } else {
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
        // die();
    }
}



// ===================



$post_title = mysqli_real_escape_string($conn, $_POST['post_title']);
$postdesc = mysqli_real_escape_string($conn, $_POST['postdesc']);
$category = mysqli_real_escape_string($conn, $_POST['category']);
$date = date("d M, Y");
$author = $_SESSION['user_id'];


$sql = "INSERT INTO post (title, description, category, post_date, author, post_img)
        VALUES ('$post_title', '$postdesc', $category, '$date', '$author', '$file_name');";

$sql .= "UPDATE category SET post = post + 1 WHERE category_id = $category;";



if (mysqli_multi_query($conn, $sql)) {
    header("Location: http://localhost:84/mysite/php/CMS/admin/post.php");
} else {
    echo "<div class='alert alert-danger'>Query Failed</div>";
}
