<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:56:"/www/wwwroot/smgj/public/../app/wap/view/jndeb/room.html";i:1540625081;s:59:"/www/wwwroot/smgj/public/../app/wap/view/jndeb/room_js.html";i:1540785985;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title><?php echo $title; ?></title>
    <link rel="icon" href="__IMG__/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="__IMG__/favicon.ico" type="image/x-icon" />
    <link href="__CSS__/wap_new/mui.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="__CSS__/wap_new/common.css"/>
    <link rel="stylesheet" type="text/css" href="__CSS__/wap_new/index.css"/>
</head>
<style>
    .betting-boss.game-main{
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        background: #fff;
        display: none;
        z-index: 50;
    }
    .betting-boss.game-main{
        height: calc(60vh);
    }
    .betting-boss.game-main .game-paly-right{
        height: calc(60vh - 76px);
    }
    .betting-foot{
        display: none;
        z-index: 60;
    }
    .hello{
        width: 75%;
        margin: auto;
        height: 30px;
        background: #e5e5e5;
        margin-top: 3%;
        border-radius: 5px;
        text-align: center;
        overflow: hidden;
        text-overflow:ellipsis;
        white-space: nowrap;
        font-size: 14px;
        line-height: 25px;
    }
    .room-msg{
        background: #e5e5e5;margin: 20px 60px; padding:10px 20px;border-radius:10px;text-align: center;
    }
</style>
<body  id="game">
<header class="mui-bar mui-bar-nav">
    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
    <h1 class="mui-title text_left"><?php echo $title; ?></h1>
    <span class="top-icon">
		    	<a href="javascript:void(0);" class="mg_left10 color_ff" id="icon-add">
		    		<img class="icon-small vertical-align_m" src="__IMG__/wap_new/icon-list.png" alt="" />
		    	</a>
		    </span>
    <!--<div class="index-nav">-->
        <!--<div class="top-nav">-->
            <!--<a href="hall-zhudan.html"><img class="vertical-align_m icon-small1" src="__IMG__/wap_new/icon_ball01.png" alt="" />即时注单</a>-->
            <!--<a href="hall-today.html"><img class="vertical-align_m icon-small1" src="__IMG__/wap_new/icon_bal02.png" alt="" /> 今日已结</a>-->
            <!--<a href="hall-Bet-record.html"><img class="vertical-align_m icon-small1" src="__IMG__/wap_new/icon_bal03.png" alt="" /> 下注记录</a>-->
            <!--<a href="Lottery_results.html"><img class="vertical-align_m icon-small1" src="__IMG__/wap_new/icon_bal04.png" alt="" /> 开奖结果</a>-->
            <!--<a href="hall-cl.html"><img class="vertical-align_m icon-small1" src="__IMG__/wap_new/icon_bal05.png" alt="" /> 两面长龙</a>-->
            <!--<a href="hall-rule.html"><img class="vertical-align_m icon-small1" src="__IMG__/wap_new/icon_bal06.png" alt="" /> 游戏规则</a>-->
            <!--<a href="money.html"><img class="vertical-align_m icon-small1" src="__IMG__/wap_new/icon_bal07.png" alt="" /> 充值</a>-->
            <!--<a href="money.html"><img class="vertical-align_m icon-small1" src="__IMG__/wap_new/icon_bal08.png" alt="" /> 提现</a>-->
        <!--</div>-->
        <!--<p class="icon-triangle"></p>-->
    <!--</div>-->
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
<div class="mui-content" id="stageStatus">
    <div class="bg_ff">
        <ul class="clearfix bettimg-top bor_b padding_10">
            <li class="left">
                <p>距离<span class="red" id="next_turn_num">325211</span>期截止</p>
                <div class="colockbox clearfix left" id="demo02">
                    <span class="minute"></span>:
                    <span class="second"></span>
                </div>
            </li>
            <li class="left">
                <p>余额</p>
                <p><img class="vertical-align_m" src="__IMG__/wap_new/yb.png"/><span id="memMoney"><?php echo bcadd($mem['money'],0,2); ?></span></p>
            </li>
        </ul>
        <ul class="mui-table-view betting-ls">
            <li class="mui-table-view-cell mui-collapse">
                <a class="mui-navigate-right" href="#" id="openOne">
                    <span>第<i class="blue cur_turn_num">1231333</i>期</span>
                    <span>
                        <i class="round1" style="margin: 0 10px;">1</i>+
                        <i class="round1" style="margin: 0 10px;">3</i>+
                        <i class="round1" style="margin: 0 10px;">5</i>
                        <span>=</span>
                        <i class="round1">9</i>
                    </span>
                    <span>(小,单)</span>
                </a>
                <div class="mui-collapse-content" id="openList"></div>
            </li>
        </ul>
    </div>
    <div class="msg-box" id="room">
        <div class="msg-main mg_top10 roomc"></div>
    </div>
