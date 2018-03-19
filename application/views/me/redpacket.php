<!-- css -->
<style type="text/css">
	
/** css 部分*/
	.main-inner{
		/*background: #e5ebf2;*/
		margin: 0 39px; 
		/*border: 1px solid #00bff3;*/
		background: #E5EBF2;;
	}
	.main-inner .inner-header {
		/*background: #ED561F;*/
	}
	.main-inner .inner-header .title{
		background: #E93E00;
		padding: 0 0 0 50px;
		margin :0;
		border: 1px solid #FF4400;
	}
	.main-inner .inner-header .info {
		margin: 0;
		color: #fff;
		background: #A7B4B8;
	}
	.main-inner .inner-header .info p {
		margin: 5px 2px 4px 10px;
		font-size: 14px;
	}

	.main-inner .inner-header .title h3{
		margin: 4px 0; 
		color: #fff;
		/*background:#58bbb8;*/
	}

	.main-inner .inner-body {
		margin: 1px 5px;
		/*border: 1px solid red;*/
		padding: 10px;
		padding-bottom: 100px;

	}
	.main-inner .inner-body .panel-point {
		display: block;
		margin: 0 auto;
		margin-bottom: 16px;
	}
	 .panel {
	 	border-radius: 1%;
	 	text-align: center;
	 	background: #fff;
		margin: 0 15px;
		width: 219px;
		/*padding: 2px 40px;*/
		display: inline-block;
		/*border: 1px solid #42890D;*/
	}
	.main-inner .inner-body .panel .red-o{
		color: #eb4f38;
	}

	.main-inner .inner-body .panel-header h2{
		margin:0;
	}
	.main-inner .inner-body .panel .panel-header span{
		font-size: 12px;
	}
	.main-inner .inner-body .panel .panel-body{
		margin-bottom: 10px;
	}
	.main-inner .inner-body .panel .panel-footer{
		line-height: 30px;
	}
	.panel .panel-footer button {
		font-size: 16px;
		font-weight: 18px;
		color: #fff;
		width: 100%;
		/*background: #eb4f38;*/
		border: 0px solid #fff;
	}
	.panel .panel-footer button:hover {
		background: rgba(255,255,255,0.4);
		border: 0px solid #fff;
	}
	.red {
		background: #eb4f38;
	}
	.v3-o{
		color: #95BE3E;
	}
	.v3 {
		background: #95BE3E;
		color: #fff;
	}
	.v2-o{
		color: #F98700;
	}
	.v2 {
		background: #F98700;
	}
	.v1-o{
		color: #38B7EA;
	}
	.v1 {
		background: #38B7EA;
	}


</style>

<!-- 主体内容 -->
<div class="main-inner">
	<!-- 头部title -->
	<div class="inner-header">
		<div class="title">
			<h3>发红包</h3>
		</div>
		<div class="info">
			<p>红包玩法简介：你可以通过向红包池发红包来赚取收益,第二天系统会按照比例返到你的余额中。红包分为两大类 1.积分红包,2.钻石红包。积分红包不限制发放次数,钻石红包只对应普通会员、黄金会员、钻石会员用户,只有这三种用户可以发钻石红包，同时这三种会员又分别对应不同的钻石数量的钻石红包，钻石红包每人每天只能发一次</p>
		</div>
	</div>
	<!-- 内容体 -->
	<div class="inner-body">
		<!-- 主区块内容 -->
		<!-- 积分红包 -->
		<div style="display:block;" class="panel panel-point">
			<div class="panel-header red-o">
				<h2>积分红包</h2>
				<span><?php echo $pointNum?>积分</span>
			</div>
			<div class="panel-body red-o">
				<!-- <i class="fa fa-user fa-3x"></i> -->
				<img src="<?php echo base_url('public/img/me/point.png')?>" alt="" width="50">
			</div>
			<div class="panel-footer red">
				<button id="integral_packet" class="btn red">我要发</button>
			</div>
		</div>
		<!-- 钻石红包v3 -->
		<div class="panel">
			<div class="panel-header v3-o">
				<h2>钻石红包</h2>
				<span>vip3-<?php echo $v3['red_packet_num']?>钻石</span>
				
			</div>
			<div class="panel-body v3-o">
				<i class="fa fa-diamond fa-3x"></i>
			</div>
			<div class="panel-footer v3">
				<button id="diamond_packet" class="btn v3">我要发</button>
			</div>
		</div>
		<!-- v2 -->
		<div class="panel">
			<div class="panel-header v2-o">
				<h2>钻石红包</h2>
				<span>vip2-<?php echo $v2['red_packet_num']?>钻石</span>
				
			</div>
			<div class="panel-body v2-o">
				<i class="fa fa-diamond fa-3x"></i>
			</div>
			<div class="panel-footer v2">
				<button id="gold_packet" class="btn v2">我要发</button>
			</div>
		</div>
		<!-- V1 -->
		<div class="panel">
			<div class="panel-header v1-o">
				<h2>钻石红包</h2>
				<span>vip1-<?php echo $v1['red_packet_num']?>钻石</span>
				
			</div>
			<div class="panel-body v1-o">
				<i class="fa fa-diamond fa-3x"></i>
			</div>
			<div class="panel-footer v1">
				<button id="common_packet" class="btn v1">我要发</button>
			</div>
		</div>
		<!-- 积分红包 -->
	</div>
	<!-- 底部 -->
	<div class="inner-footer"></div>
