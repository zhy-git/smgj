<?php if (!defined('THINK_PATH')) exit(); /*a:7:{s:58:"/www/wwwroot/smgj/public/../app/home/view/xglhc/index.html";i:1540461497;s:64:"/www/wwwroot/smgj/public/../app/home/view/common/detail_top.html";i:1539765119;s:62:"/www/wwwroot/smgj/public/../app/home/view/common/cate_top.html";i:1540435336;s:62:"/www/wwwroot/smgj/public/../app/home/view/common/siderbar.html";i:1539588229;s:65:"/www/wwwroot/smgj/public/../app/home/view/xglhc/integration2.html";i:1523368392;s:60:"/www/wwwroot/smgj/public/../app/home/view/common/footer.html";i:1540262035;s:55:"/www/wwwroot/smgj/public/../app/home/view/xglhc/js.html";i:1539568027;}*/ ?>
<!DOCTYPE html>
<!-- saved from url=(0026)https://www.mtc9.com/game/ -->
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta HTTP-EQUIV="Pragma" CONTENT="no-cache">
    <meta HTTP-EQUIV="Expires" CONTENT="-1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <link rel="shortcut icon" href="__IMG__/favicon.ico" />
    <link rel="bookmark" href="__IMG__/favicon.ico" type="image/x-icon"　/>
    <script src="__JS__/jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="__JS__/jquery.validate.min.js"></script>
    <script src="__JS__/layer3.1/layer.js" ></script>
    <script src="__JS__/common.js" ></script>
    <title>香港六合彩</title>
    <link rel="stylesheet" href="__CSS__/index.css">
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
    <link type="text/css" rel="stylesheet" href="__CSS__/chat-index.css"></head>
<body>
<div id="appLoading" class="bet-loading" style="position: fixed; width: 100%; top: 200px; text-align: center; z-index: 3000; display: none;">
    <div class="spinner"><div class="three-bounce"><div class="one"></div><div class="two"></div><div class="three"></div></div></div>
</div>
<div class="main-body skin_red" style="right: 0px;">
    <div class="header">
        <div class="header-top clearfix"><div class="logo2"><img src="__IMG__/logo.png" alt="最专业彩票网" height="53"></div>
            <div class="menu1">
                <div class="draw_number">
                    <div>香港六合彩</div>
                    <div><span class="cur_turn_num"></span>期开奖</div>
                </div>
                <div id="result_balls" class="T_HK6 L_HK6">
                    <span><b class="b27">27</b> <i>羊</i></span> <!---->
                    <span><b class="b37">37</b> <i>鸡</i></span> <!---->
                    <span><b class="b02">02</b> <i>猴</i></span> <!---->
                    <span><b class="b36">36</b> <i>狗</i></span> <!---->
                    <span><b class="b21">21</b> <i>牛</i></span> <!---->
                    <span><b class="b30">30</b> <i>龙</i></span>
                    <span class="plus">+</span>
                    <span><b class="b04">04</b> <i>马</i></span> <!---->
                </div>
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
            <a href="<?php echo url('index',['cate'=>8,'hall'=>1]); ?>" class="router-link-exact-active selected">特码</a> |
            <a href="<?php echo url('index',['cate'=>8,'hall'=>1,'type'=>'two']); ?>" class="">两面盘</a> |
            <a href="<?php echo url('index',['cate'=>8,'hall'=>1,'type'=>'seven']); ?>" class="">正码</a> |
            <a href="<?php echo url('index',['cate'=>8,'hall'=>1,'type'=>'eight']); ?>" class="">正码特</a> |
            <a href="<?php echo url('index',['cate'=>8,'hall'=>1,'type'=>'nine']); ?>" class="">正码1~6</a> |
            <a href="<?php echo url('index',['cate'=>8,'hall'=>1,'type'=>'seventeen']); ?>" class="">连码</a> |
            <a href="<?php echo url('index',['cate'=>8,'hall'=>1,'type'=>'sixteen']); ?>" class="">连肖</a> |
            <a href="<?php echo url('index',['cate'=>8,'hall'=>1,'type'=>'eighteen']); ?>" class="">连尾</a> |
            <a href="<?php echo url('index',['cate'=>8,'hall'=>1,'type'=>'fifteen']); ?>" class="">自选不中</a> |
            <a href="<?php echo url('index',['cate'=>8,'hall'=>1,'type'=>'five']); ?>" class="">合肖</a> |
            <a href="<?php echo url('index',['cate'=>8,'hall'=>1,'type'=>'three']); ?>" class="">生肖、波色</a> |
            <a href="<?php echo url('index',['cate'=>8,'hall'=>1,'type'=>'eleven']); ?>" class="">平特一肖/尾数</a> |
            <a href="<?php echo url('index',['cate'=>8,'hall'=>1,'type'=>'twelve']); ?>" class="">正肖</a> |
            <!--<a href="<?php echo url('index?type=ten'); ?>" class="">五行</a> |-->
        </div>
    </div>
