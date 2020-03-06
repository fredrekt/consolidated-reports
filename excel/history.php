<?php
    session_start();
    include_once '../dbconnect.php';

    if(isset($_SESSION['loggedin'])){
        $user = $_SESSION['loggedin'];
        // echo "<script type='text/javascript'>alert('User Session still exists!');</script>";   
    }
    else{
        header("Location: index.php");
    }

    if(isset($_POST['btnUpdate'])){
        if(isset($_POST['lname']) && isset($_POST['fname']) && isset($_POST['mail']) && isset($_POST['pwd']) && isset($_POST['school']) && isset($_POST['grade'])){  
           
            $lnme = $_POST['lname'];
            $fnme = $_POST['fname'];
            $pass = $_POST['pwd'];
            $email = $_POST['mail'];
            $school = $_POST['school'];
            $grade = $_POST['grade'];
            //setting the session of logged in to teacher name
            $lnme = $_SESSION['loggedin'];
            $qry = "UPDATE users SET password = '$pass',lastname='$lnme', firstname='$fnme', email='$email', school='$school', major='$grade' WHERE username='$user'";
            if(mysqli_query($db,$qry)){
                echo "<script type='text/javascript'>alert('User has successfully updated information!');</script>";   
            }
            else{
                echo "<script type='text/javascript'>alert('User has failed to update information!');</script>";   
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account: <?php echo $user?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/consolidated/excel/index.php">Consolidated App</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Welcome, <?php echo $_SESSION['loggedin']?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
        <a class="dropdown-item" href="edit.php">Edit Account</a>
        <a class="dropdown-item" href="history.php">View Upload History</a>
        <a class="dropdown-item" data-toggle="modal" data-target="#exampleModal">Delete Account</a>
          <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
      </li>
    </ul>
  </div>
</nav>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Deletion of Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Deleting this account means that you wont be able to access this account again.
        This Account will be deleted from our database.
      </div>
      <div class="modal-footer">
      <a href="delete.php" class="btn btn-danger">Delete Account</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Ends -->



    
    <div class="container">
    <?php
       $qry = "select * from users where username = '$user'";
       $result = mysqli_query($db, $qry);
    if(mysqli_num_rows($result)>0){
        while ($row = mysqli_fetch_assoc($result)) {
            $name = $row['username'];
            $email =  $row["email"];
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $password = $row['password'];
            $school = $row['school'];
            $grade = $row['major'];
            
        }
    }   
    else{
        echo "zero results";
    }
    ?>
    <h1 style="margin-top:5%;text-transform:uppercase">Teacher History Upload</h1>
    <p style="color:grey" class="grey-text">Below the teacher can see his or her consolidated reports that he or she submitted</p>
    <form method="POST" method="edit.php">
    <?php
        //echo $user;
        $dhist = "select * from file where teacher ='$user' ";
        $qryDisplay =mysqli_query($db,$dhist);
        //echo $user;
        if(mysqli_num_rows($qryDisplay)>0){
            echo "<table class='table'>";
            echo " <thead>
            <tr>";
             echo' 
              <th scope="col">#</th>
              <th scope="col">Uploaded By</th>
              <th scope="col">Section</th>
              <th scope="col">Grade</th>
              <th scope="col">File Name</th>
              <th scope="col">Time Submitted</th>';
          echo " </tr> ";
          echo "</thead>";
            while ($row = mysqli_fetch_assoc($qryDisplay)) {
                $id = $row['id'];
                $name = $row['teacher'];
                $section =  $row["section"];
                $grade = $row['grade'];
                $filename = $row['filedir'];
                $time = $row['timestamp'];
                // $password = $row['password'];
                // $school = $row['school'];
                // $grade = $row['major'];
                echo "<tr>";
                //echo "<td>
                //<input type='checkbox' name='chck'/>
                //</td>";
                echo "
                <td>$id</td>
                ";

                echo "<td>$name</td>";

                echo "<td>$section</td>";

                echo "<td>$grade</td>";

                echo '<td><a href="view.php?file='.$filename.'"
                target="_blank">'.$filename.'</a>
                </td>';

                echo "
                <td>$time</td>
                </tr>";

                
            }
            echo "</table>";
            echo '<a href="clear.php?name='.$user.' style="color:white;" class="btn btn-sm btn-danger">clear history</a>';
            //echo '<a href="clearmultiple.php?chck="$_GET[`chck`]" style="color:white;" class="btn btn-sm btn-danger ml-4">clear multiple</a>';

        }
        else{
            echo '<div class="alert alert-danger" role="alert">
            Teacher '.$user.' has no current uploads 
          </div>';
        }
    ?>
    <div class="row">

    </div>


    
<!-- 
<div class="footer bg-dark">
    <div>
        <a style="color:white" href="#footerlink">Copyright 2020</a>
    </div>
</div> -->

  <style>
.footer {
   left: 0;
   padding:15px;
   bottom: 0;
   width: 100%;
   color: white;
   text-align: center;
}
</style>  
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>