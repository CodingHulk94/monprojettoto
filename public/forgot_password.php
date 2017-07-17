<?php
require'../inc/config.php';

if (!empty($_POST)){
  $recovery = isset($_POST['recoverpassword']) ? strip_tags(trim($_POST['recoverpassword'])) : '';

  $sqlrecovery = 'SELECT * FROM user WHERE usr_email = :recovered';
  $pdoRecoveryStatement = $pdo->prepare($sqlrecovery);
  $pdoRecoveryStatement->bindValue(':recovered', $recovery);

  if($pdoRecoveryStatement->execute() === false){
    print_r($pdoRecoveryStatement->errorInfo());
  }
  else{
    if ($pdoRecoveryStatement->rowCount() > 0){
      $recoveryData = $pdoRecoveryStatement->fetch(PDO::FETCH_ASSOC);
      $recoveryToken = md5($recoveryData['usr_id'].getmypid().time().'migos');
      $tokensql = "UPDATE user SET usr_token = '{$recoveryToken}' WHERE usr_id = {$recoveryData['usr_id']}";
      $pdoTokenInserterStatement = $pdo->prepare($tokensql);

      if($pdoTokenInserterStatement->execute() === false){
        print_r($pdoTokenInserterStatement->errorInfo());
      }else{
        $subject = "Reset password!!!";
        $link= 'http://localhost/7-phpproject/public/reset_password.php?token='.$recoveryToken.'';
        $to = 'givanildohbpt@gmail.com';

        $htmlContent = 'Toma la o reset: '.$link.'';

        emailsender($to, 'Reset du mot de passe', $htmlContent);

        header("Location: index.php");
        exit;
      }



    }else{
      echo'Email pas reconnu';
    }
  }
}







require'../view/header.php';
require'../view/forgot_password.php';
require'../view/footer.php';
 ?>
