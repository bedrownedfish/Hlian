<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>历史</title>
    <link href="<?=base_url('public/')?>css/mui.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="<?=base_url('public/')?>css/basic.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url('public/')?>css/history.css"/>
    <script src="<?=base_url('public/')?>js/mui.min.js"></script>
	<script src="<?=base_url('public/')?>js/jquery.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
	<div class="section1 mui-clearfix">
		<header class="mui-bar mui-bar-nav" >
			<a class="mui-icon mui-icon-left-nav mui-pull-left" href="javascript:history.back(-1)" style="color: #3474FA;"></a>
			<!--<h1 class="mui-title">login</h1>-->
			<!--<a class="mui-icon mui-pull-right right1" href="javascript:;"><img src="images/nav_icon_management.png"/></a>-->
		</header>
	</div>
	<div class="section2">
		<div class="container mui-clearfix">
			<p class="p1">历史</p>
			<p class="p2">只提供每月最后100个交易</p>
		</div>
	</div>
	<div class="section3">
		<div class="container mui-clearfix">
			<ul class="zv">
				<li class="all"><a href="javascript:void(0);" class="s1 select">全部</a></li>
				<li class="send"><a href="javascript:void(0);" class="s1">接收</a></li>
				<li class="receive"><a href="javascript:void(0);" class="s1">发送</a></li>
			</ul>
		</div>
	</div>
	<div class="section4">
			<div class="items select">
				<?php foreach($code as $k =>$v):?>
				<div class="items-1">
					<div class="title">
						<div class="container">
							<p><?=$k?></p>
						</div>
						
					</div>
					<?php foreach($v as $key=>$value):?>
					<div class="center<?=$value['userid']!=$this->session->userid?'':'1'?>">
						<div class="container mui-clearfix">
							<div class="div1">
								<img src="<?=base_url('public/')?>images/pl<?=$value['userid']!=$this->session->userid?'2':'1'?>.png"/>
							</div>
							<div class="div2">
								<p class="p1">
									<?=substr_replace($value['accounts'], "***",5,30)?>
								</p>
								<p class="p2">
									<?=date('Y-m-d h:i:s',$value['addtime'])?>
								</p>
							</div>
							<div class="div3">
								<?=number_format(abs($value['moneys']),2)?> H链
							</div>
						</div>
					</div>
					<?php endforeach?>
				</div>
				<?php endforeach?>
			</div>			
	</div>
	
	
	
	
</body>

<script type="text/javascript" charset="utf-8">
  	mui.init();
</script>
<script type="text/javascript">
	$(function(){
		var aa = $(".zv li");
		aa.click(function(){
			$(this).children().addClass("select").parent().siblings().children().removeClass("select");
			$(this).hasClass('all') && $('.center,.center1').show(); 
			$(this).hasClass('send') &&  $('.center').show() && $('.center1').hide();
			$(this).hasClass('receive') &&  $('.center1').show() && $('.center').hide();

		})
	})
</script>


</html>