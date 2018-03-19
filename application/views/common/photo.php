<div class="container" style="margin-top: 20px">
	<div class="container-center1100px photo-container">
		<div class="manipulate">
			<span><button id="upload-imgs-btn" type="button" class="btn upload-photo-btn"><i class="fa fa-file-image-o"></i> 上传照片</button></span>
			<span><a id="create-album-btn" class="btn btn-normal" href="javascript:void(0)">创建相册</a></span>
		</div>

		<ul id="albums-lists" class="albums-container">
		<?php foreach ($data as $k => $v): ?>
			<li>
				<div id="bun_1" class="face-img-container">
                    <a href="<?php echo site_url('common/photoview').'?album_id='.$v['album_id']?>" ><img src="<?php echo site_url('Home/getPhoto').'?photo_id='.$v['album_head'] ?>"></a>
				</div>
				<div class="album-title">
					<?php echo $v['album_name'] ?>
				</div>
				<div class="infos">
					<span><?php echo $v['photo_count']?>张</span>
					<span>
						<?php 
							if ($v['album_isshow']==1) {
								$msg = '所有人可见';
							}else if ($v['album_isshow']== 2) {
								$msg = '仅好友可见';
							}else if ($v['album_isshow']==3) {
								$msg = '仅自己可见';
							}
							echo $msg;
						?>
					</span>
					<span><i class="fa fa-pencil alter-album"></i> <i class="fa fa-trash delete-album"></i></span>
				</div>
			</li>
		<?php endforeach ?>
			
			<!--<li>
				<div class="face-img-container">
					<img src="<?php echo base_url('public/img/logo.png'); ?>">
				</div>
				<div class="album-title">
					5号故宫
				</div>
				<div class="infos">
					<span>177张</span>
					<span>自己可见</span>
					<span><i class="fa fa-pencil alter-album"></i> <i class="fa fa-trash delete-album"></i></span>
				</div>
			</li>-->
			

		</ul>
	</div>
</div>

<span id="urls" data-baseurl="<?php echo site_url('Ajax') ?>" data-innerpage="<?php echo site_url('Innerpage'); ?>" hidden="hidden"></span>




