<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>login-3</title>
    <link href="<?=base_url()?>public/css/mui.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="<?=base_url()?>public/css/basic.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/login-5.css"/>
    <script src="<?=base_url()?>public/js/mui.min.js"></script>
	<script src="<?=base_url()?>public/js/jquery.js" type="text/javascript" charset="utf-8"></script>
    
</head>
<body>
	<div class="section1 mui-clearfix">
		<header class="mui-bar mui-bar-nav" style="">
			<a class="mui-icon mui-icon-left-nav mui-pull-left" href="javascript:history.back(-1)" style="color: #666;"></a>
			<h1 class="mui-title" style="font-weight: bold;">备份助记词</h1>
			<!--<a class="mui-icon mui-pull-right right1" href="javascript:;" >恢复账号</a>-->
		</header>
	</div>
	<div class="section2">
		<div class="container">
			<div class="section2-1">
				<p>请抄写下你的助记词</p>
			</div>
			<div class="section2-2">
				<p>请用安全的笔记方式，来记录您的助记词备份。(建议不要使用截图方式，以免被盗取)</p>
			</div>
			<div class="section2-3 mui-clearfix">
				<?php $arr = explode('&', $arrays);
				?>
				<ul>
					<?php foreach ( $arr as $key => $value) {
						echo "<li>".$value."</li>";
					};?>
				</ul>
			</div>
			<!--<div class="section2-4 mui-clearfix">
				<ul>
					<?php 
					shuffle($arr);
					foreach ($arr as $k => $v) {
						echo "<li>".$v."</li>";
					};?>
				</ul>
			</div>-->
			<div class="section2-5" id ="qtypes">
				<a href="<?=base_url('home/backupsWord?mnemonicWord='.implode(',',explode('&', $arrays)).',')?>">下一步</a>
			</div>
		</div>
	</div>
	<div class="sectionboa"></div>
	<div class="sectionbod">
			<div class="sectionbod_1">
				<p class="p3"><img src="<?=base_url('public/images/xxuuii.png')?>"/></p>
				<p class="p1">请勿截图</p>
				<p class="p2">建议不要截屏,用纸笔抄写在保密的地方，一旦助记词丢失，您的资产将很难恢复。</p>
				<p class="p4"><a href="javascript:void(0);" class="close_know">知道了</a></p>
			</div>
	</div>
	
</body>

<script type="text/javascript" charset="utf-8">
  	mui.init();
</script>
<script type="text/javascript">
	$(function(){
		var dfg = $(window).height()-$(".sectionbod").height();
		$(".sectionbod").css("top",dfg/2);
		$(".close_know").click(function(){
			$(".sectionbod").hide();
			$(".sectionboa").hide();
		})
	})
	var string = "",number = 0,getstr = "";
	$(".section2-4 ul li").click(function(){
		
		if($(this).is('.select')){
			number--;
			string = string.replace($(this).html()+"&","");
			getstr = getstr.replace($(this).html()+",","");
		}else{

			number++;
			string += $(this).html()+"&";
			getstr += $(this).html()+",";

		}
		console.log(string)
		$(this).toggleClass("select");

		

		if(number == 12){
			/*console.log(string);
			console.log("<?php echo $arrays.'&';?>")*/
			if("<?php echo $arrays.'&';?>" == string ){
				mui.toast('助记词验证成功！');
				$("#qtypes").show();
				$("#qtypes a").attr('href','<?=base_url()?>home/backupsWord?mnemonicWord='+getstr);
			}else{
				mui.confirm('验证失败，是否重新验证！', '提示！', ['取消','确定'], function(e) {
			        if (e.index == 1) {
			            location.reload();
			        } else {
			            mui.toast('请继续验证您的助记词');
			        }
			    })

			}
		}
	})
	
</script>

</html>