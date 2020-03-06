<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:62:"/www/wwwroot/smgj/public/../app/wap/view/agent/agent_back.html";i:1540630435;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>团队返红记录</title>
		<link rel="icon" href="__IMG__/favicon.ico" type="image/x-icon">
        <link rel="shortcut icon" href="__IMG__/favicon.ico" type="image/x-icon" />
		<link href="__CSS__/wap_new/mui.min.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="__CSS__/wap_new/common.css"/>
		<link rel="stylesheet" type="text/css" href="__CSS__/wap_new/index.css"/>
	</head>
	<body>
		<header class="mui-bar mui-bar-nav">
		    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
		    <h1 class="mui-title">团队返红记录</h1>
		</header>
		<div class="mui-content ">
			<div class="table-box bg_ff">
				<table border="" cellspacing="" cellpadding="">
					<tr>
						<th>账单日期</th>
						<th>团队总投注</th>
						<th>已返红金额</th>
						<th>账单状态</th>
					</tr>
					<?php if(!(empty($data) || (($data instanceof \think\Collection || $data instanceof \think\Paginator ) && $data->isEmpty()))): if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
					<tr>
						<td><?php echo $vo['days']; ?></td>
						<td><?php echo bcadd($vo['bet_money'],0,2); ?></td>
						<td><?php echo bcsub($vo['back'],0,2); ?></td>
						<td>已审核</td>
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
		<script type="text/javascript">
		
		
		
	    </script>
	</body>

</html>