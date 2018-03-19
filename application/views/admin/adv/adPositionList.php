        <!-- /. NAV SIDE  -->
<div id="page-wrapper" >
    <div id="page-inner">
		<div class="row">
            <div class="col-md-12">
                <h3 class="page-header">
                    &nbsp;广告位 <small>所有广告位</small>
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
                                <div class="col-sm-2">
                                    <input class="form-control input-sm form-datetime" type="text">
                                </div>
                                <div class="col-md-offset-5 col-xs-2">
                                        <select id="seek" name="seek" class="form-control input-sm">
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
                                            <th>ID</th>
                                            <th>名称</th>
                                            <!-- <th>描述</th> -->
                                            <th>状态</th>
                                            <th>广告图片</th>
                                            <th>联系人</th>
                                            <th>手机</th>
                                            <th>开始时间</th>
                                            <th>结束时间</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($data as $k => $v): ?>
                                        <tr>
                                            <td><?php echo $v['adv_id']; ?> </td>
                                            <td> <?php echo $v['advp_name']; ?></td>
                                            <!-- <td> <?php echo $v['advp_des'] ?></td> -->
                                            <td> <!-- 广告 状态 -->
                                             <?php if ($v['adv_state']==1){?>
                                                可用
                                             <?php }else if($v['adv_state']==2){ ?>
                                                <i style="color:#50D42A;" >广告中</i>
                                             <?php }else if($v['adv_state']==3){ ?>
                                                <i style="color:#DA3D36;">广告停用</i>
                                                
                                             <?php }else if($v['adv_state']==4){ ?>
                                                <i style="color:#D4D42A;" >停用</i>
                                                
                                             <?php } ?>
                                            </td>
                                            <td>
                                             <?php if ($v['adv_img']==''): ?>
                                                <span style="color:rgba(110,110,110,0.5)">空</span>
                                             <?php else: ?>
                                                <img class="adv-img-thumb" data-toggle="tooltip" title="<img width='<?php echo $v['advp_width'] ?>' height='<?php echo $v['advp_height'] ?>' src='<?php echo $v['adv_img'] ?>'>" style="height:22px;" src="<?php echo $v['adv_img'] ?>">
                                             <?php endif ?>
                                            </td>
                                            <td> <?php echo $v['advertiser_name'] ?></td>
                                            <td> <?php echo $v['advertiser_mobile'] ?></td>
                                            <td> <?php echo $v['adv_start'] ?></td>
                                            <td> <?php echo $v['adv_end'] ?></td>
                                            <td>
                                                <?php if ($v['adv_state']==2){ ?>
                                                    <button class="btn btn-danger btn-xs" onclick="javascript:advStop( <?php echo $v['adv_id'] ?>)">停用</button>
                                                <?php }else if($v['adv_state']==3){?>
                                                    <button class="btn btn-success btn-xs" onclick="javascript:advStart( <?php echo $v['adv_id'] ?>)">启用</button>
                                                <?php } ?>
                                                <button class="btn btn-warning btn-xs" onclick="javascript:advReset( <?php echo $v['adv_id'] ?>)"><i class="fa fa-trash-o"></i></button>
                                                <a href="<?php echo site_url('admin/Adv/advEdit').'?id='.$v['adv_id'];?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
                                            </td>
                                            <!-- <td></td> -->
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
    <link href="<?php echo base_url('public/admin/plugins/datetimepicker/datetimepicker.css')?>" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?php echo base_url('public/admin/plugins/datetimepicker/datetimepicker.min.js')?>"></script>
    <script type="text/javascript">
        $(function(){
            $('.adv-img-thumb').tooltip({html:true});
        })
        $('.form-datetime').datetimepicker({
            language: "zh-CN",
            autoclose: true,
            format: 'yyyy-mm-dd hh:ii'
        });

        //停用
        function advStop (id) {
            $.post("<?php echo site_url('admin/Adv/advStop') ?>"+'?id='+id,function(data){
                var rs = JSON.parse(data);
                if (rs.status=1){
                    layer.open({
                        title:'提示',
                        content: '停用成功',
                        yes: function(index, layero){
                            location.reload();
                        }
                    });
                }else{
                    layer.open({
                      title: '操作失败',
                      content: rs.errmsg
                  });  
                }
            })
        }

        //启用
        function advStart (id) {
            $.post("<?php echo site_url('admin/Adv/advStart') ?>"+'?id='+id,function(data){
                var rs = JSON.parse(data);
                if (rs.status=1){
                    layer.open({
                        title:'提示',
                        content: '启用成功',
                        yes: function(index, layero){
                            location.reload();
                        }
                    });
                }else{
                    layer.open({
                      title: '操作失败',
                      content: rs.errmsg
                  });
                }
            })
        }

        /** 重置 */
        function advReset (id) {
            $.post("<?php echo site_url('admin/Adv/advReset') ?>"+'?id='+id,function(data){
                var rs = JSON.parse(data);
                if (rs.status=1){
                    layer.open({
                        title:'提示',
                        content: '重置成功',
                        yes: function(index, layero){
                            location.reload();
                        }
                    });
                }else{
                    layer.open({
                      title: '操作失败',
                      content: rs.errmsg
                  });
                }
            })
        }
    </script>