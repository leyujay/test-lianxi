<?php /*a:1:{s:73:"D:\phpStudy\PHPTutorial\WWW\admin\application\admins\view\slide\index.php";i:1534820301;}*/ ?>
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
	</style>
</head>
<body style="padding: 10px;">
	<div class="header">
		<span>首页首屏</span>
		<button class="layui-btn layui-btn-sm" onclick="add()">添加</button>
	</div>

	<table class="layui-table">
		<thead>
			<tr>
				<th>ID</th>
				<th>排序</th>
				<th>标题</th>
				<th>URL</th>
				<th>图片</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
			<tr>
				<td><?php echo htmlentities($vo['id']); ?></td>
				<td><?php echo htmlentities($vo['ord']); ?></td>
				<td><?php echo htmlentities($vo['title']); ?></td>
				<td><?php echo htmlentities($vo['url']); ?></td>
				<td><img src="<?php echo htmlentities($vo['img']); ?>" style="height: 30px;"></td>
				<td>
					<button class="layui-btn layui-btn-xs" onclick="add(<?php echo htmlentities($vo['id']); ?>)">编辑</button>
					<button class="layui-btn layui-btn-danger layui-btn-xs" onclick="del(<?php echo htmlentities($vo['id']); ?>)">删除</button>
				</td>
			</tr>
			<?php endforeach; endif; else: echo "" ;endif; ?>
		</tbody>
	</table>

	<script type="text/javascript">
		layui.use(['layer'],function(){
			layer = layui.layer;
			$ = layui.jquery;
		});

		// 添加幻灯片
		function add(id){
			layer.open({
			  type: 2,
			  title: id>0?'编辑幻灯片':'添加幻灯片',
			  shade: 0.3,
			  area: ['480px', '420px'],
			  content: '/index.php/admins/slide/add_first?id='+id
			});
		}

		// 删除
		function del(id){
			layer.confirm('确定要删除吗？', {
			  icon:3,
			  btn: ['确定','取消']
			}, function(){
			  $.post('/index.php/admins/slide/delete',{'id':id},function(res){
			  	if(res.code>0){
			  		layer.alert(res.msg,{icon:2});
			  	}else{
			  		layer.msg(res.msg);
			  		setTimeout(function(){window.location.reload();},1000);
			  	}
			  },'json');
			});
		}
	</script>
</body>
</html>