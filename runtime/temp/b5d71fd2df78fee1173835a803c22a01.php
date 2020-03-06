<?php if (!defined('THINK_PATH')) exit(); /*a:8:{s:55:"/www/wwwroot/smgj/public/../app/home/view/mssc/two.html";i:1540433646;s:64:"/www/wwwroot/smgj/public/../app/home/view/common/detail_top.html";i:1539765119;s:62:"/www/wwwroot/smgj/public/../app/home/view/common/cate_top.html";i:1540435336;s:62:"/www/wwwroot/smgj/public/../app/home/view/common/siderbar.html";i:1539588229;s:63:"/www/wwwroot/smgj/public/../app/home/view/mssc/integration.html";i:1523368392;s:64:"/www/wwwroot/smgj/public/../app/home/view/mssc/integration2.html";i:1523368392;s:60:"/www/wwwroot/smgj/public/../app/home/view/common/footer.html";i:1540262035;s:54:"/www/wwwroot/smgj/public/../app/home/view/mssc/js.html";i:1540453497;}*/ ?>
<!DOCTYPE html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta HTTP-EQUIV="Pragma" CONTENT="no-cache">
	<meta HTTP-EQUIV="Expires" CONTENT="-1">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<link rel="shortcut icon" href="__IMG__/favicon.ico" />
	<link rel="bookmark" href="__IMG__/favicon.ico" type="image/x-icon"　/>
	<title>秒速赛车</title>
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
<div class="main-body skin_red" style="right: 0px;"><div class="header">
	<div class="header-top clearfix">
		<div class="logo2">
			<img src="__IMG__/logo.png" alt="最专业彩票网" height="53">
		</div>
		<div class="menu1">
			<div class="draw_number">
				<div>秒速赛车</div>
				<div><span class="cur_turn_num"></span>期开奖</div>
			</div>
			<div id="result_balls" class="T_PK10 L_BJPK10" style="top:0;">
				<span><b class="b0">00</b></span>
				<span><b class="b0">00</b></span>
				<span><b class="b0">00</b></span>
				<span><b class="b0">00</b></span>
				<span><b class="b0">00</b></span>
				<span><b class="b0">00</b></span>
				<span><b class="b0">00</b></span>
				<span><b class="b0">00</b></span>
				<span><b class="b0">00</b></span>
				<span><b class="b0">00</b></span>
			</div>
			<div id="result-wrap" class="T_PK10">
				<span class="resultData">小</span>
				<span class="resultData">单</span>
				<span class="resultData">虎</span>
				<span class="resultData">虎</span>
				<span class="resultData">虎</span>
				<span class="resultData">虎</span>
				<span class="resultData">虎</span>
			</div>
			<div title="点击关闭提醒声音" class="open_sound"></div>
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
		<div class="show cate_menu">
			<a href="<?php echo url('index',['cate'=>6,'hall'=>$hall]); ?>" class="">两面盘</a> |
			<a href="<?php echo url('index',['cate'=>6,'hall'=>$hall,'type'=>'two']); ?>" class="router-link-exact-active selected">单号1~10</a> |
			<a href="<?php echo url('index',['cate'=>6,'hall'=>$hall,'type'=>'three']); ?>" class="">冠亚组合</a>
			<?php if($hall==1): ?>
			<a href="<?php echo url('index',['cate'=>6,'hall'=>2]); ?>" style="padding:2px 5px;background: green;border-radius: 5px;color: #fff;">切换B盘</a>
			<?php else: ?>
			<a href="<?php echo url('index',['cate'=>6,'hall'=>1]); ?>" style="padding:2px 5px;background: green;border-radius: 5px;color: #fff;">切换A盘</a>
			<?php endif; ?>
		</div>
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
			<div class="content">
				<div class="sub-wrap clearfix">
					<div class="cont-main active">
						<div class="cont-col3">
							<div class="u-header play_tab_1 clearfix">
								<div class="fl">
									<span id="page_game_name">秒速赛车</span>&nbsp;&nbsp;-&nbsp;&nbsp;
									<span id="page_name">单号1~10</span>
									<!--<span id="total_sum_money_text"> &nbsp;&nbsp; 当前彩种输赢： <span id="total_sum_money">0.000</span> </span>-->
								</div>
								<div class="fr">
                                    <span id="stageStatus" data-status="off" style="display: none;"></span>
                                    <span id="next_turn_num"></span>&nbsp;期 距离封盘：
                                    <span id="bet-date">00:00</span> 距离开奖：
                                    <span id="open-date">00:00</span>
								</div>
							</div>
							<div>
								<div class="cont-col3-hd clearfix">
									<div class="cont-col3-box2">
										<span>金额 </span>
										<input type="number" class="bet-money" oninput="changeVale(this)" onpropertychange="changeVale(this)" maxlength="6" value="" />
										<a href="javascript:void(0)" class="u-btn1 betTab">确定</a>
										<a href="javascript:void(0)" class="u-btn1 betReset">重置</a>
									</div>
								</div>
								<div>
									<div>
										<div class="cont-col3-bd">
                                            <table class="cont-list1 clearfix">
                                                <tbody>
                                                <tr>
                                                    <?php if(is_array($rule_data['qiu']['0']) || $rule_data['qiu']['0'] instanceof \think\Collection || $rule_data['qiu']['0'] instanceof \think\Paginator): $i = 0; $__LIST__ = $rule_data['qiu']['0'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?>
                                                    <td>
                                                        <table class="u-table2">
                                                            <thead>
                                                            <tr>
                                                                <th colspan="3" data-target-type="<?php echo $v1['type']; ?>"><?php echo $v1['type_name']; ?></th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php if(is_array($v1['info']) || $v1['info'] instanceof \think\Collection || $v1['info'] instanceof \think\Paginator): $i = 0; $__LIST__ = $v1['info'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v2): $mod = ($i % 2 );++$i;?>
                                                            <tr>
                                                                <td data-id="<?php echo $v2['id']; ?>" class="name" data-num="<?php echo $v2['rule']; ?>"><span class="ball c-n<?php echo intval($v2['rule']); ?>"></span></td>
                                                                <td data-id="<?php echo $v2['id']; ?>" class="odds"><span class="c-txt3"><?php echo $v2['rate']; ?></span></td>
                                                                <td data-id="<?php echo $v2['id']; ?>" class="amount"><input type="text"  /></td>
                                                            </tr>
                                                            <?php endforeach; endif; else: echo "" ;endif; ?>
                                                            </tbody>
                                                        </table></td>
                                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <table class="cont-list1">
                                                <tbody>
                                                <tr>
                                                    <?php if(is_array($rule_data['qiu']['1']) || $rule_data['qiu']['1'] instanceof \think\Collection || $rule_data['qiu']['1'] instanceof \think\Paginator): $i = 0; $__LIST__ = $rule_data['qiu']['1'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?>
                                                    <td>
                                                        <table class="u-table2">
                                                            <thead>
                                                            <tr>
                                                                <th colspan="3" data-target-type="<?php echo $v1['type']; ?>"><?php echo $v1['type_name']; ?></th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php if(is_array($v1['info']) || $v1['info'] instanceof \think\Collection || $v1['info'] instanceof \think\Paginator): $i = 0; $__LIST__ = $v1['info'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v2): $mod = ($i % 2 );++$i;?>
                                                            <tr>
                                                                <td data-id="<?php echo $v2['id']; ?>" class="name" data-num="<?php echo $v2['rule']; ?>"><span class="ball c-n<?php echo intval($v2['rule']); ?>"></span></td>
                                                                <td data-id="<?php echo $v2['id']; ?>" class="odds"><span class="c-txt3"><?php echo $v2['rate']; ?></span></td>
                                                                <td data-id="<?php echo $v2['id']; ?>" class="amount"><input type="text"  /></td>
                                                            </tr>
                                                            <?php endforeach; endif; else: echo "" ;endif; ?>
                                                            </tbody>
                                                        </table></td>
                                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                                </tr>
                                                </tbody>
                                            </table>
										</div>
									</div>
								</div>
								<div class="cont-col3-hd clearfix" style="margin-top: 15px;">
									<div class="cont-col3-box2">
										<span>金额 </span>
										<input type="number" class="bet-money" oninput="changeVale(this)" onpropertychange="changeVale(this)" maxlength="6" value="" />
										<a href="javascript:void(0)" class="u-btn1 betTab">确定</a>
										<a href="javascript:void(0)" class="u-btn1 betReset">重置</a>
									</div>
								</div>
								<div class="el-dialog__wrapper" style="display: none;">
									<div class="el-dialog el-dialog--small bet-modal" style="top: 15%;">
										<div class="el-dialog__header">
											<span class="el-dialog__title">下注明细 (请确认注单)</span>
											<button type="button" aria-label="Close" class="el-dialog__headerbtn"><i class="el-dialog__close el-icon el-icon-close"></i></button>
										</div>
										<!---->
										<!---->
									</div>
								</div>
							</div>
						</div>
						<div class="count-wrap">
    <table id="stat_qiu" class="u-table2">
        <thead>
        <tr>
            <th class="u-tb3-th2 select">冠军</th>
            <th class="u-tb3-th2">亚军</th>
            <th class="u-tb3-th2">第三名</th>
            <th class="u-tb3-th2">第四名</th>
            <th class="u-tb3-th2">第五名</th>
            <th class="u-tb3-th2">第六名</th>
            <th class="u-tb3-th2">第七名</th>
            <th class="u-tb3-th2">第八名</th>
            <th class="u-tb3-th2">第九名</th>
            <th class="u-tb3-th2">第十名</th>
        </tr>
        </thead>
    </table>
    <table class="u-table4">
        <tbody>
        <tr>
            <td class="f1 fwb">1</td>
            <td class="f1 fwb">2</td>
            <td class="f1 fwb">3</td>
            <td class="f1 fwb">4</td>
            <td class="f1 fwb">5</td>
            <td class="f1 fwb">6</td>
            <td class="f1 fwb">7</td>
            <td class="f1 fwb">8</td>
            <td class="f1 fwb">9</td>
            <td class="f1 fwb">10</td>
        </tr>
        <tr id="specialListOne">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        </tbody>
    </table>
    <table class="u-table2 mt5">
        <thead>
        <tr id="stat_type">
            <th class="u-tb3-th2 select"> 冠军 </th>
            <th class="u-tb3-th2"> 大小 </th>
            <th class="u-tb3-th2"> 单双 </th>
            <th class="u-tb3-th2"> 冠、亚军和 </th>
            <th class="u-tb3-th2"> 冠、亚军和 大小 </th>
            <th class="u-tb3-th2"> 冠、亚军和 单双 </th>
        </tr>
        </thead>
    </table>
    <div>
        <table class="u-table4 table-td-valign-top">
            <tbody>
            <tr class="stattd"  id="specialListTwo">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
					</div>
					<div class="cont-sider">
    <div class="sider-box1 mt5">
        <table class="u-table2"><thead><tr><th id="stat_play_list_desc">长龙排行榜</th></tr></thead></table>
        <table class="u-table5">
            <tbody id="stat_play_list">
            <tr class="u-tb5-tr1">
                <td class="statFont" style="text-align: center;" colspan="2">
                    暂无排行数据
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
				</div>
			</div>
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
    var cate=<?php echo $cate; ?>,hall=<?php echo $hall; ?>;
    var timeCountDown = {
        longPollingCheck : true,
        timeLapse : '',
        getCountDown:function(t,ts){
            var hour = Math.floor(t / 1000 / 60 / 60 % 24); //计算时
            var min = Math.floor(t / 1000 / 60 % 60); //计算分
            var sec = Math.floor(t / 1000 % 60);      //计算秒
            var ts_hour = Math.floor(ts / 1000 / 60 / 60 % 24); //计算时
            var ts_min = Math.floor(ts / 1000 / 60 % 60); //计算分
            var ts_sec = Math.floor(ts / 1000 % 60);      //计算秒
            if (t >= 3600000) {
                banBet('ban');return;
                if (hour < 10) {
                    hour = "0" + hour;
                }
                if (min < 10) {
                    min = "0" + min;
                }
                if (sec < 10) {
                    sec = "0" + sec;
                }
                if (ts_hour < 10) {
                    ts_hour = "0" + ts_hour;
                }
                if (ts_min < 10) {
                    ts_min = "0" + ts_min;
                }
                if (ts_sec < 10) {
                    ts_sec = "0" + ts_sec;
                }
                $('#open-date').html(min + ':' + sec);
                $('#bet-date').html(ts_min + ':' + ts_sec);
            } else if (t >= 0) {
                if (t <= 15000) {    //15s后封盘
                    $('#fd').html('已封单').css('visibility', 'inherit');
                }
                if(t>60000){
                    banBet('ban');return;
                }
                if (hour < 10) {
                    hour = "0" + hour;
                }
                if (min < 10) {
                    min = "0" + min;
                }
                if (sec < 10) {
                    sec = "0" + sec;
                }
                if (ts_hour < 10) {
                    ts_hour = "0" + ts_hour;
                }
                if (ts_min < 10) {
                    ts_min = "0" + ts_min;
                }
                if (ts_sec < 10) {
                    ts_sec = "0" + ts_sec;
                }
                $('#open-date').html(min + ':' + sec);
                $('#bet-date').html(ts_min + ':' + ts_sec);
            } else {
                var s = $('#next_turn_num').html();
                clearInterval(timeCountDown.timeLapse);
                $('#lastBets .bets').html('');
                timeCountDown.getTime();
                timeCountDown.longPolling(s);
            }
        },
        getTime:function (s,n) {
            $.ajax({
                url: "<?php echo url('Mssc/getStage'); ?>",
                type: 'POST',
                dataType: "json",
                timeout: 20000,//20秒超时，可自定义设置
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    if (textStatus == "timeout") { // 请求超时
                        setTimeout(function(){
                            timeCountDown.getTime();
                        },3000); // 递归调用
                    }
                },
                success: function (data, textStatus) {
                    if (data) {
                        if(s,n){
                            var openStage = Number(s);
                            var stage = Number(data.stage_next)-1;
                            if(openStage != stage){
                                timeCountDown.longPolling(stage);
                            }
                            var sum1 = 0;
                            var number = n.split(',');
                            $.each(number,function(k,v){
                                $('#result_balls span:eq('+k+') b').attr('class','b'+ parseInt(v));
                                $('#result_balls span:eq('+k+') b').html(v);
                            })
                            sum1 = parseInt(number[0])+parseInt(number[1]);
                            $("#result-wrap span:eq(0)").html(dxJudgment(12,sum1));
                            $("#result-wrap span:eq(1)").html(dsJudgment(sum1));
                            $("#result-wrap span:eq(2)").html(lhhJudgment(number[0],number[9]));
                            $("#result-wrap span:eq(3)").html(lhhJudgment(number[1],number[8]));
                            $("#result-wrap span:eq(4)").html(lhhJudgment(number[2],number[7]));
                            $("#result-wrap span:eq(5)").html(lhhJudgment(number[3],number[6]));
                            $("#result-wrap span:eq(6)").html(lhhJudgment(number[4],number[5]));
                            $('.cur_turn_num').html(openStage);
                        }
                        $('#next_turn_num').html(data.stage_next);
                        var t = data.dateline * 1000;
                        var ts = (data.dateline - 15) * 1000;
                        if(data.stage_next){
                            banBet();
                            timeCountDown.timeLapse = setInterval(function () {
                                timeCountDown.getCountDown(t,ts);
                                t = t - 1000;
                                if (ts <= 0) {
                                    ts = 0;
                                    banBet('ban');
                                } else {
                                    ts = ts - 1000;
                                }
                            }, 1000);
                        }else{
                            setTimeout(function(){
                                banBet('ban');
                                timeCountDown.getCountDown(-1,-1);
                            },30000);
                        }
                    } else {
                        setTimeout(function(){
                            timeCountDown.getTime();
                        },3000);
                    }
                }
            });
        },
        longPolling:function (stage) {
            if (timeCountDown.longPollingCheck) {
                timeCountDown.longPollingCheck = false;
            } else {
                return;
            }
            $.ajax({
                url: "<?php echo url('Api/checkOpenMssc'); ?>",
                data: {stage: stage},
                type: 'POST',
                dataType: "json",
                timeout: 20000,//20秒超时，可自定义设置
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    setTimeout(function () {
                        timeCountDown.longPollingCheck = true;
                        timeCountDown.longPolling(stage);
                    }, 3000);
                },
                success: function (data, textStatus) {
                    if (data.status == 1) { // 请求成功
                        var sum1 = 0;
                        var number = data.number.split(',');
                        $.each(number,function(k,v){
                            $('#result_balls span:eq('+k+') b').attr('class','b'+ parseInt(v));
                            $('#result_balls span:eq('+k+') b').html(v);
                            // sum1+=parseInt(v);
                        })
                        sum1 = parseInt(number[0])+parseInt(number[1]);
                        $("#result-wrap span:eq(0)").html(dxJudgment(12,sum1));
                        $("#result-wrap span:eq(1)").html(dsJudgment(sum1));
                        $("#result-wrap span:eq(2)").html(lhhJudgment(number[0],number[9]));
                        $("#result-wrap span:eq(3)").html(lhhJudgment(number[1],number[8]));
                        $("#result-wrap span:eq(4)").html(lhhJudgment(number[2],number[7]));
                        $("#result-wrap span:eq(5)").html(lhhJudgment(number[3],number[6]));
                        $("#result-wrap span:eq(6)").html(lhhJudgment(number[4],number[5]));
                        $('.cur_turn_num').html(data.stage);
                        setTimeout(function () {
                            timeCountDown.longPollingCheck = true;
                        }, 3000);
                    } else {
                        setTimeout(function () {
                            timeCountDown.longPollingCheck = true;
                            timeCountDown.longPolling(stage);
                        }, 3000);
                    }
                }
            });
        },
        getWinMessage : function(){
            $.ajax({
                url: "<?php echo url('Api/checkWinMessage'); ?>",
                type: 'POST',
                dataType: "json",
                timeout: 20000,//20秒超时，可自定义设置
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                },
                success: function (data, textStatus) {
                    if (data.status == 1) { // 请求成功
                        var str = '';
                        $.each(data.data,function(k,v){
                            str += v.content+'<br>';
                        });
                        var type = 'rb',
                            text = str;
                        layer.open({
                            title:'<span class="win_message_alert_title">中奖信息</span>'
                            ,type: 1
                            ,offset: type
                            ,area:['308px','auto']
                            ,time:3000
                            ,id: 'layerDemo'+type
                            ,content: '<div class="win_message_alert">'+ text +'</div>'
                            ,btnAlign: 'c'
                            ,shade: 0
                            ,yes: function(){
                                layer.closeAll();
                            }
                        });
                        lotteryBetController.fresh();
                    }
                }
            });
        }
    }
    var lotteryBetController = {
        setOrderCheck : true,
        freshCheck : true,
        betTab : function(){
            if($('#stageStatus').attr('data-status')=='off'){
                pop('该期已封单，不能下单');
                return;
            }
            if(!$('.cont-col3-bd .amount.bg_yellow').length){
                pop('下注内容不正确，请重新下注单');
                return;
            }
            var str = '';
            var totalMoney = 0;
            var totalBet = 0;
            $.each($('.cont-col3-bd .amount.bg_yellow input'),function(){
                var title = $(this).parent().parent().parent().prev().find('tr th').html();
                var titleType =$(this).parent().parent().parent().prev().find('tr th').attr('data-target-type');
                var type = $(this).parent().prev().prev().attr('data-num');
                var unitPrice = $(this).parent().prev().find('span').html();
                var money = $(this).val();
                str += '<tr><td class="multiple" data-target-type="'+titleType+'" data-target-num="'+type+'" style="text-align: left; padding-left: 5px;">'+title+'  '+type+' </td>';
                str += '<td><span class="c-txt3">'+unitPrice+'</span></td>';
                str += '<td><input type="number" oninput="lotteryBetController.betTabChangeVale(this)" onpropertychange="lotteryBetController.betTabChangeVale(this)" class="el-tooltip" value="'+money+'" style="width: 85%;"></td>';
                str += '<td><input type="checkbox" onclick="lotteryBetController.betTabCheck(this)" checked></td></tr>';
                totalMoney = totalMoney*1 + money*1;
                totalBet ++;
            })
            $('#bcountVal').html(totalBet);
            $('#btotalVal').html(totalMoney);
            $('#betModalList').html(str);
            layer.open({
                type: 1,
                title:false,
                closeBtn: 0,
                shadeClose: true,
                resize:false,
                scrollbar:false,
                skin: 'layui-layer-rim', //加上边框
                area: ['500px',$('#betModal').height()], //宽高
                content: $('#betModal').html()
            });
        },
        betTabCheck : function (_this){
            var money = $(_this).parent().prev().find('input').val();
            var btotalVal = $('.layui-layer-content #btotalVal').html();
            var bcountVal = $('.layui-layer-content #bcountVal').html();
            if($(_this).attr('checked')){
                $('.layui-layer-content #bcountVal').html(bcountVal*1 + 1*1);
                $('.layui-layer-content #btotalVal').html(btotalVal*1+money*1);
            }else{
                $('.layui-layer-content #bcountVal').html(bcountVal - 1);
                $('.layui-layer-content #btotalVal').html(btotalVal*1-money*1);
            }
        },
        betTabChangeVale : function(_this){
            var val = $(_this).val();
            if(val.length<=6){
                $(_this).val(val);
            }else{
                $(_this).val(val.slice(0,6));
            }
            var totalNum = 0;
            $.each($(_this).parent().parent().siblings().find('td:eq(2) input'),function(){
                totalNum = totalNum*1 + $(this).val()*1;
            })
            $('.layui-layer-content #btotalVal').html(totalNum*1+val*1);
        },
        betReset : function(){
            $('.cont-col3-bd .amount input').val('');
            $('.cont-col3-bd table tr td').removeClass('bg_yellow');
        },
        setOrder : function (){
            if(!lotteryBetController.setOrderCheck){
                console.log(22);
                return;
            }
            var betData = {};
            var betDataArr = new Array();
            var check = true;
            if($('.layui-layer-content #betModalList tr').length == 0){
                layer.closeAll();
                pop('下注内容不正确，请重新下注');
                return;
            }
            $.each($('.layui-layer-content #betModalList tr'),function(k,v){
                betData = {};
                if($(v).find('td:eq(3) input').attr('checked')){
                    var t = $(v).find('td:eq(0)').attr('data-target-type');
                    var n = $(v).find('td:eq(0)').attr('data-target-num');
                    var o = $(v).find('td:eq(1) span').html();
                    var m = $(v).find('td:eq(2) input').val();
                    if(t && n && o && m){
                        var value = parseInt(m);
                        if(value>0 && value == m){
                            betData['type'] = t;
                            betData['num'] = n;
                            betData['odds'] = o;
                            betData['money'] = m;
                            betDataArr.push(betData);
                        }else{
                            pop('投注金额错误');
                            check = false;
                        }
                    }else{
                        layer.closeAll();
                        pop('数据异常');
                        check = false;
                    }
                }
            })
            if(check){
                $.ajax({
                    url: "<?php echo url('betting'); ?>",
                    data:  {'data':betDataArr,'cate':cate,'hall':hall},
                    type:'POST',
                    dataType: "json",
                    beforeSend:function(){ //触发ajax请求开始时执行
                        lotteryBetController.setOrderCheck = false;
                        $('.layui-layer-content .bet-loading').css('display','block');
                    },
                    success: function(data){
                        if(data.code == 1){
                            layer.closeAll();
                            pop(data.msg);
                            $('.betReset').click();
                            lotteryBetController.showList(data.data,betDataArr);
                            lotteryBetController.fresh();
                        } else {
                            pop(data.msg);
                        }
                    },
                    error: function (textStatus) {
                        pop('服务器繁忙，请稍后再试');
                    },
                    complete: function(){
                        lotteryBetController.setOrderCheck = true;
                    }
                });
            }else{
                return;
            }
        },
        oddsSet : function(){
            var pl = <?php echo json_encode($oddsList); ?>;
            var userPl = <?php echo json_encode($mem); ?>;
            var oddsArr = oddsCalculation(pl,userPl);
            $.each($('.cont-col3-bd .u-table2').find('td[class=odds]'),function(k,v){
                var play_id = $(v).attr('data-id');
                if(play_id) {
                    $(v).find('span').html(oddsArr[cate][play_id]['rate']);
                }
            })
        },
        showList : function(data){
            var str = '';
            $.each(data,function(k,v){
                str += '<li>';
                str += '<p>期号：<span class="bid">'+v.stage+'</span></p>';
                str += '<p> 内容：<span class="text">'+v.typeName+' '+v.number+'</span>@ <span class="odds">'+v.odds+'</span></p>';
                str += '<p>金额：￥'+v.money+'</p>';
                str += '</li>';
            });
            $('#lastBets .bets').prepend(str);
        },
        fresh : function(){
            if(lotteryBetController.freshCheck == false){
                return;
            }
            $.ajax({
                url: "<?php echo url('refresh'); ?>",
                type:'POST',
                dataType: "json",
                beforeSend:function(){ //触发ajax请求开始时执行
                    lotteryBetController.freshCheck = false;
                },
                success: function(data){
                    if(data.code == 1){
                        $('#memMoney').html(data.data.money);
                        $('#memUnMoney').html(data.data.unpaid_money);
                    }
                },
                error: function (textStatus) {
                    setTimeout(function(){
                        lotteryBetController.freshCheck = true;
                        lotteryBetController.fresh();
                    },1000); // 递归调用
                },
                complete: function(){
                    setTimeout(function(){
                        lotteryBetController.freshCheck = true;
                    },3000); // 递归调用
                }
            });
        }
    }
    function banBet(data){
        if(data){
            $('.cont-col3-bd .amount input').attr('readonly',true);
            $('.cont-col3-bd .amount input').addClass('fengpan');
            $('.cont-col3-bd .u-table2 td.odds span').html('--');
            $('.cont-col3-bd .u-table2 td.amount input').val('封盘');
        }else{
            $('#stageStatus').attr('data-status','on');
            $('.cont-col3-bd .amount input').attr('readonly',false);
            $('.cont-col3-bd .amount input').removeClass('fengpan');
            $('.cont-col3-bd .u-table2 td.amount input').val('');
            lotteryBetController.oddsSet();
        }
    }
    $(function () {
        dataIntegrationFun.setDataIntegration();
        $('#stat_qiu .u-tb3-th2').click(function(){
            $('#stat_qiu .u-tb3-th2').removeClass('select');
            $(this).addClass('select');
            $('#stat_type th:eq(0)').html($(this).html());
            $('#stat_type th').removeClass('select');
            $('#stat_type th:eq(0)').addClass('select');
            dataIntegrationFun.getDataIntegration();
        });
        $('#stat_type .u-tb3-th2').click(function(){
            $('#stat_type .u-tb3-th2').removeClass('select');
            $(this).addClass('select');
            dataIntegrationFun.getDataIntegration();
        });
        setTimeout(function () {
            timeCountDown.getTime("<?php echo $openStage; ?>","<?php echo $openNum; ?>");
            //lotteryBetController.oddsSet();
            $('#stat_qiu .u-tb3-th2:eq(0)').click();
            dataIntegrationFun.getCl();
        },1000)
        $('.betTab').click(lotteryBetController.betTab);
        $('.betReset').click(lotteryBetController.betReset);
        setInterval(function(){
            timeCountDown.getWinMessage();
        },10000)
    });
    function changeVale(_this){
        var val = $(_this).val();
        if(val.length<=6){
            $('.bet-money').val(val);
            $('.cont-col3-bd .amount.bg_yellow input').val(val);
        }else{
            $('.bet-money').val(val.slice(0,6));
            $('.cont-col3-bd .amount.bg_yellow input').val(val.slice(0,6));
        }
    }
    function aArrCreate(){
        var arr = [];
        arr[0] = [];
        arr[0] = arrCreate(10,0);
        arr[1] = [];
        arr[2] = [];
        arr[3] = [];
        return arr;
    }
    var dataIntegrationFun = {
        openList : <?php echo json_encode($openList); ?>,
        list : '',
        listTs : '',
        setDataIntegration : function(_this){
        var data = dataIntegrationFun.openList;
        var list = new Array(10);
        for(var i=0;i<10;++i){
            list[i] = aArrCreate();
        }
        var listTs = new Array(3);
        listTs[0] = [];
        listTs[1] = [];
        listTs[2] = [];
        $.each(data,function(k,v){
            var openNumArr = [];
            var dx = '',
                ds = '',
                zh,
                boxNum = 25;
            openNumArr = v['number'].split(',');
            for(var i=0;i<10;++i){
                var sitek = parseInt(openNumArr[i])-1;
                list[i][0][sitek]++;
                if(list[i][1][list[i][1].length-1]){
                    if(list[i][1][list[i][1].length-1].split(',')[0] == openNumArr[i]){
                        list[i][1][list[i][1].length-1] += ','+openNumArr[i];
                    }else{
                        list[i][1].push(openNumArr[i]);
                    }
                }else{
                    list[i][1].push(openNumArr[i]);
                }
                dx = dxJudgment(6,openNumArr[i]);
                if(list[i][2][list[i][2].length-1]){
                    if(list[i][2][list[i][2].length-1].split(',')[0]==dx) {
                        list[i][2][list[i][2].length - 1] += ',' + dx;
                    }else{
                        list[i][2].push(dx);
                    }
                }else{
                    list[i][2].push(dx);
                }
                ds = dsJudgment(openNumArr[i]);
                if(list[i][3][list[i][3].length-1]){
                    if(list[i][3][list[i][3].length-1].split(',')[0]==ds) {
                        list[i][3][list[i][3].length - 1] += ',' + ds;
                    }else{
                        list[i][3].push(ds);
                    }
                }else{
                    list[i][3].push(ds);
                }
            }
            zh = openNumArr[0]*1+openNumArr[1]*1;
            if(listTs[0].length <= boxNum) {
                zh = zh.toString();
                if (listTs[0][listTs[0].length - 1]) {
                    if (listTs[0][listTs[0].length - 1].split(',')[0] == zh) {
                        listTs[0][listTs[0].length - 1] += ',' + zh;
                    } else {
                        listTs[0].push(zh);
                    }
                } else {
                    listTs[0].push(zh);
                }
            }
            if(listTs[1].length <= boxNum) {
                dx = dxJudgment(11,zh);
                if (listTs[1][listTs[1].length - 1]) {
                    if (listTs[1][listTs[1].length - 1].split(',')[0] == dx) {
                        listTs[1][listTs[1].length - 1] += ',' + dx;
                    } else {
                        listTs[1].push(dx);
                    }
                } else {
                    listTs[1].push(dx);
                }
            }
            if(listTs[2].length <= boxNum) {
                ds = dsJudgment(zh);
                if (listTs[2][listTs[2].length - 1]) {
                    if (listTs[2][listTs[2].length - 1].split(',')[0] == ds) {
                        listTs[2][listTs[2].length - 1] += ',' + ds;
                    } else {
                        listTs[2].push(ds);
                    }
                } else {
                    listTs[2].push(ds);
                }
            }
        });
        dataIntegrationFun.list = list;
        dataIntegrationFun.listTs = listTs;
        console.log(list);
        console.log(listTs);
    },
        getDataIntegration : function(_this){
            var a = $('#stat_qiu th.select').index(_this);
            var b = $('#stat_type th.select').index(_this);
            var boxNum = 25;
            var str;
            $.each(dataIntegrationFun.list[a][0],function(k,v){
                $('#specialListOne td:eq('+k+')').html(v);
            });
            if(b<3){
                boxNum --;
                $.each(dataIntegrationFun.list[a][b*1+1],function(k,v){
                    str = '';
                    var vArr = v.split(',');
                    if(vArr.length>1){
                        $.each(vArr,function(k2,v2){
                            str += v2+'<br>';
                        })
                        $('#specialListTwo td:eq('+(boxNum - k)+')').html(str);
                    }else{
                        $('#specialListTwo td:eq('+(boxNum - k)+')').html(v);
                    }
                });
            }else{
                boxNum --;
                $.each(dataIntegrationFun.listTs[b-3],function(k,v){
                    str = '';
                    var vArr = v.split(',');
                    if(vArr.length>1){
                        $.each(vArr,function(k2,v2){
                            str += v2+'<br>';
                        })
                        $('#specialListTwo td:eq('+(boxNum - k)+')').html(str);
                    }else{
                        $('#specialListTwo td:eq('+(boxNum - k)+')').html(v);
                    }
                });
            }
        },
        getCl : function(){
            var list = dataIntegrationFun.list;
            var listName = ['冠军','亚军','第三名','第四名','第五名','第六名','第七名','第八名','第九名','第十名'];
            var listTs = dataIntegrationFun.listTs;
            var listTsName = ['冠、亚和','冠、亚和大小','冠、亚和单双'];
            var listData = [];
            $.each(list,function(k,v){
                for (var i=1;i<4;i++){
                    var arr = v[i][0].split(',');
                    if(arr.length>2){
                        listData.push(listName[k]+'-'+arr[0]+','+arr.length+'期');
                    }
                }
            })
            $.each(listTs,function(k,v){
                var arr = v[0].split(',');
                if(arr.length>2){
                    listData.push(listTsName[k]+'-'+arr[0]+','+arr.length+'期');
                }
            })
            if(listData.length){
                var str = '';
                $.each(listData,function(k,v){
                    var dataContent = v.split(',');
                    str += '<tr class="u-tb5-tr1"><th>'+dataContent[0]+'</th> <td class="statFont">'+dataContent[1]+'</td></tr>';
                })
                $('#stat_play_list').html(str);
            }
        }
    }
    function sum(arr) {
        return eval(arr.join("+"));
    };
</script>
</body>
</html>