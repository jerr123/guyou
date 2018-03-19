<div class="container">
    <div class="container-center1100px photoview-con">
        <div class="head-con">
            <div class="cover-con">
                <img src="<?php echo site_url('home/getPhoto').'?photo_id='.$album['album_head'] ?>" alt="">
            </div>
            <div class="album-panel">
                <div class="album-title"><?php echo $album['album_name'] ?></div>
                <div class="album-mani">
                    <button data-id="<?php echo $album['album_id']?>" id="upload-imgs-btn" class="btn btn-normal">上传照片</button>
                    <!-- <button class="btn btn-info">批量管理</button> -->
                </div>
            </div>
            <div class="shortmsg">
                <?php echo $album['album_desc'] ?>
            </div>
        </div>
        <div class="main-con">
            <ul id="imgs-list" class="imgs-list">
            <?php foreach ($data as $k => $v): ?>
                <li>
                    <div class="img-con">
                        <img src="<?php echo site_url('Home/getPhotoThumb').'?photo_id='.$v['photo_id'] ?>">
                    </div>
                    <div class="img-menu">
                        <i class="fa fa-navicon"></i>
                        <ul>
                            <li class="js-set-cover"><i class="fa fa-thumb-tack"></i> 设为封面</li>
                            <li class="js-alter-name"><i class="fa fa-pencil"></i> 修改名称</li>
                            <li class="js-delpic"><i class="fa fa-trash"></i> 删除</li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>

                    <div class="img-title" data-imgid="<?php echo $v['photo_id']?>" data-name="<?php echo $v['photo_name']?>">
                        <?php echo $v['photo_name']?>
                    </div>
                </li>
            <?php endforeach ?>
                

                <!--<li>
                    <div class="img-con">
                        <img src="<?php echo base_url('public/img/logo.png') ?>">
                    </div>
                    <div class="img-menu">
                        <i class="fa fa-navicon"></i>
                        <ul>
                            <li class="js-set-cover"><i class="fa fa-thumb-tack"></i> 设为封面</li>
                            <li class="js-alter-name"><i class="fa fa-pencil"></i> 修改名称</li>
                            <li class="js-delpic"><i class="fa fa-trash"></i> 删除</li>
                        </ul>
                    </div>
                    <div class="img-title" data-imgid="1" data-name="这是照片名称">
                        这是照片名称
                    </div>
                </li>-->

               
            </ul>
        </div>
    </div>
</div>

<span id="urls" data-baseurl="<?php echo site_url('Ajax') ?>" data-innerpage="<?php echo site_url('Innerpage'); ?>" hidden="hidden"></span>