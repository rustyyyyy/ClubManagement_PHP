<?php

include 'config/dbconfig.php';
// select qurey and execute 
$statement = $pdo->prepare('select * from branch');
$statement->execute();

$branch = $statement->fetchAll(PDO::FETCH_ASSOC);

$title = $_GET['title'] ?? null;
if ($title === 'delete') {

    $id = $_GET['id'] ?? null;
    if (!$id) {
        header('Location: index.php');
        exit;
    }

    $statement = $pdo->prepare("DELETE FROM branch WHERE (branch_id = :id);");
    $statement->bindValue(':id', $id);
    $statement->execute();
    header('Location: branch.php');
}
?>
