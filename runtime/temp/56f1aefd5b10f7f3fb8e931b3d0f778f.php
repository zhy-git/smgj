<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:57:"/www/wwwroot/smgj/public/../app/wap/view/jndeb/index.html";i:1540625069;s:61:"/www/wwwroot/smgj/public/../app/wap/view/common/bet_list.html";i:1523368392;s:57:"/www/wwwroot/smgj/public/../app/wap/view/common/menu.html";i:1523368392;s:54:"/www/wwwroot/smgj/public/../app/wap/view/jndeb/js.html";i:1540793119;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<title>加拿大28</title>
	<script src="__JS__/wap/mui.min.js"></script>
	<link href="__CSS__/wap/mui.min.css" rel="stylesheet"/>
	<link rel="stylesheet" type="text/css" href="__CSS__/wap/common.css"/>
	<link rel="stylesheet" type="text/css" href="__CSS__/wap/index.css"/>
	<script src="__JS__/wap/jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="__JS__/wap/time.js" type="text/javascript" charset="utf-8"></script>
	<script src="__JS__/wap/index.js" type="text/javascript" charset="utf-8"></script>
	<script src="__JS__/jquery.validate.min.js"></script>
	<script src="__JS__/layer.js" ></script>
	<script src="__JS__/common.js" ></script>
	<script type="text/javascript" charset="utf-8">
        mui.init();
	</script>
