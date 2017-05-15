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

                    <!-- Page Heading -->
                    <h1> MyEvents - Create  </h1>

                    <!-- Page breadcrumb -->
                    <ol class="breadcrumb">
                        <li><a href="createParticipant.php">Create Participant</a></li>

                    </ol>

                    <hr>

                    <!-- Create Participant Form -->

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
                    
                   //image and username will show on top of the table
                    echo '<img src="' . $target_path . $status . '">';
                    echo "<h3>" . " Create A Participant " . $_SESSION['username'] . "</h3>";
                    ?>

                    <div class="well">
                        <form name="createName" id="createName" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
                            <div class="form-group">
                                <label for="participantName">Full Name</label>
                                <input name="participantName" type="text" class="form-control" id="eventName" placeholder="Enter a name" required="" maxlength="100">
                            </div>
                            <div class="form-group">
                                <label for="participantEmail">Email Address</label>
                                <input name="participantEmail" type="text" class="form-control" id="eventLocation" placeholder="Enter email address" required="" maxlength="100">
                                <p>Make sure you use a valid email address</p>
                            </div>

                            <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                        </form>
                        <?php
                        //check to see if the submit button was pushed
                        if ((isset($_POST['submit']))) {

                            //include database handler file so that we can
                            //call it's functions
                            include 'dbHandler.php';

                            //getting data input into the form and assigning
                            //it to variables
                            $participantName = $_POST['participantName'];
                            $participantEmail = $_POST['participantEmail'];

                            //get the logged in user's userid SESSION variable
                            $userid = $_SESSION['userid'];

                            //connecting to MySQL and selecting myevent database
                            $link = connect();
                            //inserting a record into the participants table
                            $status = create_participants($link, $participantName, $participantEmail, $userid);

                            //output an html paragraph that contains the retun
                            //from our create_participant function
                            echo '<p class="help-block">' . $status . '</p>';

                            //close connection to MySQL
                            close($link);
                        }
                        ?>
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
