<?php /*a:1:{s:72:"D:\phpStudy\PHPTutorial\WWW\admin\application\admins\view\user\index.php";i:1534832246;}*/ ?>
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
		<span>用户列表</span>
	</div>
	<div class="layui-form-item" style="margin-top: 10px;">
		<div class="layui-input-inline">
			<input type="text" class="layui-input" value="<?php echo htmlentities($data['wd']); ?>" id="wd" placeholder="请输入昵称搜索">
		</div>
		<button class="layui-btn layui-btn-primary" onclick="searchs()"><i class="layui-icon">&#xe615;</i>搜索</button>
	</div>
	<table class="layui-table">
		<thead>
			<tr>
				<th>ID</th>
				<th>昵称</th>
				<th>图片</th>
				<th>注册时间</th>
				<th>最后登录时间</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($data['data']['lists']) || $data['data']['lists'] instanceof \think\Collection || $data['data']['lists'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['data']['lists'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
			<tr>
				<td><?php echo htmlentities($vo['uid']); ?></td>
				<td><?php echo htmlentities($vo['nickname']); ?></td>
				<td><img src="<?php echo htmlentities($vo['img']); ?>" style="height:30px;"></td>
				<td><?php echo date('Y-m-d H:i:s',$vo['add_time']); ?></td>
				<td><?php echo date('Y-m-d H:i:s',$vo['last_time']); ?></td>
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
		// 搜索
		function searchs(curpage){
			var wd = $.trim($('#wd').val());
			var url = "/index.php/admins/User/index?page="+curpage;
			if(wd){
				url += '&wd='+wd;
			}
			window.location.href = url;
		}
	</script>
</body>
</html>