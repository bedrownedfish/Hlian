<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>后台管理</title>
	<meta name="renderer" content="webkit">	
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">	
	<meta name="apple-mobile-web-app-capable" content="yes">	
	<meta name="format-detection" content="telephone=no">
	<!-- load css -->
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/manage/')?>common/layui/css/layui.css" media="all">
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/manage/')?>css/login.css" media="all">
</head>
<body>
<div class="layui-canvs"></div>
<div class="layui-layout layui-layout-login">
	<h1>
		 <strong>系统管理后台</strong>
		 <em>Management System</em>
	</h1>
	<div class="layui-user-icon larry-login">
		 <input type="text" id="users"  placeholder="账号" class="login_txtbx"/>
	</div>
	<div class="layui-pwd-icon larry-login">
		 <input type="password" id="pass" placeholder="密码" class="login_txtbx"/>
	</div>
    <div class="layui-val-icon larry-login">
    	<div class="layui-code-box">
    		<input type="text" id="code" value="<?=$this->session->securityCode?>" name="code" placeholder="验证码" maxlength="4" class="login_txtbx">
            <?=$securityCode?>
    	</div>
    </div>
    <div class="layui-submit larry-login">
    	<input type="button" id="sub" value="立即登陆" class="submit_btn"/>
    </div>
    <div class="layui-login-text">
    	<p>© 2016-2018 H链 版权所有</p>
    </div>
</div>
<script type="text/javascript" src="<?=base_url('public/manage/')?>common/layui/lay/dest/layui.all.js"></script>
<script type="text/javascript" src="<?=base_url('public/manage/')?>js/login.js"></script>
<script type="text/javascript" src="<?=base_url('public/manage/')?>jsplug/jparticle.jquery.js"></script>
<script src="<?=base_url()?>public/js/jquery.base64.js" type="text/javascript" charset="utf-8"></script>
<?php $this->load->view('module/layload');?>
<script type="text/javascript">

$(function(){
	$(".layui-canvs").jParticle({
		background: "#141414",
		color: "#E6E6E6"
	});

	$(function(){
		$('#sub').click(function(event) {
			var users = $('#users').val(),pass = $.base64.encode($.base64.encode($('#pass').val())),code = $('#code').val(),arr= new Array();
			if(users==""){layer.alert('账号不能为空');return false;};
			if(pass==""){layer.alert('密码不能为空');return false;};
			if(code == ""){layer.alert('请输入验证码');return false;};
			arr['users'] = users;arr['pass'] = pass;arr['code'] = code;
			$.ajax({
				type:'post',
				url:'<?=base_url('Manage/msLogin')?>',
				data:{users:users,pass:pass,code:code},  
				cache:false,
				dataType:'JSON',
				beforeSend: function () {
	        		i = ityzl_SHOW_LOAD_LAYER();
		        },
		        success: function (data) {
		        	ityzl_CLOSE_LOAD_LAYER(i);
		        	ityzl_SHOW_TIP_LAYER();
		        	layer.msg(data.message);
		        	data.types == 1 && setTimeout(function(){window.location.href="<?=base_url('manage/index')?>"},100);
		        },
		        error: function (e, jqxhr, settings, exception) {
		        	ityzl_CLOSE_LOAD_LAYER(i);
		        }
			});


		});
		

	})
	/*//登录链接测试，使用时可删除
	$(".submit_btn").click(function(){
	  location.href="index.html";
	});*/
});
</script>
</body>
</html>