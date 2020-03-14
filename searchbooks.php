<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {



?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
  <!-- PWA icon  -->
  <link rel="apple-touch-icon" sizes="57x57" href="icons/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="icons/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="icons/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="icons/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="icons/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="icons/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="icons/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="icons/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="icons/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192" href="icons/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="icons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="icons/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="icons/favicon-16x16.png">
  <link rel="manifest" href="icons/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="icons/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
  <!-- PWA icon  -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Online Library Management System | Manage Issued Books</title>
        <!-- BOOTSTRAP CORE STYLE  -->
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <!-- FONT AWESOME STYLE  -->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- DATATABLE STYLE  -->
        <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
        <!-- CUSTOM STYLE  -->
        <link href="assets/css/style.css" rel="stylesheet" />
        <!-- GOOGLE FONT -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    </head>

    <body>
        <!------MENU SECTION START-->
        <?php include('includes/header.php'); ?>
        <!-- MENU SECTION END-->
        <div class="content-wrapper">
            <div class="container">
                <div class="row pad-botm">
                    <div class="col-md-12">
                        <h4 class="header-line">books' list</h4>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Books' List
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Book Name</th>
                                                    <th>Author </th>
                                                    <th>Publisher</th>
                                                    <th>Page Count</th>
                                                    <th>ISBN</th>
                                                    <th>Totle Amount</th>
                                                    <th>Current Books</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT * from booklist order by b_title";
                                                $query = $dbh->prepare($sql);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;

                                                if ($query->rowCount() > 0) {
                                                    foreach ($results as $result) {               ?>
                                                        <tr class="odd gradeX">
                                                            <td class="center"><?php echo htmlentities($cnt); ?></td>
                                                            <td class="center"><a  data-toggle="modal" data-target="#myModal<?php echo $cnt; ?>"><?php echo htmlentities($result->b_title); ?></a></td>
                                                            <td class="center"><?php echo htmlentities($result->b_author); ?></td>
                                                            <td class="center"><?php echo htmlentities($result->b_publisher); ?></td>
                                                            <td class="center"><?php echo htmlentities($result->b_pagecount); ?></td>
                                                            <td class="center"><?php echo htmlentities($result->b_isbn); ?></td>
                                                            <td class="center"><?php echo htmlentities($result->b_totle); ?></td>
                                                            <td class="center"><?php echo htmlentities($result->b_remain); ?></td>
                                                            <td class="center">
                                                                <?php
                                                                if (htmlentities($result->b_remain) <= 0) {
                                                                    echo "No exist book";}
                                                                    else {
                                                                echo "<i><a href='issuebook.php?isbn=" . htmlentities($result->b_isbn) .
                                                                "&sid=" . $_SESSION['stdid'] . "'><button class='btn btn-primary'>Issue</button></a></i>";
                                                                    }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <div class="container">
                                                <form method="post" action="#" class="form-horizontal" role="form" id="myForm<?php echo $cnt; ?>" onsubmit="return ">
                                                    <div class="modal fade" id="myModal<?php echo $cnt; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">

                                                                <div class="btn-info modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4>Book Details </h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form class="form-horizontal" role="form">
                                                                        <div class="form-group">
                                                                            <label class="col-sm-3 control-label" style="padding-top:7px">Book Name: </label>
                                                                            <div style="padding-top:7px">
                                                                                <?php echo htmlentities($result->b_title); ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="col-sm-3 control-label" style="padding-top:7px">Author Name: </label>
                                                                            <div style="padding-top:7px">
                                                                                <?php echo htmlentities($result->b_author); ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="col-sm-3 control-label" style="padding-top:7px">Category: </label>
                                                                            <div style="padding-top:7px">
                                                                                <?php echo htmlentities($result->b_category); ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="col-sm-3 control-label" style="padding-top:7px">Publisher: </label>
                                                                            <div style="padding-top:7px">
                                                                                <?php echo htmlentities($result->b_publisher); ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="col-sm-3 control-label" style="padding-top:7px">Publish Date: </label>
                                                                            <div style="padding-top:7px">
                                                                                <?php echo htmlentities($result->b_publishdate); ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="col-sm-3 control-label" style="padding-top:7px">ISBN: </label>
                                                                            <div style="padding-top:7px">
                                                                                <?php echo htmlentities($result->b_isbn); ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="col-sm-3 control-label" style="padding-top:7px">Describe: </label>
                                                                            <div style="padding-top:7px"><textarea rows="5" cols="100" class="col-sm-9 form-control well"><?php echo htmlentities($result->b_description); ?></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-info" data-dismiss="modal">Confirm</button>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                                <?php $cnt = $cnt + 1;
                                                    }
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>

        <!-- CONTENT-WRAPPER SECTION END-->
        <?php include('includes/footer.php'); ?>
        <!-- FOOTER SECTION END-->
        <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
        <!-- CORE JQUERY  -->
        <script src="assets/js/jquery-1.10.2.js"></script>
        <!-- BOOTSTRAP SCRIPTS  -->
        <script src="assets/js/bootstrap.js"></script>
        <!-- DATATABLE SCRIPTS  -->
        <script src="assets/js/dataTables/jquery.dataTables.js"></script>
        <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <!-- CUSTOM SCRIPTS  -->
        <script src="assets/js/custom.js"></script>

    </body>

    </html>
<?php } ?>