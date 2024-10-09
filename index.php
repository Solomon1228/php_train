<?php
require_once __DIR__ . '/blocks/connect.php';

$sort_list = array(
'user_name' => '`user_name`',
'user_name desc' => '`user_name` DESC',
'user_email' => 'user_email',
'user_email desc' => 'user_email DESC',
'created_date' => 'created_date',
'created_date desc' => '`created_date` DESC',
);


$sort = @$_GET['sort'];
if (array_key_exists($sort, $sort_list)) {
	$sort_sql = $sort_list[$sort];
} else {
	$sort_sql = reset($sort_list);
}
function sort_link_th($title, $a, $b, $page) {
    $sort = @$_GET['sort'];
    if ($sort == $a) {
        return '<a class="active" href="index.php?page=' . $page . '&sort=' . $b . '">' . $title . ' <i>▲</i></a>';
    } elseif ($sort == $b) {
        return '<a class="active" href="index.php?page=' . $page . '&sort=' . $a . '">' . $title . ' <i>▼</i></a>';  
    } else {
        return '<a href="index.php?page=' . $page . '&sort=' . $a . '">' . $title . '</a>';  
    }
}

// Определим собственный класс исключений для ошибок MySQL
class MySQL_Exception extends Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}
?>


<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Гостевая книга</title>
</head>

<body>
    <?php require __DIR__ . "/blocks/base.php"; ?>
<?php 
$page = isset($_GET["page"]) ? (int) $_GET["page"] : 1;
$sort_sql = isset($_GET["sort"]) ? $_GET["sort"] : "id DESC";
$LIMIT = 5;
//$sort = isset($_GET["sort"]) ? $_GET["sort"] : 'id';
$offset = ($page - 1) * $LIMIT;
$result = $link->query('SELECT * FROM guest_book.book ORDER BY ' . $sort_sql . ' LIMIT  ' . $offset . ',' . $LIMIT );
$data = [];
//print($sort_sql);
$total = $link->query('SELECT CEIL(COUNT(*)/' . $LIMIT . ') FROM guest_book.book ')->fetch_row();
$total_pages = $total[0];
?>

<div class="container mt-5 px-5 ">
    <h2 class="border-bottom pb-2 mb-0">Сообщения пользователей</h2>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th><?php print(sort_link_th('Имя', 'user_name', 'user_name desc', $page)); ?></th>
                <th><?php print(sort_link_th('Почта', 'user_email', 'user_email desc', $page)); ?></th>
                <th scope="col">Текст</th>
                <th><?php print(sort_link_th('Дата создания', 'created_date', 'created_date desc', $page)); ?></th>
            </tr>
        </thead>
        <?php


            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            foreach ($data as $row):
                ?>

                <tbody>
                    <tr>
                        <th scope="row"><?php print($row['id'])  ?></th>
                        <td><?php print ($row['user_name']) ?></td>
                        <td><?php print ($row['user_email']) ?></td>
                        <td><?php print ($row['user_message']) ?></td>
                        <td><?php print ($row['created_date']) ?></td>

                    </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
        <nav aria-label="...">
            <ul class="pagination">
                <li class="page-item <?php print ($page == 1 ? 'disabled' : '') ?>">
                    <a class="page-link" href="index.php?page=<?php print ($page - 1) ?>&sort=<?php print($sort_sql) ?>">Previous</a>
                </li>
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php print ($page == $i ? 'active' : '') ?>" aria-current="page">
                        <a class="page-link" href="index.php?page=<?php print ($i) ?>&sort=<?php print($sort_sql) ?>"><?php print ($i); ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?php print ($page == $total_pages ? 'disabled' : '') ?>">
                    <a class="page-link" href="index.php?page=<?php print ($page + 1) ?>&sort=<?php print($sort_sql) ?>">Next</a>
                </li>
            </ul>
        </nav>
    </div>

</body>

</html>