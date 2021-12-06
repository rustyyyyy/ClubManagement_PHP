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
<?php include 'include/header.php' ?>
<title>Branch</title>
<link href="resource/css/styles.css" rel="stylesheet" />
<script data-search-pseudo-elements defer src="resource/js/all.min.js"></script>
<script src="resource/js/feather.min.js"></script>
</head>

<body>
    <?php include 'include/navbar.php' ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="page-header">
                <div class="container-fluid">
                    <div class="page-header-content pb-2">
                        <h1 class="page-header-title">
                            <span> <Span style="text-transform: uppercase;">
                                    <?php echo $title ?>
                                </Span> Member</span>
                        </h1>

                    </div>
                    <?php if (!empty($errors)) : ?>
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="alert alert-danger">
                                    <?php foreach ($errors as $error) : ?>
                                        <div><?php echo $error ?></div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>


            <!--Start Table-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card ">
                            <div class="card-body">
                                <form method="post" enctype="multipart/form-data">

                                    <div class="form-group">
                                        <label> Name</label>
                                        <input type="text" name="name" value="<?php if ($title === 'edit') {
                                                                                            echo $branch_name;
                                                                                        } ?>" class="form-control" placeholder="Enter Name">
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="address" name="address" value="<?php if ($title === 'edit') {
                                                                                        echo $address;
                                                                                    } ?>" class="form-control checking_email" placeholder="Enter Address">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" value="<?php if ($title === 'edit') {
                                                                                    echo $email;
                                                                                } ?>" class="form-control" placeholder="Enter Email">
                                        <small class="error_email" style="color: red;"></small>
                                    </div>
                                    <div class="form-group">
                                        <label>Contact Details</label>
                                        <input type="text" name="contact_details" value="<?php if ($title === 'edit') {
                                                                                                echo $contact_details;
                                                                                            } ?>" class="form-control" placeholder="Enter Contact Details">
                                    </div>
                                    <a href="member.php" class="btn btn-dark mr-2 my-1"> Cancel </a>
                                    <button type="submit" class="btn btn-primary">Submit</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Table-->
        </main>
    </div>

    <?php include 'include/script.php' ?>

</body>

</html>