<style type="text/css">
    /*
    关键的动态展示
*/

.main-state{

    width:100%;
    height:auto;
    padding-bottom:10px;
}
.main-state .frist{
    margin:0 0 10px 0;
}
.status-box{
    width:100%;
    height:auto;
    margin:20px auto;
    padding-bottom: 5px;
    box-shadow: 0 0 5px 0 #CCC;
    border-radius: 3px;
    background: #f7f7f7;
}


/*
        动态展示标题
*/
.box-title .title-img{
    float: left;
    width: 60px;
    height: 0px;
    border-radius: 50%;
}
.box-title{
    height: 80px;
}
.box-title .title-img img{

    width:60px; 
    margin: 10px 0 0 10px;
    height:60px;
    border-radius:50%; 
    overflow:hidden;
    background: #CCC;
}
.box-title .title-main{
    float:left;
    padding-top: 10px;
    margin-left: 80px;
}
.box-title .title-main a{
    font-weight: 600; 
    color: #555555;
    display: block;
    font-size:15px;
    text-decoration: none;
    margin-top: 10px;
    
    
}
.box-title .title-main a:hover{
    color: #ac973f;
    font-weight:700;
}
.box-title .title-main p{
    color: #636363;
    margin-top: 10px;
    font-size: 12px;
    margin-bottom:10px;
}

.box-title .fengefu{
    width: 100%;
    clear: both;

    border: 1px dashed #CCC;
}
/*
            很关键的状态内容
        
    */
    .status-box .box-main{
     
        width: 95%;
        overflow: hidden;
        height: auto;
        margin:auto;
        padding-bottom:30px;
    }
    .status-box .box-main p{
        font-size: 15px;
        color: #747474;
    }

    
/*    多图展示部分*/
    .more-img{
        width:100%;
        height:auto;
      
    }
    .more-img .img-box{
        width:275px;
        height:275px;
        padding:10px;
        border:1px solid #e4e4e4;
        float:left;
    }
    .more-img .img-box img{
        background:#fff;
    }
    
/*    单图展示部分*/
    .one-img img{
        box-shadow: 0 0 5px 0 #e8e8e8;
        max-width:730px;
    }
    
    /*翻页链接*/
    
    .list_pag{
        margin:0 auto;
        width: 300px;
        padding-bottom: 50px;
    }
    .list_pag  li{
        border:1px solid #dbdbdb ;
        width: 40px;
        float:left;
        list-style: none;
        height: 40px;
        padding: 0px;
        text-align: center;
    
    }
    .list_pag  li:hover{
        background:#e2e2e2;
    }
    .list_pag  li a{
        line-height: 40px;
        text-decoration: none;
        color: #585858;
        display: block;
        width: 40px;
        height: 40px;
    }
    .list_pag #on {
        background: #d4d4d4;
    }
    /*    
    
    
    图案弹出部分
    
    
    */
        
    .photo_album{
        position:fixed;    
        left:50%;
        margin-left:-2450px;
        top: 50%;
        z-index:999;
        width:600px;  
        height:auto;
        display:block;
        transition: all .6s;
        vertical-align: middle;
    }
    .photo_album .box-img{
       
        height:auto;
        text-align: center;
    
    }
    .photo_album img{
        vertical-align: middle;
        margin-top:-25%;
        box-shadow: 2px 2px 2px #272727;
        max-width:400px;
        max-height:600px;
        background:#fff;
    }

    
/*遮罩层
*/
    .photo_mask{
       background: #464646;
       opacity: 0.7;
       height: 100%;
       width: 100%;
       position:fixed;
       left: 0;
       top: 0;
       z-index: 9;
       display:none;
    }

</style>
           

           
           <!--          动态展示部分-->
            <div class="main-state">
                <div class="status-box frist">
                    <div class="box-title">
                        <div class="title-img">
                            <img alt="" src="/public/img/logo.png" width="100%" height="100%">
                        </div>
                        <div class="title-main">
                            <a href="#">菇友网昵称</a>
                            <p>8月16日17:15</p>
                        </div>
                        <div class="fengefu"></div>
                    </div>
                    <div class="box-main">
                        <p>今天吃什么明天吃什么天吃什么明天吃什么天吃什么明天吃什么天吃什么明天吃什么天吃什么明天吃什么天吃什么明天吃什么</p>
