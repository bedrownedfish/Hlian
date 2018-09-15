<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>index</title>
    <link href="<?=base_url()?>public/css/mui.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="<?=base_url()?>public/css/basic.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/assets.css"/>
</head>
<body>
	<div class="section1 mui-clearfix">
		<header class="mui-bar mui-bar-nav" style="background: #3474FA !important;">
			<a class="mui-icon mui-icon-left-nav mui-pull-left" href="javascript:history.back(-1)" style="color: #fff;"></a>
			<!--<h1 class="mui-title">login</h1>
			<a class="mui-icon mui-pull-right right1" href="<?=base_url()?>index/assets1"><img src="<?=base_url()?>public/images/icon_setting.png"/></a>-->
		</header>
	</div>
	<div class="section2">
		<div class="container">
			<p>增加资产</p>
		</div>
	</div>
	<div class="section3">
		<?php foreach($assets as $k=>$v):?>
			<div class="container">
				<div class="items">
					<div class="items-1 mui-clearfix">
						<div class="items-1-1">
							<img style="width: 48px;height: 48px" src="<?=base_url('public/logo/'.$v['tokname'].'.png')?>"/>
						</div>
						<div class="items-1-2">
							<p class="p1"><?=$v['tokname']=="hlink" ? "H链":$v['tokname'];?></p>
							<p class="p2"><?=substr_replace($v['contract'], "***",5,25)?></p>
						</div>
						<?php if($v['tokname']!="ether"){?>
							<div class="items-1-3 mui-clearfix">
								<div class="mui-switch <?=$v['type']?'mui-active':''?>" data-id = "<?=$v['id']?>" data-type = "<?=$v['type']?>">
									<div class="mui-switch-handle"></div>
								</div>
							</div>
						<?php }?>
					</div>
				</div>
			</div>
		<?php endforeach;?>
	</div>
	<?php $this->load->view('bottmer')?>

</body>
<script src="<?=base_url()?>public/js/mui.min.js"></script>
<script src="<?=base_url()?>public/js/jquery.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
  	mui.init();
</script>
<?php $this->load->view('module/loading')?>
<script type="text/javascript" >
    /*mui('body').on( 'tap' , 'a' , function(){
        document.location.href=this.href;
    })*/
    //扩展mui.showLoading
    $(function(){
    	$(".mui-switch").on("click",function(){
    		var thiss = $(this);
    		var type = -1,cid = $(this).data('id')
			if(!$(this).data('type')){
				type = 1;
			}
			$.ajax({
				type:'post',
				url:'<?=base_url('Operation/category')?>',
				data:{type:type,cid:cid},  
				cache:false,
				dataType:'JSON',
				success:function(data){
					thiss.data('type') ? thiss.data('type', 0) : thiss.data('type', 1);
					mui.hideLoading();
				},
		        error:function(e){
		        	mui.hideLoading();
		        },
		        beforeSend:function(e){
		        	mui.showLoading("正在加载..","div");
		        }
			});
			
		});
    })

</script>
</html>