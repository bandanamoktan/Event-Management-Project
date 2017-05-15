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
                    <h1>My Events</h1>
                    <hr>



                    <!-- Page breadcrumb -->
                    <ol class="breadcrumb">
                        <li><a href="#create">Create Events</a></li>
                        <li><a href="#add">Create Participants</a></li>
                        <li><a href="#email">Email Event Information</a></li>
                        
                    </ol>

                    <p><img class="img-responsive" src="assets/img/nepalpic.jpg"></p>

                    <h2 id="create">Create Events</h2>
                    <p class="lead">MyEvents is the best way to manage your events.
                    You can seemlessly add, update, and delete them.</p>
                    <h2 id="add">Add Participants</h2>
                    <p>MyEvents allows you to keep track of the participants who will be involved
                    in your events.</p>
                    <h2 id="email">Email Event Information</h2>
                    <p>You can easily email the details of the participants involved in it.</p>

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

