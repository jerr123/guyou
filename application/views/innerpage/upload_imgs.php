<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/admin/plugins/webUploader/css/webuploader.css') ?>">
<script type="text/javascript" src="<?php echo base_url('public/admin/plugins/webUploader/js/webuploader.js'); ?>"></script>

<style type="text/css">
.uploader-list {
	overflow: hidden;
}
.uploader-list .file-item {
	background-color: #fff;
	display: blcok;
	float: left;
	margin: 10px;
}

.uploader-list .file-item img {
	margin: auto;
}

.uploader-list .file-item .info {
	border-bottom: 3px solid rgba(51,159,242,1);
	padding-bottom: 8px;
	width: 100px;
	word-wrap: normal;
	white-space: nowrap;
	text-overflow: ellipsis;
	overflow: hidden;
}

#filePicker {
	display: block;
	margin: 10px;
}

.btns-con {
	overflow: hidden;
	width: 100%;
}

.btn-upload {
	margin: 10px 10px 10px 0;
	border-radius: 3px;
	padding: 5px 10px;
	background-color: #fff;
	border: 1px solid rgba(118,204,53, 1);
	color: rgba(118,204,53, 1);
	outline: none;
	cursor: pointer;
}

.btn-upload:hover {
	background-color: rgba(118,204,53, 1);
	color: #fff;
}


/* -------------  */

.uploader-list {
    width: 100%;
    overflow: hidden;
    border-top: 1px dashed #eee;
}
.file-item {
    float: left;
    position: relative;
    margin: 0 20px 20px 0;
    padding: 4px;
}
.file-item .error {
    position: absolute;
    top: 4px;
    left: 4px;
    right: 4px;
    background: rgba(242,29,29,1);
    color: #fff;
    text-align: center;
    height: 20px;
    font-size: 14px;
    line-height: 23px;
}
.file-item .info {
    position: absolute;
    left: 4px;
    bottom: 4px;
    right: 4px;
    height: 20px;
    line-height: 20px;
    text-indent: 5px;
    background: rgba(0, 0, 0, 0.6);
    color: #fff;
    overflow: hidden;
    white-space: nowrap;
    text-overflow : ellipsis;
    font-size: 12px;
    z-index: 10;
}
.upload-state-done:after {
    content:"\f00c";
    font-family: FontAwesome;
    font-style: normal;
    font-weight: normal;
    line-height: 1;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    font-size: 32px;
    position: absolute;
    bottom: 0;
    right: 4px;
    color: #4cae4c;
    z-index: 99;
}
.file-item .progress {
    position: absolute;
    right: 4px;
    bottom: 4px;
    height: 3px;
    left: 4px;
    height: 4px;
    overflow: hidden;
    z-index: 15;
    margin:0;
    padding: 0;
    border-radius: 0;
    background: transparent;
}
.file-item .progress span {
    display: block;
    overflow: hidden;
    width: 0;
    height: 100%;
    background: #d14 url(../images/progress.png) repeat-x;
    -webit-transition: width 200ms linear;
    -moz-transition: width 200ms linear;
    -o-transition: width 200ms linear;
    -ms-transition: width 200ms linear;
    transition: width 200ms linear;
    -webkit-animation: progressmove 2s linear infinite;
    -moz-animation: progressmove 2s linear infinite;
    -o-animation: progressmove 2s linear infinite;
    -ms-animation: progressmove 2s linear infinite;
    animation: progressmove 2s linear infinite;
    -webkit-transform: translateZ(0);
}
@-webkit-keyframes progressmove {
    0% {
        background-position: 0 0;
    }
    100% {
        background-position: 17px 0;
    }
}
@-moz-keyframes progressmove {
    0% {
        background-position: 0 0;
    }
    100% {
        background-position: 17px 0;
    }
}
@keyframes progressmove {
    0% {
        background-position: 0 0;
    }
    100% {
        background-position: 17px 0;
    }
}

a.travis {
  position: relative;
  top: -4px;
  right: 15px;
}

#select-album {
    outline: none;
	margin: 10px;
	border: 1px solid rgba(51,159,242,1);
	background-color: #fff;
	padding: 5px 10px;
	color: rgba(51,159,242,1);
}

</style>

<div class="container">
	<div id="img-uploader">
	    <div class="btns-con">
	    	<select id="select-album" style="float: left">
                <!-- <option value="">请选择相册</option> -->
            <?php foreach ($album as $k => $v): ?>
                <option value="<?php echo $v['album_id']?>" <?php if (isset($choseAlbum) ){ if ($choseAlbum==$v['album_id']) echo 'selected="true"'; }?>><?php echo $v['album_name'] ?></option>
            <?php endforeach ?>
	    	</select>
	    	<a id="filePicker" style="float: left;">选择图片</a>
			<button id="ctlBtn" class="btn btn-upload" style="float: left;">开始上传</button>
	    </div>

	    <!--用来存放item-->
	    <div id="fileList" class="uploader-list">

	    </div>
	</div>
</div>


<script type="text/javascript">
var $ = jQuery,
 	$btn = $('#ctlBtn'),
	$list = $('#fileList'),
	state = 'pending';
    //console.log($('#select-album option:selected').val());

var uploader = WebUploader.create({

    // swf文件路径
    swf: '<?php echo base_url('public/admin/plugins/webUploader') ?>/js/Uploader.swf',

    // 文件接收服务端。
    // server: 'http://webuploader.duapp.com/server/fileupload.php',
    server : '<?php echo site_url('Ajax/uploadPhoto'); ?>',

    // 选择文件的按钮。可选。
    // 内部根据当前运行是创建，可能是input元素，也可能是flash.
    pick: '#filePicker',

    // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
    
    accept: {
        title: 'Images',
        extensions: 'gif,jpg,jpeg,bmp,png',
        mimeTypes: 'image/*'
    }
});

uploader.on( 'uploadBeforeSend', function( block, data){
    data.album_id = $('#select-album option:selected').val();
})

uploader.on( 'fileQueued', function( file ) {
	
    var $li = $(
            '<div id="' + file.id + '" class="file-item thumbnail">' +
                '<img>' +
                '<div class="info">' + file.name + '</div>' +
            '</div>'
            ),
        $img = $li.find('img');


    // $list为容器jQuery实例
    $list.append( $li );

    // 创建缩略图
    // 如果为非图片文件，可以不用调用此方法。
    // thumbnailWidth x thumbnailHeight 为 100 x 100
    uploader.makeThumb( file, function( error, src ) {
        if ( error ) {
            $img.replaceWith('<span>不能预览</span>');
            return;
        }

        $img.attr( 'src', src );
        
    }, 100, 100 );
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
uploader.on( 'uploadSuccess', function( file ) {
    $( '#'+file.id ).addClass('upload-state-done');
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

uploader.on( 'all', function( type ) {
    if ( type === 'startUpload' ) {
        state = 'uploading';
    } else if ( type === 'stopUpload' ) {
        state = 'paused';
    } else if ( type === 'uploadFinished' ) {
        state = 'done';
    }

    if ( state === 'uploading' ) {
        $btn.text('暂停上传');
    } else {
        $btn.text('开始上传');
    }
});

$btn.on( 'click', function() {
    if ( state === 'uploading' ) {
        uploader.stop();
    } else {
        uploader.upload();
    }
});


</script>