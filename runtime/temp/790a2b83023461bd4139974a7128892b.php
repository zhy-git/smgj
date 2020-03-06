<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:67:"/www/wwwroot/smgj/public/../app/wap/view/center/login_password.html";i:1536919080;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>登录密码</title>
	<link rel="icon" href="__IMG__/wap_new/favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="__IMG__/wap_new/favicon.ico" type="image/x-icon" />
	<link href="__CSS__/wap_new/mui.min.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="__CSS__/wap_new/common.css"/>
	<link rel="stylesheet" type="text/css" href="__CSS__/wap_new/index.css"/>
    <script src="__JS__/wap_new/mui.min.js"></script>
    <script type="text/javascript" charset="utf-8">
      	mui.init();
    </script>
	<script src="__JS__/wap_new/jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="__JS__/wap_new/index.js" type="text/javascript" charset="utf-8"></script>
	<script src="__JS__/jquery.validate.min.js"></script>
	<script src="__JS__/layer.js" ></script>
	<script src="__JS__/common.js" ></script>
    <style type="text/css">
    	#login-form label{
    		width: 100px;
    	}
    	#login-form input{
    		width: 60%;
    	}
    </style>
</head>
<body class="bg_ff">
	<header class="mui-bar mui-bar-nav">
	    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
	    <h1 class="mui-title">登录密码</h1>
	</header>
	<div class="mui-content bg_ff">
	    <form id='resetLoginPass' class="mui-input-group mg_top20 width90">
			<div class="mui-input-row">
				<label>旧密码</label>
				<input type="password" name="oldpassword" class="mui-input-clear mui-input" placeholder="请输入旧密码">
			</div>
			<div class="mui-input-row">
				<label>新密码</label>
				<input type="password" name="password"  class="mui-input-clear mui-input" placeholder="请输入新密码">
			</div>
			<div class="mui-input-row">
				<label>确认新密码</label>
				<input type="password" name="repassword" class="mui-input-clear mui-input" placeholder="请确认新密码">
			</div>
			<p class="mg_top40"><a class="big_btn" href="javascript:void(0);" id="subLogin" >确定</a></p>
			
		</form>
	</div>
	<div class="msg-spring"></div>
	<script type="text/javascript">
        var subLoginCheck = true;
        $("#subLogin").click(function(){
            $('#resetLoginPass').serialize();
            var self = $('#resetLoginPass'),
                rules = {
                    oldpassword : {
                        required : true,
                        rangelength : [6,12],
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
                        equalTo : '#resetLoginPass input[name=password]'
                    }
                },
                messages = {
                    oldpassword : {
                        required : '请输入原始密码',
                        rangelength : '密码长度6到12之间',
                        stringCheck : '密码只能包含英文、数字、下划线'
                    },
                    password : {
                        required : '请输入密码',
                        rangelength : '密码长度6到12之间',
                        stringCheck : '密码只能包含英文、数字、下划线'
                    },
                    repassword : {
                        required : '两次密码输入不一致',
                        rangelength : '两次密码输入不一致',
                        equalTo : '两次密码输入不一致'
                    }
                };
            if(!check_validate(self,rules,messages).form()){
                return false;
            }
            if(subLoginCheck) {
                subLoginCheck = false;
                $.post("<?php echo url('subLoginReset'); ?>", self.serialize(), success, "json");
                return false;
                function success(data) {
                    if (data.code == 1) {
                        pop(data.msg);
                        self[0].reset();
                    } else {
                        pop(data.msg);
                    }
                    setTimeout(function(){
                        subLoginCheck = true;
                    },1000);
                }
            }
        })
	</script>
</body>
</html>