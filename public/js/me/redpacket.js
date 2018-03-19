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