</head>
<body style="background: #f1f1f1;">
<div class="mui-inner-wrap mui-transitioning main">
	<header class="mui-bar mui-bar-nav mui-clearfix">
		<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
		<h1 class="mui-title mui-pull-left">
			<span class="left">加拿大28 </span>
		</h1>
		<div class="mui-pull-right list_a">
            <a href="javascript:void(0);"class="mg_top10 ">
				<span class="mui-h5 color_ff padding_lr5" id="memMoney"><?php echo bcadd($mem['money'],0,2); ?></span>
                <!--<img  class="vertical-align_m book" src="__IMG__/wap/book.png" alt="" />-->
				<img  class="vertical-align_m book" src="__IMG__/wap/icon-list.png" alt=""/>
            </a>
            <!--<ul class="list_ul" style="z-index: 50">-->
                <!--<li><a href="<?php echo url('Report/unsettled'); ?>">即时注单 <p class="red" id="memUnMoney">(<?php echo $mem['unpaid_money']; ?>)</p></a></li>-->
                <!--<li><a href="<?php echo url('Report/settled'); ?>">今日已结 </a></li>-->
                <!--<li><a href="<?php echo url('Report/noteRecord'); ?>">下注记录</a></li>-->
                <!--<li><a href="<?php echo url('Report/openResult',array('cate_id'=>6)); ?>"> 开奖结果</a></li>-->
                <!--<li class="rule"><a href="javascript:void(0);"> 游戏规则</a></li>-->
                <!--&lt;!&ndash;<li><a href="javascript:void(0);">今天输赢 <p id="thisWin" class="red">(0.00)</p></a></li>&ndash;&gt;-->
            <!--</ul>-->
        </div>
		<div class="index-nav">
			<div class="top-nav">
				<a href="<?php echo url('Report/unsettled'); ?>"><img class="vertical-align_m icon-small1" src="__IMG__/wap/icon_ball01.png" alt="" />即时注单<p class="red" id="memUnMoney" style="text-align: center;">(<?php echo bcadd($mem['unpaid_money'],0,2); ?>)</p></a>
				<a href="<?php echo url('Report/settled'); ?>"><img class="vertical-align_m icon-small1" src="__IMG__/wap/icon_bal02.png" alt="" /> 今日已结</a>
				<a href="<?php echo url('Report/noteRecord'); ?>"><img class="vertical-align_m icon-small1" src="__IMG__/wap/icon_bal03.png" alt="" /> 下注记录</a>
				<a href="<?php echo url('Report/openResult',['cate'=>$cate]); ?>"><img class="vertical-align_m icon-small1" src="__IMG__/wap/icon_bal04.png" alt="" /> 开奖结果</a>
				<a href="<?php echo url('Index/hall_cl',['cate'=>$cate]); ?>"><img class="vertical-align_m icon-small1" src="__IMG__/wap/icon_bal05.png" alt="" /> 两面长龙</a>
				<a href="<?php echo url('report/rule',['cate'=>$cate]); ?>"><img class="vertical-align_m icon-small1" src="__IMG__/wap/icon_bal06.png" alt="" /> 游戏规则</a>
				<a href="<?php echo url('account/index'); ?>"><img class="vertical-align_m icon-small1" src="__IMG__/wap/icon_bal07.png" alt="" /> 充值</a>
				<a href="<?php echo url('account/index'); ?>"><img class="vertical-align_m icon-small1" src="__IMG__/wap/icon_bal08.png" alt="" /> 提现</a>
			</div>
			<p class="icon-triangle"></p>
		</div>
	</header>
	<div class="mui-content">
		<ul class="mui-clearfix game_box1">
			<li class="active"><a href="javascript:void(0);">投注区</a></li>
			<li><a href="javascript:void(0);">聊天室</a></li>
		</ul>
		<div class="game_box2 padding_tb10 bor_bd7">
			<div class="clearfix ">
				<p class="left game_B2L cur_turn_num">2336597期</p>
				<div id="result_balls"  class="left game_B2R">
					<p>
						<i class="round1">0</i>+
						<i class="round1">0</i>+
						<i class="round1">0</i>
						<span>=</span>
						<i class="round1">0</i>
					</p>
					<p class="mg_top5">
						<i class="squal1">大</i>
						<i class="squal1">双</i>
					</p>
				</div>
			</div>
		</div>
		<div class="game_box2 padding_tb10 bor_bd7">
			<div class="clearfix ">
				<p class="left game_B2L" id="next_turn_num">2336597期</p>
				<div class="left game_B2R">
					<div class="clearfix left">
						<span class="left lin_30">封盘：</span>
						<div class="colockbox clearfix left" id="bet-date">
							<span class="minute"></span><span>&nbsp;:</span>
							<span class="second"></span>
						</div>
						</span>
					</div>
					<div class="clearfix left">
						<span class="left lin_30 mg_left10">开奖：</span>
						<div class="colockbox clearfix left" id="open-date">
							<span class="minute"></span><span>&nbsp;:</span>
							<span class="second"></span>
						</div>
						</span>
					</div>
				</div>
			</div>
		</div>
		<div class="game_box3 mui-clearfix">
			<ul class="left game_B3L">
				<li class="active"><a href="javascript:void(0);"><i class="round_small"></i> 混合</a></li>
				<li><a href="javascript:void(0);"><i class="round_small"></i>猜数字</a></li>
				<li><a href="javascript:void(0);"><i class="round_small"></i>特殊玩法</a></li>
			</ul>
			<div class="game_tab left">
				<div class="tab_box active">
					<h4 class="mui-text-center padding_10 bor_bd7">混合</h4>
					<ul class="mui-clearfix two" data-target-type="1" data-target-num="混合">
						<?php if(is_array($rule_data['hh']) || $rule_data['hh'] instanceof \think\Collection || $rule_data['hh'] instanceof \think\Paginator): $i = 0; $__LIST__ = $rule_data['hh'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if(is_array($vo) || $vo instanceof \think\Collection || $vo instanceof \think\Paginator): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?>
						<li data-num="<?php echo $v1['rule']; ?>"><a href="javascript:void(0);"><?php echo $v1['rule']; ?><i data-id="<?php echo $v1['id']; ?>" class="odds"><?php echo $v1['rate']; ?></i></a></li>
						<?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
				<div class="tab_box">
					<h4 class="mui-text-center padding_10 bor_bd7">猜数字</h4>
					<ul class="mui-clearfix two" data-target-type="2" data-target-num="猜数字">
						<?php if(is_array($rule_data['tm']) || $rule_data['tm'] instanceof \think\Collection || $rule_data['tm'] instanceof \think\Paginator): $i = 0; $__LIST__ = $rule_data['tm'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if(is_array($vo) || $vo instanceof \think\Collection || $vo instanceof \think\Paginator): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?>
						<li data-num="<?php echo $v1['rule']; ?>"><a href="javascript:void(0);"><span class="round1" style="color: orangered;"><?php echo $v1['rule']; ?></span><i data-id="<?php echo $v1['id']; ?>" class="odds"><?php echo $v1['rate']; ?></i></a></li>
						<?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
				<div class="tab_box">
					<h4 class="mui-text-center padding_10 bor_bd7">特殊玩法</h4>
					<ul class="mui-clearfix three" data-target-type="3" data-target-num="特殊玩法">
						<?php if(is_array($rule_data['ts']) || $rule_data['ts'] instanceof \think\Collection || $rule_data['ts'] instanceof \think\Paginator): $i = 0; $__LIST__ = $rule_data['ts'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if(is_array($vo) || $vo instanceof \think\Collection || $vo instanceof \think\Paginator): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?>
						<li data-num="<?php echo $v1['rule']; ?>"><a href="javascript:void(0);"><?php echo $v1['rule']; ?><i data-id="<?php echo $v1['id']; ?>" class="odds"><?php echo $v1['rate']; ?></i></a></li>
						<?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<nav class="foot ">
		<div class="clearfix">
			<div class="left FootL">
				已选中<span class="red" id="betTotalNum">0</span>注
				<input type="number" class="bet-money" oninput="changeVale(this)" value="" placeholder="输入金额" />
			</div>
			<div class="right FootR">
				<a href="javascript:void(0);" class="bet_a betTab">下注</a>
				<a href="javascript:void(0);" class="betReset">重置</a>
			</div>
		</div>
	</nav>
	<nav id="fen" class="foot" style="z-index:100;height: 60px;opacity:0.5;background: #5696c4;display: none;">
		<p style="text-align: center;font-size:24px;line-height: 40px;color: #fff;">已封盘</p>
	</nav>
	<div class="rule_box">
		<h4 class="mui-h4 mui-text-center mui-clearfix">PC蛋蛋  <a class="mui-pull-right" href="javascript:void(0);"><img class="close" src="__IMG__/wap/close.png"/></a></h4>
		<p>
			大：三个位置的数值相加和大于等于14,15,16,17,18,19,20,21,22,23,24,25,26,27为大。<br />
			小：三个位置的数值相加和小于等于00,01,02,03,04,05,06,07,08,09,10,11,12,13为小。<br />
			单：三个位置的数值相加和为单就为单。<br />
			双：三个位置的数值相加和为双就为双。<br />
			极大（三个数值和）：23,24,25,26,27为极大。<br />
			极小（三个数值和）：00,01,02,03,04为极小。<br />
			红波（三个数值和）：03,06,09,12,15,18,21,24为红波。<br />
			绿波（三个数值和）：01,04,07,10,16,19,22,25为绿波。<br />
			蓝波（三个数值和）：02,05,08,11,17,20,23,26为蓝波。<br />
			注:当开奖结果为：0,13,14,27(所有买的波色皆输)视为全部不中奖！<br />
			豹子：當期開出三個數字相同即為豹子<br />
			特码（三个数值和）：單選取一個數字投注。<br />
		</p>
	</div>
	<div class="Bet_list">
    <h4 class="mui-text-center mui-h4 padding_tb10">下注清单</h4>
    <div class="padding_10 bor_b" id="betModalList">
    </div>
    <div class="bor_b padding_10">
        <p class="color_55">【合计】 总投注数:<span class="red mg_r20" id="bcountVal">0</span>总金额:<span class="red" id="btotalVal">0</span></p>
    </div>
    <div class="text-center padding_tb20 btn_box">
        <a href="javascript:void(0);" class="basic_a cancel">取消</a>
        <a href="javascript:void(0);" class="basic_a" onclick="lotteryBetController.setOrder();">确定</a>
    </div>
</div>
	<div class="overlay"></div>
</div>
<div class="menu">
    <h4 class="mui-text-center mui-h4 padding_10 color_ff"> <a href="<?php echo url('Index/index'); ?>">返回大厅</a></h4>
    <div class="menu_list">
        <ul>
            <li><a href="<?php echo url('Pcdd/index'); ?>">PC蛋蛋</a></li>
            <li><a href="<?php echo url('Cqssc/index'); ?>">重庆时时彩</a></li>
            <li><a href="<?php echo url('Car/index'); ?>">北京赛车</a></li>
            <li><a href="<?php echo url('Xglhc/index'); ?>">六合彩</a></li>
            <li><a href="<?php echo url('Xyft/index'); ?>">幸运飞艇</a></li>
            <li><a href="<?php echo url('Gdsyxw/index'); ?>">广东11选5</a></li>
            <li><a href="<?php echo url('Jsks/index'); ?>">江苏快三</a></li>
            <li><a href="<?php echo url('Msssc/index'); ?>">秒速时时彩</a></li>
            <li><a href="<?php echo url('Mssc/index'); ?>">秒速赛车</a></li>
            <li><a href="<?php echo url('Xync/index'); ?>">幸运农场</a></li>
        </ul>
    </div>
</div>
<script>
    var cate=<?php echo $cate; ?>,hall=<?php echo $hall; ?>;
    var timeCountDown = {
        getWinMessage : true,
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
                $('#open-date .minute').html(min);
                $('#open-date .second').html(sec);
                $('#bet-date .minute').html(ts_min);
                $('#bet-date .second').html(ts_sec);
            } else if (t >= 0) {
                if (t <= 50000) {    //30s后封盘
                    $('#fd').html('已封单').css('visibility', 'inherit');
                }
                if(t>210000){
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
                $('#open-date .minute').html(min);
                $('#open-date .second').html(sec);
                $('#bet-date .minute').html(ts_min);
                $('#bet-date .second').html(ts_sec);
            } else {
                var s = $('#next_turn_num').html().substr(0,$('#next_turn_num').html().length-1);
                clearInterval(timeCountDown.timeLapse);
                $('#lastBets .bets').html('');
                timeCountDown.getTime();
                timeCountDown.longPolling(s);
            }
        },
        getTime:function (s,n) {
            $.ajax({
                url: "<?php echo url('Jndeb/getStage'); ?>",
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
                            var sumV = 0;
                            $.each(n.split(','),function(k,v){
                                $('#result_balls i.round1:eq('+k+')').html(v);
                                sumV = accAdd(sumV,v);
                            })
                            $('#result_balls i.round1:eq(3)').html(sumV);
                            $('#result_balls i.squal1:eq(0)').html(dxJudgment(14,sumV));
                            $('#result_balls i.squal1:eq(1)').html(dsJudgment(sumV));
                            $('.cur_turn_num').html(openStage+'期');
                        }
                        $('#next_turn_num').html(data.stage_next+'期');
                        var t = data.dateline * 1000;
                        var ts = (data.dateline - 50) * 1000;
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
                url: "<?php echo url('Api/checkOpenJndeb'); ?>",
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
                        var sumV = 0;
                        $.each(data.number.split(','),function(k,v){
                            $('#result_balls i.round1:eq('+k+')').html(v);
                            sumV = accAdd(sumV,v);
                        })
                        $('#result_balls i.round1:eq(3)').html(sumV);
                        $('#result_balls i.squal1:eq(0)').html(dxJudgment(14,sumV));
                        $('#result_balls i.squal1:eq(1)').html(dsJudgment(sumV));
                        $('.cur_turn_num').html(data.stage+'期');
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
            if(!$('.game_tab .tab_box li.active').length){
                pop('下注内容不正确，请重新下注单');
                return;
            }
            var str = '';
            var totalMoney = 0;
            var totalBet = 0;
            $.each($('.game_tab .tab_box li.active'),function(){
                var title = $(this).parent().attr('data-target-num');
                var titleType = $(this).parent().attr('data-target-type');
                var type = $(this).attr('data-num');
                var unitPrice = $(this).find('i.odds').html();
                var money = $('.bet-money').val();
                str += '<p data-target-type="'+titleType+'" data-target-odds="'+unitPrice+'" data-target-money="'+money+'" data-target-num="'+type+'" class="mg_top10 color_55">【'+title+'-'+type+'】'+unitPrice+'*'+money+'</p>';
                totalMoney = totalMoney*1 + money*1;
                totalBet ++;
            })
            $('#bcountVal').html(totalBet);
            $('#btotalVal').html(totalMoney);
            $('#betModalList').html(str);

            $(".Bet_list").fadeIn(200);
            $(".overlay").show();
            $(".overlay").css("height",$(document).height());
        },
        betReset : function(){
            $('.game_tab .tab_box li').removeClass('active');
            $('#betTotalNum').html(0);
            $("input.bet-money").val('');
        },
        setOrder : function (){
            if(!lotteryBetController.setOrderCheck){
                return;
            }
            var betData = {};
            var betDataArr = new Array();
            var check = true;
            if($('.Bet_list #betModalList p').length == 0){
                layer.closeAll();
                pop('下注内容不正确，请重新下注');
                return;
            }
            $.each($('.Bet_list #betModalList p'),function(k,v){
                betData = {};
                var t = $(v).attr('data-target-type');
                var n = $(v).attr('data-target-num');
                var o = $(v).attr('data-target-odds');
                var m = $(v).attr('data-target-money');
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
                            $('.Bet_list .cancel').click();
                            $('.betReset').click();
                            pop(data.msg);
                            lotteryBetController.fresh();
                        } else {
                            $('.cancel').click();
                            pop(data.msg);
                        }
                    },
                    error: function (textStatus) {
                        pop('服务器繁忙，请稍后再试');
                    },
                    complete: function(){
                        setTimeout(function(){
                            lotteryBetController.setOrderCheck = true;
                        },3000); // 递归调用
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
            $.each($('.game_tab .tab_box').find('i.odds'),function(k,v){
                var play_id = $(v).attr('data-id');
                if(play_id) {
                    $(v).html(oddsArr[cate][play_id]['rate']);
                }
            })
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
        },
    }
    function banBet(data){
        if(data){
            $("#fen").show();
            $('#stageStatus').attr('data-status','off');
            $('.cont-col3-bd .amount input').attr('readonly',true);
            $('.cont-col3-bd .amount input').addClass('fengpan');
            $('.cont-col3-bd .u-table2 td.odds span').html('--');
            $('.cont-col3-bd .u-table2 td.amount input').val('封盘');
            $('.cont-col3-bd .u-table2 td').removeClass('bg_yellow');
        }else{
            $("#fen").hide();
            $('#stageStatus').attr('data-status','on');
            $('.cont-col3-bd .amount input').attr('readonly',false);
            $('.cont-col3-bd .amount input').removeClass('fengpan');
            $('.cont-col3-bd .u-table2 td.amount input').val('');
            lotteryBetController.oddsSet();
        }
    }
    $(function () {
        $('#stat_qiu .u-tb3-th2').click(function(){
            $('#stat_qiu .u-tb3-th2').removeClass('select');
            $(this).addClass('select');
            $('#stat_type th:eq(0)').html($(this).html());
            $('#stat_type th').removeClass('select');
            $('#stat_type th:eq(0)').addClass('select');
        });
        $('#stat_type .u-tb3-th2').click(function(){
            $('#stat_type .u-tb3-th2').removeClass('select');
            $(this).addClass('select');
        });
        setTimeout(function () {
            timeCountDown.getTime("<?php echo $openStage; ?>","<?php echo $openNum; ?>");
            $('#stat_qiu .u-tb3-th2:eq(0)').click();
        },1000)
        $('.betTab').click(lotteryBetController.betTab);
        $('.betReset').click(lotteryBetController.betReset);
        setInterval(function(){
            // timeCountDown.getWinMessage();
            lotteryBetController.fresh();
        },10000)
    });
    function changeVale(_this){
        var val = $(_this).val();
        if(val.length<=6){
            $('.bet-money').val(val);
        }else{
            $('.bet-money').val(val.slice(0,6));
        }
    }
</script>
</body>
</html>
