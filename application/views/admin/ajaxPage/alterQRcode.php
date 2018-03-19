<style type="text/css">
	.alt-body {
		margin:0px 60px 20px 60px;
	}
	.top {
		margin:auto;
		margin-bottom: 10px;
	}
	#view{
		width: 180px;
		height: 180px;
		/*background-color: red;*/
	}
	#view img {
		width: 175px;
		height: 175px;
	}
	.buttom{
		margin:10px 20px 0px 20px;
	}

</style>
<div class="alt-body">
	<div class="top">
		<div id="uploader">
			<div id="fileList" class="uploader-list"></div>
			<div id="filePicker">选择支付宝二维码</div>
		</div>
	</div>
	
	<div id="view">
		<img id="qrv" src="<?php echo $img ?>" alt="支付宝转账二维码">
	</div>
	<input type="hidden" id="value" value="<?php echo $img ?>">
	<div class="buttom">
		<button id="submitAlter" class="btn btn-primary btn-sm">提交</button>
	</div>
</div>

<script type="text/javascript">
	// 初始化Web Uploader
        var uploader = WebUploader.create({
            auto: true,
            //swf: BASE_URL + '/js/Uploader.swf',
            server: '<?php echo site_url('admin/Home/uploadAlipayQRCode').'?config_id='.$config_id;?>',
            pick: '#filePicker',
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            }
        });

        uploader.on( 'uploadProgress', function( file, percentage ) {
            var $li = $( '#'+file.id ),
            $percent = $li.find('.progress span');

            // 避免重复创建
            if ( !$percent.length ) {
                $percent = $('<p class="progress"><span></span></p>')
                .appendTo( $li )
                .find('span');
            }

            $percent.css( 'width', percentage * 100 + '%' );
        });

        // 文件上传成功，给item添加成功class, 用样式标记上传成功。
        uploader.on( 'uploadSuccess', function( file , rs) {
            $( '#'+file.id ).addClass('upload-state-done');
            if (rs.status==1){
            	var img = '<img src="'+rs.data.path+'?'+Math.random()+'" alt="支付宝转账二维码">'
                $('#value').val(rs.data.path);
                $('#view').html(img);
            }else{
                var notice = '<span style="color:red;">'+rs.info+'</span>';
                $('#view').html(notice);
            }
        });

        // 文件上传失败，显示上传出错。
        uploader.on( 'uploadError', function( file ) {
            var $li = $( '#'+file.id ),
            $error = $li.find('div.error');

            // 避免重复创建
            if ( !$error.length ) {
                $error = $('<div class="error"></div>').appendTo( $li );
            }

            $error.text('上传失败');
        });

        // 完成上传完了，成功或者失败，先删除进度条。
        uploader.on( 'uploadComplete', function( file ) {
            $( '#'+file.id ).find('.progress').remove();
        });

        $('#submitAlter').on('click', function(){
        	var param = {
        		id:"<?php echo $config_id?>",
        		value:$('#value').val()
        	}
        	$.post("<?php echo site_url('admin/Home/alterConfig') ?>", param, function(data){
        		var rs = JSON.parse(data);
        		if (rs.status==1){
        			layer.open({
        				title:'修改提示',
        				content:'修改成功！',
        				yes:function(){
        					location.reload();
        				}
        			})
        		}
        	})
        })
</script>