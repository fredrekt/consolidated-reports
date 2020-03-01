<?php
    session_start();
    include_once '../dbconnect.php';
    $user = $_SESSION['loggedin'];

    if(isset($_POST['btnUpdate'])){
        if(isset($_POST['lname']) && isset($_POST['fname']) && isset($_POST['mail']) && isset($_POST['pwd']) && isset($_POST['school']) && isset($_POST['grade'])){  
           
            $lnme = $_POST['lname'];
            $fnme = $_POST['fname'];
            $pass = $_POST['pwd'];
            $email = $_POST['mail'];
            $school = $_POST['school'];
            $grade = $_POST['grade'];

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
        <a class="dropdown-item" href="delete.php">Delete Account</a>
          <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
    
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
    <h1 style="margin-top:5%;text-transform:uppercase">Update User Information</h1>
    <p style="color:grey" class="grey-text">Below the teacher can update his or her information</p>
    <form method="POST" method="edit.php">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Username</label>
                <input disabled value=<?php echo $name?> class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">user: <?php echo $name?> has already been selected for updating.</small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputEmail1">First Name</label>
                <input type="text" 
                placeholder="Enter first name"
                class="form-control" id="exampleInputEmail1" 
                value="<?php echo $firstname?>"
                name="fname"
                aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted"><?php echo $name ?> hasn't updated or choosen first name </small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Last Name</label>
                <input type="text"  
                placeholder="Enter last name"
                value="<?php echo $lastname?>"
                name="lname" 
                class="form-control" id="exampleInputEmail1" 
                aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted"><?php echo $name ?> hasn't updated or choosen last name</small>
            </div>
        </div>
  </div>
  <div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" 
            name="pwd"
            value="<?php echo $password?>"
            class="form-control" id="exampleInputPassword1">
            <small id="emailHelp" class="form-text text-muted">password: <?php echo $password?> can be changed for updating.</small>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputPassword1">Email Address</label>
            <input type="email" 
            value="<?php echo $email?>"
            name="mail"
            class="form-control" id="exampleInputPassword1">
            <small id="emailHelp" class="form-text text-muted">email: <?php echo $email?> can be changed for updating.</small>
        </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputPassword1">School or University</label>
            <input type="text" 
            name="school"
            value="<?php echo $school?>"
            placeholder="ex: Cebu Institute of Technology"
            class="form-control" id="exampleInputPassword1">
            <small id="emailHelp" class="form-text text-muted">user: <?php echo $name?> can update where school he/she teaches.</small>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputPassword1">Major</label>
            <input type="text" 
            name="grade"
            value="<?php echo $grade?>"
            placeholder="ex: Senior High School"
            class="form-control" id="exampleInputPassword1">
            <small id="emailHelp" class="form-text text-muted">user: <?php echo $name?> can be changed for updating major.</small>
        </div>
    </div>
  </div>


  <div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Are you sure?</label>
  </div>
  <button
   name="btnUpdate" type="submit" class="btn btn-md btn-success">UPDATE INFORMATION</button>
</form>
    
    </div>


    

<div class="footer bg-dark">
    <div>
        <a style="color:white" href="#footerlink">Copyright 2020</a>
    </div>
</div>

  <style>
.footer {
   left: 0;
   position:fixed;
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