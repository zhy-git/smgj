<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:61:"/www/wwwroot/smgj/public/../app/wap/view/agent/team_page.html";i:1539158616;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>团队流水查询</title>
		<link rel="icon" href="__IMG__/wap_new/favicon.ico" type="image/x-icon">
		<link rel="shortcut icon" href="__IMG__/wap_new/favicon.ico" type="image/x-icon" />
		<link href="__CSS__/wap_new/mui.min.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="__CSS__/wap_new/common.css"/>
		<link rel="stylesheet" type="text/css" href="__CSS__/wap_new/index.css"/>
	</head>
	<body>
		<header class="mui-bar mui-bar-nav">
		    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
		    <h1 class="mui-title">团队流水查询</h1>
		</header>
		<div class="mui-content">
			<!--<p><input type="date" name="time" id="time" value="" onchange="window.location.href='/Home/agent/team_page/time/'+this.val()"/></p>-->
			<p class="text_right padding_lr10">当日下线总流水：<?php echo bcadd($flow,0,2); ?></p>
			<div class="table-box bg_ff">
				<table border="" cellspacing="" cellpadding="">
					<tr>
						<th>会员</th>
						<th>投注</th>
						<th>亏盈</th>
						<th>余额</th>
					</tr>
					<?php if(!(empty($data) || (($data instanceof \think\Collection || $data instanceof \think\Paginator ) && $data->isEmpty()))): if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
					<tr>
						<td><?php echo $vo['gm_name']; ?></td>
						<td><?php echo bcadd($vo['flow'],0,2); ?></td>
						<td><?php echo bcsub($vo['z_money'],$vo['flow'],2); ?></td>
						<td><?php echo bcadd($vo['money'],0,2); ?></td>
					</tr>
					<?php endforeach; endif; else: echo "" ;endif; else: ?>
					<tr><td colspan="4">你还没有下级哦！</td></tr>
					<?php endif; ?>
				</table>
			</div>
		</div>
		<div class="msg-spring"></div>
		<script src="__JS__/wap_new/mui.min.js"></script>
		<script src="__JS__/wap_new/jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="__JS__/wap_new/index.js" type="text/javascript" charset="utf-8"></script>
	</body>

</html>