<div class="container" style="margin-bottom: 20px;">
	<div class="container-center1100px top-bottom-padding" style="min-height: 500px;margin-top: 20px;">
		<div class="search-p-con">
			<div class="input-box">
				<input id="search-input" class="input-normal search-input" type="text" name="" placeholder="请输入账号或昵称进行搜索">
				<div id="result-box" class="s-result-box">
					<div id="hide-result" class="hide-result">
							隐藏搜索内容
					</div>
					<ul id="search-result-list" class="result-list">
						
						<li>
							<span class="head-img">
								<img src="<?php echo base_url('public/img/logo.png'); ?>">
							</span>
							<span class="info">
								<p>ArronSwiter</p>
								<p>18676874646</p>
								<p>中国 天津 滨海经济开发区</p>
							</span>
							<span class="manipulate">
								<button type="button" class="add-friend-btn"><i class="fa fa-plus"></i> 加好友</button>
							</span>
						</li>
						<li>
							<span class="head-img">
								<img src="<?php echo base_url('public/img/logo.png'); ?>">
							</span>
							<span class="info">
								<p>ArronSwiter</p>
								<p>18676874646</p>
								<p>中国 天津 滨海经济开发区</p>
							</span>
							<span class="manipulate">
								<button type="button" class="add-friend-btn"><i class="fa fa-plus"></i> 加好友</button>
							</span>
						</li>
						<li>
							<span class="head-img">
								<img src="<?php echo base_url('public/img/logo.png'); ?>">
							</span>
							<span class="info">
								<p>ArronSwiter</p>
								<p>18676874646</p>
								<p>中国 天津 滨海经济开发区</p>
							</span>
							<span class="manipulate">
								<button type="button" class="add-friend-btn"><i class="fa fa-plus"></i> 加好友</button>
							</span>
						</li>
						<li>
							<span class="head-img">
								<img src="<?php echo base_url('public/img/logo.png'); ?>">
							</span>
							<span class="info">
								<p>ArronSwiter</p>
								<p>18676874646</p>
								<p>中国 天津 滨海经济开发区</p>
							</span>
							<span class="manipulate">
								<button type="button" class="add-friend-btn"><i class="fa fa-plus"></i> 加好友</button>
							</span>
						</li>
						<li>
							<span class="head-img">
								<img src="<?php echo base_url('public/img/logo.png'); ?>">
							</span>
							<span class="info">
								<p>ArronSwiter</p>
								<p>18676874646</p>
								<p>中国 天津 滨海经济开发区</p>
							</span>
							<span class="manipulate">
								<button type="button" class="add-friend-btn"><i class="fa fa-plus"></i> 加好友</button>
							</span>
						</li>
						
						
					</ul>
					<div class="pagination">
							<a id="search-page-prev" href="javascript:void(0)"><i class="fa fa-chevron-circle-left"></i> 上一页</a>
							<a id="search-page-next" href="javascript:void(0)">下一页 <i class="fa fa-chevron-circle-right"></i></a>
					</div>
				</div>
			</div>
			<button id="search-btn" type="button" class="btn btn-normal search-btn"><i class="fa fa-search"></i> 搜索</button>			
			<a href="<?php echo site_url('Common/manageFriend') ?>" class="btn btn-normal" style="margin-left: 20px;"><i class="fa fa-users"></i> 好友管理</a>
		</div>

		<div class="friends-con">
			<section class="my-friends-con">
				<div class="title">
					我的好友
					<a class="more" href="<?php echo site_url('Common/manageFriend') ?>">更多...</a>
				</div>
				<ul id="my-friends" class="friends">
				<?php foreach ($data as $k => $v): ?>
					<li data-uid="<?php echo $v['friend_user_id']?>">
						<div class="head-img-con">
							<a href="<?php echo site_url('Common/mainPage').'?uid='.$v['friend_user_id']?>"><img src="<?php echo $v['ficon']; ?>"></a>
						</div>
						<p class="name">switer</p>
						<button type="button" class="friend-btn"><i class="fa fa-tty"></i> 打招呼</button>
					</li>
					
					
				<?php endforeach ?>
					
				</ul>
				
			</section>

			<section class="may-friends-con">
				<div class="title">
					可能认识的人
					
					<ul class="nav">
						<li><a id="may-prev" href="javascript:void(0)"><i class="fa fa-toggle-left"></i></a></li>
						<li><a id="may-next" href="javascript:void(0)"><i class="fa fa-toggle-right"></i></a></li>
					</ul>
				</div>

				<ul id="may-friends" class="friends">
					<li>
						<div class="head-img-con">
							<a href=""><img src="<?php echo base_url('public/img/logo.png'); ?>"></a>
						</div>
						<p class="name">switer</p>
						<button type="button" class="friend-btn"><i class="fa fa-user-plus"></i> 好友</button>
					</li>
					<li>
						<div class="head-img-con">
							<a href=""><img src="<?php echo base_url('public/img/logo.png'); ?>"></a>
						</div>
						<p class="name">switer</p>
						<button type="button" class="friend-btn"><i class="fa fa-user-plus"></i> 好友</button>
					</li>
					<li>
						<div class="head-img-con">
							<a href=""><img src="<?php echo base_url('public/img/logo.png'); ?>"></a>
						</div>
						<p class="name">switer</p>
						<button type="button" class="friend-btn"><i class="fa fa-user-plus"></i> 好友</button>
					</li>
					<li>
						<div class="head-img-con">
							<a href=""><img src="<?php echo base_url('public/img/logo.png'); ?>"></a>
						</div>
						<p class="name">switer</p>
						<button type="button" class="friend-btn"><i class="fa fa-user-plus"></i> 好友</button>
					</li>
					<li>
						<div class="head-img-con">
							<a href=""><img src="<?php echo base_url('public/img/logo.png'); ?>"></a>
						</div>
						<p class="name">switer</p>
						<button type="button" class="friend-btn"><i class="fa fa-user-plus"></i> 好友</button>
					</li>
					<li>
						<div class="head-img-con">
							<a href=""><img src="<?php echo base_url('public/img/logo.png'); ?>"></a>
						</div>
						<p class="name">Switer</p>
						<button type="button" class="friend-btn"><i class="fa fa-user-plus"></i> 好友</button>
					</li>
					<li>
						<div class="head-img-con">
							<a href=""><img src="<?php echo base_url('public/img/logo.png'); ?>"></a>
						</div>
						<p class="name">Switer</p>
						<button type="button" class="friend-btn"><i class="fa fa-user-plus"></i> 好友</button>
					</li>
					<li>
						<div class="head-img-con">
							<a href=""><img src="<?php echo base_url('public/img/logo.png'); ?>"></a>
						</div>
						<p class="name">Switer</p>
						<button type="button" class="friend-btn"><i class="fa fa-user-plus"></i> 好友</button>
					</li>
					<li>
						<div class="head-img-con">
							<a href=""><img src="<?php echo base_url('public/img/logo.png'); ?>"></a>
						</div>
						<p class="name">Switer</p>
						<button type="button" class="friend-btn"><i class="fa fa-user-plus"></i> 好友</button>
					</li>
					<li>
						<div class="head-img-con">
							<a href=""><img src="<?php echo base_url('public/img/logo.png'); ?>"></a>
						</div>
						<p class="name">Switer</p>
						<button type="button" class="friend-btn"><i class="fa fa-user-plus"></i> 好友</button>
					</li>
					<li>
						<div class="head-img-con">
							<a href=""><img src="<?php echo base_url('public/img/logo.png'); ?>"></a>
						</div>
						<p class="name">Switer</p>
						<button type="button" class="friend-btn"><i class="fa fa-user-plus"></i> 好友</button>
					</li>
					<li>
						<div class="head-img-con">
							<a href=""><img src="<?php echo base_url('public/img/logo.png'); ?>"></a>
						</div>
						<p class="name">Switer</p>
						<button type="button" class="friend-btn"><i class="fa fa-user-plus"></i> 好友</button>
					</li>
					<li>
						<div class="head-img-con">
							<a href=""><img src="<?php echo base_url('public/img/logo.png'); ?>"></a>
						</div>
						<p class="name">Switer</p>
						<button type="button" class="friend-btn"><i class="fa fa-user-plus"></i> 好友</button>
					</li>
					<li>
						<div class="head-img-con">
							<a href=""><img src="<?php echo base_url('public/img/logo.png'); ?>"></a>
						</div>
						<p class="name">Switer</p>
						<button type="button" class="friend-btn"><i class="fa fa-user-plus"></i> 好友</button>
					</li>
					<li>
						<div class="head-img-con">
							<a href=""><img src="<?php echo base_url('public/img/logo.png'); ?>"></a>
						</div>
						<p class="name">Switer</p>
						<button type="button" class="friend-btn"><i class="fa fa-user-plus"></i> 好友</button>
					</li>
					<li>
						<div class="head-img-con">
							<a href=""><img src="<?php echo base_url('public/img/logo.png'); ?>"></a>
						</div>
						<p class="name">Switer</p>
						<button type="button" class="friend-btn"><i class="fa fa-user-plus"></i> 好友</button>
					</li>
				</ul>

			</section>

		</div>
	</div>
</div>

<span id="urls" data-baseurl="<?php echo site_url('Ajax'); ?>" hidden="hidden"></span>