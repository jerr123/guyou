<style type="text/css">
	.edit {
		width: 300px;
		font-size: 15px;
	}
</style>

<div class="container">
	<div class="form-container">
		<table class="table-normal" cellpadding="0" cellspacing="0">
			<tr>
				<td>相册名: </td>
				<td><input id="input-name" class="edit input-normal" type="text" name=""></td>
			</tr>
			<tr>
				<td>相册描述: </td>
				<td>
					<div id="input-desc" class="edit input-normal" style="height: 100px;overflow: auto;" contenteditable="true" ></div>
				</td>
			</tr>

			<tr>
				<td>可见性: </td>
				<td>
					<select class="input-normal" style="font-size: 14px;" id="input-isshow">
						<option value="1">所有人可见</option>
						<option value="2">好友可见</option>
						<option value="3">仅自己可见</option>
					</select>
				</td>
			</tr>

			<tr>
				<td></td>
				<td><button id="confirm-create-album" class="btn btn-normal" type="button">确认创建</button></td>
			</tr>
		</table>
	
	</div>
</div>

<span id="ca-urls" data-baseurl="<?php echo site_url('Ajax'); ?>" hidden="hidden"></span>

<script type="text/javascript">

$(function () {
	var baseUrl = $('#ca-urls').data('baseurl');

	$('#confirm-create-album').on('click', function () {
		if ($('#input-name').val() == '') {
			layer.tips('相册名不能为空', '#input-name');
			return false;
		}

		$.post(baseUrl + '/addAlbum', {
			"album_name" : $('#input-name').val(),
			"album_desc" : $('#input-desc').text(),
			"album_isshow" : $('#input-isshow').val()
		}, function (response) {
			if (response.status != 1) {
				layer.msg(response.errmsg, {
					icon : 2
				})
				return false;
			}
			layer.closeAll();
			layer.msg('添加成功',{
				icon : 1,
				time : 2000
			},function(){
				location.reload();
			});
		});

	});

});

</script>