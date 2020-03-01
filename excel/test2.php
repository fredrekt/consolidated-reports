
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../main.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        
        
		<div class="topnav" align="left">
  		<img src="../images/depedlogo.png" alt="depedlogo" style="width:62px;height:42px;border:0;">
		
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
		</div></div><div class="bgimg-1"><div class="boxdleft" align="center"><h1>Bato Elementary School</h1><br><br><br>


        <?php
    $txtname = $_POST['userfile'];
    $txtGrade = $_POST['gradeLvl'];
    $txtSection = $_POST['section'];

    //echo "hello",$txtname;
   // echo $txtGrade, $txtSection;

    include_once "../Classes/PHPExcel.php";

    $tmpfname = '../'.$txtname;
		$excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
		$excelObj = $excelReader->load($tmpfname);
		$worksheet = $excelObj->getSheet(0);
		$lastRow = $worksheet->getHighestRow();
		
		echo "<table>";
		for ($row = 1; $row <= $lastRow; $row++) {
			 echo "<tr><td>";
			 echo $worksheet->getCell('A'.$row)->getValue();
             echo "</td><td>";
             echo $worksheet->getCell('B'.$row)->getValue();
			 echo "</td><td>";
			 echo $worksheet->getCell('C'.$row)->getCalculatedValue();
			 echo "</td><tr>";
		}
		echo "</table>";	
?>
    </head>
    <body>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>