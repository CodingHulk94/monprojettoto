<?php

require'../inc/config.php';

// JE récupère la donnée de l'URL
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

//Définition du nombre d'étudiants
$sql = 'SELECT * FROM student';

$pdoStatement = $pdo->query($sql);

if($pdoStatement === false){
  print_r($pdo->errorInfo());
}else{
  $studentCount = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
}

$maxPages = count($studentCount)/5;
// Définition du nombre d'étudiants s'arrête ici

// JE calcule l'offset correspondant à la page
$offset = $page * 5 - 5;

$sql = 'SELECT *
FROM student
LIMIT 5
OFFSET '.$offset.'';



$ResultSet = $pdo->query($sql);


if($ResultSet === false){
  print_r($pdo->errorInfo());
}else{
  $AllResults = $ResultSet->fetchAll(PDO::FETCH_ASSOC);
}


//RECHERCHE

if(!empty($_GET['motrecherche'])){



  $motRecherche = isset($_GET['motrecherche']) ? strip_tags(trim($_GET['motrecherche'])) : '';
  $sqlRecherche = 'SELECT *
  FROM student
  INNER JOIN city ON cit_id = city_cit_id
  WHERE stu_lastname LIKE :recherche
  OR stu_firstname LIKE :recherche
  OR stu_email LIKE :recherche
  OR cit_name LIKE :recherche
  ';

  $pdoStatementRecherche = $pdo->prepare($sqlRecherche);
  $pdoStatementRecherche->bindValue(":recherche", "%{$motRecherche}%");

  if ($pdoStatementRecherche->execute() === false ) {
    print_r($pdoStatementRecherche->errorInfo());
  }
  else {
    $rechercheResult = $pdoStatementRecherche->fetchAll(PDO::FETCH_ASSOC);

  }

  $numberOfResults = 0;
  foreach($rechercheResult as $keyrecherche => $valuerecherche){
    $numberOfResults += 1;
  }

  $phraseResult = $numberOfResults." résultats pour le mot ".$motRecherche;

}

//ETUDIANTS PAR SESSIONS
$tester = !empty($_GET['sessionrequest']);
if(!empty($_GET['sessionrequest'])){
  $SessionRequested = isset($_GET['sessionrequest']) ? strip_tags(trim($_GET['sessionrequest'])) : '';
  $sql = 'SELECT * FROM student
  LEFT JOIN city ON cit_id = city_cit_id
  LEFT JOIN session ON ses_id = session_ses_id
  LEFT JOIN training ON tra_id = training_tra_id
  LEFT JOIN location ON loc_id = location_loc_id
  WHERE session_ses_id = :sessionrequested';
  $pdoStatementSessionRequested = $pdo->prepare($sql);
  $pdoStatementSessionRequested->bindValue(":sessionrequested", $SessionRequested);

  if ($pdoStatementSessionRequested->execute() === false ) {
    print_r($pdoStatementSessionRequested->errorInfo());
  }
  else {
    $sessionRequestedResult = $pdoStatementSessionRequested->fetchAll(PDO::FETCH_ASSOC);
  }
}

//Pour supprimer
if(!empty($_GET['DeleteID'])){
  $DeleteID = $_GET['DeleteID'];

  $sql= 'DELETE
  FROM student
  WHERE stu_id = :deletestudent' ;

  $pdoStatementDelete = $pdo->prepare($sql);
  $pdoStatementDelete->bindValue(':deletestudent', $DeleteID);

  if ($pdoStatementDelete->execute() === false ) { // Si erreur
  	print_r($pdo->errorInfo());
  }
  else {

    echo 'Supprimé';
  }
}

require'../view/header.php';
require'../view/list.php';
require'../view/footer.php';


?>
