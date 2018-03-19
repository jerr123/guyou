$(function () {

	var baseUrl = $('#urls').data('baseurl');
	var baseurl = baseUrl;
	var input = '';
	var searchPage = 1;


	// 根据账号或昵称搜索
	$('#search-btn').on('click', function () {
		input = $('#search-input').val();

		searchPage = 1;
		search();
	});

	function search() {	 // 搜索数据执行函数
		$.post(baseUrl + '/searchFriend/' + searchPage, {"param" : input}, function (response) {
			// 这个数据会填充到我们的搜索显示框中

			//response.status = 1;
			/*if (response.status < 1) {
				sweetAlert("Oops...", "数据通信出现一定错误", "error");
				return false;
			}*/

			var content = '';
			if (!response.data) {
				layer.msg("搜索不到相关的人");
				return false;
			}

			for (var i = 0; i < response.data.length; i++) {
				content += '<li data-id="' + response.data[i].user_id + '"><span class="head-img"><img src="' + response.data[i].user_icon + '"></span><span class="info">' +
					'<p>' + response.data[i].user_nick + '</p>' +
					'<p>' + response.data[i].user_mobile + '</p>' +
					'<p>' + response.data[i].user_address + '</p>' +
					'</span><span class="manipulate"><button type="button" class="add-friend-btn"><i class="fa fa-plus"></i> 加好友</button></span></li>';
			}

			$('#search-result-list').html(content);
			$('#result-box').show();
		});
	}

	$('#search-page-prev').on('click', function () {  // 搜索上一页
		if (searchPage <= 1) {
			layer.tips('不能再往前了!', this);
			return false;
		}

		searchPage--;
		search();
	});

	$('#search-page-next').on('click', function () { // 搜索下一页
		searchPage++;
		search();
	});

	$('#search-result-list').on('click', '.add-friend-btn', function () {  // 点击添加好友
		$.post(baseurl + '/friendApply', {
			"to_user_id" : $(this).closest('li').data('id')
		}, function(response) {
			// $(this).attr('disabled', 'disabled');
			if (response.status == 1) {
				sweetAlert("申请添加成功", "申请添加好友信息已发送", "success");
			} else {
				sweetAlert("出现错误", response.errmsg, "error");
				return false;
			}

		});
	});
	
	$('#hide-result').on('click', function () { // 隐藏搜索内容
		$('#result-box').hide();
	});



	// 我的好友打招呼
	$('#my-friends').on('click', '.friend-btn',function() {
		var uid = $(this).closest('li').data('uid');

		layer.tips('你向该用户打了一个招呼!', this);
		/*$.post(baseurl + '/sayHello', {}, function () {

		});
*/
	});


	// 申请加好友
	$('#may-friends').on('click', '.friend-btn',function () {
		var that = this;
		$.get(baseUrl + '/friendApply', {
			"to_user_id" : $(this).closest('li').data('uid')
		}, function (response) {
			if (response.status) {
				layer.tips('已发送过好友请求!', that);
			} else {
				layer.tips('已发送好友请求!', that);
			}
		});

		
	});


	// 可能认识的人数据更新
	var myFriendsPage = 1;
	$('.may-friends-con #may-prev').on('click', function () {
		refreshMayFriends(-1);
	});

	$('.may-friends-con #may-next').on('click', function () {
		refreshMayFriends(1);
	});

	function refreshMayFriends(direction) {
		if (direction > 0) {
			myFriendsPage++;
		} else {
			if (myFriendsPage <= 1) {
				layer.tips('不能在往前了!', '#may-next');
				return false;
			}
		}

		$.post(baseUrl + '/mayFriends', {
			"maypage" : myFriendsPage
		}, function (response) {
			if (response.status == 2 && direction > 0) // 企图加载更多没有的数据的时候的返回代码2
				layer.tips('没有更多数据!', '#may-next');

			if (response.status == 1) // 其他错误问题出现的返回代码1
				layer.tips(response.errmsg, '#may-next');

		});

	}



});

