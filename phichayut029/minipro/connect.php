<?php
$con = mysqli_connect("localhost", "root", "", "mysql 029");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
mysqli_set_charset($con, "utf8");
?>