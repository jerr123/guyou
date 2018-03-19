<style type="text/css">
  #box{
    /*background-color: red;*/
    width:700px;
    margin:0 auto;
    overflow: hidden;

}

    #box .btn-boxes {
        width: 100%;
        background-color: red;
        overflow: hidden;
    }

        #box .btn-boxes button {
            text-align: center;
            background-color: #fff;
            color: #777;
            line-height: 15px;
            border: 1px solid #eee;
            font-size: 15px;
            width: 50%;
            float: left;
            padding: 10px 0;
            outline: none;
        }

        #box .btn-boxes button:hover {
            background-color: rgba(255,217,82, 1);
            color: rgba(110,77,50,0.7);
        }

    #box .box-line {
        padding: 0;
        margin: 0;
        /*height: 1px;*/
        display: block;
        width: 100%;
        border-bottom: 1px solid #ccc;

    }


#box .panel-con {
    justify-content: center;
    display: -ms-flex;
    display: flex;
    width: 100%;
    text-align: center;
}

#box .inner-box {
    margin: auto;
    /*background-color: red;*/
}





/* #box div{
    position:relative;
    height:300px;
background: #F2F2F2;
    display: none;
} */
#box input{
    height:30px;
    padding: 5px;
    font-size: 14px;
    line-height: 14px;
    outline: none;
    width: 220px;
}

/*修改密码*/
#pass{
    display: block;
    
}

#pass .modify-pass{
    padding: 0;
    margin: 0;
    border-collapse:separate;
    cellpading: 0;
    cellspacing: 0;
    border-spacing:30px;
}
#pass .modify-pass tr {
    /*background-color: red;*/
    margin: 0;
    padding: 0;
}

#pass .modify-pass tr td:nth-child(1) {
    font-size: 13px;
    text-align: right;
}

#pass .modify-pass td {
    margin: 0;
    padding: 0;
}
       
#pass .sub-pass {
    display:block;
    width:100px;
    font-size: 14px;
    padding: 5px 20px;
} 


/*修改密码结束*/
/*绑定银行卡*/
#bank{
    padding-top: 10px;
    display: none;
}
#bank .bound-bank{
    border-collapse:separate;
    border-spacing:10px;
}

#bank .bound-bank tr td:nth-child(1) {
    font-size: 13px;
    text-align: right;
}

#bank .bound-bank tr td:nth-child(2) {
    text-align: left;
}

#bank .sub-bank{
    padding: 5px 10px;
    margin: 5px 0;
    /*display:block;*/
    width:180px;
    font-size: 14px;
}


#bank .bank-title {
    font-size: 15px;
    line-height: 10px;
    color: #aaa;
    background-color: #fff;
    margin-left: 5px;
}

#bank .bank-img{

    width: 200px;
    height: 50px;
}

#bank .info {
    color: #cc0000;
    font-size: 12px;
}

#agree a {
    font-size:14px;
    font-weight:normal;
    color: #aaa;
    text-decoration: none;
}
#agree a:hover {
    color: #555;
    text-decoration: underline;
}

</style>
<div id="box">
    <div class="btn-boxes">
      <button id="tab-pass" style="border:0px;" type="button">修改密码</button>
      <button id="tab-bank" style="border:0px;" type="button">绑定银行卡</button>
    </div>
    
    <span class="box-line"></span>
    <div class="panel-con">
      <div id="pass" class="inner-box">
          <table class="modify-pass">
             <tr>
                 <td><label>旧密码：</label></td>
                 <td><input id="old-pass" class="input-normal text" type="password" name="" placeholder="请输入旧密码"></td>
             </tr>

             <tr>
                 <td><label>新密码：</label></td>
                 <td><input id="new-pass" class="input-normal text" type="password" name="" placeholder="请输入新密码"></td>
             </tr>
             <tr>
                 <td><label>确认新密码：</label></td>
                 <td><input id="confirm-pass" type="password" class="input-normal" name="" placeholder="确认密码"></td>
             </tr>
             <tr>
               <td></td>
               <td><button id="btn-alter-pass" class="btn btn-normal sub-pass" type="button">确认修改</button></td>
             </tr>
          </table>
          
      </div>
      <div id="bank" class="inner-box">
        <span class="info"><img src="" alt="">仅限持卡人本人操作,请如实填写一下信息用于银行验证.</span>
        <table class="bound-bank">
