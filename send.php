<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Проверка капчи</title>
</head>

<body>
    <?php
    require __DIR__ . "/blocks/base.php";
    require_once __DIR__ . "/blocks/connect.php";

    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $ip = $_SERVER['REMOTE_ADDR'];
    $browser = $_SERVER['HTTP_USER_AGENT'];

    if ($_POST['capcha'] == $_SESSION['capcha']) {
        $query = "INSERT INTO guest_book.book (user_name, user_email, user_message, user_ip, user_browser) VALUES ('$name', '$email', '$message' , '$ip', '$browser')";

        if ($link->query($query)) {
            echo "Данные успешно добавлены";
        } else {
            echo "Ошибка: " . $link->error;
        }
    } else {
        echo "Капча введена неверно";
    }
    ?>

</body>

</html>