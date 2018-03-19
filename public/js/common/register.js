$(function() {

	var base_url = $('#urls').data('baseurl'),
		innerpageUrl = $('#urls').data('innerpage');

	var fillGuiCodeIndex = -1;

	// 获取手机验证码操作
	$('#get-phone-code').on('click', function () {
		var phone = $('#phone').val();
		
		if (!checkPhone(phone))
			return false;
	
		$.get(innerpageUrl + '/fillGuicode/' + phone, function (response) {
			fillGuiCodeIndex = layer.open({
				title: '填写图形验证码',
				type: 1,
				area: ['600px', '130px'],
				shadeClose: true, 
				content : response
			});

		});
		
	});

	// 提交数据操作
	$('#btn-submit').on('click', function () {
		
		if (!checkPhone($('#phone').val()))
			return false;

		if(!validatePassEqual())
			return false;

		$.post($('#urls').data('registerurl') , {
			'invitecode' : $('#invitecode').val(),
			'user_nick' : $('#nickname').val(),
			'code' : $('#phone-code').val(),
			'user_mobile' : $('#phone').val(),
			'user_password' : $('#pass').val()
		}, function (response) {
			if (response.status == 1) {
				swal({
				  title: "注册成功",
				  text: "2秒后转向登录界面",
				  timer: 2000,
				  showConfirmButton: false
				}, function() {
					location.pathname = "";
				});
			} else {
				console.log(response);
				swal("注册失败!", "错误提示: " + response.errmsg, "error");
			}

		});

		

	});

	// 清除所有数据
	$('#btn-clear').on('click', function () {
		$('input').val('');
	});


	// 检测手机号是否合法
	function checkPhone(phone) {
	    var pattern = /^1\d{10}$/;
	    console.log("checkphone program");
	    if (pattern.test(phone)) {
	        return true;
	    } else {
	    	// swal("手机号码不正确!", "请确保输入正确手机号", "error");
	    	layer.tips('手机号码格式不正确!', '#phone');
	        return false;
	    }
	}


	// 验证密码是否相同
	function validatePassEqual() {
		var pass = $('#pass').val();
		var passRepeat = $('#pass-repeat').val();

		if (pass.length < 6) {
			layer.tips('密码不能少于6位啊!朋友', '#pass');
			return false;
		}

		if (pass != passRepeat) {
			// swal("密码不相同!", "请确保输入正确密码", "error");
			layer.tips('两次输入的密码不相同!', '#pass-repeat');
			return false;
		}

		return true;
	}


});