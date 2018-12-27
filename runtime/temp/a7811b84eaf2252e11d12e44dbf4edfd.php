<?php /*a:1:{s:75:"D:\phpStudy\PHPTutorial\WWW\admin\application\admins\view\order\product.php";i:1534831778;}*/ ?>
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
		<span style="cursor:pointer" onclick="back()">订单列表</span>
		<span>商品列表</span>
	</div>
	<table class="layui-table">
		<thead>
			<tr>
				<th>ID</th>
				<th>商品ID</th>
				<th>商品标题</th>
				<th>购买价格</th>
				<th>购买数量</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($data['data']['lists']) || $data['data']['lists'] instanceof \think\Collection || $data['data']['lists'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['data']['lists'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
			<tr>
				<td><?php echo htmlentities($vo['id']); ?></td>
				<td><?php echo htmlentities($vo['product_id']); ?></td>
				<td><?php echo htmlentities($vo['product']['title']); ?></td>
				<td><?php echo htmlentities($vo['price']); ?></td>
				<td><?php echo htmlentities($vo['count']); ?></td>
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
		// 返回一级分类
		function back(pid){
			window.location.href="/index.php/admins/order/index?pid="+pid;
		}
	</script>
</body>
</html>