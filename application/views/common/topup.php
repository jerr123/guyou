<input id="pointNum" type="hidden" value="<?php echo $randPoint?>">
<div class="container">
	<div class="topup-container">
        <div class="topup-contro">
            <a href="#javascript" class="hushubao on1">支付宝充值</a>
            <a href="#javascript" class="chongzhika on">银行卡充值</a>
        </div>
    <div id="hushubao">
               
        <!--下一步的按钮-->
        <div class="next-btn">
            <a id="nextBtnAlipay" href="javascript:void(0)">下一步</a>
        </div>
                <div class="topup-form" >
            <div class="form-row">
				<label>支付宝账户</label>
				<div class="form-input">
					<input id="alipay" type="text" name="" placeholder="支付宝账户">
				</div>
				<p>*请认真确认支付宝账号</p>
			</div>
			<div class="form-row">
				<label>充值金额</label>
				<div class="form-input">
					<input id="alipayMoney" type="text" name="" placeholder="最低充值100￥">
					<span>.<?php echo $randPoint?></span>
				</div>
				<p>*请严格按照上述金额汇款，包括<i>.<?php echo $randPoint?></i></p>
				
			</div>
			<div class="form-row">
				<label>联系手机</label>
				<div class="form-input">
					<input id="alipayMobile" type="text" name="" placeholder="方便客服联系">
				</div>
				
			</div>
			<div class="form-row">
				<label>预计到账时间</label>
				<h5>20分钟</h5>
				
			</div>
			
        </div>
    </div>
       
     <!--充值卡部分-->
        <div id="chongzhika">
                          
        <!--下一步的按钮-->
        <div class="next-btn">
            <a id="nextBtnBank" href="javascript:void(0)">下一步</a>
        </div>
            <div class="card-form" >
            <div class="form-row">
                <label>汇款姓名</label>
                <div class="form-input">
                    <input id="remitName" type="text" name="" placeholder="汇款姓名">
                </div>
                <p>*请认真确认汇款姓名</p>
            </div>
            <!-- <div class="form-row"> 
				<label>银行卡账户</label>
				<div class="form-input">
					<input id="bankNo" type="text" name="" placeholder="充值银行卡号">
				</div>
				<p>*请认真确认银行卡账号</p>
			</div>
            -->
			<div class="form-row">
				<label>充值金额</label>
				<div class="form-input">
					<input id="bankMoney" type="text" name="" placeholder="最低充值100￥">
					<span>.<?php echo $randPoint?></span>
				</div>
				<p>*请严格按照上述金额汇款，包括<i>.<?php echo $randPoint?></i></p>
				
			</div>
			<div class="form-row">
				<label>联系手机</label>
				<div class="form-input">
					<input id="bankMobile" type="text" name="" placeholder="方便客服联系">
				</div>
				
			</div>
			<div class="form-row">
				<label>预计到账时间</label>
				<h5>20分钟</h5>
				
			</div>
			
        </div>
        </div>

        <div class="topuo-record">
           <h2><b>充值记录</b></h2>
            <div class="box-list">
               <table >
                    <thead>
                        <tr>
                            <th>充值ID</th>   
                            <th>充值时间</th>   
                            <th>金额</th>   
                            <th class="">实付金额</th>   
                            <th>转账备注</th>   
                            <th>充值状态</th>   
                            <th>操作</th>   
                        </tr>
                    </thead>
                    <tbody id="records-list-body">
                        <tr>
                            <td>123456</td>
                            <td>123456</td>
                            <td>12345</td>
                            <td>1000</td>
                            <td>184468</td>
                            <td><span>在路上</span></td>
                            <td><a href="#javascript">查看</a></td>
                        </tr>
                      
                        <tr>
                            <td>123456</td>
                            <td>123456</td>
                            <td>12345</td>
                            <td>1000</td>
                            <td>184468</td>
                            <td><span>在路上</span></td>
                            <td><a href="#javascript">查看</a></td>
                        </tr>
                        <tr>
                            <td>123456</td>
                            <td>123456</td>
                            <td>12345</td>
                            <td>1000</td>
                            <td>184468</td>
                            <td><span>在路上</span></td>
                            <td><a href="#javascript">查看</a></td>
                        </tr>
                     
                         <tr>
                            <td>123456</td>
                            <td>123456</td>
                            <td>12345</td>
                            <td>1000</td>
                            <td>184468</td>
                            <td><span>在路上</span></td>
                            <td><a href="#javascript">查看</a></td>
                         </tr>
                         <tr>
                            <td>123456</td>
                            <td>123456</td>
                            <td>12345</td>
                            <td>1000</td>
                            <td>184468</td>
                            <td><span>在路上</span></td>
                            <td><a href="#javascript">查看</a></td>
                         </tr>
                 
                    </tbody>
                </table>
                <div class="record-btn">
                    <a id="record-prev" href="javascript:void(0)">上一页</a>
                    <a id="record-next" href="javascript:void(0)">下一页</a>
                </div>
            </div>
        </div>
	</div>

</div>


<span id="urls" data-baseurl="<?php echo site_url('Ajax') ?>" data-innerpage="<?php echo site_url('Innerpage') ?>" hidden="hidden"></span>