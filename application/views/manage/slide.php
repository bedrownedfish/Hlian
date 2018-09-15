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
            
		         <!-- 操作日志 -->
                <div class="layui-form news_list">
                    <table class="layui-table">
					   
					<thead>
						<tr>
							<th>编号</th>
							<th>修改时间</th>
							<th>图片</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody class="news_content" id="codeht">
						<?php foreach($slide as $k=>$v):?>
						<tr >
							<td><?=$v['id']?></td>
							<td><?=date('Y-m-d H:i:s',$v['addtime'])?></td>
							<td><img style="width: 600px;height: 300px" src="<?=base_url($v['imgs'])?>"></td>
							<td>
								<a href="<?=base_url('news/setSlide?id=').$v['id']?>" class="layui-btn layui-btn-mini news_edit" ><i class="iconfont icon-edit"></i>编辑</a>
							</td>
						</tr>
						<?php endforeach?>
					</tbody>
					</table>
			    </div>
		    </div>
		</div>
</section>
</body>
</html>