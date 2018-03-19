
<div id="alipayInfo">
	<div class="treasure-main">
		<div class="main-title"><p>*请用支付宝转账至以下账号或扫描二维码</p></div>
		<div class="main-list">
			<div class="list-box">
	            <div class="list-lable">
	                <ul>
                        <li><b>支付宝账户：</b></li>
	                    <li><b>公司名称：</b></li>
	                    <li><b>支付金额：</b></li>
	                    <li><b>到账时间：</b></li>
	                    <li><b>备注/复验：</b></li>
	                </ul>
	            </div>
	            <div class="list-td">
	                <ul>
	                    <li><?php echo $account['alipayAccount']?></li>
	                    <li><?php echo $account['companyName']?></li>
                        <li><span id="alipayMoney"><?php echo $account['money']?></span></li>
	                    <li><span>20分钟</span></li>
	                    <li><?php echo $account['randomCode']?></li>
	                </ul>
	            </div>
			</div>
			<div class="img-box">
				<img alt="" src="<?php echo $account['alipayQRCode']?>"/>
				
			</div>
			<div class="img-tishi"><p>XXX的支付宝二维码</p></div>
		</div>
		<div class="main-remark"><p>这是我们要说的内容的区域这是我们要说的内容的区域这是我们要说的内容的区域这是我们要说的内容的区域这是我们要说的内容的区域</p></div>
	</div>
</div>