<!--                        多图展示部分-->
                        <div class="more-img">
                            <div class="img-box mask-btn">
                                <img src="/public/img/logo.png" width="100%" height="100%">
                            </div>
                            <div class="img-box"><img src="/public/img/myhome_bg.jpg" width="100%" height="100%"></div>
                            <div class="img-box"> <img src="/public/img/myhome_bg.jpg" width="100%" height="100%"></div>
                            <div class="img-box"><img src="/public/img/myhome_bg.jpg" width="100%" height="100%"></div>
                            <div class="img-box"><img src="/public/img/nav/01.jpg" width="100%" height="100%"></div>
                            <div class="img-box"><img src="/public/img/pay/alipay_logo.png" width="100%" height="100%"></div>
                            <div class="img-box"><img src="/public/img/myhome_bg.jpg" width="100%" height="100%"></div>
                            <div class="img-box"><img src="/public/img/logo.png" width="100%" height="100%"></div>
                        </div>
                    </div>    
                </div>
                <div class="status-box">
                    <div class="box-title">
                        <div class="title-img">
                            <img alt="" src="/public/img/logo.png" width="100%" height="100%">
                        </div>
                        <div class="title-main">
                            <a href="#">菇友网昵称</a>
                            <p>8月16日17:15</p>
                        </div>
                        <div class="fengefu"></div>
                    </div>
                    <div class="box-main">
                        <p>今天吃什么明天吃什么天吃什么明天吃什么天吃什么明天吃什天吃什么明天吃什么天吃什么明天吃什么天吃什么明天吃什天吃什么明天吃什么天吃什么明天吃什么天吃什么明天吃什天吃什么明天吃什么天吃什么明天吃什么天吃什么明天吃什    天吃什么明天吃什么天吃什么明天吃什么天吃明天吃什么天吃什么明天吃什天吃什么明天吃什么天吃什么明天吃什么天吃什么明天吃什天吃什么明天吃什么天吃什么明天吃什么天吃什么明天吃什天吃什么明天吃什么天吃什么明天吃什么天吃什么明天吃什    天吃什么明天吃什么天吃什么明天吃什么天吃明天吃什么天吃什么明天吃什天吃什么明天吃什么天吃什么明天吃什么天吃什么明天吃什天吃什么明天吃什么天吃什么明天吃什么天吃什么明天吃什天吃什么明天吃什么天吃什么明天吃什么天吃什么明天吃什    天吃什么明天吃什么天吃什么明天吃什么天吃什么明天吃什么天吃什么明天吃什么天吃什么明天吃什么天吃什么明天吃什么</p>
                        
                        
