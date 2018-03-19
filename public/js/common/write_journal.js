$(function () {

	var baseUrl = $('#urls').data('baseurl'),
		innerpageUrl = $('#urls').data('innerpage'),
		blogUrl = $('#urls').data('blogurl');

	// 配置编辑器
	var ue = UE.getEditor('write-panel-con');

    $('#public-journal').on('click', function () {
        
        var id = $(this).data('id');
   		//对编辑器的操作最好在编辑器ready之后再做
        ue.ready(function() {
            
            //获取html内容，返回: <p>hello</p>
            var html = ue.getContent();


            $.post(blogUrl + '/addBlog', {
                "blog_id" : id,
            	"blog_content" : html,
            	'blog_title' : $('#journal-title').val(),
            	"blog_type_id" : $('#category').val(),
            	"blog_rank" : $('#auth').val()
            }, function (response) {
            	if (response.status != 1 ) {
            		/*swal("Error", response.errmsg, 'error');*/
                    layer.msg("Error: " + response.errmsg);
            		return false;
            	}

                layer.msg("成功发表日志");
            	/*swal("Success", '成功发表日志', 'success');*/
            });
        });
    });


	$('#journal-manage-category').on('click', function () {
		$.get(innerpageUrl + '/journalManageCategory', function (response) {
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