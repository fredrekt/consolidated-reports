<?php
    session_start();
    include_once '../dbconnect.php';
    //library for reading excel files
    include_once "../Classes/PHPExcel.php";

     //syntax for reading file IO :D
     

    if(isset($_SESSION['loggedinadmin'])){
        // echo "<script>alert('Session Exists')</script>";
    }
    else{
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin's Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- sidenav -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/sidebar.css">
</head>
<body>

<nav style="margin-top:-2%;  background: #212121; border:1px white solid" class="navbar navbar-expand-lg navbar-dark">
  <a style="font-weight:700" class="navbar-brand ml-4" href="#">Consolidated Monthly Report</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Welcome, <?php echo $_SESSION['loggedinadmin']?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
        <!-- <a class="dropdown-item" href="edit.php">Edit Account</a>
        <a class="dropdown-item" href="">View Upload History</a>
        <a class="dropdown-item" href="delete.php">Delete Account</a> -->
          <a class="dropdown-item" href="../excel/logout.php">Logout</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
<div class="wrapper d-flex align-items-stretch">
<nav style="margin-bottom:-10%;height:800px" id="sidebar">
        <ul class="list-unstyled components mb-5">
          <li id="active-1" class="active">
            <a onclick="displayOne()"><span class="fa fa-home mr-3"></span> Admin Contoller</a>
          </li>
          <li class="" id="active-2">
              <a href="consolidate.php"><span class="fa fa-user mr-3"></span> Consolidate </a>
          </li>
          <li class="" id="active-3">
            <a onclick="displayThree()"><span class="fa fa-sticky-note mr-3"></span> Archived</a>
          </li>
          <li>
            
          </li>
        </ul>

    	</nav>
    </div>



  <div id="container3" style="margin-top:-42%;margin-left:20%;" class="container">
            <div class="container">
            <h1 style="margin-top:5%" class="black-text text-center">ADMIN HANDLES THE ARCHIVING</h1>
                <hr style="width:50%"/>
                <p style="margin-top:-1%" class="grey-text text-center" style="margin-top:5%">
                Below are the records that the admin has selected to be archived, saved for later purposes
                </p>
            </div>
        
        <div style="margin-left:-6%;margin-top:-5%" class="container">
        <table class="table">
  <thead>
    <tr>
      <th scope="col">Archive #</th>
      <th scope="col">ID</th>
      <th scope="col">Teacher</th>
      <th scope="col">Section</th>
      <th scope="col">Grade</th>
      <th scope="col">Time Archived</th>
      <th scope="col">Retrieve</th>
    </tr>
  </thead>
  <tbody>
  <form action="dashboard.php" method="get">
  <?php
    $qry = "select * from archived";
    $result = mysqli_query($db,$qry);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
            $id = $row['id'];
            $noid = $row['no_id'];
            $name = $row['teacher'];
            $section = $row['section'];
            $grade = $row['grade'];
            $filename = $row['file_directory'];
            $timestmp = $row['time_stamp'];

    echo "<tr>";
      echo "<th scope='row'>$noid</th>";
      echo "<th scope='row'>$id</th>"; 
      echo "<td>$name</td>";
      echo "<td>$section</td>";
      echo "<td>$grade</td>";
      echo "<td>$timestmp</td>";
      echo "<td><a class='btn btn-success btn-sm' download href='../$filename'>Retrieve</a></td>";
      echo '</tr>';
    }
    } else {
      echo '    
      <div style="margin-top:10%;margin-left:15%" class="alert alert-danger" role="alert">
        <strong>Warning:</strong> No data present, the data being fetched is missing
      </div>
      ';
    }
    ?>

  </tbody>
  </form>
</table>
</div>
</div>



</div>


<!-- <div class="footer">
    <div>
        <a style="color:white" href="#footerlink">Copyright 2020</a>
    </div>
</div> -->



<div id="container1" style="margin-top:-42%;margin-left:20%;display:block" class="container">

