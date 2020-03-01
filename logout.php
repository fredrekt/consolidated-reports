<?php
session_start();
session_destroy();
?>
<?php

header('location:index.php');



?>
<script>window.location.replace("index.php");</script>