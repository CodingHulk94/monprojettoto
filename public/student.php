<?php

require'../inc/config.php';

if(!isset($_SESSION['userRole']) || $_SESSION['userRole'] != 'user' && $_SESSION['userRole'] != 'admin'){
  http_response_code(403);
  exit;
}
//Pour les détails
if(!empty($_GET['StudentID'])){
  $studentID = $_GET['StudentID'];
}
else{
  echo 'Aucun élève sélectionné';
}

// $sql = 'SELECT *
// FROM student
// LEFT JOIN city ON cit_id = city_cit_id
// LEFT JOIN session ON ses_id = session_ses_id
// LEFT JOIN training ON tra_id = training_tra_id
// WHERE stu_id = :student' ;
// $pdoStatement = $pdo->prepare($sql);
// $pdoStatement->bindValue(':student', $studentID, PDO::PARAM_INT);
//
// if ($pdoStatement->execute() === false ) { // Si erreur
// 	print_r($pdoStatement->errorInfo());
// }
// else {
//   // fetch pour 1 array (row)
// 	$FinalResult = $pdoStatement->fetch(PDO::FETCH_ASSOC);
// }
//
// $birthdate = $FinalResult['stu_birthdate'];
// if(!empty($birthdate)){
//   $birthTimestamp = strtotime($birthdate);
//   $elapsedSeconds = time() - $birthTimestamp;
//   $age = floor($elapsedSeconds / (365.25*60*60*24));
// }




require'../view/header.php';
require'../view/student.php';
require'../view/footer.php';

 ?>
