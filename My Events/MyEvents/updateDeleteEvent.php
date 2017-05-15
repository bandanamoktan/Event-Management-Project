<?php
session_start();
if (!isset($_SESSION['userid']) || ($_SESSION['userid'] == 0)){
    header('Location: login.php');
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
                    <h1>MyEvents - Update/Delete Event</h1>
                    <hr>

                    <!-- Page breadcrumb -->
                    <ol class="breadcrumb">
                        <li><a href="addParticipantToEvent.php?eventId=<?php echo $_GET['eventId'];?>">Add Participants</a></li>
                         
                    </ol>
                    
                    <!-- Create participants Form -->
                    <?php 
                    if ($_SESSION['userid'] != 0) {

                        //include database handler file so that we can
                        //call it's functions
                        include 'dbHandler.php';

                        //get the logged in lists listid SESSION variable
                        $participantName = filter_input(INPUT_GET, 'participantName');

                        //connecting to MySQL and selecting myevent database
                        $link = connect();

                        $status = select_participant_name($link, $participantName);

                        //output html table rows that contains the return
                        //from our create_participant function
                       echo "<h3>" . "Update/ Delete Event " .  $_SESSION['username'] . "</h3>";

                        //close connection to MySQL 
                        close($link);
                    }
                    
                                    
                            //check if the user session variable is not equal to 0 -
                            //this means we have a valid user who has logged into myevents
                            if ($_SESSION['userid'] != 0){
                            
                            //get the logged in lists listid SESSION variable
                            $participantName = filter_input(INPUT_GET, 'participantName');
                            //connecting to MySQL and selecting myevents database
                            $link = connect();
                            
                            $status = select_participant_name($link, $participantName);
                             //close connection to MySQL
                            close($link);
                            }
                            ?>
                             </div>             
                                <?php
                             //check if the user session variable is not equal to 0 -
                            //this means we have a valid user who has logged into myevents
                            if ($_SESSION['userid'] != 0){
                            
                            //get the logged in lists listid SESSION variable
                            $participantName = filter_input(INPUT_GET, 'participantName');
                            //connecting to MySQL and selecting myevents database
                            $link = connect();
                       $status = select_participant_name($link, $participantName);
                              //close connection to MySQL
                            close($link);
                            }
                            ?>
                    
                        <?php
                        //check to see if the submit button was pushed
                        if ((isset($_POST['submit']))){
                            
                            //include database handler file so that we can
                            //call it's functions
                            include 'dbHandler.php';
                            
                            //getting data input into the form and assigning
                            //it to variables
                            $participantName = filter_input(INPUT_POST,'participantName');
                           
                            
                            //get the logged in user's userid SESSION variable
                            $userid = $_SESSION['userid'];
                          
                            //connecting to MySQL and selecting myevents database
                            $link = connect();
                            
                            //inserting a record into the user table
                            $status = create_participants($link, $participantName, $participantEmail,$userid);
                            
                            //output an html paragraph that contains the retun
                            //from our create_Participant function
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
