<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:61:"/www/wwwroot/smgj/public/../app/wap/view/center/add_bank.html";i:1540951521;}*/ ?>
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
			<div class="bank-info bg_ff">
				<form id="card_form">
					<div class="padding_10 bor_b">
						<label for="">发卡银行</label>
						<select name="bank">
							<option value="农业银行">农业银行</option>
							<option value="建设银行">建设银行</option>
							<option value="工商银行">工商银行</option>
							<option value="招商银行">招商银行</option>
							<option value="交通银行">交通银行</option>
							<option value="民生银行">民生银行</option>
							<option value="兴业银行">兴业银行</option>
							<option value="中国银行">中国银行</option>
							<option value="邮政银行">邮政银行</option>
							<option value="光大银行">光大银行</option>
							<option value="中信银行">中信银行</option>
							<option value="广发银行">广发银行</option>
							<option value="浦发银行">浦发银行</option>
							<option value="华夏银行">华夏银行</option>
							<option value="平安银行">平安银行</option>
							<option value="北京银行">北京银行</option>
							<option value="上海银行">上海银行</option>
							<option value="农商银行">农商银行</option>
						</select>
					</div>
					<div class="padding_10 bor_b">
						<label for="">收款户名</label>
						<input type="text" name="fullName" id="" value="" placeholder="请输入收款户名" />
					</div>
					<div class="padding_10 bor_b">
						<label for="">收款账号</label>
						<input type="number" name="num" id="" value="" placeholder="请输入银行卡号" />
					</div>
					<div class="padding_10 bor_b">
						<label for="">开户网点</label>
						<input type="text" name="bank_branch" id="" value="" placeholder="请输入开户网点" />
					</div>
					<div class="width90 text-center mg_top10">
						<a href="javascript:;" id="card_form_sub" class="big_btn">确定</a>
					</div>
				</form>
			</div>	
		</div>
		<div class="msg-spring"></div>
		<script src="__JS__/wap_new/mui.min.js"></script>
		<script src="__JS__/wap_new/jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="__JS__/wap_new/index.js" type="text/javascript" charset="utf-8"></script>
		<script src="__JS__/layer.js" ></script>
		<script type="text/javascript">
            var subCheck = true;
            $("#card_form_sub").click(function(){
                $('#card_form').serialize();
                var self = $('#card_form');
                if(subCheck) {
                    subCheck = false;
                    $.post("/home/account/addcard.html", self.serialize(), success, "json");
                    return false;
                    function success(data) {
                        if (data.code == 1) {
                            // $("#add_car_box1").show();
                            // $("#card_form").hide();
                            // pop(data.msg,data.url,3);
                            layer.msg(data.msg, {
                                icon: 1,
                                time: 2000 //2秒关闭（如果不配置，默认是3秒）
                            }, function(){
                                window.location.href=data.url;
                            });
                        } else {
                            layer.msg(data.msg);
                            subCheck = true;
                        }
                    }
                }
            })
	    </script>
	</body>

</html>