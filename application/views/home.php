<!--引入webuploader-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/admin/plugins/webUploader/css/webuploader.css') ?>">
<script type="text/javascript" src="<?php echo base_url('public/admin/plugins/webUploader/js/webuploader.js'); ?>"></script>

<!-- emoji必备 -->
<link rel="stylesheet" href="<?php echo base_url('public/lib/emoji'); ?>/lib/css/jquery.mCustomScrollbar.min.css"/>
<link rel="stylesheet" href="<?php echo base_url('public/lib/emoji'); ?>/dist/css/jquery.emoji.css"/>
<link rel="stylesheet" href="<?php echo base_url('public/lib/emoji'); ?>/lib/css/railscasts.css"/>
<script src="<?php echo base_url('public/lib/emoji'); ?>/lib/script/jquery.mousewheel-3.0.6.min.js"></script>
<script src="<?php echo base_url('public/lib/emoji'); ?>/lib/script/jquery.mCustomScrollbar.min.js"></script>
<script src="<?php echo base_url('public/lib/emoji'); ?>/dist/js/jquery.emoji.min.js"></script>

<div class="container">
	<div class="container-center1100px top-bottom-padding">
		<div class="leftbox">
			<div class="user-info-panel">
				<div class="user-head-image">
					<img src="<?php echo isset($data['user_icon'])?$data['user_icon']:'' ?>">
				</div>
				<p class="user-nickname"><?php echo isset($data['user_nick'])?$data['user_nick']:'' ?></p>
				<ul class="user-infos">
					<li><span class="info-title">邀请码:</span><span><?php echo isset($data['user_invitecode'])?$data['user_invitecode']:'' ?></span></li>
					<li><span class="info-title">手机号:</span><span><?php echo isset($data['user_mobile'])?$data['user_mobile']:'' ?></span></li>
					<li><span class="info-title">邮箱:</span><span><?php echo isset($data['user_email'])?$data['user_email']:'' ?></span></li>
					<li><span class="info-title">家乡:</span><span><?php echo isset($data['user_address'])?$data['user_address']:'' ?></span></li>
					<li><span class="info-title">性别:</span><span><?php  if (isset($data['user_sex'])) { echo $data['user_sex']==1?'男':'女';}else{ echo '';} ?></span></li>
				</ul>
				<!-- <div class="alter-info-box">
					<button class="btn btn-default btn-block">修改信息</button>
				</div> -->
			</div>

			<div class="subnav-panel"> 
				<ul class="subnav-items">
					<li class="active"><a><i class="fa fa-fire fa-fw"></i>全部动态</a></li>
					<li><a href="<?php echo site_url("Common/photo") ?>"><i class="fa fa-image fa-fw"></i>相册</a></li>
					<li><a href="<?php echo site_url("Common/journal") ?>"><i class="fa fa-bookmark fa-fw"></i>日志</a></li>
				</ul>
			</div>

			<div class="ads-box">
				<div class="ad">
					<a href=""><img src="<?php echo $adv[1]['adv_img'] ?>"></a>
				</div>

				<div class="ad">
					<a href=""><img src="<?php echo $adv[0]['adv_img'] ?>"></a>
				</div>
			</div>
		</div>
		<div class="centerbox">
			<div class="publish-box">
				<div id="publisher" class="input-normal publisher" contenteditable="true" spellcheck="false"></div>
				<div class="manipulate">
					<ul class="other-publish">
						<li data-layer="1"><button id="btn-emoji" class="fa fa-smile-o btn-addon"></button></li>
						<!-- <li data-layer="2" ><button id="btn-photo" class="fa fa-photo btn-addon"></button></li> -->
						<li data-layer="3" ><button id="btn-at" class="fa fa-at btn-addon"></button></li>
					</ul>

					<div class="publish-btn-box">
						<span id="publish-num" class="publish-word-num">0/140</span>
						<button id="btn-newpublish" class="btn btn-normal publish-btn">发表</button>
					</div>
					
				</div>

				<div id="layer-panel">
					

					<div data-layer="2" class="photo-panel js-photo-panel hidden">
						<form class="photo-form">
							 <div class="btns-con">
							    	<a id="filePicker" style="float: left;">选择图片</a>
									<button id="ctlBtn" class="btn btn-upload" style="float: left;">开始上传</button>
							    </div>

							    <!--用来存放item-->
							    <div id="fileList" class="uploader-list">

	    					</div>
						</form>
					</div>



					<div data-layer="3" class="at-panel js-at-panel hidden">  <!-- hidden -->
						<ul id="ated-list" class="ated-box">
							
						</ul>

						<div class="at-confirm-box">
							<p><input id="at-search-input" class="input-normal" type="text" placeholder="好友昵称或账号" name=""></p>
							<button id="at-search-btn" class="btn btn-normal">搜索</button>
						</div>

						<div class="at-choose-box">
							<ul id="at-seach-lists" class="at-search-lists">
								
							</ul>

							<!-- <div class="at-search-pagination">
								<a class="btn btn-normal" href="javascript:void(0)">上一页</a>
								<a class="btn btn-normal" href="javascript:void(0)">下一页</a>
							</div> -->
						</div>
					</div>
				</div>

			</div>
			<div id="dynamics-box" class="dynamics-box">


			</div>
			<div class="load-more-box">
				<button id="load-more" class="btn btn-normal btn-more">点击加载更多</button>
			</div>
		</div>

		<div class="rightbox">
			<div class="infos">
				<div class="recognize">
					<div class="top">
						<span class="top-title">可能认识的人</span>
						<span class="link">
							<!-- <a href="">全部</a> -->
							<a id="another-mf" href="javascript:void(0)">换一批</a>
						</span>
					</div>
					<div class="maybe-friends">
						<ul id="maybe-friends">
							<li data-id="">
								<div class="img-con">
									<img src="<?php  echo base_url('public/img/logo.png') ?>">
								</div>
								<div class="nickname">Arron</div>
								<button type="button" class="add-friend">+ 好友</button>
							</li>
							<li>
								<div class="img-con">
									<img src="<?php  echo base_url('public/img/logo.png') ?>">
								</div>
								<div class="nickname">Arron</div>
								<button type="button" class="add-friend">+ 好友</button>
							</li>
							<li>
								<div class="img-con">
									<img src="<?php  echo base_url('public/img/logo.png') ?>">
								</div>
								<div class="nickname">Arron</div>
								<button type="button" class="add-friend">+ 好友</button>
							</li>
							<li>
								<div class="img-con">
									<img src="<?php  echo base_url('public/img/logo.png') ?>">
								</div>
								<div class="nickname">Arron</div>
								<button type="button" class="add-friend">+ 好友</button>
							</li>
							<li>
								<div class="img-con">
									<img src="<?php  echo base_url('public/img/logo.png') ?>">
								</div>
								<div class="nickname">Arron</div>
								<button type="button" class="add-friend">+ 好友</button>
							</li>
							<li>
								<div class="img-con">
									<img src="<?php  echo base_url('public/img/logo.png') ?>">
								</div>
								<div class="nickname">Arron</div>
								<button type="button" class="add-friend">+ 好友</button>
							</li>
						</ul>
					</div>
				</div>

				<div class="visiters">
					<div class="top">
						<span class="top-title">最近访客</span>
						<span class="page">
							<i id="visiters-prev" class="fa fa-angle-left"></i>
							<i id="visiters-next" class="fa fa-angle-right"></i>
						</span>
					</div>
					<div class="visiters-list">
						<ul id="visiters-list">
							<li>
								<div class="img-con">
									<img src="<?php  echo base_url('public/img/logo.png') ?>">
								</div>
								<div class="nickname">Arron</div>
								<div class="date-time">16/7/12</div>
							</li>
							<li>
								<div class="img-con">
									<img src="<?php  echo base_url('public/img/logo.png') ?>">
								</div>
								<div class="nickname">Arron</div>
								<div class="date-time">16/7/12</div>
							</li>
							<li>
								<div class="img-con">
									<img src="<?php  echo base_url('public/img/logo.png') ?>">
								</div>
								<div class="nickname">Arron</div>
								<div class="date-time">16/7/12</div>
							</li>
							<li>
								<div class="img-con">
									<img src="<?php  echo base_url('public/img/logo.png') ?>">
								</div>
								<div class="nickname">Arron</div>
								<div class="date-time">16/7/12</div>
							</li>
							<li>
								<div class="img-con">
									<img src="<?php  echo base_url('public/img/logo.png') ?>">
								</div>
								<div class="nickname">Arron</div>
								<div class="date-time">16/7/12</div>
							</li>
							<li>
								<div class="img-con">
									<img src="<?php  echo base_url('public/img/logo.png') ?>">
								</div>
								<div class="nickname">Arron</div>
								<div class="date-time">16/7/12</div>
							</li>
						</ul>
					</div>
					<div class="clearfix"></div>
					<div class="total">
						<span>今日访客: 0</span> <span>总访客: 0</span>
					</div>
				</div>

			</div>

			<div class="ads-box">
				<div class="ad">
					<a href=""><img src="<?php echo $adv[2]['adv_img'] ?>"></a>
				</div>

				<div class="ad">
					<a href=""><img src="<?php echo $adv[3]['adv_img'] ?>"></a>
				</div>
			</div>
		</div>

		<div class="clearfix">
			
		</div>
	</div>
</div>

<span id="urls" data-baseurl="<?php echo site_url('Ajax'); ?>" data-innerpageurl="<?php echo site_url('Innerpage') ?>" data-photoserver="<?php echo site_url('Ajax/uploadPhoto'); ?>"  data-swfurl="<?php echo base_url('public/admin/plugin/webUploader/'); ?>" data-emojiurl="<?php echo base_url('public/lib/emoji'); ?>" hidden="hidden"></span>
