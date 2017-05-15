<?php
//start new or resume existing session
session_start();
//register a session variable named userid
//and we're going to set its initial value to 0
if (!isset($_SESSION['userid'])) {

    $_SESSION['userid'] = 0;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <title>MyEvents - Events</title>

        <!-- Bootstrap Core CSS file -->
        <link rel="stylesheet" href="assets/css/bootstrap.css">

        <!-- Override CSS file - add your own CSS rules -->
        <link rel="stylesheet" href="assets/css/styles.css">


    </head>
    <body>

        <!-- include nav Bar html file -->
        <?php
        include'NavBarAfterLogin.html';
        ?>

        <!-- Page Content -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">

                    <!-- Page Heading -->
                    <h1>MyEvents - Events</h1>

                    <!-- Page breadcrumb -->
                    <ol class="breadcrumb">
                        <li><a href="createEvent.php">Create Event</a></li>
                        <li><a href="emailEvents.php">Email Events</a></li>
                        

                    </ol>
                    <hr>
                    <?php
                    //include database handler file so that we can
                    //call it's functions
                    include 'dbhandler.php';

                    //get the logged in user's userid SESSION variable
                    $userid = $_SESSION['userid'];
                    $target_path = "../uploads/";

                    //connecting to MySQL and selecting myevents database
                    $link = connect();

                    //inserting a record into the user table
                    $status = select_user_picture($link, $userid, $target_path);

                    //close connection to MySQL
                    close($link);
                    
                    // image and username will show on top of the table
                    echo '<img src="' . $target_path . $status . '">';
                    echo "<h3>" . $_SESSION['username'] . " Events " . "</h3>";
                    ?>


                    <div class="well">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>								
                                    <th>Name</th>
                                    <th>Location</th>
                                    <th>Date</th>
                                    <th>Description</th>

                                </tr>
                            </thead>
                            <tbody
                            <?php
                            //check if the user session variable is not equal to 0 -
                            //this means we have a valid user who has logged into Shopper
                            if ($_SESSION['userid'] != 0) {

                                //include database handler file so that we can
                                //call it's functions
                                //get the logged in user's userid SESSION variable
                                $userid = $_SESSION['userid'];


                                //connecting to MySQL and selecting shopper database
                                $link = connect();


                                $status = select_events($link, $userid);

                                //output html table rows that contains the retun
                                //from our create_user function
                                echo $status;
                                
                            

                                //close connection to MySQL
                                close($link);
                            }
                            ?>


                        </tbody>
                    </table> 
                </div>



                <hr>



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

