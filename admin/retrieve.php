<?php
      include_once '../dbconnect.php';
    $_GET['id'] = $id;
    $select = "select * from archived where id ='$id' ";
    $res = mysqli_query($db,$select);
    if(mysqli_num_rows($res)>0){
        while($row = mysqli_fetch_assoc($res)){
            $id = $row['id'];
            $teacher = $row['teacher'];
            $section = $row['section'];
            $grade = $row['grade'];
            $filedir = $row['file_directory'];

            $qry = "insert into file(id,teacher,section,grade,filedir) values('$id','$teacher','$section','$grade','$filedir')";
            $exec = mysqli_query($db,$qry);
            if($exec){
                echo "inserted new";
                header("Location: dashboard.php");
            }
            else{
                echo "error";
            }
        }
    }
?>