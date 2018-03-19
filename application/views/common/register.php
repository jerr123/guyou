<div class="container">
	<div class="register-container">
		<h1 class="title">菇友·千寻社 <small>(账号注册)</small></h1>
		<div class="register-dashed-line"></div>
		<form class="register-form">
			<div class="form-row">
				<label>邀请码</label>
				<div class="form-input">
					<input id="invitecode" type="text" name="" placeholder="填写邀请人给你的邀请码">
				</div>

			</div>

			<div class="form-row">
				<label>昵称</label>
				<div class="form-input">
					<input id="nickname" type="text" name="" placeholder="好听的网名">
				</div>
				
			</div>

			<div class="form-row">
				<label>手机</label>
				<div class="form-input">
					<input id="phone" type="text" name="" placeholder="手机号是登录账号">
				</div>
				
			</div>
			<div class="form-row">
				
				<label><a id="get-phone-code" class="get-code" href="javascript:void(0)">获取验证码</a></label>
				<div class="form-input">
					<input id="phone-code" style="width: 120px;margin-right: 150px"  type="text" name="" placeholder="验证码">
				</div>
			</div>

			<div class="form-row">
				<label>密码</label>
				<div class="form-input">
					<input id="pass" type="password" name="" placeholder="密码有助于安全">
				</div>
				
			</div>
			<div class="form-row">
				<label>重复密码</label>
				<div class="form-input">
					<input id="pass-repeat" type="password" name="">
				</div>
				
			</div>
			
			<div class="form-row">
				<button id="btn-submit" class="btn" type="button">提交</button>
				<button id="btn-clear" class="btn" type="button">清空</button>
			</div>
		</form>
	</div>
</div>

<span id="urls" data-registerurl="<?php echo site_url('Login/register'); ?>" data-getphonecode="<?php echo site_url('Login/getPhoneCode'); ?>" data-baseurl="<?php echo site_url('Ajax'); ?>" data-innerpage="<?php echo site_url('Innerpage') ?>" hidden="hidden"></span>