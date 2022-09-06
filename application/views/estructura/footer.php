<footer class="main-footer">
    <div class="pull-right d-none d-sm-inline-block">
        <ul class="nav nav-primary nav-dotted nav-dot-separated justify-content-center justify-content-md-end">
            
            <li class="nav-item">
                Creado por AM Solutions
            </li>
        </ul>
    </div>
    &copy; 2022 GRAFICA G
</footer>



<!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->






<script>
    var base_url = "<?= base_url(); ?>";
  var token_name = '<?= $this->security->get_csrf_token_name(); ?>';
  var token_hash = '<?= $this->security->get_csrf_hash(); ?>';
</script>




<!-- jQuery 3 -->
<script src="<?= base_url() ?>assets/style/vendor_components/jquery-3.3.1/jquery-3.3.1.js"></script>

<!-- fullscreen -->
<script src="<?= base_url() ?>assets/style/vendor_components/screenfull/screenfull.js"></script>

<!-- popper -->
<script src="<?= base_url() ?>assets/style/vendor_components/popper/dist/popper.min.js"></script>


<!-- Bootstrap 4.0-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<!-- Slimscroll -->
<script src="<?= base_url() ?>assets/style/vendor_components/jquery-slimscroll/jquery.slimscroll.js"></script>

<!-- FastClick -->
<script src="<?= base_url() ?>assets/style/vendor_components/fastclick/lib/fastclick.js"></script>

 


<!-- CrmX Admin App -->
<script src="<?= base_url() ?>assets/style/js/jquery.smartmenus.js"></script>
<script src="<?= base_url() ?>assets/style/js/menus.js"></script>
<script src="<?= base_url() ?>assets/style/js/template.js"></script>



<!-- daterangepicker -->
<script src="<?=base_url()?>assets/style/vendor_components/moment/min/moment.min.js"></script>
<script src="<?=base_url()?>assets/style/vendor_components/bootstrap-daterangepicker/daterangepicker.js"></script>

 <!-- Toast -->
<script src="<?= base_url() ?>assets/style/vendor_components/jquery-toast-plugin-master/src/jquery.toast.js" type="text/javascript"></script>

 <script src="<?=base_url()?>assets/js/preloader.js" type="text/javascript"></script>


<!-- Loading -->
<script src="<?= base_url() ?>assets/libraries/loading/jquery.loading.min.js" type="text/javascript"></script>


<script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>

<script>
function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
 
        $.ajax({
            type: "POST",
            data: { [token_name]:token_hash},
            async: true,
            url: base_url+"home/salir",
            success: function (result) {
                window.location.href =base_url;
            },

        });
    });
  }


  function onLoad() {
    gapi.load('auth2', function() {
      gapi.auth2.init();
    });
  }
</script>
<?php
       
    // $this->load->view("tipo_libjs")
    if (array_key_exists('libjs',$datalibrary)) {
        
        foreach ($datalibrary['libjs'] as $vista) {

            $this->load->view($vista);
        }
    } else {
        $this->load->view('libjs');
    }
    ?>

<script>
    $(document).ready(function () {
            $('body').css("overflow", "");
        });

</script>
</body>
</html>
