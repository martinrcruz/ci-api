 <script>
        var base_url = "<?= base_url();?>";
    </script>
	<!-- jQuery 3 -->

	<!-- jQuery 3 -->
	<script src="<?=base_url()?>/assets/style/vendor_components/jquery-3.3.1/jquery-3.3.1.js"></script>
	
	<!-- fullscreen -->
	<script src="<?=base_url()?>/assets/style/vendor_components/screenfull/screenfull.js"></script>
	
	<!-- popper -->
	<script src="<?=base_url()?>/assets/style/vendor_components/popper/dist/popper.min.js"></script>
	
	<!-- Bootstrap 4.0-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        
    <!-- Toast -->
    <script src="<?= base_url() ?>assets/style/vendor_components/jquery-toast-plugin-master/src/jquery.toast.js" type="text/javascript"></script>

    <!-- Loading -->
    <script src="<?= base_url() ?>assets/libraries/loading/jquery.loading.min.js" type="text/javascript"></script>
       
    <script src="<?=base_url()?>assets/js/preloader.js" type="text/javascript"></script>
    
</body>
<?php
        if (array_key_exists('libjs', $datalibrary)) {
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
         var token_name = '<?= $this->security->get_csrf_token_name(); ?>';
         var token_hash = '<?= $this->security->get_csrf_hash(); ?>';
         
       </script>
</body>
</html>
