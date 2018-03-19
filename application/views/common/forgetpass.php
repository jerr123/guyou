<div class="container">
	<div class="forgetpass-container">
		<h1 class="title">菇友·千寻社 <small>(找回密码)</small></h1>
		<div class="forgetpass-dashed-line"></div>
			<!--step1-->
       <form class="forgetpass-form">

         	   
		     <div class="form-row">
				<label>手机</label>
				<div class="form-input">
					<input id="" type="text" name="" placeholder="手机号是登录账号">
				</div>
				
			</div>
			

			
			

			

			<div class="form-row">
				<label>验证码</label>
				<div class="form-input">
					<input id="" type="password" name="" placeholder="短信的验证码">
				</div>
                <div class="mobile-check-btn" id="reset-distance">
                    <a href="#">点击获取手机验证码</a>
                </div>
				
			</div>
				
			<!--step2-->
			<div class="forgetpass-dashed-line"></div>		
			<div class="form-row">
				<label>重置密码</label>
				<div class="form-input">
					<input id="" type="password" name="" placeholder="重新输入密码">
				</div>
				
			</div>

			<div class="form-row">
				<label>再次输入</label>
				<div class="form-input">
					<input id="" type="password" name="" placeholder="输入密码与上面的一致">
				</div>
				
			</div>
			<div class="form-row">
                <div class="form-check">
                    <input id="" type="text" name="" placeholder="图片验证码">
                    <div class="checkcode">
                        <img src="http://guyou.com/index.php/Captcha/create"/>
                    </div>
                </div>
			</div>
			<!--step3-->
			<div class="forgetpass-dashed-line"></div>
			<div class="form-row">
				<button class="btn" type="button">提交</button>
				<button class="btn" type="button">清空</button>
			</div>
		</form>
	</div>
</div>


<script type="text/javascript">
	$('.checkcode').on('click', function () {
		$(this).find('img').attr('src', 'http://guyou.com/index.php/Captcha/create?id=' + Math.random());
	});
</script>
