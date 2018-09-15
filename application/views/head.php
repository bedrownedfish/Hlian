<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>logo</title>
    <link href="<?=base_url('public/')?>css/mui.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="<?=base_url('public/')?>css/basic.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url('public/')?>css/head.css"/>
    <script src="<?=base_url('public/')?>js/mui.min.js"></script>
	<script src="<?=base_url('public/')?>js/jquery.js" type="text/javascript" charset="utf-8"></script>
  	<script type="text/javascript">
	    mui.init();
	    function setimage(images){
	    	$('#upimage').attr('src','<?=base_url()?>'+images);
	    }
	    function scanDemos(){
	        var browser = {
				versions: function () {
					var u = navigator.userAgent,
					app = navigator.appVersion;
					return { 
						ios: !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/), 
						android: u.indexOf('Android') > -1 || u.indexOf('Linux') > -1, //android终端或uc浏览器 
						iPhone: u.indexOf('iPhone') > -1, //是否为iPhone或者QQHD浏览器 
						iPad: u.indexOf('iPad') > -1, //是否iPad 
					};
				}(),
	        }
	        if (browser.versions.iPhone || browser.versions.iPad || browser.versions.ios) {
	            setTimeout(function(){
					$(".section4").slideDown();
				},0);
	        }
	        if (browser.versions.android) {
	            //console.log(getQueryString('app'))
	          if(getQueryString('app') == 1){
	          	android.uploadImage(<?=$this->session->userid?>);
	          }else{
	             setTimeout(function(){
					$(".section4").slideDown();
				},0);
	          }
	        }
	    }    
	    function getQueryString(name) {
	        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
	        var reg_rewrite = new RegExp("(^|/)" + name + "/([^/]*)(/|$)", "i");
	        var r = window.location.search.substr(1).match(reg);
	        var q = window.location.pathname.substr(1).match(reg_rewrite);
	        if(r != null){
	            return unescape(r[2]);
	        }else if(q != null){
	            return unescape(q[2]);
	        }else{
	            return null;
	        }
	    }
    </script>
</head>
<body>
	<div class="section1 mui-clearfix">
		<header class="mui-bar mui-bar-nav" >
			<a class="mui-icon mui-icon-left-nav mui-pull-left" href="javascript:history.back(-1)" style="color: #fff;"></a>
			<!--<h1 class="mui-title">login</h1>-->
			<a class="mui-icon mui-pull-right right1" href="javascript:;"><img src="<?=base_url('public/')?>images/nav_icon_share_w.png"/></a>
		</header>
	</div>
	<div class="section2">
		<div class="container">
			<p>更换头像</p>
		</div>
	</div>
	<div class="section3">
		<div class="container">
			<img id='upimage' src="<?=base_url($images)?>"/>
		</div>
	</div>
	<div class="section4">
		<div class="container">
			<div class="section4-1">
				<ul>
					<li><a href="javascript:void(0);">选择</a></li>
					<li class="ted"><a href="javascript:void(0);" >取消</a></li>

				</ul>
			</div>
		</div>
	</div>
	
</body>

<script type="text/javascript" charset="utf-8">
  	
</script>
<script type="text/javascript">
	$(function(){
		$('.section3').click(function(event) {
			/*setTimeout(function(){
				$(".section4").slideDown();
			},0);*/
          	scanDemos();
		});
		
		$(".ted").click(function(){
			$(".section4").slideUp();
		})
	})
</script>

</html>