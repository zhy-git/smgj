<?php if (!defined('THINK_PATH')) exit(); /*a:6:{s:58:"/www/wwwroot/smgj/public/../app/home/view/msssc/index.html";i:1541053115;s:64:"/www/wwwroot/smgj/public/../app/home/view/common/detail_top.html";i:1539765119;s:62:"/www/wwwroot/smgj/public/../app/home/view/common/cate_top.html";i:1540435336;s:62:"/www/wwwroot/smgj/public/../app/home/view/common/siderbar.html";i:1539588229;s:60:"/www/wwwroot/smgj/public/../app/home/view/common/footer.html";i:1540262035;s:55:"/www/wwwroot/smgj/public/../app/home/view/msssc/js.html";i:1540433677;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="-1" />
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <link rel="shortcut icon" href="__IMG__/favicon.ico" />
    <link rel="bookmark" href="__IMG__/favicon.ico" type="image/x-icon" 　="" />
    <title>极速时时彩</title>
    <link rel="stylesheet" href="__CSS__/index.css" />
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
        .fengpan{color: rgb(170, 152, 152);}
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
        .bet-modal .u-btn1{
            background: linear-gradient(to bottom,#d87c86 0,#6a1f2d 100%);
            border: 1px solid #ab374a;
            color: #fff;
        }
    </style>
    <link type="text/css" rel="stylesheet" href="__CSS__/chat-index.css" />
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
                <img src="__IMG__/logo.png" alt="最专业彩票网" height="53" />
            </div>
            <div class="menu1">
                <div class="draw_number">
                    <div>
                        秒速时时彩
                    </div>
                    <div>
                        <span class="cur_turn_num"></span>期开奖
                    </div>
                </div>
                <div id="result_balls" class="T_SSC L_CQSSC" style="top:0;">
                    <span><b class="b0">0</b></span>
                    <span><b class="b0">0</b></span>
                    <span><b class="b0">0</b></span>
                    <span><b class="b0">0</b></span>
                    <span><b class="b0">0</b></span>
                </div>
                <div id="result-wrap" class="T_PK10">
                    <span class="resultData">小</span>
                    <span class="resultData">单</span>
                    <span class="resultData">虎</span>
                </div>
                <!--<div title="点击关闭提醒声音" class="open_sound"></div>-->
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
                <a href="<?php echo url('index',['cate'=>4,'hall'=>$hall]); ?>" class="router-link-exact-active selected">整合</a> |
                <a href="<?php echo url('index',['cate'=>4,'hall'=>$hall,'type'=>'ball']); ?>" class="">1~5</a> |
                <?php if($hall==1): ?>
                <a href="<?php echo url('index',['cate'=>4,'hall'=>2]); ?>" style="padding:2px 5px;background: green;border-radius: 5px;color: #fff;">切换B盘</a>
                <?php else: ?>
                <a href="<?php echo url('index',['cate'=>4,'hall'=>1]); ?>" style="padding:2px 5px;background: green;border-radius: 5px;color: #fff;">切换A盘</a>
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
                                    <span id="page_game_name">秒速时时彩</span>&nbsp;&nbsp;-&nbsp;&nbsp;
                                    <span id="page_name">整合</span>
                                    <!--<span id="total_sum_money_text"> &nbsp;&nbsp; 当前彩种输赢：<span id="total_sum_money">0.000</span> </span>-->
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
                                        <input type="number" class="bet-money" oninput="changeVale(this)" onpropertychange="changeVale(this)" maxlength="6" value=""/>
                                        <a href="javascript:void(0)" class="u-btn1 betTab">确定</a>
                                        <a href="javascript:void(0)" class="u-btn1 betReset">重置</a>
                                    </div>
                                </div>
                                <div>
                                    <div>
                                        <div class="cont-col3-bd">
                                            <table class="u-table2">
                                                <thead>
                                                <tr>
                                                    <th colspan="12" data-target-type="1">总和-龙虎和</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php if(is_array($rule_data['zh']) || $rule_data['zh'] instanceof \think\Collection || $rule_data['zh'] instanceof \think\Paginator): $i = 0; $__LIST__ = $rule_data['zh'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                                <tr>
                                                    <?php if(is_array($vo) || $vo instanceof \think\Collection || $vo instanceof \think\Paginator): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?>
                                                    <td data-id="<?php echo $v1['id']; ?>" class="name" data-num="<?php echo $v1['rule']; ?>"><?php echo $v1['rule']; ?></td>
                                                    <td data-id="<?php echo $v1['id']; ?>" class="odds"><span class="c-txt3"><?php echo $v1['rate']; ?></span></td>
                                                    <td data-id="<?php echo $v1['id']; ?>" class="amount"><input type="text" style="" /></td>
                                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                                </tr>
                                                <?php endforeach; endif; else: echo "" ;endif; ?>
                                                </tbody>
                                            </table>
                                            <table class="cont-list1">
                                                <tbody>
                                                <tr>
                                                    <?php if(is_array($rule_data['qiu']) || $rule_data['qiu'] instanceof \think\Collection || $rule_data['qiu'] instanceof \think\Paginator): $i = 0; $__LIST__ = $rule_data['qiu'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                                    <td>
                                                        <table class="u-table2">
                                                            <thead>
                                                            <tr>
                                                                <th colspan="3" data-target-type="<?php echo $vo['type']; ?>"><?php echo $vo['type_name']; ?></th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php if(is_array($vo['info']) || $vo['info'] instanceof \think\Collection || $vo['info'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['info'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?>
                                                            <tr>
                                                                <td data-id="<?php echo $v1['id']; ?>" class="name" data-num="<?php echo $v1['rule']; ?>"><?php echo $v1['rule']; ?></td>
                                                                <td data-id="<?php echo $v1['id']; ?>" class="odds"><span class="c-txt3"><?php echo $v1['rate']; ?></span></td>
                                                                <td data-id="<?php echo $v1['id']; ?>" class="amount"><input type="text" style="" /></td>
                                                            </tr>
                                                            <?php endforeach; endif; else: echo "" ;endif; ?>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <table class="u-table2" style="margin-top: 10px;">
                                                <thead>
                                                <tr>
                                                    <th colspan="15" data-target-type="7">前三</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <?php if(is_array($rule_data['qs']) || $rule_data['qs'] instanceof \think\Collection || $rule_data['qs'] instanceof \think\Paginator): $i = 0; $__LIST__ = $rule_data['qs'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                                    <td data-id="<?php echo $vo['id']; ?>" class="name" data-num="<?php echo $vo['rule']; ?>"><?php echo $vo['rule']; ?></td>
                                                    <td data-id="<?php echo $vo['id']; ?>" class="odds"><span class="c-txt3"><?php echo $vo['rate']; ?></span></td>
                                                    <td data-id="<?php echo $vo['id']; ?>" class="amount"><input type="text" style="" /></td>
                                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <table class="u-table2" style="margin-top: 10px;">
                                                <thead>
                                                <tr>
                                                    <th colspan="15" data-target-type="8">中三</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <?php if(is_array($rule_data['zs']) || $rule_data['zs'] instanceof \think\Collection || $rule_data['zs'] instanceof \think\Paginator): $i = 0; $__LIST__ = $rule_data['zs'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                                    <td data-id="<?php echo $vo['id']; ?>" class="name" data-num="<?php echo $vo['rule']; ?>"><?php echo $vo['rule']; ?></td>
                                                    <td data-id="<?php echo $vo['id']; ?>" class="odds"><span class="c-txt3"><?php echo $vo['rate']; ?></span></td>
                                                    <td data-id="<?php echo $vo['id']; ?>" class="amount"><input type="text" style="" /></td>
                                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <table class="u-table2" style="margin-top: 10px;">
                                                <thead>
                                                <tr>
                                                    <th colspan="15" data-target-type="9">后三</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <?php if(is_array($rule_data['hs']) || $rule_data['hs'] instanceof \think\Collection || $rule_data['hs'] instanceof \think\Paginator): $i = 0; $__LIST__ = $rule_data['hs'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                                    <td data-id="<?php echo $vo['id']; ?>" class="name" data-num="<?php echo $vo['rule']; ?>"><?php echo $vo['rule']; ?></td>
                                                    <td data-id="<?php echo $vo['id']; ?>" class="odds"><span class="c-txt3"><?php echo $vo['rate']; ?></span></td>
                                                    <td data-id="<?php echo $vo['id']; ?>" class="amount"><input type="text" style="" /></td>
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
                                        <input type="number" class="bet-money" oninput="changeVale(this)" onpropertychange="changeVale(this)" maxlength="6" value=""/>
                                        <a href="javascript:void(0)" class="u-btn1 betTab">确定</a>
                                        <a href="javascript:void(0)" class="u-btn1 betReset">重置</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="count-wrap">
                            <table id="stat_qiu" class="u-table2">
                                <thead>
                                <tr>
                                    <th class="u-tb3-th2 select" data-target="0">第一球</th>
                                    <th class="u-tb3-th2" data-target="1">第二球</th>
                                    <th class="u-tb3-th2" data-target="2">第三球</th>
                                    <th class="u-tb3-th2" data-target="3">第四球</th>
                                    <th class="u-tb3-th2" data-target="4">第五球</th>
                                </tr>
                                </thead>
                            </table>
                            <table class="u-table4 cl_table">
                                <tbody>
                                <tr>
                                    <td class="f1 fwb">0</td>
                                    <td class="f1 fwb">1</td>
                                    <td class="f1 fwb">2</td>
                                    <td class="f1 fwb">3</td>
                                    <td class="f1 fwb">4</td>
                                    <td class="f1 fwb">5</td>
                                    <td class="f1 fwb">6</td>
                                    <td class="f1 fwb">7</td>
                                    <td class="f1 fwb">8</td>
                                    <td class="f1 fwb">9</td>
                                </tr>
                                <tr>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                </tr>
                                </tbody>
                            </table>
                            <table class="u-table2 mt5">
                                <thead>
                                <tr id="stat_type">
                                    <th class="u-tb3-th2" data-target="ball">第一球</th>
                                    <th class="u-tb3-th2" data-target="dx"> 大小 </th>
                                    <th class="u-tb3-th2" data-target="ds"> 单双 </th>
                                    <th class="u-tb3-th2" data-target="zhdx"> 总和大小 </th>
                                    <th class="u-tb3-th2" data-target="zhds"> 总和单双 </th>
                                    <th class="u-tb3-th2" data-target="lhh"> 龙虎和 </th>
                                </tr>
                                </thead>
                            </table>
                            <div>
                                <table class="u-table4 table-td-valign-top">
                                    <tbody>
                                    <tr class="stattd cl_table2" v-html="stat_html">
                                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="cont-sider">
                        <div class="sider-box1 mt5">
                            <table class="u-table2">
                                <thead>
                                <tr>
                                    <th id="stat_play_list_desc">长龙排行榜</th>
                                </tr>
                                </thead>
                            </table>
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
            <div class="iframe_table">
                <iframe id="iframeMain" src="" width="1100" frameborder="0" scrolling="no"></iframe>
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
<div class="gameservice">
    <!---->
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
                url: "<?php echo url('Msssc/getStage'); ?>",
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
                                $('#result_balls span:eq('+k+') b').attr('class','b'+v);
                                $('#result_balls span:eq('+k+') b').html(v);
                                sum1+=parseInt(v);
                            })
                            $("#result-wrap span:eq(0)").html(dxJudgment(23,sum1));
                            $("#result-wrap span:eq(1)").html(dsJudgment(sum1));
                            $("#result-wrap span:eq(2)").html(lhhJudgment(number[0],number[4]));
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
                url: "<?php echo url('Api/checkOpenMsssc'); ?>",
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
                            $('#result_balls span:eq('+k+') b').attr('class','b'+v);
                            $('#result_balls span:eq('+k+') b').html(v);
                            sum1+=parseInt(v);
                        })
                        $("#result-wrap span:eq(0)").html(dxJudgment(23,sum1));
                        $("#result-wrap span:eq(1)").html(dsJudgment(sum1));
                        $("#result-wrap span:eq(2)").html(lhhJudgment(number[0],number[4]));
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
                var type = $(this).parent().prev().prev().find('span').html();
                if(!type){
                    type = $(this).parent().prev().prev().html();
                }
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
            $.each($('.cont-col3-bd .u-table2').find('td.odds'),function(k,v){
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
            $('#stageStatus').attr('data-status','off');
            $('.cont-col3-bd .u-table2 td').removeClass('bg_yellow');
        }else{
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
            dataIntegrationFun.dataIntegration(this);
        });
        $('#stat_type .u-tb3-th2').click(function(){
            $('#stat_type .u-tb3-th2').removeClass('select');
            $(this).addClass('select');
            dataIntegrationFun.dataIntegrationSpecial(this);
        });
        setTimeout(function () {
            timeCountDown.getTime("<?php echo $openStage; ?>","<?php echo $openNum; ?>");
            //lotteryBetController.oddsSet();
            $('#stat_qiu .u-tb3-th2:eq(0)').click();
            dataIntegrationFun.dataIntegrationCl();
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
    var dataIntegrationFun = {
        openList : <?php echo json_encode($openList); ?>,
        dataIntegrationSpecial : function(_this){
            var data = dataIntegrationFun.openList;
            var cl_table2_num = 24;
            var ballNum = $('#stat_qiu .u-tb3-th2.select').attr('data-target');
            $('.cl_table2 td').html('');
            switch ($(_this).attr('data-target')){
                case 'ball':
                    var pre = '';
                    $.each(data,function(k,v){
                        if(v['number'].length == 0){
                            return;
                        }
                        var openNumArr = [];
                        openNumArr = v['number'].split(',');
                        if(cl_table2_num>=0) {
                            var ty = openNumArr[ballNum];
                            if(pre == ty){
                                cl_table2_num = cl_table2_num + 1*1;
                                var cl_table2 = $('.cl_table2 td:eq('+cl_table2_num+')');
                                cl_table2.html(cl_table2.html()+'<br>'+ty);
                            }else{
                                var cl_table2 = $('.cl_table2 td:eq('+cl_table2_num+')');
                                cl_table2.html(ty);
                            }
                            pre = ty;
                            cl_table2_num = cl_table2_num-1;
                        }else{
                            return;
                        }
                    });
                    break;
                case 'dx':
                    var pre = '';
                    $.each(data,function(k,v){
                        if(v['number'].length == 0){
                            return;
                        }
                        var openNumArr = [];
                        openNumArr = v['number'].split(',');
                        if(cl_table2_num>=0) {
                            var ty = dxJudgment(5,openNumArr[ballNum]);
                            if(pre == ty){
                                cl_table2_num = cl_table2_num + 1*1;
                                var cl_table2 = $('.cl_table2 td:eq('+cl_table2_num+')');
                                cl_table2.html(cl_table2.html()+'<br>'+ty);
                            }else{
                                var cl_table2 = $('.cl_table2 td:eq('+cl_table2_num+')');
                                cl_table2.html(ty);
                            }
                            pre = ty;
                            cl_table2_num = cl_table2_num-1;
                        }else{
                            return;
                        }
                    });
                    break;
                case 'ds':
                    var pre = '';
                    $.each(data,function(k,v){
                        if(v['number'].length == 0){
                            return;
                        }
                        var openNumArr = [];
                        openNumArr = v['number'].split(',');
                        if(cl_table2_num>=0) {
                            var ty = dsJudgment(openNumArr[ballNum]);
                            if(pre == ty){
                                cl_table2_num = cl_table2_num + 1*1;
                                var cl_table2 = $('.cl_table2 td:eq('+cl_table2_num+')');
                                cl_table2.html(cl_table2.html()+'<br>'+ty);
                            }else{
                                var cl_table2 = $('.cl_table2 td:eq('+cl_table2_num+')');
                                cl_table2.html(ty);
                            }
                            pre = ty;
                            cl_table2_num = cl_table2_num-1;
                        }else{
                            return;
                        }
                    });
                    break;
                case 'zhdx':
                    var pre = '';
                    $.each(data,function(k,v){
                        if(v['number'].length == 0){
                            return;
                        }
                        var openNumArr = [];
                        openNumArr = v['number'].split(',');
                        if(cl_table2_num>=0) {
                            var ty = dxJudgment(23,sum(openNumArr));
                            if(pre == ty){
                                cl_table2_num = cl_table2_num + 1*1;
                                var cl_table2 = $('.cl_table2 td:eq('+cl_table2_num+')');
                                cl_table2.html(cl_table2.html()+'<br>'+ty);
                            }else{
                                var cl_table2 = $('.cl_table2 td:eq('+cl_table2_num+')');
                                cl_table2.html(ty);
                            }
                            pre = ty;
                            cl_table2_num = cl_table2_num-1;
                        }else{
                            return;
                        }
                    });
                    break;
                case 'zhds':
                    var pre = '';
                    $.each(data,function(k,v){
                        if(v['number'].length == 0){
                            return;
                        }
                        var openNumArr = [];
                        openNumArr = v['number'].split(',');
                        if(cl_table2_num>=0) {
                            var ty = dsJudgment(sum(openNumArr));
                            if(pre == ty){
                                cl_table2_num = cl_table2_num + 1*1;
                                var cl_table2 = $('.cl_table2 td:eq('+cl_table2_num+')');
                                cl_table2.html(cl_table2.html()+'<br>'+ty);
                            }else{
                                var cl_table2 = $('.cl_table2 td:eq('+cl_table2_num+')');
                                cl_table2.html(ty);
                            }
                            pre = ty;
                            cl_table2_num = cl_table2_num-1;
                        }else{
                            return;
                        }
                    });
                    break;
                default:
                    var pre = '';
                    $.each(data,function(k,v){
                        if(v['number'].length == 0){
                            return;
                        }
                        var openNumArr = [];
                        openNumArr = v['number'].split(',');
                        if(cl_table2_num>=0) {
                            var ty = lhhJudgment(openNumArr[0],openNumArr[4]);
                            if(pre == ty){
                                cl_table2_num = cl_table2_num + 1*1;
                                var cl_table2 = $('.cl_table2 td:eq('+cl_table2_num+')');
                                cl_table2.html(cl_table2.html()+'<br>'+ty);
                            }else{
                                var cl_table2 = $('.cl_table2 td:eq('+cl_table2_num+')');
                                cl_table2.html(ty);
                            }
                            pre = ty;
                            cl_table2_num = cl_table2_num-1;
                        }else{
                            return;
                        }
                    });
                    break;
            }

        },
        dataIntegration : function(_this) {
            var data = dataIntegrationFun.openList;
            var dataTarget = $(_this).attr('data-target');
            var returnData = [];
            returnData = [0,0,0,0,0,0,0,0,0,0];
            var cl_table2_num = 24;
            var preOpenNum = '';
            $.each(data,function(k,v){
                if(v['number'].length == 0){
                    return;
                }
                var openNumArr = [];
                openNumArr = v['number'].split(',');
                returnData[openNumArr[dataTarget]] = returnData[openNumArr[dataTarget]]*1+1*1;
                if(cl_table2_num>=0){
                    if(preOpenNum == openNumArr[dataTarget]){
                        cl_table2_num = cl_table2_num + 1*1;
                        var cl_table2 = $('.cl_table2 td:eq('+cl_table2_num+')');
                        cl_table2.html(cl_table2.html()+'<br>'+openNumArr[dataTarget]);
                    }else{
                        var cl_table2 = $('.cl_table2 td:eq('+cl_table2_num+')');
                        cl_table2.html(openNumArr[dataTarget]);
                    }
                    preOpenNum = openNumArr[dataTarget];
                    cl_table2_num = cl_table2_num-1;
                }
            })
            $.each($('.cl_table tr:eq(1) td'),function(k,v){
                $(v).html(returnData[k]);
            })
        },
        dataIntegrationCl : function(){
            var openNumArrOld = dataIntegrationFun.openList;
            var ydx='',
                yds='',
                edx='',
                eds='',
                sdx='',
                sds='',
                sidx='',
                sids='',
                wdx='',
                wds='',
                zhdx='',
                zhds='',
                zhlh='',
                clArr = [],
                fData = [];
            clArr['ydx'] = 1;
            clArr['yds'] = 1;
            clArr['edx'] = 1;
            clArr['eds'] = 1;
            clArr['sdx'] = 1;
            clArr['sds'] = 1;
            clArr['sidx'] = 1;
            clArr['sids'] = 1;
            clArr['wdx'] = 1;
            clArr['wds'] = 1;
            clArr['zhdx'] = 1;
            clArr['zhds'] = 1;
            clArr['zhlh'] = 1;
            $.each(openNumArrOld,function(k,v){
                if(v['number'].length == 0){
                    return;
                }
                var openNumArr = [];
                openNumArr = v['number'].split(',');
                if(ydx) {
                    if (clArr['ydx'] != 0) {
                        if (ydx == dxJudgment(5, openNumArr[0])) {
                            clArr['ydx']++;
                            if(clArr['ydx']>=3){
                                fData[0] = [];
                                fData[0]['num'] = clArr['ydx'];
                                fData[0]['name'] = '第一球';
                                fData[0]['type'] = ydx;
                            }
                        } else {
                            clArr['ydx'] = 0;
                        }
                    }
                    if (clArr['yds'] != 0) {
                        if (yds == dsJudgment(openNumArr[0])) {
                            clArr['yds']++;
                            if(clArr['yds']>=3){
                                fData[1] = [];
                                fData[1]['num'] = clArr['yds'];
                                fData[1]['name'] = '第一球';
                                fData[1]['type'] = yds;
                            }
                        } else {
                            clArr['yds'] = 0;
                        }
                    }
                    if (clArr['edx'] != 0) {
                        if (edx == dxJudgment(5, openNumArr[1])) {
                            clArr['edx']++;
                            if(clArr['edx']>=3){
                                fData[2] = [];
                                fData[2]['num'] = clArr['edx'];
                                fData[2]['name'] = '第二球';
                                fData[2]['type'] = edx;
                            }
                        } else {
                            clArr['edx'] = 0;
                        }
                    }
                    if (clArr['eds'] != 0) {
                        if (eds == dsJudgment(openNumArr[1])) {
                            clArr['eds']++;
                            if(clArr['eds']>=3){
                                fData[3] = [];
                                fData[3]['num'] = clArr['eds'];
                                fData[3]['name'] = '第二球';
                                fData[3]['type'] = eds;
                            }
                        } else {
                            clArr['eds'] = 0;
                        }
                    }
                    if (clArr['sdx'] != 0) {
                        if (sdx == dxJudgment(5, openNumArr[2])) {
                            clArr['sdx']++;
                            if(clArr['sdx']>=3){
                                fData[4] = [];
                                fData[4]['num'] = clArr['sdx'];
                                fData[4]['name'] = '第三球';
                                fData[4]['type'] = sdx;
                            }
                        } else {
                            clArr['sdx'] = 0;
                        }
                    }
                    if (clArr['sds'] != 0) {
                        if (sds == dsJudgment(openNumArr[2])) {
                            clArr['sds']++;
                            if(clArr['sds']>=3){
                                fData[5] = [];
                                fData[5]['num'] = clArr['sds'];
                                fData[5]['name'] = '第三球';
                                fData[5]['type'] = sds;
                            }
                        } else {
                            clArr['sds'] = 0;
                        }
                    }
                    if (clArr['sidx'] != 0) {
                        if (sidx == dxJudgment(5, openNumArr[3])) {
                            clArr['sidx']++;
                            if(clArr['sidx']>=3){
                                fData[6] = [];
                                fData[6]['num'] = clArr['sidx'];
                                fData[6]['name'] = '第四球';
                                fData[6]['type'] = sidx;
                            }
                        } else {
                            clArr['sidx'] = 0;
                        }
                    }
                    if (clArr['sids'] != 0) {
                        if (sids == dsJudgment(openNumArr[3])) {
                            clArr['sids']++;
                            if(clArr['sids']>=3){
                                fData[7] = [];
                                fData[7]['num'] = clArr['sids'];
                                fData[7]['name'] = '第四球';
                                fData[7]['type'] = sids;
                            }
                        } else {
                            clArr['sids'] = 0;
                        }
                    }
                    if (clArr['wdx'] != 0) {
                        if (wdx == dxJudgment(5, openNumArr[4])) {
                            clArr['wdx']++;
                            if(clArr['wdx']>=3){
                                fData[8] = [];
                                fData[8]['num'] = clArr['wdx'];
                                fData[8]['name'] = '第五球';
                                fData[8]['type'] = wdx;
                            }
                        } else {
                            clArr['wdx'] = 0;
                        }
                    }
                    if (clArr['wds'] != 0) {
                        if (wds == dsJudgment(openNumArr[4])) {
                            clArr['wds']++;
                            if(clArr['wds']>=3){
                                fData[9] = [];
                                fData[9]['num'] = clArr['wds'];
                                fData[9]['name'] = '第五球';
                                fData[9]['type'] = wds;
                            }
                        } else {
                            clArr['wds'] = 0;
                        }
                    }
                    if (clArr['zhdx'] != 0) {
                        if (zhdx == dxJudgment(23, sum(openNumArr))) {
                            clArr['zhdx']++;
                            if(clArr['zhdx']>=3){
                                fData[10] = [];
                                fData[10]['num'] = clArr['zhdx'];
                                fData[10]['name'] = '总和-龙虎和';
                                fData[10]['type'] = zhdx;
                            }
                        } else {
                            clArr['zhdx'] = 0;
                        }
                    }
                    if (clArr['zhds'] != 0) {
                        if (zhds == dsJudgment(sum(openNumArr))) {
                            clArr['zhds']++;
                            if(clArr['zhds']>=3){
                                fData[11] = [];
                                fData[11]['num'] = clArr['zhds'];
                                fData[11]['name'] = '总和-龙虎和';
                                fData[11]['type'] = zhds;
                            }
                        } else {
                            clArr['zhds'] = 0;
                        }
                    }
                    if (clArr['zhlh'] != 0) {
                        if (zhlh == lhhJudgment(openNumArr[0], openNumArr[4])) {
                            clArr['zhlh']++;
                            if(clArr['zhlh']>=3){
                                fData[12] = [];
                                fData[12]['num'] = clArr['zhlh'];
                                fData[12]['name'] = '总和-龙虎和';
                                fData[12]['type'] = zhlh;
                            }
                        } else {
                            clArr['zhlh'] = 0;
                        }
                    }
                }
                ydx = dxJudgment(5,openNumArr[0]);
                yds = dsJudgment(openNumArr[0]);
                edx = dxJudgment(5,openNumArr[1]);
                eds = dsJudgment(openNumArr[1]);
                sdx = dxJudgment(5,openNumArr[2]);
                sds = dsJudgment(openNumArr[2]);
                sidx = dxJudgment(5,openNumArr[3]);
                sids = dsJudgment(openNumArr[3]);
                wdx = dxJudgment(5,openNumArr[4]);
                wds = dsJudgment(openNumArr[4]);
                zhdx = dxJudgment(23,sum(openNumArr));
                zhds = dsJudgment(sum(openNumArr));
                zhlh = lhhJudgment(openNumArr[0],openNumArr[4]);
                //sum(openNumArr)
            })
            var str = '';
            $.each(fData,function(k,v){
                if(v) {
                    str += '<tr class="u-tb5-tr1">';
                    str += '<th>'+v.name+' - '+v.type+'</th>';
                    str += '<td class="statFont">'+v.num+'期</td></tr>';
                }
            });

            if(str.length){

            }else{
                str += '<tr class="u-tb5-tr1">';
                str += '<td class="statFont" style="text-align: center;" colspan="2">暂无排行数据</td></tr>';
            }
            $('#stat_play_list').html(str);
        }
    }
    function sum(arr) {
        return eval(arr.join("+"));
    };
</script>
</body>
</html>