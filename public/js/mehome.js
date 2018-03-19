var jcrop = '';
var C_Image_rant = '';
var subnavAjaxUrl = '';
var currentLi = '';
var target = '';
$(function() {

	// 初始化数据等待使用
	subnavAjaxUrl = $('#ajax-subnav-list').data('url');
	currentLi = $('#ajax-subnav-list').find('li:nth-child(1)');
	target = currentLi.find('a').data('target');
	var scripts = [], csss = []; // 存储动态载入的js和css文件,便于清除节点


	// 初始化后加载的页面
	dealPage();


	// 设置监听器
	$('#ajax-subnav-list').on('click', 'li>a', function() {

		// target获取和样式变换
		currentLi.removeClass('active');
		target = $(this).data('target');
		currentLi = $(this).closest('li');
		currentLi.addClass('active');

		//clearJSCSS();

		// 获取页面
		dealPage();
		
	});


 	// 处理动态载入的页面和参数
	function dealPage() {
		
		
		/*$.get(subnavAjaxUrl + '/' + 'param_' + target, function(response) {
			dealAjaxParamResponse(response);
		});*/

		$.get(subnavAjaxUrl + '/' + target, function(response) {
			
			$('#content-con').html(response);
			if (target=='envelope'){
				envelopePageJs();
				return false;
			}
			if (target=='transferRecord') {
				transferRecordPageJs();
				return false;
			}
		});

		
	}


	// 清空动态载入的Javascript和Css文件
	function clearJSCSS() {
		var tempNode = null;
		for (var counter = 0; counter < scripts.length; counter++ ) {
			tempNode = scripts.pop();
			tempNode.remove();
		}

		for (var counter = 0; counter < csss.length; counter++ ) {
			tempNode = csss.pop();
			tempNode.remove();
		}
	}

	// 处理Ajax页面参数请求得到的响应数据
	function dealAjaxParamResponse(response) {
		if (response != null) {
			if (response._csss) 
				addCsss(response._csss);
			
			if (response._scripts) 
				addScripts(response._scripts);
		}
	}
	
	// 动态添加js文件
	function addScripts(_scripts) {
		for (var counter = 0; counter < _scripts.length; counter++ ) {
			var scriptNode = document.createElement('script');
			scriptNode.src = _scripts[counter];
			// scriptNode.src = 'proxy.js?t='+new Date().getTime();/*附带时间参数，防止缓存*/
			document.body.appendChild(scriptNode);
			scripts.push(scriptNode);
		}
		
	}

	// 动态添加css文件
	function addCsss(_csss) {
		for (var counter = 0; counter < _csss.length; counter++ ) {
			var cssNode = document.createElement('link');
			cssNode.rel = 'stylesheet';
			cssNode.type = 'text/css';
			// cssNode.media = 'screen';
			cssNode.href = _csss[counter];
			// cssNode.href = 'style.css?t='+new Date().getTime();/*附带时间参数，防止缓存*/
			document.head.appendChild(cssNode);
			csss.push(cssNode);
		}
	}

	//envelope分页JS
	function envelopePageJs(){
		$('.pagination a').on('click', function(){
			if ($(this).closest('li').attr('class')=='active'){
				return false;
			}
			var pageNum = $(this).data('ci-pagination-page');
			var per_page = $('#tx-per-page').val();
			var page = (pageNum-1)*per_page;
			$.get(subnavAjaxUrl + '/' + target + '/page/'+page, function(response) {
				$('#content-con').html(response);
				envelopePageJs();
			});
		})
	}

	//transferRecord分页 账单查询系列事件绑定
	function transferRecordPageJs(){
		$('.pagination-con a').on('click', function(){
			if ($(this).closest('li').attr('class')=='active'){
				return false;
			}
			var pageNum = $(this).data('ci-pagination-page');
			var per_page = $('#tsr-per-page').val();
			var page = (pageNum-1)*per_page;
			var searchKey = {
				startDate : $('#startDate').val(),
				endDate : $('#endDate').val()
			}
			$.get(subnavAjaxUrl + '/' + target + '/page/'+page, searchKey, function(response) {
				$('#content-con').html(response);
				transferRecordPageJs();
			});
		})
		/** 账单分页条件查询事件绑定 */
		$('#tsf-search-btn').on('click', function(){
			var searchKey = {
				startDate : $('#startDate').val(),
				endDate : $('#endDate').val()
			}
			var page = 0;
			$.get(subnavAjaxUrl + '/' + target + '/page/'+page, searchKey, function(response) {
				$('#content-con').html(response);
				transferRecordPageJs();
			});
		})
	}

	// 修改头衔
	//定义裁剪对象
	$('#change-headimg').on('click', function () {
		$.get($('#urls').data('innerpage') + '/alterHeadimg', function (response) {
			var index = layer.open({
				title: '修头像',
				type: 1,
				area: '600px',
				shadeClose: true, //点击遮罩关闭
				// content: '\<\div style="padding:20px;">自定义内容\<\/div>'
				content : response,
				btn:['确认','返回'],
				yes:function(){
					console.log(jcrop.tellSelect());
					var sf = jcrop.getScaleFactor();
					//console.log(sf)
					var img = jcrop.tellSelect();
					var param = {};
					param.x = img.x*C_Image_rant;
					param.w = img.w*C_Image_rant;
					param.y = img.y*C_Image_rant;
					param.h = img.h*C_Image_rant;
					param.sfb = C_Image_rant;
					param.source = $('#source').val();
					param.value = $('#value').val();
					param.file_name = $('#file_name').val();
					$.post($('#urls').data('baseurl') + '/cropIcon', param, function(response){
						if (response.status==1){
							layer.msg('修改头像成功',{
								icon:1,
								time:1000
							},function(){
								location.reload();
							});
						}else{
							layer.msg('修改失败',{
								icon:4
							});
						}
					})
				}
			});

		});
	});

	// 打开修改基本信息
	$('#alter-meinfo-btn').on('click', function () {

		$.get($('#urls').data('innerpage') + '/alterBasicInfo', function (response) {
			var index = layer.open({
				title: '修改基本信息',
				type: 1,
				area: ['600px', '360px'],
				shadeClose: true, //点击遮罩关闭
				// content: '\<\div style="padding:20px;">自定义内容\<\/div>'
				content : response
			});

		});
	});


});