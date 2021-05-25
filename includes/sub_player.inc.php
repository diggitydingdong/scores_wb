<?php
if(isset($_POST['player_input']))
{
  include 'dbh.inc.php';

  $p = $_POST['player_input'];

  $sql = "INSERT INTO players (players_name) VALUES ('$p')";

  // echo $sql;

  mysqli_query($conn, $sql);
  header("Location: ../players");
}
else
{
  header("Location: ../");
}
?>
