<style type="text/css">
	/**  */
	.detail{
		margin:0px 2px 0px 2px;
	}
	table>tr>td:first-child{
		padding-left:2px; 
	}
	.info {
		margin:-2px 0px 0px 2px;
		font-size:12px; 
	}
</style>

<div class="detail">
	<table class="table table-condensed table-hover table-condensed">
		<tr>
			<td>用户昵称：</td>
			<td><?php echo $user_nick ?></td>
		</tr>
		<tr>
			<td>用户账号：</td>
			<td><?php echo $user_mobile ?></td>
		</tr>
		<tr>
			<td>充值金额：</td>
			<td><?php echo $money ?></td>
		</tr>
		<tr>
			<td>联系人手机：</td>
			<td><?php echo $user_mobile ?></td>
		</tr>
		<tr>
			<td>支付方式：</td>
			<?php if ($topup_type==1): ?>
				<td>支付宝</td>
			<?php else: ?>
				<td>银行卡</td>
			<?php endif ?>
		</tr>
		<tr>
		<?php if ($topup_type==1): ?>
			<td>支付宝账号：</td>
			<td><?php echo $alipay ?></td>
		<?php else: ?>
			<td>收款人姓名：</td>
			<td><?php echo $remit_name ?></td>
		<?php endif ?>
		</tr>
		<tr>
			<td>创建时间：</td>
			<td><?php echo $topup_addtime ?></td>
		</tr>
	</table>
	<div class="info">请在确认收到钱后点击确认，点击确认会自动进行充值</div>
</div>