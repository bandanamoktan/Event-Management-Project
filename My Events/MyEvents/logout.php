<?php
session_start();
$_SESSION['userid'] = 0;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <title>MyEvents</title>

        <!-- Bootstrap Core CSS file -->
        <link rel="stylesheet" href="assets/css/bootstrap.css">

        <!-- Override CSS file - add your own CSS rules -->
        <link rel="stylesheet" href="assets/css/styles.css">


    </head>
    <body>

        <!-- include nav Bar html file -->
        <?php
        include'NavBarBeforeLogin.html';
        ?>

        <!-- Page Content -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">



                    <!-- Page Heading -->
                    <h1>MyEvents - Come Back Soon!</h1>
                    <hr>



                    <!-- Page breadcrumb -->
                    <ol class="breadcrumb">
                        <li><a href="index.php">Home</a></li>

                    </ol>




                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->

        <!-- JQuery scripts -->
        <script src="assets/js/jquery-1.11.2.min.js"></script>

        <!-- Bootstrap Core scripts -->
        <script src="assets/js/bootstrap.min.js"></script>
    </body>
</html>
