<?php
include "./database/dbconfig.php";


session_start();
session_unset();
session_destroy();

header("Location: http://localhost:84/mysite/php/CMS/admin/");
