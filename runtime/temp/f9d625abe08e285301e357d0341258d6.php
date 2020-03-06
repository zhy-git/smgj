<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:63:"/www/wwwroot/smgj/public/../app/home/view/account/recharge.html";i:1523368392;s:64:"/www/wwwroot/smgj/public/../app/home/view/common/detail_top.html";i:1539765119;s:62:"/www/wwwroot/smgj/public/../app/home/view/common/cate_top.html";i:1540435336;s:62:"/www/wwwroot/smgj/public/../app/home/view/common/siderbar.html";i:1539588229;s:60:"/www/wwwroot/smgj/public/../app/home/view/common/footer.html";i:1540262035;}*/ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta HTTP-EQUIV="Pragma" CONTENT="no-cache">
	<meta HTTP-EQUIV="Expires" CONTENT="-1">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<link rel="shortcut icon" href="__IMG__/favicon.ico" />
	<link rel="bookmark" href="__IMG__/favicon.ico" type="image/x-icon"　/>
	<title>充值提现</title>
	<link rel="stylesheet" href="__CSS__/index.css">
	<link type="text/css" rel="stylesheet" href="__CSS__/chat-index.css">
	<script src="__JS__/jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="__JS__/jquery.validate.min.js"></script>
	<script src="__JS__/layer.js" ></script>
	<script src="__JS__/common.js" ></script>
	<style>
		.spinner {
			width: 60px;
			height: 30px;
			display: inline-block;
			background: rgba(255, 255, 255, 0.85);
			padding: 10px 50px 0;
		}

		.spinner .three-bounce {
			position: relative;
			text-align: center;
			top: 50%;
			bottom: 50%;
			margin-top: -9px
		}

		.spinner .three-bounce>div {
			display: inline-block;
			width: 18px;
			height: 18px;
			border-radius: 100%;
			top: 50%;
			margin-top: -9px;
			background: #aeadba;
			-webkit-animation: bouncedelay 1.4s infinite ease-in-out;
			animation: bouncedelay 1.4s infinite ease-in-out;
			-webkit-animation-fill-mode: both;
			animation-fill-mode: both
		}

		.spinner .three-bounce .one {
			-webkit-animation-delay: -.32s;
			animation-delay: -.32s;
			background: rgb(55,137,250);
		}

		.spinner .three-bounce .two {
			-webkit-animation-delay: -.16s;
			animation-delay: -.16s;
			background: rgb(99,99,99);
		}

		.spinner .three-bounce .three {
			background: rgb(235,67,70);
		}

		@keyframes bouncedelay {
			0%,100%,80% {
				transform: scale(0);
				-webkit-transform: scale(0)
			}

			40% {
				transform: scale(1);
				-webkit-transform: scale(1)
			}
		}
		.fengpan{color: rgb(170, 152, 152);}
        .bet-modal .u-btn1{
            background: linear-gradient(to bottom,#d87c86 0,#6a1f2d 100%);
            border: 1px solid #ab374a;
            color: #fff;
        }
	</style>
</head>
<body>
<div id="appLoading" class="bet-loading" style="position: fixed; width: 100%; top: 200px; text-align: center; z-index: 3000; display: none;">
	<div class="spinner">
		<div class="three-bounce">
			<div class="one"></div>
			<div class="two"></div>
			<div class="three"></div>
		</div>
	</div>
</div>
<div class="main-body skin_red" style="right: 0px;">
	<div class="header">
	<div class="header-top clearfix">
		<div class="logo2">
			<img src="__IMG__/logo.png" alt="最专业彩票网" height="53">
		</div>
		<?php if(!session('member_info.is_temporary')): if(session('member_info.is_proxy')): ?>
<div class="menu2">
    <span><a href="javascript:void(0)" class="menu2_list1">未结明细</a>&nbsp;&nbsp;|</span>
    <span><a href="javascript:void(0)" class="menu2_list2">今天已结</a>&nbsp;&nbsp;|</span>
    <span><a href="javascript:void(0)" class="menu2_list3">开奖结果</a>&nbsp;&nbsp;|</span>
    <span><a href="javascript:void(0)" class="menu2_list4">历史报表</a></span> <br>
    <span style="display: none;"><a href="javascript:void(0)" class="menu2_list5">个人资讯</a>&nbsp;&nbsp;|</span>
    <span><a href="javascript:void(0)" class="menu2_list6">游戏规则</a>&nbsp;&nbsp;|</span>
    <span><a href="javascript:void(0)" class="menu2_list7">充值提现</a>&nbsp;&nbsp;|</span>
    <span id="skinPanel">
        代理中心
        <ul>
            <li><a href="<?php echo url('Agent/index?type=add'); ?>" class="menu2_list8">新增用户</a></li>
            <li><a href="<?php echo url('Agent/index?type=link'); ?>" class="menu2_list9">推广链接</a></li>
            <li><a href="<?php echo url('Agent/index?type=report'); ?>" class="menu2_list10">盈亏报表</a></li>
            <li><a href="<?php echo url('Agent/index?type=betRecord'); ?>" class="menu2_list11">投注记录</a></li>
            <li><a href="<?php echo url('Agent/index?type=accountRecord'); ?>" class="menu2_list12">账变记录</a></li>
             <li><a href="<?php echo url('Agent/index?type=manageTeam'); ?>" class="menu2_list12">团队管理</a></li>
        </ul>
    </span>
</div>
<?php else: ?>
<div class="menu2">
    <span><a href="javascript:void(0)" class="menu2_list1">未结明细</a>&nbsp;&nbsp;|</span>
    <span><a href="javascript:void(0)" class="menu2_list2">今天已结</a>&nbsp;&nbsp;|</span>
    <span><a href="javascript:void(0)" class="menu2_list3">开奖结果</a>&nbsp;&nbsp;|</span>
    <span><a href="javascript:void(0)" class="menu2_list4">历史报表</a></span> <br>
    <!--<span><a href="javascript:void(0)" class="menu2_list5">个人资讯</a>&nbsp;&nbsp;|</span>-->
    <span><a href="javascript:void(0)" class="menu2_list6">游戏规则</a>&nbsp;&nbsp;|</span>
    <span><a href="javascript:void(0)" class="menu2_list7">充值提现</a>&nbsp;&nbsp;</span>
</div>
<?php endif; else: ?>
<div class="menu2">
    <span><a href="javascript:void(0)" class="menu2_list1">未结明细</a>&nbsp;&nbsp;|</span>
    <span><a href="javascript:void(0)" class="menu2_list2">今天已结</a>&nbsp;&nbsp;|</span>
    <span><a href="javascript:void(0)" class="menu2_list3">开奖结果</a>&nbsp;&nbsp;</span>
    <br>
    <span><a href="javascript:void(0)" class="menu2_list5">个人资讯</a>&nbsp;&nbsp;|</span>
    <span><a href="javascript:void(0)" class="menu2_list6">游戏规则</a>&nbsp;&nbsp;</span>
</div>
<?php endif; ?>
<div class="menu4">
    <!--<a href="https://tb.53kf.com/code/client/10172642/1" target="_blank" class="support"></a>-->
    <a href="http://wpa.qq.com/msgrd?v=3&uin=2271030162&site=qq&menu=yes" target="_blank" class="support"></a>
</div>
<div class="menu3"><a href="<?php echo url('Index/index'); ?>" class="logout">首页</a></div>

	</div>
	<div class="header-middle lotterys">
		<div class="show">
    <a href="<?php echo url('index/index'); ?>"><span>首页</span> <i class="editbtn" style="display: none;"></i></a>
    <a href="<?php echo url('Pcdd/index',['cate'=>1,'hall'=>1]); ?>" <?php if($controllerName == 'pcdd'): ?>class="selected"<?php endif; ?>><span>PC蛋蛋</span> <i class="editbtn" style="display: none;"></i></a>
    <a href="<?php echo url('Jndeb/index',['cate'=>2,'hall'=>1]); ?>" <?php if($controllerName == 'jndeb'): ?>class="selected"<?php endif; ?>><span>加拿大28</span> <i class="editbtn" style="display: none;"></i></a>
    <a href="<?php echo url('Car/index',['cate'=>5,'hall'=>1]); ?>" <?php if($controllerName == 'car'): ?>class="selected"<?php endif; ?>><span>北京赛车(PK10)</span> <i class="editbtn" style="display: none;"></i></a>
    <a href="<?php echo url('Xyft/index',['cate'=>7,'hall'=>1]); ?>" <?php if($controllerName == 'xyft'): ?>class="selected"<?php endif; ?>><span>幸运飞艇</span> <i class="editbtn" style="display: none;"></i></a>
    <a href="<?php echo url('Cqssc/index',['cate'=>3,'hall'=>1]); ?>" <?php if($controllerName == 'cqssc'): ?>class="selected"<?php endif; ?>><span>重庆时时彩</span> <i class="editbtn" style="display: none;"></i></a>
    <a href="<?php echo url('Xglhc/index',['cate'=>8,'hall'=>1]); ?>" <?php if($controllerName == 'xglhc'): ?>class="selected"<?php endif; ?>><span>香港六合彩</span> <i class="editbtn" style="display: none;"></i></a>
    <a href="<?php echo url('Mssc/index',['cate'=>6,'hall'=>1]); ?>" <?php if($controllerName == 'mssc'): ?>class="selected"<?php endif; ?>><span>极速赛车</span> <i class="editbtn" style="display: none;"></i></a>
    <a href="<?php echo url('Msssc/index',['cate'=>4,'hall'=>1]); ?>"  <?php if($controllerName == 'msssc'): ?>class="selected"<?php endif; ?>><span>极速时时彩</span> <i class="editbtn" style="display: none;"></i></a>
</div>
	</div>
	<div class="header-bottom sub">
		<div class="show cate_menu"></div>
	</div>
	</div>
	<div class="main-wrap">
		<div class="siderbar">
    <div class="side_left userctrl">
        <ul>
            <li>
                <div class="r-wrap r-nowrap1">账户信息</div>
                <div class="info">
                    <div><label>账号：</label><span id="userinfo_name"><?php echo $mem['gm_name']; ?></span></div>
                    <div><label>彩票余额：</label><span class="balance" id="memMoney"><?php echo bcadd($mem['money'],0,2); ?></span></div>
                    <!--<div><label>AG余额：</label><span class="balance" id="memAgMoney"><?php echo $mem['ag_money']; ?></span>-->
                        <!--<a href="javascript:void(0)" title="点击刷新消息" id="refreshRealMoneyAg" onclick="refreshRealMoney('AG')">-->
                            <!--<img alt="点击刷新消息" src="__IMG__/refresh.png" width="18" height="18" title="点击刷新消息">-->
                        <!--</a>-->
                    <!--</div>-->
                    <!--<div>-->
                        <!--<label>SS余额：</label><span class="balance" id="memBbMoney"><?php echo $mem['bb_money']; ?></span>-->
                        <!--<a href="javascript:void(0)" title="点击刷新消息" id="refreshRealMoneySs" onclick="refreshRealMoney('SS')">-->
                            <!--<img alt="点击刷新消息" src="__IMG__/refresh.png" width="18" height="18" title="点击刷新消息">-->
                        <!--</a>-->
                    <!--</div>-->
                    <div>
                        <label>未结金额：</label><span class="betting" id="memUnMoney"><?php echo bcadd($mem['unpaid_money'],0,2); ?></span>
                        <a href="javascript:void(0)" title="点击刷新消息" id="refreshMoney" onclick="refreshMoney()">
                            <img alt="点击刷新消息" src="__IMG__/refresh.png" width="18" height="18" title="点击刷新消息">
                        </a>
                    </div>
                </div>
            </li>
            <?php if(!session('member_info.is_temporary')): ?>
            <li class="r-wrap r-nowrap1 link">
                <a href="<?php echo url('Center/index'); ?>" class="r-bg personal_a">个人中心</a>
                <!--<img src="__IMG__/msg_new2.png" class="new" >-->
            </li>
            <?php endif; ?>
            <li class="r-wrap trial-cls" style="display: list-item;">
                <div class="nowrap2" onclick="$('#iframeMain').css({'height':'800'});$('.content').hide();$('#iframeMain').attr('src', '/Home/Account/index')">
                    <a>在线充值</a>
                </div>
                <div class="nowrap2" onclick="$('#iframeMain').css({'height':'800'});$('.content').hide();$('#iframeMain').attr('src', '/Home/Account/index')">
                    <a>在线提款</a>
                </div>
            </li>
             <li class="r-wrap r-nowrap1 link">
                <a>抽奖活动 </a>
                 <img src="__IMG__/msg_new2.png" class="new" >
            </li>
            <li class="r-wrap r-nowrap1 link">
                <a>下载APP</a>
            </li>
            <li style="margin-top: 30px;" class="r-wrap r-nowrap1 link">
                <a>最新注单</a>
            </li>
        </ul>
    </div>
    <div class="sider-col2">
        <div id="lastBets" class="side_left" style="display: block;">
            <ul class="bets">
                <?php if(is_array($newSingleList) || $newSingleList instanceof \think\Collection || $newSingleList instanceof \think\Paginator): $i = 0; $__LIST__ = $newSingleList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nsll): $mod = ($i % 2 );++$i;?>
                <li>
                    <p>期号：<span class="bid"><?php echo $nsll['stage']; ?></span></p>
                    <p> 内容：<span class="text"><?php echo $nsll['title']; ?> <?php echo $nsll['number']; ?></span>@ <span class="odds"><?php echo $nsll['odds']; ?></span></p>
                    <p>金额：￥<?php echo $nsll['money']; ?></p>
                </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>
