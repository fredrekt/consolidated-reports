
<?php
session_start(); 
include_once 'dbconnect.php';



if (isset($_SESSION["login"])){
    header("Location: adminhome.php"); /* Redirect browser */

}
//echo($_SESSION["login"]);


    if(isset($_POST['btnLogin'])){
        
        $user=$_POST['username'];
        $pwd=$_POST['password'];
        

        // To protect MySQL injection for Security purpose
        $username = stripslashes($user);
        $password = stripslashes($pwd);
        $username = mysqli_real_escape_string($user);
        $password = mysqli_real_escape_string($pwd);

        $query="SELECT username FROM users where username='$user'";
        $verifyUser=mysqli_query($db, $query) or die(mysqli_error($db));
        $count = mysqli_num_rows($verifyUser);

        $query2="SELECT * FROM users where username='$user' and password='$pwd'";
        $verifyPass=mysqli_query($db, $query2) or die(mysqli_error($db));
        $result=mysqli_num_rows($verifyPass);

        while (list($id, $idnumber, $username, $passowrd, $admin, $firstname, $lastname) = mysqli_fetch_array($verifyPass)){
        	$adminstatus = $admin;
          $_SESSION["id"] = $id;
          $_SESSION["username"] = $username;
          $_SESSION["password"] = $password;
          $_SESSION["firstname"] = $firstname;
          $_SESSION["lastname"] = $lastname;
        }
    
            
                if($count){
                    if(!$result){
                        echo $result.'<script type="text/javascript"> alert("PasswordInvalid Access");</script>';
                       
                    } 
                    else{
                   
                        $_SESSION["login"]=1;
                        
                        if($adminstatus==1){
                      		echo '<script type="text/javascript">window.location.href="adminhome.php"; </script>';
                      	}
                      	else{
                      		echo '<script type="text/javascript">window.location.href="teacherhome.php"; </script>';
                      	}
                    }
                } else{
                    echo '<script type="text/javascript"> alert("USernameInvalid Access");</script>';
                    
                }
             
    }
?>
<?php
           if (isset($_GET['id'])) {
               $con = mysqli_connect('localhost', 'root', '', 'php') or die(mysql_error($con));
               $db = mysqli_select_db('php', $con);
               $id = $_GET['id'];
               $query = "SELECT name, type, size, content " .
                       "FROM upload WHERE id = '$id'";
               $result = mysqli_query($con, $query) or die(mysqli_error($con));
               list($name, $type, $size, $content) = mysqli_fetch_array($result);
               header("Content-length: $size");
               header("Content-type: $type");
               header("Content-Disposition: attachment; filename=$name");
               ob_clean();
               flush();
               echo $content;
               mysql_close($con);
               exit;
           }
           ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Bato Elementary School</title>
		<link rel="stylesheet" type="text/css" href="css/main.css">
		
		<script>
			function openForm() {
				document.getElementById("myForm").style.display = "block";
				//document.getElementById("login").style.display = "none";
			}

			function closeForm() {
				document.getElementById("myForm").style.display = "none";
				//document.getElementById("login").style.display = "block";
			}
		</script>
	</head>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">


	<body>
		
		<div class="topnav" align="left">
  		<img src="images/depedlogo.png" alt="depedlogo" style="width:62px;height:42px;border:0;">
		
		<a></a>
		<button type="submit" class="open-button" id="login"onclick="openForm()">Log-in</button>
		<div class="form-popup" id="myForm" style="display:none">
			<form class="form-container" method="POST">
				<h2>Login</h2>

				<label for="username"><b>Username</b></label>
				<input type="text" placeholder="Enter Email" name="username" required>

				<label for="password"><b>Password</b></label>
				<input type="password" placeholder="Enter Password" name="password" required>

				<button type="submit" class="btn" name="btnLogin">Login</button>
				<button type="submit" class="btn cancel" onclick="closeForm()">Close</button>
			</form>
		</div></div>
        
        <div class="bgimg-1"><div class="boxdleft" align="center"><h1>Bato Elementary School</h1><br><br><br><script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	
			<div id="piechart"></div>
			<script type="text/javascript">
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Task', 'Hours per Day'],
  ['Total Enrolled', 400],
  ['Passed', 50],
  ['Failed', 23],
  ['Male', 40],
  ['Female', 60],
]);

  // Optional; add a title and set the width and height of the chart
  var options = {backgroundColor: 'transparent','title':'Students Status Report', 'width':550, 'height':400};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}
</script>
		<br><br><br><br><br><br><br><br><div class="boxdleft" align="center"><h3>STATISTICS GRAPH HERE</h3><br>

		</div></div>
  			
		</div>	
    		
		
		
  			
		
		

		
		
		
		

		<footer>
    		
		</footer>
	</body>
</html>
