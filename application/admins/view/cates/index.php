<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="/static/plugins/layui/css/layui.css">
	<script type="text/javascript" src="/static/plugins/layui/layui.js"></script>
	<style type="text/css">
		.header span{background: #009688;margin-left: 30px;padding: 10px;color:#ffffff;}
		.header div{border-bottom: solid 2px #009688;margin-top: 8px;}
	</style>
</head>
<body style="padding: 10px;">
	<div class="header">
		<span>分类管理</span>
		<div></div>
	</div>

	<form class="layui-form">
		<table class="layui-table">
			<thead>
				<tr>
					<th>ID</th>
					<th>排序</th>
					<th>标签名称</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				{volist name="data" id="vo"}
				<tr>
					<td>{$vo.id}</td>
					<td><input type="text" class="layui-input" name="ords[{$vo.id}]" value="{$vo.ord}"></td>
					<td><input type="text" class="layui-input" name="titles[{$vo.id}]" value="{$vo.title}"></td>
					<td>
						<button class="layui-btn layui-btn-xs" onclick="child({$vo.id});return false;">子菜单</button>
					</td>
				</tr>
				{/volist}
				<tr>
					<td></td>
					<td><input type="text" class="layui-input" name="ords[0]"></td>
					<td><input type="text" class="layui-input" name="titles[0]"></td>
					<td></td>
				</tr>
			</tbody>
		</table>
	</form>
	<button class="layui-btn" onclick="save()">保存</button>
	<script type="text/javascript">
		layui.use(['layer','form'],function(){
			$ = layui.jquery;
			layer = layui.layer;
			form = layui.form;
		});
		// 子菜单
		function child(id){
			window.location.href="/index.php/admins/Cates/index_two?pid="+id;
		}
		// 保存
		function save(){
			$.post('/index.php/admins/Cates/save',$('form').serialize(),function(res){
				if(res.code>0){
					layer.alert(res.msg,{'icon':2});
				}else{
					layer.msg(res.msg,{'icon':1});
					setTimeout(function(){window.location.reload();},1000);
				}
			},'json');
		}
	</script>
</body>
</html>