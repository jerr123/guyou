<style>
/*消息头*/
	#info-title{
		width:100%;
	}
	#info-title span{
		color:#093665;
		font-weight: bold;
		font-size:18px;
	}
	#info-title b{
		color:black;
		font-size:16px;
		font-weight:normal;
	}

/*消息头结束	*/

/*按钮菜单*/
#btn-bar{
	margin-top:20px;
	height:40px;
	background-color: #C1D9F3;
	padding: 10px;
}
#btn-bar button{
	border:1px solid #C1D9F3;
	width:150px;
	height:25px;
	border-radius: 5px;
	background:#99CC33;
	color:white;
	font-weight: normal;
	font-size:14px;
}
#btn-bar .trans{
	width:100px;
}
#btn-bar button:hover{
	cursor: pointer;
	background:#fff;
	color:#99CC33;
	border:1px solid #99CC33;
}
/*按钮菜单结束*/

/*未读消息*/

/*标题头部*/
#info-con .tr-header{
	background: #F2F4F6;
	font-weight: normal;
	font-size:12px;
	height:25px;
	color:black;
}
#info-con .tr-header .info-logo{
	width:60px;
	text-align: center;
	color:black;
}
#info-con .tr-header .send-person{
	width:220px;
}
#info-con .tr-header .theme{
	width:400px;
}
#info-con .tr-header .time{
	width:200px;
}
/*标题头部结束*/

/*表格内容*/
#info-con .tr-con{
	background: white;
	font-weight: bold;
	font-size:12px;
	height:25px;
	color:black;
}
#info-con .tr-con .info-logo{
	width:60px;
	text-align: center;
	color:black;
}
#info-con .tr-con .send-person{
	width:220px;
}
#info-con .tr-con .theme{
	width:400px;
}
#info-con .tr-con .theme .inner-div{
	width: 400px;
	height:20px;
	overflow: hidden;
	white-space:nowrap;/*处理元素内的空白，比如空格，使得在一行显示，不换行  */
	text-overflow:ellipsis; 
}
#info-con .tr-con .theme .inner-div a{
	text-decoration: none;
	color:black;
}
#info-con .tr-con .theme .inner-div a:hover{
	color:blue;
}
#info-con .tr-con .time{
	width:200px;
}
/*表格内容结束*/
#info-con table tr td{
	text-align: center;
	border-bottom:1px solid #F2F4F6;
}
#info-con table tr:hover{
	background: #F2F4F6;
}
/*未读消息结束*/

.pagination {
	margin: 2px 0;
	white-space: nowrap;
	display: inline-block;
	padding-left: 0;
	/* margin: 20px 0; */
	border-radius: 4px;
}
.pagination > li {
    display: inline;
}
.pagination > li:first-child > a, .pagination > li:first-child > span {
    margin-left: 0;
    border-top-left-radius: 4px;
    border-bottom-left-radius: 4px;
}
.pagination > .active > a, .pagination > .active > span, .pagination > .active > a:hover, .pagination > .active > span:hover, .pagination > .active > a:focus, .pagination > .active > span:focus {
    z-index: 2;
    color: #fff;
    cursor: default;
    background-color: #428bca;
    border-color: #428bca;
}
.pagination > li > a, .pagination > li > span {
    position: relative;
    float: left;
    padding: 6px 12px;
    margin-left: -1px;
    line-height: 1.42857143;
    color: #428bca;
    text-decoration: none;
    background-color: #fff;
    border: 1px solid #ddd;
}
.pagination > li > a, .pagination > li > span {
    position: relative;
    float: left;
    padding: 6px 12px;
    margin-left: -1px;
    line-height: 1.42857143;
    color: #428bca;
    text-decoration: none;
    background-color: #fff;
    border: 1px solid #ddd;
}
.pagination > li > a:hover, .pagination > li > span:hover, .pagination > li > a:focus, .pagination > li > span:focus {
    color: #2a6496;
    background-color: #eee;
    border-color: #ddd;
}
</style>
<?php //var_dump($data)?>
<div id="info-title">
	<span>个人消息：</span>
	<b>（共<?php echo $unreadNum?>条未读动态消息）</b>
</div>
<div id="btn-bar">
	<!-- <button id="remarkToRead" class="delete">全部标记未已读</button> -->
	<!-- <button class="tans">转发</button> -->
</div>
<div id="info-con">
	<table>
		<tr class="tr-header">
			<th class="info-logo"><i class="fa fa-envelope-o"></i></th>
			<th class="send-person">发件人</th>
			<th class="theme">主题</th>
			<th class="time">时间</th>
		</tr>
		<tbody id="main-info">
			<?php foreach ($data as $k => $v): ?>
				<tr class="tr-con" data-id="<?php echo $v['fri_tx_id'] ?>">
					<td class="info-logo"><i class="fa fa-envelope-o"></i></td>
					<td class="send-person"><?php echo $v['user_nick']?></td>
					<td class="theme"><div class="inner-div"><a class="js-tx-detail" href="javascript:void(0)"><?php echo $v['fri_tx_content'] ?></a></div></td>
					<td class="time"><?php echo $v['fri_tx_addtime'] ?></td>
				</tr>
			<?php endforeach ?>
			<tr>
				<td id="tx" colspan="4">
					<ul class="pagination">
						<?php echo $page ?>
					</ul>
				</td>
			</tr>
		</tbody>
		
	</table>
</div>
<input type="hidden" id="tx-per-page" value="<?php echo $info['per_page'] ?>">
<script type="text/javascript">
	$(function(){
		$('.pagination a').attr("href","javascript:void(0)");

	})
	$('#remarkToRead').on('click', function(){
		$.post("<?php echo site_url('Ajax/txAllToRead')?>", function(response){
			if (response.status==1){
				layer.msg('操作成功',{
					icon : 1
				})
			}else{
				layer.msg(response.errmsg, {
					icon : 4
				})
			}
		})
	})

	//点击弹窗阅读
	$('#main-info').on('click', '.js-tx-detail', function(response){
		var id = $(this).closest('tr').data('id');
		$.post("<?php echo site_url('Innerpage/envelopeRead')?>", {
			id : id
		}, function (response) {
			layer.open({
				type : 1,
				title : '查看消息',
				shadeClose : true,
				area : '700px',
				content : response
			})
		})
	})
</script>