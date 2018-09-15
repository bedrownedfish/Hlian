<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>logo</title>
    <link href="<?=base_url('public/')?>css/mui.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="<?=base_url('public/')?>css/basic.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url('public/')?>css/ment_go.css"/>
    <script src="<?=base_url('public/')?>js/mui.min.js"></script>
	<script src="<?=base_url('public/')?>js/jquery.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?=base_url()?>public/js/qrcode.min.js"></script>
	<script src="<?=base_url()?>public/js/clipboard.js"></script>
</head>
<body>
	<div class="section1 mui-clearfix">
		<header class="mui-bar mui-bar-nav" >
			<a class="mui-icon mui-icon-left-nav mui-pull-left" href="javascript:history.back(-1)" style="color: #3474FA;"></a>
			<!--<h1 class="mui-title">login</h1>-->
			<a class="mui-icon mui-pull-right right1" href="javascript:;"><img src="<?=base_url('public/')?>images/nav_icon_management.png"/></a>
		</header>
	</div>
	<div class="section2">
		<div class="container">
			<p>钱包管理</p>
		</div>
	</div>
	<div class="section3 zbn">
		<div class="container">
			<div class="section3-1 mui-clearfix">
				<div class="section3-1-1">
					<img src="<?=base_url('public/')?>images/icon_hc_03.png"/>
				</div>
				<div class="section3-1-2">
					<p class="p1 nickname" style="overflow: hidden;"><?=$users['nickname']?></p>
					<p class="p2"><?=substr_replace($users['eth_accounts'], "***",5,25)?></p>
				</div>
				<div class="section3-1-3">
					<img src="<?=base_url('public/')?>images/send_icon_qr_code.png" class="zbn"/>
				</div>
			</div>
		</div>
	</div>
	<div class="section2" style="margin-top: 15px;">
		<div class="container">
			<p>钱包姓名</p>
		</div>
	</div>
	<div class="section4">
		<div class="container">
			<div class="f1">
				<input type="text" name="" id="nickname" value="" placeholder="修改钱包名称"/>
			</div>
			<div class="sub">
				<input type="submit" id="sub" name="" value="确定" />
			</div>
		</div>
	</div>
	<div class="section5">
		<div class="section5-1">
			<ul>
				<li class="mui-clearfix li1">
					<div class="div1">
						<img src="<?=base_url('public/')?>images/icon_export_wallet.png"/>
					</div>
					<div class="div2">
						分享钱包
					</div>
					<div class="div3">
						<img src="<?=base_url('public/')?>images/profile_icon_crow_right.png"/>
					</div>
				</li>
              	<li class="mui-clearfix">
					<a href="<?=base_url('Option/forget')?>">
						<div class="div1">
							<img src="<?=base_url('public/')?>images/icon_modify.png"/>
						</div>
						<div class="div2">
							手机号重置密码
						</div>
						<div class="div3">
							<img src="<?=base_url('public/')?>images/profile_icon_crow_right.png"/>
						</div>
					</a>
				</li>
				<li class="mui-clearfix">
					<a href="<?=base_url('index/findpass')?>">
						<div class="div1">
							<img src="<?=base_url('public/')?>images/icon_modify.png"/>
						</div>
						<div class="div2">
							密码重置
						</div>
						<div class="div3">
							<img src="<?=base_url('public/')?>images/profile_icon_crow_right.png"/>
						</div>
					</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="section6">
		<div class="container">
			<div class="section6-1">
				<div class="container">
					<div class="title">
						<p>分享钱包</p>
					</div>
					<div class="center1">
						<p>警告：钱包地址为以太坊官方地址，支持以太坊下所有币种的承载</p>
					</div>
					<div class="center2">
						<p><?=$users['eth_accounts']?></p>
					</div>
					<div class="center3">
						<button href="javascript:void(0);"  class="hbn copy_btn" data-clipboard-text="<?=$users['eth_accounts']?>">复制</button>
					</div>
				</div>
			</div>
			
		</div>
	</div>
	<div class="section9">
		<div class="container">
			<div class="section9-1">
				<p class="p3"><img style="width: 80px;height: 80px" src="<?=base_url($users['portrait'])?>"/></p>
				<p class="p1 olo nickname"><?=$users['nickname']?></p>
				<p class="p2"><?=$users['eth_accounts']?></p>
			</div>
			<div class="section9-2" id='qrcode'>

			</div>
			<div class="section9-3">
				<button href="javascript:;" class="hnb copy_btn" data-clipboard-text="<?=$users['eth_accounts']?>">复制</button>
			</div>
			
		</div>
		<div class="section9-4">
			<img src="<?=base_url()?>public/images/upup.png" class="totle"/>
		</div>
	</div>
	<div class="section10">
		
	</div>
</body>

<script type="text/javascript" charset="utf-8">
  	mui.init();
</script>
<?php $this->load->view('module/loading')?>
<script type="text/javascript">

	$(document).ready(function(){
        var clipboard = new Clipboard('.copy_btn');
        clipboard.on('success', function(e) {
            mui.toast('复制成功！');
            e.clearSelection();
            //console.log(e.clearSelection);
        });
    });

	$('#qrcode').qrcode({
	    render: "canvas", //也可以替换为table
	    width: 220,
	    height: 220,
	    text: '<?=$users['eth_accounts']?>'
	});
	$('#sub').click(function(event) {
		var nickname = $('#nickname').val();
		if(nickname == ""){mui.toast('钱包名称不能为空');return false;}



		if(nickname.length >=8){mui.toast('钱包名称不能大于八位数258');return false;}
		$.ajax({
			type:'post',
			url:'<?=base_url('Operation/upPortrait')?>',
			data:{nickname:nickname},
			cache:false,
			dataType:'JSON',
			success:function(data){
				mui.hideLoading();
				console.log(data);
				data.types == 1 && $('.nickname').html(nickname) && $('#nickname').val("");
				mui.toast(data.message);				
			},
		    error:function(e){
		       	console.log(e);
		       	mui.hideLoading();
		    },
		    beforeSend:function(e){
		       	mui.showLoading("正在修改..","div");
		    }
		});
	});
	$(function(){
		$(".zbn").click(function(){
			$(".section9").slideDown();
			$(".section10").show();
		});
		$(".section10,.hnb").click(function(){
			$(".section9").slideUp();
			$(".section6").hide();
			$(".section10").hide();
		});
	});
	$(function(){
		$(".li1").click(function(){
			$(".section6").show();
			$(".section10").show();
		});
		$(".hbn").click(function(){
			$(".section6").hide();
			$(".section10").hide();
		});
	})
</script>