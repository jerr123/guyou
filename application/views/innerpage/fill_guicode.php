<style type="text/css">
.code-con {
	margin: 20px;

}

	
	.input-box {
		width: 100%;
	}

	.input-box .checkcode-input, .input-box .checkcode{
		float: left;
	}

	.input-box .checkcode-input {
		padding: 10px;
		width: 9em;
		text-align: center;
	}

	.checkcode img {
		height: 40px;
	}
</style>

<div class="container" style="text-align: center;">
	<div class="code-con">
		<div class="input-box">
			<input id="cvalicode" data-phone="<?php echo $phone ?>" type="text" name="" class="input-normal checkcode-input" placeholder="点击验证码刷新">
			<div class="checkcode">
				<img src="<?php echo site_url('Captcha/create') ?>">
			</div>
		</div>
		<button id="btn-su-code" class="btn btn-normal js-su-code" style="padding: 10px;">提交并获取短信验证码</button>
	</div>
</div>
<span id="fillurls" data-loginurl="<?php echo site_url('Login') ?>" data-getphonecode="<?php echo site_url('Login/getPhoneCode'); ?>" data-baseurl="<?php echo site_url('Ajax'); ?>" data-captcha="<?php echo site_url('Captcha/create'); ?>" hidden="hidden"></span>

<script type="text/javascript">
$(function () {

	// 设置验证码点击刷新事件
	$('.checkcode img').on('click', function () {
		var captcha_url = $('#fillurls').data('captcha');
		$(this).attr('src', captcha_url + '?id=' + Math.random());
	});

	var getPhoneCodeUrl = $('#fillurls').data('getphonecode');

	var btnCode = document.getElementById('btn-su-code');


	// 提交确认发送短信的验证码
	$('.js-su-code').on( 'click' ,function () {


		var url = $('#fillurls').data('getphonecode');
		var phone = $('#cvalicode').data('phone');
		var icode = $('#cvalicode').val();
		$.post( getPhoneCodeUrl, {
			"phone" : phone,
			"code" : icode
		}, function (response) {
			console.log(response);
			if (response.status == 1) {
				layer.msg('请勿将该验证码泄露给他人');
			} else {
				layer.msg("验证码发送失败!错误原因: " + response.errmsg);
			}
		});
	});

});


</script>