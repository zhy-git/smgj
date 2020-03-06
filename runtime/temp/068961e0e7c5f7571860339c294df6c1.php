<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:60:"/www/wwwroot/smgj/public/../app/wap/view/account/add_sm.html";i:1539070284;}*/ ?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>支付宝账号</title>
		<link rel="icon" href="__IMG__/favicon.ico" type="image/x-icon">
        <link rel="shortcut icon" href="__IMG__/favicon.ico" type="image/x-icon"/>
		<link href="__CSS__/wap_new/mui.min.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="__CSS__/wap_new/common.css"/>
		<link rel="stylesheet" type="text/css" href="__CSS__/wap_new/index.css"/>
	</head>
	<body >
		<header class="mui-bar mui-bar-nav">
		    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
		    <h1 class="mui-title">支付宝账号</h1>
		</header>
		<div class="mui-content">
			<div class="bank-info bg_ff">
				<div class="padding_10 ">
					<label for="name">昵称</label>
					<input type="text" name="name" id="name" value="" placeholder="请输入支付昵称" />
				</div>
				<div class="padding_10 ">
					<label for="num">支付宝账户</label>
					<input type="text" name="num" id="num" value="" placeholder="请输入支付宝账号" />
				</div>
			</div>	
			<p class="mg_top40 padding_lr30"><a href="javascript:void(0);" class="big_btn" onclick="addCard()">确认</a></p>
		</div>
		<div class="msg-spring"></div>
		<script src="__JS__/wap_new/mui.min.js"></script>
		<script src="__JS__/wap_new/jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="__JS__/wap_new/index.js" type="text/javascript" charset="utf-8"></script>
		<script src="__JS__/layer.js" ></script>
		<script>
			var addCheck=true;
			function addCard() {
				var name = $("input[name=name]").val();
				var num = $("input[name=num]").val();
				if(!addCheck){
				    layer.msg('请勿重复提交');return false;
				}
				$.ajax({
					url:"<?php echo url('addsm'); ?>",
					data:{name:name,num:num},
					type:"post",
					dataType:'json',
                    beforeSend:function(){ //触发ajax请求开始时执行
                        addCheck=false;
                    },
					success:function (data) {
					    if(data.code==1){
                            layer.msg(data.msg, {
                                icon: 1,
                                time: 1500 //2秒关闭（如果不配置，默认是3秒）
                            }, function(){
                                window.location.href=data.url;
                            });
						}else{
					        layer.msg(data.msg);
						}
                    },error: function (textStatus) {
                        setTimeout(function(){
                            addCheck=true;
                        },1000); // 递归调用
                    },
                    complete: function(){
                        setTimeout(function(){
                            addCheck=true;
                        },1000); // 递归调用
                    }
				});
            }
		</script>
	</body>

</html>