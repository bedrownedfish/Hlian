<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>index</title>
    <link href="<?=base_url()?>public/css/mui.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="<?=base_url()?>public/css/basic.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/bizhong_neiye.css"/>
    <script type="text/javascript" src="<?=base_url()?>public/js/gg.js"></script>
    
</head>
<body>
	<div class="section1 mui-clearfix">
		<header class="mui-bar mui-bar-nav">
			<a class="mui-icon mui-icon-left-nav mui-pull-left" href="javascript:history.back(-1)" ></a>
			<!--<h1 class="mui-title">login</h1>-->
			<a class="mui-icon mui-pull-right right1" href="javascript:;"><img src="<?=base_url()?>public/images/nav_icon_scan.png" class="ikl" style="width: 1.3rem;" /></a>
		</header>
	</div>
	<div class="section2">
		<div class="container">
			<p><?=$cuarr['nickname']?$cuarr['nickname']:$cuarr['nickname'];?></p>
		</div>
	</div>
	<div class="section3">
		<div class="container" style="width: 100%;word-break: normal|break-all|keep-all;">
			<p class="p1"><img src="<?=base_url()?>public/images/send_icon_hc.png"/></p>
			<p class="p2"><?=$cuarr['nickname']?></p>
			<p class="p3" style="color: #000;margin-top: 15px;font-size: 0.9rem;overflow:hidden; "><?=$cuarr['contract']?></p>
		</div>
	</div>
	<div class="section4">
		<div class="container">
			<div class="section4-1">
				<div class="container-1 mui-clearfix">
					<div class="section4-1-1 mui-clearfix">
						<img src="<?=base_url()?>public/images/icon_total.png" class="im1" />
						<span>全部</span>
						<img src="<?=base_url()?>public/images/detail_icon_pulldown.png" class="im2" />
					</div>
					<div class="section4-1-2 mui-clearfix">
						<div class="section4-1-2-1">
							<p class="p1"><?=number_format($cuarr['moneys'],2)." ".$cuarr['nickname'];?></p>
							<p class="p2"><?=number_format($cuarr['moneys']*$cuarr['price']/$usdrate,2)?> USD</p>
							<p class="p2"><?=number_format($cuarr['moneys']*$cuarr['price'],2)?> CNY</p>
						</div>
						<div class="section4-1-2-2">
							<img src="<?=base_url()?>public/images/image_total_dataline.png"/>
						</div>
					</div>
					<div class="section4-1-3 mui-clearfix">
						<div class="zv">
							<p class="p1"><?=number_format($cuarr['moneys'],2)." ".$cuarr['nickname'];?></p>
							<p class="p2"><?=number_format($cuarr['moneys']*$cuarr['price']/$usdrate,2)?> USD</p>
							<p class="p2"><?=number_format($cuarr['moneys']*$cuarr['price'],2)?> CNY</p>
						</div>
						<div class="zb">
							<div id="mountNode"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="section5">
		<div class="container mui-clearfix">
			<div class="section5-1">
				<a href="<?=base_url()?>index/send?id=<?=$cuarr['id']?>" style="z-index: 99">发送</a>
			</div>
			<div class="section5-2 takein">
				<a href="javascript:;" class="right1">接收</a>
			</div>
		</div>
	</div>
	<div class="section6">
		<div class="container">
			<p class="olo">过渡</p>
		</div>
	</div>
	<div class="section7">
		<div class="zz mui-clearfix">
			<ul>
				<li class="select alls">全部</li>
				<li class="pluss">接收</li>
				<li class="reduces">发送</li>
			</ul>
		</div>
	</div>
	<div class="section8 select" id="dealss">
		<?php foreach($cuarr['deal'] as $key => $value):?>
		<div class="section8-1 <?=$value['accounts']==$cuarr['eth_accounts']?'plus':'reduce'?>" data-money="<?=number_format($value['moneys'],2)." ".$cuarr['nickname'] ?>"data-user="<?=$value['accounts']!=$cuarr['eth_accounts']?$value['accounts']:$value['useraccounts']?>" data-time="<?=date('Y-m-d H:i:s',$value['addtime'])?>" data-accoun="<?=$value['accounts']!=$cuarr['eth_accounts']?$value['accounts']:$cuarr['eth_accounts']?>" data-fee="<?=$value['fee']?>">
			<div class="container mui-clearfix">
				<div class="ab">
					<p class="p1"><?=substr_replace($value['accounts']!=$cuarr['eth_accounts']?$value['accounts']:$value['useraccounts'], "***",5,25)?></p>
					<p class="p2"><?=date('Y-m-d H:i:s',$value['addtime'])?></p>
				</div>
				<div class="ad">
					<p><img src="<?=base_url()?>public/images/icon_<?=$value['accounts']==$cuarr['eth_accounts']?'plus':'reduce'?>.png"/> <span><?=number_format($value['moneys'],2)." ".$cuarr['nickname'] ?></span></p>
				</div>
			</div>
		</div>
		<?php endforeach;?>
	</div>
	<?php if($cuarr['page']):?>
			<div class="section6" id="pages" data-num='1'>
				<div class="ad">
					<p class="p1" style="text-align: center;">加载更多···</p>
				</div>
			</div>
			<div class="section6" id="nulls" style="display: none" data-num='1'>
				<div class="ad">
					<p class="p1" style="text-align: center;">已经到底了</p>
				</div>
			</div>
		<?php endif;if(!$cuarr['deal']):?>
			<div class="section6">
				<div class="ad">
					<p class="p1" style="text-align: center;">暂无记录</p>
				</div>
			</div>
		<?php endif?>
	<div class="section9">
		<div class="container">
			<div class="section9-1">
				<p class="p3"><img src="<?=base_url()?>public/images/icon_hc_03.png"/></p>
				<p class="p1 olo"><?=$cuarr['nickname']?></p>
				<p class="p2"><?=$cuarr['eth_accounts']?></p>
			</div>
			<div class="section9-2" id='qrcode'>
				<!-- <img src="<?=base_url()?>public/images/image_qr_code.png"/> -->
			</div>
			<div class="section9-3">
				<button href="javascript:;" class="copy_btn" data-clipboard-text="<?=$cuarr['eth_accounts']?>">复制</button>
			</div>
			
		</div>
		<div class="section9-4" >
			<img src="<?=base_url()?>public/images/upup.png" class="totle" />
		</div>
	</div>
	<div class="section10">
		
	</div>


	<div class="section13">
		
	</div>
	<div class="section12">
		<div class="container">
			<div class="div1 mui-clearfix">
				<p class="p1" id='dtime'></p>
				<p class="p2"></p>
				<p class="p1" id="duser"></p>
				<p class="p2"></p>
				<p class="p1" id='dmoney'></p>
				<p class="p2"></p>
				<p class="p1" id='dfee'></p>
				<p class="p2"></p>
			</div>
			<div class="div2">
				<span class="close_btn">关闭</span>
			</div>
		</div>
	</div>


