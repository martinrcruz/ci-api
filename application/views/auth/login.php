<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">


<div class="container-fluid">
  <div class="row">
    <div class="col-1">
    </div>
    <div class="col-lg-2 pt-5 mt-5 pb-5 mb-5 text-center">
      <br><br>
      <img src=" <?= base_url() ?>/assets/images/logo-graficag.png" alt="">
      <h1 class="text-center" style="font-weight:700; font-size:16px;"><?php echo lang('login_heading'); ?></h1>

      <div id="infoMessage"><?php echo $message; ?></div>

      <?php echo form_open("auth/login"); ?><br>





      <p>
        Email/Usuario<br>
        <?php echo form_input($identity); ?>
      </p>

      <p>
        Contraseña<br>
        <?php echo form_input($password); ?>
      </p>

      <p>
        <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"'); ?>
        Recordarme
      </p>


      <p><?php echo form_submit('submit', lang('login_submit_btn')); ?></p>

      <?php echo form_close(); ?>

      <p><a href="forgot_password"><?php echo lang('login_forgot_password'); ?></a></p>
    </div>
    <div class="col-1">
    </div>

    <div class="col-lg-8" style="background-image: url('<?= base_url() ?>assets/images/login-background-1.jpg'); background-size: cover; height: 100vh; overflow: auto;">
    </div>
  </div>
</div>