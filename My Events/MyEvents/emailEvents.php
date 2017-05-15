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
                            //check if the user session variable is not equal to 0 -
                            //this means we have a valid user who has logged into Shopper
                            if ($_SESSION['userid'] != 0) {
                                
                                //include database handler file so that we can
                                 //call it's functions
                                 include 'dbHandler.php';

                                //include database handler file so that we can
                                //call it's functions
                                //get the logged in user's userid SESSION variable
                                $userid = $_SESSION['userid'];
                               


                                //connecting to MySQL and selecting shopper database
                                $link = connect();
                                
                                 


                                //$status = select_events($link, $userid);

                                //output html table rows that contains the retun
                                //from our create_user function
                               // image and username will show on top of the table
                              
                   
                    echo "<h3>" . $_SESSION['username'] . " Events " . "</h3>";

                                //close connection to MySQL
                                close($link);
                            }
                            ?>


                    <div class="well">
                        <form name="emailEvents" id="emailEvents" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">

                            <div class="form-group">
                                <label for="emailAddress">Email Address</label>
                                <input name="emailAddress" type="email" class="form-control" id="emailAddress" placeholder="Enter an email address" required="">
                                <p class="help-block">Make sure you use a valid email address</p>
                            </div>

                            <button name="email" type="submit" class="btn btn-primary">Email</button>
                        </form>
                        <?php
                        //check to see if the submit button was pushed
                        if ((isset($_POST['email']))) {
                            // echo $_SESSION['userid'];
                           // echo 'foo';

                            if ($_SESSION['userid'] != 0) {

                                include('class.phpmailer.php');

                                $mail = new PHPMailer();

                                //set values in our objects fields
                                //that allow us to send an email using
                                //Gmail's SMTP server
                                $mail->SMTPAuth = true;
                                $mail->SMTPSecure = "ssl";
                                $mail->Host = "smtp.gmail.com";
                                $mail->Port = 465;
                                $mail->Mailer = "smtp";
                                $mail->Username = "bibek712@gmail.com";
                                $mail->Password = "gmail712";

                                //set up the From portion of the email
                                $mail->From = "bibek712@gmail.com";
                                $mail->FromName = "Events";

                                $userid = $_SESSION['userid'];
                                $link = connect();

                                $mail->Subject = "Here are your events " . $_SESSION['username'];
                                        select_events($link, $userid, 1);
                               

                                $mail->Body = '<table id="shopper" width="100%" height="100%" style="border-spacing: 0; border-collapse: collapse;">
                                <thead>
                                      <tr style="background-color: #f2f2f2;">
                                             <th style="border-bottom: 2px solid #ddd; padding: 10px; text-align: left">#</th>
                                             <th style="border-bottom: 2px solid #ddd; padding: 10px; text-align: left">Name</th>
                                             <th style="border-bottom: 2px solid #ddd; padding: 10px; text-align: left">Location</th>
                                             <th style="border-bottom: 2px solid #ddd; padding: 10px; text-align: left">Date</th>
                    
                                      </tr>
                                </thead>
                                <tbody>';
                                //this code builds the table rows
                                $mail->Body .= select_events_email($link, $userid);
                                
                             
                                
                               // $status = select_list_total_cost($link, $listid);
                                
                                //this code builds the last table row that displays the total cost
                                $mail->Body .= '
                               </tbody>
                               </table>';
                                
                                close($link);
                                
                                $mail->AddAddress($_POST['emailAddress'], "Events Contact");
                                $mail->IsHTML(true);
                                
                                //send email
                                if(!$mail->Send()){
                                    echo '<p class="help-block">Mail Error: ' . $mail->ErrorInfo . '</p>';
                                } else {
                                    echo '<p class="help-block">Email Sent!</p>';
                                    
                                    
                                }
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

