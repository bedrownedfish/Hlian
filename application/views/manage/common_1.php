<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>个人信息</title>
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
		<header class="larry-personal-tit">
			<span>个人信息</span>
		</header><!-- /header -->
		<div class="larry-personal-body clearfix">
			<form class="layui-form col-lg-5" action="" method="post">
				
				<div class="layui-form-item">
					<label class="layui-form-label">标题</label>
					<div class="layui-input-block">
						<input type="text" name="title"  autocomplete="off" class="layui-input" value="<?=$codes['title']?>" >
					</div>
				</div>
				<div class="layui-form-item layui-form-text">
					<label class="layui-form-label">内容</label>
					<div class="layui-input-block">
						<textarea value="" name="content" class="layui-textarea"><?=$codes['content']?></textarea>
					</div>
				</div>
				<div class="layui-form-item">
					<div class="layui-inline">
				      	<label class="layui-form-label">发布时间</label>
				      	<div class="layui-input-inline">
				        	<input type="text"  lay-verify="required" class="layui-input" value="<?=date('Y-m-d H:i:s',$codes['addtime']?$codes['addtime']:time())?>" name="addtime" id="date1" placeholder="选择发布时间">
				    	</div>
				    </div>
				</div>
				<div class="layui-form-item">
					<div class="layui-inline">
						<label class="layui-form-label">是否开放</label>
						<div class="layui-input-inline">
							<select name="type" class="newsLook" lay-filter="browseLook">
						        <option <?=$codes['type']&&$codes['id']?"selected":""?> value="1">是</option>
						        <option <?=!$codes['type']&&$codes['id']?"selected":""?> value="0">否</option>
						    </select>
						</div>
					</div>
				</div>
				<input type="hidden" name="id" value="<?=$codes['id']?>">
				<div class="layui-form-item">
					<div class="layui-input-block">
						<button class="layui-btn" lay-submit="" lay-filter="formDemo" lay-filter="demo1">立即提交</button>
						<a type="reset" href="<?=base_url('Kinds/common')?>" class="layui-btn layui-btn-primary">返回</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
<script type="text/javascript" src="<?=base_url('public/manage/')?>common/layui2.4/layui.js"></script>
<script type="text/javascript">
	var opinionurl = "<?=base_url('Kinds/common_1')?>";
	layui.config({
		base : "/public/manage/js/"
	}).use(['form','layer','jquery','laydate'],function(){
		var form = layui.form,
			layer = parent.layer === undefined ? layui.layer : parent.layer,
			laypage = layui.laypage,
			laydate = layui.laydate,
			layedit = layui.layedit,
			$ = layui.jquery;
		laydate.render({
		    elem: '#date1'
		    ,type: 'datetime'
		});
		form.on('submit(formDemo)', function(data) {
			var codes = data.field,
				index = layer.msg('数据提交中，请稍候',{icon: 16,time:false,shade:0.8});;
			$.ajax({
				type:'post',
				url: opinionurl,
				data:codes,
				cache:false,
				dataType:'JSON',
				success:function(data){
					layer.msg(data.message);
					if(data.types){
						window.location.href='<?=base_url("Kinds/common")?>';
					}
					layer.close(index);
					console.log(data)
				},
			    error:function(e){
			    	layer.close(index);
			    },
			    beforeSend:function(e){
			    	
			    }
			});
			return false;
			
		});
	})
</script>
</body>
</html>