<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:56:"/www/wwwroot/smgj/public/../app/wap/view/index/game.html";i:1540196271;s:61:"/www/wwwroot/smgj/public/../app/wap/view/common/top_list.html";i:1539757393;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>游戏大厅</title>
		<link rel="icon" href="__IMG__/favicon.ico" type="image/x-icon">
		<link rel="shortcut icon" href="__IMG__/wap_new/favicon.ico" type="image/x-icon" />
		<link href="__CSS__/wap_new/mui.min.css" rel="stylesheet" />
		<link href="__CSS__/wap_new/swiper.min.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="__CSS__/wap_new/common.css"/>
		<link rel="stylesheet" type="text/css" href="__CSS__/wap_new/index.css"/>
	</head>
	<body >
		<header class="mui-bar mui-bar-nav">
		    <h1 class="mui-title">游戏大厅</h1>
		    <span class="top-icon">
		    	<a href="javascript:void(0);" class="mg_left10 color_ff" id="icon-add">
		    		<img class="icon-small vertical-align_m" src="__IMG__/wap_new/icon-list.png" alt=""/>
		    	</a>	
		    </span>
			<div class="index-nav">
    <div class="top-nav">
        <a href="<?php echo url('Report/unsettled'); ?>"><img class="vertical-align_m icon-small1" src="__IMG__/wap/icon_ball01.png" alt="" />即时注单<p class="red" id="memUnMoney" style="text-align: center;">(<?php echo bcadd($mem['unpaid_money'],0,2); ?>)</p></a>
        <a href="<?php echo url('Report/settled'); ?>"><img class="vertical-align_m icon-small1" src="__IMG__/wap/icon_bal02.png" alt="" /> 今日已结</a>
        <a href="<?php echo url('Report/noteRecord'); ?>"><img class="vertical-align_m icon-small1" src="__IMG__/wap/icon_bal03.png" alt="" /> 下注记录</a>
        <a href="<?php echo url('Report/openResult'); ?>"><img class="vertical-align_m icon-small1" src="__IMG__/wap/icon_bal04.png" alt="" /> 开奖结果</a>
        <a href="<?php echo url('Index/hall_cl'); ?>"><img class="vertical-align_m icon-small1" src="__IMG__/wap/icon_bal05.png" alt="" /> 两面长龙</a>
        <!--<a href="<?php echo url('report/rule'); ?>"><img class="vertical-align_m icon-small1" src="__IMG__/wap/icon_bal06.png" alt="" /> 游戏规则</a>-->
        <a href="<?php echo url('account/index'); ?>"><img class="vertical-align_m icon-small1" src="__IMG__/wap/icon_bal07.png" alt="" /> 充值</a>
        <a href="<?php echo url('account/index'); ?>"><img class="vertical-align_m icon-small1" src="__IMG__/wap/icon_bal08.png" alt="" /> 提现</a>
    </div>
    <p class="icon-triangle"></p>
</div>
		</header>
		<nav class="mui-bar mui-bar-tab">
		    <a class="mui-tab-item1 " href="<?php echo url('Index/index'); ?>">
		        <span class="mui-icon "><img src="__IMG__/wap_new/icon-01.png" alt="" /></span>
		        <span class="mui-tab-label">首页</span>
		    </a>
		    <a class="mui-tab-item1 mui-active" href="<?php echo url('Index/game'); ?>">
		        <span class="mui-icon "><img src="__IMG__/wap_new/icon-02yellow.png" alt="" /></span>
		        <span class="mui-tab-label">游戏大厅</span>
		    </a>
		    <a class="mui-tab-item1 " href="<?php echo url('Account/index'); ?>">
		        <span class="mui-icon"><img src="__IMG__/wap_new/icon-03.png" alt="" /></span>
		        <span class="mui-tab-label">资金管理</span>
		    </a>
		    <a class="mui-tab-item1 " href="<?php echo url('Center/index'); ?>">
		        <span class="mui-icon "><img src="__IMG__/wap_new/icon-04.png" alt="" /></span>
		        <span class="mui-tab-label">我的</span>
		    </a>
		</nav>
		<div class="mui-content">
			<div class="clearfix padding_10">
				<img class="laba left" src="__IMG__/wap_new/laba.png" alt="" />
				<div class="scrollDiv left" id="s1">
					<ul>
						<?php if(is_array($noticeList) || $noticeList instanceof \think\Collection || $noticeList instanceof \think\Paginator): $i = 0; $__LIST__ = $noticeList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
							<li><a href="#">【平台公告】<?php echo $vo['title']; ?></a></li>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
			</div>
	        <ul class="clearfix index-game padding_10 padding_b20">
				<li><a href="<?php echo url('Pcdd/index',['cate'=>1,'hall'=>1]); ?>"><img src="__IMG__/wap_new/game-01.png" alt="" /><p class="color_55">PC蛋蛋</p> </a></li>
				<li><a href="<?php echo url('hall'); ?>"><img src="__IMG__/wap_new/game-02.png" alt="" /><p class="color_55">加拿大28</p> </a></li>
				<li><a href="<?php echo url('Car/index',['cate'=>5,'hall'=>1]); ?>"><img src="__IMG__/wap_new/game-03.png" alt="" /><p class="color_55">北京赛车</p> </a></li>
				<li><a href="<?php echo url('Xyft/index',['cate'=>7,'hall'=>1]); ?>"><img src="__IMG__/wap_new/game-04.png" alt="" /><p class="color_55">幸运飞艇</p> </a></li>
				<li><a href="<?php echo url('Cqssc/index',['cate'=>3,'hall'=>1]); ?>"><img src="__IMG__/wap_new/game-05.png" alt="" /><p class="color_55">重庆时时彩</p> </a></li>
				<li><a href="<?php echo url('Xglhc/index',['cate'=>8,'hall'=>1]); ?>"><img src="__IMG__/wap_new/game-06.png" alt="" /><p class="color_55">香港六合彩</p> </a></li>
				<li><a href="<?php echo url('Mssc/index',['cate'=>6,'hall'=>1]); ?>"><img src="__IMG__/wap_new/game-07.png" alt="" /><p class="color_55">极速赛车</p> </a></li>
				<li><a href="<?php echo url('Msssc/index',['cate'=>4,'hall'=>1]); ?>"><img src="__IMG__/wap_new/game-08.png" alt="" /><p class="color_55">极速时时彩</p> </a></li>
		    </ul>
		</div>
		<div class="msg-spring"></div>
		<script src="__JS__/wap_new/mui.min.js"></script>
		<script src="__JS__/wap_new/jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="__JS__/wap_new/swiper.min.js"></script>
		<script src="__JS__/wap_new/email-decode.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="__JS__/wap_new/index.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
		function AutoScroll(obj) {
			$(obj).find("ul:first").animate({
				marginTop: "-25px"
			}, 500, function() {
				$(this).css({
					marginTop: "0px"
				}).find("li:first").appendTo(this);
			});
		}
		$(document).ready(function() {
			setInterval('AutoScroll("#s1")', 2000);
		});
	   </script>
	</body>
</html>