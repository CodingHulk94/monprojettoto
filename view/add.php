<?php if(isset($_SESSION['userRole']) && $_SESSION['userRole'] === 'admin') : ?>
<br>
<div class="panel panel-primary" style="max-width:98%;margin:auto;">
  <div class="panel-heading">
    <h3 class="panel-title">Form</h3>
  </div>
  <div class="panel-body">
    <form class="form-group" action="add.php" method="post">
      <fieldset>
        <label for="">Nom</label>
        <input class="form-control" type="text" name="newlastname" value="">
        <label for="">Prénom</label>
        <input class="form-control" type="text" name="newfirstname" value=""><br>
        <label for="">Date de naissance</label>
        <input class="form-control" type="date" name="newbirthdate" value=""><br>
        <label for="">Email</label>
        <input class="form-control" type="email" name="newemail" value=""><br>
        <label for="">Sympathie</label><br>
        <select class="" name="newsympathy">
          <?php foreach ($sympathiearray as $key3 => $value3): ?>
          <option value="<?=$key3?>"><?=$value3?></option>
          <?php endforeach; ?>
        </select><br><br>
        <label for="">Numéro de session</label><br>
        <select class="" name="newsession">
          <?php foreach ($fetchedData2 as $key => $value): ?>
          <option value="<?=$key+1?>"><?=$value['ses_number'].'-'.$value['tra_name']?></option>
        <?php endforeach; ?>
        </select><br><br>
        <label for="">Ville</label><br>
        <select class="" name="newcity">
          <?php foreach ($fetchedData1 as $key => $value): ?>
          <option value="<?=$key+1?>"><?=$value['cit_name']?></option>
        <?php endforeach; ?>
        </select><br><br>
        <button class="btn btn-success" type="submit" name="button">
          Valider
        </button>
      </fieldset>
    </form>
  </div>
</div>
<br>
<?php else : ?>
<h1>ACCESS DENIED</h1>
<?php endif; ?>
