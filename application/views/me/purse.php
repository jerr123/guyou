<!-- 样式 -->
<style type="text/css">
    .box1{
/*        background:#FBFBFB;*/
    /*position:relative;*/
    /*text-align:center;*/
    padding: 15px 0 0 90px;
    width:870px;
    height:320px;
    margin:0px auto;
    /*background: #E5EBF2;*/
}
#balance{
/*
    position:absolute;
    left:100px;
    top:100px;
*/
}
.box1 .panel{
    text-align: center;
    width: 160px;
    height: auto;
    background: #E5E7DD;
    margin: 15px 0px 0px 0px;
    margin-top: 10px;
    display: inline-block;
}
.box1 .panel .panel-body {
    padding: 15px;
    
}
.box1 .panel .panel-body h3 {
    margin: 0;
    margin-top: 5px; 
    padding: 0;
}
.box1 .panel-footer {
    background-color: rgb(246, 189, 26);
    color: #fff;
    border-top: 0px solid #fff;
    padding: 6px 15px;
    /*border-top: 1px solid #ddd;*/
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
}
.box1 .panel .body-point {
    /*background: */
    color: #eb4f38;
}
.box1 .panel .footer-point {
    color: #fff;
    background-color: #eb4f38;
}

.box1 .panel .body-biocn {
    color: rgb(246, 189, 26);
}
.box1 .panel .footer-biocn {
    color: #fff;
    background-color: rgb(246, 189, 26);
}

.box1 .panel .body-diamond {
    color: #56abe4;
}
.box1 .panel .footer-diamond {
    color: #fff;
    background-color: #56abe4;
}

.box1 .panel .body-rmb {
    color: #11cd6e;
}
.box1 .panel .footer-rmb {
    color: #fff;
    background-color: #11cd6e;
}
.box1 .recharge {
    margin: 40px 0 0 0;
    width: auto;
}
.box1 .recharge .btn {
    margin: 0 15px;
    font-size: 16px;
    /*line-height: 18px;*/
    text-decoration: none;
    padding: 8px 60px;
    border-radius:3px;
    border:1px solid #fff;
}
.box1 .recharge .put-in {
    background:#5CC931;
    color:white;  
}
.box1 .recharge .put-in:hover{
    border:1px solid #5CC931;
    color: #5CC931;
    background: #fff;
}
.box1 .recharge .put-out {
    padding: 8px 45px;
    background: #00bb9c;
    color: #fff;
}

.box1 .recharge .put-out:hover {
    border: 1px solid #00bb9c;
    background: #fff;
    color: #00bb9c;
}

.box1 .recharge .other-link a {
    font-size: 12px;
    background: #5c6868;
    line-height: 14px;
    padding: 2 4px;
    margin: 0 5px;
    color: #fff;
    border: 1px solid #fff;
    text-decoration: none;
}
.box1 .recharge .other-link a:hover {
   
    background: rgba(0,0,0,0.4);
}



