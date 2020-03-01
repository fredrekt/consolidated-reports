
<?php
session_start(); 





//echo($_SESSION["login"]);
include_once 'dbconnect.php';

    if(isset($_POST['btnLogin'])){
        
        $user=$_POST['username'];
        $pwd=$_POST['password'];
        

        // To protect MySQL injection for Security purpose
        $username = stripslashes($user);
        $password = stripslashes($pwd);
        $username = mysql_real_escape_string($user);
        $password = mysql_real_escape_string($pwd);

        $query="SELECT username FROM users where username='$username'";
        $verifyUser=mysql_query($query);
        $count = mysql_num_rows($verifyUser);

        $query2="SELECT * FROM users where username='$username' and password='$password'";
        $verifyPass=mysql_query($query2);
        $result=mysql_num_rows($verifyPass);
    
            
                if($count){
                    if(!$result){
                        echo '<script type="text/javascript"> alert("Invalid Access");</script>';
                       
                    } else{
                   
                        $_SESSION["login"]=1;
                        while ($row = mysql_fetch_array($verifyPass)) {
                      
                            $_SESSION["username"] = $row['username'];
                            $_SESSION["password"] = $row['password'];
                          
                            break;
                        }
                      echo '<script type="text/javascript">window.location.href="adminhome.php"; </script>';
                    }
                } else{
                    echo '<script type="text/javascript"> alert("Invalid Access");</script>';
                    
                }
             
    }
?>
<?php
           if (isset($_GET['id'])) {
               $con = mysql_connect('localhost', 'root', '') or die(mysql_error());
               $db = mysql_select_db('php', $con);
               $id = $_GET['id'];
               $query = "SELECT name, type, size, content " .
                       "FROM upload WHERE id = '$id'";
               $result = mysql_query($query) or die('Error, query failed');
               list($name, $type, $size, $content) = mysql_fetch_array($result);
               header("Content-length: $size");
               header("Content-type: $type");
               header("Content-Disposition: attachment; filename=$name");
               ob_clean();
               flush();
               echo $content;
               mysql_close();
               exit;
           }
           ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Search</title>
		<link rel="stylesheet" type="text/css" href="css/main.css">
		
		<script>
			function openForm() {
				document.getElementById("myForm").style.display = "block";
				document.getElementById("login").style.display = "none";
			}

			function closeForm() {
				document.getElementById("myForm").style.display = "none";
				document.getElementById("login").style.display = "block";
			}
		</script>
	</head>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">


	<body>
		
		<div class="topnav" align="center">
  		<a class="active" href="index.php">Home</a>
		<a href="files.php">Files</a>
  		<a href="#">About</a>
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
			
		</div></div><br><div class="bgimg-3"><div class=""><h2 align="center"style="color: black">Files Available</h2>
		<div class="boxedleft""><form method="POST" action="search.php">
				<input type="text" placeholder="Search" name="search">

				<button type="submit" class="btn" name="searchit"><img src="images/search.png" alt="Download file" style="width:32px;height:32px;border:0;"></button>
				</form></div>
		<?php
        
		
		$search = $_POST['search'];
		//echo($search);
		$con = mysql_connect('localhost', 'root', '') or die(mysql_error());
        $db = mysql_select_db('php', $con);
        $query = "SELECT id, filetext, description, name FROM upload WHERE filetext like '%".$search."%' OR description like '%".$search."%'";
        $result = mysql_query($query) or die('Error, query failed');?>
		
		<table style="width:70%">
		<tr>
			<th>File</th>
			<th>Description</th> 
			<th>Download</th>
		</tr>
		<?php
		if (mysql_num_rows($result) == 0) {
            echo "Database is empty <br>";
        } else {
            while (list($id, $filetext, $description, $name) = mysql_fetch_array($result)) {
                  ?>
				 <tr>
				 <td align="center" width="20%"><b><?php echo($filetext);   ?></b></td>
				 <td width="60%" align="center"><small><?php echo($description);  ?></small></td>
                <td align="center"width="10%"><a href="search.php?id=<?php echo urlencode($id); ?>"
                   ><img src="images/download.png" alt="Download file" style="width:32px;height:32px;border:0;"></a></td>
				
				</tr><?php
            }
        }
		?></table><?php
        mysql_close();
        ?>
  			</div>
  			
		</div>	
    		
		
		
  			
		
		

		
		
		
		

		<footer>
    		<ul>
        		<li><a href="mailto:carlollada@gmail.com">email</a></li>
        		<li><a href="https://github.com/carlollada">github.com/carlollada</a></li>
			</ul>
		</footer>
	</body>
</html>
