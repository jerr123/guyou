$(function () {

    var innerpageUrl = $('#urls').data('innerpage'),
        baseUrl = $('#urls').data('baseurl');

    // 上传图片
    $("#upload-imgs-btn").on('click', function () {
        $.get(innerpageUrl + '/uploadImgs?id=' + $(this).data('id'), function (response) {
            var index = layer.open({
                title: '上传图片',
                type: 1,
                area: ['660px', '400px'],
                shadeClose: true, 
                content : response
            });

        });
    });

    // [img-menu]弹出菜单
    $('#imgs-list').on('click', '.fa-navicon',function () {
        $(this).closest('.img-menu').children('ul').toggle();
    });


    // [img-menu]删除照片
    $('#imgs-list').on('click', '.js-delpic', function () {
        var imgId = $(this).closest('.img-menu').siblings('.img-title').data('imgid');

        swal({
            title: "确认删除该照片么?",  
            text: "你将用删除此照片，该操作不可回退",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "删除", 
            cancelButtonText: "取消",
            closeOnConfirm: false 
        }, function() {   
           $.post(baseUrl + '/delPhoto', {
                "photo_id" : imgId 
            }, function (response) {
                if (response.status != 1) {
                    swal("Error", response.errmsg, 'error');
                    return false;
                }

                layer.msg("删除照片成功",{
                    icon : 1,
                    time : 1000
                },function(){
                    location.reload();
                });
            });
        });

    });

    // [img-menu]设为封面
    $('#imgs-list').on('click', '.js-set-cover', function () {
        var imgId = $(this).closest('.img-menu').siblings('.img-title').data('imgid');


        swal({
            title: "确认设为封面么?",  
            text: "你将用此照片作为相册封面",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "确认",
            cancelButtonText: "取消",   
            closeOnConfirm: false 
        }, function() {   
           $.post(baseUrl + '/setAlbumCover', {
                "aid" : 1,
                "img_id" : imgId 
            }, function (response) {
                if (response.status != 1) {
                    swal("Error", response.errmsg, 'error');
                    return false;
                }

                layer.msg("设置相册封面成功",{
                    icon : 1,
                    time : 1000
                }, function(){
                    location.reload();
                });
            });
        });

    });


    // [img-menu]修改名称
    $('#imgs-list').on('click', '.js-alter-name', function () {
        var titleCon = $(this).closest('.img-menu').siblings('.img-title');
        var content = '<input type="text" name="" value="' + titleCon.data('name') + '" />' + 
                        '<div class="mani-panel">' + 
                           ' <a href="javascript:void(0)" class="js-save" ><i class="fa fa-edit"></i></a>' + 
                           ' <a href="javascript:void(0)" class="js-cancel" ><i class="fa fa-history"></i></a>' + 
                        '</div>';
        
        titleCon.html(content);
        titleCon.find('input').focus();
    });

    // 确认修改名称
    $('#imgs-list').on('click', '.img-title .js-save', function () {
        var imgTitleElem = $(this).closest('.img-title');

        var name = imgTitleElem.find('input').val();
        var id = imgTitleElem.data('imgid');

        $.post(baseUrl + '/alterImgName', {
            "img_name" : name,
            "img_id" : id
        }, function (response) {
            if (response.status != 1) {
                swal("Error", response.errmsg, 'error');
                return false;
            }

            layer.msg("名称已修改");
            imgTitleElem.data('name', name);
            imgTitleElem.html(name);
        });
    });

    // 取消修改
    $('#imgs-list').on('click', '.img-title .js-cancel', function () {
        var imgTitleElem = $(this).closest('.img-title');
        imgTitleElem.html(imgTitleElem.data('name'));
        
    });

});