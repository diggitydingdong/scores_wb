<?php
if(isset($_POST['score_input']))
{
  include 'dbh.inc.php';

  $p = $_POST['player_select'];
  $g = $_POST['game_select'];
  $s = intval($_POST['score_input']);
  $d = $_POST['date_input'].date(" H:m:s", time());

  $sql = "INSERT INTO scores (scores_score, scores_player, scores_game, scores_date) VALUES ($s, $p, $g, '$d')";

  // echo $sql;

  mysqli_query($conn, $sql);
  header("Location: ../");
}
else
{
  header("Location: ../");
}
?>
