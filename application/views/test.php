<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>文件上传测试</title>
</head>
<body>
	<form action="<?php echo site_url('Ajax/uploadPhoto')?>" method="post" enctype="multipart/form-data">
		<input type="text" name="album_id">
		选择文件1<input type="file" name="file[]">
		选择文件2<input type="file" name="file[]">
		<input type="submit" value="上传">
	</form>
</body>
</html>