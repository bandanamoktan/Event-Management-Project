<?php
//start new or resume existing session
session_start();
// session variable to connect 
// to user's data
$_SESSION['fullname'] = "";
$_SESSION['phoneNumber'] = "";
$_SESSION['userName'] = "";
$_SESSION['password'] = "";
$_SESSION['emailAddress'] = "";
$_SESSION['picture'] = "";
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
                    <h1>MyEvents - Create Account</h1> 
                    <hr>

                    <!-- Page breadcrumb -->
                    <ol class="breadcrumb">
                        <li><a href="index.php">Home</a></li>

                    </ol> 


                    <?php
                    //check to see if the submit button was pushed
                    if ((isset($_POST['submit']))) {

                        //include dbhandler file so we can call its functions
                        include 'dbhandler.php';

                        //get data that was typed in by user
                        $fullName = $_POST['fullName'];
                        $phoneNumber = $_POST['phoneNumber'];
                        $userName = $_POST['userName'];
                        $password = $_POST['password'];
                        $emailAddress = $_POST['emailAddress'];
                        $picture = $_POST['picture'];


                        //connecting to MySQL and selecting shopper database
                        $link = connect();

                        $userNameExists = verify_user($link, $userName);

                        if ($userNameExists == 0) {

                           
                            // store data that was typed in by user into
                            // session variables
                            $_SESSION['fullName'] = $fullName;
                            $_SESSION['phoneNumber'] = $phoneNumber;
                            $_SESSION['userName'] = $userName;
                            $_SESSION['password'] = $password;
                            $_SESSION['emailAddress'] = $emailAddress;
                            header("Location: http://localhost/MyEvents/addPicture.php");
                            exit();
                        } else {

                            echo '<h3> Create Your Account </h3>';
                            echo '<p class ="help-block">Username already exists! </p>';
                        }

                        close($link);
                    } else {
                        echo '<h3>Create Your Account</h3>';
                    }
                    ?>

                    <!-- Create Account Forms -->

                    <div class="well">
                        <form name="createAccount" id="createAccount" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
                            <div class="form-group">
                                <label for="fullName">Full Name</label>
                                <input name="fullName" type="text" class="form-control" id="fullName" placeholder="Enter your Full Name" required="" maxlength="100">
                            </div>

                            <div class="form-group">
                                <label for="phoneNumber">Phone Number</label>
                                <input name="phoneNumber" type="text" class="form-control" id="phoneNumber" placeholder="Enter your Phone Number" required="" maxlength="10">
                            </div>


                            <div class="form-group">
                                <label for="userName">User Name</label>
                                <input name="userName" type="text" class="form-control" id="userName" placeholder="Enter a Username" required="" maxlength="100">
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input name="password" type="password" class="form-control" id="password" placeholder="Enter a Password" required="" maxlength="100">
                            </div>

                            <div class="form-group">
                                <label for="emailAddress">Email Address</label>
                                <input name="emailAddress" type="email" class="form-control" id="emailAddress" placeholder="Enter a Email Address" required="" maxlength="100">
                                <p class="help-block">Make sure you use a valid email address</p>
                            </div>

                            <button name="submit"type="submit" class="btn btn-primary">Submit</button>
                        </form>


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

