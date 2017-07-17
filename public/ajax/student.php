<?php

require'../../inc/config.php';

if(!empty($_POST['StudentID'])){
  $mystudentID = $_POST['StudentID'];
}
else{
  echo 'Aucun élève sélectionné';
}

$sql = 'SELECT *
FROM student
LEFT JOIN city ON cit_id = city_cit_id
LEFT JOIN session ON ses_id = session_ses_id
LEFT JOIN training ON tra_id = training_tra_id
WHERE stu_id = :student' ;
$pdoStatement = $pdo->prepare($sql);
$pdoStatement->bindValue(':student', $mystudentID, PDO::PARAM_INT);

if ($pdoStatement->execute() === false ) { // Si erreur
	print_r($pdoStatement->errorInfo());
}
else {
  // fetch pour 1 array (row)
	$FinalResult1 = $pdoStatement->fetch(PDO::FETCH_ASSOC);
}

$birthdate = $FinalResult1['stu_birthdate'];
if(!empty($birthdate)){
  $birthTimestamp = strtotime($birthdate);
  $elapsedSeconds = time() - $birthTimestamp;
  $age = floor($elapsedSeconds / (365.25*60*60*24));
}


 ?>
 <h2><?= $FinalResult1['stu_lastname']?> <?= $FinalResult1['stu_firstname']?></h2>
 <br><br>
 <ul id="studentslist">
   <li>ID: <?= $FinalResult1['stu_id']?></li>
   <li>Nom: <?= $FinalResult1['stu_lastname']?></li>
   <li>Prénom: <?= $FinalResult1['stu_firstname']?></li>
   <li>Email: <?= $FinalResult1['stu_email']?></li>
   <li>Date de naissance: <?= $FinalResult1['stu_birthdate']?></li>
   <li>Age: <?=$age?></li>
   <li>Ville: <?= $FinalResult1['cit_name']?></li>
   <li>Sympathie: <?= $FinalResult1['stu_friendliness']?></li>
   <li>Numero de Session: <?= $FinalResult1['ses_number']?></li>
   <li>Localité: <?= $FinalResult1['tra_name']?></li>
   <li><img src="files/<?=$FinalResult1['stu_img']?>" alt=""></li>
 </ul><br>
