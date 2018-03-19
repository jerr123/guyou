<div class="container">
	<div class="container-center1100px top-bottom-padding" >
		<div class="meframe">
			<div class="frame-top">
				<div class="head-img-con">
					<div class="head-img">
						<img src="<?php echo $user['user_icon']; ?>">
					</div>
					<div class="btn-con">
						<a id="change-headimg" class="alter-head-img-btn" href="javascript:void(0)">修改头像</a>
					</div>
				</div>

				<div class="meinfos">
					<ul>
						<li>账号: <?php echo $user['user_mobile']?></li>
						<li>邀请码 :<?php echo $user['user_invitecode']?></li>
						<li>昵称 : <?php echo $user['user_nick'] ?></li>
						<li>现居于 : <span class="add-under-line"><?php echo $user['user_address'] ?></span> </li>
						<li><a id="alter-meinfo-btn" class="btn btn-info alter-meinfo-btn" href="javascript:void(0)">修改基本信息</a></li>

					</ul>

				</div>
				<div class="otherinfo">
					
				</div>
				<div class="clearfix"></div>
			</div>



			<div class="frame-content-con">
				<div class="aside-con">
					<ul id="ajax-subnav-list" data-url="<?php echo site_url('Me'); ?>">
						<li class="active"><a data-target="home" href="javascript:void(0)"><i class="fa fa-fw fa-user"></i>我的主页</a></li>
						<li><a data-target="envelope" href="javascript:void(0)"><i class="fa fa-fw fa-envelope-o"></i>个人提醒</a></li>
						<!-- <li><a href=""><i class="fa fa-fw fa-image"></i>相册</a></li> -->
						<!-- <li><a href=""><i class="fa fa-fw fa-bookmark"></i>日志</a></li> -->
						<li><a data-target="redpacket" href="javascript:void(0)"><i class="fa fa-fw fa-money"></i>发红包</a></li>
						<li><a data-target="purse" href="javascript:void(0)"><i class="fa fa-fw fa-credit-card"></i>我的钱包</a></li>
						<li><a data-target="upgrade" href="javascript:void(0)"><i class="fa fa-fw fa-rocket"></i>会员升级</a></li>
						<li><a data-target="friends" href="javascript:void(0)"><i class="fa fa-fw fa-user-secret"></i>我的度友</a></li>
						<li><a data-target="transferRecord" href="javascript:void(0)"><i class="fa fa-fw fa-sticky-note"></i>转账记录</a></li>
						<li><a data-target="information" href="javascript:void(0)"><i class="fa fa-fw fa-file-archive-o"></i>我的资料</a></li>
						<li><a data-target="setting" href="javascript:void(0)"><i class="fa fa-fw fa-cog"></i>设置</a></li>
					</ul>
				</div>
				<div id="content-con" class="content-con">

				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>

<span id="urls" data-baseurl="<?php echo site_url('Ajax')?>" data-innerpage="<?php echo site_url('Innerpage') ?>" hidden="hidden"></span>