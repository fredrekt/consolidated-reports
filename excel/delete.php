<?php
    include_once '../dbconnect.php';
    session_start();

    $user = $_SESSION['loggedin'];

    $qry = "DELETE FROM users WHERE username= '$user'";

    if (mysqli_query($db, $qry)) {
        echo "<script type='text/javascript'>alert('User has successfully been deleted');</script>";   
        header( "refresh:2;url=index.php" );
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }

    mysqli_close($conn);
?>
