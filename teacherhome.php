
<?php
session_start();
$id = $_SESSION["id"]; 
include_once 'dbconnect.php';

    

if (($_SESSION["login"])==0){
    header("Location: logout.php");
}

include_once 'dbconnect.php';

 
	
?>
<!DOCTYPE html>
<?php
if (isset($_POST['upload']) && $_FILES['userfile']['size'] > 0) {
    $id = $_SESSION["id"];
    $filetext = $_POST['filetext'];
	$description = $_POST['description'];
	$fileName = $_FILES['userfile']['name'];
    $tmpName = $_FILES['userfile']['tmp_name'];
    $fileSize = $_FILES['userfile']['size'];
    $fileType = $_FILES['userfile']['type'];
    $fileType = (get_magic_quotes_gpc() == 0 ? mysqli_real_escape_string(
                            $_FILES['userfile']['type']) : mysqli_real_escape_string(
                            stripslashes($_FILES['userfile'])));
    $fp = fopen($tmpName, 'r');
    $content = fread($fp, filesize($tmpName));
    $content = addslashes($content);
    fclose($fp);
    if (!get_magic_quotes_gpc()) {
        $fileName = addslashes($fileName);
    }
    $con = mysqli_connect('localhost', 'root', '', 'php') or die(mysqli_error($con));
    $db = mysqli_select_db('php', $con);
    if ($con) {
        $query = "INSERT INTO upload (filetext, description, name, size, type, content, idnumber) VALUES ('$filetext', '$description','$fileName', '$fileSize', '$fileType', '$content','$id')";
        mysqli_query($con, $query) or die(mysqli_error($con));
        mysqli_close($con);
        echo "<br>File $fileName uploaded<br>";
    } else {
        echo "file upload failed";
    }
}
?>
<?php
           if (isset($_GET['id'])) {
               $con = mysqli_connect('localhost', 'root', '', 'php') or die(mysqli_error($con));
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
               //echo $content;
               mysqli_close($con);
               //exit;
           }
           ?>
		   


<html>
	<head>
		<title>Teacher Home</title>
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
				//document.getElementById("login").style.display = "none";
			}
		</script>
	</head>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">


	<body>
		
		<div class="topnav" align="left">
  		<img src="images/depedlogo.png" alt="Deped Logo" style="width:62px;height:42px;border:0;">
  		<a href="" style="float:right;margin:0 300px 0 0;"><h4><?php echo ($_SESSION["lastname"]); echo ", "; echo $_SESSION["firstname"]; 
  		echo $_SESSION["id"];
  		?></h4></a>
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
	</div>
<div class="split left">
  <div class="centered">
    <form class="form-container" method="POST" enctype="multipart/form-data"	>
		<input type="text" placeholder="" name="search" required>
		<input name="Search" type="submit" class="btn" id="search" value=" Search ">
		</form>
		<a href="teacherhome.php"><h3>Dashboard</h3></a>
		
		
		<button type="submit" class="ope-uploadcontrol" id="logi"onclick="openUpload()">Upload File</button>
		<div class="form-upload" id="myForm" style="display:none">
			<form class="form-container" method="POST" enctype="multipart/form-data">
				<h2>Upload File</h2>

				<label for="username"><b>Grade Level</b></label>
				<select id="username">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
				</select>
				<br>
				<label for=""><b>Section</b></label><br>
				<input type="text" placeholder="" name="description" required>
				<br>
				<input type="hidden" name="MAX_FILE_SIZE"
                               value="16000000">
                        <input class="" name="userfile" type="file" id="userfile"><br>
				<input name="upload" type="submit" class="btn" id="upload" value=" Upload ">
				<button type="submit" class="btn cancel" onclick="closeForm()">Close</button>
			</form>
		
  		</div>
  			<?php
        $con = mysqli_connect('localhost', 'root', '', 'php') or die(mysql_error());
        $db = mysqli_select_db('php', $con);
        $query = "SELECT id, filetext, description, name FROM upload WHERE idnumber='$id'";
        $result = mysqli_query($con, $query) or die(mysqli_error($con));?>
		<br><br>
		<h4 align="center">Documents</h4>
		<table style="width:90%">
		<tr>
			<th>Grade</th>
			<th>Section</th> 
			<th>Download</th>
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
                <td align="center"width="30%"><a href="teacherhome.php?id=<?php echo urlencode($id); ?>"
                   ><img src="images/xls.png" alt="Download file" style="width:32px;height:32px;border:0;"></a></td>
				
				</tr><?php
            }
        }
		?></table><?php
        mysqli_close($con);
        ?>
</div>
</div>
<div class="split right">
  <div class="centered">

  </div>
</div>
		
		

		<footer>
    		
		</footer>
	</body>
</html>
