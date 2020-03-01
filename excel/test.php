
<!-- <!DOCTYPE <!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>

    <form method="post" action="test2.php">
        <input type="file" id="txtUpload" name="txtUpload">
        <button type="submit" id="upload">upload</button>
    </form>
    <body>
    </body>
</html> -->

<?php
    include_once "../Classes/PHPExcel.php";

    // $tmpfname = "../avg.xls";
	// 	$excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
	// 	$excelObj = $excelReader->load($tmpfname);
	// 	$worksheet = $excelObj->getSheet(0);
	// 	$lastRow = $worksheet->getHighestRow();
		
	// 	echo "<table>";
	// 	for ($row = 1; $row <= $lastRow; $row++) {
	// 		 echo "<tr><td>";
	// 		 echo $worksheet->getCell('A'.$row)->getValue();
	// 		 echo "</td><td>";
	// 		 echo $worksheet->getCell('B'.$row)->getValue();
	// 		 echo "</td><tr>";
	// 	}
	// 	echo "</table>";	

?>



<html>
	<head>
		<title>Teacher Home</title>
		<link rel="stylesheet" type="text/css" href="../css/main.css">
		
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
  		<img src="../images/depedlogo.png" alt="Deped Logo" style="width:62px;height:42px;border:0;">
  		<a href="" style="float:right;margin:0 300px 0 0;"><h4>
  		</h4></a>
		<button type="submit" class="open-button" id="login" onclick="openForm()">Logout</button>
		
		

		</div>
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
		<a href="../teacherhome.php"><h3>Dashboard</h3></a>
		<button type="submit" class="ope-uploadcontrol" id="logi"onclick="openUpload()">Upload File</button>
		<div class="form-upload" id="myForm" style="display:none">
			<form class="form-container" method="POST" action="test2.php">
				<h2>Upload File</h2>

				<label for="username"><b>Grade Level</b></label>
				<select name="gradeLvl" id="username">
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
				<input type="text" placeholder="" name="section" required>
				<br>
				<input type="hidden" name="MAX_FILE_SIZE"
                               value="16000000">
                        <input class="" name="userfile" type="file" id="userfile"><br>
				<input name="upload" type="submit" class="btn" id="upload" value=" Upload ">
				<button type="button" class="btn cancel" onclick="closeForm()">Close</button>
			</form>
		
  		</div>
		<br><br>
	
</div>
		
		

		<footer>
    		
		</footer>
	</body>
</html>