<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>index</title>
    <link href="<?=base_url()?>public/css/mui.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="<?=base_url()?>public/css/basic.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/send.css"/>
    <script src="<?=base_url()?>public/js/mui.min.js"></script>
	<script src="<?=base_url()?>public/js/jquery.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?=base_url()?>public/js/jquery.base64.js" type="text/javascript" charset="utf-8"></script>
	<?php $this->load->view('module/loading')?>
    <script type="text/javascript">
	    mui.init();
	    function setaccounts(images){
	    	$('#accounts').val(images);
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
	            if(getQueryString('app') == 2){
	              try {
	                 window.webkit.messageHandlers.capture.postMessage('abc');
	              }
	              catch (exception) {

	              }
	            }else{
					mui.toast('不支持苹果浏览器扫描');
	            }
	        }
	        if (browser.versions.android) {
	            //console.log(getQueryString('app'))
				if(getQueryString('app') == 1){
					android.capture();
				}else{
					mui.toast('不支持浏览器扫描');
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
			<a class="mui-icon mui-icon-left-nav mui-pull-left" href="javascript:history.back(-1)" style="color: #3474FA;"></a>
			<!--<h1 class="mui-title">login</h1>-->
			<a class="mui-icon mui-pull-right right1" href="javascript:;"></a>
		</header>
	</div>
	<div class="section2">
		<div class="container mui-clearfix">
			<p class="p1"><?=$arr['nickname']?> 发送</p>
			<p class="p2"><img src="<?=base_url()?>public/images/icon_hc_03.png"/></p>
		</div>
	</div>
	<div class="section3">
		<div class="container mui-clearfix">
				<div class="f1">
					<input type="text" name="accounts" id="accounts" value="<?=$_GET['accounts']?>" placeholder="钱包地址"/>
					<img src="<?=base_url()?>public/images/send_icon_qr_code.png" onClick="scanDemos()" alt="" class="im1"/>
				</div>
				<div class="f2 mui-clearfix" hidden id="fees">
					<p class="p1"><span>矿工费：<span id="fe"></span></span></p>
				</div>
				<div class="f1">
					<input type="number" name="moneys" id="moneys" placeholder="交易金额" />
				</div>
				<div class="f2 mui-clearfix">
					<p class="p1"><img src="<?=base_url()?>public/images/icon_total.png"/> <span>可用数量：<?=number_format($arr['moneys'],2)."    ".$arr['nickname']?></span></p>
					<p class="p2" id='max'><a href="javascript:;">最大数量</a></p>
				</div>
				<div class="f1">
					<input type="text" name="remark" id="remark" placeholder="备注" />
					<input type="hidden" id="tokname" value="<?=$arr['tokname']?>" />
				</div>
				<div class="sub">
					<input type="submit" value="发送"/>
				</div>
		</div>
	</div>
	<?php $this->load->view('bottmer')?>
</body>

<script type="text/javascript" charset="utf-8">
var fee = <?=$arr['fee']?>,
nickname = "<?=$arr['nickname']?>";
$("#moneys").bind('input propertychange',function(){
	var mone = $(this).val();
	$('#fees').show();
	$('#fe').html(mone*fee/100+nickname+'&nbsp; &nbsp; &nbsp; 扣除'+(parseInt(mone)+(mone*fee/100))+nickname);
	if(mone==''){
		$('#fees').hide();
	}
});
  	
$('.sub').click(function(){
	var accounts = $('#accounts').val(),moneys = $('#moneys').val(),remark = $('#remark').val();
	if(accounts == "" || accounts.length!=42) {mui.toast('请输入有效的钱包地址!');return false};
	if(moneys == "" || (parseInt(moneys)+moneys*fee*100/10000)><?=$arr['moneys']?>) {mui.toast('请输入有效的交易金额!');return false};
	var btnArray = ['取消', '确定'];
  	mui.confirm('<input type="password" id="test" />', '请输入密码', null, function(event) {
	    var index = event.index;
	    if(index === 1) {
	        var pwd = $('#test').val();
	        if(pwd ==''){mui.toast('请输入密码!');return false;}
	        $.ajax({
				type:'post',
				url:'<?=base_url('Operation/sendCurr')?>',
				data:{accounts:accounts,moneys:moneys,code:$.base64.encode($.base64.encode(pwd)),remark:remark,tokname:$('#tokname').val(),tid:<?=$_GET['id']?>},  
				cache:false,
				dataType:'JSON',
				success:function(data){
					mui.hideLoading();
					if(data.types == 1)setTimeout(function(){location.href="<?=base_url('index/bizhong_neiye?id=').$arr['id']?>"},1000);
					mui.toast(data.message);
					if(data.types == 0)return false;
				},
		        error:function(e){
		        	mui.hideLoading();
		        },
		        beforeSend:function(e){
		        	mui.showLoading("正在发送..","div");
		        }
			});

	        //alert(pwd);
	        //return false;
	    }
	});
});
$('#max').click(function(event) {
	var fe = <?=$arr['moneys']?>*fee*100/10000,
	mon = <?=$arr['moneys']?>-fe;
	$('#moneys').val(mon);
	$('#fees').show();
	$('#fe').html(fe+nickname);
});
</script>
</html>