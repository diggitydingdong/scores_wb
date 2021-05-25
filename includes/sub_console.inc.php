<?php
if(isset($_POST['console_input']))
{
  include 'dbh.inc.php';

  $c = $_POST['console_input'];

  $sql = "INSERT INTO consoles (consoles_name) VALUES ('$c')";

  // echo $sql;

  mysqli_query($conn, $sql);
  header("Location: ../consoles");
}
else
{
  header("Location: ../");
}
?>
