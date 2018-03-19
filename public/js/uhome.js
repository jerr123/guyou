$(function () {

	// 设置验证码点击刷新事件
	$('.checkcode').on('click', function () {
		var captcha_url = $('#urls').data('captcha');
		$(this).find('img').attr('src', captcha_url + '?id=' + Math.random());
	});


	// 登录URL
	var login_url = $('#urls').data('loginurl');


	// 登录按钮监听
	$('#login-btn').on('click', function () {
		var phone = $('#phone').val();
		var pass = $('#pass').val();
		var valicode = $('#valicode').val();

		if (!checkPhone(phone)) 
			return false;

		$.post(login_url + '/login', {"mobile" : phone, "password" : pass, "code" : valicode}, function (response) {
			console.log(response);
			if (response.status == 1) {
				swal({
				  title: "登录成功",
				  text: "正在转向主页面",
				  timer: 1000,
				  showConfirmButton: false
				}, function() {
					location.pathname = "Home/loginedHome";
				});
			} else {
				swal("登录失败!", "错误原因: " + response.errmsg, "error");
			}
		});

	});


	// 检测手机号是否合法
	function checkPhone(phone) {
	    var pattern = /^1\d{10}$/;
	    
	    if (pattern.test(phone)) {
	        return true;
	    } else {
	    	swal("手机号码不正确!", "请确保输入正确手机号", "error");
	        return false;
	    }
	}

});