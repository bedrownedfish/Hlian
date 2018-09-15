<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>us</title>
    <link href="<?=base_url()?>public/css/mui.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="<?=base_url()?>public/css/basic.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/us.css"/>
    <script src="<?=base_url()?>public/js/mui.min.js"></script>
	<script src="<?=base_url()?>public/js/jquery.js" type="text/javascript" charset="utf-8"></script>
    
</head>
<style type="text/css">
	.section2{
		padding: 10px 0px;
	}
	.section2 p{

	}
</style>
<body>
	
	<div class="section2">
		<div class="container mui-clearfix">
			<p style="float: left;">个人资料</p> <a style="float: right;" class="mui-icon mui-pull-right right1" href="<?=base_url('index/setting')?>"><img src="<?=base_url()?>public/images/nav_profile_icon_setting.png" style="width: 1.5rem;"/></a>
		</div>
	</div>
	<div class="section3">
		<div class="container">
			<div class="section3-1 mui-clearfix">
				<div class="section3-1-1">
					<a href="<?=base_url('index/head')?>">
						<img style="width: 6.5rem;height: 6.5rem;border-radius: 50%" src="<?=base_url($users['portrait'])?>"/>
					</a>
				</div>
			</div>
			<!--<div class="section3-2 mui-clearfix">
				<a href="login.html">登录</a> <span>|</span> <a href="register.html">注册</a>
			</div>-->
			<div class="section3-3">
				<p><?=$users['nickname']?></p>
			</div>
		</div>
	</div>
	<div class="section4">
		<div class="container">
			<div class="section4-1 mui-clearfix">
				<ul>
					<li>
						<a href="<?=base_url()?>index/ment_go">
							<img src="<?=base_url()?>public/images/profile_icon_management3.png"/>
							<p>管理</p>
						</a>
					</li>
					<li><a href="<?=base_url()?>index/history">
							<img src="<?=base_url()?>public/images/profile_icon_history3.png"/>
							<p>历史</p>
						</a>
					</li>
					<li>
						<a href="<?=base_url()?>index/feedback">
							<img src="<?=base_url()?>public/images/profile_icon_order3.png"/>
							<p>建议反馈</p>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="section5">
		<div class="section5-1 mui-clearfix">
			<ul>
				<li>
					<a href="<?=base_url()?>index/message" class="mui-clearfix">
						<p class="p1 mui-clearfix">
							<img src="<?=base_url()?>public/images/profile_icon_message.png"/ class="img1">
							<span class="span1">消息</span>
							<img src="<?=base_url()?>public/images/profile_icon_crow_right.png" class="img2"/>
							<?php if($numbers):?>
								<span class="span2"><?=$numbers?></span>
							<?php endif?>
						</p>
					</a>
				</li>
				<li>
					<a href="<?=base_url()?>index/rate" class="mui-clearfix">
						<p class="p1 mui-clearfix">
							<img src="<?=base_url()?>public/images/profile_icon_rate_calculation.png"/ class="img1">
							<span class="span1">计算汇率</span>
							<img src="<?=base_url()?>public/images/profile_icon_crow_right.png" class="img2"/>
							<!--<span class="span2">2</span>-->
						</p>
					</a>
				</li>
				<li style="margin-top: 20px;">
					<a href="<?=base_url()?>index/fqa" class="mui-clearfix">
						<p class="p1 mui-clearfix">
							<img src="<?=base_url()?>public/images/profile_icon_fqa.png"/ class="img1">
							<span class="span1">常见问题</span>
							<img src="<?=base_url()?>public/images/profile_icon_crow_right.png" class="img2"/>
							<!--<span class="span2">2</span>-->
						</p>
					</a>
				</li>
				<li>
					<a href="<?=base_url()?>index/about_us" class="mui-clearfix">
						<p class="p1 mui-clearfix">
							<img src="<?=base_url()?>public/images/profile_icon_aboutus.png"/ class="img1">
							<span class="span1">关于我们</span>
							<img src="<?=base_url()?>public/images/profile_icon_crow_right.png" class="img2"/>
							<!--<span class="span2">2</span>-->
						</p>
					</a>
				</li>
				
			</ul>
		</div>			
	</div>
	<?php $this->load->view('bottmer')?>
</body>

<script type="text/javascript" charset="utf-8">
  	mui.init();
  	
</script>

</html>