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
		<span style="cursor:pointer" onclick="back()">分类管理</span>
		<span>二级分类</span>
		<button class="layui-btn layui-btn-sm" onclick="add({$pid})">添加</button>
	</div>

	<table class="layui-table">
		<thead>
			<tr>
				<th>ID</th>
				<th>标签名称</th>
				<th>图片</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			{volist name="data" id='vo'}
			<tr>
				<td>{$vo.id}</td>
				<td>{$vo.title}</td>
				<td><img class="thumb" src="{$vo.img}" onmouseover="show_img(this)" onmouseleave="hide_img()" style="height: 30px;"></td>
				<td>
					<button class="layui-btn layui-btn-xs" onclick="add({$pid},{$vo.id})">编辑</button>
					<button class="layui-btn layui-btn-danger layui-btn-xs" onclick="del({$vo.id})">删除</button>
				</td>
			</tr>
			{/volist}
		</tbody>
	</table>

	<script type="text/javascript">
		layui.use(['layer'],function(){
			layer = layui.layer;
			$ = layui.jquery;
		});

		// 添加分类
		function add(pid,id){
			layer.open({
			  type: 2,
			  title: id>0?'编辑分类':'添加分类',
			  shade: 0.3,
			  area: ['480px', '420px'],
			  content: '/index.php/admins/cates/index_two_add?id='+id+'&pid='+pid
			});
		}
		// 返回一级分类
		function back(pid){
			window.location.href="/index.php/admins/cates/index?pid="+pid;
		}
		// 删除
		function del(id){
			layer.confirm('确定要删除吗？', {
			  icon:3,
			  btn: ['确定','取消']
			}, function(){
			  $.post('/index.php/admins/cates/delete',{'id':id},function(res){
			  	if(res.code>0){
			  		layer.alert(res.msg,{icon:2});
			  	}else{
			  		layer.msg(res.msg);
			  		setTimeout(function(){window.location.reload();},1000);
			  	}
			  },'json');
			});
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