</div>

<div class="game-main clearfix betting-boss">
    <ul class="clearfix left game-paly-left" style="height: 742px;">
        <li class="active"><a href="javascript:void(0);">猜双面</a></li>
        <li> <a href="javascript:void(0);">猜数字</a> </li>
        <li> <a href="javascript:void(0);">特殊玩法</a> </li>
    </ul>
    <div class="left game-paly-right bg_ff">
        <div class="game-boss active">
            <div class="padding_10 bor_b text-center font_15 color_00">猜双面</div>
            <div class="game-chosess-box">
                <ul class="clearfix text-center game-chosess" data-target-type="1" data-target-num="混合">
                    <?php if(is_array($rule_data['hh']) || $rule_data['hh'] instanceof \think\Collection || $rule_data['hh'] instanceof \think\Paginator): $i = 0; $__LIST__ = $rule_data['hh'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if(is_array($vo) || $vo instanceof \think\Collection || $vo instanceof \think\Paginator): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?>
                    <li class="li_two" data-num="<?php echo $v1['rule']; ?>" data-rate="<?php echo $v1['rate']; ?>"><strong class="font_14"><?php echo $v1['rule']; ?></strong><span data-id="<?php echo $v1['id']; ?>"><?php echo $v1['rate']; ?></span></li>
                    <?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
        </div>
        <div class="game-boss">
            <div class="padding_10 bor_b text-center font_15 color_00">猜数字</div>
            <div class="game-chosess-box">
                <ul class="clearfix text-center game-chosess gameball" data-target-type="2" data-target-num="猜数字">
                    <?php if(is_array($rule_data['tm']) || $rule_data['tm'] instanceof \think\Collection || $rule_data['tm'] instanceof \think\Paginator): $i = 0; $__LIST__ = $rule_data['tm'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if(is_array($vo) || $vo instanceof \think\Collection || $vo instanceof \think\Paginator): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?>
                    <li class="li_two" data-num="<?php echo $v1['rule']; ?>" data-rate="<?php echo $v1['rate']; ?>"><i class="icon-ball"><?php echo $v1['rule']; ?></i><span data-id="<?php echo $v1['id']; ?>"><?php echo $v1['rate']; ?></span></li>
                    <?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
        </div>
        <div class="game-boss">
            <div class="padding_10 bor_b text-center font_15 color_00">特殊玩法</div>
            <div class="game-chosess-box">
                <ul class="clearfix text-center game-chosess" data-target-type="3" data-target-num="特殊玩法">
                    <?php if(is_array($rule_data['ts']) || $rule_data['ts'] instanceof \think\Collection || $rule_data['ts'] instanceof \think\Paginator): $i = 0; $__LIST__ = $rule_data['ts'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if(is_array($vo) || $vo instanceof \think\Collection || $vo instanceof \think\Paginator): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?>
                    <li class="li_two" data-num="<?php echo $v1['rule']; ?>" data-rate="<?php echo $v1['rate']; ?>"><strong class="font_14"><?php echo $v1['rule']; ?></strong> <span data-id="<?php echo $v1['id']; ?>"><?php echo $v1['rate']; ?></span> </li>
                    <?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
        </div>

        <!--赔率说明-->
        <!--<p class="padding_10 text_right mg_top40"><a href="javascript:void(0);" class="odds-icon"><img src="__IMG__/wap_new/icon-wh.png" class="vertical-align_m pl-icon" alt="">赔率说明</a></p>-->
    </div>
</div>
<!--底部输入框-->
<div class="game-footer">
    <div class="padding_10">
        <div class="footer-inpbox clearfix">
            <!--<input type="text" name=""  class="right betting-input" value="" placeholder="" />-->
            <div>
                <a href="javascript:void(0);" class="betting-a tz" style="width: 100%;text-align: center;">投注</a>
            </div>
        </div>
    </div>
</div>
<div class="game-footer betting-foot">
    <div class="padding_10">
        <p>已选中<span class="yell nums"> 0 </span> 注</p>
        <div class="footer-inpbox clearfix">
            <input type="number" name="" id="money-text" value="" placeholder="输入金额">
            <div class="right">
                <a href="javascript:void(0);" class="betting-a xz" id="betting">下注</a>
                <input type="reset" name="reset_inp" id="reset_inp" value="重置">
            </div>
        </div>
    </div>
</div>
<!--<div class="mi_box">-->
    <!--<a href="javascript:void(0);"><img src="__IMG__/wap_new/mi.png"/></a>-->
<!--</div>-->
<div class="msg-spring"></div>
<div class="overlay"></div>
<script src="__JS__/wap_new/mui.min.js"></script>
<script src="__JS__/wap_new/jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
<script src="__JS__/jquery.validate.min.js"></script>
<script src="__JS__/layer.js"></script>
<script src="__JS__/common.js"></script>
<script src="__JS__/wap_new/index.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    var room_id = <?php echo $rongData['room_id']; ?>;
    var xbIsLogin=1,
        rongKey="<?php echo $rongData['rong_key']; ?>",
        rongToken="<?php echo $rongData['rong_token']; ?>",
        xbUserInfo = {
            id: "<?php echo $rongData['uid']; ?>",
            name: "<?php echo $rongData['username']; ?>",
            avatar: "<?php echo $rongData['head']; ?>"
        };
    function  hide(){
        $(".betting-boss").fadeOut(200)
        $(".betting-foot").fadeOut(200);
        $(".overlay").hide();
    }
    $(function(){
        $(".tz").click(function(){
            $(".overlay").show();
            $(".betting-boss").fadeIn(200)
            $(".betting-foot").fadeIn(200);
            $(".overlay").click(function(){
                hide()
            })
        })
        $(".xz").click(function(){
            hide()
        })
    })
</script>
<script src="http://cdn.ronghub.com/RongIMLib-2.3.1.min.js"></script>
<script src="__JS__/wap_new/main.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>
<script>
    var cate = <?php echo $cate; ?>;
    var hall = <?php echo $hall; ?>;
    var cache = "<?php echo $cache; ?>";
    var bet_time=50;
    var all_time=210;
    var timeCountDown = {
        getWinMessage : true,
        longPollingCheck : true,
        timeLapse : '',
        getCountDown:function(t,ts){
            var day = Math.floor(t / 1000 / 60 / 60 /24); //计算天
            var hour = Math.floor(t / 1000 / 60 / 60 % 24); //计算时
            var min = Math.floor(t / 1000 / 60 % 60); //计算分
            var sec = Math.floor(t / 1000 % 60);      //计算秒
            var ts_day = Math.floor(t / 1000 / 60 / 60/24); //计算天
            var ts_hour = Math.floor(ts / 1000 / 60 / 60 % 24); //计算时
            var ts_min = Math.floor(ts / 1000 / 60 % 60); //计算分
            var ts_sec = Math.floor(ts / 1000 % 60);      //计算秒
            if(ts_sec==30 && ts_hour==0 && ts_min==0){
                systemMsg('本期投注截止时间还有30秒，请抓紧时间下单，别错过大奖哦');
            }
            if(sec==0 && min==0 && hour==0){
                systemMsg('开始下注');
            }
            if (t >= 3600000 && t<=all_time) {
                $('#demo02').html('已停盘');
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
                if(hour){
                    min = hour+'时'+min;
                }
                if(day){
                    min = day+'天'+min;
                }
                if(ts_hour){
                    ts_min = ts_hour +'时'+ ts_min;
                }
                if(ts_day){
                    ts_min =ts_day +'天'+ ts_min;
                }
                var str_time = '<span class="minute">'+ts_min+'</span> : <span class="second">'+ts_sec+'</span>';
                $('#demo02').html(str_time);
            } else if (t >= 0) {
                if (t <= bet_time*1000) {    //30s后封盘
                    $('#demo02').html('已封盘');
                    banBet('ban');return;
                }
                if(t>=all_time*1000){
                    $('#demo02').html('已停盘');
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
                if(hour){
                    min = hour+'时'+min;
                }
                if(day){
                    min = day+'天'+min;
                }
                if(parseInt(ts_hour)){
                    ts_min = ts_hour +'时'+ ts_min;
                }
                if(ts_day){
                    ts_min =ts_day +'天'+ ts_min;
                }
                var str_time = '<span class="minute">'+ts_min+'</span> : <span class="second">'+ts_sec+'</span>';
                $('#demo02').html(str_time);
            } else {
                var s = $('#next_turn_num').html();
                clearInterval(timeCountDown.timeLapse);//清除定时器
                timeCountDown.getTime();
                timeCountDown.longPolling(s);
            }
        },
        getTime:function (s,n) {
            $.ajax({
                url: "<?php echo url($cache.'/getStage'); ?>",
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
                            var str='';
                            var str_b='';
                            var sum=0;
                            if(openStage != stage){
                                timeCountDown.longPolling(stage);
                            }
                            $.each(n.split(','),function(k,v){
                                str_b+='<i class="round1" style="margin: 0 5px;">'+v+'</i>+';
                                sum+=parseInt(v);
                            });
                            str_b=str_b.substr(0,(str_b.length-1));
                            str+='<span>第<i class="blue cur_turn_num">'+openStage+'</i>期</span><span>'+str_b+'<span>=</span><i class="round1" style="margin: 0 5px;">'+sum+'</i></span><span>('+dxJudgment(14,sum)+','+dsJudgment(sum)+')</span>';
                            $('#openOne').html(str);
                        }
                        $('#next_turn_num').html(data.stage_next);
                        var t = data.dateline * 1000;
                        var ts = (data.dateline - bet_time) * 1000;
                        if(data.stage_next){
                            banBet();
                            lotteryBetController.refresh(cate);
                            getNewOpenList(cache);
                            timeCountDown.timeLapse = setInterval(function (){
                                timeCountDown.getCountDown(t,ts);
                                t = t - 1000;
                                if (ts <= 0) {
                                    ts = 0;
                                    banBet('ban');
                                    order_refresh();
                                } else {
                                    ts = ts - 1000;
                                }
                            }, 1000);
                        }else{
                            setTimeout(function(){
                                banBet('ban');
                                order_refresh();
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
                url: "<?php echo url('Api/checkOpen'.ucfirst($cache)); ?>",
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
                        var str='';
                        var str_b='';
                        var sum = 0;
                        $.each(data.number.split(','),function(k,v){
                            str_b+='<i class="round1" style="margin: 0 5px;">'+v+'</i>+';
                            sum+=parseInt(v);
                        });
                        str_b=str_b.substr(0,(str_b.length-1));
                        str+='<span>第<i class="blue cur_turn_num">'+data.stage+'</i>期</span><span>'+str_b+'<span>=</span><i class="round1" style="margin: 0 5px;">'+sum+'</i></span><span>('+dxJudgment(14,sum)+','+dsJudgment(sum)+')</span>';
                        $('#openOne').html(str);
                        setTimeout(function () {
                            getNewOpenList(cache);
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
                        var allmoney=0;
                        $.each(data.data,function(k,v){
                            allmoney += parseFloat(v.money);
                        });
                        if(allmoney>0){
                            str = '<p>恭喜中奖'+allmoney+'元宝</p>';
                            $('.jjc').html(str);
                            $('.mengba').css('display','block');
                            setTimeout(function(){
                                $('.mengba').css('display','none');
                            },5000); // 递归调用
                            lotteryBetController.fresh();
                        }
                    }
                }
            });
        }
    }
    var lotteryBetController = {
        setOrderCheck : true,
        freshCheck : true,
        refreshCheck:true,
        cancelBetCheck:true,
        sentCheck : true,
        boxBetCheck:true,
        betTab : function(){
            if(lotteryBetController.setOrderCheck==false){
                layer.msg('投注中...');return;
            }
            var money = 0;
            if($('#stageStatus').attr('data-status')=='off'){
                layer.msg('该期已封单，不能下单');
                return;
            }
            if(!$('.game-boss li.active').length){
                layer.msg('下注内容不正确，请重新下注单');
                return;
            }
            var str = '';
            var totalMoney = 0;
            var totalBet = 0;
            var betDataArr = new Array();
            var check = true;
            $.each($('.game-boss li.active'),function(k,v){
                var betData = {};
                var t = $(v).parent().attr('data-target-type');
                var n = $(v).attr('data-num');
                var o = $(v).attr('data-rate');
                var m = $("#money-text").val();
                if(t && n && o && m){
                    var value = parseInt(m);
                    if(value>0 && value == m){
                        betData['type'] = t;
                        betData['num'] = n;
                        betData['odds'] = o;
                        betData['money'] = m;
                        betDataArr.push(betData);
                        totalMoney +=parseInt(betData['money']);
                    }else{
                        layer.msg('投注金额错误');
                        check = false;
                    }
                }else {
                    layer.closeAll();
                    layer.msg('数据异常');
                    check = false;
                }
            });
            if(check){
                var totalNotes = betDataArr.length;
                var index5={};
                layer.confirm('共'+totalNotes+'注，共'+totalMoney+'元宝',{icon: 3, title:'投注提示'},function(index) {
                    $.ajax({
                        url: "<?php echo url($cache.'/betting'); ?>",
                        data: {'data': betDataArr, 'cate': cate, 'hall': hall},
                        type: 'POST',
                        dataType: "json",
                        beforeSend: function () { //触发ajax请求开始时执行
                            index5 = layer.load(0, {shade: false});
                            lotteryBetController.setOrderCheck = false;
                            $('.layui-layer-content .bet-loading').css('display', 'block');
                        },
                        success: function (data) {
                            if (data.code == 1) {
                                betBoxFresh();
                                layer.msg(data.msg);
                                setMsg(data.data,data.info);
                                $(".game-boss ul li").removeClass('active');
                                $("#money-text").html('0');
                                $(".nums").html('0');
                                lotteryBetController.fresh();
                            } else {
                                $('.cancel').click();
                                layer.msg(data.msg);
                                lotteryBetController.setOrderCheck = true;
                            }
                        },
                        error: function (textStatus) {
                            layer.msg('服务器繁忙，请稍后再试');
                        },
                        complete: function () {
                            layer.close(index5);
                            setTimeout(function () {
                                lotteryBetController.setOrderCheck = true;
                            }, 3000); // 递归调用
                        }
                    });
                    layer.close(index);
                })
            }else{
                return;
            }
        },
        boxBet:function () {
            if(lotteryBetController.boxBetCheck==false){
                layer.msg('投注中...');return;
            }
            if($('#stageStatus').attr('data-status')=='off'){
                betBoxFresh();
                // systemMsg('该期已封单，不能下单');
                layer.msg('该期已封单，不能下单');
                return;
            }
            if(!$('.list-con p').length){
                // systemMsg('下注内容不正确，请重新下注单');
                layer.msg('无有效注单');
                return;
            }
            var totalMoney = 0;
            var betDataArr = new Array();
            var check = true;
            $.each($('.list-con p'),function(k,v){
                var betData = {};
                var t = $(v).attr('data-type');//值
                var n = $(v).attr('data-rule');
                var o = $(v).attr('data-rate');
                var m = $(v).attr('data-money');
                if(t && n && o && m){
                    var value = parseInt(m);
                    if(value>0 && value == m){
                        betData['type'] = t;
                        betData['num'] = n;
                        betData['odds'] = o;
                        betData['money'] = m;
                        betDataArr.push(betData);
                        totalMoney +=parseInt(betData['money']);
                    }else{
                        layer.msg('投注金额错误');
                        check = false;
                    }
                }else {
                    layer.closeAll();
                    layer.msg('数据异常');
                    check = false;
                }
            });
            if(check){
                var totalNotes = betDataArr.length;
                var index4={};
                layer.confirm('共'+totalNotes+'注，共'+totalMoney+'元宝',{icon: 3, title:'投注提示'},function(index) {
                    $.ajax({
                        url: "<?php echo url($cache.'/betting'); ?>",
                        data: {'data': betDataArr, 'cate': cate, 'hall': hall},
                        type: 'POST',
                        dataType: "json",
                        beforeSend: function () { //触发ajax请求开始时执行
                            index4 = layer.load(0, {shade: false});
                            lotteryBetController.boxBetCheck = false;
                            $('.layui-layer-content .bet-loading').css('display', 'block');
                        },
                        success: function (data) {
                            if (data.code == 1) {
                                boxFresh();
                                layer.msg(data.msg);
                                setMsg(data.data,data.info);
                                lotteryBetController.fresh();
                            } else {
                                $('.cancel').click();
                                layer.msg(data.msg);
                                lotteryBetController.boxBetCheck = true;
                            }
                        },
                        error: function (textStatus) {
                            layer.msg('服务器繁忙，请稍后再试');
                        },
                        complete: function () {
                            layer.close(index4);
                            setTimeout(function () {
                                lotteryBetController.boxBetCheck = true;
                                lotteryBetController.fresh();
                            }, 3000); // 递归调用
                        }
                    });
                    layer.close(index);
                })
            }else{
                return;
            }
        },
        oddsSet : function(){

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
                        // $('.game-boss li').removeClass('active');
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
        refresh : function(cate){
            if(lotteryBetController.refreshCheck == false){
                return;
            }
            var stage = $('#next_turn_num').html();
            var dom1 = $('#div ul li.active');
            // $.each(dom1,function(k,v){
            //     // $(v).removeClass('active');
            //     $('.start').hide();
            // });
            $.ajax({
                url: "<?php echo url($cache.'/getStageList'); ?>",
                type:'POST',
                data:{stage:stage},
                dataType: "json",
                beforeSend:function(){ //触发ajax请求开始时执行
                    lotteryBetController.refreshCheck = false;
                },
                success: function(data){
                    if(data){
                        var str ="";
                        var str_id = '';
                        var str_stage='';
                        var str_cate = '';
                        var single_num =data.length;
                        $.each(data,function(k,v){
                            str += '<li><p style="width:150px !important;">'+v.typeName+'-'+v.number+'</p><p style="flex: 1;text-align: right"><b>'+parseInt(v.money)+'元宝</b></p></li>';
                            str_id += v.id+',';
                            str_stage=v.stage;
                            str_cate = v.cate;
                        });
                        $('#single_list').html(str);
                        $('.fir>button').attr('onclick','cancelAllBet("'+str_id+'","'+str_stage+'","'+str_cate+'")');
                        $('#single_num').html(single_num);
                    }

                },
                error: function (textStatus) {
                    setTimeout(function(){
                        lotteryBetController.refreshCheck = true;
                        lotteryBetController.refresh();
                    },1000); // 递归调用
                },
                complete: function(){
                    setTimeout(function(){
                        lotteryBetController.refreshCheck = true;
                    },3000); // 递归调用
                }
            });
        },
        cancelBet:function(stage,cate){
            if($('#stageStatus').attr('data-status')=='off'){
                layer.msg('该期已封单，不能撤单');
                return;
            }
            if(lotteryBetController.cancelBetCheck == false){
                return;
            }
            $.ajax({
                url: "<?php echo url('api/cancelSingel'); ?>",
                type:'POST',
                data:{stage:stage,cate:cate,id:single_id},
                dataType: "json",
                beforeSend:function(){ //触发ajax请求开始时执行
                    lotteryBetController.cancelBetCheck = false;
                },
                success: function(data){
                    console.log(data);
                },
                error: function (textStatus) {
                    setTimeout(function(){
                        lotteryBetController.cancelBetCheck = true;
                        lotteryBetController.cancelBet();
                    },1000); // 递归调用
                },
                complete: function(){
                    setTimeout(function(){
                        lotteryBetController.cancelBetCheck = true;
                    },1000); // 递归调用
                }
            });
        },
        sentOrder:function(posts){
            if(lotteryBetController.sentCheck == false){
                return;
            }
            $.ajax({
                url: "<?php echo url($cache.'/msg_betting'); ?>",
                type:'POST',
                data:{posts:posts},
                dataType: "json",
                beforeSend:function(){ //触发ajax请求开始时执行
                    lotteryBetController.sentCheck = false;
                },
                success: function(data){
                    console.log(data);

                },
                error: function (textStatus) {
                    layer.msg('系统错误');
                }
            });
        }
    }
    function betBoxFresh() {
        $('#off').click();
        $('.lest').hide();
    }
    function banBet(data){
        if(data){
            $('#stageStatus').attr('data-status','off');
        }else{
            $('#stageStatus').attr('data-status','on');
        }
    }
    function order_refresh() {
        $('.order_num').html('0');
        $('.order_money').html('0');
        $('.sho').html('');
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
        },1000)
        joinMsg("<?php echo $mem['gm_name']; ?>");
        $('.betReset').click(lotteryBetController.betReset);
        setInterval(function(){
            // timeCountDown.getWinMessage();
            lotteryBetController.fresh();
        },10000)
        $('select[name="sort"]').change(function(){
            var type_id = $(this).val();
            $(this).parent().parent().siblings().attr('data-target-type',type_id);
        });
    });
    $(document).on('click','#betting',function () {
        lotteryBetController.betTab();
    });
    $(document).on('click','#boxBetting',function () {
        lotteryBetController.boxBet();
    });
    function joinMsg(name) {
        var str='<p class="hello"><span> 欢迎 </span><b> '+name+' </b><span>进入房间</span></p>'
        $('.roomc').append(str);
        rongChangeScrollHeight();
    }
    function systemMsg(content){
        var str='';
        str ='<div class="userBetting room-msg">'+content+'</div>';
        $('.roomc').append(str);
        rongChangeScrollHeight();
    }
    function setMsg(data,info){
        var str='';
        var str_a='';
        if(info.type==1){
            $.each(data,function(k,v){
                str_a +='<p class="padding_5  clearfix"><span class="width50 left red">'+v.typeName+'_'+v.number+'</span><span class="width50 left red">'+v.money+' <img  class="icon-small1" src="__IMG__/wap_new/yb.png"/></span></p>';
            });
            str+='<dl class="clearfix"><dt class="right"><img class="width100" src="'+info.head+'"/></dt><dd class="left">'
                +'<p>'+info.name+'</p><div class="msg-font"><p data-issue="'+data[0].stage+'"><img class="icon-small1" src="__IMG__/wap_new/blackclock_icon.png"/>'+data[0].stage+'期</p>'
                +'<p class="padding_5 bor_b clearfix"><span class="width50 left">投注类型</span><span class="width50 left">投注金额</span>'+str_a+'</p>'
                +'</div></dd></dl><p class="time">'+info.time+'</p>';
        }else if(info.type==3){
            $.each(data,function(k,v){
                str_a += '<div class="issueCon"><em></em><span>'+v.stage+'期</span></div><p order-no="undefined"><label>投注类型：</label><span>'+v.typeName+'_'+v.number+'</span><label class="r">金额：<em>'+v.money+'</em><i class="iconMoney"></i></label></p>';
            });
            str +='<div class="userBetting"><dl class="right"><dt><img src="'+info.head+'"></dt>';
            str +='<dd><h3 style="text-align:left"><b> '+info.name+' </b><img src="'+info.level_pic+'" width="50" alt=""></h3><div class="bet-con-self">';
            str +=str_a+'<i class="mask"></i></div><span class="timeRecord">'+info.time+'</span></dd></dl></div>';
        }else{

            }
        $('.roomc').append(str);
        rongChangeScrollHeight();
    }
    function rongChangeScrollHeight(){
        var div = document.getElementById('room');
        div.scrollTop = div.scrollHeight;
    }
    function genzhu(username,stage,money,number,type,odds,typeName){
        if($('#stageStatus').attr('data-status')=='off'){
            betBoxFresh();
            layer.msg('该期已封单，不可跟注');
            return;
        }
        var str='';
        var str_bet='';
        var betData={};
        var betDataArr=[];
        var check=true;
        var numbers = number.split('/');
        var type_name = typeName.split('/');
        var oddss = odds.split('/');
        var type_id = type.split('/');
        var bet_money = money.split('/');
        numbers.pop();
        type_name.pop();
        oddss.pop();
        type_id.pop();
        bet_money.pop();
        $.each(numbers,function(k,v){
            str_bet+='<li>类别：<b>'+type_name[k]+'_'+v+'</b><b class="ro"><i>'+bet_money[k]+'</i> <img src="__WAP_IMG__/yb.png" alt=""/></b></li>';
        });
        str+='<div class="geng-c" number="'+numbers+'" type_name="'+type_name+'" oddss="'+oddss+'" type_id="'+type_id+'" money="'+money+'"><h1>跟投 <a id="close" onclick="$(\'#gentou\').hide();"><img src="__WAP_IMG__/clos.png" alt=""/></a></h1><ul><li>玩家：<span>'+username+'</span></li>' +
            '<li>期数：<span>'+stage+'</span></li> '+str_bet+'</ul><a class="ok" id="gentou_bt">确定</a> <a class="ok" style="background:#c7c7c7;" onclick="$(\'#gentou\').hide();">取消</a></div>';
        $('#gentou').html(str);
        $('#gentou').show();
        var gencheck= true;
        $(document).one('click','#gentou_bt',function(){
            betDataArr=[];
            $.each(numbers,function(k,v){
                betData = {};
                var t_v=type_name[k];
                var t = type_id[k];
                var n = v;
                var o = oddss[k];
                var m = bet_money[k];
                if(t && n && o && m){
                    if(m>0){
                        betData['type'] = t;
                        betData['num'] = n;
                        betData['odds'] = o;
                        betData['money'] = m;
                        betDataArr.push(betData);
                    }else{
                        layer.msg('投注金额错误');
                        check = false;
                    }
                }else{
                    layer.closeAll();
                    layer.msg('数据异常');
                    check = false;
                }
            })
            if(gencheck==false){
                layer.msg('请勿重复投注');return;
            }
            if(check){
                var index3={};
                $.ajax({
                    url: "<?php echo url($cache.'/betting'); ?>",
                    data:  {'data':betDataArr,'cate':cate,'hall':hall},
                    type:'POST',
                    dataType: "json",
                    beforeSend:function(){ //触发ajax请求开始时执行
                        index3 = layer.load(0, {shade: false});
                        gencheck = false;
                    },
                    success: function(data){
                        if(data.code == 1){
                            $('#nowMoney').html(data.money);
                            setMsg(data.data,data.info);
                            layer.msg(data.msg);
                            lotteryBetController.fresh();
                            $('#gentou').hide();
                        } else {
                            $('.off').click();
                            layer.msg(data.msg);
                        }
                    },
                    error: function (textStatus) {
                        layer.msg('服务器繁忙，请稍后再试');
                    },
                    complete: function(){
                        layer.close(index3);
                        setTimeout(function(){
                            gencheck = true;
                        },3000); // 递归调用
                    }
                });
            }else{
                return;
            }
        });
    }
    function zuiCreate(obj){
        var num =$("#stage_num").val();
        var multiple = $("#multiple").val();
        var t = $(".zhui_num").attr('data-target-type');
        var t_v = $(".zhui_num").attr('data-target-num');
        var n = $(".zhui_num").attr('data-rule');
        var o = $(".zhui_num").attr('data-rate');
        var m = $("#zhui_money").val();
        var min_m =  $("#zhui_money").attr('min');
        var stage = $('#next_turn_num').html();
        var str="";
        if(m<min_m){
            layer.msg('单注最低投注'+min_m);return;
        }
        if(!num){
            layer.msg('请填写追号期数');return;
        }
        if(num>20){
            layer.msg('单次最高可追20期');return false;
        }
        if(multiple<1){
            layer.msg('请填写追号倍数');return;
        }
        for (var i = 0; i<num; i++) {
            str+='<tr class="zuiList" data-stage="'+stage+'" data-money="'+(m*Math.pow(multiple,(i+1)))+'" data-multiple="'+Math.pow(multiple,(i+1))+'"><td>'+stage+'</td><td>'+(m*Math.pow(multiple,(i+1)))+'</td><td>'+Math.pow(multiple,(i+1))+'</td></tr>';
            stage++;
        }
        $('#zuiBox').attr('data-target-type',t);
        $('#zuiBox').attr('data-target-num',t_v);
        $('#zuiBox').attr('data-num',n);
        $('#zuiBox').attr('data-rate',o);
        $('#zuiBox').html('<tr><th>期号</th><th>投注金额</th><th>翻倍</th></tr>'+str);
        $('.tapb .tap-table').show();
    }
    function zhuiHao(obj){
        var betDataArr=Array();
        var is_check = $("#zuiCheck").is(":checked");
        $.each($(".zuiList"),function(k,v){
            var betData={};
            betData['type'] = $("#zuiBox").attr('data-target-type');
            betData['t_v'] =$("#zuiBox").attr('data-target-num');
            betData['num'] = $("#zuiBox").attr('data-num');
            betData['odds'] = $("#zuiBox").attr('data-rate');
            betData['stage'] = $(v).attr('data-stage');
            betData['money'] = $(v).attr('data-money');
            betData['bei'] = $(v).attr('data-multiple');
            betDataArr.push(betData);
        });
        if(betDataArr.length){
            var zhuiCheck=true;
            var index6={};
            $.ajax({
                url: "<?php echo url($cache.'/zhui_betting'); ?>",
                data:  {'data':betDataArr,'cate':cate,'hall':hall,'is_check':is_check},
                type:'POST',
                dataType: "json",
                beforeSend:function(){ //触发ajax请求开始时执行
                    index6 = layer.load(0, {shade: false});
                    zhuiCheck = false;
                },
                success: function(data){
                    if(data.code == 1){
                        betBoxFresh();
                        boxFresh();
                        zuiBoxFresh();
                        setMsg(data.data,data.info);
                        lotteryBetController.fresh();
                        $('.balance').html(data.money);
                        layer.msg(data.msg);
                    } else {
                        layer.msg(data.msg);
                    }
                },
                error: function (textStatus) {
                    console.log(textStatus);
                    layer.msg('服务器繁忙，请稍后再试');
                },
                complete: function(){
                    layer.close(index6);
                    setTimeout(function(){
                        zhuiCheck = true;
                    },3000); // 递归调用
                }
            });
        }else{
            layer.msg('请先创建追单');
        }
    }
    function getNewOpenList(cate) {
        $.get('/home/api/getNewOpenList', {cate: cate}, function (data) {
            if (data.code == 0) {
                var str = '';
                $.each(data.data,function (k,v) {
                    var str_a = '';
                    var sum = 0;
                    $.each(v.number.split(','),function (i,j) {
                        str_a+='<i class="round1" style="margin:0 5px;">'+j+'</i>+';
                        sum+=parseInt(j);
                    })
                    str_a=str_a.substr(0,(str_a.length-1));
                    str+='<p><span>第<i class="blue">'+v.stage+'</i>期</span>'+str_a+'<span>=</span><i class="round1" style="margin:0 5px;">'+sum+'</i><span>('+dxJudgment(14,sum)+','+dsJudgment(sum)+')</span></p>';
                })
                $("#openList").html(str);
            }
        })
    }
    getNewOpenList(cache);
    $(".list-empty").click(function () {
        $(".list-con").html('');
        getNotes();
    })
    function getNotes() {
        this.dom = $(".list-con p");
        this.notes = this.dom.length;
        var money = 0;
        $.each(this.dom,function (k,v) {
            money+=parseInt($(v).find('span').text());
        })
        $(".all").html('总计：'+money);
        $(".go").html('共：'+this.notes+'注');
    }
    function getBetNotes() {
        this.dom = $(".game-right").find('td.act');
        this.notes = this.dom.length;
        var money = parseInt($("#gold").val())*this.notes;
        $(".bet-notes").html(this.notes);
        $(".bet-money").html(money);
    }
    function boxFresh() {
        $('.list-con').html('');
        getNotes();
    }
    function zuiBoxFresh() {
        $("#zuiBox").html('');
        $('.tapb .tap-table').hide();
    }
    $('.game-left').off('click','a').on('click','a',function(){
        $(this).addClass('active');
        $(this).siblings().removeClass('active');
        this.name = $(this).html();
        this.way = $(this).attr('data-id');
        rules(2,this.way,this.name);
        return false;
    });
</script>