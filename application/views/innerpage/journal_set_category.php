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
	min-width: 200px;
	font-size: 15px;
}


.box-con>button {
	padding: 5px 20px;
}
</style>

<div class="container">
	<div class="box-con">
		<label>分类: </label>
        <select id="category" class="input-normal">
            <?php foreach ($type as $k => $v): ?>
            	<option <?php if ($type_id==$v['blog_type_id']) echo 'selected="true"';?> value="<?php echo $v['blog_type_id']?>"><?php echo $v['blog_type_name']?></option>
            <?php endforeach ?>
        </select>
        <button id="btn-set-category" class="btn btn-normal">提交</button>
	</div>
</div>
<span id="setcateurls" data-baseurl="<?php echo site_url('Ajax') ?>" data-innerpage="<?php echo site_url('Innerpage'); ?>" hidden="hidden"></span>

<script type="text/javascript">

$(function () {
	var baseUrl = $('#setcateurls').data('baseurl');


	$('#btn-set-category').on('click', function () {

		$.post(baseUrl + '/alterBlogBelong', {
			"id" : <?php echo $bid?>,
			"blog_type_id" : $('#category').val()
		}, function (response) {
			if (response.status != 1) {
				layer.tips(response.errmsg, '#btn-set-auth');
				return false;
			}

			layer.msg('修改分类成功');
		});
	});

});

</script>