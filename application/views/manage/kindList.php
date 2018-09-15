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
							<th>昵称</br>（必须为英文简写）</th>
							<th>合约名称</th>
							<th style="text-align:left;">合约地址</th>
							<th>添加时间</th>
							<th>价格</th>
							<th>发行币量</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody class="news_content" id="codeht">
						<?php foreach($codes as $k=>$v):?>
						<tr >
							<td><?=$v['id']?></td>
							<td><?=$v['nickname']?></td>
							<td><?=$v['tokname']?></td>
							<td align="left"><?=$v['contract']?></td>
							<td><?=date('Y-m-d H:i:s',$v['addtime'])?></td>
							<td><?=number_format($v['price'],2)?></td>
							<td><?=$v['numbers']?></td>
							<td>
								<a class="layui-btn layui-btn-mini news_edit" data-id=<?=$v['contract']?>><i class="iconfont icon-edit"></i>编辑</a>
							</td>
						</tr>
						<?php endforeach?>
					</tbody>
					</table>
                     
			    </div>
		    </div>
		</div>
</section>
<script type="text/javascript">
var hurl = "<?=base_url('kinds/setKinds')?>";
layui.config({
	base : "/public/manage/js/"
}).use(['form','layer','jquery','laypage'],function(){
	var form = layui.form(),
		layer = parent.layer === undefined ? layui.layer : parent.layer,
		laypage = layui.laypage,
		$ = layui.jquery;
	//加载页面数据
	var newsData = '';
	//操作
	$("body").on("click",".news_edit",function(){  //编辑
		var id = $(this).data('id');
		window.location.href = hurl+'?id='+id
		// window.open(hurl+'?id='+id);

	})
})
	
</script>
</body>
</html>