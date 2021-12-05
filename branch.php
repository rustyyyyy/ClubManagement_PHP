<?php include 'config/branch/branch.php' ?>
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
                            <span>Branch list</span>
                        </h1>
                        <a href="branch-form.php?title=add" title="Add new category" class="btn btn-white">
                            <div class="page-header-icon"><i data-feather="plus"></i></div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="container-fluid ">

                <div class="card mb-4">
                    <div class="card-header">All branches</div>
                    <div class="card-body">
                        <div class="datatable table-responsive">
                            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Branch Name</th>
                                        <th>Address</th>
                                        <th>Email</th>
                                        <th>Contact Details</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                        <th>Committee</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($branch as $i => $branch) : ?>
                                        <tr>
                                            <td> <?php echo $i + 1 ?></td>

                                            <td><?php echo $branch['branch_name'] ?> </td>
                                            <td><?php echo $branch['address'] ?> </td>
                                            <td><?php echo $branch['email'] ?> </td>
                                            <td><?php echo $branch['contact_details'] ?> </td>

                                            <td>
                                                <a href="branch-form.php?title=edit&id=<?php echo $branch['branch_id'] ?>" class="btn btn-blue btn-icon"><i data-feather="edit"></i></a>
                                            </td>
                                            <td>
                                                <a href="branch.php?title=delete&id=<?php echo $branch['branch_id'] ?>" class="btn btn-red btn-icon"><i data-feather="trash-2"></i></a>
                                            </td>
                                            <td>
                                                <button class="btn btn-cyan btn-icon"><i data-feather="eye"></i></button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- <div class="row">
                    <div class="col-lg-4">
                        <div class="card mb-2">
                            <div class="card-header bg-red text-white">
                                <span> Branch Data Deleted Successfully! <span>
                            </div>
                        </div>
                    </div>
                </div> -->

            </div>

        </main>
    </div>

    <?php include 'include/script.php' ?>

</body>

</html>