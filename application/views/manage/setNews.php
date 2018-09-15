<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?=$codes['nickname']?></title>
	<meta name="renderer" content="webkit">	
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">	
	<meta name="apple-mobile-web-app-status-bar-style" content="black">	
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
	<meta name="apple-mobile-web-app-capable" content="yes">	
	<meta name="format-detection" content="telephone=no">	
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/manage/')?>common/layui2.4/css/layui.css" media="all">
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/manage/')?>common/bootstrap/css/bootstrap.css" media="all">
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/manage/')?>common/global.css" media="all">
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/manage/')?>css/personal.css" media="all">
</head>
<body>
<section class="layui-larry-box">
	<div class="larry-personal">
	    <div class="layui-tab">
	    	<div class="layui-form-item">
				<label class="layui-form-label">缩略图</label>
				<div class="layui-upload">
					<button type="button" class="layui-btn" id="test1">更换</button>
				  	<div class="layui-upload-list"><label class="layui-form-label"></label>
				    	<img class="layui-upload-img" id="demo1" style="width: 300px;display: <?=$codes['images']?"block":"none"?>" src='<?=base_url($codes['images'])?>'>
				    	<p id="demoText"></p>
				  	</div>
				</div>
			</div>
            <form class="layui-form" action="">
		         <!-- 操作日志 -->
                	
				<div class="layui-form-item">
				    <label class="layui-form-label">文章标题</label>
				    <div class="layui-input-block">
				      	<input type="text" name="title" required  lay-verify="required" value="<?=$codes['title']?>" autocomplete="off" class="layui-input">
				    </div>
				</div>
				<div class="layui-form-item">
				    <label class="layui-form-label">文章作者</label>
				    <div class="layui-input-block">
				      	<input type="text" name="author" required  lay-verify="required" value="<?=$codes['author']?>" autocomplete="off" class="layui-input">
				    </div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">内容摘要</label>
					<div class="layui-input-block">
						<textarea placeholder="请输入内容摘要" lay-verify="required" name="abstract" class="layui-textarea"><?=$codes['abstract']?></textarea>
					</div>
				</div>
				<div class="layui-form-item">
				    <label class="layui-form-label">文章内容</label>
				    <div class="layui-input-block">
				      	<textarea class="layui-textarea" id="LAY_demo1" lay-verify="LAY_demo1" style="display: none">  
						  	<?=$codes['content']?>
						</textarea>
				    </div>
				    <div class="layui-form-mid layui-word-aux"></div>
				</div>
				  <div class="layui-form-item">
				    <label class="layui-form-label">冻结</label>
				    <div class="layui-input-block">
				      <input type="checkbox" lay-skin="switch" <?=!$codes['type']?"checked":""?>>
				    </div>
				  </div>
				  <div class="layui-form-item">
				    <div class="layui-input-block">
				    	<input type="hidden" name="content" value="" id = "contentss">
				    	<input type="hidden" name="id" value="<?=$codes['id']?>" id = "memberid">
				      	<button class="layui-btn site-demo-layedit" lay-submit lay-filter="formDemo" id="newsSet" data-type="content">立即提交</button>
				      	<button type="button" class="layui-btn layui-btn-primary" onclick="window.location.href='<?=base_url('news/newList')?>'">返回</button>
				    </div>
				  </div>
 			</form>

			     <!-- 完 -->
			   
		    </div>
		</div>
	
</section>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="<?=base_url('public/manage/')?>common/layui2.4/layui.js"></script>
<script src="<?=base_url()?>public/js/jquery.base64.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
layui.use('layedit', function(){
	var layedit = layui.layedit
	//构建一个默认的编辑器
	layedit.set({
        uploadImage: {
            url: layditImgUrl, //接口url
        	type: 'post' //默认post
		}
	});
	var index = layedit.build('LAY_demo1');
	//编辑器外部操作
	var active = {
	   	content: function(){
	      	$('#contentss').val(layedit.getContent(index)); //获取编辑器内容
	    }
	    ,text: function(){
	      	alert(layedit.getText(index)); //获取编辑器纯文本内容
	    }
	    ,selection: function(){
	      	alert(layedit.getSelection(index));
	    }
	};
	$('.site-demo-layedit').on('click', function(){
	    var type = $(this).data('type');
	    active[type] ? active[type].call(this) : '';
	});
});
</script>
<script type="text/javascript">
	var uploadsurl ="<?=base_url('news/newUploads?id=').$codes['id']?>",
		setnewsurl = "<?=base_url('news/upNews')?>",
		layditImgUrl = '<?=base_url('news/layditImg')?>',
        checkedurls = '<?=base_url('news/newsCheck')?>',
		url = '<?=base_url()?>';
		if('<?=$_GET["msg"]?>'=='aaa'){
			alert("修改完成");
		}

	layui.config({
		base : "/public/manage/js/"
	}).use(['form','layer','jquery','laypage','upload'],function(){
		var form = layui.form,
			layer = parent.layer === undefined ? layui.layer : parent.layer,
			laypage = layui.laypage,
			upload = layui.upload,
			$ = layui.jquery;
		//加载页面数据
		var newsData = '';

		$('.layui-form-switch').on('click', function(event) {
			var id = $('#memberid').val(),dtype="";
			if(!$(this).hasClass('layui-form-onswitch')){
				dtype = 1;
			}else{
				dtype = 0;
			}
			var index = layer.msg('请稍候',{icon: 16,time:false,shade:0.8});
			$.ajax({
				type:'get',
				url: checkedurls,
				data:{id:id,type:dtype},
				cache:false,
				dataType:'JSON',
				success:function(data){
					var a = !dtype?"冻结":"开启";
					data.codes?layer.msg('新闻'+a+'成功'):layer.msg('新闻'+a+'失败');
					layer.close(index);
				},
			    error:function(e){
			    	layer.close(index);
			    },
			    beforeSend:function(e){
			    	layer.close(index);
			    }
			});

		})
		form.on('submit(formDemo)', function(data) {
			var codes = JSON.stringify(data.field);
			var index = layer.msg('请稍候',{icon: 16,time:false,shade:0.8});
			$.ajax({
				type:'post',
				url: setnewsurl,
				data:data.field,
				cache:false,
				dataType:'JSON',
				success:function(data){
					layer.msg(data.message);
					if(data.dtype){
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
		});
		var uploadInst = upload.render({
		    elem: '#test1'
		    ,url: uploadsurl
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
	})
</script>
</body>
</html>