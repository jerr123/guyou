        <!-- /. NAV SIDE  -->
<div id="page-wrapper" >
    <div id="page-inner">
		<div class="row">
            <div class="col-md-12">
                <h3 class="page-header">
                    &nbsp;会员列表 <small>所有用户</small>
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
                                <!-- <div class="form-inline"> -->
                                <div style="margin-bottom:10px;" class="row">
                                <div class="col-md-offset-7 col-xs-2">
                                        <select id="seek" name="seek" class="form-control input-xs">
                                            <option value="0" selected="">查询方式</option>
                                            <option value="1">UID</option>
                                            <option value="2">昵称</option>
                                            <option value="3">邮箱</option>
                                            <option value="4">手机号</option>
                                        </select>
                                        <input name="seek" value="0" type="hidden">
                                    </div>
                                    <div class="col-xs-3 arrow">
                                        <div class="input-group">
                                           <input class="form-control input-sm" type="text">
                                           <span class="input-group-addon btn btn-default btn-xs"><i class="glyphicon glyphicon-search"></i></span>   
                                       </div>
                                   </div>
                                </div>
                                    
                                <!-- </div> -->
                                <table class="table table-striped table-bordered table-hover os-table">
                                    <thead>
                                        <tr>
                                            <th>用户ID</th>
                                            <th>手机号</th>
                                            <th>昵称</th>
                                            <th>邮箱</th>
                                            <th>会员等级</th>
                                            <th>最后登录时间</th>
                                            <th>最后登录ip</th>
                                            <th>状态</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($data as $k => $v): ?>
                                        <tr>
                                            <td><?php echo $v['user_id']; ?> </td>
                                            <td> <?php echo $v['user_mobile']; ?></td>
                                            <td> <?php echo $v['user_nick'] ?></td>
                                            <td> <?php echo $v['user_email']; ?></td>
                                            <td> <!-- 会员等级 -->
                                             <?php if ($v['user_level']==1){?>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                             <?php }else if($v['user_level']==2){ ?>
                                                <i style="color:#D4D42A;" class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                             <?php }else if($v['user_level']==3){ ?>
                                                <i style="color:#D4D42A;" class="fa fa-star"></i>
                                                <i style="color:#D4D42A;" class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                             <?php }else if($v['user_level']==4){ ?>
                                                <i style="color:#D4D42A;" class="fa fa-star"></i>
                                                <i style="color:#D4D42A;" class="fa fa-star"></i>
                                                <i style="color:#D4D42A;" class="fa fa-star"></i>
                                             <?php } ?>
                                            </td>
                                            <td> <?php echo $v['user_lastlogin'] ?></td>
                                            <td> <?php echo $v['user_lastip'] ?></td>
                                            <td>
                                                <?php if ($v['user_state']==1): ?>
                                                    <i style="color:green;" class="fa fa-check"></i>
                                                    <?php else: ?>
                                                    <i style="color:red;" class="fa fa-close"></i>
                                                <?php endif ?>
                                            </td>
                                            <td>
                                                <?php if ($v['user_state']==1): ?>
                                                    <button onclick="javascript:stopUser(<?php echo $v['user_id']?>)" class="btn btn-danger btn-xs">禁用</button>
                                                <?php else: ?>
                                                    <button onclick="javascript:startUser(<?php echo $v['user_id'] ?>)" class="btn btn-success btn-xs">启用</button>
                                                <?php endif ?>
                                                <button onclick="javascript:del(<?php echo $v['user_id']?>)" class="btn btn-warning btn-xs">删除</button>
                                                <button onclick="javascript:resetPass(<?php echo $v['user_id']?>)" class="btn btn-primary btn-xs">重置密码</button>
                                            </td>
                                            <!-- <td></td> -->
                                        </tr>
                                    <?php endforeach ?>
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div aria-relevant="all" aria-live="polite" role="alert" id="dataTables-example_info" class="dataTables_info">一共<?php echo $info['total'] ?>条数据，每页显示<?php echo $info['per_page'] ?>条，一共 <?php echo $info['total_page'] ?>页</div>
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

    /** 停用 */
    function stopUser (id) {
        var stopi = layer.load();
        $.post("<?php echo site_url('admin/User/stopUser')?>", {user_id:id}, function(data){
            layer.close(stopi);
            if (data.status==1){
                layer.alert('操作成功',function(){
                    location.reload();
                })
            }else{
                layer.alert('操作失败',{title:'提示信息'});
            }
        })
    }
    /** 启用 */
    function startUser (id) {
        var stopi = layer.load();
        $.post("<?php echo site_url('admin/User/startUser')?>", {user_id:id}, function(data){
            layer.close(stopi);
            if (data.status==1){
                layer.alert('操作成功',{title:'启用用户提示'},function(){
                    location.reload();
                })
            }else{
                layer.alert('操作失败',{title:'启用用户提示'});
            }
        })
    }
    /** 删除 */
    function del (id) {
        var stopi = layer.load();
        layer.confirm('确定要删除该项吗？请谨慎操作',{title:'删除'},function(){
            $.post("<?php echo site_url('admin/User/del')?>", {user_id:id}, function(data){
                layer.close(stopi);
                if (data.status==1){
                    layer.alert('操作成功',function(){
                        location.reload();
                    })
                }else{
                    layer.alert('操作失败',{title:'提示信息'});
                }
            })
        })
        
    }
    /** 重置密码 */
    function resetPass (id) {
        var stopi = layer.load();
        $.post("<?php echo site_url('admin/User/resetPass')?>", {user_id:id}, function(data){
            layer.close(stopi);
            if (data.status==1){
                layer.alert('操作成功',function(){
                    location.reload();
                })
            }else{
                layer.alert('操作失败',{title:'提示信息'});
            }
        })
    }

</script>