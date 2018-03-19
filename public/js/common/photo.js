$(function () {

	var innerpageUrl = $('#urls').data('innerpage'),
		baseUrl = $('#urls').data('baseurl');

	// 上传图片
	$("#upload-imgs-btn").on('click', function () {
		$.get(innerpageUrl + '/uploadImgs', function (response) {
			var index = layer.open({
				title: '上传图片',
				type: 1,
				area: ['660px', '400px'],
				shadeClose: true, 
				content : response
			});

		});
	});

 	// 创建相册
	$('#create-album-btn').on('click', function () {
		$.get(innerpageUrl + '/createAlbum', function (response) {
			var index = layer.open({
				title: '创建相册',
				type: 1,
				area: ['600px', '380px'],
				shadeClose: true, 
				content : response
			});

		});
	});


	// 修改相册内容
	$('#albums-lists').on('click', '.alter-album', function () {
		var albumId = 1;
		$.get(innerpageUrl + '/alterAlbum/' + albumId, function (response) {
			var index = layer.open({
				title: '修改相册内容',
				type: 1,
				area: ['600px', '380px'],
				shadeClose: true, 
				content : response
			});

		});
	});


	// 删除相册
	$('#albums-lists').on('click', '.delete-album', function () {
		var albumId = 1;

		swal({
			title: "是否确认删除?",
			text: "删除相册后不可恢复，是否确认删除",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			cancelButtonText: "否",
			confirmButtonText: "确认删除",
			closeOnConfirm: false
		}, function(){

			$.post(baseUrl + '/delAlbum', {
				"album_id" : albumId
			}, function (response) {
				if (response.status != 1) {
					swal("Error", response.errmsg, 'error');
					return false;
				}

				swal("已删除!", "这本相册已成功删除!", "success");
				
			});
			
		});
		
	});

});