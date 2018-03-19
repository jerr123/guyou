<div class="container" style="margin-bottom: 20px;">
	<div class="container-center1100px top-bottom-margin">
		<div class="my-friends-con">
				<h2 class="title">我的好友</h2>
				<ul id="my-friends" class="friends">
				<?php foreach ($data as $k => $v): ?>
					<li data-uid="<?php echo $v['friend_user_id']?>">
						<div class="head-img-con">
							<a href="<?php echo site_url('Common/mainPage').'?uid='.$v['friend_user_id']; ?>"><img src="<?php echo $v['ficon']; ?>"></a>
						</div>
						<a class="name"><?php echo $v['fnick'] ?></a>
						<button type="button" class="friend-btn">打招呼</button>
					</li>
				<?php endforeach ?>
				<!--	<li data-uid="1">
						<div class="head-img-con">
							<a href="<?php echo site_url('Common/mainPage'); ?>"><img src="<?php echo base_url('public/img/logo.png'); ?>"></a>
						</div>
						<a class="name" href="">switer</a>
						<button type="button" class="friend-btn">打招呼</button>
					</li>
					<li>
						<div class="head-img-con">
							<a href="<?php echo site_url('Common/mainPage'); ?>"><img src="<?php echo base_url('public/img/logo.png'); ?>"></a>
						</div>
						<a class="name" href="">switer</a>
						<button type="button" class="friend-btn">打招呼</button>
					</li>
					<li>
						<div class="head-img-con">
							<a href="<?php echo site_url('Common/mainPage'); ?>"><img src="<?php echo base_url('public/img/logo.png'); ?>"></a>
						</div>
						<a class="name" href="">switer</a>
						<button type="button" class="friend-btn">打招呼</button>
					</li>-->
					
				</ul>

				<div class="pagination-con">
					<?php echo $page ?>
				</div>
		</div>

	</div>
</div>