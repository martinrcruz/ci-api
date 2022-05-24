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
	<script src="<?=base_url()?>/assets/style/vendor_components/bootstrap/dist/js/bootstrap.min.js"></script>
        
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
