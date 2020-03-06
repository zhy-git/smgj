<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:64:"/www/wwwroot/smgj/public/../app/wap/view/center/back_record.html";i:1540784315;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>返水记录</title>
		<link rel="icon" href="__IMG__/wap_new/favicon.ico" type="image/x-icon">
		<link rel="shortcut icon" href="__IMG__/wap_new/favicon.ico" type="image/x-icon" />
		<link href="__CSS__/wap_new/mui.min.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="__CSS__/wap_new/common.css"/>
		<link rel="stylesheet" type="text/css" href="__CSS__/wap_new/index.css"/>
	</head>
	<body>
		<header class="mui-bar mui-bar-nav">
		    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
		    <h1 class="mui-title">返水记录</h1>
		</header>
		<div class="mui-content">
			<div class="table-box bg_ff">
				<table border="" cellspacing="" cellpadding="" class="table_nob">
					<tr>
						<th colspan="4">退水为隔日凌晨到帐</th>
					</tr>
					<tr>
						<th>时间</th>
						<th>笔数</th>
						<th>流水</th>
						<th>盈亏</th>
						<th>退水</th>
					</tr>
					<?php if(!(empty($data) || (($data instanceof \think\Collection || $data instanceof \think\Paginator ) && $data->isEmpty()))): if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
					<tr>
						<td><p><?php echo $vo['days']; ?></p></td>
						<td><?php echo $vo['count']; ?></td>
						<td><?php echo $vo['bet_money']; ?></td>
						<td class="yell"><?php echo bcsub($vo['z_money'],$vo['bet_money'],2); ?></td>
						<td ><?php echo (isset($vo['back']) && ($vo['back'] !== '')?$vo['back']:"0.00"); ?></td>
					</tr>
					<?php endforeach; endif; else: echo "" ;endif; else: ?>
					<tr><td colspan="5">无数据</td></tr>
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