	<?php
        if($this->ion_auth->logged_in())
        {
            ?>
				</div>	
			</div>
			<?php
		}
	?>
		<!-- start: FOOTER -->
			
		<!-- end: FOOTER -->
        
        <!-- start: MAIN JAVASCRIPTS -->
			<!-- jQuery -->
		    <script src="<?= public_backend_url(); ?>components/jquery/dist/jquery.min.js"></script>
		    <script src="<?= public_backend_url(); ?>components/jquery/dist/jquery-migrate-1.2.1.min.js"></script>

		    <!-- Bootstrap Core JavaScript -->
		    <script src="<?= public_backend_url(); ?>components/bootstrap/dist/js/bootstrap.min.js"></script>

		    <!-- Metis Menu Plugin JavaScript -->
		    <script src="<?= public_backend_url(); ?>components/metisMenu/dist/metisMenu.min.js"></script>

		    <!-- Custom Theme JavaScript -->
		    <script src="<?= public_backend_url(); ?>js/walart_main.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->

		<script type="text/javascript">
			var base_url = "<?= base_url(); ?>";
		</script>

		<!-- start: SCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<?php
			if(isset($scripts) && count($scripts) > 0)
			{
				foreach($scripts['src'] as $script_src)
				{
					?>
					<script type="text/javascript" src="<?= public_backend_url(); ?><?= $script_src; ?>"></script>
					<?php
				}
			}
		?>
		<!-- end: SCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<?php
		if(file_exists(APPPATH . 'vardefs/' . 'simbanic' . '/script.php'))
        {
            require_once(APPPATH . 'vardefs/' . 'simbanic' . '/script.php');
        }
        ?>
        <?php 
		if(!$this->ion_auth->is_admin())
		{
			?>
			<script type="text/javascript">
				jQuery(document).ready(function(){
					
					jQuery('#depot_form input, #depot_form textarea, #depot_form select').attr('disabled', true);
					jQuery('#customer_form input, #customer_form textarea, #customer_form select').attr('disabled', true);
				});
			</script>
			<?php
		}
		?>
        <?php
        if(isset($simbanic))
        {
        	?>
        	<script type="text/javascript">
				getState();
				getDistrict();
				getArea();
			</script>
        	<?php
        }
        ?>
		
  	</body>
</html>
            
            
            
            
            
        
