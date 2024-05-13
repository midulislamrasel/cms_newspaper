<?php
include "../database/dbconfig.php";

$userID = $_GET['id'];

$sql = "DELETE FROM user WHERE user_id = $userID";

if (mysqli_query($conn, $sql)) {
    header("Location: {$locationhostname}admin/users.php");
} else {
    echo "Some Thing is Error";
}

// ========================user========
if ($_SESSION['user_role'] == 0) {
    header("Location: http://localhost:84/mysite/php/CMS/admin/post.php");
}
