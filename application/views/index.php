<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>首页</title>
    <link href="<?=base_url()?>public/css/mui.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="<?=base_url()?>public/css/basic.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/index.css"/>
    
</head>
<body>
	<div class="section2">
		<div class="container">
			<div class="b1">
				<div class="section2-1 mui-clearfix">
					<p class="p1">我的钱包</p>
					<p class="p2"><a href="<?=base_url()?>index/assets"><img src="<?=base_url()?>public/images/jia.png"/></a></p>
				</div>
				<div class="section2-2 mui-clearfix">
					<p><?=number_format($moneys['moneys'],2)?></p>
				</div>
				<div class="section2-3 mui-clearfix">
					<div class="section2-3-1 mui-clearfix">
						<div class="section2-3-1-1">
							<img src="<?=base_url()?>public/images/icon_income_w.png"/>
						</div>
						<div class="section2-3-1-2">
							<p>收入</p>
							<p>$<?=number_format($deal['income'],2)?></p>
						</div>
						
					</div>
					<div class="section2-3-2 mui-clearfix">
						<div class="section2-3-2-1">
							<img src="<?=base_url()?>public/images/icon_expense.png"/>
						</div>
						<div class="section2-3-2-2">
							<p>支出</p>
							<p>$<?=number_format(abs($deal['expend']),2)?></p>
						</div>
					</div>
				</div>
			</div>
			<div class="b2">
				<div class="zv mui-clearfix">
					<p class="p1">
						$<?=number_format($moneys['moneys'],2)?>
					</p>
					<div class="p2">
						<a href="javascript:void(0);"><img src="<?=base_url()?>public/images/jia.png"/></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="gkl"></div>
	<div class="section3">
		<div class="container">
			<div class="items">
				<?php foreach($kinds as $k =>$v ):?>
				<a href="<?=base_url()?>index/bizhong_neiye?id=<?=$v['id']?>">
					<div class="items-1 mui-clearfix">
						<div class="items-1-1">
							<img style="width: 48px;height: 48px" src="<?=base_url('public/logo/'.$v['tokname'].'.png')?>"/>
						</div>
						<div class="items-1-2">
							<p class="p1"><?=$v['nickname'] == '' ? $v['tokname'] : $v['nickname']?></p>
							<p class="p2"><?=substr_replace($v['contract'], "***",5,30)?></p>
						</div>
						<div class="items-1-3">
							<p class="p1"><?=number_format($moneys[$v['tokname']]/$v['price'],2)?></p>
							<p class="p2">= $<?=number_format($moneys[$v['tokname']],2)?></p>
						</div>
					</div>
				</a>
				<?php endforeach;?>
			</div>
		</div>
	</div>
	<?php $this->load->view('bottmer')?>
</body>
<script src="<?=base_url()?>public/js/mui.min.js"></script>
<script src="<?=base_url()?>public/js/jquery.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
  	mui.init();
  	if(!'<?=$userarr['eth_accounts']?>'){
  		mui.confirm('您的账户存在异常将无法执行转账等操作,是否联系管理员紧急处理', '警告', ['取消','确定'], function(e) {
			if (e.index == 1) {
				window.location.href="<?=base_url('Index/feedback')?>";
			} else {

			}
		})
  	}
</script>

<script>
	var startPoint = null;
    document.addEventListener("touchstart",function(e){
    	var e = e||window.event;
    	startPoint = e.touches[0];
    })
    document.addEventListener("touchend",function(e){
    		var e=e||window.event;
    		//e.changedTouches能找到离开手机的手指，返回的是一个数组
    		var endPoint = e.changedTouches[0];
    		//计算终点与起点的差值
    		var x = endPoint.clientX - startPoint.clientX;
    		var y = endPoint.clientY - startPoint.clientY;
    		//设置滑动距离的参考值
    		var d = 10;
    		if(Math.abs(x)>d){
    			if(x>0){
    			console.log("向右滑动");
    			}else{
    			console.log("向左滑动");
    			}
    		}
    		if(Math.abs(y)>d){
    			if(y>0){
    			console.log("向下滑动");
    			$(".b1").show();
				$(".b2").hide();
				$(".gkl").css("height",217);
    			
    			}else{
    			console.log("向上滑动");
    			$(".b1").hide();
				$(".b2").show();
				$(".gkl").css("height",80);
    			
    			}
    		}
    	
    })

</script>

</html>