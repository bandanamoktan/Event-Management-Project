<?php
session_start();

if (!isset($_SESSION['userid'])) {
    $_SESSION['userid'] = 0;
}
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
        <!-- Include Nav Bar HTML -->
        <?php
        include 'navBarAfterLogin.html';
        ?>



        <!-- Page Content -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">

                    <!-- Page breadcrumb -->
                    <ol class="breadcrumb">
                        <?php
                        include 'dbhandler.php';
                        
                    //get the logged in user's userid SESSION variable
                    $userid = $_SESSION['userid'];
                    $target_path = "../uploads/";

                    //connecting to MySQL and selecting myevents database
                    $link = connect();

                    //inserting a record into the user table
                    $status = select_user_picture($link, $userid, $target_path);
                    
                 
                    close($link);
                   
                     echo '<img src="' . $target_path . $status . '">';
                        $participantName = filter_input(INPUT_GET, 'participantName');

                        echo '<li><a href="addParticipantToEvent.php?participantName=' . $participantName . '">Add Participants</a></li>';
                        ?>

                    </ol>

                    <!-- Page Heading -->
                    <h1>MyEvents - Add Participant To Event</h1>
                    <hr>



                    <!-- Add Item To shopping List Form -->
                    <?php
                    if ($_SESSION['userid'] != 0) {

                        //include database handler file so that we can
                        //call it's functions
                        include 'dbHandler.php';


                        //get the logged in lists listid SESSION variable
                        $participantName = filter_input(INPUT_GET, 'participantName');

                        //connecting to MySQL and selecting shopper database
                        $link = connect();

                        $status = select_participant_name($link, $participantName);

                        //output html table rows that contains the retun
                        //from our create_user function
                        echo '<h3>Add Participant To ' . $status . '</h3>';

                        //close connection to MySQL
                        close($link);
                    }
                    ?>


                    <div class="well">
                        <form name="createName" id="createName" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
                            <div class="form-group">
                                <label for="participantName">Participants</label>

                                <select name="participant_id" id="participantName" class="form-control"></select>
                            </div>


                            <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                        </form>

                        <?php
                        //check if the user session variable is not equal to 0 -
                        //this means we have a valid user who has logged into Shopper
                        if ($_SESSION['userid'] != 0) {




                            //get the logged in user's userid SESSION variable
                            $userid = $_SESSION['userid'];

                            //connecting to MySQL and selecting shopper database
                            $link = connect();

                            $status = events_participants($link, $event_id, $participant_id, $userid);

                            //output html table rows that contains the retun
                            //from our create_user function
                            echo '<p class="help-block">' . $status . '</p>';

                            //close connection to MySQL
                            close($link);
                        }
                        ?>

                        </select>





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

