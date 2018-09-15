<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>login-2</title>
    <link href="<?=base_url()?>public/css/mui.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="<?=base_url()?>public/css/basic.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/login-2.css"/>
    <script src="<?=base_url()?>public/js/mui.min.js"></script>
	<script src="<?=base_url()?>public/js/jquery.js" type="text/javascript" charset="utf-8"></script>
    
</head>
<body>
	<div class="section1 mui-clearfix">
		<header class="mui-bar mui-bar-nav" style="">
			<!--<a class="mui-icon mui-icon-left-nav mui-pull-left" href="javascript:history.back(-1)" style="color: #3474FA；"></a>-->
			<h1 class="mui-title" style="font-weight: bold;">特别提示</h1>
			<a class="mui-icon mui-pull-right right1" href="<?=base_url('home/backupsword1')?>" style="font-size: 0.9rem;color: #FEE265;padding-top: 14px;">恢复账号</a>
		</header>
	</div>
	<div class="section2">
		<div class="container">
			<div class="section2-1">
				<img src="<?=base_url()?>public/images/dengpao.png"/>
			</div>
			<div class="section2-2">
				<p>产品是钱包，请一定抄好12个助记词，您只可以用这些单词恢复您的账户！一旦丢失，您的币将无法找回！因此请：</p>
			</div>
			<div class="section2-3">
				<p>不要卸载</p>
				<p>不要清除应用数据</p>
				<p>抄好12个助记词，并秘密保管</p>
			</div>
		</div>
	</div>
	<div class="section3">
		<div class="container">
			<a href="<?=base_url()?>home/setPass">确定</a>
		</div>
	</div>
</body>

<script type="text/javascript" charset="utf-8">
  	mui.init();
</script>
</html>