<div class="container-center1100px">
    <div class="mainpage-container ">
        <div class="mainpage-head">
            <div class="head-box">
                <div class="head-img"><img alt="" src="/public/img/logo.png"></div>
                <div class="head-nick">
                    <p><?php echo $uinfo['user_nick']?>主页</p>
                    <?php if ($user['user_id']!=$uinfo['user_id']): ?>
                        <a href="#"> <i class="fa fa-plus"></i> 加好友</a>
                    <?php endif ?>
                    
                </div>
            </div>
        </div>
        
<!--        左侧功能板块-->
       
       
        <div class="mainpage-mian">
        
        
<!--           个人信息板块-->
           
            <div class="main-plate">
                <div class="plate-person">
                    <div class="person-box">
                        <h1>个人信息</h1>
                        <div class="person-mian">
                            <p><span>昵称:</span>&nbsp;&nbsp;<?php echo $uinfo['user_nick'] ?></p>
                            <p><span>星座:</span>&nbsp;&nbsp;<?php echo $uinfo['user_star'] ?></p>
                            <p><span>地址:</span>&nbsp;&nbsp;<?php echo $uinfo['user_address'] ?></p>
                            <!-- <p><span>简单描述:</span>&nbsp;&nbsp;我的性格偏于内向，为人坦率、热情、讲求原则；处事乐观、专心、细致、头脑清醒；富有责任心、乐于助人。 </p> -->
                        </div>
                      
                    </div>
                </div>
                
                
                <!--            日志板块-->
             
                <div class="plate-log">
                    <div class="log-box">
                        <h1>日志</h1> 
                        <a class="more-log"  href="#">更多</a>
                        <div class="under-line"></div>
                        <div class="person-mian">
                        <?php foreach ($blog as $bk => $bv): ?>
                            <a href="<?php echo site_url('Common/viewJournal').'?blog_id='.$bv['blog_id']?>"><p><?php echo $bv['blog_title'] ?> <span><?php echo $bv['blog_addtime'] ?></span></p></a>
                        <?php endforeach ?> 
                       
                        </div>
                      
                    </div>
                </div>
                
                                

                
<!--                相册部分-->
            <div class="plate-log">
                    <div class="log-box">
                        <h1>最新照片</h1> 
                         <a class="more-log-p"  href="#">更多</a>
                        <div class="under-line"></div>
                        <div class="person-mian">
                        <?php foreach ($photo as $pk => $pv): ?>
                            <a class="mask-btn" href="#"><img src="<?php echo site_url('Home/getCommonPhotoThumb').'?photo_id='.$pv['photo_id']?>" width="100%" height="100%"></a>
                        <?php endforeach ?>
                            
                            
                           
                        </div>
                      
                    </div>
                </div>
<!--                照片弹窗-->
            <div class="photo_mask"></div>
                
            </div>
<!--          动态展示部分-->
            <div class="main-state">
                
                <?php foreach ($trends as $tk => $v): ?>
                    <div class="status-box">
                        <div class="box-title">
                            <div class="title-img">
                                <img alt="" src="/public/img/logo.png" width="100%" height="100%">
                            </div>
                            <div class="title-main">
                            <a href="#"><?php echo $uinfo['user_nick'] ?></a>
                                <p><?php echo $v['trends_addtime'] ?></p>
                            </div>
                            <div class="fengefu"></div>
                        </div>
                        <div class="box-main">
                            <p><?php echo $v['trends_content'] ?></p>
                            <!-- <img src="/public/img/pay/alipay_logo.png"> -->
                        </div>
                    </div>
                <?php endforeach ?>
                
                
                <!--<div class="list_pag">
                    <ul>
                        <li><a id="on" href="#">1</a></li>
                        <li><a  href="#">2</a></li>
                        <li><a  href="#">3</a></li>
                        <li><a  href="#">4</a></li>
                        <li><a  href="#">5</a></li>
                        <li><a  href="#">...</a></li>
                    </ul>
                </div>-->
            </div>
        </div>
    </div>
</div>

<!---->
<!---->
<!--弹窗部分内容-->
<div>
    <div class="photo_mask"></div>
    <div class="photo_album">
        <div class="box-img">
            <img src="/public/img/pay/alipay_logo.png";>
            <span></span>
        </div>
    </div>
</div>
<script type="text/javascript">
    
</script>
