<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:70:"E:\phpStudy\PHPTutorial\WWW\smgj\public/../app/wap/view/login\reg.html";i:1524022204;}*/ ?>
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
			background: linear-gradient(#CD4C65,#C4475F,#BA4158,#B53F55);
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
		#verify_img{position: absolute;top: -5px;right: 10px}
        .code{cursor: pointer;}
	</style>

</head>

<body>
<header class="mui-bar mui-bar-nav">
	<h1 class="mui-title">登录</h1>
</header>
<div class="mui-content">
	<img src="__IMG__/wap/reg_bg.png" class="width100" alt="" />
	<div class="reg_login active">
		<form id='regForm' class="mui-input-group">
			<input name="param" type="hidden" value="<?php echo $id; ?>" placeholder="" />
			<div class="mui-input-row">
				<label><img src="__IMG__/wap/icon_phone.png"/></label>
				<input id='account' type="tel" name="username" class="mui-input-clear mui-input" placeholder="请输入手机号">
			</div>

			<div class="mui-input-row">
				<label><img src="__IMG__/wap/icon_psd.png" alt="" /></label>
				<input id='password' name="password" type="password" class="mui-input-clear mui-input" placeholder="请输入密码">
			</div>
			<div class="mui-input-row">
				<label><img src="__IMG__/wap/icon_psd.png" alt="" /></label>
				<input id='password' name="repassword" type="password" class="mui-input-clear mui-input" placeholder="请确认密码">
			</div>
			<div class="mui-input-row code">
				<label><img src="__IMG__/wap/icon_code.png"/></label>
				<input id='code' name="verifyCode" type="text" class="mui-input-clear mui-input" placeholder="请输入验证码">
				<i><img id="verify_img" src="<?php echo captcha_src(); ?>" alt="" onclick="refreshVerify()"/></i>
			</div>
		</form>
		<div class="mui-content-padded">
			<button id='reg' onclick="reg()" class="mui-btn mui-btn-block mui-btn-primary">注册</button>
		</div>
	</div>
</div>
</body>

</html>
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
                password : {
                    required : true,
                    rangelength : [6,12],
                    stringCheck : true
                },
                repassword : {
                    required : true,
                    rangelength : [6,12],
                    equalTo : '#regForm input[name=password]'
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
                password : {
                    required : '请输入密码',
                    rangelength : '密码长度6到12之间',
                    stringCheck : '密码只能包含英文、数字、下划线'
                },
                repassword : {
                    required : '两次密码输入不一致',
                    rangelength : '密码长度6到12之间',
                    equalTo : '两次密码输入不一致'
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
        	console.log(data);
            if (data.code == 1) {
                pop(data.msg,data.url,1);
            } else {
                pop(data.msg);
                refreshVerify();
            }
        }
    }
</script>
