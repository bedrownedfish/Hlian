<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>login-3</title>
    <link href="<?=base_url('public/')?>css/mui.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="<?=base_url('public/')?>css/basic.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url('public/')?>css/login-7.css"/>
    <script src="<?=base_url('public/')?>js/mui.min.js"></script>
	<script src="<?=base_url('public/')?>js/jquery.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?=base_url()?>public/js/jquery.base64.js" type="text/javascript" charset="utf-8"></script>
	<?php $this->load->view('module/loading')?>
    
</head>
<body>
	<div class="section1 mui-clearfix">
		<header class="mui-bar mui-bar-nav" style="">
			<a class="mui-icon mui-icon-left-nav mui-pull-left" href="javascript:history.back(-1)" style="color: #666;"></a>
			<h1 class="mui-title" style="font-weight: bold;">恢复账号</h1>
			<!--<a class="mui-icon mui-pull-right right1" href="javascript:;" >恢复账号</a>-->
		</header>
	</div>
	<div class="section2">
		<div class="container">
			<div class="section2-1">
				<p>请顺序输入下你的助记词</p>
			</div>
			<form action="">
				<div class="section2-3 mui-clearfix">
					<input type="text" class="word" placeholder="?"/>
					<input type="text" class="word" placeholder="?"/>
					<input type="text" class="word" placeholder="?"/>
					<input type="text" class="word" placeholder="?"/>
					<input type="text" class="word" placeholder="?"/>
					<input type="text" class="word" placeholder="?"/>
					<input type="text" class="word" placeholder="?"/>
					<input type="text" class="word" placeholder="?"/>
					<input type="text" class="word" placeholder="?"/>
					<input type="text" class="word" placeholder="?"/>
					<input type="text" class="word" placeholder="?"/>
					<input type="text" class="word" placeholder="?"/>
				</div>
				<div class="section2-4">
					<input type="password" id="password" name='p' placeholder="输入密码"/>
				</div>
				<div class="section2-6">
					<li class="mui-table-view-cell mui-checkbox mui-left">
						<input id="checkboxs" name="checkbox" type="checkbox">&nbsp;
					</li>
					<p>我已仔细阅读并同意 <a href="javascript:void(0);">服务隐私条款</a></p>
				</div>
				
				<div class="section2-5 works">
					<input type="button"  value="开始导入" />
				</div>
			</form>
		</div>
	</div>
	
</body>

<script type="text/javascript" charset="utf-8">
  	mui.init();
</script>
<script type="text/javascript">
	var e = 0;
	$(".section2-4 ul li").click(function(){
		$(this).addClass("select");
		var aa = $(this).index();
		$(".section2-3 ul li").eq(aa).html($(this).text())
	})
	$('.mui-checkbox').on('change','input', function(event) {
		if($('#checkboxs').is(':checked'))e = 1;
		if(!$('#checkboxs').is(':checked'))e = 0;
	});
	$('.works').click(function(event) {
		var a = "",b=1;
		$('.word').each(function(index, el) {
			a+=$(this).val()+',';
			if($(this).val() == "")b=0;
		});
		if(!b){ 
        	mui.toast('您的助记词不足12个');
        	return false;
    	}
    	if(!e) {mui.toast('请确认服务条款');return false};
    	var c = $('#password').val();
    	if(c.length<8) {mui.toast('密码不小于8位数');return false};
    	$.ajax({
			type:'post',
			url:'<?=base_url('Home/restAccount')?>',
			data:{mnemonicWord:a,code:$.base64.encode($.base64.encode(c))},
			cache:false,
			dataType:'JSON',
			success:function(data){
				console.log(data)
				mui.hideLoading();
				if(data.types == 1){setTimeout(function(){window.location.href="<?=base_url('Index/index')?>";},1000)};
				mui.toast(data.message);
								
			},
		    error:function(e){
		       	console.log(e);
		       	mui.hideLoading();
		    },
		    beforeSend:function(e){
		       	mui.showLoading("正在修改..","div");
		    }
		});

	});
	
</script>

</html>