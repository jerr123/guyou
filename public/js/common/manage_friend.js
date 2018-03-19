$(function () {

	var innerpageUrl = $('#urls').data('innerpage'),
		baseUrl = $('#urls').data('baseurl');

	// 管理分组
	$('#btn-fgroup-manage').on('click', function () {
		$.get(innerpageUrl + '/friendGroupManage', function (response) {
			var index = layer.open({
				title: '分组管理',
				type: 1,
				area: ['600px', '360px'],
				shadeClose: true, 
				content : response
			});

		});
	});

	// 添加好友通知
	$('#btn-add-friendnoti').on('click', function () {
		$.get(innerpageUrl + '/addFriendNoti', function (response) {
			var index = layer.open({
				title: '添加好友通知',
				type: 1,
				area: ['600px', '360px'],
				shadeClose: true, 
				content : response
			});
			//加载完该页面后绑定分页事件
			//friendnotiJs();
		});
	});


	// 修改分组
	$('.put-select').on('change', function () {
		var fid = $(this).closest('li').data('fid');
		var val = $(this).children('option:selected').val();
		$.post(baseUrl + '/changeToGroup', {
			"fid" : fid,
			"group_id" : val
		}, function (response) {
			if (response.status != 1) {
				swal('Error', response.errmsg, 'error');
				return false;
			}

			swal('Success', '修改分组成功', 'success');
		});
	});


	// 打招呼
	$('#friends-con').on('click', '.js-sayhello', function () {
		var that = this;
		$.post(baseUrl + '/addHi', {
			'to_user_id' : $(this).closest('li').data('fid')
		}, function (response) {
			if (response.status != 1) {
				swal('Error', response.errmsg, 'error');
				return false;
			}

			layer.tips("你已向该用户Say Hello", that, {
				tips : 4
			});
		});
	});


	// 删除好友关系
	$('#friends-con').on('click', '.js-delete', function () {
		var that = this;
		swal({
			title: "是否确认删除好友?",
			text: "删除好友后不可恢复，是否确认删除",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			cancelButtonText: "否",
			confirmButtonText: "确认删除",
			closeOnConfirm: false
		}, function(){

			$.post(baseUrl + '/delFriend', {
				"fid" : $(that).closest('li').data('fid')
			}, function (response) {
				if (response.status != 1) {
					swal("Error", response.errmsg, 'error');
					return false;
				}

				swal("已删除!", "该用户已经不是你的好友", "success");
				$(that).closest('li').remove();
			});
			
		});
	});
	
	/** 绑定好友通知分页事件 */
	function friendnotiJs () {
		
		$('.mpagination .con a').on('click', function(){
			if ($(this).attr("class")=='acive'){
				return false;
			}
			var per_page = $('#per-page').val();
			var pageNum = $(this).data('ci-pagination-page');
			var page = (pageNum-1)*per_page;
			$.get(innerpageUrl + '/addFriendNoti/page/'+page, function (response) {
				var index = layer.open({
					title: '添加好友通知',
					type: 1,
					area: ['600px', '360px'],
					shadeClose: true, 
					content : response
				});
					//加载完该页面后绑定分页事件
				friendnotiJs();
			});
		})
	}

});