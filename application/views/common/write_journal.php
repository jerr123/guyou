<div class="container">
    <div class="container-center800px" style="">
        <div class="heading-con">
            <div class="layout-head">
                <!-- <div class="title" style="background-image: url(<?php echo base_url('public/img/writejournal/head.jpg');?>)">
                    <h1 style="font-color: #fff">写日志</h1>
                    <span class="backtolist"><a href="">返回日志列表</a></span>
                </div> -->

                <label>分类：</label>
                <select id="category" class="input-normal">
                    <option value="">选择日志分类</option>
                <?php foreach ($type as $k => $v): ?>
                    <option <?php if (isset($blog['blog_type_id']) && $blog['blog_type_id']==$v['blog_type_id']) echo 'selected="true"'?> value="<?php echo $v['blog_type_id'] ?>"><?php echo $v['blog_type_name'] ?></option>  
                <?php endforeach ?>
                      
                    <!-- <option value="">旅游日记</option>     -->
                    <!-- <option value="">日常记录</option>     -->
                </select>
                <a id="journal-manage-category" class="btn btn-normal" href="javascript:void(0)">管理分类</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <label>权限：</label>
                <select id="auth" class="input-normal">
                    <option <?php if (isset($blog['blog_rank']) && $blog['blog_rank']==1) echo 'selected="true"'?> value="1">公开</option>
                    <option <?php if (isset($blog['blog_rank']) && $blog['blog_rank']==1) echo 'selected="true"'?> value="2">所有好友可见</option>
                    <!-- <option value="3">指定好友可见</option> -->
                    <option <?php if (isset($blog['blog_rank']) && $blog['blog_rank']==1) echo 'selected="true"'?> value="3">仅自己可见</option>
                </select>

                <span class="backtolist"><a class="link-normal" href="javascript:history.back()">返回日志列表</a></span>
                
            </div>

            <div class="title-con">
                <label>标题:</label>
                <input id="journal-title" type="text" value="<?php echo isset($blog['blog_title'])?$blog['blog_title']:'' ?>" class="input-normal" placeholder="每一篇日志都应该有一个标题">
            </div>
        </div>
        <!-- <div id="write-panel-con" class="write-panel">
            开始写一篇美好的日志吧
        </div> -->

        <div class="main-con" style="overflow: hidden">
            <script id="write-panel-con" name="content" type="text/plain"><?php echo isset($blog['blog_content'])?$blog['blog_content']:'开始写日志吧' ?></script>

            <div class="layout-foot">
                <button data-id="<?php echo isset($blog['blog_id']) ? $blog['blog_id'] : ''?>" id="public-journal" type="button" class="btn btn-normal" >发表</button>
                <button type="button" class="btn btn-danger" >取消</button>
            </div>
        </div>

    </div>
</div>

<span id="urls" data-blogurl="<?php echo site_url('Blog') ?>" data-baseurl="<?php echo site_url('Ajax') ?>" data-innerpage="<?php echo site_url('Innerpage'); ?>" hidden="hidden"></span>


<script type="text/javascript" src="<?php echo base_url('public/lib/umeditor'); ?>/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="<?php echo base_url('public/lib/umeditor'); ?>/ueditor.all.js"></script>

