<?php
session_start();
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
        include 'navBarBeforeLogin.html';
        ?>

        <!-- Page Content -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">


                    <!-- Page Heading -->
                    <h1>MyEvents - Add Picture To Account</h1>
                    <hr>

                    <!-- Page breadcrumb -->
                    <ol class="breadcrumb">
                        <li><a href="index.php">Home</a></li>

                    </ol>

                    <!-- Create participants Form -->

                </div>             


                <?php
                echo "<h3>" . $_SESSION['userName'] . " Account Created. Add Picture To Account? " . "</h3>";
                ?>   



                <div class="well">
                    <form name="addPicture" id="addPicture" enctype="multipart/form-data" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
                        <div class="form-group">
                            <label for="userFile">Picture</label>
                            <input name="userFile" type="file" class="form-control" id="userFile"  required="" value="">
                        </div>


                        <button name="yes" type="submit" class="btn btn-success">Yes</button>
                        <button name="no" type="submit" class="btn btn-danger">No</button>
                    </form>

                    <?php
                    include 'dbhandler.php';


                    //check to see if the update button was pushed
                    if ((isset($_POST['yes']))) {


                        // get pertinent information about the file
                        // being uploaded
                        $fileName = $_FILES['userFile']['name'];
                        $fileType = $_FILES['userFile']['type'];
                        $fileTempName = $_FILES['userFile']['tmp_name'];

                        // get item id of shopping list item
                        $fullName = $_SESSION['fullName'];
                        $phoneNumber = $_SESSION['phoneNumber'];
                        $userName = $_SESSION['userName'];
                        $password = $_SESSION['password'];
                        $emailAddress = $_SESSION['emailAddress'];



                        if (($fileType == 'image/gif') ||
                                ($fileType == "image/jpeg") ||
                                ($fileType == "image/jpg") ||
                                ($fileType == "image/png")) {

                            // set up target path at which the file will exist
                            // after it's uploaded    
                            $target_path = "C:/wamp/www/uploads/" . $fileName;

                            // move file
                            if (move_uploaded_file($fileTempName, $target_path)) {



                                // update the name of the file in the picture
                                // column on the item table
                                $link = connect();

                                $status = create_user($link, $fullName, $phoneNumber, $userName, $password, $emailAddress, $fileName);

                                $status = select_user_id($link, $userName);

                                $_SESSION['userid'] = $status;
                                $_SESSION['username'] = $userName;

                                //close connection to MySQL
                                close($link);

                                // for assignment 5 i havve to implement this functionallity in my create account page.
                                header("Location: http://localhost/MyEvents/events.php");

                                exit();
                            } else {
                                // display error message if upload fails
                                $fileError = $_FILES['userfile']['error'];
                                $status = 'Error uploading file: ' . $fileError;
                                echo '<p class="help-block">' . $status . '</p';
                            }
                        } else {
                            echo '<p class="help-block">Invalid File Type!</p>';
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

