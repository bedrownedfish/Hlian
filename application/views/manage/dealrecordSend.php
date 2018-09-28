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
	    <div class="layui-tab">
           
            
		    <div class="layui-tab-content larry-personal-body clearfix mylog-info-box">
		         <!-- 操作日志 -->
                <div class="layui-tab-item layui-field-box layui-show">
                     <table class="layui-table table-hover" lay-even="" lay-skin="nob">
                          <thead>
                              <tr>
                                  <th>编号</th>
                                  <th>发送人帐号</th>
                                  <th>接受人账号</th>
                                  <th>交易时间</th>
                                  <th>币种名称</th>
                                  <th>备注信息</th>
                                  <th>金额</th>
                              </tr>
                          </thead>
                          <tbody id = 'codes'>
                            <?php foreach($codes as $k=>$v):?>
                              <tr>
                                <td><?=$v['id']?></td>
                                <td><?=$v['useraccounts']?></td>
                                <td><?=$v['accounts']?></td>
                                <td><?=date('Y-m-d H:i:s',$v['addtime'])?></td>
                                <td><?=$v['nickname']?></td>
                                <td><?=$v['remark']?></td>
                                <td><?=$v['moneys']?></td>
                              </tr>
                            <?php endforeach?>
                          </tbody>
                     </table>
                     <div class="larry-table-page clearfix">
				          <div id="page" class="page"></div>
			         </div>
			    </div>
		    </div>
		</div>
	</div>
</section>
<script type="text/javascript" src="<?=base_url('public/manage/')?>common/layui/layui.js"></script>
<script type="text/javascript">
  console.log(<?=json_encode($codes)?>);
  function DateToTime(unixTime,type="Y-M-D H:i:s"){
      var date = new Date(unixTime * 1000);//时间戳为10位需*1000，时间戳为13位的话不需乘1000
      var datetime = "";
      datetime += date.getFullYear() + type.substring(1,2);
      datetime += (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1) + type.substring(3,4);
      datetime += (date.getDate() < 10 ? '0'+(date.getDate()) : date.getDate());
      if (type.substring(5,6)) {
          if (type.substring(5,6).charCodeAt() > 255) {
              datetime += type.substring(5,6);
              if (type.substring(7,8)) {
                  datetime += " " + (date.getHours() < 10 ? '0'+(date.getHours()) : date.getHours());
                  if (type.substring(9,10)) {
                      datetime += type.substring(8,9) + (date.getMinutes() < 10 ? '0'+(date.getMinutes()) : date.getMinutes());
                      if (type.substring(11,12)) {
                          datetime += type.substring(10,11) + (date.getSeconds() < 10 ? '0'+(date.getSeconds()) : date.getSeconds());
                      };
                  };
              };
          }else{
              datetime += " " + (date.getHours() < 10 ? '0'+(date.getHours()) : date.getHours());
              if (type.substring(8,9)) {
                  datetime += type.substring(7,8) + (date.getMinutes() < 10 ? '0'+(date.getMinutes()) : date.getMinutes());
                  if (type.substring(10,11)) {
                      datetime += type.substring(9,10) + (date.getSeconds() < 10 ? '0'+(date.getSeconds()) : date.getSeconds());
                  };
              };
          };
      };
      return datetime; 
  }
	layui.use(['jquery','layer','element','laypage'],function(){
	      window.jQuery = window.$ = layui.jquery;
	      window.layer = layui.layer;
          var element = layui.element(),
              laypage = layui.laypage;

            
          laypage({
					cont: 'page',
					pages: '<?=$number?>' //总页数
						,
					groups: 5 //连续显示分页数
						,
					jump: function(obj, first) {
						//得到了当前页，用于向服务端请求对应数据

						if(!first) {
              var curr = obj.curr,
              index = layer.msg('请稍候,加载中',{icon: 16,time:false,shade:0.8});
              $.ajax({
                type:'post',
                url: "<?=base_url('manage/dealrecordSend')?>",
                data:{number:curr},
                cache:false,
                dataType:'JSON',
                success:function(data){
                  console.log(data)
                  var html = "";
                  $.each(data,function(index, el) {
                    html  += "<tr><td>"+el.id+"</td>"
                          +"<td>"+el.useraccounts+"</td>"
                          +"<td>"+el.accounts+"</td>"
                          +"<td>"+DateToTime(el.addtime)+"</td>"
                          +"<td>"+el.nickname+"</td>"
                          +"<td>"+el.remark+"</td>"
                          +"<td>"+el.moneys+"</td>";
                  });
                  $('#codes').html(html)
                  layer.close(index);
                },
                  error:function(e){
                    layer.close(index);
                  },
                  beforeSend:function(e){
                    
                  }
              });
						}
					}
				});
    });

</script>
</body>
</html>