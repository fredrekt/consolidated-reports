
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
           if (isset($_GET['submit'])) {
			   $id=$_GET['id'];
			   $filetext=$_GET['filetext'];
			   $description=$_GET['description'];
			   echo($id);
			   echo($filetext);
			   echo($description);
               $con = mysql_connect('localhost', 'root', '') or die(mysql_error());
               $db = mysql_select_db('php', $con);
               $id = $_GET['id'];
               $query = "UPDATE upload SET filetext='$filetext', description='$description' WHERE id='$id'";
	
               $result = mysql_query($query) or die('Error, query failed');
              
               mysql_close();
             //  exit;
			  header('location:adminhome.php');
           }
           ?>

<html>
	<head>
		<title>Repository Control</title>
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
		
		<div class="topnav" align="center">
  		<a class="active" href="adminhome.php">Home</a>
		<a href="files.php">Files</a>
  		<a href="#">About</a>
		<a></a>
		<button type="submit" class="open-button" id="login" onclick="openForm()">Logout</button>
		
		

		</div>
		
		
		 <?php
		if (isset($_GET['idd'])){
		$idd=$_GET['idd'];
        $con = mysql_connect('localhost', 'root', '') or die(mysql_error());
        $db = mysql_select_db('php', $con);
        $query = "SELECT id, filetext, description, name FROM upload WHERE id = '$idd'";
        $result = mysql_query($query) or die('Error, query failed');?>
        
		<br><br>
		<form method="GET" action="updateid.php?">
		<table style="width:80%">
		<tr>
			<th>File</th>
			<th>Description</th>
			<th>Update</th>
			
		</tr>
		<?php
		if (mysql_num_rows($result) == 0) {
            echo "Database is empty <br>";
        } else {
            while (list($id, $filetext, $description, $name) = mysql_fetch_array($result)) {
                  ?>
				 <tr>
				 <td align="center" width="20%"><b>
				 <input type="hidden" name="id"
                               value="<?php echo($id);?>">
				 <input type="text" placeholder="" name="filetext" id="fname"value="<?php echo($filetext);?>"></b></td>
				 <td align="center" width="20%"><b><input type="text" placeholder="" name="description" id="desc"value="<?php echo($description);?>"></b></td>
				 <td align="center"> <button type="submit" name="submit" value="Update"><img src="images/update.png" alt="Update file" style="width:32px;height:32px;border:0;"></button></td>
				<!--<td align="center"width="10%"><a href="updateid.php?id=<?php echo($id);?>&filetext=<?php echo $_GET['filetext'];?>&description=<?php echo $_GET['description'];?>"
                   ><img src="images/update.png" alt="Update file" style="width:32px;height:32px;border:0;"></a></td>
				-->
				</tr><?php
            }
        }
		?></table></form><?php
        mysql_close();
        }?>
		
		
		

		<footer>
    		<ul>
        		<li><a href="mailto:carlollada@gmail.com">email</a></li>
        		<li><a href="https://github.com/carlollada">github.com/carlollada</a></li>
			</ul>
		</footer>
	</body>
</html>
