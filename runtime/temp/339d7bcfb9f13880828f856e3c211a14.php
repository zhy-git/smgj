<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:56:"/www/wwwroot/smgj/public/../app/home/view/login/reg.html";i:1540435901;}*/ ?>
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
        <title>注册</title>
        <link rel="stylesheet" href="__CSS__/common.css">
        <link rel="stylesheet" type="text/css" href="__CSS__/chat-index.css"/>
        <link rel="stylesheet" type="text/css" href="__CSS__/index_sy.css"/>
		<script src="__JS__/jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="__JS__/jquery.validate.min.js"></script>
		<script src="__JS__/layer.js" ></script>
		<script src="__JS__/common.js" ></script>
		<style>
			#verify_img{position: relative;top: -6px;left: 2px;}
			.code{cursor: pointer;}
		</style>
	</head>
	<body>
		<div class="login_top"></div>
		<div class="login_main">
			<div class="form_box">
				<form id="regForm" action="<?php echo url('reg'); ?>">
				<div class="form_main" style="top:18%">
					<div><img src="__IMG__/logo.png" alt="" /><input name="param" type="hidden" value="<?php echo $id; ?>" placeholder="" /></div>
					<p><img src="__IMG__/icon_l01.png" alt="" /><input name="username" type="text" placeholder="请输入登陆账号" /></p>
					<p><img src="__IMG__/icon_l01.png" alt="" /><input name="qq" type="text" placeholder="qq号码，作为身份认证的重要渠道" /></p>
					<p><img src="__IMG__/icon_l02.png" alt="" /><input name="password" type="password" placeholder="请输入登陆密码"/></p>
					<p><img src="__IMG__/icon_l02.png" alt="" /><input name="moneypassword" type="password" placeholder="请输入资金密码"/></p>
					<p class="code_box"><img src="__IMG__/icon_l03.png" alt="" /><input name="verifyCode" type="text" placeholder="请输入验证码"/><i class="code"><img id="verify_img" src="<?php echo captcha_src(); ?>" alt="验证码" onclick="refreshVerify()"></i></p>
					<h4	 class="clearfix padding_lr10"> 
						<a href="<?php echo url('login/index'); ?>" class="left">已有账号，马上登录</a>
					</h4>
					<a href="javascript:void(0)" onclick="reg()" class="login_a">注册</a>
				</div>
				</form>
			</div>
		</div>
		<script>
            function refreshVerify() {
                var ts = Date.parse(new Date())/1000;
                $('#verify_img').attr("src", "/captcha?id="+ts);
            }
            function reg() {
                var self = $('#regForm'),
					rules = {
                        param :{
                            required : true
						},
                        username : {
                            required : true,
                            rangelength : [5,10],
                            stringCheck : true
                        },
						qq :{
                            required : true,
						},
                        password : {
                            required : true,
                            rangelength : [6,12],
                            stringCheck : true
                        },
                        moneypassword : {
                            required : true,
                            rangelength : [6,6],
                            stringCheck : true
                        },
                        verifyCode : {
                            required : true,
                            rangelength : [4,4]
                        }
					},
					messages = {
                        param : {
                            required : '参数错误,请刷新后重试',
						},
                        username : {
                            required : '请输入登陆账号',
                            rangelength : '用户名长度5到10之间',
                            stringCheck : '用户账号只能包含英文、数字、下划线'
						},
						qq :{
                            required : '请输入qq账号',
						},
                        password : {
                            required : '请输入密码',
                            rangelength : '密码长度6到12之间',
                            stringCheck : '密码只能包含英文、数字、下划线'
                        },
                        moneypassword : {
                            required : '请输入资金密码',
                            rangelength : '密码长度6',
                            equalTo : '密码只能包含英文、数字、下划线'
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
	</body>
</html>