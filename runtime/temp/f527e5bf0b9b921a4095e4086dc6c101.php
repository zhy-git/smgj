<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:73:"E:\phpStudy\PHPTutorial\WWW\smgj\public/../app/home\view\index\index.html";i:1540286216;}*/ ?>
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
	<link type="text/css" rel="stylesheet" href="__CSS__/iziToast.min.css">
	<script src="__JS__/jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="__JS__/jquery.validate.min.js"></script>
	<script src="__JS__/jquery.scrollbox.js" ></script>
	<script src="__JS__/layer.js" ></script>
	<script src="__JS__/common.js" ></script>
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
	<?php if($status==1): ?>
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
	<?php else: ?>
	<div class="index-top">
		<form action="<?php echo url('login/index'); ?>" id="form_login" method="post">
			<div class="text-right nav-top">
				<input type="text" name="username" id="username" value=""  placeholder="用户账号"/>
				<input type="password" name="password" id="password" value="" placeholder="密码" />
				<span class="code-box">
	   	  	 	<input name="verifyCode" class="getcode" type="text" placeholder="请输入验证码" onkeydown="KeyDown()"/>
			  	<img id="verify_img" style="height:30px;border-radius: 5px;" class="absolute codeimg" src="<?php echo captcha_src(); ?>" alt="验证码" onclick="refreshVerify()">
	   	  	</span>
				<a href="javascript:void(0);" onclick="login()" class="login-a">登录</a>
				<a href="<?php echo url('login/reg'); ?>" class="reg-a">注册</a>
				<a href="javascript:void(0);" class="forget-psd-a">忘记密码？</a>
			</div>
		</form>
	</div>
	<script>
		setTimeout(function () {
            alert('请先登录哦');
        },500);
	</script>
	<?php endif; ?>
    <div class="nav">
	   	<div class="nav-list">
		   	<div class="clearfix">
		   	 	<img class="left" src="__IMG__/logo.png"/>
		   	 	<ul class="right clearfix nav-li">
		   	 		<li class="active"><a href="<?php echo url('pcdd/index',['cate'=>1,'hall'=>1]); ?>">彩票游戏<br />LOTTERY</a></li>
		   	 		<li><a href="<?php echo url('Download/index'); ?>">手机APP<br />ACTIVITY</a></li>
		   	 		<li><a href="javascript:void(0);" onclick="alert('活动还未开始哦！敬请期待');">幸运抽奖<br />ANNOUNCEMENT</a></li>
		   	 		<li><a href="<?php echo url('/home/pcdd/index',['cate'=>1,'hall'=>1]); ?>" >游戏规则<br />GAMEINFORMATION</a></li>
		   	 		<li><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $service_qq; ?>&site=qq&menu=yes">在线服务<br />MOBILE</a></li>
		   	 	</ul>
		   	 </div>
	   </div>
   </div>
    <div id="banner"><img src="__IMG__/banner.png"/></div>
    <div class="notice">
    	<p class="notice-font clearfix">
     	   <img class="left" src="__IMG__/laba.png" alt="" />
    		<span class="left " style="font-size: 20px;line-height: 30px;">
    			<marquee direction="left" style="width: 1160px; color: #fff;margin-top: 5px;">
					<?php if(is_array($noticeList) || $noticeList instanceof \think\Collection || $noticeList instanceof \think\Paginator): $i = 0; $__LIST__ = $noticeList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nll): $mod = ($i % 2 );++$i;?>
				   		【平台公告】<?php echo $nll['info']; endforeach; endif; else: echo "" ;endif; ?>
				</marquee>

    		</span>
    	</p>
    </div> 
    <div id="bg_index">
	    <div class="game-box">
	    	<div class="padding_10 text-center">
	    		<img src="__IMG__/hot.png"/>
	    	</div>
	    	<ul class="clearfix game-ifo">
	    		<li >
	    			<a href="<?php echo url('pcdd/index',['cate'=>1,'hall'=>1]); ?>">
	    				<img src="__IMG__/game01.png" alt="" />
		    			<p href="javascript:void(0);">
		    			   最火爆彩票投注平台，口碑最好，用户好评率最高的平台
		    		    </p>
	    			</a>
	    		</li>
	    		<li >
	    			<a href="<?php echo url('jndeb/index',['cate'=>2,'hall'=>1]); ?>">
	    				<img src="__IMG__/game02.png" alt="" />
		    			<p href="javascript:void(0);">
		    			   最火爆彩票投注平台，口碑最好，用户好评率最高的平台
		    		    </p>
	    			</a>
	    		</li>
	    		<li>
	    			<a href="<?php echo url('car/index',['cate'=>5,'hall'=>1]); ?>">
	    				<img src="__IMG__/game03.png" alt="" />
		    			<p href="javascript:void(0);">
		    			   最火爆彩票投注平台，口碑最好，用户好评率最高的平台
		    		    </p>
	    			</a>
	    		</li>
	    		<li>
	    			<a href="<?php echo url('xyft/index',['cate'=>7,'hall'=>1]); ?>">
	    				<img src="__IMG__/game04.png" alt="" />
		    			<p href="javascript:void(0);">
		    			   最火爆彩票投注平台，口碑最好，用户好评率最高的平台
		    		    </p>
	    			</a>
	    		</li>
	    		<li>
	    			<a href="<?php echo url('cqssc/index',['cate'=>3,'hall'=>1]); ?>">
	    				<img src="__IMG__/game05.png" alt="" />
		    			<p href="javascript:void(0);">
		    			   最火爆彩票投注平台，口碑最好，用户好评率最高的平台
		    		    </p>
	    			</a>
	    		</li>
	    		<li>
	    			<a href="<?php echo url('xglhc/index',['cate'=>8,'hall'=>1]); ?>">
	    				<img src="__IMG__/game06.png" alt="" />
		    			<p href="javascript:void(0);">
		    			   最火爆彩票投注平台，口碑最好，用户好评率最高的平台
		    		    </p>
	    			</a>>
	    		</li>
	    		<li>
	    			<a href="<?php echo url('mssc/index',['cate'=>6,'hall'=>1]); ?>">
	    				<img src="__IMG__/game07.png" alt="" />
		    			<p href="javascript:void(0);">
		    			   最火爆彩票投注平台，口碑最好，用户好评率最高的平台
		    		    </p>
	    			</a>
	    		</li>
	    		<li>
	    			<a href="<?php echo url('msssc/index',['cate'=>4,'hall'=>1]); ?>">
	    				<img src="__IMG__/game08.png" alt="" />
		    			<p href="javascript:void(0);">
		    			   最火爆彩票投注平台，口碑最好，用户好评率最高的平台
		    		    </p>
	    			</a>
	    		</li>
	    	</ul>
	        <section class="service clearfix">
				<div class="container">
					<dl>
						<dt>
							<h3>服务优势<span class="smallTitle">SERVICE ADVANTAGES</span></h3>
							<hr class="hr_1">
							<hr class="hr_2">
						</dt>
						<dd>
							<p>存款</p>
							<p class="time">到账平均时间<span class="time_num">23</span><span class="time_unit">秒</span></p>
							<p class="graph"><span class="yellow"></span></p>
						</dd>
						<dd>
							<p>取款</p>
							<p class="time">到账平均时间<span class="time_num">2'02</span><span class="time_unit">分</span></p>
							<p class="graph"><span class="purple"></span></p>
						</dd>
					</dl>
					<dl>
						<dt>
							<h3>移动端下载<span class="smallTitle">MOBILE TERMINAL DOWNLOADS</span></h3>
							<hr class="hr_1">
							<hr class="hr_2">
						</dt>
						<dd class="mobileDP">
							<p>移动互联网时代，机会一手把握</p>
							<p>全面支持苹果APP 安卓APP 手机全部浏览器</p>
						</dd>
						<dd>
							<ul class="iconsList">
								<li><a class="icon_ios" href="javascript:;"></a></li>
								<li><a class="icon_android" href="javascript:;"></a></li>
								<li><a class="icon_ie" href="javascript:;"></a></li>
							</ul>
						</dd>
					</dl>
					<dl>
						<dt>
							<h3>帮助中心<span class="smallTitle">HELP CENTER</span></h3>
							<hr class="hr_1 last">
							<hr class="hr_2">
						</dt>
						<dd>
							<ul class="helpList">
								<li>
									<a href="deposit.jsp"><b></b>存款问题</a>
									<a href="questions.jsp"><b></b>游戏帮助</a>
								</li>
								<li>
									<a href="withdraw.jsp"><b></b>取款问题</a>
									<a href="javascript:;"><b></b>联系客服</a>
								</li>
							</ul>
						</dd>
					</dl>
				</div>
			</section>
	    </div>
	</div>    
    <div class="game-foot">
    	<img src="__IMG__/footer.png" alt="" />
    </div>
	<div class="iziToast-wrapper iziToast-wrapper-bottomRight">
		<div class="iziToast-capsule" style="height: auto;">
			<div class="iziToast bounceInLeft iziToast-color-green iziToast-animateInside">
				<button class="iziToast-close"></button>
				<div class="iziToast-progressbar">
					<div style="width: 93.8143%;"></div>
				</div>
				<div class="iziToast-body" style="padding-left: 33px;">
					<i class="iziToast-icon ico-check revealIn"></i>
					<strong class="slideIn"></strong>
					<p class="slideIn"><?php echo $notice['info']; ?></p>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<script>
	$(".iziToast-close").on('click',function () {
		$(".iziToast-wrapper").hide();
    })
    function KeyDown(){
        if (event.keyCode == 13)  {
            event.returnValue=false;
            event.cancel = true;
            login()
        }
    }
    function refreshVerify() {
        var ts = Date.parse(new Date())/1000;
        $('#verify_img').attr("src", "/captcha?id="+ts);
    }
    function login() {
        var self = $('#form_login'),
            rules = {
                username : {
                    required : true,
                    stringCheck : true
                },
                password : {
                    required : true,
                    rangelength : [6,10],
                    stringCheck : true
                },
                verifyCode : {
                    required : true,
                    rangelength : [4,4]
                }
            },
            messages = {
                username : {
                    required : '请输入登陆账号',
                    stringCheck : '账号不存在'
                },
                password : {
                    required : '请输入密码',
                    rangelength : '密码错误',
                    stringCheck : '密码错误'
                },
                verifyCode : {
                    required : '请输入验证码',
                    rangelength : '验证码不正确'
                }
            };
        if(!check_validate(self,rules,messages).form()){
            return false;
        }
        $.post(self.attr("action"), self.serialize(), success, "json");
        return false;
        function success(data) {
            if (data.code == 1) {
                pop(data.msg,data.url,1);
            } else {
                pop(data.msg);
                refreshVerify();
            }
        }
    }
