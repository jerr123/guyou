<?php foreach ($data as $k => $v): ?>
	<li>
		<div class="img-con">
			<img src="<?php  echo $v['vicon'] ?>">
		</div>
		<div class="nickname"><?php echo $v['vnick'] ?></div>
		<div class="date-time"><?php echo $v['visitor_addtime'] ?></div>
	</li>
<?php endforeach ?>
