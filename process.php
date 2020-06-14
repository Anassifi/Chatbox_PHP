<?php

include 'database.php';

if(isset($_POST["submit"])){
    //inputs wrapped
    $user = mysqli_real_escape_string($con, $_POST["user"]);
    $message = mysqli_real_escape_string($con, $_POST["message"]);

    $time = date("H:i:s");
    // uncomment this one in case timezone was asked
    /* $date = date_create(null, timezone_open('Africa/Casablanca'));
    $tz = date_timezone_get($date);
    echo timezone_name_get($tz); */

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // validate inputs
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name = test_input($_POST["user"]);
        $text = test_input($_POST["message"]);
    }


    // handle error
    if(empty($_POST["user"]) && empty($_POST["message"])){
        //use get to handle error?
        header("Location: http://localhost//C6_N1_N2-master/Chatbox/Starter_files/index.php"); /* Redirect browser */
        exit;

    } else {

        $sql1 = "INSERT INTO shouts(username, messages, text_time) VALUES ('$user', '$message', '$time')";
        $result = mysqli_query($con, $sql1);

        if(!$result){
            die('error '. mysqli_error($con));
        }

        header("Location: http://localhost//C6_N1_N2-master/Chatbox/Starter_files/index.php");
    }
}