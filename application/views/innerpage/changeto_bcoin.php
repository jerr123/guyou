<!-- 提出b币 -->
<style type="text/css">
	/**	css */
	.inner {
		margin:5px 3px;
	}
	.inner-header {
		/**/
	}
	.inner-body	{
		/*width: 620px;*/
	}
	.inner-body .top-info {
		overflow: hidden;
		margin: 10px 5px;
		border: 1px solid #dde5f7;
		padding: 5px 40px;
		background: #f7f9fe;
		font-size: 15px;
	}
	.inner-body .top-info .lf{
		padding: 0 20px;
		float: left;
	}
	.inner-body .top-info .lr{
		/*padding: 0 20px;*/
		float: right;
		margin-right: 20px; 
	}
	.inner-body .top-info .rant {
		padding: 0 20px;
		float: right;
		/*height: 20px;*/
		margin-right: 20px;
	}
	.inner-body .top-info .rant p {
		margin: 0;
		margin-top: -5px;
		font-size: 13px;
		color: #4b7caf;

	}
	.inner-body .top-info .lf p{
		color: #555;
		/* font-size: 15px; */
	}
	.inner-body .top-info .lr p{
		color: #555;
		/* font-size: 15px; */
	}
	.inner-body .top-info .lr p span {
		font-size: 15px;
		color: #f57403;
		/*margin: 10px 5px;*/
	}
	.inner-body .main-info {
		margin: 14px 5px;
		border: 1px solid #dde5f7;
	}
	.inner-body .main-info .info-group {
		/*overflow: hidden;*/
		margin-bottom: 6px;
		line-height: 35px;
		font-size: 14px;
		color: #555;
	}
	.inner-body .main-info .info-group .group-left {
		float: left;
		width: 250px;
		padding: 5px 0;
		padding-right: 6px;
		text-align: right;
	}
	.clearfix {
		display: block;
	}
	.inner-body .main-info .info-group .group-right {
		float: right;
		width: 390px;
		padding-left: 1px;
		text-align: left;
	}
	.inner-body .main-info .info-group .group-right p {
		padding-right: 20px; 
		line-height: 16px;
		display: inline-block;
	}
	.ipt {
		display: inline-block;
		line-height: 30px;
		border: 1px solid #ccc;
		border-radius: 2px;
		box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
		color: #555;
		font-size: 12px;
		padding: 1px 4px;
		vertical-align: middle;
		width: 140px;

	}
	.ipt:focus{
		border-color: #66afe9;
		outline: 0;
		box-shadow: inset 0 1px 1px rgba(0,0,0,0.075),0 0 8px rgba(102,175,233,0.6);
	}
	.inner-body .main-info .info-group .group-right em {
		margin-left: 10px;
	}
	.btn-group {
		padding: 5px 0 30px 270px;
	}
	.btn-group button {
		border: 1px solid #66afe9;
		border-radius: 4px;
		color: #66afe9;
		background: #fff;
		padding: 6px 20px;
	}
	.btn-group button:hover {
		cursor: pointer;
		background: #66afe9;
		color: #fff;
	}
</style>
<div class="inner">
	<div class="inner-header">
		<!-- <h3>提现</h3> -->
	</div>
	<div class="inner-body">
		<div class="top-info">
			<div class="lf">
				<p class="">钱包账户：<b><?php $user=$_SESSION['USER']; echo $user['user_nick'] ?></b></p>
			</div>
			<div class="lr">
				<p>账户B币余额：<span><?php echo $wallet['b_icon'] ?>&nbsp;</span><i class="fa fa-btc"></i></p>
			</div>
			<div class="lr">
				<p>账户钻石余额：<span><?php echo $wallet['diamond']?>&nbsp;</span><i class="fa fa-diamond"></i></p>
			</div>
			<div class="rant clearfix">
				<p>1B币=<?php echo 1/$bdrant?>&nbsp;<i class="fa fa-diamond"></i></p>	
			</div>
		</div>
		<div class="main-info">
			<div class="info-group clearfix">
				<input id="bdrant" type="hidden" value="<?php echo $bdrant?>">
				<label class="group-left" for="">所需钻石数：</label>
				<div id="" class="group-right">
					<p><span id="change-need">00.00</span>&nbsp;<i class="fa fa-diamond" id="diamond-tip"></i></p>
				</div>
			</div>
			<div class="info-group clearfix">
				<label class="group-left" for="">兑换B币数：</label>
				<div class="group-right">
					<input type="text" id="bIocn" class="ipt"><em>B币</em>
				</div>
			</div>
			<!--<div class="info-group clearfix">
				<label class="group-left" for="">登录密码：</label>
				<div class="group-right">
					<input type="password" class="ipt">
				</div>

			</div>-->
			<div class="btn-group">
				<button id="changeBtn">兑换</button>
			</div>
		</div>
	</div>
	<div class="inner-footer"></div>
</div>

<script type="text/javascript">
	$(function(){
		$('#bIocn').on('input propertychange', function () {
			var bIocn = $(this).val();
			var bdrant = $('#bdrant').val();
			var need = bIocn/bdrant;
			$('#change-need').text(need.toFixed(2));
		})
		$('#changeBtn').on('click', function () {
			$.post("<?php echo site_url('Ajax/DiamondToBIcon') ?>", {
				b_icon : $('#bIocn').val(),
			}, function(response){
				if (response.status==1){
					layer.closeAll();
					$.get(subnavAjaxUrl + '/' + target, function(response) {
						$('#content-con').html(response);
					});
					layer.msg('兑换成功',{
						icon:1,
						time:2000
					},function(){
						//
					})
				}else if(response.status==-2){
					layer.tips('输入的B币必须大于零','#bIocn',{
						tips : 2
					})
				}else if(response.status==-3){
					layer.tips('没有那么多钻石','#change-need',{
						tips : 1
					})
				}else{
					layer.msg(response.errmsg, {
						icon : 2
					})
				}
			})
		})
	})
</script>

