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
	<script type="text/javascript" src="<?=base_url('public/manage/')?>common/layui/layui.js"></script>
	<script type="text/javascript" src="<?=base_url('public/manage/')?>js/newslist.js"></script>
</head>
<body>
<section class="layui-larry-box">
	<div class="larry-personal">
	    <div class="layui-tab">
    <blockquote class="layui-elem-quote news_search">
    	<form action="<?=base_url('manage/table')?>" method="get">
		<div class="layui-inline">
		    <div class="layui-input-inline">
		    	<input value="" name="code" placeholder="请输入eth账户"  class="layui-input search_input" type="text">
		    </div>
		    <!-- <a class="layui-btn search_btn">查询</a> -->
		    <input type="submit" value="查询" class="layui-btn search_btn">
		</div>
		</form>
		<!-- <div class="layui-inline">
			<a class="layui-btn layui-btn-normal newsAdd_btn">添加文章</a>
		</div>
		<div class="layui-inline">
			<a class="layui-btn recommend" style="background-color:#5FB878">推荐文章</a>
		</div>
		<div class="layui-inline">
			<a class="layui-btn audit_btn">审核文章</a>
		</div>
		<div class="layui-inline">
			<a class="layui-btn layui-btn-danger batchDel">批量删除</a>
		</div>
		<div class="layui-inline">
			<div class="layui-form-mid layui-word-aux">本页面刷新后除新添加的文章外所有操作无效，关闭页面所有数据重置</div>
		</div> -->
	</blockquote>
            
		         <!-- 操作日志 -->
                <div class="layui-form news_list">
                    <table class="layui-table">
					<thead>
						<tr>
							<th><input name="" lay-skin="primary" lay-filter="allChoose" id="allChoose" type="checkbox">
								<div class="layui-unselect layui-form-checkbox" lay-skin="primary"><i class="layui-icon"></i></div>
							</th>							
							<th style="text-align:left;">账户信息</th>
							<th>编号</th>
							<th>添加时间</th>
							<th>昵称</th>
							<th>ETH余额</th>
							<th>H链余额</th>
							<th>状态</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody class="news_content" id="codeht">
						<?php foreach($codes as $k=>$v):?>
						<tr >
							<td><input name="checked" lay-skin="primary" lay-filter="choose" type="checkbox">
								<div class="layui-unselect layui-form-checkbox" lay-skin="primary"><i class="layui-icon"></i></div>
							</td>
							
							<td align="left"><?=$v['eth_accounts']?></td>
							<td><?=$v['userid']?></td>
							<td><?=date('Y-m-d H:i:s',$v['addtime'])?></td>
							<td><?=$v['nickname']?></td>
							<td><?=number_format($v['ether'],8)?></td>
							<td><?=number_format($v['hlink'],8)?></td>
							<td style="color: <?=$v['type']?"green":"red"?>"><?=$v['type']?"正常":"已冻结"?></td>
							<td>
								<a class="layui-btn layui-btn-mini news_edit" data-id=<?=$v['eth_accounts']?>><i class="iconfont icon-edit"></i>编辑</a>
							</td>
						</tr>
						<?php endforeach?>
					</tbody>
					</table>
                     <div class="larry-table-page clearfix">
                          <a href="javascript:;" class="layui-btn layui-btn-small"><i class="iconfont icon-shanchu1"></i>冻结</a>
				          <div id="page" class="page"></div>
			         </div>
			    </div>
			     <!-- 登录日志 -->
			    <div class="layui-tab-item layui-field-box">
			          <table class="layui-table table-hover" lay-even="" lay-skin="nob">
                           <thead>
                              <tr>
                                  <th><input type="checkbox" id="selected-all"></th>
                                  <th>ID</th>
                                  <th>管理员账号</th>
                                  <th>状态</th>
                                  <th>最后登录时间</th>
                                  <th>上次登录IP</th>
                                  <th>登录IP</th>
                                  <th>IP所在位置</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td><input type="checkbox"></td>
                                <td>110</td>
                                <td>admin</td>
                                <td>后台登录成功</td>
                                <td>2016-12-19 14:26:03</td>
                                <td>127.0.0.1</td>
                                <td>127.0.0.1</td>
                                <td>Unknown</td>
                              </tr>
                            </tbody>
			          </table>
			          <div class="larry-table-page clearfix">
                          <a href="javascript:;" class="layui-btn layui-btn-small"><i class="iconfont icon-shanchu1"></i>冻结</a>
				          <div id="page2" class="page"></div>
			         </div>
			    </div>
		    </div>
		</div>
</section>
<script type="text/javascript">
	var page = '<?=$_POST["page"]?$_POST["page"]:1?>',
		seturl = '<?=base_url("manage/table")?>',
		hurl = '<?=base_url('manage/table_1')?>';
	layui.use(['jquery','layer','element','laypage'],function(){
	    window.jQuery = window.$ = layui.jquery;
	    window.layer = layui.layer;
        var element = layui.element(),
            laypage = layui.laypage;
        laypage({
					cont: 'page',
					pages: <?=ceil($total_nums/$pagenum)?> //总页数
						,
					groups: 5 //连续显示分页数
						,
					jump: function(obj, first) {
						
						//得到了当前页，用于向服务端请求对应数据
						var curr = obj.curr;
						if(!first) {
							var index = layer.msg('查询中，请稍候',{icon: 16,time:false,shade:0.8});
							$.ajax({
								type:'get',
								url:'<?=base_url('Manage/table')?>',
								data:{page:obj.curr},
								cache:false,
								dataType:'JSON',
								success:function(data){
									
									layer.close(index);
									var htmls = "";
									data.map(function(n){
										htmls+= '<tr><td><input name="checked" lay-skin="primary" lay-filter="choose" type="checkbox"><div class="layui-unselect layui-form-checkbox"><span>勾选</span><i class="layui-icon"></i></div></td>';
										htmls+='<td align="left">'+n.eth_accounts+'</td>';
										htmls+='<td>'+n.id+'</td>';
										htmls+='<td>'+DateToTime(parseInt(n.addtime))+'</td>';
										htmls+='<td>'+n.nickname+'</td>';
										htmls+='<td>'+n.ether+'</td>';
										htmls+='<td>'+n.hlink+'</td>';
										htmls+='<td><a class="layui-btn layui-btn-mini news_edit"><i class="iconfont icon-edit"></i> 编辑</a></td></tr>';

									})
									$('#codeht').html(htmls);
								},
							    error:function(e){
							    	layer.close(index);
							    },
							    beforeSend:function(e){
							    	layer.close(index);
							    }
							});
							// layer.msg('第 '+ obj.curr +' 页');
						}
					}
				});
    });
</script>
</body>
</html>