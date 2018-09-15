<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>news</title>
    <link href="<?=base_url()?>public/css/mui.min.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/swiper.min.css"/>
    <link rel="stylesheet" href="<?=base_url()?>public/css/basic.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/news.css"/>
    <script src="<?=base_url()?>public/js/mui.min.js"></script>
	<script src="<?=base_url()?>public/js/jquery.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?=base_url()?>public/js/swiper.min.js" type="text/javascript" charset="utf-8"></script>
    
</head>
<body>
	
	<div class="section2">
		<div class="container mui-clearfix">
			<p class="p1">推荐</p>
		</div>
	</div>
	<div class="section3">
		<div class="ppp">
			<div class="swiper-container">
			    <div class="swiper-wrapper">
			    	<?php foreach($slideshow as $k=>$v):?>
			        	<div class="swiper-slide"><a href="javascript:;"><img src="<?=base_url($v['imgs'])?>"/></a></div>
			    	<?php endforeach?>
			    </div>
			    <div class="swiper-pagination"></div>
			
			
			</div>
		</div>
	</div>
	<div class="section4">
		<div class="container mui-clearfix">
			<p class="p1">新闻公告</p>
		</div>
	</div>
	<div class="section5">
		<?php foreach($news as $key=>$value):?>
		<div class="section5-1">
			<a href="<?=base_url('index/new_go?id='.$value['id'])?>">
				<div class="container mui-clearfix">
					<div class="section5-1-1">
						<p class="p1"><?=$value['title']?></p>
						<p class="p2"><?=date('Y-m-d H:i:s',$value['addtime'])?></p>
					</div>
					<div class="section5-1-2">
						<img src="<?=base_url($value['images'])?>"/>
					</div>
				</div>
			</a>
		</div>
	<?php endforeach?>
	</div>
	<?php $this->load->view('bottmer');?>
</body>

<script type="text/javascript" charset="utf-8">
  	mui.init();
</script>
<script>
    var swiper = new Swiper('.swiper-container', {
        spaceBetween: 30,
        centeredSlides: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },

    });
</script>
</html>