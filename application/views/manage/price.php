<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>添加信息</title>
	<meta name="renderer" content="webkit">	
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">	
	<meta name="apple-mobile-web-app-status-bar-style" content="black">	
	<meta name="apple-mobile-web-app-capable" content="yes">	
	<meta name="format-detection" content="telephone=no">	
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/manage/')?>common/layui/css/layui.css" media="all">
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/manage/')?>common/bootstrap/css/bootstrap.css" media="all">
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/manage/')?>common/global.css" media="all">
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/manage/')?>css/personal.css" media="all">
</head>
<body class="childrenBody">
	<form class="layui-form">
		<div class="layui-form-item">
			<div class="layui-inline">
				<label class="layui-form-label">币种选择</label>
				<div class="layui-input-inline">
					<select name="id" class="newsLook" lay-filter="browseLook">
						<?php foreach($codes as $k=>$v):?>
				        	<option value="<?=$v['id']?>"><?=$v['nickname']?></option>
				    	<?php endforeach?>
				    </select>
				</div>
			</div>
		</div>
		<div class="layui-form-item">
			<div class="layui-inline">
		      	<label class="layui-form-label">币种价格</label>
		      	<div class="layui-input-inline">
		        	<input class="layui-input newsName" name="price" lay-verify="required" placeholder="请输入价格" type="number">
		    	</div>
		    </div>
			
		</div>
		<div class="layui-form-item">
			<div class="layui-inline">
		      	<label class="layui-form-label">发布时间</label>
		      	<div class="layui-input-inline">
		        	<input type="text" class="layui-input" value="<?=date('Y-m-d H:i:s')?>" name="addtime" id="date1" placeholder="选择发布时间">
		    	</div>
		    </div>
			
		</div>
		
		<div class="layui-form-item">
			<div class="layui-input-block">
				<button class="layui-btn" lay-submit="" lay-filter="addNews">立即提交</button>
		    </div>
		</div>
	</form>
	<script type="text/javascript" src="<?=base_url('public/manage/')?>common/layui2.4/layui.js"></script>
<script type="text/javascript">
var newsInset = '<?=base_url("kinds/addprice")?>';
layui.config({
	base : "js/"
}).use(['form','layer','jquery','layedit','laydate','upload'],function(){
	var form = layui.form,
		layer = parent.layer === undefined ? layui.layer : parent.layer,
		laypage = layui.laypage,
		layedit = layui.layedit,
		upload = layui.upload,
		laydate = layui.laydate,
		$ = layui.jquery;
		laydate.render({
		    elem: '#date1'
		    ,type: 'datetime'
		});
	//创建一个编辑器
 	form.on("submit(addNews)",function(data){
 		
 		//弹出loading
 		var index = top.layer.msg('数据提交中，请稍候',{icon: 16,time:false,shade:0.8}),
 		codes = data.field;
			$.ajax({
				type:'post',
				url: newsInset,
				data:codes,
				cache:false,
				dataType:'JSON',
				success:function(data){
					layer.msg(data.message);
				},
			    error:function(e){
			    	layer.close(index);
			    },
			    beforeSend:function(e){
			    	layer.close(index);
			    }
			});
 		return false;
 	})

	
})

</script>

</body>
</html>