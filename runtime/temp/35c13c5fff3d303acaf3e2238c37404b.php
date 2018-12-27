<?php /*a:1:{s:75:"D:\phpStudy\PHPTutorial\WWW\admin\application\admins\view\product\index.php";i:1534767281;}*/ ?>
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
		<span>商品列表</span>
		<button class="layui-btn layui-btn-sm" onclick="add()">添加</button>
	</div>
	<div class="layui-form-item" style="margin-top: 10px;">
		<div class="layui-input-inline">
			<input type="text" class="layui-input" value="<?php echo htmlentities($data['wd']); ?>" id="wd" placeholder="请输入商品名称搜索">
		</div>
		<button class="layui-btn layui-btn-primary" onclick="searchs()"><i class="layui-icon">&#xe615;</i>搜索</button>
	</div>
	<table class="layui-table">
		<thead>
			<tr>
				<th>ID</th>
				<th>一级分类</th>
				<th>二级分类</th>
				<th>名称</th>
				<th>价格</th>
				<th>状态</th>
				<th>热门</th>
				<th>添加时间</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($data['data']['lists']) || $data['data']['lists'] instanceof \think\Collection || $data['data']['lists'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['data']['lists'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
			<tr>
				<td><?php echo htmlentities($vo['id']); ?></td>
				<td><?php echo isset($data['cates'][$vo['cid']])?$data['cates'][$vo['cid']]['title']:''; ?></td>
				<td><?php echo isset($data['fates'][$vo['fid']])?$data['fates'][$vo['fid']]['title']:''; ?></td>
				<td><?php echo htmlentities($vo['title']); ?><img class="thumb" src="<?php echo htmlentities($vo['img']); ?>" onmouseover="show_img(this)" onmouseleave="hide_img()"></td>
				<td><?php echo htmlentities($vo['price']); ?></td>
				<td><?php echo $vo['status']==0 ? '<span style="color : red">下架</span>':'正常'; ?></td>
				<td><?php echo $vo['hot']==1 ? '<span style="color : red">是</span>':'否'; ?></td>
				<td><?php echo date('Y-m-d H:i:s',$vo['add_time']); ?></td>
				<td>
					<button class="layui-btn layui-btn-xs" onclick="add(<?php echo htmlentities($vo['id']); ?>)">编辑</button>
					<button class="layui-btn layui-btn-danger layui-btn-xs" onclick="del(<?php echo htmlentities($vo['id']); ?>)">删除</button>
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
			window.location.href = '/index.php/admins/product/add?id='+id;
		}

		// 删除
		function del(id){
			layer.confirm('确定要删除吗？', {
			  icon:3,
			  btn: ['确定','取消']
			}, function(){
			  $.post('/index.php/admins/product/delete',{'id':id},function(res){
			  	if(res.code>0){
			  		layer.alert(res.msg,{icon:2});
			  	}else{
			  		layer.msg(res.msg);
			  		setTimeout(function(){window.location.reload();},1000);
			  	}
			  },'json');
			});
		}

		// 搜索
		function searchs(curpage){
			var wd = $.trim($('#wd').val());
			var url = "/index.php/admins/product/index?page="+curpage;
			if(wd){
				url += '&wd='+wd;
			}
			window.location.href = url;
		}

		// 预览图片
		function show_img(obj){
			var imgurl = $(obj).attr('src');
			var res = getMousePos();
			var html = '<div style="background:#fff;position: absolute;width: 200px;border:solid 1px #cdcdcd;border-radius: 6px;padding: 2px;left:'+res.x+'px;top:'+res.y+'px;z-index:1000" id="preview">\
					<img style="width: 100%;border-radius: 6px;" src="'+imgurl+'">\
				</div>';
			$('body').append(html);
		}
		function hide_img(){
			$('#preview').remove();
		}

		// 获取鼠标位置
		function getMousePos(event) {
		   var e = event || window.event;
		   var scrollX = document.documentElement.scrollLeft || document.body.scrollLeft;
		   var scrollY = document.documentElement.scrollTop || document.body.scrollTop;
		   var x = e.pageX || e.clientX + scrollX;
		   var y = e.pageY || e.clientY + scrollY;
		   return { 'x': x, 'y': y };
		}

	</script>
</body>
</html>