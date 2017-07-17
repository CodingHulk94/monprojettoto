<?php

require'../../inc/config.php';

if(!empty($_POST['email'])){
    $emailtoverify = strip_tags(trim($_POST['email']));

    $sql = 'SELECT usr_email FROM user';
    $pdoStatement = $pdo->prepare($sql);

    if($pdoStatement->execute() === false){
        print_r($pdoStatement->errorInfo());
    }
    else{
        $EmailList = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        $rownumber = $pdoStatement->rowCount();
        for($index=0; $index<$rownumber; $index++){
            if (in_array($emailtoverify, $EmailList[$index])){
                echo 1;
            }
            else{

            }
        }
    }
}


?>
