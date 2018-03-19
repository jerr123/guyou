<style type="text/css">
.mana-con {
	width: 100%;
	padding: 10px;
}

.mana-con label {
	margin-right: 5px;
	font-size: 15px;
	color: #777;
}

.mana-con .new-category {
	padding-bottom: 10px;
	width: 100%;
	/*border-top: 1px dashed #ddd;*/
	border-bottom: 1px dashed #ddd;
}

.category-lists {

	list-style: none;
	margin: 0;
	padding: 5px 0 0 0;
	color: #555;
	font-size: 15px;
}

.category-lists li {

	padding: 10px;
	
}
.category-lists li .title {
	/*word-wrap: normal;*/

	white-space: nowrap;
	text-overflow: ellipsis;
	overflow: hidden;
}

.category-lists li .title input {
	width: 350px;
}

.category-lists li:nth-child(odd) {
	background-color: #eee;
	display: block;
}


.category-lists .mani-panel {
	float: right;
}

.category-lists .mani-panel i {
	cursor: pointer;
	display: block;
	padding: 0 5px;
	float: right;

}

.category-lists .mani-panel i:hover {
	color: rgba(242,29,29,1);
}

.category-lists .mani-panel button {
	float: left;
	font-size: 12px;
	padding: 5px;
	margin-left: 5px;
}

</style>

<div id="manage-con" class="container">
	<div class="mana-con">
		<div class="new-category">
			<label>新分组:</label>
			<input id="input-category" type="text" name="" class="input-normal">
			<button id="btn-add-category" class="btn btn-normal">添加新分组</button>
		</div>
		<ul id="category-lists" class="category-lists">

		<?php foreach ($data as $k => $v): ?>
			<li data-id="<?php echo $v['group_id']?>"><span class="title js-title"><?php echo $v['friend_group_name'] ?></span> <span class="mani-panel"><i class="fa fa-close js-close"></i> <i class="fa fa-pencil js-alter"></i></span>
			</li>
		<?php endforeach ?>

		</ul>
	</div>
</div>
<span id="manacateurls" data-baseurl="<?php echo site_url('Ajax') ?>" data-innerpage="<?php echo site_url('Innerpage'); ?>" hidden="hidden"></span>

<script type="text/javascript">
$(function () {


    $(window).on("load",function(){
        $("#manage-con").mCustomScrollbar();
    });
 
	var baseUrl = $("#manacateurls").data('baseurl');

	// 添加新的分组
	$('#btn-add-category').on('click', function () {
		var name = $('#input-category').val();
		$.post(baseUrl + '/addGroup', {
			"friend_group_name": name
		}, function (response) {
			if (response.status != 1) {
				layer.msg(response.errmsg);
				return false;
			}

			layer.msg('添加成功');
			$('#category-lists').append('<li data-id="' +  response.data.group_id + '" data-title="' + name + '"><span class="title js-title">' + name + '</span> <span class="mani-panel"><i class="fa fa-close js-close"></i> <i class="fa fa-pencil js-alter"></i></span></li>');
		});

	});

	// 删除某个分组
	$('#category-lists').on('click', '.js-close', function () {
		var that = this;

		layer.msg('确定删除该分组么?', {
		  	time: 0 //不自动关闭
		  	,btn: ['确定', '取消']
		  	,yes: function(index){
			    $.post(baseUrl + '/delGroup', {
					"group_id": $(that).closest('li').data('id')
				}, function (response) {
					if (response.status != 1) {
						layer.msg(response.errmsg);
						return false;
					}

					layer.msg('删除分组成功');
					$(that).closest('li').remove();
				});
		  	}
		});
		

	});

	// 点击修改按钮
	$('#category-lists').on('click', '.js-alter', function () {
		var li = $(this).closest('li');
		var titleElem = li.find('.js-title');
		var content = titleElem.html();

		li.find('.mani-panel').html('<button class="btn btn-normal js-subalter">提交</button> <button class="btn btn-danger js-cancelalter">取消</button>');
	
		titleElem.html('<input type="text" class="input-normal js-input-title" value="' + content + '" />');
	});


	// 提交分组修改
	$('#category-lists').on('click', '.js-subalter', function () {
		var li = $(this).closest('li');
		var title = li.find('.js-input-title').val();
		$.post(baseUrl + '/alterGroup', {
			"group_id": li.data('id'),
			"friend_group_name" : title
		}, function (response) {
			if (response.status != 1) {
				layer.msg(response.errmsg);
				return false;
			}


			layer.msg('修改成功');
			li.find('.title').text(title);
			li.data('title', title);
			li.find('.mani-panel').html('<i class="fa fa-close js-close"></i> <i class="fa fa-pencil js-alter"></i>');
		});
	});

	// 取消分组修改
	$('#category-lists').on('click', '.js-cancelalter', function () {
		var li = $(this).closest('li');
		
		li.find('.title').text(li.data('title'));
		li.find('.mani-panel').html('<i class="fa fa-close js-close"></i> <i class="fa fa-pencil js-alter"></i>');
	});

});
</script>