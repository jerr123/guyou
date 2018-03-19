<div class="container" style="margin-top: 20px">
	<div class="container-center1100px journal-container">
		<div class="left-panel">
			<div class="top">
                <span><a id="btn-write-journal" class="btn write-btn" href="<?php echo site_url('Common/writeJournal'); ?>"><i class="fa fa-edit"></i> 写日志</a></span>
				<span class="other-edit">
					<!-- <span id="btn-trash"><i class="fa fa-trash-o"></i> 回收站</span> -->
					<!-- <span id="btn-setting"><i class="fa fa-pencil-square-o"></i> 设置</span> -->
					<!-- <span id="btn-muti"><a href="javascript:void(0)">批量处理</a></span> -->
				</span>
			</div>
			<ul id="journals-list" class="journal-list">
			<?php foreach ($data as $k => $v): ?>
				<li class="js-liid" data-id="<?php echo $v['blog_id'] ?>">
					<span><a class="journal" data-id="<?php echo $v['blog_id'] ?>" href="<?php echo site_url('Common/viewJournal').'/?blog_id='.$v['blog_id']?>"><?php echo $v['blog_title']?></a></span>
					<span class="o_edit"><i class="fa fa-chevron-down"></i>
						<ul class="o_panel">
							<li><a href="">删除日志</a></li>
							<li><a href="">设置权限</a></li>
							<li><a href="">修改分类</a></li>
						</ul>
					</span>
					<span><a class="edit" href="<?php echo site_url('Common/writeJournal').'?blog_id='.$v['blog_id'] ?>">编辑</a></span>
					<span class="date"><?php echo $v['blog_addtime']?></span>
				</li>
			<?php endforeach ?>
				
			</ul>

			<div class="pagination">
				<ul>
					<!--<li><a href="">上一页</a></li>
					<li><a class="active" href="">1</a></li>
					<li><a href="">2</a></li>
					<li><a href="">下一页</a></li>-->
					<?php echo $page ?>
					<li>转到 <input class="page-input" type="text" name="" value="1"> 页 <span><button type="button" class="btn btn-confirm-page">确定</button></span></li>
					
				</ul>
			</div>
		</div>

		<div class="right-panel">
			<div class="panel-box">
				<div class="title">
					日志分类
					<span><a id="journal-manage-category" href="javascript:void(0)">管理</a></span>
				</div>
				<ul class="journal-classify">
					<li><a href="">全部日志 <span>(<?php echo $blogCount ?>)</span></a></li>
					<?php foreach ($blog_type as $k => $v): ?>
						<li><a href=""><?php echo $v['blog_type_name'] ?> <span>(<?php echo $v['num'] ?>)</span></a></li>
					<?php endforeach ?>
					
				</ul>

			</div>
			<div class="panel-box">
			<form action="<?php site_url('Common/journal')?>" method="post">
				<div class="title">
					搜索日志
				</div>
				<div class="search-journal-input">
					<input type="text" name="searchKey" value="<?php echo $searchKey?>" placeholder="你想要找什么">
					<input id="sbtn" hidden="hidden" type="submit">
					<i id="searchBtn" class="fa fa-search"></i>
				</div>
			</form>
			</div>
		</div>

		<div class="clearfix"> </div>
	</div>
</div>

<span id="urls" data-baseurl="<?php echo site_url('Ajax') ?>" data-innerpage="<?php echo site_url('Innerpage'); ?>" hidden="hidden"></span>
<script type="text/javascript">
	$(function(){
		$("#searchBtn").on('click', function(){
			$('#sbtn').click();
		})
	})
</script>