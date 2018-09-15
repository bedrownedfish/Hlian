<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>logo</title>
    <link href="<?=base_url('public/')?>css/mui.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="<?=base_url('public/')?>css/basic.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url('public/')?>css/fqa.css"/>
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
			<p>常见问题</p>
		</div>
	</div>
	<div class="section3">
		<div class="section3-1">
			<ul>
				<?php foreach($code as $k=>$v):?>
				<li class="mui-clearfix">
					<a href="javascript:void(0);" class="mui-clearfix">
						<div class="div1">
							<p class="p1"><?=$v['title']?></p>
							<p class="p2"><?=$v['content']?></p>
						</div>
						<div class="div2">
							<p class="p1"><?=date('Y-m-d',$v['addtime'])?></p>
						</div>
					</a>
				</li>
				<?php endforeach?>
			</ul>
		</div>
	</div>
	
	
	
</body>

<script type="text/javascript" charset="utf-8">
  	mui.init();
</script>


</html>