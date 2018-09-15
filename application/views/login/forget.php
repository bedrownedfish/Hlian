<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title></title>
    <script src="<?=base_url('public/login/')?>js/mui.min.js"></script>
    <link href="<?=base_url('public/login/')?>css/mui.min.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url('public/login/')?>css/common.css"/>
    <script src="<?=base_url()?>public/js/jquery.js"></script>   
	<script src="<?=base_url()?>public/js/jquery.base64.js" ></script>
    <?php $this->load->view('module/loading')?>
    <script type="text/javascript" charset="utf-8">
      	mui.init();
    </script>
</head>
<body class="resiter_body">
	<div class="sectionH  mui-clearfix">
		<header class="mui-bar mui-bar-nav" style="">
			<a class="mui-icon  mui-pull-left" href="javascript:history.back(-1)" style=""><img src="<?=base_url('public/login/')?>images/register_nav_icon_back.png"/></a>
			<h1 class="mui-title">重置密码</h1>
			<!--<a class="mui-icon mui-pull-right right1" href="assets-1.html"><img src="images/icon_setting.png"/></a>-->
		</header>
	</div>
	<div class="kong1"></div>
	<div class="forget_section1">
		
			<div class="fom">
				<form action="" id="form">
					<div class="f1">
						<div class="container_1">
							<img src="<?=base_url('public/login/')?>images/register_icon_phone.png" class="img1"/>
							<input type="text" id="mobiles" name="mobiles"  value="" placeholder="请填写手机号"/>
						</div>
					</div>
					<div class="f1">
						<div class="container_1">
							<img src="<?=base_url('public/login/')?>images/register_icon_code.png" class="img1"/>
							<input type="text" name="vcodes" id="codes"  value="" placeholder="请填写验证码"/>
							<span class="forget_btn" id="vcodes">获取验证码</span>
						</div>
					</div>
					<div class="f1">
						<div class="container_1">
							<img src="<?=base_url('public/login/')?>images/register_icon_pw.png" class="img1"/>
							<input type="password" name="password" id="password1" value="" placeholder="请填写密码"/>
							<img src="<?=base_url('public/login/')?>images/register_icon_view_open.png" class="forget_yan"/>
							<img src="<?=base_url('public/login/')?>images/register_icon_view_close.png" class="forget_yan forget_yan1"/>
						</div>
					</div>
					<div class="f1">
						<div class="container_1">
							<img src="<?=base_url('public/login/')?>images/register_icon_pw.png" class="img1"/>
							<input type="password" name="" id='password2'  value="" placeholder="确认密码"/>
							<img src="<?=base_url('public/login/')?>images/register_icon_view_open.png" class="forget_yan "/>
							<img src="<?=base_url('public/login/')?>images/register_icon_view_close.png" class="forget_yan forget_yan1"/>
						</div>
					</div>
					<input type="hidden" name="password" id="password">
					<div class="sub">
						<div class="container_1">
							<input type="submit" name=""  value="确定" />
						</div>
					</div>
				</form>
			</div>
		
	</div>
</body>
<script>
	function isMobile(str) {
		var myreg=/^[1][3,4,5,7,8][0-9]{9}$/;
	    if (!myreg.test(str)) {
			return false;
		} else {
			return true;
		}
	}
	$(function(){
		$(".forget_yan").click(function(){
			$(this).hide();
			$(this).siblings(".forget_yan1").show();
			$(this).siblings("input").attr("type","text");
		});
		$(".forget_yan1").click(function(){
			$(this).hide();
			$(this).siblings(".forget_yan").show();
			$(this).siblings("input").attr("type","password");
		});
		$('#vcodes').click(function(event) {
			var mobiles = $('#mobiles').val();
			if(!isMobile(mobiles)){mui.toast('请输入正确手机号');return false;};
			$.ajax({
				type:'post',
				url:'<?=base_url('Option/getCode')?>',
				data:{mobile:mobiles},
				cache:false,
				dataType:'JSON',
				success:function(data){
					mui.hideLoading();
					mui.toast(data.message);
									
				},
			    error:function(e){
			       	console.log(e);
			       	mui.hideLoading();
			    },
			    beforeSend:function(e){
			       	mui.showLoading("正在发送..","div");
			    }
			});
		});
		$("#form").submit(function() {
			var password = $('#password1').val(), password2 = $('#password2').val(),
				mobiles = $('#mobiles').val(),codes = $('#codes').val();
				if(!isMobile(mobiles)){mui.toast('请输入正确手机号');return false;};
				if(!codes){mui.toast('请输入您收到的手机验证码');return false;};
				if(password.length <8 || password2<8){
					mui.toast('密码不能小于8位');return false;
				}
				if(password2!=password){mui.toast('请输入相同的密码');return false;}
				$('#password').val($.base64.encode($.base64.encode(password)));
				data = $("#form").serialize();
				$.ajax({
					type:'post',
					url:'<?=base_url('Option/forgets')?>',
					data:data,
					cache:false,
					dataType:'JSON',
					success:function(data){
						mui.hideLoading();
						if(data.types == 1){setTimeout(function(){window.location.href="<?=base_url('home/login')?>";},1000)};
						mui.toast(data.message);									
					},
				    error:function(e){
				       	mui.hideLoading();
				    },
				    beforeSend:function(e){
				       	mui.showLoading("正在注册..","div");
				    }
				});
			    return false;
		});

	})
</script>
</html>