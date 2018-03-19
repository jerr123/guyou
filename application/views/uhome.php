<div class="page-container">

	<div id="" class="center-box">
		<div class="bigtitle">
			<h1>菇友·千寻社</h1>
			<h2>你的菇友在这里</h2>
		</div>

		<div class="login-box">
			<form action="">
				<input id="phone" type="text" name="" placeholder="手机">
				<input id="pass" type="text" name="" placeholder="密码">
				<div class="checkcode-group">
					<input id="valicode" type="text" name="" class="checkcode-input" placeholder="右侧验证码点击刷新">
					<div class="checkcode">
						<img src="<?php echo site_url('Captcha/create') ?>">
					</div>
				</div>

				<button id="login-btn" class="login-btn" type="button">登录</button>
			</form>

			<div class="other-info">
				<a href="<?php echo site_url('Common/register') ?>">注册账号</a>
				|
				<a href="<?php echo site_url('Common/forgetPassword') ?>">忘记密码</a>
			</div>
		</div>
	</div>

	<div class="bottom-box">
		菇友·千寻社 &copy; 2016-2017 版权所有
	</div>

	
</div>


<span id="urls" data-loginurl="<?php echo site_url('Login') ?>" data-baseurl="<?php echo site_url('Ajax'); ?>" data-captcha="<?php echo site_url('Captcha/create'); ?>" hidden="hidden"></span>
