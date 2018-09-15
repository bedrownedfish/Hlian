<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>卡券</title>
    <link href="<?=base_url()?>public/css/mui.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="<?=base_url()?>public/css/basic.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/exchange.css"/>
    
</head>
<body>
	
	<div class="section2">
		<div class="container mui-clearfix">
			<p class="p1">卡券</p>
		</div>
	</div>
	<div class="section3">
		<div class="kaquan_section1">
			<div class="container">
				<div class="a1">
					<div class="a1_1">
						<div class="a1_1_1 mui-clearfix">
							<img src="<?=base_url()?>public/images/activity_pay_title.png" alt="" />
							<p class="p1">高尔夫俱乐部</p>
							<p class="p2"><span>2.5</span> 折</p>
						</div>
						
					</div>
					<div class="a1_2">
							<p class="p1">地址：山东省临沂市兰山区南京路707</p>
						</div>
				</div>
				<div class="a1">
					<div class="a1_1">
						<div class="a1_1_1 mui-clearfix">
							<img src="<?=base_url()?>public/images/activity_pay_title2.png" alt="" />
							<p class="p1">游艇俱乐部</p>
							<p class="p2"><span>2.5</span> 折</p>
						</div>
						
					</div>
					<div class="a1_2">
							<p class="p1">地址：山东省临沂市兰山区南京路707</p>
						</div>
				</div>
			</div>
		</div>
	</div>
	<?php $this->load->view('bottmer');?>
</body>
<script src="<?=base_url()?>public/js/mui.min.js"></script>
<script src="<?=base_url()?>public/js/jquery.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
  	mui.init();
</script>
</html>