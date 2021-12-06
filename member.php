<?php

include 'config/dbconfig.php';
$statement = $pdo->prepare('select * from members');
$statement->execute();

$members = $statement->fetchAll(PDO::FETCH_ASSOC);

function deginationName($designationId)
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

function brandName($branch_id)
{
    include 'config/dbconfig.php';

    $statement = $pdo->prepare('select branch_name from branch where branch_id = :id');
    $statement->bindValue(':id', $branch_id);
    $statement->execute();
    $branch = $statement->fetchAll(PDO::FETCH_ASSOC);

    foreach ($branch as $val) {
        echo $val['branch_name'];
    }
}

?>
<?php include 'include/header.php' ?>
<title>Branch</title>
<link href="resource/css/styles.css" rel="stylesheet" />
<script data-search-pseudo-elements defer src="js/all.min.js"></script>
<script src="js/feather.min.js"></script>
</head>

<body>
    <?php include 'include/navbar.php' ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="page-header">
                <div class="container-fluid">
                    <div class="page-header-content d-flex align-items-center justify-content-between text-white">
                        <h1 class="page-header-title">
                            <span>Members list</span>
                        </h1>
                        <a href="branch-form.php?title=add" title="Add new category" class="btn btn-white">
                            <div class="page-header-icon"><i data-feather="plus"></i></div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="container-fluid ">

                <div class="card mb-4">
                    <div class="card-header">All Members</div>
                    <div class="card-body">
                        <div class="datatable table-striped table-responsive">
                            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Designation</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Email</th>
                                        <th>Phone number</th>
                                        <th>Branch</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($members as $i => $member) : ?>
                                        <tr>
                                            <td><?php echo $i + 1 ?></td>

                                            <td>
                                                <?php
                                                deginationName($member['designation_id'])
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo $member['name'] ?>
                                            </td>
                                            <td>
                                                <?php echo $member['address'] ?>
                                            </td>
                                            <td>
                                                <?php echo $member['email'] ?>
                                            </td>
                                            <td>
                                                <?php echo $member['phone_number'] ?>
                                            </td>
                                            <td>
                                                <?php 
                                                brandName($member['branch_id'])
                                                ?>
                                            </td>

                                            <td>
                                                <button class="btn btn-blue btn-icon"><i data-feather="edit"></i></button>
                                            </td>
                                            <td>
                                                <button class="btn btn-red btn-icon"><i data-feather="trash-2"></i></button>
                                            </td>

                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>

        </main>
    </div>

    <?php include 'include/script.php' ?>

</body>

</html>