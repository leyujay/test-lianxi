<?php /*a:1:{s:72:"D:\phpStudy\PHPTutorial\WWW\admin\application\admins\view\home\index.php";i:1534746450;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="/static/plugins/layui/css/layui.css">
	<script type="text/javascript" src="/static/plugins/layui/layui.js"></script>
	<style type="text/css">
		.header{width:100%;height: 50px;line-height: 50px;background: #2e6da4;color:#ffffff;}
		.title{margin-left: 20px;font-size: 20px;}
		.userinfo{float: right;margin-right: 10px;}
		.userinfo a{color:#ffffff;}
		.menu{width: 200px;background: #333744;position: absolute;}
		.main{position: absolute;left: 200px;right: 0px;}

		.layui-collapse{border: none;}
		.layui-colla-item{border-top: none;}
		.layui-colla-title{background: #42485b;color:#ffffff;}
		.layui-colla-content{border-top: none;padding: 0px;}
	</style>
</head>
<body>
	<!--header-->
	<div class="header">
		<span class="title"><span style="font-size: 20px;"><?php echo htmlentities($site['values']); ?></span>--后台管理系统</span>
		<span class="userinfo"><?php echo htmlentities($admin['username']); ?>【<?php echo htmlentities($role['title']); ?>】<span><a href="javascript:;" onclick="logout()">退出</a></span></span>
	</div>
	<!--菜单-->
	<div class="menu" id="menu">
		<div class="layui-collapse" lay-accordion>
		  <?php if(is_array($menus) || $menus instanceof \think\Collection || $menus instanceof \think\Paginator): $i = 0; $__LIST__ = $menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
		  <div class="layui-colla-item">
		    <h2 class="layui-colla-title"><?php echo htmlentities($vo['title']); ?></h2>
		    <div class="layui-colla-content<?php echo $i==1 ? ' layui-show' : ''; ?>">
		    	<?php if(isset($vo['children']) && $vo['children']){?>
		    	<ul class="layui-nav layui-nav-tree" lay-filter="test">
		    		<?php if(is_array($vo['children']) || $vo['children'] instanceof \think\Collection || $vo['children'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['children'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cvo): $mod = ($i % 2 );++$i;?>
					<li class="layui-nav-item"><a href="javascript:;" onclick="menuFire(this)" src="/index.php/admins/<?php echo htmlentities($cvo['controller']); ?>/<?php echo htmlentities($cvo['method']); ?>"><?php echo htmlentities($cvo['title']); ?></a></li>
		    		<?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
				<?php }?>
		    </div>
		  </div>
		  <?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
	</div>
	<!--主操作页面-->
	<div class="main">
		<iframe src="/index.php/admins/Home/welcome" onload="resetMainHeight(this)" style="width: 100%;height: 100%;" frameborder="0" scrolling="0"></iframe>
	</div>

	<script>
		layui.use(['element','layer'], function(){
		  var element = layui.element;
		  $ = layui.jquery;
		  layer = layui.layer;

		  resetMenuHeight();
		});

		// 重新设置菜单容器高度
		function resetMenuHeight(){
			var height = document.documentElement.clientHeight - 50;
			$('#menu').height(height);
		}

		// 重新设置主操作页面高度
		function resetMainHeight(obj){
			var height = parent.document.documentElement.clientHeight - 53;
			$(obj).parent('div').height(height);
		}

		// 菜单点击
		function menuFire(obj){
			// 获取url
			var src = $(obj).attr('src');
			// 设置iframe的src
			$('iframe').attr('src',src);
		}

		// 退出
		function logout(){
			layer.confirm('确定要退出吗？', {
				icon:3,
			    btn: ['确定','取消']
			}, function(){
			  $.get('/index.php/admins/account/logout',function(res){
					if(res.code>0){
						layer.msg(res.msg,{'icon':2});
					}else{
						layer.msg(res.msg,{'icon':1});
						setTimeout(function(){window.location.href="/index.php/admins/account/login";},1000);
					}
				},'json');
			});
		}
</script>
</body>
</html>