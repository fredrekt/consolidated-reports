<?php
    session_start();
    include_once '../dbconnect.php';

    $user = $_SESSION['loggedin'];

    if(isset($_SESSION['loggedin'])){
        echo "<script type='text/javascript'>alert('Teacher Session Exists');</script>";   
        //header("Location: dashboard.php");
      }
      else{
        echo "<script type='text/javascript'>alert('Teacher Session Expired');</script>";   
        header("Location: index.php");
      }
    //uploading the file into the server
    if(isset($_POST['btnMove'])){
        $filename = $_FILES['file']['name'];
        $filetype = $_FILES['file']['type'];
        $filesize = $_FILES['file']['size'];
        $filetmploc = $_FILES['file']['tmp_name'];
        $filedir = "../".$filename;

        move_uploaded_file($filetmploc,$filedir);
    }
    
    if(isset($_POST['upload'])){
        $txtname = $_POST['userfile'];
        $txtGrade = $_POST['gradeLvl'];
        $txtSection = $_POST['section'];
        
        //uploading the file to server
        // $filename = $_FILES['userfile']['name'];
        // $filetype = $_FILES['userfile']['type'];
        // $filesize = $_FILES['userfile']['size'];
        // $filetmploc = $_FILES['userfile']['tmp_name'];
        // $filedir = "../".$filename;

        // move_uploaded_file($filetmploc,$filedir);

        $qry = "INSERT INTO file(teacher,section,grade,filedir) values('$user','$txtSection', '$txtGrade', '$txtname')";

        if(mysqli_query($db,$qry)){
            echo "<script type='text/javascript'>alert('Teacher Action: Data is inserted');</script>";   
        }
        else{
            echo "<script type='text/javascript'>alert('Failed to retrieve data');</script>";   
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher's Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>

<nav style="margin-top:-2%" class="navbar navbar-expand-lg navbar-dark bg-dark">
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


<div style="margin-top:5%;" class="container">
    <div class="jumbotron">
    <h1 style="color:black" class="display-4 text-center">Welcome to Cosolidated App</h1>
    <p style="color:grey" class="lead text-center">The first thing you need to do is upload the file to your server, if the file already exists in the server: you can skip me</p>
        <div class="container mt-4 mb-4 text-center">
            <form action="dashboard.php" method="post" enctype="multipart/form-data">
                <input class="" type="file" name="file"/>
                <button class="btn btn-sm btn-primary" name="btnMove" type="submit">UPLOAD FILE TO SERVER</button>
            </form>
        </div> 
    <hr class="my-4">
    <div class="text-center">
    <p class="grey-text">
        Secondly, you need to select the file you just uploaded to your server
    </p>
    <button type="submit" class="btn btn-primary btn-md ope-uploadcontrol" id="logi"onclick="openUpload()">Choose file from server</button>
    </div>
    </div>
</div>




<div style="margin-bottom:10%" class="container">

</div>

<div class="form-upload" id="myForm" style="display:none">
			<form class="form-container" method="POST" action="dashboard.php">
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


<div class="container">
    <h1 style="color:black" class="display-4 text-center">Consolidated App Statistics</h1>
    <p class="grey-text text-center">These are the overview of the Consolidated Application expressed through statistics</p>
        <div style="margin-left: 30%;">
            <div id="piechart"></div>
        </div>
    </div>

<?php
    //displaying new updates from admin - file pushes
    $qryDisplay = "select * from updates";
    $execDisplay = mysqli_query($db,$qryDisplay);
    
    if (mysqli_num_rows($execDisplay) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($execDisplay)) {
            $fileUpdateName = $row['filename'];
        }
    } else {
        echo "<script type='text/javascript'>alert('Teacher Fetch: update push has failed');</script>";   
    }
?>

<div class="container">
    <h1 style="color:black" class="display-4 text-center">Application Updates</h1>
    <hr style="width:50%"/>
    <p class="grey-text text-center">The updates from the admin are shown below</p>
    
    <div style="margin-left:0" class="container">
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Holy guacamole!</strong> <a class="alert-link" href="../<?php echo $fileUpdateName?>" download>Click this link to begin downloading the file from the admin</a>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
    </div>
</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	
    
    <script type="text/javascript">
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
var data = google.visualization.arrayToDataTable([
['Task', 'Hours per Day'],
['Total Enrolled', 400],
['Passed', 1],
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

</div></div>
      
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
   margin-top:10%;
   color: white;
   text-align: center;
}
</style>  
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
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>