</script>
<script type="text/javascript">
    $(document).ready(function(){
        /* ----- 侧边悬浮 ---- */
        $(document).on("mouseenter", ".suspension .a", function(){
            var _this = $(this);
            var s = $(".suspension");
            var isService = _this.hasClass("a-service");
            var isServicePhone = _this.hasClass("a-service-phone");
            var isQrcode = _this.hasClass("a-qrcode");
            if(isService){ s.find(".d-service").show().siblings(".d").hide();}
            if(isServicePhone){ s.find(".d-service-phone").show().siblings(".d").hide();}
            if(isQrcode){ s.find(".d-qrcode").show().siblings(".d").hide();}
        });
        $(document).on("mouseleave", ".suspension, .suspension .a-top", function(){
            $(".suspension").find(".d").hide();
        });
        $(document).on("mouseenter", ".suspension .a-top", function(){
            $(".suspension").find(".d").hide();
        });
        $(document).on("click", ".suspension .a-top", function(){
            $("html,body").animate({scrollTop: 0});
        });
        $(window).scroll(function(){
            var st = $(document).scrollTop();
            var $top = $(".suspension .a-top");
            if(st > 400){
                $top.css({display: 'block'});
            }else{
                if ($top.is(":visible")) {
                    $top.hide();
                }
            }
        });

    });
</script>


