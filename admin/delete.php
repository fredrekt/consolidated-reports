<?php
    include_once '../dbconnect.php';

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $qry = "select * from file where id='$id' ";
        $res = mysqli_query($db,$qry);
        if(mysqli_num_rows($res)>0){
            while($row = mysqli_fetch_assoc($res)) {
               $teacher = $row['teacher'];
               $section = $row['section'];
               $grade = $row['grade'];
               $filedir = $row['filedir'];
            }
            $insertQry = "INSERT INTO archived( id,teacher, section, grade, file_directory) VALUES ('$id','$teacher','$section','$grade','$filedir')";
            $execInsert = mysqli_query($db,$insertQry);
            $qrydelete = "delete from file where id='$id'";
            $execDelete = mysqli_query($db,$qrydelete);

            if($execInsert){
                $execDelete;
                echo "<script type='text/javascript'>alert('Admin Action: record now archived');</script>";   
            }
            else{
                echo "<script type='text/javascript'>alert('Admin Action: record failed to be archived');</script>";   
            }
        }
        else{
            echo 'failed';
        }
        echo "<script type='text/javascript'>alert('Admin Action: teacher record has been deleted');</script>";   
        header("Location: dashboard.php");
    }
?>