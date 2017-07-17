<?php

function emailvalidator($emailToCheck){
  global $pdo;
  global $errorList;
  global $formValid;
  $sql = 'SELECT usr_email FROM user';
  $pdoStatement = $pdo->query($sql);
  $fetchedData = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

  //PARCOURIR TABLEAU
  if (in_array($emailToCheck, $fetchedData[1])){
    $formValid = false;
    $errorList['emailToto'][] = 'L\'email est déja prise';
  }

}
function emailsender($to, $subject, $htmlContent, $textContent=''){

  $mail = new PHPMailer;

  //$mail->SMTPDebug = 3;                               // Enable verbose debug output

  $mail->isSMTP();                                      // Set mailer to use SMTP
  $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
  $mail->SMTPAuth = true;                               // Enable SMTP authentication
  $mail->Username = 'givanildohbpt@gmail.com';                 // SMTP username
  $mail->Password = file_get_contents('pwd.txt');                           // SMTP password
  $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
  $mail->Port = 587;                                    // TCP port to connect to

  $mail->setFrom('givanildohbpt@gmail.com', 'Mailer');
  $mail->addAddress($to, 'Hulk');     // Add a recipient
                 // Name is optional
  //$mail->isHTML(true);                                  // Set email format to HTML

  $mail->Subject = $subject;
  $mail->Body    = $htmlContent;
  $mail->AltBody = $textContent;

  if(!$mail->send()) {
      echo 'Message could not be sent.';
      echo 'Mailer Error: ' . $mail->ErrorInfo;
  } else {
      echo 'Message has been sent';
}

}

 ?>
