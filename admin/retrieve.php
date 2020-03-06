<?php
      include_once '../dbconnect.php';
      if(!$db){
          echo "failed conn";
      }

      if(isset($_GET['id'])){
          $id = $_GET['id'];
          echo $id;
          $qry = "select * from archived where id ='$id'";

          $execQry = mysqli_query($db,$qry);
          if(mysqli_num_rows($execQry)>0){
              while($row = mysqli_fetch_assoc($execQry)){
                  $id = $row['id'];
                  $teacher = $row['teacher'];
                  $section = $row['section'];
                  $grade = $row['grade'];
                  $filedir = $row['file_directory'];                    
            }
            $insertqry = "INSERT INTO file(id,teacher,section,grade,filedir) values('$id','$teacher','$section', '$grade','$filedir')";
            $execqrys = mysqli_query($db,$insertqry);
            if($execqrys){
                echo "inserted";
                header("Location: dashboard.php");
            }
            else{
                echo "error";
            }
          }
      }
      else{
        echo "fail";
      }
      
?>