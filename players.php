<?php
  include 'header.php';
?>

<h5 class="mt-2 ml-2 text-light">Submit player:</h5>
<form class="mx-2 text-light" action="includes/sub_player.inc.php" method="post">
  <div class="form-group">
    <input class="form-control" id="player_input" name="player_input">
  </div>
  <button type="submit" class="btn btn-primary" name="player_submit">Submit</button>
</form>

<table class="mt-5 table table-dark">
  <thead>
    <tr>
      <th scope="col">Player</th>
      <th scope="col">Number of scores</th>
      <th scope="col">Number of high scores</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $sql = 'SELECT *,
                (SELECT COUNT(*)
                  FROM scores
                  WHERE scores_player = players.players_id) as scorecount,
                (SELECT COUNT(*)
                  FROM (SELECT a.*
                          FROM scores a
                          LEFT OUTER JOIN scores b
                            ON a.scores_game = b.scores_game
                            AND a.scores_score < b.scores_score 
                          WHERE b.scores_game IS NULL) as maxscore
                  WHERE scores_player = players.players_id) as highscorecount
              FROM players
              ORDER BY players_name';

      $result = mysqli_query($conn, $sql);
      echo $sql;
      while($row = mysqli_fetch_assoc($result))
      {
        echo '<tr>
                <td><a href="/scores?p='.$row['players_id'].'">'.$row['players_name'].'</a></td>
                <td>'.$row['scorecount'].'</td>
                <td>'.$row['highscorecount'].'</td>
              </tr>';
      }
    ?>
  </tbody>
</table>

<?php
  include 'end.php';
?>