</body>
<script src="<?=base_url()?>public/js/mui.min.js"></script>
<script src="<?=base_url()?>public/js/jquery.js"></script>
<script src="<?=base_url()?>public/js/qrcode.min.js"></script>
<script src="<?=base_url()?>public/js/clipboard.js"></script>
<?php $this->load->view('module/loading')?>
<script>
	$(function(){
		var ww = $(window).width();
		var hh = $(window).height();
		$(".section12").css("top",(hh-$(".section12").height())/2)
		$(document).on('click','.section8-1',function(){
			var moneys = $(this).data('money'),
			user = $(this).data('user'),
			time = $(this).data('time'),
			fee = $(this).data('fee'),
			accounts = $(this).data('accoun');
			$('#dtime').html('交易时间'+time);
			$('#duser').html(user==accounts?"发送给:"+user:"发送者:"+user);
			$('#dmoney').html("交易金额："+moneys);
			$('#dfee').html('矿工费：'+fee);
			$(".section12").show();
			$(".section13").show();
		});
		$(".close_btn").click(function(){
			$(".section12").hide();
			$(".section13").hide();
		})
	})
</script>
<script type="text/javascript">
	$(document).ready(function(){
        var clipboard = new Clipboard('.copy_btn');
        clipboard.on('success', function(e) {
            mui.toast('复制成功！');
            e.clearSelection();
        });
    });
	$('#qrcode').qrcode({
	    render: "canvas", //也可以替换为table
	    width: 220,
	    height: 220,
	    text: '<?=$cuarr['eth_accounts']?>'
	});
	$(function() {
		var r = 0;
		$('.im2').click(function() {
			r += 180;
			$(this).css('transform', 'rotate(' + r + 'deg)');
			$(".section4-1-2").slideToggle();
			$(".section4-1-3").slideToggle(500);
		});
	});
	$(function(){
		$(".zz li").click(function(){
			$(this).addClass("select").siblings().removeClass("select");
			$(this).hasClass('alls') && $('.plus,.reduce').show();
			$(this).hasClass('pluss') && $('.plus').show() && $('.reduce').hide();
			$(this).hasClass('reduces') && $('.reduce').show() && $('.plus').hide();
			// $(".section8").eq($(this).index()).addClass("select").siblings().removeClass("select")
		})
	})
	$(function(){
		$(".right1,.takein").click(function(){
			$(".section9").slideDown();
			$(".section10").show();
		});
		$(".section10").click(function(){
			$(".section9").slideUp();
			$(".section10").hide();
		});
	})
	$('#pages').on('click', function(event) {
		var num = $(this).data('num'),
		id = <?=$_GET['id']?>,
		athis=$(this);

		$.ajax({
			type:'post',
			url:'<?=base_url('Operation/dealPage')?>',
			data:{page:num,id:id},
			cache:false,
			dataType:'JSON',
			success:function(data){
				console.log(data)
				mui.hideLoading();
				var html='';
				$.each(data.deal,function(index, el) {
					var clas = el.accounts==data.eth_accounts?'plus':'reduce',
					user = el.accounts!=data.eth_accounts?el.accounts:el.useraccounts,
					accoun = el.accounts!=data.eth_accounts?el.accounts:data.eth_accounts;
					html += '<div class="section8-1 '+clas+'" data-id="'+el.id+'" data-money="'+el.moneys+data.nickname+'" data-user="'+user+'" data-accoun="'+accoun+'"data-time="'+el.addtime+'" data-fee="'+el.fee+data.nickname+'">'
							+'<div class="container mui-clearfix">'
							+'<div class="ab">'
							+'<p class="p1">'+el.accountstr+'</p>'
							+'<p class="p2">'+el.addtime+'</p>'
							+'</div>'
							+'<div class="ad">'
							+'<p><img src="<?=base_url()?>public/images/icon_'+clas+'.png"/> <span>'+el.moneys+data.nickname+'</span></p>'
							+'</div></div></div>';
				});
				if(data.deal.length<10){
					$('#pages').hide();
					$('#nulls').show();
				}
				$('#dealss').append(html);
				athis.data('num', num+1);
			},
		    error:function(e){
		       	console.log(e);
		       	mui.hideLoading();
		    },
		    beforeSend:function(e){
		       	mui.showLoading("玩命加载中..","div");
		    }
		});
	});
</script>
<script>
	var data = <?=json_encode($chart)?>;
	var chart = new G2.Chart({
		container: 'mountNode',
		forceFit: true,
		height: 200,
		padding: [ 20, 20, 40, 40]
	});
	chart.source(data);
	chart.scale('moneys', {
		min: 0
	});
	chart.scale('year', {
		range: [0, 1]
	});
	chart.tooltip({
		crosshairs: {
			type: 'line'
		}
	});
	chart.line().position('year*moneys');
	chart.point().position('year*moneys').size(4).shape('circle').style({
		stroke: '#fff',
		lineWidth: 1
	});
	chart.render();
</script>
</html>