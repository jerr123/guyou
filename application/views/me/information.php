<style type="text/css">
  .info_preview ul li{
    list-style:none;
}
.info_preview {
    padding-top: 8px;
}
.info_preview .preview_title {
    
    text-align: right;
    padding-left:30px;
    border-bottom: 1px solid #ccc;
    
}
.info_preview .preview_title h4 {
    width: 5em;
    padding: 0;
    margin: 10px 0;
}

.info_preview .preview_list {
    margin: 0;
    padding: 8px 0px 8px 30px;
}   

.info_preview .preview_list li {
    margin: 8px 0;
    padding: 0;
    font-size: 15px;
}

.info_preview .preview_list li label {
    text-align: right;
    display: inline-block;
    width: 6em;
}
.info_preview .preview_list .preview_option {
    display: inline-block;
    text-indent: 0.8em;
}
.info_preview .preview_list .preview_option a {
    text-decoration: none;
    color: #555;
}
.info_preview .preview_list .preview_option a:hover {
    text-decoration: underline;
    color: #82C59E;
}
.preview_list li:after {
    content: "";
    height: 0;
    visibility: hidden;
}
</style>
<div class="container">
    <div class="info_preview">
        <div class="preview_title"><h4>基本资料</h4></div>

        <ul class="preview_list">
           <li id="sex_li"><label>性别：</label><div id="sex" class="preview_option"><?php echo isset($user_sex) ? ($user_sex==1?'男':'女') : ''?></div></li>
           <li id="age_li"><label>昵称：</label><div id="age" class="preview_option"><?php echo isset($user_nick) ? $user_nick : "" ?></div></li>
           <li id="age_li"><label>手机：</label><div id="age" class="preview_option"><?php echo isset($user_mobile) ? $user_mobile : "" ?></div></li>
           <li id="astro_li"><label>星座：</label><div id="astro" class="preview_option"><?php echo isset($user_star) ? $user_star : "" ?></div></li>
           <li id="live_address_li"><label>现居于：</label><div id="age" class="preview_option"><?php echo isset($user_address) ? $user_address : "" ?></div></li>
           <li id="birthday_li"><label>开户银行：</label><div id="birthday" class="preview_option"><?php echo isset($bank_name) ? $bank_name : "" ?></div></li>
            <li><label>开户人：</label><div class="preview_option"><?php echo isset($bank_user_name) ? $bank_user_name : '' ?></div></li>
            <li>
              <label>银行卡卡号：</label>
              <div class="preview_option"><?php echo isset($bank_no) ? $bank_no : '' ?></div>
            </li>
            <li>
              <label>绑定时间：</label>
              <div class="preview_option"><?php echo isset($bank_addtime) ? $bank_addtime : '' ?></div>
            </li>
            <li>
              <label>注册时间：</label>
              <div class="preview_option"><?php echo isset($bank_addtime) ? $bank_addtime : '' ?></div>
            </li>
            <li>
              <label>推介人：</label>
              <div class="preview_option">
                <a href=""><?php echo isset($rnick) ? $rnick : ''  ?></a></div>
            </li>
        </ul>

    </div>
</div>