</div>

<span id="redpacketurl" data-baseurl="<?php echo site_url('Ajax') ?>" hidden="hidden"></span>

<!-- js -->
<script type="text/javascript">
$(function () {
	console.log("mioce");
	var baseUrl = $('#redpacketurl').data('baseurl');

	$('#integral_packet').on('click', function () {
		var redi = layer.load();
		$.post(baseUrl + '/pointRedPacket',  function (response) {
			layer.close(redi);
			if (response.status == 1) {
				layer.msg('恭喜红包已经进入红包池,收益明天自动入账',{
					icon:1,
					time:4000
				});
			} if (response.status == 2){
				layer.msg('会员等级不够,请升级会员',{
					icon:4,
					time:4000
				});
			}else{
				var index = layer.msg(response.errmsg,{
					//area:['200px','100px'],
					icon:2,
					shadeClose:true,
					time:3000
					//fix:false
				});   
				return false;
			}
			
		});

	});

	$('#common_packet').on('click',  function () {
		var redi = layer.load();
		$.post(baseUrl + '/v1RedPacket',{red_packet_type:2}, function (response) {
			layer.close(redi);
			if (response.status == 1) {
				layer.msg('恭喜红包已经进入红包池,收益明天自动入账',{
					icon:1,
					time:4000
				});
			} if (response.status == 2){
				layer.msg('会员等级不够,请升级会员',{
					icon:5,
					time:4000
				});
			} if (response.status == 3){
				layer.msg(response.errmsg,{
					icon:4,
					time:4000
				});
			}else{
				var index = layer.msg(response.errmsg,{
					//area:['200px','100px'],
					icon:2,
					shadeClose:true,
					time:3000
					//fix:false
				});   
				return false;
			}
			
		});
	});


	$('#gold_packet').on('click', {red_packet_type:3}, function () {
		var redi = layer.load();
		$.post(baseUrl + '/v2RedPacket', function (response) {
			layer.close(redi);
			if (response.status == 1) {
				layer.msg('恭喜红包已经进入红包池,收益明天自动入账',{
					icon:1,
					time:4000
				});
			} if (response.status == 2){
				layer.msg('会员等级不够,请升级会员',{
					icon:5,
					time:4000
				});
			} if (response.status == 3){
				layer.msg(response.errmsg,{
					icon:4,
					time:4000
				});
			}else{
				var index = layer.msg(response.errmsg,{
					//area:['200px','100px'],
					icon:2,
					shadeClose:true,
					time:3000
					//fix:false
				});   
				return false;
			}
			
		});
	});

	$('#diamond_packet').on('click', function () {
		var redi = layer.load();
		$.post(baseUrl + '/v3RedPacket', {red_packet_type:4}, function (response) {
			layer.close(redi);
			if (response.status == 1) {
				layer.msg('恭喜红包已经进入红包池,收益明天自动入账',{
					icon:1,
					time:4000
				});
			} if (response.status == 2){
				layer.msg('会员等级不够,请升级会员',{
					icon:5,
					time:4000
				});
			} if (response.status == 3){
				layer.msg(response.errmsg,{
					icon:4,
					time:4000
				});
			}else{
				var index = layer.msg(response.errmsg,{
					//area:['200px','100px'],
					icon:2,
					shadeClose:true,
					time:3000
					//fix:false
				});   
				return false;
			}
			
		});
	});

});
</script>
