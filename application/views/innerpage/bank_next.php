<!--银行卡-->

<div id="bankInfo" class="">
	<div class="box-treasure">
		<div class="treasure-main">
			<div class="main-title"><p>*请您使用网银或柜台像一下银行转账/汇款</p></div>
			<div class="main-list">
				<div class="list-box">
		            <div class="list-lable">
		                <ul>
                            <li><b>收款人：</b></li>
		                    <li><b>银行账户：</b></li>
		                    <li><b>开户行：</b></li>
		                    <li><b>待支付金额：</b></li>
		                    <li><b>备注/复验：</b></li>
		                </ul>
		            </div>
		            <div class="list-td-inhon">
		                <ul>
		                    <li><?php echo $account['receiver']?></li>
		                    <li><?php echo $account['receiverBankNo']?><i>请仔细阅读新收款账号</i></li>
                            <li><?php echo $account['receiverBankName']?><i>(建设银行暂不支持支付宝转账)</i></li>
		                    <li><span><?php echo $account['money']?></span></li>
		                    <li><?php echo $account['randomCode']?></li>
		                </ul>
		            </div>
				</div>
				<div class="prompt-box">
					
				</div>
			</div>
			<div class="main-remark"><p>这是我们要说的内容的区域这是我们要说的内容的区域这是我们要说的内容的区域这是我们要说的内容的区域这是我们要说的内容的区域</p></div>
		</div>
	</div>
	<div class="box-card"></div>
</div>