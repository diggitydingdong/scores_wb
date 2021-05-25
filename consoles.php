<?php
  include 'header.php';
?>

<h5 class="mt-2 ml-2 text-light">Submit console:</h5>
<form class="mx-2 text-light" action="includes/sub_console.inc.php" method="post">
  <div class="form-group">
    <input class="form-control" id="console_input" name="console_input">
  </div>
  <button type="submit" class="btn btn-primary" name="console_submit">Submit</button>
</form>

<table class="mt-5 table table-dark">
  <thead>
    <tr>
      <th scope="col">Console</th>
      <th scope="col">Number of games</th>
      <th scope="col">Number of scores</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $sql = 'SELECT *,
                (SELECT COUNT(*)
                  FROM games
                  WHERE games_console = consoles.consoles_id) as gamecount,
                (SELECT COUNT(*)
                  FROM (SELECT * FROM scores LEFT JOIN games ON games_id = scores_game) as a_t
                  WHERE games_console = consoles.consoles_id) as scorecount
              FROM consoles
              ORDER BY consoles_name';

      $result = mysqli_query($conn, $sql);

      while($row = mysqli_fetch_assoc($result))
      {
        echo '<tr>
                <td><a href="/scores/games?c='.$row['consoles_id'].'">'.$row['consoles_name'].'</a></td>
                <td>'.$row['gamecount'].'</td>
                <td>'.$row['scorecount'].'</td>
              </tr>';
      }
    ?>
  </tbody>
</table>

<?php
  include 'end.php';
?>
