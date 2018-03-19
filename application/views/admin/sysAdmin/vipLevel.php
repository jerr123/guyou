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
                    &nbsp;会员等级设置 <small>双击进行编辑</small>
                </h3>
            </div>
        </div> 
                 <!-- /. ROW  -->
               
    <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div style="width:75%" class="panel panel-default">
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
                                            <th>会员等级</th>
                                            <th>升级所需钻石</th>
                                            <th>红包钻石数</th>
                                            <!-- <th>操作</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($data as $k => $v): ?>
                                        <tr>
                                            <td><?php echo $v['vip_level_id']; ?> </td>
                                            <td width="25%"> <img style="width:20px;" src="<?php echo base_url('public/img/vip_icon/v').($v['vip_level_id']-1).'.png' ?>"><?php echo $v['vip_level_name']; ?></td>
                                            <td data-url="<?php echo site_url('admin/Home/alterVipLevelNeed').'?id='.$v['vip_level_id'] ?>" data-id="<?php echo $v['vip_level_id'] ?>" data-toggle="tooltip"  width="30%" class="allow-alter"> 
                                                <?php echo $v['vip_level_need'] ?>
                                            </td>
                                            <td data-url="<?php echo site_url('admin/Home/alterVipNum').'?id='.$v['vip_level_id'] ?>" data-id="<?php echo $v['vip_level_id'] ?>" data-toggle="tooltip" width="30%" class="allow-alter"> <?php echo $v['red_packet_num'] ?></td>
                                            
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
        $(function () { $("[data-toggle='tooltip']").tooltip({container:'div.table-responsive',placement:'bottom',title:'双击进行编辑'}); });
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
                    $.post(url, param, function(data){
                        var rs = JSON.parse(data);
                        if (rs.status==1){
                            ipt.closest("td").text(ipt.val());
                        }else{
                            //
                        }
                    })
                     
                }
            })
        })
        
    </script>