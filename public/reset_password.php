<?php
  require'../inc/config.php';

  global $formOK;
// Récupérer le token via URL
  if (!empty($_GET['token'])) {
    $token = isset($_GET['token']) ? strip_tags(trim($_GET['token'])) : '';;
    // echo $email.'<br>'.$token;
    $formOK = true;
    $sql = 'SELECT *
            FROM user
            WHERE usr_token = :token';
    $pdoStatement = $pdo->prepare($sql);
    // Je définis la valeur pour chaque token de requête
    $pdoStatement->bindValue(':token', $token);
    // J'exécute la requête !! (car pas encore exécuté)
    if ($pdoStatement->execute() === false ) { // Si erreur
      print_r($pdoStatement->errorInfo());
    }
    else {
      // Je récupère les résultats comme avant
      $userResult = $pdoStatement->fetch(PDO::FETCH_ASSOC);
      if ($pdoStatement->rowCount() > 0) {
        // print_r($userResult);
        $formOK = true;
        // echo "user trouvé";
      }
      else {
        $formOK = false;
        echo "token non trouvé";
      }
    }
  }


  if(!empty($_POST)){
    $firstpass = isset($_POST['choixpass1']) ? strip_tags(trim($_POST['choixpass1'])) : '';
    $secondpass = isset($_POST['choixpass2']) ? strip_tags(trim($_POST['choixpass2'])) : '';

    $token = isset($_GET['token']) ? strip_tags(trim($_GET['token'])) : '';

    $formValid = true;

    if($firstpass !== $secondpass){
      $formValid = false;
      echo 'Mots de passe ne correspondent pas';
    }

    if(empty($firstpass) || empty($secondpass)){
      $formValid = false;
      echo 'Mots de passe vides';
    }

    if (strlen($firstpass) < 8 || strlen($secondpass) < 8) {
  		$formValid = false;
      echo 'Mots de passe trop petits';
    }

    if($formValid){
      $updatepassSql = 'UPDATE user SET usr_password = :newpass, usr_token= " " WHERE usr_token = :token';
      $pdoStatement = $pdo->prepare($updatepassSql);
      $newhashedPassword = password_hash($firstpass, PASSWORD_BCRYPT);
      $pdoStatement->bindValue(':newpass', $newhashedPassword);
      $pdoStatement->bindValue(':token', $token);


      if ($pdoStatement->execute() === false) {
  			print_r($pdoStatement->errorInfo());
  		}
  		// Si aucun erreur SQL
  		else {
  			echo 'Mot de passe redéfini!';
        header('Location: signin.php');
  		}
    }
  }









  require'../view/header.php';
  require'../view/reset_password.php';
  require'../view/footer.php';

 ?>
