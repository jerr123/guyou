<style type="text/css">
    table tr td {
        height:48px;
    }
     table tr td.allow-alter span:hover {
        /*cursor:text;*/
    }
    #temp{
        width: 90%;
        margin:0;
    }
</style>
        <!-- /. NAV SIDE  -->
<div id="page-wrapper" >
    <div id="page-inner">
		<div class="row">
            <div class="col-md-12">
                <h3 class="page-header">
                    &nbsp;常用配置设置 <small>双击进行编辑</small>
                </h3>
            </div>
        </div> 
                 <!-- /. ROW  -->
               
    <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div style="width:90%" class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <!-- <div class="form-inline"> -->
                                <div style="margin-bottom:10px;" class="row">
                                
                                
                                    <div class="col-xs-1 arrow">
                                        <div class="input-group">
                                           <!-- <button class="btn btn-success btn-xs"><i class="fa fa-plus">&nbsp;新增</i></button> -->
                                       </div>
                                   </div>
                                </div>
                                    
                                <!-- </div> -->
                                <table class="table table-striped table-bordered table-hover os-table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>字段</th>
                                            <th>配置名</th>
                                            <th>配置值</th>
                                            <!-- <th>操作</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($data as $k => $v): ?>
                                        <tr>
                                            <td><?php echo $v['config_id']; ?> </td>
                                            <td width="20%"><?php echo $v['field_code']; ?></td>
                                            <td  width="35%"> 
                                                <?php echo $v['field_name'] ?>
                                            </td>
                                            <?php if ($v['field_code']=='alipayQRCode'): ?>
                                                <td data-imgurl="<?php echo $v['field_value'] ?>" data-id="<?php echo $v['config_id'] ?>" data-title="<div style='background-color:#fff;width:260px;margin-left:-8px;margin-top:-3px;margin-bottom:-3px;'><img src='<?php echo $v['field_value']?>' alter='扫描二维码转账' > </div>" width="30%" id="alipayQRCode"> 
                                                    <?php echo $v['field_value'] ?>
                                                    <button id="alterAlipaQRCode" class="btn btn-primary btn-xs">修改</button>
                                                </td>
                                            <?php else: ?>
                                                <td data-url="<?php echo site_url('admin/Home/alterConfig').'?id='.$v['config_id'] ?>" data-id="<?php echo $v['config_id'] ?>" data-toggle="tooltip" width="40%" class="allow-alter"> <?php echo $v['field_value'] ?></td>
                                            <?php endif ?>
                                            
                                            
                                            <!-- <td></td> -->
                                        </tr>
                                    <?php endforeach ?>
                                    </tbody>
                                </table>
                                
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
        $(function () { 
            $("[data-toggle='tooltip']").tooltip({container:'div.table-responsive',placement:'bottom',title:'双击进行编辑'});
            $('#alipayQRCode').tooltip({container:'div.table-responsive',html:true})
        });
        $('td.allow-alter').on('dblclick',function(){
            var input ="<input type='text' class='form-control input-sm' id='temp' value="+$(this).text()+" >"; 
            $(this).text(""); 
            $(this).html(input); 
            $("input#temp").focus();
            var url = $(this).data('url');
            $("input#temp").blur(function(){
                var ipt = $(this);
                if($(this).val()==""){ 
                    $(this).remove(); 
                }else{
                    var param = {
                        value:$(this).val()
                    }
                    var ii = layer.load();
                    $.post(url, param, function(data){
                        layer.close(ii);
                        var rs = JSON.parse(data);
                        if (rs.status==1){
                            ipt.closest("td").text(ipt.val());
                        }else{
                            //
                        }
                    })
                     
                }
            })
        });
        $("#alterAlipaQRCode").on('click', function(){
            var qrload = layer.load();
            $.get("<?php echo site_url('admin/ajaxPage/alterQRcode')?>"+'?id='+$('#alipayQRCode').data('id')+'&img='+$('#alipayQRCode').data('imgurl'), function(data){
                layer.close(qrload);
                layer.open({
                    title:'修改支付宝转账二维码',
                    area: ['400px', '360px'],
                    content :data
                })
            })
            
        })
        
    </script>