</div>
<script>
    var refreshMoneyCheck = true;
    function refreshMoney(){
        if(refreshMoneyCheck){
            refreshMoneyCheck = false;
            $.ajax({
                url: "<?php echo url('refresh'); ?>",
                type:'POST',
                dataType: "json",
                beforeSend:function(){ //触发ajax请求开始时执行

                },
                success: function(data){
                    if(data.code == 1){
                        $('#memMoney').html(data.data.money);
                        // $('#memAgMoney').html();
                        // $('#memBbMoney').html();
                        $('#memUnMoney').html(data.data.unpaid_money);
                    } else {
                        pop(data.msg);
                    }
                },
                error: function (textStatus) {
                    //pop('服务器繁忙，请稍后再试');
                },
                complete: function(){
                    setTimeout(function(){
                        refreshMoneyCheck = true;
                    },10000)
                }
            });
        }else{
            return;
        }
    }
    var refreshRealMoneyCheck = true;
    function refreshRealMoney(type){
        if(refreshRealMoneyCheck){
            refreshRealMoneyCheck = false;
            $.ajax({
                url: "<?php echo url('refreshRealMoney'); ?>",
                data: {type: type},
                type:'POST',
                dataType: "json",
                beforeSend:function(){ //触发ajax请求开始时执行

                },
                success: function(data){
                    if(data.code == 1){
                        if(data.date === true){
                            setTimeout(function(){
                                refreshRealMoneyCheck = true;
                                refreshRealMoney(type);
                            },1000)
                        }else{
                            if(type == 'SS'){
                                $('#memBbMoney').html(data.data);
                            }else{
                                $('#memAgMoney').html(data.data);
                            }
                        }
                    } else {
                        pop(data.msg);
                    }
                },
                error: function (textStatus) {
                    //pop('服务器繁忙，请稍后再试');
                },
                complete: function(){
                    setTimeout(function(){
                        refreshRealMoneyCheck = true;
                    },10000)
                }
            });
        }else{
            return;
        }
    }
    var cedanCheck=true;
    function cedan(num,obj) {
        if(cedanCheck){
            $.ajax({
                'url':'/home/bet/cedan',
                'type':'post',
                'dataType':'json',
                'data':{num:num},
                beforeSend:function(){ //触发ajax请求开始时执行
                    cedanCheck = false;
                },
                success:function (data) {
                    if(data.code==1){
                        $(obj).remove();
                    }
                    layer.msg(data.msg);
                },
                error: function (textStatus) {
                    layer.msg('服务器繁忙，请稍后再试');
                },
                complete: function(){
                    setTimeout(function(){
                        cedanCheck = true;
                    },1000);
                }
            });
        }else{
            layer.msg('请勿重复提交');
        }
    }
