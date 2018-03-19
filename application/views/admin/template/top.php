<div id="wrapper">
<nav class="navbar navbar-default top-navbar" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo site_url('admin/Home/index');?>">菇友·千寻社后台</a>
    </div>

    <ul class="nav navbar-top-links navbar-right">
        
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <!-- <li><a href="#"><i class="fa fa-user fa-fw"></i> 个人信息</a> 
                </li>
                <li><a href="#"><i class="fa fa-gear fa-fw"></i> 设置</a>
                </li>-->
                <li class="divider"></li>
                <li><a href="<?php echo site_url('admin/Login/logout')?>"><i class="fa fa-sign-out fa-fw"></i> 退出</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
</nav>
<!-- /.top nav -->
<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">

            <li <?php if (isset($flag1) && $flag1=='yhgl') echo "class=\"active\"";?>>
                <a href="" ><i class="fa fa-user"></i> 用户管理<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li>
                        <a href="<?php echo site_url('admin/User/userList') ?>" <?php if (isset($flag2) && $flag2=='hygl') echo "class=\"active-menu\"";?> >用户列表</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin/User/topupList') ?>" <?php if (isset($flag2) && $flag2=='czcl') echo "class=\"active-menu\"";?>>充值处理</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin/User/topupRecordList') ?>" <?php if (isset($flag2) && $flag2=='czjl') echo "class=\"active-menu\"";?>>充值记录</a>
                    </li>
                    

                </ul>
            </li>
            <li <?php if (isset($flag1) && $flag1=='yygl') echo "class=\"active\"";?>>
                <a href="#"><i class="fa fa-laptop"></i> 运营管理<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li>
                        <a href="<?php echo site_url('admin/Adv/AdPositionList') ?>" <?php if (isset($flag2) && $flag2=='ggw') echo "class=\"active-menu\"";?> >广告管理</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin/Home/index')?>" <?php if (isset($flag2) && $flag2=='sjtj') echo "class=\"active-menu\"";?>>数据统计</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin/Home/cashList')?>" <?php if (isset($flag2) && $flag2=='txgl') echo "class=\"active-menu\"";?>>提现管理</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin/Home/cashRecordList')?>" <?php if (isset($flag2) && $flag2=='txjl') echo "class=\"active-menu\"";?>>提现记录</a>
                    </li>
                </ul>
            </li>
            <li <?php if (isset($flag1) && $flag1=='xtgl') echo "class=\"active\"";?>>
                <a href="#"><i class="fa fa-sun-o"></i> 系统管理<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li>
                        <a href="<?php echo site_url('admin/Home/info') ?>" <?php if (isset($flag2) && $flag2=='grxx') echo "class=\"active-menu\"";?>>个人信息</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin/Home/mainConfig') ?>" <?php if (isset($flag2) && $flag2=='cypz') echo "class=\"active-menu\"";?> >常用配置</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin/Home/vipLevel') ?>" <?php if (isset($flag2) && $flag2=='hypz') echo "class=\"active-menu\"";?> >会员等级配置</a>
                    </li>
                    <!--<li>
                        <a href="#" <?php if (isset($flag2) && $flag2=='qipz') echo "class=\"active-menu\"";?>>其他配置</a>
                    </li>-->
                    
                </ul>
            </li>
            <!--<li>
                <a href="#"><i class="fa fa-picture-o"></i> 相册管理<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li>
                        <a href="#">用户相册</a>
                    </li>
                    <li>
                        <a href="#">照片列表</a>
                    </li>
                    <li>
                        <a href="#" class="active-menu">其他</a>
                    </li>
                    
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-file-text-o"></i> 日志管理<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li>
                        <a href="#">用户日志</a>
                    </li>
                    <li>
                        <a href="#">非法日志</a>
                    </li>
                    
                </ul>
            </li>-->
            <!--<li>
                <a href="empty.html"><i class="fa fa-fw fa-file"></i> Empty Page</a>
            </li>-->
        </ul>

    </div>

</nav>
<!-- ./ side nav -->