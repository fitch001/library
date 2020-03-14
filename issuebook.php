<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {

    if (isset($_GET['isbn'])) {
        $isbn = $_GET['isbn'];
        $sid = $_GET['sid'];
        $query0 = "select b_remain from booklist where b_isbn = $isbn";
        $query = $dbh->prepare($query0);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);



        foreach ($results as $result) {
            $remain = htmlentities($result->b_remain);
            $newremain = $remain - 1;
            if ($newremain < 0) {
                echo "<script language=\"JavaScript\">\r\n";
                echo " alert(\"Sorry, this book do not have enough stock of this book in the library\");\r\n";
                echo " history.back();\r\n";
                echo "</script>";
            }   else {

                $sql3= "SELECT count(b_isbn) as num FROM tblissuedbookdetails WHERE StudentID = '$sid' AND ReturnStatus= '0' AND b_isbn = '$isbn'";
                $query3 = $dbh->prepare($sql3);
                $query3->execute();
                $results3 = $query3->fetchAll(PDO::FETCH_OBJ);
                foreach ($results3 as $result3) {
                    $num = htmlentities($result3->num);
                }
                if  ($num > 0) {
                    echo "<script language=\"JavaScript\">\r\n";
                    echo " alert(\"Sorry, You can not issue this book twice!!!!\");\r\n";
                    echo " history.back();\r\n";
                    echo "</script>";
                } else {
                $sql1 = "UPDATE booklist SET `b_remain` = '$newremain' WHERE `booklist`.`b_isbn` = $isbn";
                $query1 = $dbh->prepare($sql1);
                $query1->execute();

                $sql2 = "INSERT INTO  tblissuedbookdetails(StudentID,b_isbn) VALUES('$sid','$isbn')";
                $query2 = $dbh->prepare($sql2);
                $query2->execute();

                echo "<script language=\"JavaScript\">\r\n";
                echo " alert(\"You have issued this book successful\");\r\n";
                echo " history.back();\r\n";
                echo "</script>";
                }


            };
        }
    }
?>












<?php } ?>