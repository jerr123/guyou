<div class="container" style="">
	<div class="container-center1100px top-bottom-padding" style="margin-top: 20px;margin-bottom: 20px;">
		<div class="left-box">
			<section>
				<div class="head-title">好友分组<a id="btn-fgroup-manage" class="sub-panel btn btn-normal" href="javascript:void(0)">分组管理</a></div>
				<div class="content">
					<ul class="friend-group-list">
						<li><a href="<?php echo site_url('common/manageFriend')?>">全部好友 (<?php echo $info['total']?>)</a></li>
						<?php foreach ($group as $gk => $gv): ?>
							<li><a href="<?php echo site_url('common/manageFriend').'?group_id='.$gv['group_id']?>"> <?php echo $gv['friend_group_name'] ?>(<?php echo $gv['user_count']?>)</a></li>
						<?php endforeach ?>
						
						<!--<li class="active"><a href="">同学 (0)</a></li>
						<li><a href="">亲属 (0)</a></li>
						<li><a href="">同事 (0)</a></li>-->
					</ul>
				</div>
			</section>
			<section style="margin-top: 20px;background-color: rgba(255,255,255,0);padding: 0">

				<a id="btn-add-friendnoti" href="javascript:void(0)" class="btn btn-normal" style="font-size: 14px">添加好友通知 (<?php echo $info['applyNum'] ?>) <i class="fa fa-bullhorn"></i></a>
			</section>
		</div>
		<div class="right-box">
			<div style="min-height: 200px;border: 1px solid #ccc;background-color: #fff">
				<div class="head-title">
					<span class="group-title">全部好友</span>
				</div>
				<div id="friends-con" class="friends-con">
					<ul>
					<?php foreach ($data as $k => $v): ?>
						<li data-fid="<?php echo $v['friend_user_id']?>">
							<div class="head-img-con">
								<img src="<?php echo $v['ficon'] ?>">
							</div>
							<div class="content">
								<p><a href="<?php echo site_url('Common/mainPage').'?uid='.$v['friend_user_id'] ?>"><?php echo $v['fnick'] ?></a></p>
								<p><?php echo $v['fmobile'] ?></p>
								<p><?php echo $v['faddress'] ?></p>
							</div>
							<div class="mani-panel">
								<select class="input-normal put put-select">
									<option value="">我的好友</option>
								<?php foreach ($group as $gk => $gv): ?>
									<option value="<?php echo $gv['group_id']?>" <?php if ($gv['group_id']==$v['friend_group_id']) echo 'selected="true"'?>><?php echo $gv['friend_group_name'] ?></option>
								<?php endforeach ?>
								</select>
								<button class="btn btn-normal put js-sayhello">打招呼</button>
								<button class="btn btn-danger put js-delete"><i class="fa fa-times"></i></button>
							</div>
						</li>
					<?php endforeach ?>
						
					</ul>
				</div>
				<div class="pagination">
					<div class="con">
						<?php echo $page ?>
			
					</div>
				</div>
			</div>
		</div>

		<div class="clearfix"></div>
	</div>
</div>

<span id="urls" data-baseurl="<?php echo site_url('Ajax') ?>" data-innerpage="<?php echo site_url('Innerpage'); ?>" hidden="hidden"></span>