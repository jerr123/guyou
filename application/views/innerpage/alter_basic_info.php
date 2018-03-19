<style type="text/css">
	
/*
 	修改基本信息
 */

.alter-mo-con {
	padding: 20px;
	width: 100%;
}

	.alter-mo-con .form-table {
		box-sizing: border-box;
		cell-spacing: none;
		cell-padding: none;
		width: 100%;
		margin: auto;
		/*background-color: #eee;*/
		font-size: 14px;
		color: #777;
	}

	.alter-mo-con .form-table tr {
		border: none;
		padding: 0;
		margin: 0;
	}

	.alter-mo-con .form-table td {
		padding: 8px 0;
	}

	.alter-mo-con .form-table td:nth-child(1) {
		width: 30%;
		text-align: right;
		padding: 0 10px 0 0;
	}

	.alter-mo-con .form-table td:nth-child(2) {
		width: 70%;
		
	}

	.alter-mo-con .form-table .form-input {
		
		font-size: 14px;
		padding: 5px 10px;
		width: 50%;
		color: #777;
	}

/* 	.alter-mo-con .form-table .form-input:focus,
.alter-mo-con  .form-table .select:focus{
	border: 1px solid rgba(255,217,82,1);
	outline: none;
}
 */
	.alter-mo-con  .form-table .select {
		border: 1px solid #ccc;
		color: #777;
		padding: 5px;
	}


	.alter-mo-con .alter-btn {
		display: inline-block;
		text-decoration: none;
		padding: 5px 20px;

	}



</style>

<div class="alter-mo-con">
	<table class="form-table">
		<tbody>
			<tr>
				<td>星座:</td>
				<td id="nickname">
					<input id="al-star" value="<?php echo $user['user_star'] ?>" class="input-normal form-input nickname" type="text" name="">
				</td>
			</tr>
			<tr>
				<td>居住地:</td>
				<td>
					<input id="al-address" value="<?php echo $user['user_address'] ?>" class="input-normal form-input" type="text" name="">
				</td>
			</tr>
			<tr>
				<td>性别:</td>
				<td>
					<select id="al-sex" class="input-normal select" >
						<option <?php if($user['user_sex']==1) echo 'selected="true"';?> value="1">男</option>
						<option <?php if($user['user_sex']==2) echo 'selected="true"';?> value="2">女</option>
						<!-- <option value="3">中性</option> -->
					</select>
				</td>
			</tr>
			<tr>
				<td>邮箱:</td>
				<td>
					<input id="al-email" value="<?php echo $user['user_email'] ?>" class="input-normal form-input" type="text" name="">
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<a id="btn-sub-alter" class="btn btn-normal alter-btn" href="javascript:void(0)">提交</a>
					<a id="btn-clear-alter" class="btn btn-info alter-btn" href="javascript:void(0)">清空</a>
				</td>
			</tr>
		</tbody>
	</table>
</div>

<span id="basicurls" data-baseurl="<?php echo site_url('Ajax'); ?>" hidden="hidden"></span>

<script type="text/javascript">
$(function() {

	var baseUrl = $("#basicurls").data('baseurl');

	$('body').on('click', '#btn-sub-alter', function () {
		// layer.msg('请输入有效的性别', {icon: 2}); // 出错

		// layer.tips('只想提示地精准些', '#al-sex');
		var email = $('#al-email').val();
		if (!checkEmail(email))
			return false;

		$.post(baseUrl + '/alterUserInfo', {
			"user_star" : $('#al-star').val(),
			"user_address" : $('#al-address').val(),
			"user_sex" : $('#al-sex').val(),
			"user_email" : $('#al-email').val()
		}, function (response) {
			if (response.status == 1) {
				layer.msg('修改信息成功',{
					icon:1,
					time:1000
				},function(){
					location.reload();
				})
			} else {
				layer.msg(response.errmsg,{
					title:'修改错误提示',
					icon:2
				})
				return false;
			}
		});

	});


	// 检测邮箱
	function checkEmail(email) {  
	    if (email == "") {  
	      	layer.tips('邮箱地址不能为空!', '#al-email');
	        return false;  
	    }  

	    if (!email.match(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/)) {  
	        layer.tips('邮箱格式不正确!', '#al-email');
	        return false;  
	    }  
	    return true;  
	}  



	$('#btn-clear-alter').on('click', function() {	// 清空按钮
		$('.alter-mo-con input').val('');
	});


});
</script>