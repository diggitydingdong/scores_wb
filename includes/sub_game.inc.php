<?php
if(isset($_POST['game_input']))
{
  include 'dbh.inc.php';

  $g = $_POST['game_input'];
  $c = $_POST['console_select'];

  $sql = "INSERT INTO games (games_name, games_console) VALUES ('$g', $c)";

  // echo $sql;

  mysqli_query($conn, $sql);
  header("Location: ../games");
}
else
{
  header("Location: ../");
}
?>
