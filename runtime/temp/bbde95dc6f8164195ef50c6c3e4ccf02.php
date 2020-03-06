<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:57:"/www/wwwroot/smgj/public/../app/wap/view/index/index.html";i:1541038443;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>首页</title>
		<link rel="icon" href="__IMG__/favicon.ico" type="image/x-icon">
        <link rel="shortcut icon" href="__IMG__/favicon.ico" type="image/x-icon" />
		<link href="__CSS__/wap_new/mui.min.css" rel="stylesheet" />
		<link href="__CSS__/wap_new/swiper.min.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="__CSS__/wap_new/common.css"/>
		<link rel="stylesheet" type="text/css" href="__CSS__/wap_new/index.css"/>
	</head>
	<body >
		<header class="mui-bar mui-bar-nav">
			<span class="left"><img class="logo" src="__IMG__/wap_new/logo.png" alt="" /></span>
			<div class="right mg_top10">
				<span class="color_ff"><img class="icon-small vertical-align_m" src="__IMG__/wap_new/icon-user.png" alt="" /><?php echo $memMoney['name']; ?></span>
				<a href="<?php echo url('login/out'); ?>" class="color_ff mg_left10">退出</a>
			</div>
		</header>
		<nav class="mui-bar mui-bar-tab">
		    <a class="mui-tab-item1 mui-active" href="<?php echo url('Index/index'); ?>">
		        <span class="mui-icon "><img src="__IMG__/wap_new/icon-01yellow.png" alt="" /></span>
		        <span class="mui-tab-label">首页</span>
		    </a>
		    <a class="mui-tab-item1" href="<?php echo url('Index/game'); ?>">
		        <span class="mui-icon "><img src="__IMG__/wap_new/icon-02.png" alt="" /></span>
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
			<div id="banner" class="bg_ff">
				<div class="swiper-container">
			        <div class="swiper-wrapper">
			            <div class="swiper-slide swiper-slide-center none-effect"><a href="#"><img src="__IMG__/wap_new/banner.png"/></a></div>
			            <div class="swiper-slide"><a href="#"><img src="__IMG__/wap_new/banner.png"/></a></div>
			            <div class="swiper-slide"><a href="#"><img src="__IMG__/wap_new/banner.png"/></a></div>
			            <div class="swiper-slide"><a href="#"><img src="__IMG__/wap_new/banner.png"/></a></div>
			            <div class="swiper-slide"><a href="#"><img src="__IMG__/wap_new/banner.png"/></a></div>
			        </div>
			        
			    </div>
			    <div class="swiper-pagination"></div>

			</div>
		    <div class="clearfix padding_10">
				<img class="laba left" src="__IMG__/wap_new/laba.png" alt="" />
								
				<div class="scrollDiv left" id="s1">
					<marquee direction="left" class="left" style="width: 98%;">
						<?php if(is_array($noticeList) || $noticeList instanceof \think\Collection || $noticeList instanceof \think\Paginator): $i = 0; $__LIST__ = $noticeList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
							<strong>【平台公告】</strong><?php echo $vo['info']; endforeach; endif; else: echo "" ;endif; ?>
					</marquee>	
				</div>	
					<!--<ul>
						{volist name="$noticeList" id="vo"}
							<li><a href="#">【平台公告】</a></li>

					</ul>
				-->
			</div>
			<div class="text-center tiele">
				<img src="__IMG__/wap_new/1.png" alt="" />
				<span class="padding_lr10 font_16">热门彩种</span>
				<img src="__IMG__/wap_new/2.png" alt="" />
			</div>
		    <ul class="clearfix index-game padding_10 padding_b20">
		    	<li><a href="<?php echo url('Pcdd/index',['cate'=>1,'hall'=>1]); ?>"><img src="__IMG__/wap_new/game-01.png" alt="" /><p class="color_55">PC蛋蛋</p> </a></li>
		    	<li><a href="<?php echo url('hall'); ?>"><img src="__IMG__/wap_new/game-02.png" alt="" /><p class="color_55">加拿大28</p> </a></li>
		    	<li><a  href="<?php echo url('Car/index',['cate'=>5,'hall'=>1]); ?>"><img src="__IMG__/wap_new/game-03.png" alt="" /><p class="color_55">北京赛车</p> </a></li>
		    	<li><a href="<?php echo url('Xyft/index',['cate'=>7,'hall'=>1]); ?>"><img src="__IMG__/wap_new/game-04.png" alt="" /><p class="color_55">幸运飞艇</p> </a></li>
		    	<li><a href="<?php echo url('Cqssc/index',['cate'=>3,'hall'=>1]); ?>"><img src="__IMG__/wap_new/game-05.png" alt="" /><p class="color_55">重庆时时彩</p> </a></li>
		    	<li><a href="<?php echo url('Xglhc/index',['cate'=>8,'hall'=>1]); ?>"><img src="__IMG__/wap_new/game-06.png" alt="" /><p class="color_55">香港六合彩</p> </a></li>
		    	<li><a href="<?php echo url('Mssc/index',['cate'=>6,'hall'=>1]); ?>"><img src="__IMG__/wap_new/game-07.png" alt="" /><p class="color_55">极速赛车</p> </a></li>
		    	<li><a href="<?php echo url('Msssc/index',['cate'=>4,'hall'=>1]); ?>"><img src="__IMG__/wap_new/game-08.png" alt="" /><p class="color_55">极速时时彩</p> </a></li>
		    	<li><a target="_blank" href="<?php echo $url; ?>"><img src="__IMG__/wap_new/game-09.png" alt="" /><p class="color_55">在线客服</p> </a></li>
		    </ul>
		</div>
		<div class="notice-box" style="display: block;">
			<h4 class="text-center">紧急公告</h4>
			<p class="mg_top10 lin_25 notice-font"><?php echo $notice['info']; ?></p>
			<p class="mg_top10 text-center"><a href="javascript:void(0);" onclick="$('.notice-box').hide();" class="next-a big_btn">我知道了</a></p>
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
        //头部导航
        $("#icon-add").click(function(){
        	if($(".index-nav").is(":hidden")){
        		$(".index-nav").show()
        	}else{
        		$(".index-nav").hide()
        	}
        })
		window.onload = function() {
		    var swiper = new Swiper('.swiper-container',{
//		    	width : window.innerWidth,
				autoplay:3000,
				speed:1000,
				autoplayDisableOnInteraction : false,
				loop:true,
				centeredSlides : true,
				slidesPerView:2,
		        pagination : '.swiper-pagination',
				paginationClickable:true,
				prevButton:'.swiper-button-prev',
		        nextButton:'.swiper-button-next',
				onInit:function(swiper){
					swiper.slides[2].className="swiper-slide swiper-slide-active";//第一次打开不要动画
					},
		        breakpoints: { 
		                668: {
		                    slidesPerView: 1,
		                 }
		            }
				});
			}
	   </script>
	</body>

</html>