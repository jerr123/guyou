<div id="page-wrapper" >
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h3 class="page-header">
                    &nbsp;管理员信息 <small></small>
                </h3>
            </div>
        </div> 
            <div class="row">
                <div class="col-md-6">
                     <!--    Hover Rows  -->
                    <div class="panel panel-default">
                       
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-stripebd table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>用户名：</td>
                                            <td rowspan="1"><?php echo $data['admin_name'] ?></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>密码：</td>
                                            <td clospan="2">
                                                <button id="alter-pass" class="btn btn-primary btn-xs">修改密码</button>
                                            </td>
                                            
                                        </tr>
                                        <tr>
                                            <td>添加时间：</td>
                                            <td rowspan="1"><?php echo $data['admin_addtime'] ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- End  Hover Rows  -->
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
    $(function(){
        $('#alter-pass').on('click', function(){
            $.get("<?php echo site_url('admin/AjaxPage/alterPass')?>", function(rs){
                layer.open({
                    type : 1,
                    title : '修改密码',
                    shadeClose : true,
                    //area : '360px',
                    content : rs
                })
            })
        })
    })
</script>