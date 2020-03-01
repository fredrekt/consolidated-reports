
<?php
session_start(); 
include_once 'dbconnect.php';

    

if (($_SESSION["login"])==0){
    header("Location: logout.php");
}

include_once 'dbconnect.php';

 
	
?>
<!DOCTYPE html>
<?php
if (isset($_POST['upload']) && $_FILES['userfile']['size'] > 0) {
    $filetext = $_POST['filetext'];
	$description = $_POST['description'];
	$fileName = $_FILES['userfile']['name'];
    $tmpName = $_FILES['userfile']['tmp_name'];
    $fileSize = $_FILES['userfile']['size'];
    $fileType = $_FILES['userfile']['type'];
    $fileType = (get_magic_quotes_gpc() == 0 ? mysql_real_escape_string(
                            $_FILES['userfile']['type']) : mysql_real_escape_string(
                            stripslashes($_FILES['userfile'])));
    $fp = fopen($tmpName, 'r');
    $content = fread($fp, filesize($tmpName));
    $content = addslashes($content);
    fclose($fp);
    if (!get_magic_quotes_gpc()) {
        $fileName = addslashes($fileName);
    }
    $con = mysql_connect('localhost', 'root', '') or die(mysql_error());
    $db = mysql_select_db('php', $con);
    if ($db) {
        $query = "INSERT INTO upload (filetext, description, name, size, type, content ) " .
                "VALUES ('$filetext', '$description','$fileName', '$fileSize', '$fileType', '$content')";
        mysql_query($query) or die('Error, query failed');
        mysql_close();
        //echo "<br>File $fileName uploaded<br>";
    } else {
        echo "file upload failed";
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
               $result = mysqli_query($con, $query) or die(mysql_error($con));
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
?><?php
           if (isset($_GET['delete'])) {
               $con = mysqli_connect('localhost', 'root', '', 'php') or die(mysql_error($con));
               $db = mysqli_select_db('php', $con);
               $id = $_GET['id'];
               $query = "DELETE FROM upload WHERE id = '$id'";
               $result = mysqli_query($con, $query) or die(mysql_error($con));
               mysql_close($con);
               //exit;
           }
           ?>
<?php
           if (isset($_POST['btnUser'])) {
			   $username = $_POST['username'];
			   $id=$_POST['id'];
			   $firstname=$_POST['firstname'];
			   $lastname=$_POST['lastname'];

			   $con = mysqli_connect('localhost', 'root', '', 'php') or die(mysqli_error($con));
        		$db = mysqli_select_db($con, 'php');
			   echo($id);
				$query="INSERT INTO users (idnumber, username, password, admin, firstname, lastname) VALUES ('$id', '$username', '$id', '0', '$firstname', '$lastname');";
        		$addUser=mysqli_query($con, $query) or die(mysqli_error($con));
              
               mysqli_close($con);
               	echo '<script language="javascript">';
				echo 'alert("User added.")';
				echo '</script>';
             //  exit;
			  //header('location:adminhome.php');
           }


           ?>


<html>
	<head>
		<title>Admin Home</title>
		<link rel="stylesheet" type="text/css" href="css/main.css">
		
		<script>
			function openForm() {
				window.location.replace("logout.php");
				
			}

			function closeForm() {
				document.getElementById("myForm").style.display = "none";
				
			}
			
			function openUpload() {
				document.getElementById("myForm").style.display = "block";
				document.getElementById("login").style.display = "none";
			}
			function openAddUser() {
				document.getElementById("myForm").style.display = "block";
				//document.getElementById("login").style.display = "none";
			}

			function closeAddUser() {
				document.getElementById("myForm").style.display = "none";
				//document.getElementById("login").style.display = "block";
			}
		</script>
	</head>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">


	<body>
		
		<div class="topnav" align="left">
  		<img src="images/depedlogo.png" alt="Download file" style="width:62px;height:42px;border:0;">
  		<a href="" style="float:right;margin:0 300px 0 0;"><h4><?php echo ($_SESSION["lastname"]); echo ", "; echo $_SESSION["firstname"]; ?></h4></a>
		<button type="submit" class="open-button" id="login" onclick="openForm()">Logout</button>
		
		

		<!--</div>
		<button type="submit" class="open-uploadcontrol" id="logi"onclick="openUpload()">Add File</button>
		<div class="form-upload" id="myForm" style="display:none">
			<form class="form-container" method="POST" enctype="multipart/form-data">
				<h2>Upload File</h2>

				<label for="username"><b>Filename</b></label>
				<input type="text" placeholder="" name="filetext" required>

				<label for=""><b>Description</b></label>
				<br><textarea name="description" id="description" style="font-family:sans-serif;font-size:1em;">
				
				</textarea><br>
				<input type="hidden" name="MAX_FILE_SIZE"
                               value="16000000">
                        <input class="" name="userfile" type="file" id="userfile"><br>
				<input name="upload" type="submit" class="btn" id="upload" value=" Upload ">
				<button type="submit" class="btn cancel" onclick="closeForm()">Close</button>
			</form>
		</div>-->
		
		
<div class="split left">
  <div class="centered">
    <form class="form-container" method="POST" enctype="multipart/form-data">
		<input type="text" placeholder="" name="search" required>
		<input name="Search" type="submit" class="btn" id="search" value=" Search ">
		</form>
		<?php
        $con = mysqli_connect('localhost', 'root', '', 'php') or die(mysql_error());
        $db = mysqli_select_db('php', $con);
        $query = "SELECT id, filetext, description, name FROM upload";
        $result = mysqli_query($con, $query) or die(mysqli_error($con));?>
		<br><br>
		<h4 align="center">Documents</h4>
		<table style="width:100%">
		<tr>
			<th>Grade</th>
			<th>Section</th>
			<th>Download</th> 
			<th>Delete</th>
		</tr>
		<?php
		if (mysqli_num_rows($result) == 0) {
            echo "Database is empty <br>";
        } else {
            while (list($id, $filetext, $description, $name) = mysqli_fetch_array($result)) {
                  ?>
				 <tr>
				 <td align="center" width="20%"><b><?php echo($filetext);   ?></b></td>
				 <td width="20%" align="center"><small><?php echo($description);  ?></small></td> 
                <td align="center"width="30%"><a href="adminhome.php?id=<?php echo urlencode($id); ?>"
                   ><img src="images/xls.png" alt="Download file" style="width:32px;height:32px;border:0;"></a></td>
				 <td align="center" width="20%"><a href="adminhome.php?delete=<?php echo urlencode($id); ?>"
                   ><?php echo urlencode($id);?></a></b></td>
				</tr><?php
            }
        }
		?></table><?php
        mysqli_close($con);
        ?>
		
		<button type="submit" class="open-adduser" id="login"onclick="openAddUser()">Add User</button>
		<div class="form-popup" id="myForm" style="display:none">
			<form class="form-container" method="POST">
				<h2>Add User</h2>

				<label for="username"><b>Username</b></label>
				<input type="text" placeholder="Enter Username" name="username" required>

				<label for="password"><b>ID Number</b></label>
				<input type="text" placeholder="Enter ID number" name="id" required>

				<label for="password"><b>First Name</b></label>
				<input type="text" placeholder="Enter first name" name="firstname" required>

				<label for="password"><b>Last Name</b></label>
				<input type="text" placeholder="Enter last name" name="lastname" required>

				<button type="submit" class="btn" name="btnUser">Confirm</button>
				<button type="submit" class="btn cancel" onclick="closeAddUser()">Close</button>
			</form>


  </div>
</div>

<div class="split right">
  <div class="centered">
    	<div id="piechart"></div>
			<script type="text/javascript">
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Task', 'Hours per Day'],
  ['Passed', 235],
  ['Failed', 23],
]);

  // Optional; add a title and set the width and height of the chart
  var options = {backgroundColor: 'transparent','title':'Exam Result', 'width':550, 'height':400};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}
</script>
  </div>
</div>
		

		<footer>
    		
		</footer>
	</body>
</html>
