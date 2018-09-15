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
<body class="login_body">
	<div class="sectionH sectionH1 mui-clearfix">
		<header class="mui-bar mui-bar-nav" style="">
			<!--<a class="mui-icon mui-icon-left-nav mui-pull-left" href="javascript:history.back(-1)" style="color: #fff;"></a>-->
			<h1 class="mui-title">登录</h1>
			<!--<a class="mui-icon mui-pull-right right1" href="assets-1.html"><img src="images/icon_setting.png"/></a>-->
		</header>
	</div>
	<div class="kong1"></div>
	<div class="login_section1">
		<div class="container">
			<img src="<?=base_url('public/login/')?>images/send_icon_hc.png" alt="" />
		</div>
	</div>
	<div class="login_section2">
		<div class="container_2">
			<div class="fom">
				<form action="" method="post" id="form">
					<div class="f1 fx">
						<img src="<?=base_url('public/login/')?>images/login_icon_user.png" class="img1"/>
						<input type="text" name="names" id="names" value="" placeholder="请填写用户名/手机号"/>
					</div>
					<div class="f1 ">
						<img src="<?=base_url('public/login/')?>images/login_icon_certification_code.png" class="img1"/>
						<input type="password" name="" id="mak" value="" placeholder="请填写密码"/>
					</div>
					<input type="hidden" name="pasword" id="pasword">
					<div class="sub">
						<input type="submit" value="确定"/>
					</div>					
				</form>
			</div>
			
		</div>
	</div>
	<div class="login_other">
		<div class="container_2">
			<div class="div2 mui-clearfix">
				<p class="p1"><a href="<?=base_url('home/forget')?>">忘记密码</a></p>
				<p class="p2"><a href="<?=base_url('home/resiter')?>">新用户注册</a></p>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript">
	function isMobile(str) {
		var myreg=/^[1][3,4,5,7,8][0-9]{9}$/;
	    if (!myreg.test(str)) {
			return false;
		} else {
			return true;
		}
	}
	$(function(){
		$("#form").submit(function(){			
			var username = $('#names').val(),
			words = $('#mak').val();
			if(!isMobile(username)){mui.toast('请输入正确手机号');return false;}
			if(words == ''){mui.toast('请输入登陆密码');return false;}
			$('#pasword').val($.base64.encode($.base64.encode(words)));
			data = $("#form").serialize();
			$.ajax({
				type:'post',
				url:'<?=base_url('Option/login')?>',
				data:data,
				cache:false,
				dataType:'JSON',
				success:function(data){
					mui.hideLoading();
					if(data.types == 1){setTimeout(function(){window.location.href="<?=base_url('Index/index')?>";},1000)};
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
			return false;
		})
	})

</script>
</html>