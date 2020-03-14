<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['update'])) {
        $bookname = addslashes($_POST['bookname']);
        $publisher = addslashes($_POST['publisher']);
        $author = addslashes($_POST['author']);
        $pagecount = $_POST['pagecount'];
        $isbn = $_POST['isbn'];
        $price = $_POST['price'];
        $bookid = $_POST['bookid'];
        $description = addslashes($_POST['description']);
        $category = addslashes($_POST['category']);
        $publishdate = $_POST['publishdate'];
        $sql = "update  booklist set b_title='$bookname',b_author='$author',b_price='$price',b_isbn='$isbn',b_description='$description',b_publisher='$publisher',b_pagecount='$pagecount', b_category='$category',b_publishdate='$publishdate' where b_id='$bookid'";
        $query = $dbh->prepare($sql);
        $query->execute();
        //echo $sql;
        $_SESSION['msg'] = "Book info updated successfully";
        header('location:manage-books.php');
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
        <title>Online Library Management System | Edit Book</title>
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
                                <?php
                                $bookid = intval($_GET['bookid']);
                                $sql = "SELECT * from booklist where b_id = '$bookid'";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                $cnt = 1;
                                if ($query->rowCount() > 0) {
                                    foreach ($results as $result) {               ?>

                                        <div class="form-group">
                                            <label>Book Name<span style="color:red;">*</span></label>
                                            <input class="form-control" type="hidden" name="bookid" value="<?php echo $bookid; ?>" required />
                                            <input class="form-control" type="text" name="bookname" value="<?php echo htmlentities($result->b_title); ?>" required />
                                        </div>
                                        <div class="form-group">
                                            <label>Author Name<span style="color:red;">*</span></label>
                                            <input class="form-control" type="text" name="author" value="<?php echo htmlentities($result->b_author); ?>" required />
                                        </div>
                                        <div class="form-group">
                                            <label>Price<span style="color:red;">*</span></label>
                                            <input class="form-control" type="text" name="category" value="<?php echo htmlentities($result->b_category); ?>" required="required" />
                                        </div>
                                        <div class="form-group">
                                            <label>Pagecount<span style="color:red;">*</span></label>
                                            <input class="form-control" type="text" name="pagecount" value="<?php echo htmlentities($result->b_pagecount); ?>" required />
                                        </div>
                                        <div class="form-group">
                                            <label>ISBN Number<span style="color:red;">*</span></label>
                                            <input class="form-control" type="text" name="isbn" value="<?php echo htmlentities($result->b_isbn); ?>" required="required" />
                                            <p class="help-block">An ISBN is an International Standard Book Number.ISBN Must be unique</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Publisher<span style="color:red;">*</span></label>
                                            <input class="form-control" type="text" name="publisher" value="<?php echo htmlentities($result->b_publisher); ?>" required />
                                        </div>
                                        <div class="form-group">
                                            <label>Publishdate<span style="color:red;">*</span></label>
                                            <input class="form-control" type="text" name="publishdate" value="<?php echo htmlentities($result->b_publishdate); ?>" required="required" />
                                        </div>
                                        <div class="form-group">
                                            <label>Price<span style="color:red;">*</span></label>
                                            <input class="form-control" type="text" name="price" value="<?php echo htmlentities($result->b_price); ?>" required="required" />
                                        </div>
                                        <div class="form-group">
                                            <label>Description<span style="color:red;">*</span></label>
                                            <textarea rows="9" cols="20" class="form-control" type="text" name="description" required="required"><?php echo htmlentities($result->b_description); ?></textarea>
                                        </div>
                                <?php }
                                } ?>
                                <button type="submit" name="update" class="btn btn-info">Update </button>

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