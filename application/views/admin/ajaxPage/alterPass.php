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
			<td>用户账号：</td>
			<td><?php echo $admin_name ?></td>
		</tr>
		<tr>
			<td>原密码：</td>
			<td><input id="old" type="password" class="form-control"></td>
		</tr>
		<tr>
			<td>新密码：</td>
			<td><input id="new" type="password" class="form-control"></td>
		</tr>
		<tr>
			<td>新密码：</td>
			<td><input id="confirm" type="password" class="form-control"></td>
		</tr>
		<tr>
			<td colspan="2">
				<button id="sub-alter" type="button" class="btn btn-primary btn-sm">提交</button>
			</td>
		</tr>
	</table>
</div>
<script type="text/javascript">

		$('#sub-alter').on('click', function(){
			$.post("<?php echo site_url('admin/Home/alterPass')?>",{
				old : $('#old').val(),
				new : $('#new').val(),
				confirm : $('#confirm').val()
			}, function(rs){
				if (rs.status==1){
					layer.closeAll();
					layer.msg("修改成功，请记住你的新密码",{
						icon : 1
					})
				}else if(rs.status==-3){
					layer.tips(rs.errmsg, '#new',{
						tips : 2
					});
				}else if(rs.status==-2){
					layer.tips(rs.errmsg, '#old', {
						tips : 2
					})
				}else{
					layer.msg(rs.errmsg,{
						icon : 2
					})
				}
			})
		})

</script>