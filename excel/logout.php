r<?php
session_start();
?>

<?php
// remove all session variables
session_unset();

// destroy the session
session_destroy();
echo "<script type='text/javascript'>alert('User has successfully logged out');</script>";   
header("Location: index.php");
?>