<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>个人信息</title>
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
<body>
<section class="layui-larry-box">
	<div class="larry-personal">
		<header class="larry-personal-tit">
			<span>个人信息</span>
		</header><!-- /header -->
		<div class="larry-personal-body clearfix">
			<form class="layui-form col-lg-5" action="" method="post">
				<div class="layui-form-item">
					<label class="layui-form-label">用户名</label>
					<div class="layui-input-block">  
						<input type="text" name=""  autocomplete="off"  class="layui-input layui-disabled" value="<?=$codes['username']?>" disabled="disabled" >
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">标题</label>
					<div class="layui-input-block">
						<input type="text" name=""  autocomplete="off" class="layui-input layui-disabled" value="<?=$codes['title']?>" disabled="disabled">
					</div>
				</div>
				<div class="layui-form-item layui-form-text">
					<label class="layui-form-label">内容</label>
					<div class="layui-input-block">
						<textarea disabled="disabled" value="" class="layui-textarea"><?=$codes['content']?></textarea>
					</div>
				</div>
				<?php if($codes['mobile']):?>
				<div class="layui-form-item">
					<label class="layui-form-label">联系方式</label>
					<div class="layui-input-block">
						<input type="text" name="" disabled="disabled" value="<?=$codes['mobile']?>" autocomplete="off" class="layui-input" placeholder="输入手机号码">
					</div>
				</div>
				<?php endif?>
				<div class="layui-form-item layui-form-text">
					<label class="layui-form-label">回复</label>
					<div class="layui-input-block">
						<textarea placeholder="请输入回复内容" name="reply" lay-verify="required"  class="layui-textarea"><?=$codes['reply']?></textarea>
					</div>
				</div>
				<input type="hidden" name="id" value="<?=$codes['id']?>">
				<div class="layui-form-item">
					<div class="layui-input-block">
						<button class="layui-btn" lay-submit="" lay-filter="formDemo" lay-filter="demo1">立即提交</button>
						<a type="reset" href="<?=base_url('Kinds/opinion')?>" class="layui-btn layui-btn-primary">返回</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
<script type="text/javascript" src="<?=base_url('public/manage/')?>common/layui/layui.js"></script>
<script type="text/javascript">
	var opinionurl = "<?=base_url('Kinds/opinion_1')?>";
	layui.config({
		base : "/public/manage/js/"
	}).use(['form','layer','jquery'],function(){
		var form = layui.form(),
			layer = parent.layer === undefined ? layui.layer : parent.layer,
			laypage = layui.laypage,
			$ = layui.jquery;
		form.on('submit(formDemo)', function(data) {
			var codes = data.field,
				index = layer.msg('数据提交中，请稍候',{icon: 16,time:false,shade:0.8});;
			$.ajax({
				type:'post',
				url: opinionurl,
				data:codes,
				cache:false,
				dataType:'JSON',
				success:function(data){
					layer.msg(data.message);
					if(data.types){
						window.location.href='<?=base_url("Kinds/opinion")?>';
					}
				},
			    error:function(e){
			    	layer.close(index);
			    },
			    beforeSend:function(e){
			    	layer.close(index);
			    }
			});
			return false;
			
		});
	})
</script>
</body>
</html>