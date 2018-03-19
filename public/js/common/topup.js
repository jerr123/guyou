$(function () {
    var randPoint = $('#pointNum').val();
    console.log(randPoint);
	var baseUrl = $('#urls').data('baseurl');
	var innerpageUrl = $('#urls').data('innerpage'); // Innerpage url

    
    /*是支付宝出现*/
    $(".hushubao").click(function(){
        $("#hushubao").css("display","block");
    });
    $(".hushubao").click(function(){
        $("#chongzhika").css("display","none");
    });
    $(".hushubao").click(function(){
        $("a:first").addClass("on1");
    });
    $(".hushubao").click(function(){
        $(".on").css("color","#8f8f8f");
    });
    $(".hushubao").click(function(){
        $(".on").css("font-size","15px");
    });

    /*是银行卡出现*/
    $(".chongzhika").click(function(){
        $("#chongzhika").css("display","block");
    });
    $(".chongzhika").click(function(){
        $("#hushubao").css("display","none");
    });
    $(".chongzhika").click(function(){
        $("a:first").removeClass("on1");
    });
    $(".chongzhika").click(function(){
        $(".on").css("color","#505050");
    });
    $(".chongzhika").click(function(){
        $(".on").css("font-size","16px");
    });




    $('#nextBtnAlipay').on('click', function () {

        var param = {
                //topup_type:1,
                alipay:$('#alipay').val(),
                money:$('#alipayMoney').val()+'.'+randPoint,
                mobile:$('#alipayMobile').val()
            };
		$.get(innerpageUrl + '/alipayNext', param, function (response) {
			if (response.status==-1){
                layer.msg(response.errmsg,{
                    icon:5,
                    title:'提交充值错误',
                })
            }else if (response.status==2){
                //
            }else{
                layer.msg('提交成功',{
                    icon:1
                    //title:'提交充值错误',
                })
                var index = layer.open({
                    title:'支付宝转账信息',
                    type: 1,
                    area:['680px','380'],
				    shadeClose: true, //点击遮罩关闭
				    // content: '\<\div style="padding:20px;">自定义内容\<\/div>'
				    content : response
			     });
            }
		});
	});

	$('#nextBtnBank').on('click',function(){
        //var nexti = layer.load();
        var param = {
                money:$('#bankMoney').val()+'.'+randPoint,
                mobile:$('#bankMobile').val(),
                //bank_no:$('#bankNo').val(),
                remit_name:$('#remitName').val()
            }
        $.get(innerpageUrl + '/bankNext', param, function (response) {
			if (response.status==-1){
                layer.msg(response.errmsg,{
                    icon:5,
                    title:'提交充值错误',
                })
            }else if (response.status==2){
                //
            }else{
                var index = layer.open({
                    title:'支付宝转账信息',
                    type: 1,
                    area:['680px','380'],
                    shadeClose: true, //点击遮罩关闭
                    // content: '\<\div style="padding:20px;">自定义内容\<\/div>'
                    content : response
                });
            }
            

		});
    });


	// 充值记录数据更新
	var recordPage = 1;
    $('#record-prev').on('click', function () {
    	if (recordPage <= 1) {
    		layer.tips('不能再往前了', '#record-prev');
    		return false;
    	}

    	recordPage--;
    	recordPage();
    });

    $('#record-next').on('click', function () {
    	recordPage++;
    	recordPage();
    });

    function recordPage() {
    	$.get(baseUrl + '/topupRecord/' + recordPage, function (response) {
    		if (response.status != 1) {
    			swal('Error', response.errmsg, 'error');
    			return false;
    		}

    		var content = '';
    		for (var counter = 0; counter < response.data.length; counter++) {
    			content +=  '<tr data-id"' + response.data[counter].id + '">' +
	                            '<td>' + response.data[counter].id + '</td>' +
	                            '<td>' + response.data[counter].date + ' ' + response.data[counter].time + '</td>' +
	                            '<td>' + response.data[counter].price + '</td>' +
	                            '<td>' + response.data[counter].trueprice + '</td>' +
	                            '<td>' + response.data[counter].remark + '</td>' +
	                            '<td><span>' + response.data[counter].state + '</span></td>' +
	                            '<td><a href="javascript:void(0)">查看</a></td>' +
	                        '</tr>';
    		}

    		$('#records-list-body').html(content);
    	});
    }

});