<!-- css -->
<style type="text/css">
.member_option{
    width:870px;
    height:320px;
/*        background:#FBFBFB;*/
    margin:10px auto;
    text-align:center;
    position:relative;+
}
.member_option tr td button{
    width:150px;
    height:40px;
    color:white;
    border:0px;
    background:#88D47C;
    cursor:pointer;
}
.member_option tr td button:hover{
    color:#88D47C;
    background:white;
    border:1px solid #88D47C;
}
.member_option table{
    /*position:absolute;*/
    margin: 40px 120px;
    left:180px;
    top:20px;
}
.member_option table tr td{
    width:150px;
    height:40px;
    /*background:#d9cbcb;*/
}
.member_option tr td{
    background-color:#fff; 
    width:100px;
    height:50px;
    text-align:center;
}
.member_option table tr td img{
    border-radius: 10px;
    width:150px;
    height:180px;
    background:#d9cbcb;
}
</style>

<div class="member_option">
  <table width="400px" cellspacing="20" cellpadding="0">
       <tr>
         <td>
             <img src="<?php echo base_url('public/img/me/vip1.png');?>" alt="">
         </td>
         <td>
             <img src="<?php echo base_url('public/img/me/vip2.png');?>" alt="">
         </td>
         <td>
             <img src="<?php echo base_url('public/img/me/vip3.png');?>" alt="">
         </td>
       </tr>
       <tr>
           <td><button id="upgrade-10" type="button" ><?php echo $v1['vip_level_need']?>&nbsp;<i class="fa fa-diamond"></i></button></td>
           <td><button id="upgrade-100" type="button" ><?php echo $v2['vip_level_need']?>&nbsp;<i class="fa fa-diamond"></i></button></td>
           <td><button id="upgrade-1000" type="button" ><?php echo $v3['vip_level_need']?>&nbsp;<i class="fa fa-diamond"></i></button></td>
       </tr>
  </table>
</div>

<span id="ug-urls" data-baseurl="<?php echo site_url('Ajax') ?>" hidden="hidden"></span>
<!-- js -->
<script type="text/javascript">
$(function () {


    var baseUrl = $("#ug-urls").data('baseurl');    // 基础url


    $('#upgrade-10').on('click', function () {
        $.post(baseUrl + '/levelUp', {"to_level" : 2}, function (response) {
            if (response.status == 1) {
                swal('Success', '升级成功', 'success');
            } else {
                swal('Error', response.errmsg, 'error');
                return false;
            }

        });
    });


    $('#upgrade-100').on('click', function () {
        $.post(baseUrl + '/levelUp', {"to_level" : 3}, function (response) {
            if (response.status == 1) {
                swal('Success', '升级成功', 'success');
            } else {
                swal('Error', response.errmsg, 'error');
                return false;
            }

        });
    });


    $('#upgrade-1000').on('click', function () {
        $.post(baseUrl + '/levelUp', {"to_level" : 4}, function (response) {
            if (response.status == 1) {
                swal('Success', '升级成功', 'success');
            } else {
                swal('Error', response.errmsg, 'error');
                return false;
            }

        });
    });


});
</script>