<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:57:"/www/wwwroot/smgj/public/../app/wap/view/login/index.html";i:1541493471;}*/ ?>
<!DOCTYPE html>
<html class="ui-page-login">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<title>登录-注册</title>
	<link href="__CSS__/wap/mui.min.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="__CSS__/wap/common.css"/>
	<link href="__CSS__/wap/index.css" rel="stylesheet" />
    <script src="__JS__/wap/mui.min.js"></script>
    <script src="__JS__/wap/jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="__JS__/jquery.validate.min.js"></script>
    <script src="__JS__/layer.js" ></script>
    <script src="__JS__/common.js" ></script>
	<style>
		.mui-content{background: #fff;}
		.login_box li{width: 30%;float: left;text-align: center;padding: 10px 0;margin:0 10% ;}
		.area {
			margin: 20px auto 0px auto;
		}
		.mui-input-group {
			margin-top: 10px;
		}
		.mui-input-group:first-child {
			margin-top: 20px;
		}
		.mui-input-group label {
			width: 22%;
			text-align: center;.=
		}
		.mui-input-row label~input,
		.mui-input-row label~select,
		.mui-input-row label~textarea {
			width: 78%;
		}
		.mui-checkbox input[type=checkbox],
		.mui-radio input[type=radio] {
			top: 6px;
		}
		.mui-content-padded {
			margin-top: 25px;
		}
		.mui-btn {
			padding: 7px;
			background: linear-gradient(#5696c4,#5696c4,#5696c4,#5696c4);
			border-radius: 15px;
			border: none;
			font-size: 16px;
		}
		.link-area {
			display: block;
			margin-top: 25px;
			text-align: center;
		}
		.mui-input-group label img{
			width: 26%;
			margin: 0 auto;
		}
		.login_box li.active{
			border-bottom: 2px solid #CF4C66;
		}
		.reg_login{
			display: none;
		}
		.reg_login.active{
			display: block;
		}
		.mui-input-row.code label~input{
			width: 50%;
			float: left;
		}
		.mui-input-row.code i img{
			margin-top: 10px;
		}
        #verify_img{position:absolute;top: -5px;right: 10px;}
        .code{cursor: pointer;}
	</style>

</head>

<body>
<header class="mui-bar mui-bar-nav">
	<h1 class="mui-title">登录</h1>
</header>
<div class="mui-content">
	<img src="__IMG__/wap_new/login_img.png" class="width100" alt="" />
	<!--<ul class="mui-clearfix login_box">-->
		<!--<li class="active"><a href="javascript:void(0);">登录</a></li>-->
		<!--<li><a href="javascript:void(0);">注册</a></li>-->
	<!--</ul>-->
	<div class="reg_login active">
		<form id='login-form' class="mui-input-group">
			<div class="mui-input-row">
				<label><img src="__IMG__/wap/icon_phone.png"/></label>
				<input id='account' name="username" type="text" class="mui-input-clear mui-input" placeholder="请输入账号">
			</div>
			<div class="mui-input-row">
				<label><img src="__IMG__/wap/icon_psd.png" alt="" /></label>
				<input id='password' name="password" type="password" class="mui-input-clear mui-input" placeholder="请输入密码">
			</div>
			<div class="mui-input-row code">
				<label><img src="__IMG__/wap/icon_code.png"></label>
				<input id="code" name="verifyCode" type="text" class="mui-input-clear mui-input" placeholder="请输入验证码" data-input-clear="7"><span class="mui-icon mui-icon-clear mui-hidden"></span>
				<i><img id="verify_img" src="<?php echo captcha_src(); ?>" alt="验证码" onclick="refreshVerify()"></i>
			</div>
		</form>
		<div class="mui-content-padded">
			<button id='login' onclick="login();" class="mui-btn mui-btn-block mui-btn-primary">登录</button>
			<!--<div class="link-area"> <a id='forgetPassword' href="forget_password.html">忘记密码</a></div>-->
		</div>
		<div class="clearfix padding_tb10 width90" style="padding: 10px 15px;display: none;">
			<a href="<?php echo url('reg'); ?>" class="right red">立即注册</a>
		</div>
	</div>
</div>
<script>
    function refreshVerify() {
        var ts = Date.parse(new Date())/1000;
        $('#verify_img').attr("src", "/captcha?id="+ts);
    }
    var loginCheck = true;
    function login() {
        var self = $('#login-form'),
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
        if(!loginCheck){
            return;
        }
        loginCheck = false;
        $.post(self.attr("action"), self.serialize(), success, "json");
        return false;
        function success(data) {
            if (data.code == 1) {
                pop(data.msg,data.url,1);
            } else {
                pop(data.msg);
                refreshVerify();
                loginCheck = true;
            }
        }
    }
    var freeTryCheck = true;
    function freeTry(){
        if(!freeTryCheck){
            return;
        }
        freeTryCheck = false;
        $.post("<?php echo url('freeTry'); ?>", {}, success, "json");
        return false;
        function success(data) {
            if (data.code == 1) {
                pop('登陆成功',data.url,1);
            } else {
                pop(data.msg);
                freeTryCheck = true;
            }
        }
    }
</script>
</body>
</html>
