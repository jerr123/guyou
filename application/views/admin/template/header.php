<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<!-- Bootstrap Styles-->
    <link href="<?php echo base_url('public/admin/css/bootstrap.css');?>" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="<?php echo base_url('public/lib/FontAwesome/css/font-awesome.css');?>" rel="stylesheet" />
    <!-- Morris Chart Styles-->
    <link href="<?php echo base_url('public/admin/js/morris/morris-0.4.3.min.css');?>" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="<?php echo base_url('public/admin/css/custom-styles.css');?>" rel="stylesheet" />
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url('public/admin/js/dataTables/dataTables.bootstrap.css') ?>">
    <!-- jQuery Js -->
    <script src="<?php echo base_url('public/admin/js/jquery-1.10.2.js');?>"></script>
    <!-- layUI -->
    <script src="<?php echo base_url('public/lib/layui/layer.js') ?>"></script>
    <!-- zui -->
    <!-- <link href="<?php echo base_url('public/admin/plugins/zui/css/zui.min.css');?>" rel="stylesheet"> -->
    <!-- SUI -->
    <!-- <link rel="stylesheet" href="http://g.alicdn.com/sj/dpl/1.5.1/css/sui.min.css">  -->
    <!-- <script type="text/javascript" src="http://g.alicdn.com/sj/dpl/1.5.1/js/sui.min.js"></script>  -->
    <!-- <script type="text/javascript" src="<?php echo base_url('public/admin/plugins/sui/sui.min.js') ?>"></script> -->
    <!-- Google Fonts-->
    <!-- <link href='http://fonts.useso.com/css?family=Open+Sans' rel='stylesheet' type='text/css' /> -->
    <?php 
	if (isset($css))
		foreach ($css as $_css_path) {
			echo '<link rel="stylesheet" type="text/css" href="'.base_url('public/admin/css/'.$_css_path.'.css').'">';
		}
	?>
    <?php if (isset($isWebUploader)): ?>
        <link rel="stylesheet" href="<?php echo base_url('public/admin/plugins/webUploader/css/webuploader.css') ?>">
    <?php endif ?>
    <!-- bootbox -->
    
        <script type="text/javascript" src="<?php echo base_url('public/admin/lib/bootbox.js') ?>"></script>

	<title><?php echo isset($title)?$title:"菇友网管理后台";?></title>
</head>
<body>