<div class="container">
<h1 style="margin-top:5%" class="black-text text-center">ADMIN CONTROLS EVERYTHING</h1>
    <hr style="width:50%"/>
    <p style="margin-top:-1%" class="grey-text text-center" style="margin-top:5%">
    Below are the control access the admin has to the teachers that submitted the report
    </p>
</div>

<div style="margin-left:-6%;margin-top:-5%" class="container">
<table class="table">
<thead>
<tr>
  <th scope="col">#</th>
  <th scope="col">Teacher</th>
  <th scope="col">Section</th>
  <th scope="col">Grade</th>
  <th scope="col">Time Submitted</th>
  <th scope="col">Action</th>
  <th scope="col">Control</th>
</tr>
</thead>
<tbody>
<form action="dashboard.php" method="get">
<?php
$qry = "select * from file";
$result = mysqli_query($db,$qry);

if (mysqli_num_rows($result) > 0) {
// output data of each row
while($row = mysqli_fetch_assoc($result)) {
//echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
$id = $row['id'];
$name = $row['teacher'];
$section = $row['section'];
$grade = $row['grade'];
$filename = $row['filedir'];
$timestmp = $row['timestamp'];

echo "<tr>";
echo "<th scope='row'>$id</th>";
echo "<td>$name</td>";
echo "<td>$section</td>";
echo "<td>$grade</td>";
echo "<td>$timestmp</td>";
echo '<td><a 
style="color:white"
href="view.php?file='.$filename.'"
target="_blank"
class="btn btn-sm btn-primary">
view
</a></td>';
echo '<td><a style="color:white" data-toggle="modal" data-target="#exampleModal" 
class="btn btn-sm btn-danger">
delete
</a></td>
</tr>';

echo '
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Deletion of Record</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Deleting this record means that you wont be able to access this record again.
        This Account will be deleted from our database and therefore will be archived.
        <strong>ID Number: '.$id.' </strong>will be processed.
      </div>
      <div class="modal-footer">

      <a href="delete.php?id='.$id.'" class="btn btn-danger">Delete Record</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

';
}
} else {
  echo '    
      <div style="margin-top:10%;margin-left:15%" class="alert alert-danger" role="alert">
        <strong>Warning:</strong> No data present, the data being fetched is missing
      </div>
      ';
}
?>

</tbody>
</form>
</table>
</div>
</div>



<!-- Modal -->


<!-- Modal Ends -->


<style>
.footer {
   left: 0;
   padding:25px;
   bottom: 0;
   width: 100%;
   color: white;
   text-align: center;
   background: #212121
}
.grey-text{
  color:grey;
}

</style> 


<!-- JAVASCRIPT GRAPH -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	
    
    <script type="text/javascript">
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
var data = google.visualization.arrayToDataTable([
['Task', 'Hours per Day'],
['English', 400],
['Mathematics', 1],
['Filipino', 23],
['Science', 40],
['Aral Panlipunan', 60],
['Mapeh', 23],
['EPP', 40],
['ESP', 60],
]);

// Optional; add a title and set the width and height of the chart
var options = {backgroundColor: 'transparent','title':'Highest Average', 'width':550, 'height':400};

// Display the chart inside the <div> element with id="piechart"
var chart = new google.visualization.PieChart(document.getElementById('piechart'));
chart.draw(data, options);
}
</script>



<script>
document.getElementById('container3').style.display="none";
function hehe(){
    window.alert('Hello');
}
//javascript to display per feature on side navigation
function displayOne(){
    document.getElementById('container1').style.display = "block";
    var z = document.getElementById('container3');
    z.style.display = "none";
}
function displayTwo(){
    var x = document.getElementById('container-1');
    var y = document.getElementById('container-2');
    var z = document.getElementById('container3');

    // var a = document.getElementById('active-1');
    // var b = document.getElementById('acactive-2tive-2');
    // var c = document.getElementById('active-3');

    x.style.display = "none";
    y.style.display = "block";
    z.style.display = "none";

    // a.classList.remove("active");
    // b.classList.add("active");
}
function displayThree(){
    document.getElementById('container1').style.display = "none";
    document.getElementById('container3').style.display="block";
}
function hehe(){
  window.alert('hello ');
}
</script>
<script src="main.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>