<?php if($_SESSION['userRole'] == 'admin') : ?>
<br>
<div class="panel panel-primary" style="max-width:98%;margin:auto;">
  <div class="panel-heading">
    <h3 class="panel-title">Form</h3>
  </div>
  <div class="panel-body">
    <form class="form-group" action="edit.php" method="post" enctype="multipart/form-data">
      <fieldset>
        <label for="">Nom</label>
        <input class="form-control" type="text" name="modiflastname" value="<?=$prefilledResults['stu_lastname']?>">
        <label for="">Prénom</label>
        <input class="form-control" type="text" name="modiffirstname" value="<?=$prefilledResults['stu_firstname']?>"><br>
        <label for="">Date de naissance</label>
        <input class="form-control" type="date" name="modifbirthdate" value="<?=$prefilledResults['stu_birthdate']?>"><br>
        <label for="">Email</label>
        <input class="form-control" type="email" name="modifemail" value="<?=$prefilledResults['stu_email']?>"><br>
        <label for="">Sympathie</label><br>
        <select class="" name="modifsympathy">
          <?php foreach ($sympathiearray as $key3 => $value3): ?>
            <option value="<?=$key3?>" <?php if ($prefilledResults['stu_friendliness'] == ($key3)) : ?> selected <?php endif ?>><?=$value3?></option>
          <?php endforeach; ?>
        </select><br><br>
        <label for="">Numéro de session</label><br>
        <select class="" name="modifsession">
          <?php foreach ($fetchedData2 as $key => $value): ?>
          <option value="<?=$key+1?>" <?php if ($prefilledResults['session_ses_id'] == ($key+1)) : ?> selected <?php endif ?>><?=$value['ses_number'].'-'.$value['tra_name']?></option>
        <?php endforeach; ?>
        </select><br><br>
        <label for="">Ville</label><br>
        <select class="" name="modifcity">
          <?php foreach ($fetchedData1 as $key => $value): ?>
          <option value="<?=$key+1?>" <?php if ($prefilledResults['city_cit_id'] == ($key+1)) : ?> selected <?php endif ?>><?=$value['cit_name']?></option>
        <?php endforeach; ?>
        </select><br><br>
        <input type="hidden" name="editeurID" value="<?=$prefilledResults['stu_id']?>">
        <input type="hidden" name="submitFile" value="1" />
        <label for="fileForm">Fichier</label>
        <input type="file" name="fileForm" id="fileForm" />
        <p class="help-block">Extensions autorisées: .jpg, .png</p>
        <br />
        <button class="btn btn-success" type="submit" name="button">
          Valider
        </button>
      </fieldset>
    </form>
  </div>
</div>
<br>
<?php else : ?>
<h1>ACCESS FORBIDDEN</h1>
<?php endif; ?> 