/*下面这一部分废弃*/
#balance table tr{
    color:#a9b7b7;
}
#balance table tr td{
    /*width:200px;*/
}
#money{
    font-size:20px;
    font-weight:bold;
    color:black;
}
.font-color{
    color:#908383;
    font-weight:bold;
}
#recharge{
    margin:0px auto;
}
#recharge #put-in{
    font-size: 14px;
    line-height: 14px;
    text-decoration: none;
    width:100px;
    padding: 10px;
    background:#5CC931;
    color:white;
    border-radius:3px;
    border:0px;
    /*position:absolute;*/
    /*left:80px;*/
}
#recharge #put-in:hover{
    background:white;
    color:#5CC931;
    border:1px solid #5CC931;
}
#recharge #put-out{
    margin-left: 10px;
    font-size: 14px;
    line-height: 14px;
    text-decoration: none;
    padding: 10px;
    width:100px;
    background:#F5F3F3;
    color:#696868;
    border-radius:3px;
    border:1px solid #696868; 
    /*position:absolute;*/
    left:200px;
}
#recharge #put-out:hover{
    background:#696868;
    color:#F5F3F3;
}
#recharge .other-link{ 

    font-size:12px;
    color:#7394F8;
}
 #recharge .other-link a{
    float: right;
    text-decoration:none;
    color:#7394F8;
    font-size:12px;
    display: block;
    margin: 0 10px;
    padding-top: 10px;
}
 #recharge .other-link a:hover{
    color:#b22f2f;
}
</style>
<!-- html内容 -->
<div class="box1">
    <div class="panel">
        <div class="panel-body body-biocn">
            <i class="fa fa-btc fa-4x"></i>
            <h3><?php echo isset($data['b_icon']) ? $data['b_icon'] : 0; ?></h3>
        </div>
        <div class="panel-footer footer-biocn">
            <span>我的B币</span>
        </div>
    </div>
    <!-- 第二个 -->
    <div class="panel">
        <div class="panel-body body-diamond">
            <i class="fa fa-diamond fa-4x"></i>
            <h3><?php echo isset($data['diamond']) ? $data['diamond'] : 0; ?></h3>
        </div>
        <div class="panel-footer footer-diamond">
            <span>我的钻石</span>
        </div>
    </div>
    <!-- 第三快 -->
    <div class="panel">
        <div class="panel-body body-point">
            <!-- <i class="fa fa-4x"> -->
                <img width="60" src="<?php echo base_url('public/img/me/point.png')?>" alt="">
            <!-- </i> -->
            <h3><?php echo $data['point'] ?></h3>
        </div>
        <div class="panel-footer footer-point">
            <span>我的积分</span>
        </div>
    </div>
    <!-- 第四块 -->
    <div class="panel">
        <div class="panel-body body-rmb">
            <i class="fa fa-rmb fa-4x"></i>
            <h3><?php echo $data['topuping']?></h3>
        </div>
        <div class="panel-footer footer-rmb">
            <span>待到账(充值)</span>
        </div>
    </div>
<div class="recharge">
    <a class="btn put-in" href="<?php echo site_url('Common/toTopup'); ?>">充值</a>
    <button id="put-out" class="btn put-out" type="button">提出B币</button>
    <span class="other-link">
        <a id="changeto_bcoin" class="" href="javascript:void(0)">钻石兑换B币</a>
        <a id="changeto_diamond" class="" href="javascript:void(0)">B币兑换钻石</a>
    </span>
</div>
</div>

<span id="purse-urls" data-innerpage="<?php echo site_url('Innerpage') ?>" hidden="hidden"></span>

<!-- js -->
<script type="text/javascript">
    $(function () {
    var index = '';
    var innerpageUrl = $('#purse-urls').data('innerpage');

    // 提出B币
    $('#put-out').on('click', function () {
        $.get(innerpageUrl + '/withdrawBCoin', function (response) {
                index = layer.open({
                title:'提出B币',
                type: 1,
                area:['680px','380px'],
                shadeClose: true, //点击遮罩关闭
                // content: '\<\div style="padding:20px;">自定义内容\<\/div>'
                content : response
            });
        });
    });

    // 兑换b币
    $('#changeto_bcoin').on('click', function () {
        $.get(innerpageUrl + '/changeToBCoin', function (response) {
                index = layer.open({
                title:'兑换B币',
                type: 1,
                area:['680px','340px'],
                shadeClose: true, //点击遮罩关闭
                content : response
            });
        });
    });

    // B币兑换钻石
    $('#changeto_diamond').on('click', function () {
        $.get(innerpageUrl + '/changetoDiamond', function (response) {
                index = layer.open({
                title:'兑换钻石',
                type: 1,
                area:['680px','340px'],
                shadeClose: true, //点击遮罩关闭
                content : response
            });
        });
    });

});
</script>