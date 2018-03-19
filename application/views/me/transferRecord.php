<style type="text/css">
.tr_box table{
    margin:30px auto;
    border-collapse: collapse;
}

.tr_box #search-box{
        /*background:#dddada;*/
    width:830px;
    margin:0 auto;
}

#search-box .search-input {
    font-size: 12px;
    line-height: 12px;
    padding: 5px 10px;
    margin: 0;
    outline: none;
}

#search-box .search-input:focus {
    border-color: rgba(110,77,50,1);
}

#title td{
    
    background-color:#F2F2F2;
    text-align:center;
    color:#0f0101;
    font-size:14px;
}

.tr_box table tr:nth-child(odd) {
    background-color: #efebeb;    
}
.tr_box table tr td{
    padding: 5px;
    border:1px solid #e6dada;
    height:30px;
    text-align:center;
    color:#191111;
    font-size:12px;
}

.tr_box table tr td:last-child {
    text-align: left;
}

#title .number{
    /*width:50px;*/
}
#title .put-in{
    /*width:180px;*/
}
#title .put-out{
    /*width:180px;*/
}
#title .detail-info{
    /*width:300px;*/
}

#tsf-search-btn {
    
    padding: 5px 20px;
    font-size: 14px;
}

.pagination-con {

}

.pagination-con .pagination {
    overflow: hidden;
    /*background-color: red;*/
    margin: 0 auto;
    padding: 0;
    list-style: none;
    text-align: center;
}

.pagination-con .pagination  li {
    display: inline-block;
    margin: 0 5px;
}

.pagination-con .pagination  li.active a {
    color: #F7AF57;
}

.pagination-con .pagination a {
    display: block;
    font-size: 14px;
    text-decoration: none;
    color: #777;
}

.pagination-con .pagination a:hover {
    border-bottom: 1px solid #999;
    color: #222;
}


</style>
<!-- 加载laydate -->
<script src="<?php echo base_url('public/lib/laydate/laydate.js')?>"></script>
<div class="tr_container">
    <div class="tr_box">
       <div id="search-box">
           <span style="font-size: 14px;">请输入查询已有账单的时间区间：</span>
           <input id="startDate" onclick="laydate()" class="s-date search-input form-datetime" type="text" placeholder="2016-7-1" value="<?php echo $info['startDate'] ?>"> <i class="fa fa-long-arrow-right"></i>
           <input id="endDate" onclick="laydate()" class="s-date search-input form-datetime" type="text" value="<?php echo $info['endDate'] ?>" placeholder="2016-8-1">
           <button id="tsf-search-btn" class="btn btn-info" type="button">查询</button>
       </div>
        
        <table id="table1" style="margin-top: 10px">
            <tr id="title">
                <td width="5%" class="number">编号</td>
                <td width="15%" >日期</td>
                <td width="10%">账单类型</td>
                <td width="12%">数量</td>
                <td width="10%" class="put-in">进入</td>
                <td width="10%" class="put-out">来自</td>
                <td width="33%" class="detail-info">备注</td>
            </tr>
            <?php foreach ($data as $k => $v): ?>
                <tr>
                <td><?php echo $k+1 ?></td>
                    <td><?php echo $v['bill_addtime'] ?></td>
                    <?php if ($v['bill_type']==1){?>
                        <td>充值</td>
                    <?php }else if($v['bill_type']==2){?>
                        <td>发红包</td>
                    <?php }else if($v['bill_type']==3){?>
                        <td>收益</td>
                    <?php }else if($v['bill_type']==4){?>
                        <td>转账</td>
                    <?php }else if($v['bill_type']==5){?>
                        <td>提现</td>
                    <?php }else if($v['bill_type']==6){?>
                        <td>开通会员</td>
                    <?php }?>
                    <td>
                    <?php 
                        if ($v['bill_type']==1 || $v['bill_type']==3){
                            $str = '+'.$v['bill_amount'];
                            if ($v['bill_currency']==1) {
                                $str .= 'b币';
                            }else if ($v['bill_currency']==2){
                                $str .= '钻石';
                            }else if ($v['bill_currency']==3){
                                $str .= '积分';
                            }
                            echo $str;
                        }
                    ?>
                    <td><?php echo $v['tnick'] ?></td>
                    <td><?php echo $v['fnick'] ?></td>
                    <td><?php echo $v['bill_remark'] ?></td>
                </tr>
            <?php endforeach ?>
                                           
        </table>
    </div>
    <div class="pagination-con">
        <ul id="record-pagination" class="pagination">
            <?php echo $page ?>
        </ul>
    </div>
</div>
<input type="hidden" id="tsr-per-page" value="<?php echo $info['per_page']?>">
<!-- 加载日期选择器 -->

<script type="text/javascript">
    $(function(){
        $('.pagination-con a').attr("href", "javascript:void(0)");
    })
</script>