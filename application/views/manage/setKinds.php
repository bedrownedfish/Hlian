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
			<label class="layui-form-label">币种昵称</label>
			<div class="layui-input-block">
				<input class="layui-input newsName" lay-verify="required" disabled="disabled" value="<?=$codes['tokname']?>" type="text">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">合约地址</label>
			<div class="layui-input-block">
				<input class="layui-input newsName" lay-verify="required" disabled="disabled" value="<?=$codes['contract']?>" type="text">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">合约名称</label>
			<div class="layui-input-block">
				<input class="layui-input newsName" name="nickname" lay-verify="required" value="<?=$codes['nickname']?>" type="text">
			</div>
		</div>
		<div class="layui-form-item">
			<div class="layui-inline">		
				<label class="layui-form-label">发布时间</label>
				<div class="layui-input-inline">
					<input class="layui-input newsTime" name="addtime" value="<?=date('Y-m-d',$codes['addtime'])?>" lay-verify="required|date" onClick="layui.laydate({elem:this})" type="text">
				</div>
			</div>
			<div class="layui-inline">
				<label class="layui-form-label">是否开启</label>
				<div class="layui-input-inline">
					<select name="type" class="newsLook" lay-filter="browseLook">
				        <option value="1">是</option>
				        <option value="0">否</option>
				    </select><div class="layui-unselect layui-form-select"><div class="layui-select-title"><input placeholder="是否开启" value="是否开启" readonly="" class="layui-input layui-unselect" type="text"><i class="layui-edge"></i></div><dl class="layui-anim layui-anim-upbit"><dd lay-value="1" class="layui-this">是</dd><dd lay-value="0" class="">否</dd></dl></div>
				</div>
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">币种价格</label>
			<div class="layui-input-block">
				<input class="layui-input" name="price" value="<?=round($codes['price'],4)?>" type="number">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">发行数量</label>
			<div class="layui-input-block">
				<input class="layui-input" name="numbers" value="<?=round($codes['numbers'],4)?>" type="number">
			</div>
		</div>
		<div class="layui-form-item">
			<div class="layui-input-block">
				<input type="hidden" name="id" value="<?=$codes['id']?>">
				<button class="layui-btn" lay-submit="" lay-filter="addNews">立即提交</button>
				<button type="reset" class="layui-btn layui-btn-primary">返回</button>
		    </div>
		</div>
	</form>
	<script type="text/javascript" src="<?=base_url('public/manage/')?>common/layui/layui.js"></script>
	<script type="text/javascript">
		var furl = "<?=base_url('kinds/kindList');?>",
			setkinds = "<?=base_url('kinds/setKinds')?>";
	layui.config({
		base : "js/"
	}).use(['form','layer','jquery','layedit','laydate'],function(){
		var form = layui.form(),
			layer = parent.layer === undefined ? layui.layer : parent.layer,
			laypage = layui.laypage,
			layedit = layui.layedit,
			laydate = layui.laydate,
			$ = layui.jquery;

		//创建一个编辑器
	 	var editIndex = layedit.build('news_content');
	 	form.on("submit(addNews)",function(data){
	 		var index = top.layer.msg('数据提交中，请稍候',{icon: 16,time:false,shade:0.8});
	        var codes = data.field;
	        $.ajax({
				type:'post',
				url: setkinds,
				data:codes,
				cache:false,
				dataType:'JSON',
				success:function(data){
					data?top.layer.msg('修改成功！'):top.layer.msg('修改失败');
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
	 	$("body").on("click",".layui-btn-primary",function(){  //编辑
			window.location.href = furl;
		})
		
	})
	</script>
</body>
</html>