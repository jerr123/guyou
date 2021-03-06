        <!-- /. NAV SIDE  -->
        <style>
            .green{
                color: green;
            }
        </style>

<div id="page-wrapper" >
    <div id="page-inner">
		<div class="row">
            <div class="col-md-12">
                <h3 class="page-header">
                    &nbsp;充值单记录 <small></small>
                </h3>
            </div>
        </div> 
                 <!-- /. ROW  -->
               
    <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <form action="<?php echo site_url('admin/User/topupList')?>" method="post">
                                <div style="margin-bottom:10px;" class="row">
                                <div class="col-md-offset-7 col-xs-2">
                                        <select id="seek"  class="form-control input-sm">
                                            <option value="0" selected="">查询方式</option>
                                            <!-- <option value="1">ID</option> -->
                                            <option value="unick">昵称</option>
                                            <!-- <option value="3">邮箱</option> -->
                                            <option value="umobile">手机号</option>
                                        </select>
                                        
                                    </div>
                                    <div class="col-xs-3 arrow">
                                        <div class="input-group">
                                           <input class="form-control input-sm" id="search-key" name="searchKey" type="text">
                                           <span id="search-btn" class="input-group-addon btn btn-default btn-xs"><i class="glyphicon glyphicon-search"></i></span>   
                                       </div>
                                   </div>
                                   <input id="sub-btn" type="submit" hidden="hidden">
                                </div>
                                </form>
                                <table class="table table-striped table-bordered table-hover os-table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>用户昵称</th>
                                            <!-- <th>描述</th> -->
                                            <th>账号(手机)</th>
                                            <th>开户银行</th>
                                            <th>开户人</th>
                                            <th>银行卡号</th>
                                            <th>提现金额</th>
                                            <th>提现添加时间</th>
                                            <th>状态</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($data as $k => $v): ?>
                                        <tr id="tr_<?php echo $v['to_cash_id'] ?>">
                                            <td><?php echo $v['to_cash_id']; ?> </td>
                                            <td> <?php echo $v['user_nick']; ?></td>
                                            <td> <?php echo $v['user_mobile'] ?></td>
                                            <td> <?php echo $v['bank_name']; ?></td>
                                            <td> <?php echo $v['bank_user_name']; ?></td>
                                            <td> <?php echo $v['bank_no']; ?></td>
                                            <td> <?php echo $v['b_icon_num'] ?></td>
                                            <td> <?php echo $v['to_cash_addtime'] ?></td>
                                            
                                            <td class="green">
                                                <?php if ($v['to_cash_state']==1): ?>
                                                    <span>待处理</span>
                                                <?php else: ?>
                                                    <span>提现成功</span>
                                                <?php endif ?>
                                            </td>
                                            
                                            <td>
                                                <button onclick="javascript:cashSuccess(<?php echo $v['to_cash_id']?>)" class="btn btn-primary btn-xs">确认提现成功</button>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div aria-relevant="all" aria-live="polite" role="alert" id="dataTables-example_info" class="dataTables_info">一共<?php echo $info['total'] ?>条数据，每页显示<?php echo $info['per_page'] ?>条，共 <?php echo $info['total_page'] ?>页</div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div id="dataTables-example_paginate" class="dataTables_paginate paging_simple_numbers">
                                            <ul class="pagination">
                                                <?php echo $page ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
                <!-- /. ROW  -->
        </div>
    </div>
    
<script type="text/javascript">
    $(function(){

        /** 绑定搜索切换事件 */
       $('#seek').on('change', function () {
            $('#search-key').attr("name", $(this).val());
       })

       /** 搜索按钮点击事件绑定 */
       $('#search-btn').on('click', function(){
            $('#sub-btn').click();
       })
    })
    /** 确认提现操作 */
        function cashSuccess(id){
            var i = layer.load();
            $.post("<?php echo site_url('admin/Home/cashSuccess')?>",{
                id : id
            }, function(data){
                layer.close(i);
                if (data.status!=1){
                    layer.msg(data.errmsg,{
                        icon : 2
                    })
                    return false;
                }
                layer.msg('操作成功！',{
                    icon : 1
                },function(){
                    location.reload();
                })
            })
        }
</script>