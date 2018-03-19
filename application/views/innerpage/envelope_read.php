
<style type="text/css">
	.main-info {
		border-bottom: 1px solid #48D4A3;
		
	}
	.main-info .head-info {
		/*overflow: hidden;*/
		background: #f7f9fe;
		margin: 2px 10px;
		border: 1px solid #dde5f7;
	}
	.main-info .head-info .ficon {
		display: inline-block;
		padding: 5px 10px;
		margin: 10px 0px;
		margin-left: 40px; 
	}
	.main-info .head-info .ficon img {
		width: 78px;
		border-radius: 50%;
	}
	.main-info .head-info p {
		margin: 0;
		padding: 0;
	}
	.main-info .head-info .other {
		overflow: hidden;
		display: inline-block;
		padding: 5px 10px;
		margin: 10px 0px;

	}
	.main-info .head-info .other .about {
		padding: 20px 10px;
		margin: 4 10px;
		float: right;
	}
	.main-info .head-info .other .about span {
	}
	.main-info .body-info {
		margin: 6px 10px;
		border: 1px solid #dde5f7;
		
		padding: 40px 60px;
		margin-bottom: 20px;
	}
</style>
<div class="main-info">
	<div class="head-info">
		<div class="ficon">
			<img src="<?php echo $data['ficon']?>" >
		</div>
		<div class="other">
			<div class="about">
				<span>时间：<?php echo $data['fri_tx_addtime']?></span>
			</div>
			<div class="about">
				<span>消息类型：
					<?php if ($data['fri_tx_type']==1){?>
						加好友
					<?php }else if ($data['fri_tx_type']==2){?>
						评论
					<?php }else if ($data['fri_tx_type']==3){?>
						系统
					<?php }else if ($data['fir_tx_type']==4){?>
						提现
					<?php }?>
				</span>
			</div>
			<div class="about">
				<span>来自：<?php echo $data['fnick']?></span>
			</div>
		</div>
		
	</div>
	<div class="body-info">
		<?php echo $data['fri_tx_content']?>
	</div>
</div>