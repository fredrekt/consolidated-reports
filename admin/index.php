<?php
    session_start();
    include_once '../dbconnect.php';
    
//verfying admin login - only accounttype allowed is "Admin" 
    if(isset($_POST['btnAdminLogin'])){
        if(isset($_POST['adminuser']) && isset($_POST['adminpass'])){
            $txtuser = $_POST['adminuser'];
            $txtpass = $_POST['adminpass'];

            $qryVerifyAdmin = "select * from users where username='$txtuser' and password='$txtpass' and accounttype='Admin' ";
            $execQuery = mysqli_query($db,$qryVerifyAdmin);
            $response = mysqli_num_rows($execQuery);
            if($response>0){
                $_SESSION['loggedinadmin'] = $txtuser;
                echo "<script type='text/javascript'>alert('Admin Access Granted!');</script>";   
                header("Location: dashboard.php");
            }
            else{
                echo "<script type='text/javascript'>alert('Admin Access Denied!');</script>";   
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title>Admin Side</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body style="background-position:800px 80px;background-repeat:no-repeat;background-image:url('https://i.pinimg.com/736x/cb/dc/9b/cbdc9bf758a327b81d8c8a937f95fcf4.jpg')">
    

<nav class="navbar navbar-dark bg-dark">
<a class="navbar-brand" href="#">Consolidated App</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Features</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Team</a>
      </li>
    </ul>
  </div>

</nav>

<div style="margin-top:10%;margin-bottom:10%" class="container">
    <div style="width:50%" class="jumbotron">
    <h3 class="text-center">Admin Authentication</h3>
        <form method="POST" action="">
            <div class="form-group">
                <label for="exampleInputEmail1">Admin Access Key</label>
                <input 
                type="text" 
                name="adminuser"
                class="form-control" 
                id="exampleInputEmail1" 
                aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input 
                type="password" 
                class="form-control" 
                name="adminpass"
                id="exampleInputPassword1">
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" name="btnAdminLogin" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
<!-- 
<center>
<div class="container" style="margin-top:10%">
    <div style="padding:25px;width:50%" class="card">
            <form method="POST" action="index.php">
            <h3 class="text-center">Admin Authentication</h3>
            <div class="form-group">
                <label for="exampleInputEmail1">Username</label>
                <input 
                type="text"
                class="form-control" 
                id="exampleInputEmail1"
                name="username"
                aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" 
                name="password"
                class="form-control" id="exampleInputPassword1">
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Remember my password</label>
            </div>
            <button name="btnLogin" type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
</div>
</center> -->

</div>


<div class="footer bg-dark">
    <div>
        <a style="color:white" href="#footerlink">Copyright 2020</a>
    </div>
</div>

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