<!--           <tr>
               <td><label>开户银行：</label></td>
               <td>
                   <input name="bank" type="radio" value="" style="width: 15px;height: 15px"/><span class="bank-title">中国建设银行</span> <img class="bank-img" src="<?php echo base_url('public/img/me/jianshe.png');?>" alt="">            
                   <input name="bank" type="radio" value="" style="width: 15px;height: 15px"/><span class="bank-title">中国农业银行</span> <img class="bank-img" src="<?php echo base_url('public/img/me/nongye.png');?>" alt="">            
               </td>
           </tr>
-->
           <tr>
               <td><label>开户名：</label></td>
               <td><input id="bank-truename" type="text" class="input-normal" name="" placeholder="请输入银行卡开户姓名"></td>
           </tr>
           <tr>
               <td><label>开户银行：</label></td>
               <td><input id="bank-name" type="text" class="input-normal" name="" placeholder="请输入开户的银行,如建设银行"></td>
           </tr>
           <tr>
               <td><label>银行卡号：</label></td>
               <td><input id="bank-card" type="text" class="input-normal" name="" placeholder="请输入银行卡号"></td>
           </tr>
<!--           <tr>
               <td><label>手机号码：</label></td>
               <td><input id="bank-phone" type="text" name="" placeholder="请输入预留手机号码"></td>
           </tr>
-->
           <tr>
             <td></td>
             <td><button id="binding-bank" class="btn btn-normal sub-bank" type="button" >同意协议并提交</button></td>
           </tr>
           <tr>
             <td></td>
             <td><p id="agree"><a href="">《支付宝快捷支付服务协议》</a></p></td>
           </tr>
        </table>
        
        
      </div>
    </div>

</div>

<span id="settingurls" data-baseurl="<?php echo site_url('Ajax') ?>" hidden="hidden"></span>

<script type="text/javascript">
  $(function () {

    var baseUrl = $('#settingurls').data('baseurl');

    // 选项卡
    $('#tab-pass').on('click', function () {
        $('#bank').hide();
        $('#pass').show();
    });

    $('#tab-bank').on('click', function () {
        $('#bank').show();
        $('#pass').hide();
    });



    // 修改密码
    $('#btn-alter-pass').on('click', function () {

        $.post(baseUrl + '/alterPass', {
            "old" : $('#old-pass').val(),
            "new" : $('#new-pass').val(),
            "confirm" : $('#confirm-pass').val()
        }, function (response) {
            if (response.status == 1) {
                layer.msg('修改成功,请记住你的新密码',{
                  icon : 1
                })
            }else if (response.status==-2){
              layer.tips('两次密码不一样','#confirm-pass',{
                tips : 1
              });
            }else if (response.status==-5){
              layer.tips(response.errmsg,'#new-pass',{
                tips : 2
              });
            }else if (response.status==-4){
              layer.tips(response.errmsg,'#old-pass',{
                tips : 2
              });
            }else{
              layer.msg(response.errmsg, {
                icon : 2
              })
            }
            
        });

    });


    // 绑定银行卡
    $('#binding-bank').on('click', function () {
         $.post(baseUrl + '/bindingBank', {
            //"bank" : $('input:radio[name=bank]:checked').val(),
            "truename" : $('#bank-truename').val(),
            "card" : $('#bank-card').val(),
            "bank_name" : $('#bank-name').val()
           // "phone" : $('#bank-phone').val()
        }, function (response) {
            if (response.status == 1) {
                layer.msg('恭喜！绑定银行卡成功',{
                  icon : 1
                })
            }else if (response.status==-3){
              layer.tips(response.errmsg,'#bank-card',{
                tips : 2
              });
            }else if (response.status==-4){
              layer.tips(response.errmsg,'#bank-truename',{
                tips : 2
              });
            }else if (response.status==-5){
              layer.tips(response.errmsg,'#bank-name',{
                tips : 2
              });
            }else{
              layer.msg(response.errmsg, {
                icon : 2
              })
            }
        });
         
    });

});
</script>