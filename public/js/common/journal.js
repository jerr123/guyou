$(function () {

	var innerpageUrl = $('#urls').data('innerpage'),
		baseUrl = $('#urls').data('baseurl');


	// 批量处理操作
 	$('#btn-muti').on('click', function () {
		  
		/*$.get(innerpageUrl + '/uploadImgs', function (response) {
			var index = layer.open({
				title: '批量处理',
				type: 1,
				area: ['600px', '360px'],
				shadeClose: true, 
				content : response
			});

		});*/
	});



/*
下拉框下的所有操作
 */

	// 编辑下拉框
	$('#journals-list').on('click', '.o_edit>i',function () {
		var maniHtml = 	'<i class="fa fa-chevron-down"></i>' +
						'<ul class="o_panel">' +
							'<li><a class="js-delete" href="javascript:void(0)">删除日志</a></li>' +
							'<li><a class="js-setauth" href="javascript:void(0)">设置权限</a></li>' +
							'<li><a class="js-setcategory" href="javascript:void(0)">修改分类</a></li>' +
						'</ul>';



		var edit = $(this).closest('span.o_edit');

		if (edit.hasClass('active')) { // 如果点击的是当前已近触发的按钮就做class的修改
			edit.find('.o_panel').css({"display": "none"});
			edit.html(maniHtml).toggleClass('active');
			return false;
		}

		// 如果没有已经出发的按钮, 统一操作
		$('#journals-list span.o_edit.active ul.o_panel').remove();
		$('#journals-list span.o_edit.active').removeClass('active');

		edit.html(maniHtml).toggleClass('active');
		edit.find('.o_panel').css({"display": "block"});
	});


	// 删除日志操作
	$('#journals-list').on('click', '.js-delete', function () {
		var that = this;


		swal({
			title: "是否确认删除?",
			text: "删除日志后不可恢复，是否确认删除",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			cancelButtonText: "否",
			confirmButtonText: "确认删除",
			closeOnConfirm: false
		}, function(){

			// console.log($(that).closest('.js-liid').data('id').html());
			$.post(baseUrl + '/delBlog', {
				"blog_id" : $(that).closest('.js-liid').data('id')
			}, function (response) {
				if (response.status != 1) {
					swal("Error", response.errmsg, 'error');
					return false;
				}

				swal("已删除!", "这篇日志已成功删除!", "success");
				$(that).closest('li').remove();
			});
			
		});

		
	});

	// 设置权限操作
	$('#journals-list').on('click', '.js-setauth', function () {
		$.get(innerpageUrl + '/journalSetAuth',{ bid:$(this).closest('.js-liid').closest('li').data('id')}, function (response) {
			var index = layer.open({
				title: '修改日志访问权限',
				type: 1,
				area: ['500px', '120px'],
				shadeClose: true, 
				content : response
			});

		});
	});


	// 修改分类操作
	$('#journals-list').on('click', '.js-setcategory', function () {
		$.get(innerpageUrl + '/journalSetCategory',{ bid:$(this).closest('.js-liid').closest('li').data('id')}, function (response) {
			var index = layer.open({
				title: '修改日志分类',
				type: 1,
				area: ['500px', '120px'],
				shadeClose: true, 
				content : response
			});

		});
	});


	// 管理日志
	$('#journal-manage-category').on('click', function () {
		$.get(innerpageUrl + '/journalManageCategory',{ bid:$(this).closest('.js-liid').closest('li').data('id')}, function (response) {
			var index = layer.open({
				title: '管理日志分类',
				type: 1,
				area: ['600px', '320px'],
				shadeClose: true, 
				content : response
			});

		});
	});

	

});