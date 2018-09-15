<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title></title>
    <script src="<?=base_url('public/')?>js/mui.min.js"></script>
    <link href="<?=base_url('public/')?>css/mui.min.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url('public/')?>css/common.css"/>
    <script src="<?=base_url('public/')?>js/jquery.js"></script>
    <?php $this->load->view('module/loading')?>
    <script type="text/javascript" charset="utf-8">
      	mui.init();
    </script>
</head>
<body>
	<div class="sectionH  sectionH2 mui-clearfix">
		<header class="mui-bar mui-bar-nav" style="">
			<a class="mui-icon mui-icon-left-nav  mui-pull-left" href="<?=base_url('Index/us')?>" style="color: #727272;"></a>
			<h1 class="mui-title">意见建议</h1>
			<!--<a class="mui-icon mui-pull-right right1" href="assets-1.html"><img src="images/icon_setting.png"/></a>-->
		</header>
	</div>
	<div class="kong1"></div>
	<div class="set_yijian_section1">
		<div class="container">
			<form action="" method="post" id="form">
				<div class="f2 mui-clearfix">
					<p class="p1">标题</p>
					<input type="text" name="title" placeholder="请输入标题">
				</div>
				<div class="f4 mui-clearfix">
					<p class="p1">意见建议</p>
					<textarea name="content" id="content" rows="8" cols="" placeholder="您有什么想说的？欢迎留言"></textarea>
				</div>
				<div class="f2 mui-clearfix">
					<p class="p1">联系方式</p>
					<input type="text" name="mobile" placeholder="请输入联系方式">
				</div>
				
				<div class="sub">
					<input type="submit" value="提交"/>
				</div>
			</form>
		</div>
		
	</div>
	
</body>
<script type="text/javascript">
	$(function(){
		$('#form').submit(function(event) {
			var content = $('#content').val();
			if(!content){mui.toast('内容不能为空！');return false;}
			var data = $("#form").serialize();
			$.ajax({
				type:'post',
				url:'<?=base_url('Operation/opinion')?>',
				data:data,
				cache:false,
				dataType:'JSON',
				success:function(data){
					mui.hideLoading();
					if(data.types == 1){setTimeout(function(){window.location.href="<?=base_url('Index/us')?>";},1000)};
					mui.toast(data.message);									
				},
			    error:function(e){
			       	mui.hideLoading();
			    },
			    beforeSend:function(e){
			       	mui.showLoading("正在发送..","div");
			    }
			});
			return false;
		});
	})
</script>
</html>