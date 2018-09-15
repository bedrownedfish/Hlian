<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>验证助记词</title>
    <link href="<?=base_url()?>public/css/mui.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="<?=base_url()?>public/css/basic.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/login-6.css"/>
    <script src="<?=base_url()?>public/js/mui.min.js"></script>
	<script src="<?=base_url()?>public/js/jquery.js" type="text/javascript" charset="utf-8"></script>
    
</head>
<body>
	<div class="section1 mui-clearfix">
		<header class="mui-bar mui-bar-nav" style="">
			<a class="mui-icon mui-icon-left-nav mui-pull-left" href="javascript:history.back(-1)" style="color: #666;"></a>
			<h1 class="mui-title" style="font-weight: bold;">验证助记词</h1>
			<!--<a class="mui-icon mui-pull-right right1" href="javascript:;" >恢复账号</a>-->
		</header>
	</div>
	<div class="section2">
		<div class="container">
			<div class="section2-1">
				<p>请抄写下你的助记词</p>
			</div>
			<div class="section2-2">
				<p>请按顺序点击助记词，来确认你的助记词备份正确。</p>
			</div>
			<div class="section2-3 mui-clearfix">
				<ul>
					<li>?</li>
					<li>?</li>
					<li>?</li>
					<li>?</li>
					<li>?</li>
					<li>?</li>
					<li>?</li>
					<li>?</li>
					<li>?</li>
					<li>?</li>
					<li>?</li>
					<li>?</li>
				</ul>
			</div>
			<div class="section2-4 mui-clearfix">
				<ul>
					<?php 
					$arr = explode('&', $arrays);
					shuffle($arr);
					foreach ($arr as $k => $v) {
						echo "<li>".$v."</li>";
					};?>
				</ul>
			</div>
			<div class="section2-5 ">
				<a href="<?=base_url()?>home/createSite" class = 'qtypes' style='display:none'>开启会链之旅!</a>
			</div>
		</div>
	</div>
	
</body>

<script type="text/javascript" charset="utf-8">
  	mui.init();
</script>
<script type="text/javascript">

	var number = 0,backupsWord = "";

	$(".section2-4 ul li").click(function(){
		var string = $(this).html();
		if($(this).is('.select')){
			$('.qtypes').hide();
			number--;
			$(this).removeClass('select');
			backupsWord = backupsWord.replace(string+"&","");
			$(".section2-3 ul li").eq(number).html("?");
			return false;
		}
		$(this).addClass("select");
		backupsWord +=string+"&";
		$(".section2-3 ul li").eq(number).html(string)
		if(number == 11){
			if(backupsWord == ("<?php echo $_SESSION['mnemonicWord'];?>"+"&")){
				mui.toast('验证成功');
				$('.qtypes').show().attr({
					'href': '<?=base_url()?>home/createSite'
				});;
				return false;
			}
			mui.confirm('验证失败，是否重置验证！', '提示！', ['取消','确定'], function(e) {
			    if (e.index == 1) {
			        location.reload();
			    } else {
			        mui.toast('请继续验证您的助记词!');
			    }
			})
			
		}
		number++;
	})
	
</script>

</html>