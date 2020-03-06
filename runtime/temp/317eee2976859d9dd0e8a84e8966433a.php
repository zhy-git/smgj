<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:63:"/www/wwwroot/smgj/public/../app/wap/view/account/tx_before.html";i:1540952169;}*/ ?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title><?php echo $title; ?>提现</title>
		<link rel="icon" href="__IMG__/favicon.ico" type="image/x-icon">
        <link rel="shortcut icon" href="__IMG__/favicon.ico" type="image/x-icon" />
		<link href="__CSS__/wap_new/mui.min.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="__CSS__/wap_new/common.css"/>
		<link rel="stylesheet" type="text/css" href="__CSS__/wap_new/index.css"/>
	</head>
	<body class="bg_ff">
		<header class="mui-bar mui-bar-nav">
		    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
		    <h1 class="mui-title"><?php echo $title; ?>提现</h1>
		</header>
		<div class="mui-content">
			<div class="bank-info bg_ff">
				<!--还未绑定时出现的列表-->
				<?php if(empty($userCard) || (($userCard instanceof \think\Collection || $userCard instanceof \think\Paginator ) && $userCard->isEmpty())): ?>
				<p class="text-center color_00 padding_10">你还未绑定<?php echo $title; ?>账户</p>
				<p class="mg_top40 padding_lr30"><a href="<?php echo url('add_card',['way'=>$way]); ?>" class="big_btn">去绑定</a></p>
				<?php else: ?>
				<!--已绑定时出现的列表-->
				<div class="<?php if($way>1): ?>pay-box<?php else: ?>pay-box2<?php endif; ?>" data="<?php echo $way; ?>">
					<p class="color_ff">
						<label>用户名:</label>
						<span><?php echo $userCard['name']; ?></span>
					</p>
					<p class="color_ff mg_top10">
						<label><?php echo $title; ?>账户:</label>
						<?php if($way>1): ?>
						<span><?php echo $userCard['num']; ?></span>
						<?php else: ?>
						<span><?php echo $userCard['num']; ?></span>
						<?php endif; ?>
					</p>
				</div>
				<p class="mg_top40 padding_lr30"><a href="<?php echo url('tx_con',['way'=>$way]); ?>" class="big_btn">提现</a></p>
				<?php endif; ?>
			</div>	
		</div>
		<div class="msg-spring"></div>
		<script src="__JS__/wap_new/mui.min.js"></script>
		<script src="__JS__/wap_new/jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="__JS__/wap_new/index.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript"></script>
	</body>
</html>