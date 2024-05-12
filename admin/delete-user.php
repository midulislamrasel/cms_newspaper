<?php
include "../database/dbconfig.php";

$userID = $_GET['id'];

$sql = "DELETE FROM user WHERE user_id = $userID";

if (mysqli_query($conn, $sql)) {
    header("Location: {$locationhostname}admin/users.php");
} else {
    echo "Some Thing is Error";
}
