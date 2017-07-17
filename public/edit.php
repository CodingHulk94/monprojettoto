<?php

require'../inc/config.php';
define('__UPLOAD_DIR__', dirname(__FILE__).DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR);


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

if(!empty($_GET['editID'])){
  $editID = $_GET['editID'];

  $sqlPrefilled = 'SELECT *
  FROM student
  WHERE stu_id = :modificationID';

  $pdoPrefilledStatement = $pdo->prepare($sqlPrefilled);
  $pdoPrefilledStatement->bindValue(':modificationID', $editID);

  if ($pdoPrefilledStatement->execute() === false ) { // Si erreur
  	print_r($pdoPrefilledStatement->errorInfo());
  }
  else {
    // fetch pour 1 array (row)
  	$prefilledResults = $pdoPrefilledStatement->fetch(PDO::FETCH_ASSOC);

  }

}

//TRAITEMENT DES DONNEES QUI ONT ETE MODIFIEES
if (!empty($_POST)){

  $modiflastname = $modiffirstname = $modifdate = $modifemail = $modifsympathy = $modifsession = $modifcity = $imageFileName = '';

  if(!empty($_POST['modiflastname'])){
    $modiflastname = strip_tags(strtoupper(trim($_POST['modiflastname'])));
  }else{
    echo 'Aucun nom spécifié<br>';
  }

  if(!empty($_POST['modiffirstname'])){
    $modiffirstname = strip_tags(trim($_POST['modiffirstname']));
  }else{
    echo 'Aucun prénom spécifié<br>';
  }

  if(!empty($_POST['modifbirthdate'])){
    $modifdate = strip_tags(trim($_POST['modifbirthdate']));
  }else{
    echo 'Aucune date spécifiée<br>';
  }

  if(!empty($_POST['modifemail'])){
    $modifemail = strip_tags(trim($_POST['modifemail']));
  }else{
    echo 'Aucun email spécifiée<br>';
  }

  if(!empty($_POST['modifsympathy'])){
    $modifsympathy = strip_tags(trim($_POST['modifsympathy']));
  }else{
    echo 'Aucune sympathie spécifié<br>';
  }

  if(!empty($_POST['modifsession'])){
    $modifsession = strip_tags(trim($_POST['modifsession']));
  }else{
    echo 'Aucune session spécifié<br>';
  }

  if(!empty($_POST['modifcity'])){
    $modifcity = strip_tags(trim($_POST['modifcity']));
  }else{
    echo 'Aucune ville spécifié<br>';
  }

  $formValid = true;

  if(empty($modifdate) || empty($modifsympathy) || empty($modifcity) || empty($modifsession) || empty($modifemail) || empty($modiffirstname) || empty($modiflastname)){
    $formValid = false;
    echo 'Veuillez renseigner tous les champs svp!';
  }

  if(!empty($_FILES)) {
    //Je parcours les uploads
    foreach ($_FILES as $inputName => $fileData) {
      //Crée un tableau de string à partir du string du nom du fichier
      $tmpExplode = explode('.', $fileData['name']);
      //renvoi la valeur du dernier élément de tableau
      $extension = end($tmpExplode);

      if (!in_array($extension, array('png','jpg','gif', 'svg', 'png'))){
        echo 'Fichier invalide';
        exit;
      }else if ($fileData['size'] > 200*1024){
        echo 'Fichier trop lourd<br>';
        exit;
      }else{
        //Nom fichier uploadé
        $imageFilename = md5('moto'.$fileData['name']).'.'.$extension;
      }

        //echo 'copy from '.$fileData['tmp_name'].'<br>';
        //echo 'to '.$uploadedFilename.'<br>';

        if(move_uploaded_file($fileData['tmp_name'], __UPLOAD_DIR__.$imageFilename)){
          echo 'UPLOAD ok <br>';
        }else {
          echo 'aucun fichier uploadé<br>';
        }
      }
    }
  if($formValid){


    //TRAITEMENT DE L'UPLOAD
    $sql='UPDATE student SET stu_lastname = :name1,  stu_firstname = :name2, stu_birthdate = :birth, stu_email = :mail, stu_friendliness = :symp, stu_img = :img, session_ses_id = :sessionid, city_cit_id = :cityid
    WHERE stu_id = :editeurID';
    $pdoStatement = $pdo->prepare($sql);
    $pdoStatement->bindValue(":editeurID", $_POST['editeurID']);
    $pdoStatement->bindValue(":name1", $modiflastname, PDO::PARAM_STR);
    $pdoStatement->bindValue(":name2", $modiffirstname, PDO::PARAM_STR);
    $pdoStatement->bindValue(":birth", $modifdate);
    $pdoStatement->bindValue(":mail", $modifemail, PDO::PARAM_STR);
    $pdoStatement->bindValue(':symp', $modifsympathy);
    $pdoStatement->bindValue(':img', $imageFilename);
    $pdoStatement->bindValue(':sessionid', $modifsession);
    $pdoStatement->bindValue(':cityid', $modifcity);
    var_dump($_POST['editeurID']);


    if ($pdoStatement->execute() === false ) { // Si erreur
      print_r($pdoStatement->errorInfo());
    }
    else {
      header("Location: student.php?StudentID=".$_POST['editeurID']);
      exit;
    }
  }
}







require'../view/header.php';
require'../view/edit.php';
require'../view/footer.php';


 ?>
