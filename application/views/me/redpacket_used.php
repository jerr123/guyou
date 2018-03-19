<style type="text/css">
    .layout{
        position:relative;
/*        top:60px;*/
    }
    .red_packet{
        color:#efb20f;
        text-align:center;
        margin:10px auto;
        width:800px;
        height:320px;
        background-size:contain;
        background-position:top;
/*        border:1px solid red;*/
    }
  .integral_packet a img,.common_packet a img,.gold_packet a img,.diamond_packet a img{
/*        position:relative;*/
        width:50px;
        height:50px;
        margin:20px;
        border-radius:20px;
    }
    .integral_packet a img:hover,.common_packet a img:hover,.gold_packet a img:hover,.diamond_packet a img:hover{
        width:51px;
        height:51px;
        margin:20px;
        border-radius:20px;
    }
    .member{
/*
        position:relative;
        top:10px;
        left:80px;
*/
        margin:20px auto;
        width:280px;
        height:150px;
/*        border:1px solid red;*/
    }
    .integral_packet{
        font-size:12px;
/*        margin:50px auto;*/
/*        border:1px solid red;*/
    }
    .common_packet{
        float:left;  
        font-size:12px;
    }
    .gold_packet{
        float:left;        
        font-size:12px;
    }
    .diamond_packet{
        float:left;        
        font-size:12px;        
    }
</style>
    <div class="red_packet" style="background-image:url('<?php echo base_url("public/img/me/redpacket_bg.jpg");?>')">
       <div class="layout">
            <div id="" class="integral_packet"><a href=""><img src="<?php echo base_url('public/img/me/redpacket.jpg');?>" alt=""></a><br>红包积分</div>
            <div id="" class="member">
                <div id="" class="common_packet"><a href=""><img src="<?php echo base_url('public/img/me/redpacket.jpg');?>" alt=""></a><br>普通会员红包</div>
                <div id="" class="gold_packet"><a href=""><img src="<?php echo base_url('public/img/me/redpacket.jpg');?>" alt=""></a><br>黄金会员红包</div>
                <div id="" class="diamond_packet"><a href=""><img src="<?php echo base_url('public/img/me/redpacket.jpg');?>" alt=""></a><br>钻石会员红包</div>
            </div>          
       </div>
        
  </div>
