
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
           ?>
		   


<html>
	<head>
		<title>Admin Document</title>
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
		</script>
	</head>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">


	<body>
		
		<div class="topnav" align="left">
  		<img src="images/depedlogo.png" alt="Download file" style="width:62px;height:42px;border:0;">
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
		<a href="adminhome.php"><h3>Dashboard</h3></a>
		<a href="admindocuments.php">Document</a><br>
		<a href="">Attachment</a>
		<br><br>
		<h3>User</h3>
		<a href="adminuser.php">User 1</a><br>
		<a href="">User 2</a>

  </div>
</div>

<div class="split right">
  <div class="centered">
    <h3>Documents Here</h3>
    	
  </div>
</div>
		

		<footer>
    		
		</footer>
	</body>
</html>
