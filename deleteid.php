<?php
           if (isset($_GET['id'])) {
			   $id=$_GET['id'];
               $con = mysql_connect('localhost', 'root', '') or die(mysql_error());
               $db = mysql_select_db('php', $con);
               $id = $_GET['id'];
               $query = "DELETE " .
                       "FROM upload WHERE id = '$id'";
               $result = mysql_query($query) or die('Error, query failed');
              
               mysql_close();
             //  exit;
			   header('location:adminhome.php');
           }
           ?>
<script>window.location.replace("adminhome.php");</script>