<?php
error_reporting(0);
$db_host = 'localhost';
$db_user = 'root';
$db_password = 'root';
$db_name = 'guest_book';

$link = mysqli_connect($db_host, $db_user, $db_password, $db_name);
if (!$link) {
    die('<p style="color:red">'.mysqli_connect_errno().' - '.mysqli_connect_error().'</p>');
}

mysqli_set_charset($link, "utf8")

// echo "Успешное подключение к БД"
?>