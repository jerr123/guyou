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
		padding: 5px 30px;
		background: #f7f9fe;
	}
	.inner-body .top-info .lf{
		float: left;
	}
	.inner-body .top-info .lr{
		float: right;
	}
	.inner-body .top-info .lf p{
		padding-top: 5px;
		color: #555;
		font-size: 15px;
	}
	.inner-body .top-info .lr p{
		color: #555;
		font-size: 15px;
	}
	.inner-body .top-info .lr p span {
		font-size: 18px;
		/*font-weight: bold;*/
		color: #f57403;
		/*margin: 10px 5px;*/
	}
	.inner-body .main-info {
		margin: 10px 5px;
		border: 1px solid #dde5f7;
	}
	.inner-body .main-info .info-group {
		/*overflow: hidden;*/
		margin-bottom: 5px;
		line-height: 35px;
		font-size: 14px;
		color: #555;
	}
	.inner-body .main-info .info-group .group-left {
		float: left;
		width: 174px;
		padding: 5px 0;
		padding-right: 6px;
		text-align: right;
	}
	.clearfix {
		display: block;
	}
	.inner-body .main-info .info-group .group-right {
		float: right;
		width: 476px;
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
		font-size: 14px;
		padding: 0px 6px;
		vertical-align: middle;
		width: 200px;

	}
	.ipt:focus{
		border-color: #66afe9;
		outline: 0;
		box-shadow: inset 0 1px 1px rgba(0,0,0,0.075),0 0 8px rgba(102,175,233,0.6);*/
	}
	.inner-body .main-info .info-group .group-right em {
		margin-left: 10px;
	}
	.btn-group {
		padding: 5px 0 30px 186px;
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
				<p class="">提现账户：<b><?php $user=$_SESSION['USER']; echo $user['user_nick'] ?></b></p>
			</div>
			<div class="lr">
				<p>账户可提现B币余额：<span><?php echo $wallet['b_icon']?>&nbsp;</span>B币</p>
			</div>
		</div>
		<div class="main-info">
			<div class="info-group clearfix">
				<label class="group-left" for="">提现银行：</label>
				<div class="group-right">
					<input type="hidden" >
					<p>尾号：<?php echo isset($bank['bank_no']) ? $bank['bank_no'] : '无数据'  ?></p>
					<p>开户银行：<?php echo isset($bank['bank_name']) ? $bank['bank_name'] : '无数据'  ?></p>
					<p>开户人：<?php echo isset($bank['bank_user_name']) ? $bank['bank_user_name'] : '无数据'  ?></p>
				</div>
			</div>
			<div class="info-group clearfix">
				<label class="group-left" for="">提现金额：</label>
				<div class="group-right">
					<input id="cashNum" type="text" class="ipt"><em>元</em><span>&nbsp;&nbsp;(1B币=1元)</span>
				</div>
			</div>
			<div class="info-group clearfix">
				<label class="group-left" for="">登录密码：</label>
				<div class="group-right">
					<input id="password" type="password" class="ipt">
				</div>
			</div>
			<div class="btn-group">
				<button id="toCash-btn">提交</button>
			</div>
		</div>
	</div>
	<div class="inner-footer"></div>
</div>

<!-- js -->
<script type="text/javascript">
	$(function(){
		$('#toCash-btn').on('click', function(){
			var cashi = layer.load();
			$.post("<?php echo site_url('Ajax/BIconToCash')?>", {
				b_icon : $('#cashNum').val(),
				password : $('#password').val()
			},function(response){
				layer.close(cashi);
				if (response.status==1){
					layer.closeAll();
					$.get(subnavAjaxUrl + '/' + target, function(response) {
						$('#content-con').html(response);
					});
					layer.msg('你的提现申请已提交,我们正在处理',{
						icon : 1,
						time : 4000
					})
				}else if(response.status==-3 || response.status==-4){
					layer.tips(response.errmsg, '#cashNum', {
						tips:3
					})
				}else if(response.status==-5){
					layer.tips(response.errmsg, '#password', {
						tips:2
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

