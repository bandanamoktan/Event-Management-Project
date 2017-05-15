<?php

function connect() {

//set up variables used to connect to MySQL
    $dbhost = 'localhost:3306';
    $dbuser = 'root';
    $dbpass = '';


//connect to MySQL
    $link = mysqli_connect($dbhost, $dbuser, $dbpass);
    if (!$link) {
        die('Could not connect to MySQL:' . mysqli_errno($link));
    }


//select MyEvents database
    $retval = mysqli_select_db($link, 'myevents');
    if (!$retval) {
        die('Could not select database:' . mysqli_errno($link));
    }


    return $link;
}

function close($link) {


//close connection to MySQL
    $retval = mysqli_close($link);
    if (!$retval) {
        die('Could not close connection:' . mysqli_errno($link));
    }
}

function create_user($link, $fullName, $phoneNumber, $userName, $password, $emailAddress, $picture) {

    $password = password_hash($password, PASSWORD_DEFAULT);

//create INSERT INTO statement to insert data into the user table
    $sql = "INSERT INTO user (fullname, phonenumber, username, password, email, picture) "
            . "VALUES ('$fullName', '$phoneNumber', '$userName', '$password', '$emailAddress', '$picture')";

echo $sql;
//execute query
    $retval = mysqli_query($link, $sql);
    if (!$retval) {
        die('Could not execute insert statement:' . mysqli_errno($link));
    } else {
        return 'Account Created!';
    }
}

function verify_user($link, $userName) {

    //create SELECT statement to retrieve data from the user table
    $sql = "SELECT username "
            . "FROM user "
            . "WHERE username = '$userName'";

    //execute query
    $retval = mysqli_query($link, $sql);

    if (!$retval) {
        die('Could not execute select statement:' . mysqli_errno($link));
    } else {
        if (mysqli_num_rows($retval) == 0) {
            return 0;
        } else {
            return 1;
        }
    }
}

