<?php
//start new or resume existing session
session_start();
//register a session variable named userid
//and we're going to set its initial value to 0
$_SESSION['userid'] = 0;
$_SESSION['username'] = "";
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

                    <!-- Page breadcrumb -->
                    <ol class="breadcrumb">
                        <li><a href="index.php">Home</a></li>

                    </ol>

                    <!-- Page Heading -->
                    <h1>MyEvents - Login</h1>
                    <hr>




                    <!-- Login Form Forms -->
                    <h3>Log Into MyEvents</h3>
                    <div class="well">
                        <form name="login" id="login" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
                            <div class="form-group">
                                <label for="userName">User Name</label>
                                <input name="userName" type="text" class="form-control" id="userName" placeholder="Enter your user name" required="" maxlength="100">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input name="password" type="password" class="form-control" id="password" placeholder="Enter password" required="" maxlength="100">
                            </div>
                            <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                        </form>
<?php
//check to see if the submit button was pushed
if ((isset($_POST['submit']))) {

    //include dbhandler file so we can call its functions
    include 'dbhandler.php';

    //get data that was typed in by user
    $userName = $_POST['userName'];
    $password = $_POST['password'];


    //connecting to MySQL and selecting myevents database
    $link = connect();

    //inserting a record into the user table
    $status = select_user($link, $userName, $password);

    if ($status == 0) {


        //output an html paragraph that contains the return 
        //from our create_user function
        echo '<p class="help-block">You are not a vaild user of MyEvents!</p>';
    } else {
        
        //store the userid in the session
        $_SESSION['userid'] = $status;
        $_SESSION['username'] = $userName;

        //close connection to MySQL
        close($link);
        
       // for assignment 5 i havve to implement this functionallity in my create account page.
        header("Location: http://localhost/MyEvents/events.php");

        exit();
    }
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

