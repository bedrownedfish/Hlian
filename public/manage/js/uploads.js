layui.config({
	base : "/public/manage/js/"
}).use(['upload'],function(){
	var upload = layui.upload,
		$ = layui.jquery;
	
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
	      		$('#demo1').attr('src',url+res.code);
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
