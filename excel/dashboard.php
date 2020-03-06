<?php
    session_start();
    include_once '../dbconnect.php';
    include_once "../Classes/PHPExcel.php";


    $user = $_SESSION['loggedin'];

    if(isset($_SESSION['loggedin'])){
        // echo "<script type='text/javascript'>alert('Teacher Session Exists');</script>";   
        //header("Location: dashboard.php");
      }
      else{
        // echo "<script type='text/javascript'>alert('Teacher Session Expired');</script>";   
        header("Location: index.php");
      }
    //uploading the file into the server
    if(isset($_POST['btnMove'])){
        $filename = $_FILES['file']['name'];
        $filetype = $_FILES['file']['type'];
        $filesize = $_FILES['file']['size'];
        $filetmploc = $_FILES['file']['tmp_name'];
        $filedir = "../".$filename;

        if(move_uploaded_file($filetmploc,$filedir)){
           // echo '<script type="text/javascript">document.getElementById("step2").style.display = "inline"</script>';
            echo '<script>document.getElementById("step2").style.display = "inline"</script>';
        }
    }
    //uploading files 
    if(isset($_POST['upload'])){
        $txtGrade = $_POST['gradeLvl'];
        $txtSection = $_POST['section'];
        
        $filename = $_FILES['file']['name'];
        $filetype = $_FILES['file']['type'];
        $filesize = $_FILES['file']['size'];
        $filetmploc = $_FILES['file']['tmp_name'];
        $filedir = "../".$filename;

        move_uploaded_file($filetmploc,$filedir);
        
        $qry = "INSERT INTO file(teacher,section,grade,filedir) values('$user','$txtSection', '$txtGrade', '$filename')";
        $gradeandsection = $txtGrade."-".$txtSection;

        //use phpexcel to get the values of the row - mean and mps

        // $excel = PHPExcel_IOFactory::load('../'.$filename);

        // foreach($excel->getWorksheetIterator() as $worksheet){
        //     $highestRow = $worksheet->getHighestRow();
        //     for($row=2;$row<=$highestRow;$row++){
        //         $name = mysqli_real_escape_string($db, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
        //         $v = mysqli_real_escape_string($db, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
        //         echo $name;
        //         echo $v;
        //     }
        // }

        $qryforInsert = "INSERT INTO consolidate(gradeandsection, teacher, eng_m, eng_mps, math_m, math_mps, fil_m, fil_mps, sci_m, sci_mps, mtb_m, mtb_mps, aral_m, aral_mps, mapeh_m, mapeh_mps, epp_m, epp_mps, esp_m, esp_mps) VALUES ('$gradeandsection', '$user', '80.20', '79.25', '99.25', '81.25', '87.25', '97.25', '78.25', '79.25', '99.25', '61.8', '12.8', '21.59', '58.12', '51.51', '85.59', '29.99', '21.23', '56.21')";

        if(mysqli_query($db,$qry) &&  mysqli_query($db,$qryforInsert) ){
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
<!-- sidenav -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/sidebar.css">
</head>
<body style="background-position:340px 100px;background-repeat:no-repeat;background-image:url('./img/depedwithlogo.png')">

<nav style="margin-top:-2%; background: #212121" class="navbar navbar-expand-lg navbar-dark">
  <a class="navbar-brand" href="/consolidated/excel/index.php">
  <img src="./img/logo.png" title="Bato Elementary School" width="180" height="100" alt="">
  </a>
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
        <a class="dropdown-item" href="history.php">
        View Upload History</a>
        <a class="dropdown-item" data-toggle="modal" data-target="#exampleModal">Delete Account</a>
          <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
      </li>
    </ul>
  </div>
</nav>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Deletion of Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Deleting this account means that you wont be able to access this account again.
        This Account will be deleted from our database.
      </div>
      <div class="modal-footer">
      <a href="delete.php" class="btn btn-danger">Delete Account</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Ends -->


<div style="" class="wrapper d-flex align-items-stretch">
<nav style="margin-bottom:%;height:1000px" id="sidebar">
        <ul class="list-unstyled components mb-5">
          <li id="active-1" class="active">
            <a onclick="displayOne()"><span class="fa fa-home mr-3"></span> Submit Report</a>
          </li>
          <!-- <li class="" id="active-2">
              <a onclick="displayTwo()"><span class="fa fa-sticky-note mr-3"></span> View Upload History </a>
          </li>
          <li class="" id="active-3">
            <a onclick="displayThree()"><span class="fa fa-user mr-3"></span> Manage Account</a>
          </li> -->
        </ul>

    	</nav>
        <!-- <div class="container">
            <div class="text-center">
                <h1>WELCOME TO CONSOLIDATED MONTHLY REPORT</h1>
            </div>
        </div> -->
        
        </div>

    <div style="margin-top:-65%; font-weight:700" class="cotainer">
        <h1 style="color:blackl;text-transform:uppercase;margin-left:10%" class="display-4 text-center"><b>Welcome to Cosolidated Monthly Report</b></h1>
    </div> 
 

 <div style="display:none" id="stepperone">
    <div style="margin-top:20%; margin-left:20%" class="container">
        <div class="container">
            <div class="">
            <h3 style="color:black" class="display-4 text-center">Submit <br/>Consolidated Report</h3>
            <hr style="width:40%"/>
            <div id="step1" style="display:inline">
                <p style="color:grey" class="lead text-center">The first thing you need to do is upload the file to your server</p>
                    <div class="container mt-4 mb-4 text-center">
                        <!-- <form action="dashboard.php" method="post" enctype="multipart/form-data">
                            <input class="" type="file" name="file"/>
                            <button class="btn btn-sm btn-primary" onclick="showStep2()" id="btn-move" name="btnMove" type="submit">UPLOAD FILE TO SERVER</button>
                        </form> -->
                    </div> 
            </div>
    </div>

    <div style="margin-left:25%;padding:20px; width:50%" class="card">
    <center>
    <form class="" method="POST" action="dashboard.php" enctype="multipart/form-data">
				<h2>Upload File</h2>

				<label for="username"><b>Grade Level</b></label><br/>
				<select name="gradeLvl" id="username">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
				</select>
				<br>
				<label for=""><b>Section</b></label><br>
                <select class="mb-2" name="section">
                <option value="Rose">Rose</option>
					<option value="Orchid">Orchid</option>
					<option value="Camia">Camia</option>
					<option value="Adelfa">Adelfa</option>
					<option value="Daisy">Daisy</option>
                    <option value="Sunflower">Sunflower</option>
					<option value="Special Science Class">Special Science Class</option>
                </select>
				<!-- <input type="text" placeholder="" name="section" required> -->
				<br>
				<!-- <input type="hidden" name="MAX_FILE_SIZE"
                               value="16000000"> -->
                        <input required name="file" type="file" id="userfile"><br>
				<input name="upload" type="submit" class="btn btn-primary btn-sm mt-2" id="upload" value=" Upload ">
				<!-- <button type="button" class="btn cancel" onclick="closeForm()">Close</button> -->
			</form>
        </center>
    </div>
</div>

  
    <div id="step2" style="display:none">
        <hr class="my-4">
        <div class="text-center">
        <p class="grey-text">
            Secondly, you need to select the file you just uploaded to your server
        </p>
        <button type="submit" class="btn btn-primary btn-md ope-uploadcontrol" id="logi"onclick="openUpload()">Choose file from server</button>
    </div>   

    </div>
    </div>
</div>




<div style="margin-bottom:10%" class="container">

</div>

<div class="form-upload" id="myForm" style="display:none">
			<form class="form-container" method="POST" action="dashboard.php">
				<h2>Upload File</h2>

				<label for="username"><b>Grade Level</b></label><br/>
				<select name="gradeLvl" id="username">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
				</select>
				<br>
				<label for=""><b>Section</b></label><br>
                <select class="mb-2" name="section">
                <option value="Rose">Rose</option>
					<option value="Orchid">Orchid</option>
					<option value="Camia">Camia</option>
					<option value="Adelfa">Adelfa</option>
					<option value="Daisy">Daisy</option>
                    <option value="Sunflower">Sunflower</option>
					<option value="Special Science Class">Special Science Class</option>
                </select>
				<!-- <input type="text" placeholder="" name="section" required> -->
				<br>
				<input type="hidden" name="MAX_FILE_SIZE"
                               value="16000000">
                        <input class="" name="userfile" type="file" id="userfile"><br>
				<input name="upload" type="submit" class="btn btn-primary btn-sm mt-2" id="upload" value=" Upload ">
				<button type="button" class="btn cancel" onclick="closeForm()">Close</button>
			</form>
		
  		</div>

<!-- 
<div class="container">
    <h1 style="color:black" class="display-4 text-center">Consolidated App Statistics</h1>
    <p class="grey-text text-center">These are the overview of the Consolidated Application expressed through statistics</p>
        <div style="margin-left: 30%;">
            <div id="piechart"></div>
        </div>
    </div> -->

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
        // echo "<script type='text/javascript'>alert('Teacher Fetch: update push has failed');</script>";   
    }
?>
<!-- 
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
</div> -->
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

<!-- <div class="footer">
    <div>
        <a style="color:white" href="#footerlink">Copyright 2020</a>
    </div>
</div> -->

  <style>
.footer {
   left: 0;
   padding:15px;
   bottom: 0;
   width: 100%;
   margin-top:10%;
   color: white;
   background: #212121;
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

            function showStep2(){
                document.getElementById("step1").style.display = 'inline';
            } 
            function displayOne(){
                document.getElementById("stepperone").style.display = 'inline';    
            }
		</script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>