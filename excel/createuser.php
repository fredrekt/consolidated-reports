<?php
    include_once '../dbconnect.php';

    $usern = $_POST['username'];
    $pass = $_POST['password'];
    $email =$_POST['email'];

    $qry = "INSERT INTO users(username, password, email) values ("+$usern+", "+$pass+", "+$email+")";
    //$execqry = mysqli_query($db, $qry) or die(mysqli_error($db));
    //$res = mysqli_num_rows($execqry);
    
    if(mysqli_query($db,$qry)){
        echo 'success';
    }
    else{
        echo "fail";
        echo $mysqli_error($db);
    }
?>