<html>
	<head>
		<title>Repository</title>
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
  		<a  href="index.php">Home</a>
		<a class="active" href="#">Files</a>
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
		</div></div>
				
  			</div></div><br><div class="bgimg-2ss"><div class="boxedssright"><h2 align="center"style="color: black">Files Available</h2>
			<form  style="margin-left:10%"method="POST" action="search.php">
				<input type="text" placeholder="Search" name="search">

				<button type="submit" class="btn" name="searchit"><img src="images/search.png" alt="Download file" style="width:32px;height:32px;border:0;"></button>
				</form>
			
			<?php
        $con = mysql_connect('localhost', 'root', '') or die(mysql_error());
        $db = mysql_select_db('php', $con);
        $query = "SELECT id, filetext, description, name FROM upload";
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
                <td align="center"width="10%"><a href="index.php?id=<?php echo urlencode($id); ?>"
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
