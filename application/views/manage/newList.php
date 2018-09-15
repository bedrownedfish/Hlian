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
</head>
<body>
<section class="layui-larry-box">
	<div class="larry-personal">
	    <div class="layui-tab">
    <blockquote class="layui-elem-quote news_search">
    	
		<div class="layui-inline">
		    <!-- <a class="layui-btn search_btn">查询</a> -->
		   <a class="layui-btn search_btn" href="<?=base_url('news/newsAdd')?>">添加</a>
		</div>
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
							<th>编号</th>
							<th style="text-align:left;">标题</th>
							<th>摘要</th>
							<th>更改时间</th>
							<th>简图</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody class="news_content" id="codeht">
						<?php foreach($codes as $k=>$v):?>
						<tr >
							<td><?=$v['id']?></td>
							<td align="left"><?=$v['title']?></td>
							<td><?=$v['abstract']?></td>
							<td><?=date('Y-m-d H:i:s',$v['addtime'])?></td>
							<td><img style="width: 200px;height: 100px" src="<?=base_url($v['images'])?>"></td>
							<td>
								<a class="layui-btn layui-btn-mini news_edit" data-id=<?=$v['id']?>><i class="iconfont icon-edit"></i>编辑</a>
							</td>
						</tr>
						<?php endforeach?>
					</tbody>
					</table>
                     <div class="larry-table-page clearfix">
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
		hurl = '<?=base_url('news/setNews')?>';
	layui.config({
		base : "/public/manage/js/"
	}).use(['form','layer','jquery','laypage'],function(){
		var form = layui.form(),
			layer = parent.layer === undefined ? layui.layer : parent.layer,
			laypage = layui.laypage,
			$ = layui.jquery;
		//加载页面数据
		var newsData = '';
		$("body").on("click",".news_edit",function(){  //编辑
			var id = $(this).data('id');
			window.location.href = hurl+'?id='+id;
		})
	})
</script>
</body>
</html>