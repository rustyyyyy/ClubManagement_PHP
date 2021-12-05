<?php
$title = $_GET['title'];

if ($title === 'add') {
    include 'config/dbconfig.php';

    $result = "";
    $errors = [];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $branch_name = $_POST['branch_name'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $contact_details = $_POST['contact_details'];

        if (!$branch_name) {
            $errors[] = 'branch name is required';
        }
        if (!$address) {
            $errors[] = 'branch name is required';
        }

        if (empty($errors)) {
            $statement = $pdo->prepare("
                                INSERT INTO branch (`branch_name`, `address`, `email`, `contact_details`)
                                VALUES (:branch_name,:address,:email,:contact_details);");

            $statement->bindValue(':branch_name', $branch_name);
            $statement->bindValue(':address', $address);
            $statement->bindValue(':email', $email);
            $statement->bindValue(':contact_details', $contact_details);

            if ($statement->execute()) {
                $result = "success";
                header('Location: branch.php');
            }
        }
    }
}

if ($title === 'edit') {
    $id = $_GET['id'] ?? null;

    if (!$id) {
        header('Location: index.php');
        exit;
    }

   include 'config/dbconfig.php';

    $statement = $pdo->prepare("select * from branch where branch_id = :id");
    $statement->bindValue(':id', $id);
    $statement->execute();
    $branch = $statement->fetch(PDO::FETCH_ASSOC);

    $branch_name = $branch['branch_name'];
    $address = $branch['address'];
    $email = $branch['email'];
    $contact_details = $branch['contact_details'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $branch_name = $_POST['branch_name'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $contact_details = $_POST['contact_details'];

        if (!$branch_name) {
            $errors[] = 'branch name is required';
        }
        if (!$address) {
            $errors[] = 'branch name is required';
        }

        if (empty($errors)) {

            $statement = $pdo->prepare("UPDATE branch SET branch_name = :branch_name, address = :address, email=:email, contact_details= :contact_details
            WHERE (branch_id = :id)");

            $statement->bindValue(':branch_name', $branch_name);
            $statement->bindValue(':address', $address);
            $statement->bindValue(':email', $email);
            $statement->bindValue(':contact_details', $contact_details);
            $statement->bindValue(':id', $id);

            $statement->execute();

            header('Location: branch.php');
        }
    }
}
?>