function select_user($link, $userName, $password) {


    //setting up a userid variable and storing a value of 0 in it
    $userid = 0;

    //creating a SELECT statement to retrieve data from the user
    //table
    $sql = "SELECT id, username, password "
            . "FROM user "
            . "WHERE username = '$userName'";


    //execute query
    $retval = mysqli_query($link, $sql);

    if (!$retval) {
        die('Could not execute select statement:' . mysqli_errno($link));
    } else {
        while ($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {


            //chech to see if the username and password input in th form
            //existed in the user table
            if ((strcmp($row['username'], $userName) == 0) &&
                    password_verify($password, $row['password'])) {
                $userid = $row['id'];
                return $userid;
            } else {

                return $userid;
            }
        }
    }
}

function create_event($link, $eventName, $eventLocation, $listDate, $eventDescription, $userid) {



    //escape specical characters from name and store
    $esceventName = mysqli_real_escape_string($link, $eventName);
    $esceventLocation = mysqli_real_escape_string($link, $eventLocation);
    $esceventDescription = mysqli_real_escape_string($link, $eventDescription);

    //create INSERT INTO statement to insert data into the user table
    $sql = "INSERT INTO events (name, location, date, description, userid) "
            . "VALUES ('$esceventName', '$esceventLocation', '$listDate','$esceventDescription', '$userid')";

    //execute query
    $retval = mysqli_query($link, $sql);
    if (!$retval) {
        die('Could not execute insert statement:' . mysqli_errno($link));
    } else {
        return 'Event Created!';
    }
}

function select_events($link, $userid) {


    $i = 1;
    $status = '';

    //create SELECT statement to retrieve data from the user table
    $sql = "SELECT id, name, location, date, description "
            . "FROM events "
            . "WHERE userid = '$userid'";
    //execute query
    $retval = mysqli_query($link, $sql);
    if (!$retval) {
        die('Could not execute selct statement:' . mysqli_errno($link));
    } else {

        //processing rows returned from the SELECT statement
        while ($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {


            //formattin table rows and returning them
            $status .= '<tr>';
            $status .= '<td scope="row">' . $i . '</td>';
            $status .= '<td>' . '<a href="updateDeleteEvent.php?eventId=' . $row['id'] . '">' . $row['name'] . '</a>' . '</td>';
            $status .= '<td>' . $row['location'] . '</td>';
            $status .= '<td>' . $row['date'] . '</td>';
            $status .= '<td>' . $row['description'] . '</td>';
            
            $status .= '</tr>';

            $i++;
        }
        return $status;
    }
}

function select_events_email($link, $userid) {


    $i = 1;
    $status = '';

    //create SELECT statement to retrieve data from the user table
    $sql = "SELECT id, name, location, date "
            . "FROM events "
            . "WHERE userid = '$userid'";
    //execute query
    $retval = mysqli_query($link, $sql);
    if (!$retval) {
        die('Could not execute selct statement:' . mysqli_errno($link));
    } else {

        //processing rows returned from the SELECT statement
        while ($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
            if($i % 2 == 0){
                $status .= '<tr style="background-color: #f2f2f2">';
            } else {
                $status .= '<tr>';
        }


            //formattin table rows and returning them
            $status .='<td style="border-bottom: 1px solid #ddd; padding: 10px; text-align: left">' . $i . '</td>
                    <td style="border-bottom: 1px solid #ddd; padding: 10px; text-align: left">'. $row['name'] .'</td>
                    <td style="border-bottom: 1px solid #ddd; padding: 10px; text-align: left">' .$row['location'] .'</td>
                    <td style="border-bottom: 1px solid #ddd; padding: 10px; text-align: left">' .$row['date'] .'</td>
                </tr>';
            
          
            $i++;
        }
        return $status;
    }
}
function create_participants($link, $participantName, $participantEmail, $userid) {



    //escape specical characters from name and store
    $participantName = mysqli_real_escape_string($link, $participantName);
    $participantEmail = mysqli_real_escape_string($link, $participantEmail);


    //create INSERT INTO statement to insert data into the user table
    $sql = "INSERT INTO participants (fullname, email, userid) "
            . "VALUES ('$participantName', '$participantEmail', '$userid')";


    //execute query
    $retval = mysqli_query($link, $sql);
    if (!$retval) {
        die('Could not execute insert statement:' . mysqli_errno($link));
    } else {
        return 'Participant Created ' . $_SESSION['username'];
    }
}

function select_participants($link, $userid) {



    $i = 1;
    $status = '';

    //create SELECT statement to retrieve data from the user table
    $sql = "SELECT id, fullname, email "
            . "FROM participants "
            . "WHERE userid = '$userid'";
    //execute query
    $retval = mysqli_query($link, $sql);
    if (!$retval) {
        die('Could not execute selct statement:' . mysqli_errno($link));
    } else {



        //processing rows returned from the SELECT statement
        while ($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {


            //formattin table rows and returning them
            $status .= '<tr>';
            $status .= '<td scope="row">' . $i . '</td>';
            $status .= '<td>' . '<a href="#">' . $row['fullname'] . '</a>' . '</td>';
            $status .= '<td>' . $row['email'] . '</td>';
            $status .= '</tr>';

            $i++;
        }
        return $status;
    }
}

function select_participant_name($link, $participantName) {


    $status = '';



    //create SELECT statement to retrieve data from the user table
    $sql = "SELECT fullname "
            . "FROM participants "
            . "WHERE fullname = '$participantName'";

    //execute query
    $retval = mysqli_query($link, $sql);
    if (!$retval) {
        die('Could not execute select statement:' . mysqli_errno($link));
    } else {


        //processing rows returned from the SELECT statement
        while ($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
            $status = $row['name'];
        }
        return $status;
    }
}

function select_participant_to_add($link, $participantName) {


    $status = '';

    //create SELECT statement to retrieve data from the user table
    $sql = "SELECT fullname, email, userid "
            . "FROM participants "
            . "WHERE participantName = '$participantName'";
    //execute query
    $retval = mysqli_query($link, $sql);
    if (!$retval) {
        die('Could not execute selct statement:' . mysqli_errno($link));
    } else {
        $status .= '<option value="' . $row['participantName'] . '">'
                . '</option>';
    }
    return $status;
}

function getall_participants($link) {

    $i = 1;
    $status = '';

    //create SELECT statement to retrieve data from the user table
    $sql = "SELECT id, fullname, email "
            . "FROM participants ";

    //execute query
    $retval = mysqli_query($link, $sql);
    if (!$retval) {
        die('Could not execute selct statement:' . mysqli_errno($link));
    } else {



        //processing rows returned from the SELECT statement
        while ($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {


            //formattin table rows and returning them

            $status .= '<option value="' . $row['id'] . '">' . $row['fullname'] . '</option>';


            $i++;
        }
        return $status;
    }
}

function events_participants($link, $event_id, $participant_id, $userid) {

    $sql = "INSERT INTO events_participants (event_id, participant_id, userid) "
            . "VALUES ('$event_id', '$participant_id', '$userid')";

    //execute query
    $retval = mysqli_query($link, $sql);
    if (!$retval) {
        die('Could not execute insert statement:' . mysqli_errno($link));
    } else {
        $sql = "SELECT fullname "
                . "FROM participants "
                . "WHERE id = '$participant_id'";
        //execute query
        $retval = mysqli_query($link, $sql);
        $row = mysqli_fetch_array($retval, MYSQLI_ASSOC);
        return $row['fullname'];
    }


}
function select_user_id($link, $userName){
    $id= 0;
    //create SELECT statement to retrieve data from the user table
    $sql = "SELECT id "
            . "FROM user "
            . "WHERE username = '$userName'";
    
    //execute query
    $retval = mysqli_query($link, $sql);
    
    if(!$retval){
        
        die('Could not execute select statement:' . mysqli_errno($link));
        
    } else {
        while ($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
            $id = $row['id'];
            
           
        }
        return $id;
    }
}

function select_user_picture($link, $userid, $target_path){
    $picture= 0;
    //create SELECT statement to retrieve data from the user table
    $sql = "SELECT picture "
            . "FROM user "
            . "WHERE id = '$userid'";
    
    //execute query
    $retval = mysqli_query($link, $sql);
    
    if(!$retval){
        
        die('Could not execute select statement:' . mysqli_errno($link));
        
    } else {
        while ($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
            $picture = $row['picture'];
            
           
        }
        return $picture;
    }
}


?>
