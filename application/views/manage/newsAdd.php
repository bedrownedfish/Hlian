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
			<label class="layui-form-label">缩略图</label>
			<div class="layui-upload">
				<button type="button" class="layui-btn" id="test1">更换</button>
			  	<div class="layui-upload-list"><label class="layui-form-label"></label>
			    	<img class="layui-upload-img" id="demo1" style="width: 300px;display: none" src=''>
			    	<p id="demoText"></p>
			  	</div>
			</div>
		</div>
		<input type="hidden" name="images" id="images">
		<div class="layui-form-item">
			<label class="layui-form-label">文章标题</label>
			<div class="layui-input-block">
				<input class="layui-input newsName" name="title" lay-verify="required" placeholder="请输入文章标题" type="text">
			</div>
		</div>
		<div class="layui-form-item">
			<div class="layui-inline">		
				<label class="layui-form-label">文章作者</label>
				<div class="layui-input-inline">
					<input class="layui-input newsAuthor" lay-verify="required" name="author" placeholder="请输入文章作者" type="text">
				</div>
			</div>
			<div class="layui-inline">
		      	<label class="layui-form-label">发布时间</label>
		      	<div class="layui-input-inline">
		        	<input type="text" class="layui-input" name="addtime" id="date1" placeholder="选择发布时间">
		    	</div>
		    </div>
			<div class="layui-inline">
				<label class="layui-form-label">是否开放</label>
				<div class="layui-input-inline">
					<select name="type" class="newsLook" lay-filter="browseLook">
				        <option value="1">是</option>
				        <option value="0">否</option>
				    </select><div class="layui-unselect layui-form-select"><div class="layui-select-title"><input placeholder="是否开放" value="是否开放" readonly="" class="layui-input layui-unselect" type="text"><i class="layui-edge"></i></div><dl class="layui-anim layui-anim-upbit"><dd lay-value="1" class="layui-this">是</dd><dd lay-value="0" class="">否</dd></dl></div>
				</div>
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">内容摘要</label>
			<div class="layui-input-block">
				<textarea placeholder="请输入内容摘要" lay-verify="required" name="abstract" class="layui-textarea"></textarea>
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">文章内容</label>
			<div class="layui-input-block">
				<textarea class="layui-textarea layui-hide" name="content" lay-verify="content" id="news_content"></textarea><div class="layui-layedit"><div class="layui-unselect layui-layedit-tool"><i class="layui-icon layedit-tool-b" title="加粗" lay-command="Bold" layedit-event="b" "=""></i><i class="layui-icon layedit-tool-i" title="斜体" lay-command="italic" layedit-event="i" "=""></i><i class="layui-icon layedit-tool-u" title="下划线" lay-command="underline" layedit-event="u" "=""></i><i class="layui-icon layedit-tool-d" title="删除线" lay-command="strikeThrough" layedit-event="d" "=""></i><span class="layedit-tool-mid"></span><i class="layui-icon layedit-tool-left" title="左对齐" lay-command="justifyLeft" layedit-event="left" "=""></i><i class="layui-icon layedit-tool-center" title="居中对齐" lay-command="justifyCenter" layedit-event="center" "=""></i><i class="layui-icon layedit-tool-right" title="右对齐" lay-command="justifyRight" layedit-event="right" "=""></i><span class="layedit-tool-mid"></span><i class="layui-icon layedit-tool-link" title="插入链接" layedit-event="link" "=""></i><i class="layui-icon layedit-tool-unlink layui-disabled" title="清除链接" lay-command="unlink" layedit-event="unlink" "=""></i><i class="layui-icon layedit-tool-face" title="表情" layedit-event="face" "=""></i><i class="layui-icon layedit-tool-image" title="图片" layedit-event="image"><input name="file" type="file"></i></div><div class="layui-layedit-iframe"><iframe id="LAY_layedit_1" name="LAY_layedit_1" textarea="news_content" style="height: 280px;" frameborder="0"></iframe></div></div>
			</div>
		</div>
		<div class="layui-form-item">
			<div class="layui-input-block">
				<button class="layui-btn" lay-submit="" lay-filter="addNews">立即提交</button>
		    </div>
		</div>
	</form>
	<script type="text/javascript" src="<?=base_url('public/manage/')?>common/layui2.4/layui.js"></script>
<script type="text/javascript">
		var newsImagInset = '<?=base_url('news/newsImagInset')?>',
			layditImgUrl = '<?=base_url('news/layditImg')?>',
			url = "<?=base_url()?>"
			newsInset = '<?=base_url("news/newsInset")?>';
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
	layedit.set({
        uploadImage: {
            url: layditImgUrl, //接口url
        	type: 'post' //默认post
		}
	});
	//创建一个编辑器
 	var editIndex = layedit.build('news_content');
 	var addNewsArray = [],addNews;
 	laydate.render({
	    elem: '#date1'
	    ,type: 'datetime'
	});
 	form.on("submit(addNews)",function(data){
 		
 		//弹出loading
 		var index = top.layer.msg('数据提交中，请稍候',{icon: 16,time:false,shade:0.8}),
 		codes = data.field;
 		codes.content = layedit.getContent(editIndex);
 		if(codes.images==""){
 			layer.msg('请上传缩略图！');
 			return false;
 		}
 		if(codes.content==""){
 			layer.msg('请编辑文章内容！');
 			return false;
 		}
			$.ajax({
				type:'post',
				url: newsInset,
				data:codes,
				cache:false,
				dataType:'JSON',
				success:function(data){
					layer.msg(data.message);
					if(data.types){
						window.location.href='<?=base_url('news/newList')?>';
					}

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