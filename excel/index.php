<?php
    session_start(); 
    include_once '../dbconnect.php';

    //check session exists - loggedin user if true
    if(isset($_SESSION['loggedin'])){
        echo "<script type='text/javascript'>alert('User Session Still Exists');</script>";   
        header("Location: dashboard.php");
    }
    else{
        echo "<script type='text/javascript'>alert('User Session Expired');</script>";   
    }

    if(isset($_POST['btnLogin'])){
        if(isset($_POST['username']) && $_POST['password']){
            $user=$_POST['username'];
            $pwd=$_POST['password'];

            $query="SELECT username FROM users where username='$user'";
            $verifyUser=mysqli_query($db, $query) or die(mysqli_error($db));
            $count = mysqli_num_rows($verifyUser);

            $query2="SELECT * FROM users where username='$user' and password='$pwd'";
            $verifyPass=mysqli_query($db, $query2) or die(mysqli_error($db));
            $result=mysqli_num_rows($verifyPass);

            $ifteacher ="SELECT * FROM users where accounttype = 'Teacher' ";
            $ifadmin = "SELECT * FROM users where accounttype = 'Admin' ";

            $teacher = mysqli_query($db, $ifteacher);
            $rteach = mysqli_num_rows($teacher);
            $admin = mysqli_query($db,$ifadmin);
            $radmin = mysqli_num_rows($admin);


            if($count>0 && $result>0){
                $_SESSION['loggedin'] = $user;
                echo "<script type='text/javascript'>alert('User has successfully logged in');</script>";   
                header("Location: dashboard.php");
            }
            else{
                echo "<script type='text/javascript'>alert('User has failed to logged in');</script>";   
            }
        }
       // echo "<script>alert("+$_SESSION['loggedin']+")</script>";
    }

    if(isset($_POST['btnReg'])){
        if(isset($_POST['reguser']) && isset($_POST['regpass']) && isset($_POST['regemail']) && isset($_POST['accountType']) ){  
            $usern = $_POST['reguser'];
            $pass = $_POST['regpass'];
            $email =$_POST['regemail'];
            $atype = $_POST['accountType'];

            $qry = "INSERT INTO users(username, password, email, accounttype) values ('$usern', '$pass', '$email', '$atype')";
            if(mysqli_query($db,$qry)){
                echo "<script type='text/javascript'>alert('User has new registered');</script>";   
            }
            else{
                echo "<script type='text/javascript'>alert('User has failed to registered');</script>";   
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consolidated Reports Monthly</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
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


<div style="margin-top:5%;" class="container">
    <div class="jumbotron">
    <h1 class="display-4 text-center">Welcome to Cosolidated App</h1>
    <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
    <hr class="my-4">
    <p class="text-center">It uses utility classes for typography and spacing to space content out within the larger container.</p>
    <div class="text-center">
        <a class="btn btn-primary btn-lg" href="#" role="button">Get Started</a>
    </div>
    </div>
</div>

<div style="margin-bottom:10%" class="container">
<div class="row">


<div class="col">
    <div style="padding:25px;" class="card">
        <form method="POST" action="index.php">
        <h3 class="text-center">Sign In</h3>
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

    <div class="col">
    <div style="padding:25px;" class="card">
    <h3 class="text-center">Sign Up</h3>
        <form method="POST" action="index.php">
        <div class="form-group">
            <label for="select">Select type of account</label>
            <select name="accountType" class="browser-default custom-select">
                <option selected>Choose an account type</option>
                <option value="Admin">Admin</option>
                <option value="Teacher">Teacher</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input name="regemail" 
            type="email" 
            class="form-control" 
            id="exampleInputEmail1" 
            aria-describedby="emailHelp">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input 
            name="reguser" 
            type="text" 
            class="form-control" 
            id="exampleInputEmail1" 
            aria-describedby="emailHelp">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input name="regpass" 
            type="password" 
            class="form-control" 
            id="exampleInputPassword1">
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button name="btnReg" 
        type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
    </div>

</div>

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