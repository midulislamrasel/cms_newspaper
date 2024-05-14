<?php
include "../database/dbconfig.php";

$post_id = $_GET['id'];
$cat_id = $_GET['catid'];

//Image DELETE
$sql1 = "SELECT * FROM post WHERE post_id={$post_id};";
$result = mysqli_query($conn, $sql1) or die("Query Failed : select");
$row = mysqli_fetch_assoc($result);


unlink($row["upload/" . 'post_img']);


$sql = "DELETE FROM post WHERE post_id={$post_id};";
$sql .= "UPDATE category SET post = post-1 WHERE category_id = {$cat_id};";

if (mysqli_multi_query($conn, $sql)) {
    header("Location: http://localhost:84/mysite/php/CMS/admin/post.php");
    exit(); // Ensure script stops executing after redirect
} else {
    echo "Query Error: " . mysqli_error($conn); // Output specific error message
}
