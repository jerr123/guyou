<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">


	<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/lib/css/normalize.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/common.css') ?>">


    <link rel="stylesheet" href="<?php echo base_url('public/lib/FontAwesome') ?>/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/lib/sweetalert'); ?>/sweetalert.css">

	

	<?php 
	if (isset($_csss))
		foreach ($_csss as $_css_path) {
			echo '<link rel="stylesheet" type="text/css" href="'.base_url('public/css/'.$_css_path.'.css').'">';
		}
	?>


	 <!--[if lt IE 9]>
      <script src="<?php echo base_url('public/lib/js/html5shiv.min.js') ?>"></script>
      <script src="<?php echo base_url('public/lib/js/respond.min.js') ?>"></script>
    <![endif]-->

    <script src="<?php echo base_url('public/lib/js/jquery-2.1.1.min.js') ?>"></script>
	<script src="<?php echo base_url('public/lib/sweetalert'); ?>/sweetalert.min.js"></script>
	<script src="<?php echo base_url('public/lib/layui'); ?>/layer.js"></script>

	<title><?php echo isset($title) ? $title : '菇友·千寻社' ?></title>
	
</head>
<body>