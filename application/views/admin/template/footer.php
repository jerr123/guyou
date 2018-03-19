<?php 
	if (isset($js))
	foreach ($js as $_script_path) {
		echo '<script type="text/javascript" src="'.base_url('public/admin/js/'.$_script_path).'.js"></script>';
	} 
	?>
	<!-- JS Scripts-->
    
    <!-- Bootstrap Js -->
    <script src="<?php echo base_url('public/admin/js/bootstrap.min.js');?>"></script>
    <!-- Metis Menu Js -->
    <script src="<?php echo base_url('public/admin/js/jquery.metisMenu.js');?>"></script>
    <!-- Morris Chart Js -->
    <script src="<?php echo base_url('public/admin/js/morris/raphael-2.1.0.min.js');?>"></script>
    <script src="<?php echo base_url('public/admin/js/morris/morris.js');?>"></script>
    <!-- Custom Js -->
    <script src="<?php echo base_url('public/admin/js/custom-scripts.js');?>"></script>
    <!-- ZUI Javascript组件 -->
    <!-- <script src="<?php echo base_url('public/admin/plugins/zui/js/zui.min.js');?>"></script> -->
    <?php if (isset($isWebUploader)): ?>
    	<script src="<?php echo base_url('public/admin/plugins/webUploader/js/webuploader.js');?>"></script>
    <?php endif ?>
	
</body>
</html>