<?php if(empty($_SESSION)) : ?>
  <div class="container">
    <div class="row">
      <div class="col-md-2 col-sm-2 col-xs-0"></div>
      <div class="col-md-8 col-sm-8 col-xs-12">
        <div class="page-header">
            <h1>Sign in</h1>
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
            <input type="email" class="form-control" name="emailToto" value="<?= $email ?>" placeholder="Email address" /><br />
            <?php if (!empty($errorList['passwordToto'])) : ?>
            <div class="alert alert-danger">
              <?php foreach ($errorList['passwordToto'] as $currentError) : ?>
                <?= $currentError ?><br>
              <?php endforeach; ?>
            </div>
            <?php endif; ?>
            <input type="password" class="form-control" name="passwordToto1" value="" placeholder="Your password" /><br />
            <input type="submit" class="btn btn-success btn-block" value="Sign in" />
          </fieldset>
        </form>
      </div>
      <div class="col-md-2 col-sm-2 col-xs-0"></div>
    </div>
    <a href="forgot_password.php" style="color:black">Forgot password?</a>

  </div>
  <br>
<?php endif; ?>
