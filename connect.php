<?php
$con = mysqli_connect("localhost", "root", "", "612797_yeticave");
mysqli_set_charset($con, "utf8");
if ($con === false) {
    print("Проблемы на сайте: " . mysqli_connect_error());
    exit();
}
?>
