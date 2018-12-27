<?php /*a:1:{s:73:"D:\phpStudy\PHPTutorial\WWW\admin\application\admins\view\order\index.php";i:1534831006;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="/static/plugins/layui/css/layui.css">
	<script type="text/javascript" src="/static/plugins/layui/layui.js"></script>
	<style type="text/css">
		.header span{background: #009688;margin-left: 30px;padding: 10px;color:#ffffff;}
		.header div{border-bottom: solid 2px #009688;margin-top: 8px;}
		.header button{float: right;margin-top: -5px;}
		.thumb{height: 28px;float: right;border: solid 1px #f0f0f0;padding: 1px;}
		.layui-table td{padding: 4px 10px;}
	</style>
</head>
<body style="padding: 10px;">
	<div class="header">
		<span>订单列表</span>
	</div>
	<div class="layui-form-item" style="margin-top: 10px;">
		<div class="layui-input-inline">
			<input type="text" class="layui-input" value="<?php echo htmlentities($data['wd']); ?>" id="wd" placeholder="请输入订单号搜索">
		</div>
		<button class="layui-btn layui-btn-primary" onclick="searchs()"><i class="layui-icon">&#xe615;</i>搜索</button>
	</div>
	<table class="layui-table">
		<thead>
			<tr>
				<th>ID</th>
				<th>订单号</th>
				<th>用户ID</th>
				<th>用户昵称</th>
				<th>订单金额</th>
				<th>实际支付金额</th>
				<th>状态</th>
				<th>下单时间</th>
				<th>快递状态</th>
				<th>快递单号</th>
				<th>发货时间</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($data['data']['lists']) || $data['data']['lists'] instanceof \think\Collection || $data['data']['lists'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['data']['lists'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
			<tr>
				<td><?php echo htmlentities($vo['id']); ?></td>
				<td><?php echo htmlentities($vo['order_no']); ?></td>
				<td><?php echo htmlentities($vo['uid']); ?></td>
				<td><?php echo htmlentities($vo['user']['nickname']); ?></td>
				<td><?php echo htmlentities($vo['money']); ?></td>
				<td><?php echo htmlentities($vo['pay_money']); ?></td>
				<td>
					<?php echo $vo['status']==0 ? '<span style="color : red">未付款</span>':''; ?>
					<?php echo $vo['status']==1 ? '<span style="color : green">已付款</span>':''; ?>
					<?php echo $vo['status']==2 ? '<span style="color : gray">已完成</span>':''; ?>
				</td>
				<td><?php echo date('Y-m-d H:i:s',$vo['add_time']); ?></td>
				<td>
					<?php echo $vo['ship_status']==0 ? '<span style="color : red">未发货</span>':''; ?>
					<?php echo $vo['ship_status']==1 ? '<span style="color : green">已发货</span>':''; ?>
					<?php echo $vo['ship_status']==2 ? '<span style="color : gray">已签收</span>':''; ?>
				</td>
				<td><?php echo htmlentities($vo['ship_no']); ?></td>
				<td><?php echo $vo['ship_status']==0 ? ''  : date('Y-m-d H:i:s',$vo['ship_time']); ?></td>
				<td>
					<button class="layui-btn layui-btn-xs" onclick="add(<?php echo htmlentities($vo['id']); ?>)">发货</button>
					<button class="layui-btn layui-btn-xs" onclick="product(<?php echo htmlentities($vo['id']); ?>)">详情</button>
				</td>
			</tr>
			<?php endforeach; endif; else: echo "" ;endif; ?>
		</tbody>
	</table>
	<div id="pages"></div>
	<script type="text/javascript">
		layui.use(['layer','laypage'],function(){
			layer = layui.layer;
			$ = layui.jquery;
			laypage = layui.laypage;

			laypage.render({
			    elem: 'pages'
			    ,count:<?php echo htmlentities($data['data']['total']); ?>
			    ,limit:<?php echo htmlentities($data['pageSize']); ?>
			    ,curr:<?php echo htmlentities($data['page']); ?>
				,jump: function(obj, first){
			    if(!first){
			    	searchs(obj.curr);
			    }
			  }
			});
		});
		// 添加编辑
		function add(id){
			window.location.href = '/index.php/admins/Order/add?id='+id;
		}
		// 搜索
		function searchs(curpage){
			var wd = $.trim($('#wd').val());
			var url = "/index.php/admins/Order/index?page="+curpage;
			if(wd){
				url += '&wd='+wd;
			}
			window.location.href = url;
		}
		// 子菜单
		function product(id){
			window.location.href="/index.php/admins/order/product?id="+id;
		}
	</script>
</body>
</html>