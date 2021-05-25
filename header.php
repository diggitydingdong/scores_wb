<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Highscores</title>
    <meta charset="utf-8">
    <meta name="description" content="Highscores">

  	<!-- Bootstrap, JQuery -->
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

  	<link rel="stylesheet" href="/scores/style.css">
  </head>
  <body class="bg-secondary">
    <?php
  		include_once 'includes/dbh.inc.php';
  		include 'includes/func.inc.php';
  	?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a href="/scores/" class="navbar-brand">scores</a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="/scores/">Scores</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/scores/consoles">Consoles</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/scores/games">Games</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/scores/players">Players</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-success" href="https://10.1.64.90/catalog/">Catalog</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-primary" href="https://10.1.64.105:2000">Snake</a>
          </li>
        </ul>
      </div>
    </nav>
