<?php
    session_start();
    include_once '../dbconnect.php';
    //library for reading excel files
    include_once "../Classes/PHPExcel.php";

    //syntax for reading file IO :D
      $tmpfname = '../test.xlsx';
      $excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
      $excelObj = $excelReader->load($tmpfname);
      $worksheet = $excelObj->getSheet(0);
    //verify admin already logged in
    if(isset($_SESSION['loggedinadmin'])){
      echo "<script type='text/javascript'>alert('Admin Session Exists');</script>";   
      //header("Location: dashboard.php");
    }
    else{
      echo "<script type='text/javascript'>alert('Admin Session Expired');</script>";   
      header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title>Admin Side</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>

<nav style="margin-top:0%" class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/consolidated/excel/index.php">Consolidated App</a>
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
        <a class="dropdown-item" href="../excel/edit.php">Edit Account</a>
        <a class="dropdown-item" href="../excel/delete.php">Delete Account</a>
          <a class="dropdown-item" href="../excel/logout.php">Logout</a>
        </div>
      </li>
    </ul>
  </div>
</nav>

<?php 
     $lastRow = $worksheet->getHighestRow();
     echo '<div class="container mt-5">';
     echo '<h1 class="text-center">MONTHLY CONSOLIDATED REPORTS</h1>';
     echo '<hr style="width:20%"/>';
     echo '<p class="grey-text text-center">below are the reports which teacher you used</p>';
     echo' <table class="table">';
      for ($row = 1; $row <= $lastRow; $row++) {
              $a = $worksheet->getCell('A'.$row)->getCalculatedValue();
              $b = $worksheet->getCell('B'.$row)->getCalculatedValue();
              $c =  $worksheet->getCell('C'.$row)->getCalculatedValue();
              $d =  $worksheet->getCell('D'.$row)->getCalculatedValue();
              $e =  $worksheet->getCell('E'.$row)->getCalculatedValue();
              $f =  $worksheet->getCell('F'.$row)->getCalculatedValue();
              $h =  $worksheet->getCell('H'.$row)->getCalculatedValue();

              echo '<tr><td>';
              echo $a;
              echo '</td></td>';

              echo '<td><td>';
              echo $b;
              echo '</td></td';

              echo '<td><td>';
              echo $c;
              echo '</td></td';

              echo '<td><td>';
              echo $d;
              echo '</td></td';

              echo '<td><td>';
              echo $e;
              echo '</td></td';

              echo '<td><td>';
              echo $f;
              echo '</td></tr>';
      }
    echo' </table>';
    echo '</div>';

?>
<div class="container">
<h1 style="text-transform:uppercase" class="text-center">
      Admin Contoller
</h1>
<p style="color:grey" class="grey-text text-center">
      Below are the control access the admin has to the teachers
</p>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Teacher</th>
      <th scope="col">Section</th>
      <th scope="col">Grade Handled</th>
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

    echo "<tr>";
      echo "<th scope='row'>$id</th>";
      echo "<td>$name</td>";
      echo "<td>$section</td>";
      echo "<td>$grade</td>";
      echo '<td><a 
      style="color:white"
      href="view.php?file='.$filename.'"
      target="_blank"
      class="btn btn-sm btn-primary">
      view
      </a></td>';
      echo '<td><a 
      href="delete.php?id='.$id.'"
      class="btn btn-sm btn-danger">
      delete
      </a></td>
    </tr>';
    }
    } else {
        //echo "0 results";
    }
    ?>

  </tbody>
  </form>
</table>
<?php

  if(isset($_POST['btnPushUpdate'])){
    if(isset($_POST['filename'])){
      $filename = $_POST['filename'];
      $updateQuery = "insert into updates(filename) values('$filename')";
      $pushUpdate = mysqli_query($db,$updateQuery);

      if($pushUpdate>0){
        echo "<script type='text/javascript'>alert('Admin Action: update push successful!');</script>";   
      }
      else{
        echo "<script type='text/javascript'>alert('Admin Action: update push has failed');</script>";   
      }
    }
  }
?>
    <div class="container">
        <h1 style="text-transform:uppercase" class="text-center">
        Updated Format File Transfer
        </h1>
        <p style="color:grey" class="grey-text text-center">
            Below are where the admin sends an updated file format for the teachers
        </p>
    </div>
    <div class="container">
        <form method="POST" action="dashboard.php">
          <div style="width:50%; margin-left:25%" class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
          </div>
          <div class="custom-file">
            <input 
            type="file" 
            class="custom-file-input" 
            id="inputGroupFile01" 
            name="filename"
            aria-describedby="inputGroupFileAddon01">
            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
          </div>
          <button 
          class="btn btn-success btn-sm ml-3"
          name="btnPushUpdate">
          PASS FILE TO TEACHERS
          </button>
        </div>
        </form>
    </div>
</div>

<!-- 
<div class="footer bg-dark">
    <div>
        <a style="color:white" href="#footerlink">Copyright 2020</a>
    </div>
</div> -->

<style>
.footer {
   left: 0;
   position: fixed;
   padding:15px;
   bottom: 0;
   width: 100%;
   color: white;
   text-align: center;
}
.grey-text{
  color:grey;
}
</style> 


<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>