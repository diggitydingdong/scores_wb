<?php
  include 'header.php';
?>

<h5 class="mt-2 ml-2 text-light">Submit score:</h5>
<form class="mx-2 text-light" action="includes/sub_score.inc.php" method="post">
  <div class="form-group">
    <label for="player_select">Players</label>
    <select class="form-control" id="player_select" name="player_select">
      <!-- <option value="null">Select a player</option> -->
      <?php
        $sql = "SELECT * FROM players ORDER BY players_name";

        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result))
        {
          echo '<option value="'.$row['players_id'].'">'.$row['players_name'].'</option>';
        }
      ?>
    </select>
  </div>
  <div class="form-group">
    <label for="game_select">Games</label>
    <select class="form-control" id="game_select" name="game_select">
      <!-- <option value="null">Select a game</option> -->
      <?php
        $sql = "SELECT * FROM games LEFT JOIN consoles ON games_console = consoles_id ORDER BY games_name";

        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result))
        {
          echo '<option value="'.$row['games_id'].'">'.$row['games_name'].' ('.$row['consoles_name'].')</option>';
        }
      ?>
    </select>
  </div>
  <div class="form-group">
    <label for="score_input">Score</label>
    <input type="number" class="form-control" id="score_input" name="score_input">
  </div>
  <div class="form-group">
    <label for="date_input">Date</label>
    <input type="date" class="form-control" id="date_input" name="date_input">
  </div>
  <button type="submit" class="btn btn-primary" name="score_submit">Submit Score</button>
</form>

<table class="mt-5 table table-dark">
  <thead>
    <tr>
      <th scope="col">Game</th>
      <th scope="col">Player</th>
      <th scope="col">Score</th>
      <th scope="col">Date</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $sql = 'SELECT *, scores_score as score FROM scores
                LEFT JOIN games ON games.games_id = scores.scores_game
                LEFT JOIN players ON players.players_id = scores.scores_player';
      if(isset($_GET['g']))
      {
        $sql = 'SELECT *, MAX(scores_score) as score FROM scores
                  LEFT JOIN games ON games.games_id = scores.scores_game
                  LEFT JOIN players ON players.players_id = scores.scores_player
                  WHERE scores_game = ' . intval($_GET['g']) . '
                  GROUP BY scores_player ORDER BY score DESC;';
      }
      else if(isset($_GET['p']))
      {
        $sql = 'SELECT *, scores_score as score FROM scores
                  LEFT JOIN games ON games.games_id = scores.scores_game
                  LEFT JOIN players ON players.players_id = scores.scores_player
                  INNER JOIN
                    (SELECT scores_game, MAX(scores_score) AS maxscore
                    FROM scores
                    WHERE scores_player = ' . intval($_GET['p']) . '
                    GROUP BY scores_game
                    ) groupedscores
                  ON scores.scores_game = groupedscores.scores_game
                  AND scores.scores_score = groupedscores.maxscore
                  WHERE scores_player = ' . intval($_GET['p']) . '
                  ORDER BY games_name;';
      }
      else { $sql.=" ORDER BY scores_date DESC;"; }

      $result = mysqli_query($conn, $sql);
      // echo $sql;
      while($row = mysqli_fetch_assoc($result))
      {
        echo '<tr>
                <td><a href="?g='.$row['games_id'].'">'.$row['games_name'].'</a></td>
                <td><a href="?p='.$row['players_id'].'">'.$row['players_name'].'</a></td>
                <td>'.$row['score'].'</td>
                <td>'.english_days(days_ago($row['scores_date'])).'</td>
              </tr>';
      }
    ?>
  </tbody>
</table>

<?php
  include 'end.php';
?>
