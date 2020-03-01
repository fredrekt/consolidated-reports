<?php
    include_once '../dbconnect.php';
    
    require_once '../Classes/PHPExcel.php';

      // echo $txtGrade, $txtSection;

      include_once "../Classes/PHPExcel.php";

      $tmpfname = '../test.xlsx';
          $excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
          //$excelReader->setPreCalculateFormulas(true);
          $excelObj = $excelReader->load($tmpfname);
         // $worksheet = $excelObj->setPreCalculateFormulate(true);
          //$worksheet->setPreCalculateFormulas(true);
         $worksheet = $excelObj->getSheet(0);
          //$worksheet->setPreCalculateFormulas(true);

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

<?php 
     $lastRow = $worksheet->getHighestRow();
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
              echo '</td></td';

              echo '<td><td>';
              echo $h;
              
              echo '</td></tr>';
      }
    echo' </table>';

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
      <th scope="col">Alter</th>
      <th scope="col">Control</th>
    </tr>
  </thead>
  <tbody>
  <form action="index.php" method="get">
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
      echo "<input hidden value='$id'/>";
      echo "<th scope='row'>$id</th>";
      echo "<td>$name</td>";
      echo "<td>$section</td>";
      echo "<td>$grade</td>";
      echo '<td><button 
      name="btnView"
      class="btn btn-sm btn-primary">
      view
      </button></td>';
      echo "<td>
            <button 
            name='btnEdit'
            class='btn btn-sm btn-success'>
                edit
            </button>
      </td>";
      echo '<td><button 
      name="btnDelete"
      class="btn btn-sm btn-danger">
      delete
      </button></td>
    </tr>';
    }
    } else {
        echo "0 results";
    }
    ?>

  </tbody>
  </form>
</table>
<?php
     
     if(isset($_GET['btnView'])){
        echo "<script type='text/javascript'>alert('Button View');</script>";   
    }
    
    if(isset($_GET['btnEdit'])){
        echo "<script type='text/javascript'>alert('Button Edit');</script>";   
    }
    
    if(isset($_GET['btnDelete'])){
        //$qryDelete = "delete from file id= '' ";
        echo "<script type='text/javascript'>alert('Button Deleted'$id);</script>";   
    }
?>

    <div class="container">
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
</style> 


<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>