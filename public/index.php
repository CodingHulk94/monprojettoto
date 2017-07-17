<?php

require'../inc/config.php';

//VOTRE CODE
$sqllocations = 'SELECT * FROM location';
$pdoStatementlocation = $pdo->query($sqllocations);
$locationResults = $pdoStatementlocation->fetchAll(PDO::FETCH_ASSOC);


foreach($locationResults as $locationkey => $locationvalue){
  $sqlsession3 = 'SELECT * FROM session
  LEFT OUTER JOIN training ON training_tra_id = tra_id
  LEFT OUTER JOIN location ON location_loc_id = loc_id
  WHERE loc_id = '.$locationvalue['loc_id'].'';
  $pdoStatementsession3 = $pdo->query($sqlsession3);
  $sessionResults3[] = $pdoStatementsession3->fetchAll(PDO::FETCH_ASSOC);
}

$sqlstatistique = 'SELECT cit_name, COUNT(stu_id) AS nombre_stu
FROM city
INNER JOIN student ON cit_id = city_cit_id
WHERE cit_id = city_cit_id
GROUP BY cit_name';

$pdoStatementStatistique = $pdo->query($sqlstatistique);

if($pdoStatementStatistique === false){
  print_r($pdoStatementStatistique->errorInfo());
}else{
  $statistiqueResults = $pdoStatementStatistique->fetchAll(PDO::FETCH_ASSOC);
}

/*
$sqlsession1 = 'SELECT * FROM session
LEFT OUTER JOIN training ON training_tra_id = tra_id
LEFT OUTER JOIN location ON location_loc_id = loc_id
WHERE loc_id = 1';
$pdoStatementsession1 = $pdo->query($sqlsession1);
$sessionResults1 = $pdoStatementsession1->fetchAll(PDO::FETCH_ASSOC);


$sqlsession2 = 'SELECT * FROM session
LEFT OUTER JOIN training ON training_tra_id = tra_id
LEFT OUTER JOIN location ON location_loc_id = loc_id
WHERE loc_id = 2';
$pdoStatementsession2 = $pdo->query($sqlsession2);
$sessionResults2 = $pdoStatementsession2->fetchAll(PDO::FETCH_ASSOC);
*/
//FIN CODE

//J'inclus les vues

require'../view/header.php';
require'../view/home.php';
require'../view/footer.php';


 ?>
