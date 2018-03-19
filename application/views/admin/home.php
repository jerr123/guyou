<style type="text/css">
    .red{
        color: #EC2727;
    }
    .color {
        background:#8AE110;
    }
    .panel{
        /*border-bottom-right-radius: 100px;*/
        /*border-bottom-left-radius: 100px;*/
    }
    .panel-today{
        padding: 10px 15px;
        background-color: #f5f5f5;
        border-top: 1px solid #fff;
        border-bottom-right-radius: 100px;
        border-top-right-radius: 100px;
        border-bottom-left-radius: 100px;
        border-top-left-radius: 100px;
    }
    .badge {
        font-size: 13px;
    }
    .panel-footer span {
        font-size: 15px;
    }
</style>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
             <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            数据统计 <small>网站数据统计</small>
                        </h1>
                    </div>
                </div> 
                 <!-- /. ROW  -->
               <?php //var_dump($data)?>
            <div class="row">
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-brown">
                            <div class="panel-body">
                                <i class="fa fa-usd fa-5x"></i>
                                <h3><?php echo $data['topup']?></h3>
                            </div>
                            <div class="panel-footer back-footer-brown">
                                <span>总充值单数量</span>
                                <!-- <span class="badge pull-right color">今日充值:42</span> -->
                            </div>
                             <div class="panel-today back-today-brown">
                                <span class="badge">今日充值单:<span class="red">+<?php echo $today['topup'] ?></span></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-grold">
                            <div class="panel-body">
                                <i class="fa fa-users fa-5x"></i>
                                <h3><?php echo $data['user']?></h3>
                            </div>
                            <div class="panel-footer back-footer-grold">
                                <span>总注册用户</span>

                            </div>
                            <div class="panel-today back-today-brown">
                                <span class="badge">今日新增:<span class="red">+<?php echo $today['user']?></span></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-green">
                            <div class="panel-body">
                                <i class="fa fa-picture-o fa-5x"></i>
                                <h3><?php echo $data['photo']; ?></h3>
                            </div>
                            <div class="panel-footer back-footer-green">
                                <span>总上传照片数</span>

                            </div>
                            <div class="panel-today back-today-brown">
                                <span class="badge">今日新增:<span class="red">+<?php echo $today['photo']?></span></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-blue">
                            <div class="panel-body">
                                <i class="fa fa-sticky-note fa-5x"></i>
                                <h3><?php echo $data['blog'] ?> </h3>
                            </div>
                            <div class="panel-footer back-footer-blue">
                                <span>总日志数量</span>

                            </div>
                            <div class="panel-today back-today-brown">
                                <span class="badge">今日新增:<span class="red">+<?php echo $today['blog']?></span></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-red">
                            <div class="panel-body">
                                <i class="fa fa fa-comments fa-5x"></i>
                                <h3><?php echo $data['trends']?> </h3>
                            </div>
                            <div class="panel-footer back-footer-red">
                                <span>总说说数量</span>

                            </div>
                            <div class="panel-today back-today-brown">
                                <span class="badge">今日新增:<span class="red">+<?php echo $today['trends']?></span></span>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <!-- /. ROW  -->
        </div>