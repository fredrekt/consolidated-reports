<?php
    include_once '../dbconnect.php';
    session_start();

    $user = $_SESSION['loggedin'];

    $qry = "DELETE FROM file WHERE teacher= '$user'";

    if (mysqli_query($db, $qry)) {
        echo "<script type='text/javascript'>alert('User history has successfully been cleared');</script>";   
        header( "refresh:1;url=dashboard.php" );
    } else {
        echo "Error clearing history: " . mysqli_error($conn);
    }

    mysqli_close($conn);
?>
