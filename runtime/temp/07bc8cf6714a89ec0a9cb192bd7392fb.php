<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:58:"/www/wwwroot/smgj/public/../app/wap/view/center/index.html";i:1540950069;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>个人中心</title>
		<link rel="icon" href="__IMG__/wap_new/favicon.ico" type="image/x-icon">
		<link rel="shortcut icon" href="__IMG__/wap_new/favicon.ico" type="image/x-icon" />
		<link href="__CSS__/wap_new/mui.min.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="__CSS__/wap_new/common.css"/>
		<link rel="stylesheet" type="text/css" href="__CSS__/wap_new/index.css"/>
	</head>
	<body id="bg_body">
		<header class="mui-bar mui-bar-nav">
		    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
		    <h1 class="mui-title">个人中心</h1>
		</header>
		<nav class="mui-bar mui-bar-tab">
		    <a class="mui-tab-item1" href="<?php echo url('Index/index'); ?>">
		        <span class="mui-icon "><img src="__IMG__/wap_new/icon-01.png" alt="" /></span>
		        <span class="mui-tab-label">首页</span>
		    </a>
		    <a class="mui-tab-item1" href="<?php echo url('Index/game'); ?>">
		        <span class="mui-icon "><img src="__IMG__/wap_new/icon-02.png" alt="" /></span>
		        <span class="mui-tab-label">游戏大厅</span>
		    </a>
		    <a class="mui-tab-item1" href="<?php echo url('Account/index'); ?>">
		        <span class="mui-icon "><img src="__IMG__/wap_new/icon-03.png" alt="" /></span>
		        <span class="mui-tab-label">资金管理</span>
		    </a>
		    <a class="mui-tab-item1 mui-active" href="<?php echo url('Center/index'); ?>">
		        <span class="mui-icon "><img src="__IMG__/wap_new/icon-04yellow.png" alt="" /></span>
		        <span class="mui-tab-label">我的</span>
		    </a>
		</nav>
		<div class="mui-content" style="background: transparent;">
			<div class="money-top">
				<dl class="clearfix">
					<dt class="left"><img class="head" src="<?php echo $memInfo['head']?$memInfo['head']:'__IMG__/wap_new/head.png'; ?>" alt="" /></dt>
					<dd class="left padding_lr10">
						<p class="color_ff mg_top10"><?php echo $memInfo['name']; ?></p>
						<p class="color_ff mg_top10">账户余额：￥<span id="memMoney"><?php echo bcadd($memInfo['money'],0,2); ?></span><img src="/static/home/img/refresh.png" onclick="refreshMoney()" style="width: 15px;margin-left: 10px;" alt=""></p>
					</dd>
				</dl>
			</div>
			<div class="my-list">
				<ul class="clearfix">
					<li><a href="<?php echo url('main'); ?>"><img src="__IMG__/wap_new/my01.png" alt="" /><p class="">个人资料</p></a></li>
					<li><a href="<?php echo url('subLoginReset'); ?>"><img src="__IMG__/wap_new/my02.png" alt="" /><p class="">登录密码</p></a></li>
					<li><a href="<?php echo url('info'); ?>"><img src="__IMG__/wap_new/my03.png" alt="" /><p class="">信息中心</p></a></li>
					<li><a href="<?php echo url('account/index'); ?>"><img src="__IMG__/wap_new/my04.png" alt="" /><p class="">资金管理</p></a></li>
					<li><a href="<?php echo url('subMoneyReset'); ?>"><img src="__IMG__/wap_new/my05.png" alt="" /><p class="">取款密码</p></a></li>
					<li><a href="<?php echo url('bank'); ?>"><img src="__IMG__/wap_new/my06.png" alt="" /><p class="">银行账户</p></a></li>
					<li><a href="<?php echo url('report/noterecord'); ?>"><img src="__IMG__/wap_new/my07.png" alt="" /><p class="">下注记录</p></a></li>
					<?php if(session('member_info.is_proxy')): ?>
					<li><a href="<?php echo url('agent'); ?>"><img src="__IMG__/wap_new/my08.png" alt="" /><p class="">代理中心</p></a></li>
					<?php endif; ?>
					<li><a target="_blank" href="<?php echo $url; ?>"><img src="__IMG__/wap_new/my09.png" alt="" /><p class="">客服</p></a></li>
					<li><a href="<?php echo url('back_record'); ?>"><img src="__IMG__/wap_new/my10.png" alt="" /><p class="">返水记录</p></a></li>
				</ul>
			</div>
		</div>
		<div class="msg-spring"></div>
		<script src="__JS__/wap_new/mui.min.js"></script>
		<script src="__JS__/wap_new/jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="__JS__/wap_new/index.js" type="text/javascript" charset="utf-8"></script>
		<script src="__JS__/layer.js" ></script>
		<script type="text/javascript">
            var refreshMoneyCheck = true;
            function refreshMoney(){
                if(refreshMoneyCheck){
                    $.ajax({
                        url: "/home/pcdd/refresh.html",
                        type:'POST',
                        dataType: "json",
                        beforeSend:function(){ //触发ajax请求开始时执行
                            refreshMoneyCheck = false;
                            index = layer.load(0, {shade: false});
                        },
                        success: function(data){
                            if(data.code == 1){
                                $('#memMoney').html(data.data.money);
                                // $('#memAgMoney').html();
                                // $('#memBbMoney').html();
                            } else {
                                layer.msg(data.msg);
                            }
                        },
                        error: function (textStatus) {
                            //pop('服务器繁忙，请稍后再试');
                        },
                        complete: function(){
                            layer.close(index);
                            setTimeout(function(){
                                refreshMoneyCheck = true;
                            },10000)
                        }
                    });
                }else{
                    layer.msg('刷新间隔为10秒');
                    return;
                }
            }
	    </script>
	</body>
</html>