	<script type="text/javascript" >
		var i ;
		function ityzl_SHOW_LOAD_LAYER(){
	   		return layer.msg('努力中...', {icon: 16,shade: [0.5, '#f5f5f5'],scrollbar: false,offset: '0px', time:100000}) ;
	   	}
	   	function ityzl_CLOSE_LOAD_LAYER(index){
	   		layer.close(index);
	   	}
	   	function ityzl_SHOW_TIP_LAYER(){
	   		layer.msg('恭喜您，加载完成！',{time: 1000,offset: '10px'});
	   	}
	   	/*
			beforeSend: function () {
	        	i = ityzl_SHOW_LOAD_LAYER();
	        },
	        success: function (msg) {
	        	ityzl_CLOSE_LOAD_LAYER(i);
	        	ityzl_SHOW_TIP_LAYER();
	        },
	        error: function (e, jqxhr, settings, exception) {
	        	ityzl_CLOSE_LOAD_LAYER(i);
	        }
	
	   	*/
	</script>