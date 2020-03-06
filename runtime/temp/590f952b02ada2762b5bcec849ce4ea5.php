<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:61:"/www/wwwroot/smgj/public/../app/home/view/download/index.html";i:1539742279;}*/ ?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta HTTP-EQUIV="Pragma" CONTENT="no-cache">
    <meta HTTP-EQUIV="Expires" CONTENT="-1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <link rel="shortcut icon" href="__IMG__/favicon.ico" />
    <link rel="bookmark" href="__IMG__/favicon.ico" type="image/x-icon"　/>
    <title>生米国际</title>
    <link rel="stylesheet" href="__CSS__/common.css">
    <link rel="stylesheet" type="text/css" href="__CSS__/chat-index.css"/>
    <link rel="stylesheet" type="text/css" href="__CSS__/index_sy.css"/>
    <script src="__JS__/jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="__JS__/layer.js" ></script>
</head>
<style>
	.head-top{
		width: 1200px;
		margin: auto;
	}
	.bg_00{
		background-color: rgb(26,29,38);
	}
	.head-left input{
		width: 150px;
		border: 1px solid #A3A674;
		background: transparent;
		padding: 5px;
		border-radius: 5px;
		color: #fff;
	}
	.head-left input:focus{
		outline: none;
	}
	.head-left input::-webkit-input-placeholder{
		color: #A3A674
	}
	.head-left input:-moz-placeholder{
		color: #A3A674
	}
	.head-left input:-ms-input-placeholder{
		color: #A3A674
	}

	.relative{
		position: relative;
	}
	.absolute{
		position: absolute;
	}
	.head-left input.getcode{
		width: 120px;
	}
	.head-right img{
		vertical-align: middle;
		margin-right: 5px;
	}
	.head-right a{
		color:  #fff;
		padding: 0 10px;
	}
</style>
<body>
	<div class="index-top">
		<div class="bg_00 padding_10">
			<div class="head-top clearfix">
				<div class="head-right right">
					<a href="<?php echo url('center/index'); ?>"><img src="__IMG__/icon-h01.png" alt="" /> 会员中心</a>
					<a href="<?php echo url('Account/index'); ?>"><img src="__IMG__/icon-h01.png" alt="" /> 在线存款</a>
					<a href="<?php echo url('Account/index'); ?>"><img src="__IMG__/icon-h01.png" alt="" /> 在线取款</a>
					<a href="<?php echo url('login/out'); ?>"><img src="__IMG__/icon-h01.png" alt=""/> 退出</a>
				</div>
			</div>
		</div>
	</div>   
    <div class="nav">
	   	<div class="nav-list">
		   	<div class="clearfix">
		   	 	<img class="left" src="__IMG__/logo.png"/>
		   	 	<ul class="right clearfix nav-li">
		   	 		<li><a href="<?php echo url('pcdd/index',['cate'=>1,'hall'=>1]); ?>">彩票游戏<br />LOTTERY</a></li>
		   	 		<li class="active"><a href="<?php echo url('Download/index'); ?>">手机APP<br />ACTIVITY</a></li>
					<li><a href="javascript:void(0);" onclick="alert('活动还未开始哦！敬请期待');">幸运抽奖<br />ANNOUNCEMENT</a></li>
					<li><a href="<?php echo url('/home/pcdd/index',['cate'=>1,'hall'=>1]); ?>" >游戏规则<br />GAMEINFORMATION</a></li>
		   	 		<li><a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $setting['service_qq_1']; ?>&site=qq&menu=yes">在线服务<br />MOBILE</a></li>
		   	 	</ul>
		   	 </div>
	   </div>
   </div>
   <div class="bg_downlode">
   	  <div class="downlode-box">
   	  	<h3>手机APP</h3>
   	  	<p>多元化移动娱乐平台、警察随时随地、一切尽在掌握之中!</p>
   	  	<div class="clearfix code-dowon">
   	  		<div class="left">
   	  			<a href="javascript:void(0);">
   	  				<p class="code-box1"><img src="<?php echo $setting['ios_qrcode']; ?>" alt="" /> </p>
   	  				<p><a target="_blank" href="<?php echo $setting['ios_link']; ?>"></a><img src="__IMG__/dwonlodeios.png" alt="" /></p>
   	  			</a>
   	  		</div>
   	  		<div class="left">
   	  			<a href="javascript:void(0);">
   	  				<p class="code-box1"><img src="<?php echo $setting['android_qrcode']; ?>" alt="" /> </p>
   	  				<p><a target="_blank" href="<?php echo $setting['android_link']; ?>"></a><img src="__IMG__/dwonlodeaz.png" alt="" /></p>
   	  			</a>
   	  		</div>
   	  	</div>
   	  </div>
   </div>
    
    <div class="game-foot">
    	<img src="__IMG__/footer.png" alt="" />
    </div>
</body>
</html>




