<?php
  include 'header.php';
?>

<h5 class="mt-2 ml-2 text-light">Submit game:</h5>
<form class="mx-2 text-light" action="includes/sub_game.inc.php" method="post">
  <div class="form-group">
    <label for="game_input">Game:</label>
    <input class="form-control" id="game_input" name="game_input">
  </div>
  <div class="form-group">
    <label for="console_select">Consoles:</label>
    <select class="form-control" id="console_select" name="console_select">
      <!-- <option value="null">Select a game</option> -->
      <?php
        $sql = "SELECT * FROM consoles";

        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result))
        {
          echo '<option value="'.$row['consoles_id'].'">'.$row['consoles_name'].'</option>';
        }
      ?>
    </select>
  </div>
  <button type="submit" class="btn btn-primary" name="game_submit">Submit</button>
</form>

<table class="mt-5 table table-dark">
  <thead>
    <tr>
      <th scope="col">Game</th>
      <th scope="col">Console</th>
      <th scope="col">Number of scores</th>
      <th scope="col">Highscore</th>
      <th scope="col">Person with high score</th>
    </tr>
  </thead>
  <tbody>
    <?php
    // (SELECT COUNT(*)
    //   FROM scores
    //   WHERE scores_player = players.players_id)
      $a = '';
      if(isset($_GET['c']))
      {
        $a = " WHERE games_console = ".$_GET['c'];
      }

      $sql = 'SELECT *,
                  (SELECT COUNT(*)
                    FROM scores
                    WHERE scores_game = games_id) as scorecount,
                  (SELECT MAX(scores_score)
                    FROM scores
                    WHERE scores_game = games_id) as highscore
                FROM games
                LEFT JOIN consoles ON games_console = consoles_id
                LEFT JOIN players ON
                    (SELECT scores_player
                      FROM (SELECT a.*
                              FROM scores a
                              LEFT OUTER JOIN scores b
                                ON a.scores_game = b.scores_game
                                AND (a.scores_score < b.scores_score
                                      OR (a.scores_score = b.scores_score
                                          AND a.scores_date > b.scores_date))
                              WHERE b.scores_game IS NULL) as hs_t
                      WHERE scores_game = games.games_id) = players_id
                '.$a.'
                ORDER BY games_name';

      $result = mysqli_query($conn, $sql);
      // echo mysqli_errno($conn);
      // echo $sql;
      while($row = mysqli_fetch_assoc($result))
      {
        echo '<tr>
                <td><a href="/scores?g='.$row['games_id'].'">'.$row['games_name'].'</a></td>
                <td>'.$row['consoles_name'].'</td>
                <td>'.$row['scorecount'].'</td>
                <td>'.$row['highscore'].'</td>
                <td><a href="/scores?p='.$row['players_id'].'">'.$row['players_name'].'</a></td>
              </tr>';
      }
    ?>
  </tbody>
</table>

<?php
  include 'end.php';
?>
