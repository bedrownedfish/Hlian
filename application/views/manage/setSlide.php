<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?=$codes['nickname']?></title>
	<meta name="renderer" content="webkit">	
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">	
	<meta name="apple-mobile-web-app-status-bar-style" content="black">	
	<meta name="apple-mobile-web-app-capable" content="yes">	
	<meta name="format-detection" content="telephone=no">	
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/manage/')?>common/layui/css/layui.css" media="all">
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/manage/')?>common/bootstrap/css/bootstrap.css" media="all">
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/manage/')?>common/global.css" media="all">
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/manage/')?>css/personal.css" media="all">
</head>
<body>
<section class="layui-larry-box">
	<div class="larry-personal">
	    <div class="layui-tab">
				  <div class="layui-form-item">
				    <label class="layui-form-label">ID</label>
				    <div class="layui-input-block">
				      <input type="text" required  lay-verify="required" value="<?=$codes['id']?>" disabled="disabled"  autocomplete="off" class="layui-input">
				    </div>
				  </div>
				<div class="layui-form-item">
					<label class="layui-form-label">头像</label>
					<div class="layui-upload">
						<button type="button" class="layui-btn" id="test1">更换图片</button>
					  	<div class="layui-upload-list"><label class="layui-form-label"></label>
					    	<img class="layui-upload-img" id="demo1" style="width: 900px" src='<?=base_url($codes['imgs'])?>'>
					    	<p id="demoText"></p>
					  	</div>
					</div>
				</div> 
			   
		    </div>
		</div>
	
</section>
<script type="text/javascript" src="<?=base_url('public/manage/')?>common/layui/layui.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="<?=base_url()?>public/js/jquery.base64.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="<?=base_url('public/manage/')?>js/slideuploads.js"></script>
<script type="text/javascript">
	var uploadsurl ="<?=base_url('news/slideUpload?id=').$codes['id']?>",
		url = '<?=base_url()?>';
</script>
</body>
</html>