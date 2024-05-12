<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "news_site";

$conn = mysqli_connect($hostname, $username, $password, $database) or die("Database Error");

$locationhostname = "http://localhost:84/mysite/php/CMS/";
