$(function () {

	var baseUrl = $('#urls').data('baseurl');



	// 更新当前页面动态
	var dyPage = 1;

	refreshDynamics();  // 初始化数据

	$('#load-more').on('click', function () {
		dyPage++;
		refreshDynamics();
	});
	
	function refreshDynamics() {
		$.post(baseUrl + '/refreshDynamics', {
			"page" : dyPage
		}, function (response) {
			if (response.status != 1) {
				swal('Error', response.errmsg, 'error');
				return false;
			}

			var dyHtml = '';
			for (var c in response.data) {

				dyHtml += '<article data-id="' + response.data[c].id + '" class="dynamic">' + 
							'<div class="top">' +
								'<div class="head-img">' +
									'<img src="' + response.data[c].headimg + '" />' +
								'</div>' +
								'<div class="top-other">' +
									'<div class="nickname">' + response.data[c].unick + '</div>' +
									'<div class="infos">' +
										'<span class="date">' + response.data[c].trends_addtime + '</span>' +
										'<span style="margin-left: 10px;"><i class="fa fa-eye"></i>浏览(' + response.data[c].flow + ')</span>' +
								'</div>' +
								'</div>' +
							'</div>' +
							'<div class="content">' + response.data[c].trends_content + '</div>' +
							'<div class="bar">' +
								'<ul>' +
								'<li class="js-open-comment"><i class="fa fa-comment"></i> 评论</li>' +
								'<li data-zaned="0" class="js-zan"><i class="fa fa-thumbs-o-up"></i> 赞(28)</li>' +
								'</ul>' +
							'</div>' +
							'<div class="zan">' +
							'<ul>' +
								'<li class="zan-btn"><i class="fa fa-thumbs-up"></i></li>';

							// for (var i in resposne.data[c].zans) {
							// 	dyHtml += '<li><img src="' + resposne.data[c].zans[i].headimg + '"></li>'
							// }
							
					dyHtml += '</ul>' +
							'</div>' +
							'<div class="comment">' +
								'<ul class="comments-list">';

							for (var k in response.data[c].comments) {
								'<li data-topid="' + response.data[c].comments[k].topid + '">' +
									'<p><span class="nickname">' + response.data[c].comments[k].nick + ':</span> ' + response.data[c].comments[k].comment + ' <i class="fa fa-commenting btn-follow-com"></i></p>' +
									'<ul class="inner-comments-list comments-list">';

										for (var j in response.data[c].comments[k].subcom) {
											dyHtml += '<li><p><span class="nickname">' +  response.data[c].comments[k].subcom[j].nick + '</span> 回复 <span class="nickname">' +  response.data[c].comments[k].subcom[j].tonick + '</span>: ' + response.data[c].comments[k].subcom[j].comment + '</p></li>';	
										}
									'</ul>' +
								'</li>';
							}

					dyHtml += '</ul>' +
								'<div class="publish-comment">' +
									'<input class="input-normal js-publish-comment" type="text" name="" placeholder="我也评论一句">' +
									'<button id="c-sub-btn" type="button" class="btn btn-info c-sub-btn">提交</button>' +
								'</div>' +
							'</div>' +
						'</article>';

				$('#dynamics-box').append(dyHtml);
				dyHtml = '';
			}

		});
	}

	// 监听发表动态的输入框的字符数量
	$('#publisher').bind('input propertychange', function() {
		var length = $('#publisher').text().length;
		// console.log(length);
		$('#publish-num').text(length + '/140');
	    if (length > 140) {
	    	layer.msg("字符数量超出!");
	    	$('#publish-num').css('color', 'red');
	    } else {
	    	$('#publish-num').css('color', '#aaa');
	    }
	});

	// 发表动态
	$('#btn-newpublish').on('click', function () {

		var length = $('#publisher').text().length;
		if (length > 140 ) {
	    	swal('Error!', "字符数量超出!", 'error');
	    	return false;
	    } else if (length <= 0) {
	    	swal('Error!', "发表的内容不能为空", 'error');
	    	return false;
	    }

	    var atArr = new Array();
	    var counter = 0;

	    var atstring = '';
	    $('#ated-list li').each(function () {

	    	console.log($(this).data('id'));
	    	atArr[counter++] = '@{user_id:' + $(this).data('id')+',user_nick:'+$(this).data('nick')+'}+';
	    	atstring += '@{user_id:'+$(this).data('id')+',user_nick:'+$(this).data('nick')+'}+';
	    });

	    /*console.log(atArr);*/
	    /*console.log(atstring);*/


	    var content = $('#publisher').html()+atstring;

		$.post(baseUrl + '/publish_mood' , {
			"content" : content
		}, function (response) {
			if (response.status != 1) {
				swal('Error', response.errmsg, 'error');
				return false;
			}

			swal('Success', "发表成功", 'success');
		});
	});


/**
 * emoji表情
 */

	// 表情按钮
	$('#btn-emoji').on('click', function () {
		$('.js-at-panel').hide('fast');
		$('.js-photo-panel').hide('fast');
	});
	

	// emoji表情
	$("#publisher").emoji({
	  	button: "#btn-emoji",
	    showTab: false,
	    animation: 'slide',
	    icons: [{
	        name: "表情",
	        path: $('#urls').data('emojiurl') + "/dist/img/qq/",
	        maxNum: 91,
	        excludeNums: [41, 45, 54],
	        file: ".gif"
	    }]
	});

/**
 * 图片上传 [ 弃用 ]
 */

 	var innerPageUrl = $('#urls').data('innerpageurl');
	// 图片上传窗口
	$('.publish-box #btn-photo').on('click', function () {
		/*$(this).toggleClass('active');*/
		$('.js-at-panel').hide('fast');
		$('.js-photo-panel').toggle('fast');

		/*$.get(innerPageUrl + '/uploadImgs', function (response) {
			$('.photo-form').html(response);
		});*/
	});

	

/**
 * At 按钮
 */
	
	// At符号
	$('.publish-box #btn-at').on('click', function () {
		/*$(this).toggleClass('active');*/
		$('.js-photo-panel').hide('fast');
		$('.js-at-panel').toggle('fast');
	});

	// 删除某个at的人
	$('#ated-list').on('click', 'i.fa-times',function () {
		$(this).closest('li').animate({'width': '0px', 'paddingLeft' : '0px', 'paddingRight' : '0px', 'margin' : '0'}, 'fast', 'swing');
	});


	// at好友搜索
	$('#at-search-btn').on('click', function () {	// 监听搜索at好友的按钮
		var input = $('#at-search-input').val();
		$.post(baseUrl + '/searchFriend', {
			"param" : input
		}, function (response) {
			if (response.status != 1) {
				swal("错误发生", response.errmsg, "error");
				return 0;
			}

			var content = '';
			for (var counter = 0; counter < response.data.length; counter++) {
				response.data[counter]
				content += '<li data-nickname="' + response.data[counter].user_nick + '" data-id="' + response.data[counter].user_id + '">' +
								'<img src="' + response.data[counter].user_icon + '">' +
								'<div class="add-hover-con"><i class="fa fa-plus"></i></div>' +
								'<p class="nickname">' + response.data[counter].user_nick + '</p>' +
							'</li>';

				$('#at-seach-lists').html(content);
			}

		});

	});


	// 将搜索到的人员添加到at列表中去
	$('#at-seach-lists').on('click', 'li',function () {	// 点击at搜索的好友的图片进行at好友的添加
		var id = $(this).data('id');
		var nickname = $(this).data('nickname');

		$('#ated-list').append('<li data-id="' + id + '" data-nick="' + nickname + '">' + nickname + ' <i class="fa fa-times fa-fw"></i></li>');
	});


/**
 * 对已经发布的动态内容的操作
 */

	// 点赞功能
	$('#dynamics-box').on('click', '.js-zan', function () {
		var obj = $(this);
		if (obj.data('zaned') == 0) {
			$.post(baseUrl + '/like', {
				"id" : obj.closest('article.dynamic')
			}, function (response) {
				if (response.status == 1) {
					swal("Success", "感谢你的点赞", "success");
					obj.html('<i class="fa fa-thumbs-up"></i> 取消赞(28)');
					obj.data('zaned', 1);
				} else {
					swal("Error", "点赞功能通信出现问题", "error");
					return false;
				}

			});
		} else {
			$.post(baseUrl + '/unlike', {

			}, function (response) {
				if (response.status == 1) {
					swal("Success", "取消赞成功", "success");
					obj.html('<i class="fa fa-thumbs-o-up"></i> 赞(28)');
					obj.data('zaned', 0);
				} else {
					swal("Error", "点赞功能通信出现问题", "error");
					return false;
				}

			});
		}

	});



	// 点击评论按钮自动focus
	$('#dynamics-box').on('click', '.js-open-comment', function () { // 点击评论按钮的操作
		$(this).closest('article.dynamic').find('.js-publish-comment').focus();
	});


	// 对父级评论进行评论
	$('#dynamics-box').on('click', '.btn-follow-com', function () {
		var parentId = $(this).closest('li').data('id');
		$(this).closest('.comment').find('.js-publish-comment').data('parentid', parentId);
	});

	// 提交评论按钮
	$('#c-sub-btn').on('click', function () {
		$.post(baseUrl + '/comment', {
			"id" : $(this).closest('article').data('id'),
			"pcomment_id" : $(this).closest('.publish-comment').find('.js-publish-comment').data('parentid'),
			"comment" : $(this).closest('.publish-comment').find('.js-publish-comment').text()
		}, function (response) {
			if (response.status != 1) {
				swal('Error!', response.errmsg, 'error');
				return false;
			}

			swal('Success!', "评论成功", 'success');

		});
	});



/**
 * 可能认识的人
 */

	// 可能认识的人换一批
	$('#another-mf').on('click', function () {
		swal("good", "hello", 'success');
		$.post(baseUrl + '/anotherMayFriends', function (response) {
			if (response.status != 1) {
				swal("Error", response.errmsg, 'error');
				return false;
			}

			var textHtml = '';
			for (var c in response.data) {
				textHtml += '<li data-id="' + response.data[c].id + '">' +
								'<div class="img-con">' +
									'<img src="' + response.data[c].headimg + '">' +
								'</div>' +
								'<div class="nickname">Arron</div>' +
								'<button type="button" class="add-friend js-add-friend">+ 好友</button>' +
							'</li>';
			}

			$("#maybe-friends").html(textHtml);

		});

	});

	// 可能认识的人添加好友
	$('#maybe-friends').on('click', '.js-add-friend', function () {
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



/**
 * 最近访客
 */

	var visitersPage = 1;
	$('#visiters-prev').on('click', function () {
		if (visitersPage <= 1) {
			layer.tips('不能再往前了', $('#visiters-prev'));
			return false;
		} else {
			refreshVisiters();
		}
	});

	$('#visiters-next').on('click', function () {
		visitersPage++;
		refreshVisiters();
	});

	function refreshVisiters() {	// 更新访客
		$.get(baseUrl + '/refreshVisiters/' + visitersPage, function (response) {
			if (response.status == 2) {	// overflow 数据请求超出
				visitersPage--;
				layer.tips('不能再往后了', $('#visiters-next'));
				return false;
			}

			if (response.status != 1) {
				swal('Error', response.errmsg, 'error');
				return false;
			}

			var content = '';
			for (var counter = 1; counter < response.data.length; counter++) {
				content += '<li data-id="' + response.data[counter].id + '">' +
							'<div class="img-con">' +
							'	<img src="' + response.data[counter].img + '">' +
							'</div>' +
							'<div class="nickname">' + response.data[counter].nickname + '</div>' +
							'<div class="date-time">' + response.data[counter].date + '</div>' +
						'</li>';	
			}

			$('#visiters-list').html(content);
		});

	}


});