<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['add'])) {
        $bookname = addslashes($_POST['bookname']);
        $publisher = addslashes($_POST['publisher']);
        $author = addslashes($_POST['author']);
        $pagecount = $_POST['pagecount'];
        $isbn = $_POST['isbn'];
        $price = $_POST['price'];
        $remain = $_POST['remain'];
        $totle = $_POST['totle'];
        $bookid = $_POST['bookid'];
        $description = addslashes($_POST['description']);
        $category = addslashes($_POST['category']);
        $publishdate = $_POST['publishdate'];
        $sql = "INSERT INTO booklist (b_title, b_author, b_price, b_isbn, b_description, b_publisher, b_pagecount, b_category, b_publishdate, b_totle, b_remain) VALUES ('$bookname', '$author', '$price','$isbn', '$description', '$publisher', '$pagecount', '$category', '$publishdate', '$remain', '$totle')";
        $query = $dbh->prepare($sql);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            $_SESSION['msg'] = "Book Listed successfully";
            header('location:manage-books.php');
        } else {
            $_SESSION['error'] = "Something went wrong. Please try again";
            header('location:manage-books.php');
        }
    }
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
        <title>Online Library Management System | Add Book</title>
        <!-- BOOTSTRAP CORE STYLE  -->
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <!-- FONT AWESOME STYLE  -->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLE  -->
        <link href="assets/css/style.css" rel="stylesheet" />
        <!-- GOOGLE FONT -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    </head>

    <body>
        <!------MENU SECTION START-->
        <?php include('includes/header.php'); ?>
        <!-- MENU SECTION END-->
        <div class="content-wra
    <div class=" content-wrapper">
            <div class="container">
                <div class="row pad-botm">
                    <div class="col-md-12">
                        <h4 class="header-line">Add Book</h4>

                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"">
<div class=" panel panel-info">
                        <div class="panel-heading">
                            Book Info
                        </div>
                        <div class="panel-body">
                            <form role="form" method="post">


                                <div class="form-group">
                                    <label>Book Name<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="bookname" value="" required />
                                </div>
                                <div class="form-group">
                                    <label>Author Name<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="author" value="" required />
                                </div>
                                <div class="form-group">
                                    <label>Category<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="category" value="" required="required" />
                                </div>
                                <div class="form-group">
                                    <label>Pagecount<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="pagecount" value="" required />
                                </div>
                                <div class="form-group">
                                    <label>ISBN Number<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="isbn" value="" required="required" />
                                    <p class="help-block">An ISBN is an International Standard Book Number.ISBN Must be unique</p>
                                </div>
                                <div class="form-group">
                                    <label>Publisher<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="publisher" value="" required />
                                </div>
                                <div class="form-group">
                                    <label>Publishdate<span style="color:red;">*</span></label>
                                    <input class="form-control" type="date" name="publishdate" value="" required="required" />
                                </div>
                                <div class="form-group">
                                    <label>Price<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="price" value="" required="required" />
                                </div>
                                <div class="form-group">
                                    <label>Totle<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="totle" value="" required="required" />
                                </div>
                                <div class="form-group">
                                    <label>Remain<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="remain" value="" required="required" />
                                </div>
                                <div class="form-group">
                                    <label>Description<span style="color:red;">*</span></label>
                                    <textarea rows="9" cols="20" class="form-control" type="text" name="description" required="required"></textarea>
                                </div>

                                <button type="submit" name="add" class="btn btn-info">Add </button>

                            </form>
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
        <!-- CUSTOM SCRIPTS  -->
        <script src="assets/js/custom.js"></script>
    </body>

    </html>
<?php } ?>