<div class="container">
  <div class="row">
    <div class="col-md-2 col-sm-2 col-xs-0"></div>
    <div class="col-md-8 col-sm-8 col-xs-12">
      <div class="page-header">
          <h1>Sign up</h1>
      </div>

      <?php if (!empty($successTxt)) : ?>
      <div class="alert alert-success">
        <?= $successTxt ?>
      </div>
      <?php endif; ?>

      <form method="post" action="">
        <fieldset>
          <?php if (!empty($errorList['emailToto'])) : ?>
          <div class="alert alert-danger">
            <?php foreach ($errorList['emailToto'] as $currentError) : ?>
              <?= $currentError ?><br>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>
          <input id="emailtoto" type="email" class="form-control" name="emailToto" value="<?= $email ?>" placeholder="Email address" /><br />
          <?php if (!empty($errorList['passwordToto'])) : ?>
          <div class="alert alert-danger">
            <?php foreach ($errorList['passwordToto'] as $currentError) : ?>
              <?= $currentError ?><br>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>
          <input type="password" class="form-control" name="passwordToto1" value="" placeholder="Your password" /><br />
          <input type="password" class="form-control" name="passwordToto2" value="" placeholder="Confirm your password" /><br />
          <input type="submit" class="btn btn-success btn-block" value="Sign up" />
        </fieldset>
      </form>
    </div>
    <div class="col-md-2 col-sm-2 col-xs-0"></div>
  </div>

</div>
<br>
<script type="text/javascript">
$(document).ready(function(){
    $("form").on("submit", function(event){
        event.preventDefault();
        $.ajax({
            url: "../public/ajax/signup.php",
            method: 'POST',
            data: {'email' : $("#emailtoto").val()},
            success: function(response){
                console.log(response);
                if (response == 1){
                    if($("#emailalert").length !== 0){
                        $("#emailalert").after().remove();
                    }
                    $("#emailtoto").css("border", "1px solid red");
                    $("#emailtoto").after("<div id='emailalert' style='background-color:red; color:white;' width='100px' height='50px'>L'email saisie est déjà prise</div>");
                }
                else{
                    $("form").submit();
                }
            }
        });
    });
});

</script>
