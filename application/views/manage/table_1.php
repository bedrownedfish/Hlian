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
            
		         <!-- 操作日志 -->

                <form class="layui-form" action="">
                	<div class="layui-form-item">
					    <label class="layui-form-label">注册时间</label>
					    <div class="layui-input-block">
					      	<p style="line-height: 40px"><?=date('Y-m-d H:i:s',$codes['addtime'])?></p>
					    </div>
					 </div>
				  <div class="layui-form-item">
				    <label class="layui-form-label">以太坊账号</label>
				    <div class="layui-input-block">
				      <input type="text" required value="<?=$codes['eth_accounts']?>" disabled="disabled"  autocomplete="off" class="layui-input">
				    </div>
				  </div>
				  <div class="layui-form-item">
				    <label class="layui-form-label">以太坊密码</label>
				    <div class="layui-input-block">
				      <input type="text" required value="<?=$codes['eth_password']?>" disabled="disabled"  autocomplete="off" class="layui-input">
				    </div>
				  </div>
				  <div class="layui-form-item">
				    <label class="layui-form-label">昵称</label>
				    <div class="layui-input-block">
				      <input type="text" name="nickname" required  lay-verify="required" value="<?=$codes['nickname']?>" autocomplete="off" class="layui-input">
				    </div>
				  </div>
				  <div class="layui-form-item">
				    <label class="layui-form-label">账户密码</label>
				    <div class="layui-input-inline">
				      <input type="password" id="maks" name="mak"  placeholder="请输入密码,不修改可以不填" autocomplete="off" class="layui-input">
				    </div>
				    <div class="layui-form-mid layui-word-aux"></div>
				  </div>
				  <!-- <div class="layui-form-item">
				    <label class="layui-form-label">选择框</label>
				    <div class="layui-input-block">
				      <select name="city" lay-verify="required">
				        <option value=""></option>
				        <option value="0">北京</option>
				        <option value="1">上海</option>
				        <option value="2">广州</option>
				        <option value="3">深圳</option>
				        <option value="4">杭州</option>
				      </select>
				    </div>
				  </div> -->
				  	<?php foreach($kinds as $key=>$value):?>
						<div class="layui-form-item">
					    	<label class="layui-form-label"><?=$value['tokname']?></label>
					    	<div class="layui-input-block">
					      	<input type="text" name="<?=$value['tokname']?>" required  lay-verify="required" value="<?=round($codes[$value['tokname']],4)?>" autocomplete="off" class="layui-input">
					    	</div>
						</div>
					<?php endforeach?>
				  <div class="layui-form-item">
				    <label class="layui-form-label">币种</label>
				    <div class="layui-input-block">
				    	<?php foreach($kinds as $k=>$v):if($v['id']!=1):?>
				      		<input type="checkbox" id="kinds" data-id = "<?=$v['id']?>" title="<?=$v['tokname']?>" <?=in_array($v['id'],explode(',',$codes['currency']))?'checked':""?>>
				  		<?php endif;endforeach?>
				    </div>
				  </div>
				<div class="layui-form-item">
					<label class="layui-form-label">冻结</label>
					<div class="layui-input-block">
						<input type="checkbox" lay-skin="switch" <?=!$codes['type']?"checked":""?>>
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">头像</label>
					<div class="layui-upload">
						<button type="button" class="layui-btn" id="test1">更换头像</button>
					  	<div class="layui-upload-list"><label class="layui-form-label"></label>
					    	<img class="layui-upload-img" id="demo1" style="width: 300px" src='<?=base_url($codes['portrait'])?>'>
					    	<p id="demoText"></p>
					  	</div>
					</div>
				</div> 
				  <!-- <div class="layui-form-item">
				    <label class="layui-form-label">单选框</label>
				    <div class="layui-input-block">
				      <input type="radio" name="sex" value="男" title="男">
				      <input type="radio" name="sex" value="女" title="女" checked>
				    </div>
				  </div> -->
				  <!-- <div class="layui-form-item layui-form-text">
				    <label class="layui-form-label">文本域</label>
				    <div class="layui-input-block">
				      <textarea name="desc" placeholder="请输入内容" class="layui-textarea"></textarea>
				    </div>
				  </div> -->
				  <div class="layui-form-item">
				    <div class="layui-input-block">
				    	<input type="hidden" name="id" value="<?=$codes['id']?>" id = "memberid">
				      	<button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
				      	<button type="button" class="layui-btn layui-btn-primary" onclick="window.location.href='<?=base_url('manage/table')?>'">返回</button>
				    </div>
				  </div>
				</form>
 

			     <!-- 完 -->
			   
		    </div>
		</div>
	
</section>
<script type="text/javascript" src="<?=base_url('public/manage/')?>common/layui/layui.js"></script>
<script type="text/javascript" src="<?=base_url('public/manage/')?>js/newslist.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="<?=base_url()?>public/js/jquery.base64.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="<?=base_url('public/manage/')?>js/uploads.js"></script>
<script type="text/javascript">
	var checkedurl = "<?=base_url('manage/kindsK')?>",
		checkedurls = "<?=base_url('manage/memberType')?>",
		checkedfrom = "<?=base_url('manage/table_1')?>",
		uploadsurl ="<?=base_url('manage/uploads?id=').$codes['id']?>",
		url = '<?=base_url()?>';
		if('<?=$_GET["msg"]?>'=='aaa'){

			alert("修改完成");

		}
</script>
</body>
</html>