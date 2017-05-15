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
                    <h1> MyEvents - Create Event </h1>

                    <!-- Page breadcrumb -->
                    <ol class="breadcrumb">
                        <li><a href="createEvent.php">Create Event</a></li>
                         <li><a href="emailEvents.php">Email Events</a></li>

                    </ol>


                    <hr>


                    <!-- Create List Form -->

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
                    echo "<h3>" . " Create An Event " . $_SESSION['username'] . "</h3>";
                    ?>




                    <div class="well">
                        <form name="createEvent" id="createEvent" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
                            <div class="form-group">
                                <label for="eventName">Name</label>
                                <input name="eventName" type="text" class="form-control" id="eventName" placeholder="Enter a name" required="" maxlength="100">
                            </div>
                            <div class="form-group">
                                <label for="eventLocation">Location</label>
                                <input name="eventLocation" type="text" class="form-control" id="eventLocation" placeholder="Enter a location" required="" maxlength="100">
                            </div>
                            <div class="form-control-static">
                                <label for="listMonth">Month</label>
                                <select name="listMonth" id="listMonth">
                                    <option>01</option>
                                    <option>02</option>
                                    <option>03</option>
                                    <option>04</option>
                                    <option>05</option>
                                    <option>06</option>
                                    <option>07</option>
                                    <option>08</option>
                                    <option>09</option>
                                    <option>10</option>
                                    <option>11</option>
                                    <option>12</option>
                                </select>
                                <label for="listDay">Day</label>
                                <select name="listDay" id="listDay">
                                    <option>01</option>
                                    <option>02</option>
                                    <option>03</option>
                                    <option>04</option>
                                    <option>05</option>
                                    <option>06</option>
                                    <option>07</option>
                                    <option>08</option>
                                    <option>09</option>
                                    <option>10</option>
                                    <option>11</option>
                                    <option>12</option>
                                    <option>13</option>
                                    <option>14</option>
                                    <option>15</option>
                                    <option>16</option>
                                    <option>17</option>
                                    <option>18</option>
                                    <option>19</option>
                                    <option>20</option>
                                    <option>21</option>
                                    <option>22</option>
                                    <option>23</option>
                                    <option>24</option>
                                    <option>25</option>
                                    <option>26</option>
                                    <option>27</option>
                                    <option>28</option>
                                    <option>29</option>
                                    <option>30</option>
                                    <option>31</option>
                                </select>

                                <label for="listYear">Year</label>
                                <select name="listYear" id="listyear">
                                    <option>2016</option>
                                    <option>2017</option>
                                    <option>2018</option>
                                    <option>2019</option>
                                    <option>2020</option>
                                </select>



                            </div>
                            <div class="form-group">
                                <label for="eventDescription">Description</label>
                                <input name="eventDescription" type="text" class="form-control" id="eventDescription" placeholder="Enter a Description" required="" maxlength="100">
                            </div>

                            <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                        </form>
                        <?php
                        
                        //check to see if the submit button was pushed
                        if ((isset($_POST['submit']))) {

                            //include database handler file so that we can
                            //call it's functions
                            // include 'dbHandler.php';

                            //getting data input into the form and assigning
                            //it to variables
                            $eventName = $_POST['eventName'];
                            $eventLocation = $_POST['eventLocation'];
                            $listMonth = $_POST['listMonth'];
                            $listDay = $_POST['listDay'];
                            $listYear = $_POST['listYear'];
                            $eventDescription = $_POST['eventDescription'];

                            //format date properly for MySQL : yyyy-mm-dd
                            $listDate = $listYear . "-" . $listMonth . "-" . $listDay;
                            //get the logged in user's userid SESSION variable
                            $userid = $_SESSION['userid'];


                            //connecting to MySQL and selecting shopper database
                            $link = connect();


                            //inserting a record into the user table
                            $status = create_event($link, $eventName, $eventLocation, $listDate, $eventDescription, $userid);

                            //output an html paragraph that contains the retun
                            //from our create_user function
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