<!--                    单图展示部分-->
                        <div class="one-img">
                            <img  alt="" src="/public/img/nav/01.jpg">
                        </div>
                    </div>
                </div>
                <div class="status-box">
                    <div class="box-title">
                        <div class="title-img">
                            <img alt="" src="/public/img/logo.png" width="100%" height="100%">
                        </div>
                        <div class="title-main">
                            <a href="#">菇友网昵称</a>
                            <p>8月16日17:15</p>
                        </div>
                        <div class="fengefu"></div>
                    </div>
                    <div class="box-main">
                        <p>今天吃什么明天吃什么天吃什么明天吃什么天吃什么明天吃什么天吃什么明天吃什么天吃什么明天吃什么天吃什么明天吃什么</p>
                        <img src="/public/img/pay/alipay_logo.png">
                    </div>
                </div>
                <div class="status-box">
                    <div class="box-title">
                        <div class="title-img">
                            <img alt="" src="/public/img/logo.png" width="100%" height="100%">
                        </div>
                        <div class="title-main">
                            <a href="#">菇友网昵称</a>
                            <p>8月16日17:15</p>
                        </div>
                        <div class="fengefu"></div>
                    </div>
                    <div class="box-main">
                        <p>今天吃什么明天吃什么天吃什么明天吃什么天吃什么明天吃什么天吃什么明天吃什么天吃什么明天吃什么天吃什么明天吃什么</p>
                        <img src="/public/img/pay/alipay_logo.png">
                    </div>
                </div>
                <div class="status-box">
                    <div class="box-title">
                        <div class="title-img">
                            <img alt="" src="/public/img/logo.png" width="100%" height="100%">
                        </div>
                        <div class="title-main">
                            <a href="#">菇友网昵称</a>
                            <p>8月16日17:15</p>
                        </div>
                        <div class="fengefu"></div>
                    </div>
                    <div class="box-main">
                        <p>今天吃什么明天吃什么天吃什么明天吃什么天吃什么明天吃什么天吃什么明天吃什么天吃什么明天吃什么天吃什么明天吃什么</p>
                        <img src="/public/img/pay/alipay_logo.png">
                    </div>
                </div>
                <div class="status-box">
                    <div class="box-title">
                        <div class="title-img">
                            <img alt="" src="/public/img/logo.png" width="100%" height="100%">
                        </div>
                        <div class="title-main">
                            <a href="#">菇友网昵称</a>
                            <p>8月16日17:15</p>
                        </div>
                        <div class="fengefu"></div>
                    </div>
                    <div class="box-main">
                        <p>今天吃什么明天吃什么天吃什么明天吃什么天吃什么明天吃什么天吃什么明天吃什么天吃什么明天吃什么天吃什么明天吃什么</p>
                        <img src="/public/img/pay/alipay_logo.png">
                    </div>
                </div>
                <div class="status-box">
                    <div class="box-title">
                        <div class="title-img">
                            <img alt="" src="/public/img/logo.png" width="100%" height="100%">
                        </div>
                        <div class="title-main">
                            <a href="#">菇友网昵称</a>
                            <p>8月16日17:15</p>
                        </div>
                        <div class="fengefu"></div>
                    </div>
                    <div class="box-main">
                        <p>今天吃什么明天吃什么天吃什么明天吃什么天吃什么明天吃什么天吃什么明天吃什么天吃什么明天吃什么天吃什么明天吃什么</p>
                        <img src="/public/img/pay/alipay_logo.png">
                    </div>
                    
                </div>
                <div class="status-box">
                    <div class="box-title">
                        <div class="title-img">
                            <img alt="" src="/public/img/logo.png" width="100%" height="100%">
                        </div>
                        <div class="title-main">
                            <a href="#">菇友网昵称</a>
                            <p>8月16日17:15</p>
                        </div>
                        <div class="fengefu"></div>
                    </div>
                    <div class="box-main">
                        <p>今天吃什么明天吃什么天吃什么明天吃什么天吃什么明天吃什么天吃什么明天吃什么天吃什么明天吃什么天吃什么明天吃什么</p>
                        <img src="/public/img/pay/alipay_logo.png">
                    </div>    
                </div>
               
            </div>
<!--            /*分页部分*/-->
            
            <div >
                    <ul class="list_pag">
                        <li  id="on"><a href="#">1</a></li>
                        <li><a  href="#">2</a></li>
                        <li><a  href="#">3</a></li>
                        <li><a  href="#">4</a></li>
                        <li><a  href="#">5</a></li>
                        <li><a  href="#">...</a></li>
                    </ul>
                </div>
                
               
              
<!--            团弹出部分-->

            <div class="photo_album">
                <div class="box-img">
                    <img src="/public/img/myhome_bg.jpg">
                    <span></span>
                </div>
            </div>
            <!--                照片弹窗-->
            <div class="photo_mask"></div>
                
            
           
          
<script type="text/javascript">
    $(".mask-btn").click(function(){
      $(".photo_mask").css("display","block");
   
    })
    $(".mask-btn").click(function(){
        $(".photo_album").css("margin-left","-250px");
        
    })
    $(".photo_album .photo_close,.photo_mask").click(function(){
        $(".photo_mask").css("display","none")
    })
    
    $(".photo_album .photo_close,.photo_mask").click(function(){
        $(".photo_album").css("margin-left","-2450px")
        
    })
    
    
    
    
</script>