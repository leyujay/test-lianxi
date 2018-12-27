<?php /*a:1:{s:73:"D:\phpStudy\PHPTutorial\WWW\admin\application\admins\view\product\add.php";i:1534815530;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<title><?=$product['id']?'修改':'添加'?>商品</title>
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
		<span>商品<?=$product['id']?'修改':'添加'?></span>
		<div></div>
	</div>

	<form class="layui-form" style="margin-top: 10px;">
		<input type="hidden" name="id" value="<?php echo htmlentities($product['id']); ?>">
		<div style="float: left;width: 800px;">
			<div class="layui-form-item">
				<label class="layui-form-label">商品类目</label>
				<div class="layui-input-inline">
					<select name="cid" lay-filter="cat_id">
						<option value="0">请选择</option>
						<?php if(is_array($cates) || $cates instanceof \think\Collection || $cates instanceof \think\Paginator): $i = 0; $__LIST__ = $cates;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cate): $mod = ($i % 2 );++$i;?>
						<option value="<?php echo htmlentities($cate['id']); ?>" <?php if($product['cid']==$cate['id']){echo 'selected';}?>><?php echo htmlentities($cate['title']); ?></option>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
					<select name="fid" lay-filter="fid" id="fid">
						<?php if(is_array($fates) || $fates instanceof \think\Collection || $fates instanceof \think\Paginator): $i = 0; $__LIST__ = $fates;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$fate): $mod = ($i % 2 );++$i;?>
						<option value="<?php echo htmlentities($fate['id']); ?>" <?php if($product['fid']==$fate['id']){echo 'selected';}?>><?php echo htmlentities($fate['title']); ?></option>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">商品名称</label>
				<div class="layui-input-inline">
					<input type="text" class="layui-input" name="title" value="<?php echo htmlentities($product['title']); ?>">
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">价格</label>
				<div class="layui-input-inline">
					<input type="number" class="layui-input" name="price" value="<?php echo htmlentities($product['price']); ?>">
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">&nbsp;</label>
				<div class="layui-input-inline">
					<button class="layui-btn layui-btn-sm" onclick="return false;" id="upload_img"><i class="layui-icon">&#xe67c;</i>上传图片</button>
					<div id="img">
						<?php if(!empty($product['imgs'])){ foreach($product['imgs'] as $v){ ?>
							<img class="img" style="height: 30px;" src="<?php echo $v; ?>" />
						<?php }} ?>
						<input type="hidden" name="img" value="<?php echo htmlentities($product['img']); ?>">
					</div>
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">描述</label>
				<div class="layui-input-block">
					<textarea rows="10" cols="50" id="desc"><?php echo htmlentities($product['desc']); ?></textarea>
					<!-- <input type="text" class="layui-input" name="desc" value="<?php echo htmlentities($product['desc']); ?>"> -->
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">状态</label>
				<div class="layui-input-inline">
					<input type="checkbox" layui-skin="primary" name="status" title="上架" <?php if($product['status']){echo 'checked';}?> value="1">
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">热门</label>
				<div class="layui-input-inline">
					<input type="checkbox" layui-skin="primary" name="hot" title="是" <?php if($product['hot']){echo 'checked';}?> value="1">
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
			data.img = new Object;
			// 商品数据
			data.id = $('input[name="id"]').val();
			data.cid = $('select[name="cid"]').val();
			data.fid = $('select[name="fid"]').val();
			data.title = $.trim($('input[name="title"]').val());
			data.img = $.trim($('input[name="img"]').val());
			data.price = $.trim($('input[name="price"]').val());
			data.desc = $.trim($('#desc').val());
			data.status = $('input[name="status"]').is(':checked')?1:0;
			data.hot = $('input[name="hot"]').is(':checked')?1:0;

			$.post('/index.php/admins/product/save',data,function(res){
				if(res.code>0){
					layer.msg(res.msg,{'icon':2,'anim':2});
				}else{
					layer.msg(res.msg,{'icon':1});
				}
			},'json');
		}
		// 修改
		layui.use(['layer', 'form'], function(){
			var layer = layui.layer,form = layui.form;
			form.on('select(cat_id)', function(data){
				var html = '';
				$("#fid").html(html);
				$.ajax({
					type: 'POST',
					url: '/index.php/admins/product/cat_two',
					data: {id:data.value},
					dataType:  'json',
					success: function(data){
						$.each(data.data, function(key, val) {
							var option1 = $("<option>").val(val.id).html(val.title);
	                        $("#fid").append(option1);
	                        form.render('select');
                        });
					}
				}); 
			});
		}); 
	</script>
</body>
</html>