

  <?php if (isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'admin') : ?>
  <a class="btn btn-success" href="edit.php?editID=<?=$studentID?>">Modifier</a>
  <?php endif; ?>
    <div id="studentContent">

    </div>

<script type="text/javascript">
  $(document).ready(function(){

    $.ajax({
      method:'POST',
      url: "../public/ajax/student.php",
      data: {'StudentID' : <?=$studentID?>},

      })
      .done(function(response){
        $("#studentContent").html(response);
        console.log("Submission was successful");
        console.log(response);
      });
  });
</script>
