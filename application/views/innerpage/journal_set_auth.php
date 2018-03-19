<style type="text/css">
.box-con {
	/*text-align: center;*/
	margin: 20px 0 0 50px;
}

.box-con>label {
	margin-right: 10px;
	font-size: 15px;
	color: #777;
}

.box-con>select {
	font-size: 15px;
	min-width: 200px;
}


.box-con>button {
	padding: 5px 20px;
}
</style>

<div class="container">
	<div class="box-con">
		<label>权限：</label>
        <select id="auth" class="input-normal">
            <option <?php if($auth==1) echo 'selected="true"'?> value="1">公开</option>
            <option <?php if($auth==2) echo 'selected="true"'?> value="2">所有好友可见</option>
            <!-- <option value="3">指定好友可见</option> -->
            <option <?php if($auth==3) echo 'selected="true"'?> value="3">仅自己可见</option>
        </select>
        <button id="btn-set-auth" class="btn btn-normal">提交</button>
	</div>
</div>
<span id="setauthurls" data-baseurl="<?php echo site_url('Ajax') ?>" data-innerpage="<?php echo site_url('Innerpage'); ?>" hidden="hidden"></span>

<script type="text/javascript">

$(function () {
	var baseUrl = $('#setauthurls').data('baseurl');


	$('#btn-set-auth').on('click', function () {

		$.post(baseUrl + '/alterBlogRank', {
			"blog_id" : <?php echo $bid?>,
			"blog_rank" : $('#auth').val()
		}, function (response) {
			if (response.status != 1) {
				layer.tips(response.errmsg, '#btn-set-auth');
				return false;
			}

			layer.msg('修改访问权限成功');
		});
	});

});

</script>