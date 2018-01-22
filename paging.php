<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'test');
define('DB_PASSWORD', 'test');
define('DB_NAME', 'dotinstall_paging_php');
define('COMMENTS_PER_PAGE', 5);

error_reporting(E_ALL & ~E_NOTICE);

// if(preg_match('/^[1-9][0-9]*$/' ,$_GET['page'])) {
//     $page =(int)$_GET['page'];
// }else {
//     $page = 1;
// }
if(preg_match('/^[1-9][0-9]*$/' ,$_GET['page'])){
$page = (int)$_GET['page'];
}else{
  $page = 1;
}

try {
    $dbh = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASSWORD);
} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}

$offset = COMMENTS_PER_PAGE * ($page - 1);
$sql = "select * from comments limit ".$offset.",".COMMENTS_PER_PAGE;
$comments = array();
foreach ($dbh->query($sql) as $row) {
    array_push($comments, $row);
}
var_dump($_GET);
$total = $dbh->query("select count(*) from comments")->fetchColumn();
$totalPage = ceil($total / COMMENTS_PER_PAGE);

?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>コメント一覧</title>
</head>
<body>
    <h1>コメント一覧</h1>

    <ul>
    <?php foreach($comments as $comment) :?>
    <li><?php echo htmlspecialchars($comment['comment'],ENT_QUOTES,'UTF-8');?></li>
    <?php endforeach;?>
    </ul>
    <?php if($page > 1) : ?>
    <a href="?page=<?php echo $page-1; ?>">前へ</a>
    <?php endif; ?>
    <?php for($i =1; $i<=$totalPage; $i++) :?>
    <a href="?page=<?php echo $i; ?>"><?php echo $i;?></a>
    <?php endfor;?>

    <?php if($totalPage>$page): ?>
    <a href="?page=<?php echo $page + 1; ?>">次へ</a>
    <?php endif?>

</body>
</html>
