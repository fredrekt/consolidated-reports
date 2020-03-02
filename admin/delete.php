<?php
    include_once '../dbconnect.php';

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $qry = "delete from file where id='$id' ";
        $execQry = mysqli_query($db,$qry) or die("Failed"+ mysqli_error());
        echo "<script type='text/javascript'>alert('Admin Action: teacher record has been deleted');</script>";   
        header("Location: dashboard.php");
    }
?>