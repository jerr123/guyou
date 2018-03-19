<style type="text/css">
    .alt-body {
        /*text-align: center;*/
        margin:0;
        padding: 0;
    }
    .alt-body .top {
        margin:10px 10px;
    }
    .alt-body .content {
        text-align: center;
        margin: 5px 10px;
        width: 450px;
        height: 450px;
        border: 1px solid red;
        background: rgba(0,0,0,0.2);
        overflow: hidden;
    }
    .alt-body .content img {
        /*width: 100%;*/
    }
    .alt-body .bottom {
        margin: 26px 0;
        text-align: center;
    }
    .alt-body .bottom a {
        opacity: 0.7;
        padding: 0px 8px;
        color: #00bb9c;
        border: 1px solid #00bb9c;
        background: #fff;
        border-radius: 5px;
    }

    .alt-body .bottom a:hover {
        color: #fff;
        border: 1px solid #00bb9c;
        background: #00bb9c;
    }
    .alt-body .bottom a i {
        padding: 0;
        font-size: 12px;
    }

</style>
<input type="hidden" id="value" value="<?php echo $user_icon?>">
<input type="hidden" id="source" value="">
<input type="hidden" id="file_name" value="">
<div class="alt-body">
	<div class="top">
		<div id="uploader">
			<div id="fileList" class="uploader-list"></div>
			<div id="filePicker">选择图片</div>
		</div>
	</div>
    <div class="content" >
        <img id="cj" src="<?php echo $user_icon?>" alt="">
    </div>
<!--    <div class="bottom">
        <a id="idSmall" href="javascript:void(0)"><i class="fa fa-minus"></i></a>
        <a id="idBig" href="javascript:void(0)"><i class="fa fa-plus"></i></a>
        </div>
-->
</div>
<link rel="stylesheet" href="<?php echo base_url('public/lib/Jcrop/jquery.Jcrop.css')?>">
<link rel="stylesheet" href="<?php echo base_url('public/admin/plugins/webUploader/css/webuploader.css')?>">
<script type="text/javascript" src="<?php echo base_url('public/admin/plugins/webUploader/js/webuploader.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('public/lib/Jcrop/jquery.Jcrop.js') ?>"></script>
<script type="text/javascript">
$(function(){
   

	// 初始化Web Uploader
        var uploader = WebUploader.create({
            auto: true,
            //swf: BASE_URL + '/js/Uploader.swf',
            server: '<?php echo site_url('Ajax/uploadIcon').'?user_id='.$user_id;?>',
            pick: '#filePicker',
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            }
        });

        // 文件上传成功，给item添加成功class, 用样式标记上传成功。
        uploader.on( 'uploadSuccess', function( file , rs) {
            if (jcrop!=''){
                jcrop.destroy();
            }
            $( '#'+file.id ).addClass('upload-state-done');
            if (rs.status==1){
                var img = '<img id="cj" src="'+rs.data.path+'" >';
                $('.content').html(img);
                $('#value').val(rs.data.path);
                $('#source').val(rs.data.source);
                $('#file_name').val(rs.data.file_name);
                $('#cj').attr("src",rs.data.path);
                var imgrant = rs.data.w/rs.data.h;
                var imgw = '';imgh = 'auto';
                if (rs.data.w>=rs.data.h){
                    imgw = 450;
                    imgh = 450/imgrant;
                    //imgh = (rs.data.h*450)/rs.data.w;
                    $('#cj').attr("width",450);
                }else{
                    imgh = 450;
                    imgw = 450*imgrant;
                    $('#cj').attr("width",imgw)
                }
                C_Image_rant = rs.data.w/imgw;
                console.log(imgw+'|'+imgh);
                $('#cj').Jcrop({
                    boxWidth:imgw,
                    boxHeight:imgh,
                    bgOpacity:0.6,
                    //maxSize:[170,170],
                    handleSize:2,
                    aspectRatio:1,
                    handleOffset:10
                },function(){
                    jcrop = this;
                });
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
});
</script>