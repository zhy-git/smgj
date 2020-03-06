<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:57:"/www/wwwroot/smgj/public/../app/wap/view/center/bank.html";i:1536977562;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>银行账号</title>
		<link rel="icon" href="__IMG__/wap_new/favicon.ico" type="image/x-icon">
		<link rel="shortcut icon" href="__IMG__/wap_new/favicon.ico" type="image/x-icon" />
		<link href="__CSS__/wap_new/mui.min.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="__CSS__/wap_new/common.css"/>
		<link rel="stylesheet" type="text/css" href="__CSS__/wap_new/index.css"/>
	</head>
	<body>
		<header class="mui-bar mui-bar-nav">
		    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
		    <h1 class="mui-title">银行账号</h1>
		</header>
		<div class="mui-content">
			<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
				<div class="bank-box ">
					<h4 class="color_ff"><?php echo $vo['bank']; ?>  <a href="javascript:void(0);"><img class="icon-small vertical-align_m" src="img/icon-editu.png" alt="" /></a> </h4>
					<p class="color_ff mg_top20">开户姓名：<?php echo $vo['name']; ?></p>
					<p class="color_ff mg_top10">开户账号：**** **** **** **** <?php echo substr($vo['num'],-4); ?></p>
					<p class="color_ff mg_top10">开户网点：<?php echo $vo['bank_branch']; ?></p>
				</div>
			<?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
		<div class="msg-spring"></div>
		<script src="__JS__/wap_new/mui.min.js"></script>
		<script src="__JS__/wap_new/jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="__JS__/wap_new/index.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
	    </script>
	</body>
</html>