<?php



$title = $_GET['title'];

if ($title === 'add') {
    include 'config/dbconfig.php';

    $result = "";
    $errors = [];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $name = $_POST['name'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];

        $designation_id = $_POST['designation_id'];
        $branch_id = $_POST['branch_id'];

        if (!$name) {
            $errors[] = ' name is required';
        }
        if (!$phone_number) {
            $errors[] = 'phone_number is required';
        }

        if (empty($errors)) {
            $statement = $pdo->prepare("INSERT INTO `members` (`designation_id`, `name`, `address`, `email`, `phone_number`, `branch_id`)
            VALUES (:designation_id, :name, :address, :email, :phone_number, :branch_id);");

            $statement->bindValue(':name', $name);
            $statement->bindValue(':address', $address);
            $statement->bindValue(':email', $email);
            $statement->bindValue(':phone_number', $phone_number);

            $statement->bindValue(':branch_id', $branch_id);
            $statement->bindValue(':designation_id', $designation_id);

            $statement->execute();

            header('Location: member.php');
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

    $statement = $pdo->prepare("select * from members where member_id = :id");
    $statement->bindValue(':id', $id);
    $statement->execute();
    $members = $statement->fetch(PDO::FETCH_ASSOC);

    $name = $members['name'];
    $address = $members['address'];
    $email = $members['email'];
    $phone_number = $members['phone_number'];

    $designation_id = $members['designation_id'];
    $branch_id = $members['branch_id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $name = $_POST['name'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];

        $designation_id = $_POST['designation_id'];


        echo $designation_id;

        $branch_id = $_POST['branch_id'];

        if (!$name) {
            $errors[] = ' name is required';
        }
        if (!$phone_number) {
            $errors[] = 'phone_number is required';
        }

        if (empty($errors)) {

            $statement = $pdo->prepare("UPDATE members SET name = :name, address = :address, email=:email, phone_number= :phone_number,
            designation_id = :designation_id, branch_id = :branch_id
            WHERE (member_id = :id)");

            $statement->bindValue(':name', $name);
            $statement->bindValue(':address', $address);
            $statement->bindValue(':email', $email);
            $statement->bindValue(':phone_number', $phone_number);

            $statement->bindValue(':branch_id', $branch_id);
            $statement->bindValue(':designation_id', $designation_id);
            $statement->bindValue(':id', $id);

            $statement->execute();

            header('Location: member.php');
        }
    }
}


include 'config/dbconfig.php';

$statement = $pdo->prepare('select designation_id,  designation_name from designation');
$statement->execute();
$designation = $statement->fetchAll(PDO::FETCH_ASSOC);


function getDeginationName($designationId)
{
    include 'config/dbconfig.php';

    $statement = $pdo->prepare('select designation_name from designation where designation_id = :id');
    $statement->bindValue(':id', $designationId);
    $statement->execute();
    $designation = $statement->fetchAll(PDO::FETCH_ASSOC);

    foreach ($designation as $val) {
        echo $val['designation_name'];
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
                                                                                    echo $name;
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
                                        <input type="text" name="phone_number" value="<?php if ($title === 'edit') {
                                                                                            echo $phone_number;
                                                                                        } ?>" class="form-control" placeholder="Enter Contact Details">
                                    </div>

                                    <div class="form-group">
                                        <label>Designation ID </label>
                                        <select class="form-control " name="designation_id"  onclick="document.getElementById('myDIV').style.display = 'none';">

                                            
                                            <?php foreach ($designation as $designation) : ?>

                                                <option value="<?php echo $designation['designation_id'] ?>">
                                                    <?php echo $designation['designation_name'] ?>
                                                </option>

                                            <?php endforeach; ?>

                                            <option selected id="myDIV">
                                                <?php if ($title === 'edit') {
                                                    getDeginationName($designation_id);
                                                }
                                                ?>
                                            </option>

                                        </select>
                                    </div>



                                    <div class="form-group">
                                        <label>Branch ID </label>
                                        <input type="text" name="branch_id" value="<?php if ($title === 'edit') {
                                                                                        echo $branch_id;
                                                                                    } ?>" class="form-control" placeholder="Enter branch_id">
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