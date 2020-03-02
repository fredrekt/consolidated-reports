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
    <!-- <ul class="navbar-nav ml-auto">
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
    </ul> -->
  </div>
</nav>
<?php
    include_once '../dbconnect.php';
    //import PHPExcel Library to read excel files
    include_once "../Classes/PHPExcel.php";
    
    if(isset($_GET['file'])){

      $filename = $_GET['file'];
      $tmpfname = '../'.$filename;
      $excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
    //   $excelReader->setPreCalculateFormulas(true);
    //   $excelReader->save($tmpfname);
      $excelObj = $excelReader->load($tmpfname);
      $worksheet = $excelObj->getSheet(0);

      //displaying what the file reads (excel)
      $lastRow = $worksheet->getHighestRow();
     echo '<div class="container mt-5">';
     echo '<h1 class="text-center">MONTHLY CONSOLIDATED REPORTS</h1>';
     echo '<hr style="width:20%"/>';
     echo '<p class="grey-text text-center">below are the reports which teacher you used</p>';
     echo' <table class="table">';
      for ($row = 1; $row <= $lastRow; $row++) {
              $a = $worksheet->getCell('A'.$row)->getValue();
              $b = $worksheet->getCell('B'.$row)->getValue();
              $c =  $worksheet->getCell('C'.$row)->getValue();
              $d =  $worksheet->getCell('D'.$row)->getValue();
              $e =  $worksheet->getCell('E'.$row)->getValue();
              $f =  $worksheet->getCell('F'.$row)->getValue();
              $h =  $worksheet->getCell('H'.$row)->getValue();

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
    }
?>

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