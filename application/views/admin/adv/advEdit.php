        <!-- /. NAV SIDE  -->
<div id="page-wrapper" >
    <div id="page-inner">
		<div class="row">
            <div class="col-md-12">
                <h3 class="page-header">
                    &nbsp;广告编辑 <small></small>
                </h3>
            </div>
        </div> 
                 <!-- /. ROW  -->
               
    <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <!-- <div class="form-inline"> -->
                                
                                    
                                <!-- </div> -->
                                <table class="table table-bordered table-hover table-input">
                                    
                                    <tbody>
                                        <tr>
                                            <th>广告位ID：</th>
                                            <td> <span><?php echo $data['adv_id']; ?></span></td>
                                            <td width="220px">
                                                <div id="uploader-adv">
                                                    <div id="fileList" class="uploader-list"></div>
                                                    <div id="filePicker">选择广告图片</div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>广告位名字：</th>
                                            <td> <span><?php echo $data['advp_name']; ?></span></td>
                                            <td rowspan="7" id="adv-view">预览</td>
                                        </tr>
                                        <tr>
                                            <th>广告位描述：</th>
                                            <td> <span><?php echo $data['advp_des']; ?></span></td>
                                            <!-- <td></td> -->
                                        </tr>

                                        <tr>
                                            <th>广告主：</th>
                                            <td> 
                                                <!-- <span> -->
                                                <div class="form-group col-sm-9">
                                                     <input type="text" id="advertiser_name" class="form-control input-sm" value="<?php echo $data['advertiser_name']; ?>">
                                                </div>
                                                   
                                                <!-- <span> -->
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>广告主手机：</th>
                                            <td>
                                                <div class="form-group col-sm-8">
                                                     <input type="text" id="advertiser_mobile" class="form-control input-sm" value="<?php echo $data['advertiser_mobile']; ?>">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>投放开始时间：</th>
                                            <td>
                                                <div class="form-group col-sm-6">
                                                     <input type="text" id="adv_start" class="form-control input-sm form-datetime" value="<?php echo $data['adv_start']; ?>">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>投放结束时间：</th>
                                            <td>
                                                <div class="form-group col-sm-6">
                                                     <input type="text" id="adv_end" class="form-control input-sm form-datetime" value="<?php echo $data['adv_end']; ?>">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr><input type="hidden" id="adv_img" value=" <?php echo $data['adv_img']; ?>"/>
                                            <td colspan="2"><span style="margin:0 auto;">
                                                <button type="button" id="advSubmit" class="btn btn-primary btn-sm"><i class="fa fa-paper-plane-o"></i>提交</button>
                                                <button class="btn btn-info btn-sm">返回</button></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
                <!-- /. ROW  -->
        </div>
    </div>
    <link href="<?php echo base_url('public/admin/plugins/datetimepicker/datetimepicker.css')?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('public/admin/plugins/simple-line-icons/simple-line-icons.min.css')?>" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?php echo base_url('public/admin/plugins/datetimepicker/datetimepicker.min.js')?>"></script>
    <script src="<?php echo base_url('public/admin/plugins/webUploader/js/webuploader.js');?>"></script>
    <script type="text/javascript">
        $(function(){
            <?php if($data['adv_img']!=''){
                $img = '<img style="width:'.$data['advp_width'].'px;height:'.$data['advp_height'].'px;" src="'.$data['adv_img'].'" alt="">';
                echo '$("#adv-view").html(\''.$img.'\');';
            }
            ?>
            //bootbox.alert('s');
        })
        $('.form-datetime').datetimepicker({
            language: "zh-CN",
            autoclose: true,
            format: 'yyyy-mm-dd hh:ii'
        });
        // 初始化Web Uploader
        var uploader = WebUploader.create({
            auto: true,
            //swf: BASE_URL + '/js/Uploader.swf',
            server: '<?php echo site_url('admin/Adv/uploadAdvPic').'?adv_id='.$data['adv_id'];?>',
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
                $('#adv_img').val(rs.data.path);
                var img = "<img style=\"width:<?php echo $data['advp_width']?>px;height:<?php echo $data['advp_height']?>px;\" src=\""+rs.data.path+'?'+ Math.random()+'">';
                $('#adv-view').html(img);
            }else{
                var notice = '<span style="color:red;">'+rs.info+'</span>';
                $('#adv-view').html(notice);
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

        $('#advSubmit').on('click',function(){
            var param = {
                adv_id:<?php echo $data['adv_id'] ?>,
                advertiser_name:$('#advertiser_name').val(),
                advertiser_mobile:$('#advertiser_mobile').val(),
                adv_start:$('#adv_start').val(),
                adv_end:$('#adv_end').val(),
                adv_img:$('#adv_img').val()
            };
            $.post("<?php echo site_url('admin/Adv/exeAdvEdit') ?>", param, function(data){
                var rs = JSON.parse(data);
                if (rs.status==1){
                    layer.open({
                        content: '提交成功',
                        yes: function(index, layero){
                            location.href="<?php echo site_url('admin/Adv/AdPositionList') ?>";
                        }
                    });
                }else{
                    layer.open({
                      title: '操作失败',
                      content: rs.errmsg
                  });  
                }
            })
        })

    </script>