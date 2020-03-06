<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:57:"/www/wwwroot/smgj/public/../app/wap/view/center/main.html";i:1540624815;}*/ ?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>个人资料</title>
		<link rel="icon" href="__IMG__/wap_new/favicon.ico" type="image/x-icon">
		<link rel="shortcut icon" href="__IMG__/wap_new/favicon.ico" type="image/x-icon" />
		<link href="__CSS__/wap_new/mui.min.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="__CSS__/wap_new/common.css"/>
		<link rel="stylesheet" type="text/css" href="__CSS__/wap_new/index.css"/>
	</head>
	<body>
		<header class="mui-bar mui-bar-nav">
		    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
		    <h1 class="mui-title">个人资料</h1>
		</header>
		<div class="mui-content bg_ff">
			<div class="padding_10 bor_b clearfix">
				<span class="left">账号</span>
				<span class="right"><?php echo $memInfo['gm_name']; ?></span>
			</div>
			<div class="padding_10 bor_b clearfix">
				<span class="left">真实姓名</span>
				<span class="right"><?php echo $memInfo['true_name']; ?></span>
			</div>
			<div class="padding_10 bor_b clearfix">
				<span class="left">币别</span>
				<span class="right">RMB</span>
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