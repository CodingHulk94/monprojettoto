<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Header</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="../public/css/style.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
  </head>
  <body>
    <header>
      <nav class="navbar navbar-default" style="background-color:blue">
        <ul class="nav navbar-left">
          <li><a href="index.php">HOME</a></li>
          <?php if(!empty($_SESSION)) : ?>
            <?php if(isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'admin' || $_SESSION['userRole'] == 'admin') : ?>
              <li><a href="index.php">SESSIONS</a></li>
              <li><a href="list.php">ETUDIANTS</a></li>
            <?php endif; ?>
          <?php endif; ?>
          <?php if(isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'admin') : ?>
            <li><a href="add.php">AJOUTER UN ETUDIANT</a></li>
          <?php endif; ?>
          <?php if(empty($_SESSION)) : ?>
            <li><a href="signup.php">Sign Up</a></li>
            <li><a href="signin.php">Sign In</a></li>
          <?php endif; ?>
          <?php if (isset($_SESSION['userID'])) : ?>
            <li class="navbar-text">Votre user ID est: <?=$_SESSION['userID']?></li>
            <li class="navbar-text">Votre adresse IP est: <?=$_SERVER["REMOTE_ADDR"]?></li>
            <li>
              <a href="signin.php?signout=1">Sign Out</a>
            </li>
          <?php endif; ?>
        </ul>
          <form class="navbar-form navbar-right" action="list.php" method="get" style="margin-top:33px; margin-right:1%;">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Recherche" name="motrecherche" value="">
            </div>
            <button type="submit" class="btn btn-default" name="" value="">Rechercher</button>
          </form>
      </nav>
    </header>
