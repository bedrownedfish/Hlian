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
			<span>修改密码</span>
		</header><!-- /header -->
		<div class="larry-personal-body clearfix changepwd">
			<form class="layui-form col-lg-4" method="post" action="">
			 	<div class="layui-form-item">
					<label class="layui-form-label">用户名</label>
					<div class="layui-input-block">
					  	<input type="text" name="username"  autocomplete="off"  class="layui-input username" value="<?=$adName['username']?>" placeholder="请输入用户名" >
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">旧密码</label>
					<div class="layui-input-block">  
					  	<input type="password" name="pas"  autocomplete="off"  class="layui-input pas" value="" placeholder="请输入旧密码">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">新密码</label>
					<div class="layui-input-block">
					  	<input type="password" name="newp"  autocomplete="off"  class="layui-input newps" value="" placeholder="请输入新密码,仅修改登录名可忽略此列">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">确认密码</label>
					<div class="layui-input-block">  
					  	<input type="password" name="newps"  autocomplete="off"  class="layui-input newps" value="" placeholder="请输入确认新密码,仅修改登录名可忽略此列">
					</div>
				</div>
				<div class="layui-form-item change-submit">
					<div class="layui-input-block">
						<button class="layui-btn" lay-submit="" lay-filter="formDemo">立即提交</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
<script type="text/javascript" src="<?=base_url('public/manage/')?>common/layui/layui.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="<?=base_url()?>public/js/jquery.base64.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
	layui.use(['form','upload'],function(){
         var form = layui.form();
	});
	layui.config({
			base : "/public/manage/js/"
		}).use(['form','layer','jquery','laypage'],function(){
			var form = layui.form(),                                  
				layer = parent.layer === undefined ? layui.layer : parent.layer,
				laypage = layui.laypage,
				$ = layui.jquery;
			//加载页面数据
			form.on('submit(formDemo)', function(data) {
				var codes = JSON.stringify(data.field),
				code = data.field;
				if(code.username==""){layer.msg("登录名不能为空");return false};
				if(code.pas==""){layer.msg("请输入系统密码！");return false};
				if(code.newp != code.newps){layer.msg('两次密码不一致');return false};
				if(code.newp.length>0&&code.newp.length<6){layer.msg("新密码太短");return false};
				var pas = $.base64.encode($.base64.encode(code.pas)),
				newps = $.base64.encode($.base64.encode(code.newp)),
				index = layer.msg('请稍候',{icon: 16,time:false,shade:0.8});				
				$.ajax({
					type:'post',
					url: "<?=base_url('manage/changepwd')?>",
					data:{pas:pas,newps:newps,username:code.username},
					cache:false,
					dataType:'JSON',
					success:function(data){
						if(data.error)layer.msg(data.error);
						if(data.success){layer.msg(data.success);window.location.reload();};
					},
				    error:function(e){
				    	layer.close(index);
				    },
				    beforeSend:function(e){
				    	layer.close(index);
				    }
				});
				return false
			});
		})
</script>
</body>
</html>