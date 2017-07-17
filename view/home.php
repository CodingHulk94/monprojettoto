<main>
  <?php foreach($locationResults as $lockey => $locvalue) : ?>
  <br>
  <div class="panel panel-primary" style="max-width:98%;margin:auto;">
    <div class="panel-heading">
      <h3 class="panel-title"><?= $locvalue['loc_name']?></h3>
    </div>
    <div class="panel-body">
      <table class="table table-bordered table-hover text-center">
        <thead>
          <tr>
            <th style="text-align:center;">Nom de la session</th>
            <th style="text-align:center;">Session Nr°</th>
            <th style="text-align:center;">Date de début</th>
            <th style="text-align:center;">Date de fin</th>
            <?php if(!empty($_SESSION)) : ?>
              <?php if(isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'user' || $_SESSION['userRole'] == 'admin') : ?>
                <th style="text-align:center;">Etudiants</th>
              <?php endif; ?>
            <?php endif; ?>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($sessionResults3[$lockey] as $key1 => $currentSession1): ?>
            <tr>
              <td><?= $currentSession1['tra_name']?></td>
              <td><?= $currentSession1['ses_number']?></td>
              <td><?= $currentSession1['ses_start_date']?></td>
              <td><?= $currentSession1['ses_end_date']?></td>
              <?php if(!empty($_SESSION)) : ?>
              <?php if(isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'user' || $_SESSION['userRole'] == 'admin') : ?>
                <td><a class="btn btn-success" href="list.php?sessionrequest=<?=$currentSession1['ses_id']?>">Etudiants</a></td>
              <?php endif; ?>
              <?php endif; ?>
            </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
<?php endforeach; ?>
<br>
<div class="panel panel-primary" style="max-width:98%;margin:auto;">
  <div class="panel-heading">
    <h3 class="panel-title">Statistiques</h3>
  </div>
  <div class="panel-body">
    <table class="table table-bordered table-hover text-center">
      <thead>
        <tr>
          <th style="text-align:center;">Ville</th>
          <th style="text-align:center;">Nr° d'étudiants</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($statistiqueResults as $key => $value): ?>
          <tr>
            <td><?= $value['cit_name']?></td>
            <td><?= $value['nombre_stu']?></td>
          </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
</main>
<br>
