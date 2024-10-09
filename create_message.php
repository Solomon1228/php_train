
<!DOCTYPE html>

<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Гостевая книга</title>
</head>
<body>
    <?php require __DIR__ . "/blocks/base.php" ?>
    
    <div class="contaner mt-5 px-5 mx-5 text-center">
    <h1>Добавление записи</h1>
    <form action="/send.php" method="post">
      
        <input type="text" name="name" id="name" class="form-control" placeholder="Введите имя"><br>
        <input type="email" name="email" id="email" class="form-control" placeholder="Введите почту"><br>
        <textarea name="message" id="message" class="form-control" placeholder="Введите сообщение"></textarea><br>
        <img src="/generate_captcha.php"><br>
        <input type="text" name="capcha" id="capcha" class="form-control mt-4" placeholder="Введите капчу"><br>
        <input type="submit" class="btn btn-success" value="Отправить"><br>
        <?php print($_SESSION); ?>
   
    </form>
</div>
</body>
</html>