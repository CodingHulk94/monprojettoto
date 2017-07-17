<?php

require'../inc/config.php';


$successTxt = '';
$errorList = array();
$email = '';

if (!empty($_POST)) {
	// Récupération & Traitement des données
	$email = isset($_POST['emailToto']) ? strip_tags(trim($_POST['emailToto'])) : '';
	$password1 = isset($_POST['passwordToto1']) ? trim($_POST['passwordToto1']) : '';
	$password2 = isset($_POST['passwordToto2']) ? trim($_POST['passwordToto2']) : '';

	// Validation des données
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

	if (empty($password1) || empty($password2)) {
		$formValid = false;
		$errorList['passwordToto'][] = 'Le password est vide';
	}
	if ($password1 !== $password2) {
		$formValid = false;
		$errorList['passwordToto'][] = 'Les password sont différents';
	}
	if (strlen($password1) < 8 || strlen($password2) < 8) {
		$formValid = false;
		$errorList['passwordToto'][] = 'Le password doit faire au moins 6 caractères';
	}

	// tO dO VERIFIER SI EMAIL EXISTE DEJA

	// Si tout est ok => on ajoute en DB
	if ($formValid) {
		$sql = "
			INSERT INTO user (usr_email, usr_password, usr_date_creation, usr_role)
			VALUES (:email, :password, NOW(), 'user')
		";
		// Prepare la requete
		$pdoStatement = $pdo->prepare($sql);
		// bindValues
		$pdoStatement->bindValue(':email', $email);
		// Clear password
		$hashedPassword = $password1;
		// md5
		//$hashedPassword = md5($password1);
		// md5 + salt
		//$hashedPassword = md5('salt à_moi:)'.$password1);
		//password_hash
		$hashedPassword = password_hash($password1, PASSWORD_BCRYPT);

		$pdoStatement->bindValue(':password', $hashedPassword);

		// Execution
		if ($pdoStatement->execute() === false) {

		}
		// Si aucun erreur SQL
		else {
			$successTxt = 'Votre inscription a bien été prise en compte';
		}
	}
	else{
		
	}
}












require'../view/header.php';
require'../view/signup.php';
require'../view/footer.php';
?>
