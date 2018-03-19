<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>欢迎登录后台</title>
     <!-- jQuery Js -->
    <script src="<?php echo base_url('public/admin/js/jquery-1.10.2.js')?>"></script>
    <!-- layUI -->
    <script src="<?php echo base_url('public/lib/layui/layer.js')?>"></script>
    <!-- Bootstrap Styles-->
    <link href="<?php echo base_url('public/admin/css/bootstrap.css');?>" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="<?php echo base_url('public/admin/css/font-awesome.css');?>" rel="stylesheet" />
    <script type="text/javascript" src="<?php echo base_url('public/admin/js/canvas.js')?>"></script>

</head>
<body>
<!-- 头部 -->
<canvas width="1835" style="background:rgb(235, 239, 245);" height="950"></canvas>
<style type="text/css">
canvas {
  width: 100%;
  height: 100%;
  position: absolute;
}
    .main-box {
    width: 490px;
    background-color: #ffffff;
    position: absolute;
    left: 50%;
    margin-left: -245px;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.25);
    border: none;
    margin-top: 120px;
}
.main-box .top-banner {
    background: #19bca1;
    height: 90px;
    width: 100%;
    border-radius: 5px 5px 0 0;
    overflow: hidden;
}
.main-box .top-banner .logo {
    padding-top: 6px;
    text-align: center;
    color: #ffffff;
}
.main-box .top-banner .logo img {
    /*margin-top: 10px;*/
    height: 80px;
}
.main-box .top-banner .logo span {
    /*padding-bottom: 2px;*/
    /*display: block;*/
    height: 80px;
    padding-top: 5px;
    /*line-height: 80px;*/
    margin-top: 5px;
    font-size: 40px;
    font-weight: bold;
}

.main-box .login-wrap {
    width: 100%;
    height: auto;
    padding: 26px 40px;
}
.main-box .login-wrap .form-group {
    padding: 8px;

}
.main-box .login-wrap .form-group .icon {
    width: 20px;
    height: 40px;
    float: left;
    margin: 6px 14px 0 0;
}
.main-box .login-wrap .form-group .icon span {
    font-size: 26px;
    color:rgba(53, 174, 194, 0.94);
}
.main-box .login-wrap .form-group .ipt {
    /*width: 172px;*/
    height: 40px;
}

.main-box .login-wrap .form-group .ipt input {
    width: 300px;
    height: 40px;
}

.main-box .login-wrap .btn-group {
    padding-top: 6px;
    /*padding-bottom: 8px;*/
}

.main-box .login-wrap .btn-group button {
    border-radius: 3px;
    height: 40px;
    width: 300px;
    margin-left: 40px;
    font-weight: 20px;
    font-size: 20px;
}

</style>
   <div class="main-box">
       <div class="top-banner">
           <div class="logo">
                <span class="left">菇友</span>
               <img src="<?php echo base_url('public/img/logo.png')?>" alt="">
               <span class="right">后台</span>
           </div>
       </div>
       <div class="login-wrap">
           <div class="form-group">
                <div class="icon">
                     <span class="fa fa-user"></span>
                </div>
               <div class="input-group ipt">
                   <input id="username" type="text" placeholder="请输入管理员账户" class="form-control">
               </div>
           </div>
           <div class="form-group">
                <div class="icon">
                     <span class="fa fa-lock"></span>
                </div>
               <div class="input-group ipt">
                   <input id="password" type="password" placeholder="请输入密码" class="form-control">
               </div>
           </div>
           <div class="btn-group">
                <button id="loginBtn" class="btn btn-primary">登录</button>
           </div>
       </div>
   </div>
   <script src="<?php echo base_url('public/admin/js/bootstrap.min.js');?>"></script>
   <script type="text/javascript">
       $(function(){
            $('#loginBtn').on('click', function(){
                var logini = layer.load();
                $.post("<?php echo site_url('admin/Login/login')?>", {username:$('#username').val(), password : $('#password').val()}, function(response){
                    layer.close(logini);
                    if (response.status==1){
                        layer.msg('登录成功，正在转向后台...',{
                            icon:1,
                            time:2000
                        },function(){
                            location.href = "<?php echo site_url('admin/Home')?>";
                        })
                    }else if(response.status==2){
                        $('#password').focus();
                        layer.tips('密码不能为空', '#password', {
                            tips: 1
                        });
                    }else if(response.status==3){
                        $('#username').focus();
                        layer.tips('用户名不能为空', '#username', {
                            tips: 3
                        });
                    }else{
                        layer.msg(response.errmsg,{
                            // title:'错误提示(2秒后关闭)',
                            icon:2,
                            time:3000
                        });
                    }
                })
            })
       })
   </script>
</body>
</html>