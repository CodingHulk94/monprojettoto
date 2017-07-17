<?php

require'../inc/config.php';

$successTxt = '';
$errorList = array();
$email = '';

if (!empty($_POST)) {
	// Récupération & Traitement des données
	$email = isset($_POST['emailToto']) ? strip_tags(trim($_POST['emailToto'])) : '';
	$password = isset($_POST['passwordToto1']) ? trim($_POST['passwordToto1']) : '';

  $formValid = true;

	if (empty($email)) {
		$formValid = false;
		$errorList['emailToto'][] = 'L\'email est vide';
	}
	else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
		$formValid = false;
		$errorList['emailToto'][] = 'L\'email est invalide';
	}

  emailvalidator($email);

	if (empty($password)) {
		$formValid = false;
		$errorList['passwordToto'][] = 'Le password est vide';
	}

	if (strlen($password) < 8) {
		$formValid = false;
		$errorList['passwordToto'][] = 'Le password doit faire au moins 8 caractères';
	}

  if ($formValid){
    $sql = 'SELECT *
		FROM user
		WHERE usr_email = :email
		';

		$pdoStatement = $pdo->prepare($sql);
		//bindValues
		$pdoStatement->bindValue(':email', $email);
		//execution

		if($pdoStatement->execute() === false){
			print_r($pdoStatement->errorInfo());
		}
		else{
			if ($pdoStatement->rowCount() > 0) {
				$userData = $pdoStatement->fetch(PDO::FETCH_ASSOC);

				if (password_verify($password, $userData['usr_password'])) {
					echo 'Utilisateur connecté<br>';
          $userID = $userData['usr_id'];
          $_SESSION['userID'] = $userID;

					// Save his role in SESSION
					$_SESSION['userRole'] = $userData['usr_role'];
				}else{
					echo 'Mot de passe incorrect<br>';
				}
				//todo connect the user
			}
			else{
				echo 'Email non reconnu<br>';
			}
		}
	}
}

if(!empty($_GET)){
	if ($_GET['signout'] == 1){
		session_destroy();
		header('Location: index.php');
		exit;
	}
}



require'../view/header.php';
require'../view/signin.php';
require'../view/footer.php';
?>
