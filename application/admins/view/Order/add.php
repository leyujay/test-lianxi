<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="/static/plugins/layui/css/layui.css">
	<script type="text/javascript" src="/static/plugins/layui/layui.js"></script>
	<style type="text/css">
		.clear{clear: both;}
		.header span{background: #009688;margin-left: 30px;padding: 10px;color:#ffffff;}
		.header div{border-bottom: solid 2px #009688;margin-top: 8px;}
		.header button{float: right;margin-top: -5px;}
		.thumb{height: 28px;float: right;border: solid 1px #f0f0f0;padding: 1px;}
		.layui-table td{padding: 4px 10px;}
		.layui-table input{height: 30px;width: 60px;}
		.value-list{float: left;margin-right: 5px;}
		.value-list .del{padding: 0px 3px;background: #FF5722;border-radius: 50%;color: #fff;margin-left: 5px}
		.value-list a{margin: 0px 5px;}
	</style>
</head>
<body style="padding: 10px;">
	<div class="header">
		<span>发货</span>
		<div></div>
	</div>

	<form class="layui-form" style="margin-top: 10px;">
		<input type="hidden" name="pid" value="{$data.id}">
		<div style="float: left;width: 800px;">
			<div class="layui-form-item">
				<label class="layui-form-label">编号</label>
				<div class="layui-input-inline">
					<input type="type" class="layui-input" readonly="readonly" name="id" value="{$data.id}">
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">订单号</label>
				<div class="layui-input-inline">					
					<input type="type" class="layui-input" readonly="readonly" name="order_no" value="{$data.order_no}">
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">快递单号</label>
				<div class="layui-input-inline">
					<input type="type" class="layui-input" name="ship_no" value="{$data.ship_no}">
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">状态</label>
				<div class="layui-input-inline">
					<select name="ship_status" lay-filter="ship_status">
						<option value="0" <?php if($data['ship_status']==0){echo 'selected';}?>>未发货</option>
						<option value="1" <?php if($data['ship_status']==1){echo 'selected';}?>>已发货</option>
						<option value="2" <?php if($data['ship_status']==2){echo 'selected';}?>>已收货</option>
					</select>
				</div>
			</div>
		</div>
	</form>
	<div class="layui-form-item">
		<div class="layui-input-block">
			<button class="layui-btn" onclick="save();return false;">保存</button>
		</div>
	</div>
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script type="text/javascript">
		layui.use(['form','layer','upload'],function(){
			$ = layui.jquery;
			form = layui.form;
			layer = layui.layer;

			var upload = layui.upload;

			// 执行上传实例
			var uploadInst = upload.render({
				elem: '#upload_img' //绑定元素
				,url: '/index.php/admins/product/upload_img' //上传接口
				,accept:'images'
				,done: function(res){
					//上传完毕回调
					var html = '<img class="img" src="'+res.msg+'" style="height:30px" />';
					$('#img').append(html);
					var values = $('input[name="img"]').val();
					$('input[name="img"]').val(values+';'+res.msg);
				}
				,error: function(){
				  //请求异常回调
				}
			});
		});
		// 保存
		function save(){
			var data = new Object;
			// 商品数据
			data.pid = $('input[name="pid"]').val();
			data.ship_no = $.trim($('input[name="ship_no"]').val());
			data.ship_status = $('select[name="ship_status"]').val();
			$.post('/index.php/admins/order/save',data,function(res){
				if(res.code>0){
					layer.msg(res.msg,{'icon':2,'anim':2});
				}else{
					layer.msg(res.msg,{'icon':1});
				}
			},'json');
		}
	</script>
</body>
</html>