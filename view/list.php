<?php if(isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'user' || $_SESSION['userRole'] == 'admin') : ?>
  <main>
    <br>
    <div id="etudlist" class="panel panel-primary" style="max-width:98%;margin:auto;">
      <div class="panel-heading">
        <h3 class="panel-title">Liste des étudiants</h3>
      </div>
      <div class="panel-body">
        <?php if (isset($phraseResult)) : ?>
          <?php echo $phraseResult ?>
        <?php endif; ?>
        <table class="table table-bordered table-hover text-center">
          <thead>
            <tr>
              <th style="text-align:center;">ID</th>
              <th style="text-align:center;">Nom</th>
              <th style="text-align:center;">Prénom</th>
              <th style="text-align:center;">Email</th>
              <th style="text-align:center;">Date de naissance</th>
              <th style="text-align:center;">Détails</th>
              <?php if(isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'admin') : ?>
                <th style="text-align:center;">Supprimer</th>
              <?php endif; ?>
            </tr>
          </thead>
          <tbody>

            <!-- AFFICHER LES RESULTATS POUR LA RECHERCHE -->
            <?php if (isset($phraseResult)) : ?>
              <?php foreach ($rechercheResult as $currentStudent): ?>
                <tr>
                  <td><?= $currentStudent['stu_id']?></td>
                  <td><?= $currentStudent['stu_lastname']?></td>
                  <td><?= $currentStudent['stu_firstname']?></td>
                  <td><?= $currentStudent['stu_email']?></td>
                  <td><?= $currentStudent['stu_birthdate']?></td>
                  <td><a class="btn btn-success" href="student.php?StudentID=<?= $currentStudent['stu_id']?>">Détails</a></td>
                  <?php if(isset($_SESSION['userRole']) && $_SESSION['userRole'] === 'admin') : ?>
                    <td><a class="btn btn-danger" href="list.php?DeleteID=<?= $currentStudent['stu_id']?>">Supprimer</a></td>
                  <?php endif; ?>
                </tr>
              <?php endforeach; ?>
              <!-- AFFICHER LES ETUDIANTS DE LA SESSION CIBLE -->
            <?php elseif (isset($sessionRequestedResult)) : ?>
              <?php foreach ($sessionRequestedResult as $currentStudent): ?>
                <tr>
                  <td><?= $currentStudent['stu_id']?></td>
                  <td><?= $currentStudent['stu_lastname']?></td>
                  <td><?= $currentStudent['stu_firstname']?></td>
                  <td><?= $currentStudent['stu_email']?></td>
                  <td><?= $currentStudent['stu_birthdate']?></td>
                  <td><a class="btn btn-success" href="student.php?StudentID=<?= $currentStudent['stu_id']?>">Détails</a></td>
                  <?php if(isset($_SESSION['userRole']) && $_SESSION['userRole'] === 'admin') : ?>
                    <td><a class="btn btn-danger" href="list.php?DeleteID=<?= $currentStudent['stu_id']?>">Supprimer</a></td>
                  <?php endif; ?>
                </tr>
              <?php endforeach; ?>
            <!-- SI PAS DE RECHERCHE EFFECTUE, ON AFFICHE LA LISTE NORMALE -->
            <?php else : ?>
            <?php foreach ($AllResults as $currentStudent): ?>
              <tr>
                <td><?= $currentStudent['stu_id']?></td>
                <td><?= $currentStudent['stu_lastname']?></td>
                <td><?= $currentStudent['stu_firstname']?></td>
                <td><?= $currentStudent['stu_email']?></td>
                <td><?= $currentStudent['stu_birthdate']?></td>
                <td><a class="btn btn-success" href="student.php?StudentID=<?= $currentStudent['stu_id']?>">Détails</a></td>
                <?php if(isset($_SESSION['userRole']) && $_SESSION['userRole'] === 'admin') : ?>
                  <td><a class="btn btn-danger" href="list.php?DeleteID=<?= $currentStudent['stu_id']?>">Supprimer</a></td>
                <?php endif; ?>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
          </tbody>
        </table>
        <?php if(!isset($motRecherche)) : ?>
          <?php if ($tester === false) : ?>
            <?php if ($page <= 1) : ?>
              <a class="btn btn-info" href="list.php?page=<?=$page-1?>" style="display:none">Précédent</a>
            <?php else : ?>
              <a class="btn btn-info" href="list.php?page=<?=$page-1?>">Précédent</a>
            <?php endif; ?>


            <?php if ($page >= $maxPages) : ?>
              <a class="btn btn-info" href="list.php?page=<?=$page+1?>" style="display:none">Suivant</a>
            <?php else : ?>
              <a class="btn btn-info" href="list.php?page=<?=$page+1?>">Suivant</a>
            <?php endif; ?>
          <?php endif; ?>
        <?php endif; ?>



      </div>
    </div>
  </main>
<br>
<?php endif; ?>
