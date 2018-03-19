<div id="mfriends-con" class="new-friends-con">
		<ul>
		<?php foreach ($data as $k => $v): ?>
			<li data-id="<?php echo $v['fri_apply_id']?>">
				<div class="head-img-con">
					<img src="<?php echo $v['ficon'] ?>">
				</div>
				<div class="content">
					<p><a href=""><?php echo $v['fnick'] ?></a></p>
					<p><?php echo $v['fmobile'] ?></p>
					<p><?php echo $v['faddress'] ?></p>
				</div>

				<div class="mani-panel">
					<?php 
					if ($info['user_id']==$v['fid']){
						if ($v['fri_apply_state']==2){
							$msg = '对方已经同意';
						}else if ($v['fri_apply_state']==3){
							$msg = '对方拒绝添加你为好友';
						}else if ($v['fri_apply_state']==1){
							$msg = '等待对方同意';
						}
					} else {
						if ($v['fri_apply_state']==1){
							$msg = '<button class="btn btn-normal js-accept">接受</button>
					<button class="btn btn-danger js-deny">拒绝</button>';
						}else if ($v['fri_apply_state']==3){
							$msg = '你已经拒绝添加对方为好友';
						}else if ($v['fri_apply_state']==2){
							$msg = '你已经同意添加对方';
						}
					}
					echo $msg;
				?>
				</div>
			</li>
		<?php endforeach ?>
			
			
		</ul>
	</div>
	<div class="mpagination">
		<div class="con">
		<!-- <ul> -->
			<?php echo $page ?>
		<!-- </ul> -->
			
		<!--
			<a id="mpage-prev" href="">上一页</a>
			<a href="">1</a>
			<a href="">2</a>
			<a href="">3</a>
			<a id="mpage-next" href="">下一页</a>-->
		</div>
	</div>