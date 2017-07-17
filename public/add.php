<?php

require'../inc/config.php';
// REQUETES POUR COMPLETER LES SELECTS DU FORMULAIRE
$sql1='SELECT cit_name FROM city';

$pdoStatement1 = $pdo->query($sql1);
$fetchedData1 = $pdoStatement1->fetchAll(PDO::FETCH_ASSOC);


$sql2='SELECT ses_number, tra_name
FROM session
INNER JOIN training ON tra_id = training_tra_id';
$pdoStatement2 = $pdo->query($sql2);
$fetchedData2 = $pdoStatement2->fetchAll(PDO::FETCH_ASSOC);

$sympathiearray = array(
  1 => 'Pas sympa',
  2 => 'Assez sympa',
  3 => 'Sympa',
  4 => 'Très sympa',
  5 => 'Génial'
);

//TRAITEMENT DE DONNEES

if (!empty($_POST)){

  $newlastname = $newfirstname = $newdate = $newemail = $newsympathy = $newsession = $newcity = '';

  if(!empty($_POST['newlastname'])){
    $newlastname = strip_tags(strtoupper(trim($_POST['newlastname'])));
  }else{
    echo 'Aucun nom spécifié<br>';
  }

  if(!empty($_POST['newfirstname'])){
    $newfirstname = strip_tags(trim($_POST['newfirstname']));
  }else{
    echo 'Aucun prénom spécifié<br>';
  }

  if(!empty($_POST['newbirthdate'])){
    $newdate = strip_tags(trim($_POST['newbirthdate']));
  }else{
    echo 'Aucune date spécifiée<br>';
  }

  if(!empty($_POST['newemail'])){
    $newemail = strip_tags(trim($_POST['newemail']));
  }else{
    echo 'Aucun email spécifiée<br>';
  }

  if(!empty($_POST['newsympathy'])){
    $newsympathy = strip_tags(trim($_POST['newsympathy']));
  }else{
    echo 'Aucune sympathie spécifié<br>';
  }

  if(!empty($_POST['newsession'])){
    $newsession = strip_tags(trim($_POST['newsession']));
  }else{
    echo 'Aucune session spécifié<br>';
  }

  if(!empty($_POST['newcity'])){
    $newcity = strip_tags(trim($_POST['newcity']));
  }else{
    echo 'Aucune ville spécifié<br>';
  }

  $formValid = true;

  if(empty($newdate) || empty($newsympathy) || empty($newcity) || empty($newsession) || empty($newemail) || empty($newfirstname) || empty($newlastname)){
    $formValid = false;
    echo 'Veuillez renseigner tous les champs svp!';
  }

  if($formValid){
    $sql='INSERT INTO student (stu_lastname, stu_firstname, stu_birthdate, stu_email, stu_friendliness, session_ses_id, city_cit_id)
    VALUES (:name1, :name2, :birth, :mail, :symp, :sessionid, :cityid)';
    $pdoStatement = $pdo->prepare($sql);
    $pdoStatement->bindValue(":name1", $newlastname, PDO::PARAM_STR);
    $pdoStatement->bindValue(":name2", $newfirstname, PDO::PARAM_STR);
    $pdoStatement->bindValue(":birth", $newdate);
    $pdoStatement->bindValue(":mail", $newemail, PDO::PARAM_STR);
    $pdoStatement->bindValue(':symp', $newsympathy);
    $pdoStatement->bindValue(':sessionid', $newsession);
    $pdoStatement->bindValue(':cityid', $newcity);

    if ($pdoStatement->execute() === false ) { // Si erreur
      print_r($pdoStatement->errorInfo());
    }
    else {
      $lastID = $pdo->lastInsertId();
      header("Location: student.php?StudentID=".$lastID);
      exit;
    }
  }


}




require'../view/header.php';
require dirname(dirname(__FILE__)).'/view/add.php';

require'../view/footer.php';
 ?>
