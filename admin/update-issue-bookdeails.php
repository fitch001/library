<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['return'])) {
        $rid = intval($_GET['rid']);


        $rstatus = 1;
        $sql = "update tblissuedbookdetails set fine=:fine,ReturnStatus=:rstatus where iss_id=:rid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':rid', $rid, PDO::PARAM_STR);
        $query->bindParam(':fine', $fine, PDO::PARAM_STR);
        $query->bindParam(':rstatus', $rstatus, PDO::PARAM_STR);
        $query->execute();

        $_SESSION['msg'] = "Book Returned successfully";
        header('location:manage-issued-books.php');
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
        <title>Online Library Management System | Issued Book Details</title>
        <!-- BOOTSTRAP CORE STYLE  -->
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <!-- FONT AWESOME STYLE  -->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLE  -->
        <link href="assets/css/style.css" rel="stylesheet" />
        <!-- GOOGLE FONT -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
        <script>
            // function for get student name
            function getstudent() {
                $("#loaderIcon").show();
                jQuery.ajax({
                    url: "get_student.php",
                    data: 'studentid=' + $("#studentid").val(),
                    type: "POST",
                    success: function(data) {
                        $("#get_student_name").html(data);
                        $("#loaderIcon").hide();
                    },
                    error: function() {}
                });
            }

            //function for book details
            function getbook() {
                $("#loaderIcon").show();
                jQuery.ajax({
                    url: "get_book.php",
                    data: 'bookid=' + $("#bookid").val(),
                    type: "POST",
                    success: function(data) {
                        $("#get_book_name").html(data);
                        $("#loaderIcon").hide();
                    },
                    error: function() {}
                });
            }
        </script>
        <style type="text/css">
            .others {
                color: red;
            }
        </style>


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
                        <h4 class="header-line">Issued Book Details</h4>

                    </div>

                </div>
                <div class="row">
                    <div class="col-md-10 col-sm-6 col-xs-12 col-md-offset-1"">
<div class=" panel panel-info">
                        <div class="panel-heading">
                            Issued Book Details
                        </div>
                        <div class="panel-body">
                            <form role="form" method="post">
                                <?php
                                $rid = intval($_GET['rid']);
                                $sql = "SELECT tblissuedbookdetails.ReturnStatus, tblissuedbookdetails.b_isbn, tblissuedbookdetails.iss_id, tblissuedbookdetails.StudentID, tblissuedbookdetails.IssuesDate, tblissuedbookdetails.ReturnDate, tblissuedbookdetails.fine, booklist.b_title, booklist.b_isbn from tblissuedbookdetails join booklist on tblissuedbookdetails.b_isbn = booklist.b_isbn where tblissuedbookdetails.iss_id='$rid'";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                $cnt = 1;

                                if ($query->rowCount() > 0) {
                                    foreach ($results as $result) {        
                                        $date1 = strtotime(date('Y-m-d H:i:s', time()));
                                        $date2 = strtotime(htmlentities($result->IssuesDate));
                                        $date3 = $date1-$date2;
                                        $date4 = intval($date3 / 86400);
                                        $date = $date4 - 14;
                                        //echo $date;
                                        if ($date > 2) {
                                            $fine = $date * 0.5;
                                        } else {
                                            $fine = 0;
                                        };
                                               ?>




                                        <div class="form-group">
                                            <label>Student ID :</label>
                                            <?php echo htmlentities($result->StudentID); ?>
                                        </div>

                                        <div class="form-group">
                                            <label>Book Name :</label>
                                            <?php echo htmlentities($result->b_title); ?>
                                        </div>


                                        <div class="form-group">
                                            <label>ISBN :</label>
                                            <?php echo htmlentities($result->b_isbn); ?>
                                        </div>

                                        <div class="form-group">
                                            <label>Book Issued Date :</label>
                                            <?php echo htmlentities($result->IssuesDate); ?>
                                        </div>


                                        <div class="form-group">
                                            <label>Book Returned Date :</label>
                                            <?php if ($result->ReturnDate == "") {
                                                echo htmlentities("Not Return Yet");
                                            } else {


                                                echo htmlentities($result->ReturnDate);
                                            }
                                            ?>
                                        </div>

                                        <div class="form-group">
                                            <label>Fine (in GBP) :</label>
                                            <?php
                                                echo $fine ."￡ (Two weeks free and 0.5￡ per day for extra time)";
                                            ?>
                                        </div>
                                        <?php if ($result->ReturnStatus == 0) {
                                            ?>

                                            
                                            <button type="submit" name="return" id="submit" class="btn btn-info">Return Book </button>

                        </div>

            <?php }
                                    }
                                } ?>
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