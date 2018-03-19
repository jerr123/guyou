<style type="text/css">
.new-friends-con {
	width: 100%;
	overflow: hidden;
}

	.new-friends-con .head-title {
		padding: 10px;
		border-bottom: 1px dashed #ccc;
	}

	.new-friends-con .head-title .group-title {
		font-size: 18px;
		color: #555;
	}

	.new-friends-con  {
		width: 100%;

	}

	.new-friends-con  ul {
		margin: 0;
		padding: 0;
		overflow: hidden;
	}

	.new-friends-con  li {
		height: 90px;
		width: 100%;
		display: block;
	}

	.new-friends-con  li:not(:last-child) {
		border-bottom: 1px solid #ccc;
	}

	.new-friends-con  li>div {
		float: left;
	}

	.new-friends-con .head-img-con {	/* 头像 */
		width: 70px;
		margin: 10px;
		height: 70px;
		border: 1px solid #ccc;
		overflow: hidden;
	}

	.new-friends-con .head-img-con img {
		width: 70px;
		height: 70px;
	}

	.new-friends-con .content {  /* 主体内容 */
		width: 350px;
		height: 70px;
		margin: 10px 0;
		/*background-color: red;*/
		/*padding-top: 10px;*/
	}

	.new-friends-con .content>p {
		
		display: block;
		color: #555;
		margin: 5px 0;
		font-size: 12px;
		padding: 0;
	}

	.new-friends-con .content a {
		color: rgba(51,159,242,1);
		font-size: 14px;
	}

	

	.new-friends-con .mani-panel {
		overflow: hidden;
		/*background-color: blue;*/
		height: 70px;
		margin-top: 10px;
		/*padding-top: 20px;*/
		width: 100px;
		text-align: right;
		font-size: 14px;
	}

	.new-friends-con .mani-panel button {
		font-size: 13px;
		padding: 5px 5px;
		line-height: 13px;
		margin: 0;

	}

	.put-select {
		float: left;
		border: none;
	}

	.put-select:focus {
		border: none;
	}


.mpagination {
	border-top: 1px dashed #ccc;
	padding: 10px 0;
	text-align: center;
}

	.mpagination .con {
		text-align: center;
		margin: auto;
	}
	.mpagination a {
		font-size: 12px;
		border-radius: 3px;
		display: inline-block;
		text-decoration: none;
		color: #777;
		padding: 3px 10px;
		border: 1px solid #999;
		transition: all 0.2s;
	}
	.mpagination a:hover {
		background-color: skyblue;
		color: #fff;
		border-color: skyblue;
	}
	.mpagination .con .active {
		background-color: skyblue;
		color: #fff;
		/* border-color: skyblue; */
	}
</style>
<div id="main-body" class="container">
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
</div>
<input type="hidden" id="per-page" value="<?php echo $info['per_page']?>">
<span id="notiurls" data-baseurl="<?php echo site_url('Ajax') ?>" data-innerpage="<?php echo site_url('Innerpage'); ?>" hidden="hidden"></span>

<script type="text/javascript">
$(function () {

	var baseUrl = $('#notiurls').data('baseurl');

	addFriendNotiPageJs();
	// 接受添加好友
	$('#main-body').on('click', '.js-accept', function () {
		var id = $(this).closest('li').data('id');
		var that = this;
		$.post(baseUrl + '/agreeFriendApply', {
			"id" : id
		}, function (response) {
			if (response.status != 1) {
				layer.msg(response.errmsg,{
					icon : 2
				})
				return false;
			}

			layer.msg('同意添加好友成功',{
				icon : 1
			})
			$(that).closest('.mani-panel').hide();
		});
	});


	// 拒绝添加好友
	$('#main-body').on('click', '.js-deny', function () {
		var id = $(this).closest('li').data('id');
		var that = this;

		$.post(baseUrl + '/rejectFriendApply', {
			"id" : id
		}, function (response) {
			if (response.status != 1) {
				layer.msg(response.errmsg,{
					icon : 2
				})
				return false;
			}

			layer.msg("已经拒绝该好友申请", {
				icon : 1
			})
			$(that).closest('.mani-panel').hide();
		});
	});

	function addFriendNotiPageJs(){
		/** 清楚CI分页类的a标签src */
		$('.mpagination .con a').attr("href","javascript:void(0)");

		$('.mpagination .con a').on('click', function(){
			if ($(this).attr("class")=='active'){
				return false;
			}
			var per_page = $('#per-page').val();
			var pageNum = $(this).data('ci-pagination-page');
			var page = (pageNum-1)*per_page;
			$.get($('#notiurls').data('innerpage') + '/addFriendNotiPage/page/' + page, function(data){
				$('#main-body').html(data);
				addFriendNotiPageJs();
			})
		})
	}

});
</script>