</div>
    <div class="main-wrap"><!---->
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
                                    <span id="page_game_name">香港六合彩</span>&nbsp;&nbsp;-&nbsp;&nbsp;
                                    <span id="page_name">特码</span>
                                    <!--<span id="total_sum_money_text">当前彩种输赢：<span id="total_sum_money">0.000</span></span>-->
                                </div>
                                <div class="fr">
                                    <span id="stageStatus" data-status="off" style="display: none;"></span>
                                    <span id="next_turn_num"></span>&nbsp;期 距离封盘：
                                    <span id="bet-date">00:00:00</span> 距离开奖：
                                    <span id="open-date">00:00:00</span>
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
                                <div id="betTable">
                                    <div>
                                        <!--<div>-->
                                            <!--<div align="right" class="clearfix">-->
                                                <!--<button class="button">快捷投注</button>-->
                                            <!--</div>-->
                                        <!--</div>-->
                                        <ul class="tab" style="height: 35px;">
                                            <li class="tab_title02">
                                                <a href="<?php echo url('index',['cate'=>8,'hall'=>1]); ?>" class="<?php echo $hall==1?'on':''; ?>" name="temaA">特码A</a>
                                                <!--<a href="<?php echo url('index',['cate'=>8,'hall'=>2]); ?>" class="<?php echo $hall==2?'on':''; ?>" name="temaB">特码B</a>-->
                                            </li>
                                        </ul>
                                        <div class="tab_on ">
                                            <table class="u-table2 tab_on_one">
                                                <thead>
                                                <tr>
                                                    <th>号码</th>
                                                    <th>赔率</th>
                                                    <th>金额</th>
                                                    <th>号码</th>
                                                    <th>赔率</th>
                                                    <th>金额</th>
                                                    <th>号码</th>
                                                    <th>赔率</th>
                                                    <th>金额</th>
                                                    <th>号码</th>
                                                    <th>赔率</th>
                                                    <th>金额</th>
                                                    <th>号码</th>
                                                    <th>赔率</th>
                                                    <th>金额</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php if(is_array($rule_data['tmsz']) || $rule_data['tmsz'] instanceof \think\Collection || $rule_data['tmsz'] instanceof \think\Paginator): $i = 0; $__LIST__ = $rule_data['tmsz'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                                <tr data-target-type="1" data-target-num="特码">
                                                    <?php if(is_array($vo) || $vo instanceof \think\Collection || $vo instanceof \think\Paginator): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?>
                                                        <td data-id="<?php echo $v1['id']; ?>" data-num="<?php echo str_pad($v1['rule'],2,'0',STR_PAD_LEFT); ?>" class="name"><i class="lhc_icon lhc_b<?php echo str_pad($v1['rule'],2,'0',STR_PAD_LEFT); ?>"><?php echo str_pad($v1['rule'],2,'0',STR_PAD_LEFT); ?></i></td>
                                                        <td data-id="<?php echo $v1['id']; ?>" class="odds"><span class="c-txt3"><?php echo $v1['rate']; ?></span></td>
                                                        <td data-id="<?php echo $v1['id']; ?>" class="amount"><input type="text" /></td>
                                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                                </tr>
                                                <?php endforeach; endif; else: echo "" ;endif; ?>
                                                </tbody>
                                            </table>
                                            <table class="u-table2 mt10">
                                                <thead>
                                                <tr>
                                                    <th>号码</th>
                                                    <th>赔率</th>
                                                    <th>金额</th>
                                                    <th>号码</th>
                                                    <th>赔率</th>
                                                    <th>金额</th>
                                                    <th>号码</th>
                                                    <th>赔率</th>
                                                    <th>金额</th>
                                                    <th>号码</th>
                                                    <th>赔率</th>
                                                    <th>金额</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php if(is_array($rule_data['tmlm']) || $rule_data['tmlm'] instanceof \think\Collection || $rule_data['tmlm'] instanceof \think\Paginator): $i = 0; $__LIST__ = $rule_data['tmlm'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                                <tr data-target-type="1" data-target-num="特码">
                                                    <?php if(is_array($vo) || $vo instanceof \think\Collection || $vo instanceof \think\Paginator): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?>
                                                    <td data-id="<?php echo $v1['id']; ?>" data-num="<?php echo $v1['rule']; ?>" class="name"><?php echo $v1['rule']; ?></td>
                                                    <td data-id="<?php echo $v1['id']; ?>" class="odds"><span class="c-txt3"><?php echo $v1['rate']; ?></span></td>
                                                    <td data-id="<?php echo $v1['id']; ?>" class="amount"><input type="text" /></td>
                                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                                </tr>
                                                <?php endforeach; endif; else: echo "" ;endif; ?>
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
                    </div>
                    <!--<div class="cont-sider">-->
    <!--<div class="sider-box1 mt5">-->
        <!--<table class="u-table2">-->
            <!--<thead>-->
            <!--<tr>-->
                <!--<th id="stat_play_list_desc">长龙排行榜</th>-->
            <!--</tr>-->
            <!--</thead>-->
        <!--</table>-->
        <!--<table class="u-table5">-->
            <!--<tbody id="stat_play_list">-->
            <!--<tr class="u-tb5-tr1">-->
                <!--<th>   特小</th>-->
                <!--<td class="statFont">3期</td>-->
            <!--</tr>-->
            <!--<tr class="u-tb5-tr2"><th>   总和单</th>-->
                <!--<td class="statFont">3期</td></tr> &lt;!&ndash;&ndash;&gt;-->
            <!--</tbody>-->
        <!--</table>-->
    <!--</div>-->
<!--</div>-->
                </div>
            </div>
            <div class="iframe_table">
                <iframe id="iframeMain" src="" width="1100"  frameborder="0" scrolling="no" id="test" ></iframe>
            </div>
        </div>

    </div>
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
</div>
<div class="gameservice"><!----></div>
<script src="__JS__/tab.js" type="text/javascript" charset="utf-8"></script>
<script>
    var cate=<?php echo $cate; ?>,hall=<?php echo $hall; ?>,betType="<?php echo $template; ?>";
    var timeCountDown = {
        getWinMessage : true,
        longPollingCheck : true,
        timeLapse : '',
        getCountDown:function(t,ts){
            var day = Math.floor(t / 1000 / 60 / 60 / 24 % 365); //计算天
            var hour = Math.floor(t / 1000 / 60 / 60 % 24); //计算时
            var min = Math.floor(t / 1000 / 60 % 60); //计算分
            var sec = Math.floor(t / 1000 % 60);      //计算秒
            var ts_day = Math.floor(ts / 1000 / 60 / 60 / 24 % 365); //计算天
            var ts_hour = Math.floor(ts / 1000 / 60 / 60 % 24); //计算时
            var ts_min = Math.floor(ts / 1000 / 60 % 60); //计算分
            var ts_sec = Math.floor(ts / 1000 % 60);      //计算秒
            if (t >= 3600000) {
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
                $('#open-date').html(day + '天 ' + hour + ':' + min + ':' + sec);
                $('#bet-date').html(ts_day + '天 ' + ts_hour + ':' + ts_min + ':' + ts_sec);
            } else if (t >= 0) {
                if (t <= 30000) {    //30s后封盘
                    $('#fd').html('已封单').css('visibility', 'inherit');
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
                $('#open-date').html(day + '天 ' + hour + ':' + min + ':' + sec);
                $('#bet-date').html(ts_day + '天 ' + ts_hour + ':' + ts_min + ':' + ts_sec);
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
                url: "<?php echo url('Xglhc/getStage'); ?>",
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
                            var nArr = n.split(',')
                            $.each(nArr,function(k,v){
                                $('#result_balls span:eq('+k+') b').attr('class','b'+v);
                                $('#result_balls span:eq('+k+') b').html(v);
                                $('#result_balls span:eq('+k+') i').html(getShuXiang(v));
                            })
                            $('#result_balls span:eq(7) b').attr('class','b'+nArr[6]);
                            $('#result_balls span:eq(7) i').html(getShuXiang(nArr[6]));
                            $('.cur_turn_num').html(openStage);
                        }
                        $('#next_turn_num').html(data.stage_next);
                        var t = data.dateline * 1000;
                        var ts = (data.dateline - 300) * 1000;
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
                url: "<?php echo url('Api/checkOpenXglhc'); ?>",
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
                        $.each(data.number.split(','),function(k,v){
                            $('#result_balls span:eq('+k+') b').attr('class','b'+v);
                            $('#result_balls span:eq('+k+') b').html(v);
                            $('#result_balls span:eq('+k+') i').html(getShuXiang(v));
                        })
                        $('#result_balls span:eq(6) b').attr('class','b'+nArr[6]);
                        $('#result_balls span:eq(7) i').html(getShuXiang(nArr[6]));
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
            var limitNum = 0;
            switch(betType){
                case 'five':
                    if($("#changeTab .checkbox_td input:checked").length<2){
                        pop('下注内容不正确，请重新下注单');
                        return;
                    }
                    break;
                case 'fifteen':
                    var titleType = $("#changeTitle a.on").attr('data-id');
                    switch (titleType){
                        case '18':
                            limitNum = 5;
                            break;
                        case '19':
                            limitNum = 6;
                            break;
                        case '20':
                            limitNum = 7;
                            break;
                        case '21':
                            limitNum = 8;
                            break;
                        case '22':
                            limitNum = 9;
                            break;
                        case '23':
                            limitNum = 10;
                            break;
                        case '24':
                            limitNum = 11;
                            break;
                        case '25':
                            limitNum = 12;
                            break;
                        default:
                            break;
                    }
                    if($("#changeTab .checkbox_td input:checked").length<limitNum){
                        pop('下注内容不正确，请重新下注单');
                        return;
                    }
                    break;
                case 'seventeen':
                    var titleType = $("#changeTitle a.on").attr('data-id');
                    switch (titleType){
                        case '34':
                        case '35':
                            limitNum=3;
                            break;
                        case '36':
                        case "37":
                        case "38":
                            limitNum=2;
                            break;
                        default:
                            break;
                    }
                    if($("#changeTab .checkbox_td input:checked").length<limitNum){
                        pop('下注内容不正确，请重新下注单');
                        return;
                    }
                    break;
                case 'sixteen':
                case 'eighteen':
                    var titleType = $("#changeTitle a.on").attr('data-id');
                    switch (titleType){
                        case '10':
                        case '14':
                            limitNum=2;
                            break;
                        case '11':
                        case '15':
                            limitNum=3;
                            break;
                        case '12':
                        case '16':
                            limitNum=4;
                            break;
                        case "13":
                        case '17':
                            limitNum=5;
                            break;
                        default:
                            break;
                    }
                    if($("#changeTab .checkbox_td input:checked").length<limitNum){
                        pop('下注内容不正确，请重新下注单');
                        return;
                    }
                    break;
                default:
                    if(!$('#betTable .amount.bg_yellow').length){
                        pop('下注内容不正确，请重新下注单');
                        return;
                    }
                    break;
            }
            var str = '';
            var totalMoney = 0;
            var totalBet = 0;
            switch (betType){
                case 'seventeen':
                case 'fifteen':
                    var title = $("#changeTitle a.on").attr('data-num');
                    var titleType = $("#changeTitle a.on").attr('data-id');
                    var unitPrice = $("#changeTitle a.on").attr('data-odds');
                    var money = $(".bet-money").val();
                    var ruleArr = [];
                    $.each($("#changeTab .checkbox_td input:checked"),function (k,v) {
                        ruleArr.push($(v).attr('data-num'));
                    });
                    var ruleData = permutations(ruleArr,limitNum);
                    $.each(ruleData,function (i,j) {
                        var type = j.join(',');
                        str += '<tr><td class="multiple" data-target-type="'+titleType+'" data-target-num="'+type+'" style="text-align: left; padding-left: 5px;">'+title+'  '+type+' </td>';
                        str += '<td><span class="c-txt3">'+unitPrice+'</span></td>';
                        str += '<td><input type="number" oninput="lotteryBetController.betTabChangeVale(this)" onpropertychange="lotteryBetController.betTabChangeVale(this)" class="el-tooltip" value="'+money+'" style="width: 85%;"></td>';
                        str += '<td><input type="checkbox" onclick="lotteryBetController.betTabCheck(this)" checked></td></tr>';
                        totalMoney = totalMoney*1 + money*1;
                        totalBet ++;
                    })
                    break;
                case 'sixteen':
                case 'eighteen':
                    var title = $("#changeTitle a.on").attr('data-num');
                    var titleType = $("#changeTitle a.on").attr('data-id');
                    var money = $(".bet-money").val();
                    var ruleArr = [];
                    var unitPrice=0;
                    $.each($("#changeTab .checkbox_td input:checked"),function (k,v) {
                        unitPrice= $(v).parent().attr('data-odds');
                        ruleArr.push($(v).parent().attr('data-num'));
                    });
                    var ruleData = permutations(ruleArr,limitNum);
                    $.each(ruleData,function (i,j) {
                        var type = j.join(',');
                        str += '<tr><td class="multiple" data-target-type="'+titleType+'" data-target-num="'+type+'" style="text-align: left; padding-left: 5px;">'+title+'  '+type+' </td>';
                        str += '<td><span class="c-txt3">'+unitPrice+'</span></td>';
                        str += '<td><input type="number" oninput="lotteryBetController.betTabChangeVale(this)" onpropertychange="lotteryBetController.betTabChangeVale(this)" class="el-tooltip" value="'+money+'" style="width: 85%;"></td>';
                        str += '<td><input type="checkbox" onclick="lotteryBetController.betTabCheck(this)" checked></td></tr>';
                        totalMoney = totalMoney*1 + money*1;
                        totalBet ++;
                    });
                    break;
                case 'five':
                    var title = $("#changeTab").attr('data-target-num');
                    var titleType = $("#changeTab").attr('data-target-type');
                    var unitPrice = $("#oddsSpan").text();
                    var money = $(".bet-money").val();
                    var ruleArr = [];
                    $.each($("#changeTab .checkbox_td input:checked"),function (k,v) {
                        ruleArr.push($(v).parent().attr('data-num'));
                    });
                    var type = ruleArr.join(',');
                    str += '<tr><td class="multiple" data-target-type="'+titleType+'" data-target-num="'+type+'" style="text-align: left; padding-left: 5px;">'+title+'  '+type+' </td>';
                    str += '<td><span class="c-txt3">'+unitPrice+'</span></td>';
                    str += '<td><input type="number" oninput="lotteryBetController.betTabChangeVale(this)" onpropertychange="lotteryBetController.betTabChangeVale(this)" class="el-tooltip" value="'+money+'" style="width: 85%;"></td>';
                    str += '<td><input type="checkbox" onclick="lotteryBetController.betTabCheck(this)" checked></td></tr>';
                    totalMoney = totalMoney*1 + money*1;
                    totalBet ++;
                    break;
                default:
                    $.each($('#betTable .amount.bg_yellow input'),function(){
                        var title = $(this).parent().parent().attr('data-target-num');
                        var titleType =$(this).parent().parent().attr('data-target-type');
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
                    break;
            }
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
            $('#betTable .amount input').val('');
            $('#betTable table tr td').removeClass('bg_yellow');
            $('.checkbox_td').find('input').prop('checked',false);
        },
        setOrder : function (){
            if(!lotteryBetController.setOrderCheck){
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
            var bcountVal = $("#bcountVal").text();
            console.log(bcountVal);
            if(bcountVal>100){
                pop('单次最多可下注100组');
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
            $.each($('#betTable .u-table2').find('td.odds'),function(k,v){
                var play_id = $(v).attr('data-id');
                if(play_id){
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
            $('#betTable .amount input').attr('readonly',true);
            $('#betTable .amount input').addClass('fengpan');
            $('#betTable .u-table2 td.odds span').html('--');
            $('#betTable .u-table2 td.amount input').val('封盘');
            $('#stageStatus').attr('data-status','off');
            $('#betTable .u-table2 td').removeClass('bg_yellow');
        }else{
            $('#stageStatus').attr('data-status','on');
            $('#betTable .amount input').attr('readonly',false);
            $('#betTable .amount input').removeClass('fengpan');
            $('#betTable .u-table2 td.amount input').val('');
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
            //lotteryBetController.oddsSet();
            $('#stat_qiu .u-tb3-th2:eq(0)').click();
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
            $('#betTable .amount.bg_yellow input').val(val);
        }else{
            $('.bet-money').val(val.slice(0,6));
            $('#betTable .amount.bg_yellow input').val(val.slice(0,6));
        }
    }
    function getShuXiang(num){
        var shuxing = [];
        shuxing['01'] = '狗';shuxing['13'] = '狗';shuxing['25'] = '狗';shuxing['37'] = '狗';shuxing['49'] = '狗';
        shuxing['02'] = '鸡';shuxing['14'] = '鸡';shuxing['26'] = '鸡';shuxing['38'] = '鸡';shuxing['50'] = '鸡';
        shuxing['03'] = '猴';shuxing['15'] = '猴';shuxing['27'] = '猴';shuxing['39'] = '猴';shuxing['51'] = '猴';
        shuxing['04'] = '羊';shuxing['16'] = '羊';shuxing['28'] = '羊';shuxing['40'] = '羊';shuxing['52'] = '羊';
        shuxing['05'] = '马';shuxing['17'] = '马';shuxing['29'] = '马';shuxing['41'] = '马';shuxing['53'] = '马';
        shuxing['06'] = '蛇';shuxing['18'] = '蛇';shuxing['30'] = '蛇';shuxing['42'] = '蛇';shuxing['54'] = '蛇';
        shuxing['07'] = '龙';shuxing['19'] = '龙';shuxing['31'] = '龙';shuxing['43'] = '龙';shuxing['55'] = '龙';
        shuxing['08'] = '兔';shuxing['20'] = '兔';shuxing['32'] = '兔';shuxing['44'] = '兔';shuxing['56'] = '兔';
        shuxing['09'] = '虎';shuxing['21'] = '虎';shuxing['33'] = '虎';shuxing['45'] = '虎';shuxing['57'] = '虎';
        shuxing['10'] = '牛';shuxing['22'] = '牛';shuxing['34'] = '牛';shuxing['46'] = '牛';shuxing['58'] = '牛';
        shuxing['11'] = '鼠';shuxing['23'] = '鼠';shuxing['35'] = '鼠';shuxing['47'] = '鼠';shuxing['59'] = '鼠';
        shuxing['12'] = '猪';shuxing['24'] = '猪';shuxing['36'] = '猪';shuxing['48'] = '猪';shuxing['60'] = '猪';
        return shuxing[num];
    }
</script>
</body>
</html>