</script>
		<div class="content-wrap">
			<div class="iframe_table" >
				<iframe id="iframeMain" src="" width="1100"  frameborder="0" scrolling="no" id="test" ></iframe>
			</div>
		</div>
	</div>
    <div id="betModal" style="display: none;">
        <div class="el-dialog el-dialog--small bet-modal">
            <div class="el-dialog__header">
                <span class="el-dialog__title">下注明细 (请确认注单)</span>
                <button type="button" aria-label="Close" class="el-dialog__headerbtn"><i class="el-dialog__close el-icon el-icon-close" onclick="layer.closeAll();"><img src="__IMG__/close.png" alt="" /></i></button>
            </div>
            <div class="el-dialog__body">
                <div>
                    <div style="max-height: 380px; overflow-y: auto;">
                        <table class="u-table10">
                            <thead>
                            <tr>
                                <th style="width: 60%;">号码</th>
                                <th style="width: 15%;">赔率</th>
                                <th style="width: 15%;">金额</th>
                                <th style="width: 10%;">确认</th>
                            </tr>
                            </thead>
                            <tbody id="betModalList"></tbody>
                        </table>
                    </div>
                    <div class="bet-bottom" style="margin-top: 10px;">
                        <span class="bcount">组数：<b class="bcountVal" id="bcountVal"></b></span> <span class="btotal">总金额：
                    <b class="btotalVal" id="btotalVal"><span></span></b></span></div>
                    <div class="cont-col3-hd clearfix">
                        <div class="cont-col3-box2">
                            <a href="javascript:void(0)" class="u-btn1" onclick="lotteryBetController.setOrder();">确定</a>
                            <a href="javascript:void(0)" onclick="layer.closeAll();" class="u-btn1">取消</a>
                        </div>
                        <div class="bet-loading" style="display: none;">
                            <div class="gif"></div>
                            <div class="txt">正在提交</div>
                        </div>
                    </div>
                </div>
            </div><!---->
        </div>
    </div>
    <!--弹框结束-->
	<div class="announce">
    <h3 class="announc3-hd">公告</h3>
    <div class="nl-viewarea announce-list"  id="s1">
        <ul>
            <?php if(empty($notice) || (($notice instanceof \think\Collection || $notice instanceof \think\Paginator ) && $notice->isEmpty())): ?>
            <li class="nl-item"><a href="javascript:void(0)">生米国际郑重提示：彩票有风险，投注需谨慎，未满18周岁的青少年请自觉离开</a></li>
            <?php else: if(is_array($notice) || $notice instanceof \think\Collection || $notice instanceof \think\Paginator): $i = 0; $__LIST__ = $notice;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <li class="nl-item"><a href="javascript:void(0)"><?php echo $vo['info']; ?></a></li>
                <?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </ul>
    </div>
</div> <!---->
<div class="chatbar">
    <div class="guide"><a class="lnk-min"></a></div> <!---->
</div>
</div>
<div class="gameservice"><!----></div>
</div>
<script src="__JS__/tab.js" type="text/javascript" charset="utf-8"></script>
<script>
	$(function(){
	    $('.menu2_list7').click();
	})
</script>
</body>
</html>