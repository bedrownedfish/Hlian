<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>添加信息</title>
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
<body class="childrenBody">

	<form class="layui-form">
		<div class="layui-form-item">
			<label class="layui-form-label">名称(关于我们)</label>
			<div class="layui-input-block">
				<input class="layui-input newsName" lay-verify="required" name="sysemname" value="<?=$codes['sysemname']?>" placeholder="请输入文章标题" type="text">
			</div>
		</div>
		<input type="hidden" value="<?=$codes['sysico']?>" name="sysico" id="images">
		<div class="layui-form-item">
			<label class="layui-form-label">logo1</label>
			<div class="layui-upload">
				<button type="button" class="layui-btn" id="test1">更换</button>
			  	<div class="layui-upload-list"><label class="layui-form-label"></label>
			    	<img class="layui-upload-img" id="demo1" style="width: 300px;display: <?=$codes['sysico']?"block":"none"?>" src='<?=base_url($codes['sysico'])?>'>
			    	<p id="demoText"></p>
			  	</div>
			</div>
		</div>
		<div class="layui-form-item">
			<div class="layui-inline">		
				<label class="layui-form-label">矿工费率(手续费)</label>
				<div class="layui-input-inline">
					<input class="layui-input newsAuthor" lay-verify="required" value="<?=(float)$codes['fee']?>" name="fee" placeholder="请输入汇率" type="number">
				</div><span style="margin-top: 10px;float: left;">%</span>
			</div>
		</div>
		<div class="layui-form-item">
			<div class="layui-inline">
				<label class="layui-form-label">区块链交易</label>
				<div class="layui-input-inline">
					<select name="block" class="newsLook" lay-filter="browseLook">
				        <option value="1" <?=$codes['block']?"selected":""?>>开启</option>
				        <option value="0" <?=!$codes['block']?"selected":""?>>关闭</option>
				    </select>
				</div>
			</div>
		</div>
		<div class="layui-form-item">
			<div class="layui-inline">
		      	<label class="layui-form-label">修改时间</label>
		      	<div class="layui-input-inline">
		        	<input type="text" class="layui-input" value="<?=date('Y-m-d H:i:s')?>" name="addtime" id="date1" placeholder="选择修改时间">
		    	</div>
		    </div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">用户默认昵称</label>
			<div class="layui-input-block">
				<input class="layui-input newsName" lay-verify="required" name="defaultnick" value="<?=$codes['defaultnick']?>" placeholder="请输入默认昵称" type="text">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">系统中心账号</label>
			<div class="layui-input-block">
				<input class="layui-input newsName" lay-verify="required" name="host" value="<?=$codes['host']?>" placeholder="中心账号" type="text">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">版本号</label>
			<div class="layui-input-block">
				<input class="layui-input"  name="edition" value="<?=$codes['edition']?>" placeholder="版本号" type="text">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">汇率简介</label>
			<div class="layui-input-block">
				<textarea placeholder="请输入内容摘要" lay-verify="required" name="rate" class="layui-textarea"><?=$codes['rate']?></textarea>
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">关于我们</label>
			<div class="layui-input-block">
				<textarea class="layui-textarea layui-hide" lay-verify="required" name="asrega" lay-verify="content" id="news_content"><?=$codes['asrega']?></textarea><div class="layui-layedit"><div class="layui-unselect layui-layedit-tool"><i class="layui-icon layedit-tool-b" title="加粗" lay-command="Bold" layedit-event="b" "=""></i><i class="layui-icon layedit-tool-i" title="斜体" lay-command="italic" layedit-event="i" "=""></i><i class="layui-icon layedit-tool-u" title="下划线" lay-command="underline" layedit-event="u" "=""></i><i class="layui-icon layedit-tool-d" title="删除线" lay-command="strikeThrough" layedit-event="d" "=""></i><span class="layedit-tool-mid"></span><i class="layui-icon layedit-tool-left" title="左对齐" lay-command="justifyLeft" layedit-event="left" "=""></i><i class="layui-icon layedit-tool-center" title="居中对齐" lay-command="justifyCenter" layedit-event="center" "=""></i><i class="layui-icon layedit-tool-right" title="右对齐" lay-command="justifyRight" layedit-event="right" "=""></i><span class="layedit-tool-mid"></span><i class="layui-icon layedit-tool-link" title="插入链接" layedit-event="link" "=""></i><i class="layui-icon layedit-tool-unlink layui-disabled" title="清除链接" lay-command="unlink" layedit-event="unlink" "=""></i><i class="layui-icon layedit-tool-face" title="表情" layedit-event="face" "=""></i><i class="layui-icon layedit-tool-image" title="图片" layedit-event="image"><input name="file" type="file"></i></div><div class="layui-layedit-iframe"><iframe id="LAY_layedit_1" name="LAY_layedit_1" textarea="news_content" style="height: 280px;" frameborder="0"></iframe></div></div>
			</div>
		</div>
		<div class="layui-form-item">
			<div class="layui-input-block">
				<button class="layui-btn" lay-submit="" lay-filter="addNews">立即提交</button>
				<button type="reset" class="layui-btn layui-btn-primary">返回</button>
		    </div>
		</div>
	</form>
	<script type="text/javascript" src="<?=base_url('public/manage/')?>common/layui2.4/layui.js"></script>
	<script type="text/javascript">
		var newsImagInset = '<?=base_url('news/newsImagInset')?>',
			layditImgUrl = '<?=base_url('news/layditImg')?>',
			url = "<?=base_url()?>",
			setConfig = "<?=base_url('manage/setConfig')?>";
		layui.config({
			base : "js/"
		}).use(['form','layer','jquery','layedit','laydate','upload'],function(){
			var form = layui.form,
				layer = parent.layer === undefined ? layui.layer : parent.layer,
				laypage = layui.laypage,
				layedit = layui.layedit,
				upload = layui.upload,
				laydate = layui.laydate,
				$ = layui.jquery;
			var uploadInst = upload.render({
			    elem: '#test1'
			    ,url: newsImagInset
			    ,before: function(obj){
			      //预读本地文件示例，不支持ie8
			      obj.preview(function(index, file, result){
			        //$('#demo1').attr('src', result); //图片链接（base64）
			      });
			    }
			    ,done: function(res){
			    	//上传成功
			    	$('#demoText').html("");
			      	if(res.type ==1 ){
			      		$('#demo1').attr('src',url+res.code).show();
			      		$('#images').val(res.code);
			      	}
			      	layer.msg(res.message);
			      	
			    }
			    ,error: function(){
				    //演示失败状态，并实现重传
				    var demoText = $('#demoText');
				    demoText.html('<label class="layui-form-label"></label> <span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>');
				    demoText.find('.demo-reload').on('click', function(){
				      	uploadInst.upload();
				    });
			    }
			});
			//创建一个编辑器
			laydate.render({
			    elem: '#date1'
			    ,type: 'datetime'
			});
			layedit.set({
		        uploadImage: {
		            url: layditImgUrl, //接口url
		        	type: 'post' //默认post
				}
			});
		 	var editIndex = layedit.build('news_content');
		 	var addNewsArray = [],addNews;
		 	form.on("submit(addNews)",function(data){
		 		var index = top.layer.msg('数据提交中，请稍候',{icon: 16,time:false,shade:0.8});
 				codes = data.field;
 				codes.asrega = layedit.getContent(editIndex);
 				$.ajax({
					type:'post',
					url: setConfig,
					data:codes,
					cache:false,
					dataType:'JSON',
					success:function(data){
						layer.msg(data.message);
					},
				    error:function(e){
				    	layer.close(index);
				    },
				    beforeSend:function(e){
				    	layer.close(index);
				    }
				});
		        return false;
		 	})
			
		})
	</script>
</body>
</html>