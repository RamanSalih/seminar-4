<?php 
  include('connect.php');
	
  session_start();
  $sql = "SELECT favourite FROM users WHERE username = '" . $_SESSION['username'] . "';";
  $result = mysqli_query($link, $sql);

  echo mysqli_fetch_row($result)[0];
?>