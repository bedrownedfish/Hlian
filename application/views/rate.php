<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>logo</title>
    <link href="<?=base_url('public/')?>css/mui.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="<?=base_url('public/')?>css/basic.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url('public/')?>css/rate.css"/>
    <script src="<?=base_url('public/')?>js/mui.min.js"></script>
	<script src="<?=base_url('public/')?>js/jquery.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
	<div class="section1 mui-clearfix">
		<header class="mui-bar mui-bar-nav" >
			<a class="mui-icon mui-icon-left-nav mui-pull-left" href="javascript:history.back(-1)" style="color: #3474FA;"></a>
			<!--<h1 class="mui-title">login</h1>-->
			<a class="mui-icon mui-pull-right right1" href="javascript:;"><img src="<?=base_url('public/')?>images/nav_icon_share_w.png"/></a>
		</header>
	</div>
	<div class="section2">
		<div class="container">
			<p>汇率</p>
		</div>
	</div>
	<div class="section3">
		<div class="container">
			<div class="section3-1">
				<?php foreach($code as $k=>$v):?>
					<p><img src="<?=base_url($v['ico'])?>"/> <span>1 <?=$v['currency']?> ≈ <?=$v['ratio'].' '.$v['currency_t']?></span> <img src="<?=base_url($v['ico_t'])?>"/></p>
				<?php endforeach?>
			</div>
		</div>
	</div>
	<div class="section4">
		<div class="container">
			<div class="title">
				<p>汇率</p>
			</div>
			<div class="center">
				<p><?=$rate['rate']?></p>
			</div>
		</div>
	</div>
	
	
	
</body>

<script type="text/javascript" charset="utf-8">
  	mui.init();
</script>


</html>