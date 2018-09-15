<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>login-3</title>
    <link href="<?=base_url()?>public/css/mui.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="<?=base_url()?>public/css/basic.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/login-3.css"/>
    <script src="<?=base_url()?>public/js/mui.min.js"></script>
	<script src="<?=base_url()?>public/js/jquery.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?=base_url()?>public/js/jquery.base64.js" type="text/javascript" charset="utf-8"></script>
	
    
</head>
<body>
	<div class="section1 mui-clearfix">
		<header class="mui-bar mui-bar-nav" style="">
			<a class="mui-icon mui-icon-left-nav mui-pull-left" href="javascript:history.back(-1)" style="color: #666;"></a>
			<h1 class="mui-title" style="font-weight: bold;">设置密码</h1>
			<!--<a class="mui-icon mui-pull-right right1" href="javascript:;" >恢复账号</a>-->
		</header>
	</div>
	<div class="section2 bbnn">
		<div class="container">
			<form action="" method="post">
				<div class="section2-2">
					<p>设置您的密码(不建议为纯数字，且不要包含空格)</p>
				</div>
				<div class="section2-1 mui-clearfix one">
					<input type="password" name="" id="" value="" maxlength="1" class="yytr" readonly=""/>
					<input type="password" name="" id="" value="" maxlength="1" class="yytr" readonly="readonly"/>
					<input type="password" name="" id="" value="" maxlength="1" class="yytr" readonly="readonly"/>
					<input type="password" name="" id="" value="" maxlength="1" class="yytr" readonly="readonly"/>
					<input type="password" name="" id="" value="" maxlength="1" class="yytr" readonly="readonly"/>
					<input type="password" name="" id="" value="" maxlength="1" class="yytr" readonly="readonly"/>
					<input type="password" name="" id="" value="" maxlength="1" class="yytr" readonly="readonly"/>
					<input type="password" name="" id="" value="" maxlength="1" class="yytr" readonly="readonly"/>
				</div>

			</form>
			
		</div>
	</div>
	<div class="section2 uuyy" style="display: none;">
		<div class="container">
			<form action="" method="post">
				<div class="section2-2">
					<p>确认您的密码</p>
				</div>
				<div class="section2-1 mui-clearfix two">
					<input type="password" name="" id="" value="" maxlength="1" class="yytr" readonly=""/>
					<input type="password" name="" id="" value="" maxlength="1" class="yytr" readonly="readonly"/>
					<input type="password" name="" id="" value="" maxlength="1" class="yytr" readonly="readonly"/>
					<input type="password" name="" id="" value="" maxlength="1" class="yytr" readonly="readonly"/>
					<input type="password" name="" id="" value="" maxlength="1" class="yytr" readonly="readonly"/>
					<input type="password" name="" id="" value="" maxlength="1" class="yytr" readonly="readonly"/>
					<input type="password" name="" id="" value="" maxlength="1" class="yytr" readonly="readonly"/>
					<input type="password" name="" id="" value="" maxlength="1" class="yytr" readonly="readonly"/>
				</div>

			</form>
			
		</div>
	</div>
</body>

<script type="text/javascript" charset="utf-8">
  	mui.init();
</script>
<script>
	$(function(){
		inputcode('.one');
		//alert(password);
	})
	function inputcode(calss,code = ""){
        var txts = $(calss+' input'),one = "";
        for(var i = 0; i<txts.length;i++){
            var t = txts[i];
            t.index = i;
            t.setAttribute("readonly", true);
            t.onkeyup=function(event){
                if(event.keyCode!=8){
                	this.value=this.value.replace(/^(.).*$/,'$1');
                	one+=this.value
	                var next = this.index + 1;
	                if(next > txts.length - 1) {
	                	$(".bbnn").hide();
	                	$(".uuyy").show();
	                	if(code == one){
	                		code = $.base64.encode($.base64.encode(one));
	                		location.href = "<?=base_url()?>home/mnemonicword?code="+code;
	                	}else if(code != one && code != ""){
	                		mui.toast('密码不一致，请重新输入！');
	                		setTimeout(function(){
	                			location.reload();
	                		},1500);
	                	}
	                	inputcode('.two',one)
	                }else{
	                	txts[next].removeAttribute("readonly");
	                	txts[next].focus();
	                };
                }else{
                	if(this.index == 0) return;
                	this.value=this.value.replace(/^(.).*$/,'$1');
	                var next = this.index - 1;
	                if(next > txts.length - 1) return;
	                txts[next].removeAttribute("readonly");
	                txts[next].focus();
                }
            };
        }
        txts[0].removeAttribute("readonly");
    }
    
</script>
</html>