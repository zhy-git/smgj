<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:72:"E:\phpStudy\PHPTutorial\WWW\smgj\public/../app/wap/view/xglhc\index.html";i:1540625222;s:76:"E:\phpStudy\PHPTutorial\WWW\smgj\public/../app/wap/view/common\bet_list.html";i:1523368392;s:72:"E:\phpStudy\PHPTutorial\WWW\smgj\public/../app/wap/view/common\menu.html";i:1523368392;s:69:"E:\phpStudy\PHPTutorial\WWW\smgj\public/../app/wap/view/xglhc\js.html";i:1540793230;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>六合彩</title>
    <script src="__JS__/wap/mui.min.js"></script>
    <link href="__CSS__/wap/mui.min.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="__CSS__/wap/swiper.min.css"/>
    <link rel="stylesheet" type="text/css" href="__CSS__/wap/common.css"/>
    <link rel="stylesheet" type="text/css" href="__CSS__/wap/index.css"/>
    <script src="__JS__/wap/jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="__JS__/jquery.validate.min.js"></script>
    <script src="__JS__/layer.js" ></script>
    <script src="__JS__/common.js" ></script>
    <script type="text/javascript" charset="utf-8">
        mui.init();
    </script>
    <style>
        .lhc_show{
            display: block;
        }
        .lhc_hide{
            display: none;
        }
    </style>
</head>
<body style="background: #F1F1F1;">
<div class="main">
    <header class="mui-bar mui-bar-nav mui-clearfix">
        <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
        <h1 class="mui-title mui-pull-left">
            <span class="left">六合彩</span>
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
                <!--<li><a href="<?php echo url('Report/openResult',array('cate_id'=>9)); ?>"> 开奖结果</a></li>-->
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
        <div class="game_box2 padding_tb10 bor_bd7 six_lottery">
            <div class="clearfix ">
                <p class="left game_B2L cur_turn_num">2018109期</p>
                <div class="left game_B2R" id="result_balls">
                    <p>
                        <i class="ball bg_red">18</i>
                        <i class="ball bg_blue">26</i>
                        <i class="ball bg_red">19</i>
                        <i class="ball bg_red">07</i>
                        <i class="ball bg_green">39</i>
                        <i class="ball bg_green">27</i>
                        <span class="color_ff h3">+</span>
                        <i class="ball bg_red">02</i>
                    </p>
                    <p class="mg_top5">
                        <i class="squal1">龙</i>
                        <i class="squal1">鼠</i>
                        <i class="squal1">龙</i>
                        <i class="squal1">鸡</i>
                        <i class="squal1">马</i>
                        <i class="squal1 mg_r10">蛇</i>
                        <i class="squal1 mg_left10">马</i>
                    </p>
                </div>
            </div>
        </div>
        <div class="game_box2 padding_tb10 bor_bd7 six_lottery">
            <div class="clearfix ">
                <p class="left game_B2L" id="next_turn_num">2018109期</p>
                <div class="left game_B2R">
                    <div class="clearfix left">
                        <span class="left lin_30">封盘：</span>
                        <div class="colockbox clearfix six left" id="bet-date">
                            <span class="day"></span>
                            <span class="hour"></span>
                            <span class="minute"></span>
                            <span class="second"></span>
                        </div>
                        </span>
                    </div>
                    <div class="clearfix left">
                        <span class="left lin_30 mg_left10">开奖：</span>
                        <div class="colockbox six clearfix left" id="open-date">
                            <span class="day"></span>
                            <span class="hour"></span>
                            <span class="minute"></span>
                            <span class="second"></span>
                        </div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="game_box3 mui-clearfix">
            <ul class="left game_B3L">
                <li class="active" data-type="tm"><a href="javascript:void(0);"><i class="round_small"></i> 特码</a></li>
                <li data-type="lmm"><a href="javascript:void(0);"><i class="round_small"></i> 两面</a></li>
                <li data-type="zm"><a href="javascript:void(0);"><i class="round_small"></i> 正码</a></li>
                <li data-type="zmsz"><a href="javascript:void(0);"><i class="round_small"></i>正码1~6</a></li>
                <li data-type="zt"><a href="javascript:void(0);"><i class="round_small"></i>正特</a></li>
                <li data-type="lm"><a href="javascript:void(0);"><i class="round_small"></i>连码</a></li>
                <li data-type="lx"><a href="javascript:void(0);"><i class="round_small"></i>连肖</a></li>
                <li data-type="lw"><a href="javascript:void(0);"><i class="round_small"></i>连尾</a></li>
                <li data-type="zxbz"><a href="javascript:void(0);"><i class="round_small"></i>自选不中</a></li>
                <li data-type="hx"><a href="javascript:void(0);"><i class="round_small"></i>合肖</a></li>
                <li data-type="sxbs"><a href="javascript:void(0);"><i class="round_small"></i>生肖波色</a></li>
                <li data-type="yxws"><a href="javascript:void(0);"><i class="round_small"></i>一肖尾数</a></li>
                <li data-type="zx"><a href="javascript:void(0);"><i class="round_small"></i>正肖</a></li>

                <li style="display: none;"><a href="javascript:void(0);"><i class="round_small"></i>色波</a></li>
                <li style="display: none;"><a href="javascript:void(0);"><i class="round_small"></i>特码头数</a></li>
                <li style="display: none;"><a href="javascript:void(0);"><i class="round_small"></i>总肖</a></li>
                <li style="display: none;"><a href="javascript:void(0);"><i class="round_small"></i>五行</a></li>

            </ul>
            <div class="game_tab left">
                <!--特码-->
                <div class="tab_box active">
                    <!--<div>-->
                        <!--<h4 class="mui-text-center  bor_bd7 little_head clearfix">-->
                            <!--<a href="javascript:void(0);" class="active">特码A</a>-->
                            <!--<a href="javascript:void(0);">特码B</a>-->
                        <!--</h4>-->
                    <!--</div>-->
                    <div class="Special tma lhc_show" data-hall="1" id="Special">
                        <h4 class="mui-text-center padding_10 bor_bd7 little_head_name ">特码A</h4>
                        <ul class="mui-clearfix three" data-target-type="1" data-target-num="特码" data-hall="1">
                            <?php if(is_array($rule_data['tmszo']) || $rule_data['tmszo'] instanceof \think\Collection || $rule_data['tmszo'] instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($rule_data['tmszo']) ? array_slice($rule_data['tmszo'],0,45, true) : $rule_data['tmszo']->slice(0,45, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <li data-num="<?php echo str_pad($vo['rule'],2,'0',STR_PAD_LEFT); ?>"><a href="javascript:void(0);"><span class="ball <?php echo setBolls(str_pad($vo['rule'],2,'0',STR_PAD_LEFT)); ?>"><?php echo str_pad($vo['rule'],2,'0',STR_PAD_LEFT); ?></span><i data-id="<?php echo $vo['id']; ?>" class="odds"><?php echo $vo['rate']; ?></i></a></li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                        <ul class="mui-clearfix two" data-target-type="1" data-target-num="特码" data-hall="1">
                            <?php if(is_array($rule_data['tmszo']) || $rule_data['tmszo'] instanceof \think\Collection || $rule_data['tmszo'] instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($rule_data['tmszo']) ? array_slice($rule_data['tmszo'],45,4, true) : $rule_data['tmszo']->slice(45,4, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <li data-num="<?php echo str_pad($vo['rule'],2,'0',STR_PAD_LEFT); ?>"><a href="javascript:void(0);"><span class="ball <?php echo setBolls(str_pad($vo['rule'],2,'0',STR_PAD_LEFT)); ?>"><?php echo str_pad($vo['rule'],2,'0',STR_PAD_LEFT); ?></span><i data-id="<?php echo $vo['id']; ?>" class="odds"><?php echo $vo['rate']; ?></i></a></li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                        <h4 class="mui-text-center padding_10 bor_bd7">两面</h4>
                        <ul class="mui-clearfix two" data-target-type="1" data-target-num="特码" data-hall="1">
                            <?php if(is_array($rule_data['tmlmo']) || $rule_data['tmlmo'] instanceof \think\Collection || $rule_data['tmlmo'] instanceof \think\Paginator): $i = 0; $__LIST__ = $rule_data['tmlmo'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <li data-num="<?php echo $vo['rule']; ?>"><a href="javascript:void(0);"><?php echo $vo['rule']; ?><i data-id="<?php echo $vo['id']; ?>" class="odds"><?php echo $vo['rate']; ?></i></a></li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div>
                    <div class="Special tmb lhc_hide" data-hall="2">
                        <h4 class="mui-text-center padding_10 bor_bd7 little_head_name ">特码B</h4>
                        <ul class="mui-clearfix three" data-target-type="1" data-target-num="特码" data-hall="2">
                            <?php if(is_array($rule_data['tmszo']) || $rule_data['tmszo'] instanceof \think\Collection || $rule_data['tmszo'] instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($rule_data['tmszo']) ? array_slice($rule_data['tmszo'],0,45, true) : $rule_data['tmszo']->slice(0,45, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <li data-num="<?php echo str_pad($vo['rule'],2,'0',STR_PAD_LEFT); ?>"><a href="javascript:void(0);"><span class="ball <?php echo setBolls(str_pad($vo['rule'],2,'0',STR_PAD_LEFT)); ?>"><?php echo str_pad($vo['rule'],2,'0',STR_PAD_LEFT); ?></span><i data-id="<?php echo $vo['id']; ?>" class="odds"><?php echo $vo['rate_two']; ?></i></a></li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                        <ul class="mui-clearfix two" data-target-type="1" data-target-num="特码" data-hall="2">
                            <?php if(is_array($rule_data['tmszo']) || $rule_data['tmszo'] instanceof \think\Collection || $rule_data['tmszo'] instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($rule_data['tmszo']) ? array_slice($rule_data['tmszo'],45,4, true) : $rule_data['tmszo']->slice(45,4, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <li data-num="<?php echo str_pad($vo['rule'],2,'0',STR_PAD_LEFT); ?>"><a href="javascript:void(0);"><span class="ball <?php echo setBolls(str_pad($vo['rule'],2,'0',STR_PAD_LEFT)); ?>"><?php echo str_pad($vo['rule'],2,'0',STR_PAD_LEFT); ?></span><i data-id="<?php echo $vo['id']; ?>" class="odds"><?php echo $vo['rate_two']; ?></i></a></li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                        <h4 class="mui-text-center padding_10 bor_bd7">两面</h4>
                        <ul class="mui-clearfix two" data-target-type="1" data-target-num="特码" data-hall="2">
                            <?php if(is_array($rule_data['tmlmo']) || $rule_data['tmlmo'] instanceof \think\Collection || $rule_data['tmlmo'] instanceof \think\Paginator): $i = 0; $__LIST__ = $rule_data['tmlmo'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <li data-num="<?php echo $vo['rule']; ?>"><a href="javascript:void(0);"><?php echo $vo['rule']; ?><i data-id="<?php echo $vo['id']; ?>" class="odds"><?php echo $vo['rate_two']; ?></i></a></li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div>
                </div>
                <!--两面-->
                <div class="tab_box">
                    <div>
                        <h4 class="mui-text-center padding_10 bor_bd7 ">两面</h4>
                        <ul class="mui-clearfix two" data-target-type="1" data-target-num="特码">
                            <?php if(is_array($rule_data['tmlmo']) || $rule_data['tmlmo'] instanceof \think\Collection || $rule_data['tmlmo'] instanceof \think\Paginator): $i = 0; $__LIST__ = $rule_data['tmlmo'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <li data-num="<?php echo $vo['rule']; ?>"><a href="javascript:void(0);"><?php echo $vo['rule']; ?><i data-id="<?php echo $vo['id']; ?>" class="odds"><?php echo $vo['rate']; ?></i></a></li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                        <ul class="mui-clearfix two" data-target-type="2" data-target-num="正码">
                            <?php if(is_array($rule_data['zmzh']) || $rule_data['zmzh'] instanceof \think\Collection || $rule_data['zmzh'] instanceof \think\Paginator): $i = 0; $__LIST__ = $rule_data['zmzh'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <li data-num="<?php echo $vo['rule']; ?>"><a href="javascript:void(0);"><?php echo $vo['rule']; ?><i data-id="<?php echo $vo['id']; ?>" class="odds"><?php echo $vo['rate']; ?></i></a></li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div>
                </div>
                <!--正码-->
                <div class="tab_box">
                    <div class="Special">
                        <h4 class="mui-text-center padding_10 bor_bd7  ">正码</h4>
                        <ul class="mui-clearfix three" data-target-type="2" data-target-num="正码">
                            <?php if(is_array($rule_data['zmsz']) || $rule_data['zmsz'] instanceof \think\Collection || $rule_data['zmsz'] instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($rule_data['zmsz']) ? array_slice($rule_data['zmsz'],0,45, true) : $rule_data['zmsz']->slice(0,45, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <li data-num="<?php echo str_pad($vo['rule'],2,'0',STR_PAD_LEFT); ?>"><a href="javascript:void(0);"><span class="ball <?php echo setBolls(str_pad($vo['rule'],2,'0',STR_PAD_LEFT)); ?>"><?php echo str_pad($vo['rule'],2,'0',STR_PAD_LEFT); ?></span><i data-id="<?php echo $vo['id']; ?>" class="odds"><?php echo $vo['rate']; ?></i></a></li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                        <ul class="mui-clearfix two" data-target-type="2" data-target-num="正码">
                            <?php if(is_array($rule_data['zmsz']) || $rule_data['zmsz'] instanceof \think\Collection || $rule_data['zmsz'] instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($rule_data['zmsz']) ? array_slice($rule_data['zmsz'],45,4, true) : $rule_data['zmsz']->slice(45,4, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <li data-num="<?php echo str_pad($vo['rule'],2,'0',STR_PAD_LEFT); ?>"><a href="javascript:void(0);"><span class="ball <?php echo setBolls(str_pad($vo['rule'],2,'0',STR_PAD_LEFT)); ?>"><?php echo str_pad($vo['rule'],2,'0',STR_PAD_LEFT); ?></span><i data-id="<?php echo $vo['id']; ?>" class="odds"><?php echo $vo['rate']; ?></i></a></li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div>
                    <div>
                        <h4 class="mui-text-center padding_10 bor_bd7  ">两面</h4>
                        <ul class="mui-clearfix two" data-target-type="2" data-target-num="正码">
                            <?php if(is_array($rule_data['zmzh']) || $rule_data['zmzh'] instanceof \think\Collection || $rule_data['zmzh'] instanceof \think\Paginator): $i = 0; $__LIST__ = $rule_data['zmzh'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <li data-num="<?php echo $vo['rule']; ?>"><a href="javascript:void(0);"><?php echo $vo['rule']; ?><i data-id="<?php echo $vo['id']; ?>" class="odds"><?php echo $vo['rate']; ?></i></a></li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div>

                </div>
                <!--正码1-6-->
                <div class="tab_box">
                    <?php if(is_array($rule_data['zmlm']) || $rule_data['zmlm'] instanceof \think\Collection || $rule_data['zmlm'] instanceof \think\Paginator): $i = 0; $__LIST__ = $rule_data['zmlm'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <div class="">
                        <h4 class="mui-text-center padding_10 bor_bd7 "><?php echo $vo['type_name']; ?></h4>
                        <ul class="mui-clearfix two" data-target-type="<?php echo $vo['type']; ?>" data-target-num="<?php echo $vo['type_name']; ?>">
                            <?php if(is_array($vo['info']) || $vo['info'] instanceof \think\Collection || $vo['info'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['info'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?>
                            <li data-num="<?php echo $v1['rule']; ?>"><a href="javascript:void(0);"><?php echo $v1['rule']; ?><i data-id="<?php echo $v1['id']; ?>" class="odds"><?php echo $v1['rate']; ?></i></a></li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
                <!--正特-->
                <div class="tab_box">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <?php if(is_array($rule_data['type_zt']) || $rule_data['type_zt'] instanceof \think\Collection || $rule_data['type_zt'] instanceof \think\Paginator): $i = 0; $__LIST__ = $rule_data['type_zt'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <div class="swiper-slide <?php if($i==1): ?>swiper-slide-active<?php endif; ?>" data-target-type="<?php echo $vo['type']; ?>" data-head-class="little_head_name_zt" data-class="zt<?php echo $vo['type']; ?>" data-target-num="<?php echo $vo['title']; ?>"><?php echo $vo['title']; ?></div>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                    </div>
                    <?php if(is_array($rule_data['ztsz']) || $rule_data['ztsz'] instanceof \think\Collection || $rule_data['ztsz'] instanceof \think\Paginator): $k = 0; $__LIST__ = $rule_data['ztsz'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
                    <div class="Special zt<?php echo $vo['type']; ?>" <?php if($k!=1): ?>style="display:none;"<?php endif; ?>>
                        <h4 class="mui-text-center padding_10 bor_bd7 little_head_name_zt "><?php echo $vo['type_name']; ?></h4>
                        <ul class="mui-clearfix three list_content_name" data-target-type="<?php echo $vo['type']; ?>" data-target-num="<?php echo $vo['type_name']; ?>">
                            <?php if(is_array($vo['info']) || $vo['info'] instanceof \think\Collection || $vo['info'] instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($vo['info']) ? array_slice($vo['info'],0,45, true) : $vo['info']->slice(0,45, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?>
                            <li data-num="<?php echo str_pad($v1['rule'],2,'0',STR_PAD_LEFT); ?>"><a href="javascript:void(0);"><span class="ball <?php echo setBolls(str_pad($v1['rule'],2,'0',STR_PAD_LEFT)); ?>"><?php echo str_pad($v1['rule'],2,'0',STR_PAD_LEFT); ?></span><i data-id="<?php echo $v1['id']; ?>" class="odds"><?php echo $v1['rate']; ?></i></a></li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                        <ul class="mui-clearfix two list_content_name" data-target-type="<?php echo $vo['type']; ?>" data-target-num="<?php echo $vo['type_name']; ?>">
                            <?php if(is_array($vo['info']) || $vo['info'] instanceof \think\Collection || $vo['info'] instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($vo['info']) ? array_slice($vo['info'],45,4, true) : $vo['info']->slice(45,4, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?>
                            <li data-num="<?php echo str_pad($v1['rule'],2,'0',STR_PAD_LEFT); ?>"><a href="javascript:void(0);"><span class="ball <?php echo setBolls(str_pad($v1['rule'],2,'0',STR_PAD_LEFT)); ?>"><?php echo str_pad($v1['rule'],2,'0',STR_PAD_LEFT); ?></span><i data-id="<?php echo $v1['id']; ?>" class="odds"></i><?php echo $v1['rate']; ?></a></li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
                <!--连码-->
                <div class="tab_box">
                    <div class="swiper-container" id="six-lm">
                        <div class="swiper-wrapper">
                            <?php if(is_array($rule_data['type_lm']) || $rule_data['type_lm'] instanceof \think\Collection || $rule_data['type_lm'] instanceof \think\Paginator): $i = 0; $__LIST__ = $rule_data['type_lm'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <div class="swiper-slide <?php if($i==1): ?>swiper-slide-active<?php endif; ?>" data-target-type="<?php echo $vo['type']; ?>" data-head-class="little_head_name_lm" data-class="lm<?php echo $vo['type']; ?>" data-target-num="<?php echo $vo['title']; ?>"><?php echo $vo['title']; ?></div>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                    </div>
                    <?php if(is_array($rule_data['lm']) || $rule_data['lm'] instanceof \think\Collection || $rule_data['lm'] instanceof \think\Paginator): $k = 0; $__LIST__ = $rule_data['lm'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
                    <div class="Special lm<?php echo $vo['type']; ?>" <?php if($k!=1): ?>style="display:none;"<?php endif; ?>>
                        <h4 class="mui-text-center padding_10 bor_bd7 little_head_name_lm "><?php echo $vo['rule']; ?></h4>
                        <ul class="mui-clearfix three list_content_name" data-target-type="<?php echo $vo['type']; ?>" data-target-num="<?php echo $vo['rule']; ?>" data-target-odds="<?php echo $vo['rate']; ?>">
                            <?php $__FOR_START_32288__=1;$__FOR_END_32288__=46;for($i=$__FOR_START_32288__;$i < $__FOR_END_32288__;$i+=1){ ?>
                            <li data-num="<?php echo str_pad($i,2,'0',STR_PAD_LEFT); ?>"><a href="javascript:void(0);"><span class="ball <?php echo setBolls(str_pad($i,2,'0',STR_PAD_LEFT)); ?>"><?php echo str_pad($i,2,'0',STR_PAD_LEFT); ?></span><i data-id="<?php echo $vo['id']; ?>" class="odds"><?php echo $vo['rate']; ?></i></a></li>
                            <?php } ?>
                        </ul>
                        <ul class="mui-clearfix two list_content_name" data-target-type="<?php echo $vo['type']; ?>" data-target-num="<?php echo $vo['rule']; ?>" data-target-odds="<?php echo $vo['rate']; ?>">
                            <?php $__FOR_START_18723__=46;$__FOR_END_18723__=50;for($i=$__FOR_START_18723__;$i < $__FOR_END_18723__;$i+=1){ ?>
                            <li data-num="<?php echo str_pad($i,2,'0',STR_PAD_LEFT); ?>"><a href="javascript:void(0);"><span class="ball <?php echo setBolls(str_pad($i,2,'0',STR_PAD_LEFT)); ?>"><?php echo str_pad($i,2,'0',STR_PAD_LEFT); ?></span><i data-id="<?php echo $vo['id']; ?>" class="odds"><?php echo $vo['rate']; ?></i></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
                <!--连肖-->
                <div class="tab_box">
                    <div class="swiper-container" id="six-lx">
                        <div class="swiper-wrapper">
                            <?php if(is_array($rule_data['type_lx']) || $rule_data['type_lx'] instanceof \think\Collection || $rule_data['type_lx'] instanceof \think\Paginator): $i = 0; $__LIST__ = $rule_data['type_lx'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <div class="swiper-slide <?php if($i==1): ?>swiper-slide-active<?php endif; ?>" data-target-type="<?php echo $vo['type']; ?>" data-head-class="little_head_name_lx" data-class="lx<?php echo $vo['type']; ?>" data-target-num="<?php echo $vo['title']; ?>"><?php echo $vo['title']; ?></div>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                    </div>
                    <?php if(is_array($rule_data['lx']) || $rule_data['lx'] instanceof \think\Collection || $rule_data['lx'] instanceof \think\Paginator): $k = 0; $__LIST__ = $rule_data['lx'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
                    <div class="Special six-head lx<?php echo $vo['type']; ?>" <?php if($k!=1): ?>style="display:none;"<?php endif; ?>>
                        <h4 class="mui-text-center padding_10 bor_bd7 little_head_name_lx "><?php echo $vo['type_name']; ?></h4>
                        <ul class="mui-clearfix one " data-target-type="<?php echo $vo['type']; ?>" data-target-num="<?php echo $vo['type_name']; ?>" data-target-odds="<?php echo $vo['info']['0']['rate']; ?>">
                            <?php if(is_array($vo['info']) || $vo['info'] instanceof \think\Collection || $vo['info'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['info'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?>
                            <li class="clearfix" data-num="<?php echo $v1['rule']; ?>">
                                <a href="javascript:void(0);">
                                    <div class="left"><?php echo $v1['rule']; ?><i><?php echo $v1['rate']; ?></i></div>
                                    <div class="right">
                                        <?php if(is_array($v1['win_rule']) || $v1['win_rule'] instanceof \think\Collection || $v1['win_rule'] instanceof \think\Paginator): $i = 0; $__LIST__ = $v1['win_rule'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v2): $mod = ($i % 2 );++$i;?>
                                        <span class="ball <?php echo setBolls($v2); ?>"><?php echo $v2; ?></span>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </div>
                                </a>
                            </li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
                <!--连尾-->
                <div class="tab_box">
                    <div class="swiper-container" id="six-lw">
                        <div class="swiper-wrapper">
                            <?php if(is_array($rule_data['type_lw']) || $rule_data['type_lw'] instanceof \think\Collection || $rule_data['type_lw'] instanceof \think\Paginator): $i = 0; $__LIST__ = $rule_data['type_lw'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <div class="swiper-slide <?php if($i==1): ?>swiper-slide-active<?php endif; ?>" data-target-type="<?php echo $vo['type']; ?>" data-head-class="little_head_name_lw" data-class="lw<?php echo $vo['type']; ?>" data-target-num="<?php echo $vo['title']; ?>"><?php echo $vo['title']; ?></div>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                    </div>
                    <?php if(is_array($rule_data['lw']) || $rule_data['lw'] instanceof \think\Collection || $rule_data['lw'] instanceof \think\Paginator): $k = 0; $__LIST__ = $rule_data['lw'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
                    <div class="Special six-head lw<?php echo $vo['type']; ?>" <?php if($k!=1): ?>style="display:none;"<?php endif; ?>>
                        <h4 class="mui-text-center padding_10 bor_bd7 little_head_name_lx "><?php echo $vo['type_name']; ?></h4>
                        <ul class="mui-clearfix one " data-target-type="<?php echo $vo['type']; ?>" data-target-num="<?php echo $vo['type_name']; ?>" data-target-odds="<?php echo $vo['info']['0']['rate']; ?>">
                            <?php if(is_array($vo['info']) || $vo['info'] instanceof \think\Collection || $vo['info'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['info'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?>
                            <li class="clearfix" data-num="<?php echo $v1['rule']; ?>尾">
                                <a href="javascript:void(0);">
                                    <div class="left"><?php echo $v1['rule']; ?>尾<i><?php echo $v1['rate']; ?></i></div>
                                    <div class="right">
                                        <?php if(is_array($v1['win_rule']) || $v1['win_rule'] instanceof \think\Collection || $v1['win_rule'] instanceof \think\Paginator): $i = 0; $__LIST__ = $v1['win_rule'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v2): $mod = ($i % 2 );++$i;?>
                                        <span class="ball <?php echo setBolls($v2); ?>"><?php echo $v2; ?></span>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </div>
                                </a>
                            </li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
                <!--自选不中-->
                <div class="tab_box">
                    <div class="swiper-container" id="six-zxbz">
                        <div class="swiper-wrapper">
                            <?php if(is_array($rule_data['type_bz']) || $rule_data['type_bz'] instanceof \think\Collection || $rule_data['type_bz'] instanceof \think\Paginator): $i = 0; $__LIST__ = $rule_data['type_bz'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <div class="swiper-slide <?php if($i==1): ?>swiper-slide-active<?php endif; ?>" data-target-type="<?php echo $vo['type']; ?>" data-head-class="little_head_name_bz" data-class="bz<?php echo $vo['type']; ?>" data-target-num="<?php echo $vo['title']; ?>"><?php echo $vo['title']; ?></div>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                    </div>
                    <?php if(is_array($rule_data['zxbz']) || $rule_data['zxbz'] instanceof \think\Collection || $rule_data['zxbz'] instanceof \think\Paginator): $k = 0; $__LIST__ = $rule_data['zxbz'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
                    <div class="Special bz<?php echo $vo['type']; ?>" <?php if($k!=1): ?>style="display:none;"<?php endif; ?>>
                        <h4 class="mui-text-center padding_10 bor_bd7 little_head_name_bz "><?php echo $vo['rule']; ?></h4>
                        <ul class="mui-clearfix three list_content_name" data-target-type="<?php echo $vo['type']; ?>" data-target-num="<?php echo $vo['rule']; ?>" data-target-odds="<?php echo $vo['rate']; ?>">
                            <?php $__FOR_START_8786__=1;$__FOR_END_8786__=46;for($i=$__FOR_START_8786__;$i < $__FOR_END_8786__;$i+=1){ ?>
                            <li data-num="<?php echo str_pad($i,2,'0',STR_PAD_LEFT); ?>"><a href="javascript:void(0);"><span class="ball <?php echo setBolls(str_pad($i,2,'0',STR_PAD_LEFT)); ?>"><?php echo str_pad($i,2,'0',STR_PAD_LEFT); ?></span><i data-id="<?php echo $vo['id']; ?>" class="odds"><?php echo $vo['rate']; ?></i></a></li>
                            <?php } ?>
                        </ul>
                        <ul class="mui-clearfix two list_content_name" data-target-type="<?php echo $vo['type']; ?>" data-target-num="<?php echo $vo['rule']; ?>" data-target-odds="<?php echo $vo['rate']; ?>">
                            <?php $__FOR_START_30429__=46;$__FOR_END_30429__=50;for($i=$__FOR_START_30429__;$i < $__FOR_END_30429__;$i+=1){ ?>
                            <li data-num="<?php echo str_pad($i,2,'0',STR_PAD_LEFT); ?>"><a href="javascript:void(0);"><span class="ball <?php echo setBolls(str_pad($i,2,'0',STR_PAD_LEFT)); ?>"><?php echo str_pad($i,2,'0',STR_PAD_LEFT); ?></span><i data-id="<?php echo $vo['id']; ?>" class="odds"><?php echo $vo['rate']; ?></i></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
                <!--合肖-->
                <div class="tab_box">
                    <div class="swiper-container" id="six-hx" style="display: none;">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide swiper-slide-active" data-target-type="26" data-head-class="little_head_name_bz" data-class="hx" data-target-num="合肖中" data-target-odds="">合肖中</div>
                        </div>
                    </div>
                    <div class="Special six-head" id="hx-box">
                        <h4 class="mui-text-center padding_10 bor_bd7 " id="hx">合肖<i id="oddsSpan" style="font-size: 14px;">--</i></h4>
                        <ul class="mui-clearfix one " data-target-type="26" data-target-num="合肖中" >
                            <?php if(is_array($rule_data['hxz']) || $rule_data['hxz'] instanceof \think\Collection || $rule_data['hxz'] instanceof \think\Paginator): $i = 0; $__LIST__ = $rule_data['hxz'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <li class="clearfix" data-num="<?php echo $vo['rule']; ?>" data-target-type="<?php echo $vo['type']; ?>" data-target-num="<?php echo $vo['rule']; ?>" data-target-odds="<?php echo $vo['rate']; ?>">
                                <a href="javascript:void(0);">
                                    <div class="left"><?php echo $vo['rule']; ?></div>
                                    <div class="right">
                                        <?php if(is_array($vo['win_rule']) || $vo['win_rule'] instanceof \think\Collection || $vo['win_rule'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['win_rule'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?>
                                        <span class="ball <?php echo setBolls($v1); ?>"><?php echo $v1; ?></span>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </div>
                                </a>
                            </li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div>
                </div>
                <!--特肖-->
                <div class="tab_box">
                    <div class="Special six-head">
                        <h4 class="mui-text-center padding_10 bor_bd7">特肖</h4>
                        <ul class="mui-clearfix one " data-target-type="1" data-target-num="特肖">
                            <?php if(is_array($rule_data['tx']) || $rule_data['tx'] instanceof \think\Collection || $rule_data['tx'] instanceof \think\Paginator): $i = 0; $__LIST__ = $rule_data['tx'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <li class="clearfix" data-num="<?php echo $vo['rule']; ?>">
                                <a href="javascript:void(0);">
                                    <div class="left"><?php echo $vo['rule']; ?><i data-id="<?php echo $vo['id']; ?>" class="odds"><?php echo $vo['rate']; ?></i></div>
                                    <div class="right">
                                        <?php if(is_array($vo['win_rule']) || $vo['win_rule'] instanceof \think\Collection || $vo['win_rule'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['win_rule'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?>
                                        <span class="ball <?php echo setBolls($v1); ?>"><?php echo $v1; ?></span>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </div>
                                </a>
                            </li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                        <ul class="mui-clearfix three" data-target-type="1" data-target-num="特码波色">
                            <?php if(is_array($rule_data['tmbs']) || $rule_data['tmbs'] instanceof \think\Collection || $rule_data['tmbs'] instanceof \think\Paginator): $i = 0; $__LIST__ = $rule_data['tmbs'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <li data-num="<?php echo $vo['rule']; ?>"><a href="javascript:void(0);"><?php echo $vo['rule']; ?><i data-id="<?php echo $vo['id']; ?>" class="odds"><?php echo $vo['rate']; ?></i></a></li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div>
                </div>
                <!--平特一肖-->
                <div class="tab_box">
                    <div class="Special six-head">
                        <h4 class="mui-text-center padding_10 bor_bd7  ">平特一肖</h4>
                        <ul class="mui-clearfix one " data-target-type="30" data-target-num="平特一肖">
                            <?php if(is_array($rule_data['ptyx']) || $rule_data['ptyx'] instanceof \think\Collection || $rule_data['ptyx'] instanceof \think\Paginator): $i = 0; $__LIST__ = $rule_data['ptyx'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <li class="clearfix" data-num="<?php echo $vo['rule']; ?>">
                                <a href="javascript:void(0);">
                                    <div class="left"><?php echo $vo['rule']; ?><i data-id="<?php echo $vo['id']; ?>" class="odds"><?php echo $vo['rate']; ?></i></div>
                                    <div class="right">
                                        <?php if(is_array($vo['win_rule']) || $vo['win_rule'] instanceof \think\Collection || $vo['win_rule'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['win_rule'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?>
                                        <span class="ball <?php echo setBolls($v1); ?>"><?php echo $v1; ?></span>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </div>
                                </a>
                            </li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                        <h4 class="mui-text-center padding_10 bor_bd7  ">平特尾数</h4>
                        <ul class="mui-clearfix three" data-target-type="1" data-target-num="平特尾数">
                            <?php if(is_array($rule_data['ptws']) || $rule_data['ptws'] instanceof \think\Collection || $rule_data['ptws'] instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($rule_data['ptws']) ? array_slice($rule_data['ptws'],0,9, true) : $rule_data['ptws']->slice(0,9, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <li data-num="<?php echo $vo['rule']; ?>尾"><a href="javascript:void(0);"><?php echo $vo['rule']; ?>尾<i data-id="<?php echo $vo['id']; ?>" class="odds"><?php echo $vo['rate']; ?></i></a></li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                        <ul class="mui-clearfix one" data-target-type="1" data-target-num="平特尾数">
                            <?php if(is_array($rule_data['ptws']) || $rule_data['ptws'] instanceof \think\Collection || $rule_data['ptws'] instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($rule_data['ptws']) ? array_slice($rule_data['ptws'],9,1, true) : $rule_data['ptws']->slice(9,1, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <li data-num="<?php echo $vo['rule']; ?>尾"><a href="javascript:void(0);"><?php echo $vo['rule']; ?>尾<i data-id="<?php echo $vo['id']; ?>" class="odds"><?php echo $vo['rate']; ?></i></a></li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div>
                </div>
                <!--正肖-->
                <div class="tab_box">
                    <div class="Special six-head">
                        <h4 class="mui-text-center padding_10 bor_bd7 little_head_name3 ">正肖</h4>
                        <ul class="mui-clearfix one " data-target-type="32" data-target-num="正肖">
                            <?php if(is_array($rule_data['zx']) || $rule_data['zx'] instanceof \think\Collection || $rule_data['zx'] instanceof \think\Paginator): $i = 0; $__LIST__ = $rule_data['zx'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <li class="clearfix" data-num="<?php echo $vo['rule']; ?>">
                                <a href="javascript:void(0);">
                                    <div class="left"><?php echo $vo['rule']; ?><i data-id="<?php echo $vo['id']; ?>" class="odds"><?php echo $vo['rate']; ?></i></div>
                                    <div class="right">
                                        <?php if(is_array($vo['win_rule']) || $vo['win_rule'] instanceof \think\Collection || $vo['win_rule'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['win_rule'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?>
                                        <span class="ball <?php echo setBolls($v1); ?>"><?php echo $v1; ?></span>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </div>
                                </a>
                            </li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div>
                </div>
                <!--色波-->
                <div class="tab_box">
                    <div>
                        <h4 class="mui-text-center padding_10 bor_bd7  ">特码色波</h4>
                        <ul class="mui-clearfix three " data-target-type="3" data-target-num="色波">
                            <li data-num="红波"><a href="javascript:void(0);">红波<i data-id="107" class="odds"></i></a>	</li>
                            <li data-num="蓝波"><a href="javascript:void(0);">蓝波<i data-id="108" class="odds"></i></a>	</li>
                            <li data-num="绿波"><a href="javascript:void(0);">绿波<i data-id="108" class="odds"></i></a>	</li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="mui-text-center padding_10 bor_bd7  ">7色波</h4>
                        <ul class="mui-clearfix two " data-target-type="22" data-target-num="7色波">
                            <li data-num="红波"><a href="javascript:void(0);">红波<i data-id="168" class="odds"></i></a>	</li>
                            <li data-num="蓝波"><a href="javascript:void(0);">蓝波<i data-id="169" class="odds"></i></a>	</li>
                            <li data-num="绿波"><a href="javascript:void(0);">绿波<i data-id="169" class="odds"></i></a>	</li>
                            <li data-num="和局"><a href="javascript:void(0);">和局<i data-id="170" class="odds"></i></a>	</li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="mui-text-center padding_10 bor_bd7  ">红球</h4>
                        <ul class="mui-clearfix two " data-target-type="3" data-target-num="色波">
                            <li data-num="红单"><a href="javascript:void(0);">红单<i data-id="113" class="odds"></i></a>	</li>
                            <li data-num="红双"><a href="javascript:void(0);">红双<i data-id="114" class="odds"></i></a>	</li>
                            <li data-num="红大"><a href="javascript:void(0);">红大<i data-id="109" class="odds"></i></a></li>
                            <li data-num="红小"><a href="javascript:void(0);">红小<i data-id="110" class="odds"></i></a>	</li>
                            <li data-num="红大单"><a href="javascript:void(0);">红大单<i data-id="116" class="odds"></i></a></li>
                            <li data-num="红大双"><a href="javascript:void(0);">红大双<i data-id="118" class="odds"></i></a></li>
                            <li data-num="红小单"><a href="javascript:void(0);">红小单<i data-id="117" class="odds"></i></a></li>
                            <li data-num="红小双"><a href="javascript:void(0);">红小双<i data-id="117" class="odds"></i></a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="mui-text-center padding_10 bor_bd7  ">蓝球</h4>
                        <ul class="mui-clearfix two " data-target-type="3" data-target-num="色波">
                            <li data-num="蓝单"><a href="javascript:void(0);">蓝单<i data-id="113" class="odds"></i></a>	</li>
                            <li data-num="蓝双"><a href="javascript:void(0);">蓝双<i data-id="113" class="odds"></i></a>	</li>
                            <li data-num="蓝大"><a href="javascript:void(0);">蓝大<i data-id="111" class="odds"></i></a></li>
                            <li data-num="蓝小"><a href="javascript:void(0);">蓝小<i data-id="109" class="odds"></i></a>	</li>
                            <li data-num="蓝大单"><a href="javascript:void(0);">蓝大单<i data-id="117" class="odds"></i></a></li>
                            <li data-num="蓝大双"><a href="javascript:void(0);">蓝大双<i data-id="118" class="odds"></i></a></li>
                            <li data-num="蓝小单"><a href="javascript:void(0);">蓝小单<i data-id="116" class="odds"></i></a></li>
                            <li data-num="蓝小双"><a href="javascript:void(0);">蓝小双<i data-id="118" class="odds"></i></a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="mui-text-center padding_10 bor_bd7  ">绿球</h4>
                        <ul class="mui-clearfix two " data-target-type="3" data-target-num="色波">
                            <li data-num="绿单"><a href="javascript:void(0);">绿单<i data-id="113" class="odds"></i></a>	</li>
                            <li data-num="绿双"><a href="javascript:void(0);">绿双<i data-id="115" class="odds"></i></a>	</li>
                            <li data-num="绿大"><a href="javascript:void(0);">绿大<i data-id="112" class="odds"></i></a></li>
                            <li data-num="绿小"><a href="javascript:void(0);">绿小<i data-id="109" class="odds"></i></a>	</li>
                            <li data-num="绿大单"><a href="javascript:void(0);">绿大单<i data-id="118" class="odds"></i></a></li>
                            <li data-num="绿大双"><a href="javascript:void(0);">绿大双<i data-id="118" class="odds"></i></a></li>
                            <li data-num="绿小单"><a href="javascript:void(0);">绿小单<i data-id="118" class="odds"></i></a></li>
                            <li data-num="绿小双"><a href="javascript:void(0);">绿小双<i data-id="116" class="odds"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!--特码头数-->
                <div class="tab_box">
                    <div>
                        <h4 class="mui-text-center padding_10 bor_bd7  ">头数</h4>
                        <ul class="mui-clearfix three " data-target-type="5" data-target-num="特码头尾数">
                            <li data-num="0头"><a href="javascript:void(0);">0头<i data-id="141" class="odds"></i></a>	</li>
                            <li data-num="1头"><a href="javascript:void(0);">1头<i data-id="142" class="odds"></i></a>	</li>
                            <li data-num="2头"><a href="javascript:void(0);">2头<i data-id="142" class="odds"></i></a>	</li>
                            <li data-num="3头"><a href="javascript:void(0);">3头<i data-id="142" class="odds"></i></a>	</li>
                            <li data-num="4头"><a href="javascript:void(0);">4头<i data-id="142" class="odds"></i></a>	</li>
                        </ul>
                    </div>
                    <div class="Special six-head">
                        <h4 class="mui-text-center padding_10 bor_bd7  ">尾数</h4>
                        <ul class="mui-clearfix one " data-target-type="5" data-target-num="特码头尾数">
                            <li class="clearfix" data-num="0尾">
                                <a href="javascript:void(0);">
                                    <div class="left">0尾<i data-id="143" class="odds"></i></div>
                                    <div class="right">
                                        <span class="ball bg_green">10</span>
                                        <span class="ball bg_green">20</span>
                                        <span class="ball bg_red">30</span>
                                        <span class="ball bg_red">40</span>
                                    </div>
                                </a>
                            </li>
                            <li class="clearfix" data-num="1尾">
                                <a href="javascript:void(0);">
                                    <div class="left">1尾<i data-id="144" class="odds"></i></div>
                                    <div class="right">
                                        <span class="ball bg_red">01</span>
                                        <span class="ball bg_green">11</span>
                                        <span class="ball bg_green">21</span>
                                        <span class="ball bg_blue">31</span>
                                        <span class="ball bg_blue">41</span>
                                    </div>
                                </a>
                            </li>
                            <li class="clearfix" data-num="2尾">
                                <a href="javascript:void(0);">
                                    <div class="left">2尾<i data-id="144" class="odds"></i></div>
                                    <div class="right">
                                        <span class="ball bg_red">02</span>
                                        <span class="ball bg_red">12</span>
                                        <span class="ball bg_green">22</span>
                                        <span class="ball bg_green">32</span>
                                        <span class="ball bg_blue">42</span>
                                    </div>
                                </a>
                            </li>
                            <li class="clearfix" data-num="3尾">
                                <a href="javascript:void(0);">
                                    <div class="left">3尾<i data-id="144" class="odds"></i></div>
                                    <div class="right">
                                        <span class="ball bg_blue">03</span>
                                        <span class="ball bg_red">13</span>
                                        <span class="ball bg_red">23</span>
                                        <span class="ball bg_green">33</span>
                                        <span class="ball bg_green">43</span>
                                    </div>
                                </a>
                            </li>
                            <li class="clearfix" data-num="4尾">
                                <a href="javascript:void(0);">
                                    <div class="left">4尾<i data-id="144" class="odds"></i></div>
                                    <div class="right">
                                        <span class="ball bg_blue">04</span>
                                        <span class="ball bg_blue">14</span>
                                        <span class="ball bg_red">24</span>
                                        <span class="ball bg_red">34</span>
                                        <span class="ball bg_green">44</span>
                                    </div>
                                </a>
                            </li>
                            <li class="clearfix" data-num="5尾">
                                <a href="javascript:void(0);">
                                    <div class="left">5尾<i data-id="144" class="odds"></i></div>
                                    <div class="right">
                                        <span class="ball bg_green">05</span>
                                        <span class="ball bg_blue">15</span>
                                        <span class="ball bg_blue">25</span>
                                        <span class="ball bg_red">35</span>
                                        <span class="ball bg_red">45</span>
                                    </div>
                                </a>
                            </li>
                            <li class="clearfix" data-num="6尾">
                                <a href="javascript:void(0);">
                                    <div class="left">6尾<i data-id="144" class="odds"></i></div>
                                    <div class="right">
                                        <span class="ball bg_green">06</span>
                                        <span class="ball bg_green">16</span>
                                        <span class="ball bg_blue">26</span>
                                        <span class="ball bg_blue">36</span>
                                        <span class="ball bg_red">46</span>
                                    </div>
                                </a>
                            </li>
                            <li class="clearfix" data-num="7尾">
                                <a href="javascript:void(0);">
                                    <div class="left">7尾<i data-id="144" class="odds"></i></div>
                                    <div class="right">
                                        <span class="ball bg_red">07</span>
                                        <span class="ball bg_green">17</span>
                                        <span class="ball bg_green">27</span>
                                        <span class="ball bg_blue">37</span>
                                        <span class="ball bg_blue">47</span>
                                    </div>
                                </a>
                            </li>
                            <li class="clearfix" data-num="8尾">
                                <a href="javascript:void(0);">
                                    <div class="left">8尾<i data-id="144" class="odds"></i></div>
                                    <div class="right">
                                        <span class="ball bg_red">08</span>
                                        <span class="ball bg_red">18</span>
                                        <span class="ball bg_green">28</span>
                                        <span class="ball bg_green">38</span>
                                        <span class="ball bg_blue">48</span>
                                    </div>
                                </a>
                            </li>
                            <li class="clearfix" data-num="9尾">
                                <a href="javascript:void(0);">
                                    <div class="left">9尾<i data-id="144" class="odds"></i></div>
                                    <div class="right">
                                        <span class="ball bg_blue">09</span>
                                        <span class="ball bg_red">19</span>
                                        <span class="ball bg_red">29</span>
                                        <span class="ball bg_green">39</span>
                                        <span class="ball bg_green">49</span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--总肖-->
                <div class="tab_box">
                    <h4 class="mui-text-center padding_10 bor_bd7  ">总肖</h4>
                    <ul class="mui-clearfix two " data-target-type="23" data-target-num="总肖">
                        <li data-num="2肖"><a href="javascript:void(0);">2肖<i data-id="171" class="odds"></i></a></li>
                        <li data-num="3肖"><a href="javascript:void(0);">3肖<i data-id="172" class="odds"></i></a></li>
                        <li data-num="4肖"><a href="javascript:void(0);">4肖<i data-id="173" class="odds"></i></a></li>
                        <li data-num="5肖"><a href="javascript:void(0);">5肖<i data-id="174" class="odds"></i></a></li>
                        <li data-num="6肖"><a href="javascript:void(0);">6肖<i data-id="175" class="odds"></i></a></li>
                        <li data-num="7肖"><a href="javascript:void(0);">7肖<i data-id="176" class="odds"></i></a></li>
                        <li data-num="总肖单"><a href="javascript:void(0);">总肖单<i data-id="177" class="odds"></i></a></li>
                        <li data-num="总肖双"><a href="javascript:void(0);">总肖双<i data-id="178" class="odds"></i></a></li>
                    </ul>
                </div>
                <!--五行-->
                <div class="tab_box">
                    <div>
                        <h4 class="mui-text-center padding_10 bor_bd7 ">五行</h4>
                        <ul class="mui-clearfix two" data-target-type="19" data-target-num="五行">
                            <li data-num="金"><a href="javascript:void(0);">金<i data-id="145" class="odds"></i> </a></li>
                            <li data-num="木"><a href="javascript:void(0);">木<i data-id="146" class="odds"></i> </a></li>
                            <li data-num="水"><a href="javascript:void(0);">水<i data-id="147" class="odds"></i> </a></li>
                            <li data-num="火"><a href="javascript:void(0);">火<i data-id="148" class="odds"></i> </a></li>
                        </ul>
                        <ul class="mui-clearfix one" data-target-type="19" data-target-num="五行">
                            <li data-num="土"><a href="javascript:void(0);">土<i data-id="149" class="odds"></i> </a></li>
                        </ul>
                    </div>
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
        <h4 class="mui-h4 mui-text-center mui-clearfix">六合彩  <a class="mui-pull-right" href="javascript:void(0);"><img class="close" src="__IMG__/wap/close.png"/></a></h4>
        <p>
            以下所有投注皆含本金。<br />
            1.特码<br />
            香港六合彩公司当期开出的最後一码为特码。<br />
            2.特码大小<br />
            特小：开出的特码，(01~24)小于或等于24。<br />
            特大：开出的特码，(25~48)小于或等于48。<br />
            和局：特码为49时。<br />
            3.特码单双<br />
            特双：特码为双数，如18、20、34、42。<br />
            特单：特码为单数，如01，11，35，47。<br />
            和局：特码为49时。<br />
            4.特码合数单双<br />
            特双：指开出特码的个位加上十位之和为‘双数’，如02，11，33，44。<br />
            特单：指开出特码的个位加上十位之和为‘单数’，如01，14，36，47。<br />
            和局：特码为49时。<br />
            5.特码尾数大小<br />
            特尾大：5尾~9尾为大，如05、18、19。<br />
            特尾小：0尾~4尾为小，如01，32，44。<br />
            和局：特码为49时。<br />
            6.特码半特<br />
            以特码大小与特码单双游戏为一个投注组合；当期特码开出符合投注组合，即视为中奖；若当期特码开出49号，其余情形视为不中奖。<br />
            大单：25、27、29、31、33、35、37、39，41、43、45、47<br />
            大双：26、28、30、32、34、36、38、40，42、44、46、48<br />
            小单：01、03、05、07、09、11、13、15，17、19、21、23<br />
            小双：02、04、06、08、10、12、14、16，18、20、22、24<br />
            和局：特码为49时。<br />
            7.特码合数大小<br />
            合数大：特码的个位加上十位之和来决定大小，和数大于或等于7为大。<br />
            合数小：特码的个位加上十位之和来决定大小，和数小于或等于6为小。<br />
            和局：特码为49时。<br />
            8.正码<br />
            香港六合彩公司每期开出的前面六个号码为正码，下注号码如在六个正码号码里中奖。<br />
            9.总和大小<br />
            总和大：所以七个开奖号码的分数总和大于或等于175。<br />
            总和小：所以七个开奖号码的分数总和小于或等于174。<br />
            10.总和单双<br />
            总和单：所以七个开奖号码的分数总和是‘单数’，如分数总和是133、197。<br />
            总和双：所以七个开奖号码的分数总和是‘双数’，如分数总和是120、188。<br />
            11.正肖<br />
            以开出的6个正码做游戏，只要有1个落在下注生肖范围内，视为中奖。如超过1个正码落在下注生肖范围内 ，派彩将倍增！如：下注＄100.-正肖龙倍率1.8。<br />
            6个正码开出01，派彩为＄80<br />
            6个正码开出01，13，派彩为＄160<br />
            6个正码开出01，13，25，派彩为＄240<br />
            6个正码开出01，13，25，37，派彩为＄320<br />
            6个正码开出01，13，25，37，49，派彩为＄320<br />
            12.正码特<br />
            正码特是指 正1特、正2特、正3特、正4特、正5特、正6特。<br />
            其下注的正码特号与现场摇珠开出之正码其开奖顺序及开奖号码相同，视为中奖。<br />
            如现场摇珠第一个正码开奖为49号，下注第一个正码特为49则视为中奖，其它号码视为不中奖。<br />
            13.正码过关<br />
            可同时挑选多项赛事，串联成投注组合，其赔率为所选串当时赔率的总乘积。<br />
            只要当期所开出之中奖结果符合您所选定之串联赛事，即视为中奖。<br />
            如投注组合中某一个号码为49号和时，该组合将该串赔率以1为计算。<br />
            14.正码1-6<br />
            香港六合彩公司当期开出之前6个号码叫正码。第一时间出来的叫正码1，依次为正码2、正码3┅┅ 正码6(并不以号码大小排序)。正码1、正码2、正码3、
            正码4、正码5、正码6的大小单双合单双和特别号码的大小单双规则相同，如正码1为31，则正码1为大，为单，为合双，为合小；正码2为08，则正码2为小，
            为双，为合双，为合大；号码为49则为和。假如投注组合符合中奖结果，视为中奖。 正码1-6色波下注开奖之球色与下注之颜色相同时，视为中奖。其余情形视为不中奖。<br />
            15.半波<br />
            以特码色波和特单，特双，特大，特小为一个投注组合，当期特码开出符合投注组合，即视为中奖； 若当期特码开出49号，则视为和局；其余情形视为不中奖。<br />
            16.半半波<br />
            以特码色波和特单双及特大小等游戏为一个投注组合，当期特码开出符合投注组合，即视为中奖； 若当期特码开出49号，则视为和局；其余情形视为不中奖。<br />
            17.特码生肖<br />
            生肖顺序为 鼠 >牛 >虎 >兔 >龙 >蛇 >马 >羊 >猴 >鸡 >狗 >猪 。<br />
            如今年是鸡年，就以鸡为开始，依顺序将49个号码分为12个生肖『如下』<br />
            鸡：01、13、25、37、49<br />
            猴：02、14、26、38<br />
            羊：03、15、27、39<br />
            马：04、16、28、40<br />
            蛇：05、17、29、41<br />
            龙：06、18、30、42<br />
            兔：07、19、31、43<br />
            虎：08、20、32、44<br />
            牛：09、21、33、45<br />
            鼠：10、22、34、46<br />
            猪：11、23、35、47<br />
            狗：12、24、36、48<br />
            若当期特别号，落在下注生肖范围内，视为中奖 。<br />
            18.特码色波<br />
            香港六合彩49个号码球分别有红、蓝、绿三种颜色，以特码开出的颜色和投注的颜色相同视为中奖，颜色代表如下:<br />
            红波：01 ,02 ,07 ,08 ,12 ,13 ,18 ,19 ,23 ,24 ,29 ,30 ,34 ,35 ,40 ,45 ,46<br />
            蓝波：03 ,04 ,09 ,10 ,14 ,15 ,20 ,25 ,26 ,31 ,36 ,37 ,41 ,42 ,47 ,48<br />
            绿波：05 ,06 ,11 ,16 ,17 ,21 ,22 ,27 ,28 ,32 ,33 ,38 ,39 ,43 ,44 ,49<br />
            19.特码头数<br />
            特码头数：是指特码属头数的号码<br />
            "0"头：01、02、03、04、05、06、07、08、09<br />
            "1"头：10、11、12、13、14、15、16、17、18、19<br />
            "2"头：20、21、22、23、24、25、26、27、28、29<br />
            "3"头：30、31、32、33、34、35、36、37、38、39<br />
            "4"头：40、41、42、43、44、45、46、47、48、49<br />
            例如：开奖结果特别号码为21则2头为中奖，其他头数都不中奖。<br />
            20.特码尾数<br />
            特码尾数：是指特码属尾数的号码。<br />
            "0"尾：10、20、30、40<br />
            "1"尾：01、11、21、31、41<br />
            "2"尾：02、12、22、32、42<br />
            "3"尾：03、13、23、33、43<br />
            "4"尾：04、14、24、34、44<br />
            "5"尾：05、15、25、35、45<br />
            "6"尾：06、16、26、36、46<br />
            "7"尾：07、17、27、37、47<br />
            "8"尾：08、18、28、38、48<br />
            "9"尾：09、19、29、39、49<br />
            例如：开奖结果特别号码为21则1尾数为中奖，其他尾数都不中奖。<br />
            21.五行<br />
            挑选一个五行选项为一个组合，若开奖号码的特码在此组合内，即视为中奖；若开奖号码的特码亦不在此组合内，即视为不中奖；<br />
            如今年是2015年（五行每年不一样）<br />
            金：01、02、15、16、23、24、31、32、45、46<br />
            木：05、06、13、14、27、28、35、36、43、44<br />
            水：03、04、11、12、19、20、33、34、41、42、49<br />
            火：07、08、21、22、29、30、37、38<br />
            土：09、10、17、18、25、26、39、40、47、48<br />
            22.平特一肖<br />
            指开奖的7个号码中含有所属生肖的一个或多个号码，但派彩指派一次，即不论同生肖号码出现一个或多个号码都指派一次。<br />
            鸡：01、13、25、37、49<br />
            猴：02、14、26、38<br />
            羊：03、15、27、39<br />
            马：04、16、28、40<br />
            蛇：05、17、29、41<br />
            龙：06、18、30、42<br />
            兔：07、19、31、43<br />
            虎：08、20、32、44<br />
            牛：09、21、33、45<br />
            鼠：10、22、34、46<br />
            猪：11、23、35、47<br />
            狗：12、24、36、48<br />
            23.平特尾数<br />
            指开奖的7个号码中含有所属生肖的一个或多个号码，但派彩指派一次，即不论同生肖号码出现一个或多个号码都指派一次。<br />
            "0"尾：10、20、30、40<br />
            "1"尾：01、11、21、31、41<br />
            "2"尾：02、12、22、32、42<br />
            "3"尾：03、13、23、33、43<br />
            "4"尾：04、14、24、34、44<br />
            "5"尾：05、15、25、35、45<br />
            "6"尾：06、16、26、36、46<br />
            "7"尾：07、17、27、37、47<br />
            "8"尾：08、18、28、38、48<br />
            "9"尾：09、19、29、39、49<br />
            例如：开奖结果正码号码为11、31、42、44、35、32特别号码为21则1尾2尾4尾5尾都为中奖，其他尾数都不中奖。<br />
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
               // $('#open-date').html(day + '天 ' + hour + ':' + min + ':' + sec);
                //$('#bet-date').html(ts_day + '天 ' + ts_hour + ':' + ts_min + ':' + ts_sec);
                $('#open-date .day').html(day + '天 ');
                $('#open-date .hour').html(hour);
                $('#open-date .minute').html(min);
                $('#open-date .second').html(sec);
                $('#bet-date .day').html(ts_day + '天 ');
                $('#bet-date .hour').html(ts_hour);
                $('#bet-date .minute').html(ts_min);
                $('#bet-date .second').html(ts_sec);
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
                $('#open-date .day').html(day + '天 ');
                $('#open-date .hour').html(hour);
                $('#open-date .minute').html(min);
                $('#open-date .second').html(sec);

                $('#bet-date .day').html(ts_day + '天 ');
                $('#bet-date .hour').html(ts_hour);
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
                            $.each(n.split(','),function(k,v){
                                $('#result_balls i:eq('+k+')').html(v);
                                var ballclass = $('#result_balls i:eq('+k+')').attr('class');
                                var ballclassArr = ballclass.split(' ');
                                ballclassArr[1] = 'bg_'+setBoss(v);
                                $('#result_balls i:eq('+k+')').attr('class',ballclassArr[0]+' '+ballclassArr[1]);
                                $('#result_balls i.squal1:eq('+k+')').html(getShuXiang(v));
                            })
                            $('.cur_turn_num').html(openStage+'期');
                        }
                        $('#next_turn_num').html(data.stage_next+'期');
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
                            $('#result_balls i:eq('+k+')').html(v);
                            var ballclass = $('#result_balls i:eq('+k+')').attr('class');
                            var ballclassArr = ballclass.split(' ');
                            ballclassArr[1] = 'bg_'+setBoss(v);
                            $('#result_balls i:eq('+k+')').attr('class',ballclassArr[0]+' '+ballclassArr[1]);
                        })
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
            var betType = $(".game_B3L li.active").attr('data-type');
            var limitNum = 0;
            switch(betType){
                case 'lm':
                    var titleType = $("#six-"+betType+" div.swiper-slide-active").attr('data-target-type');
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
                    if($('.game_tab .tab_box li.active').length<limitNum){
                        pop('下注内容不正确，请重新下注单');
                        return;
                    }
                    break;
                case 'lx':
                case 'lw':
                    var titleType = $("#six-"+betType+" div.swiper-slide-active").attr('data-target-type');
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
                    if($('.game_tab .tab_box li.active').length<limitNum){
                        pop('下注内容不正确，请重新下注单');
                        return;
                    }
                    break;
                case 'zxbz':
                    var titleType = $("#six-"+betType+" div.swiper-slide-active").attr('data-target-type');
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
                    if($('.game_tab .tab_box li.active').length<limitNum){
                        pop('下注内容不正确，请重新下注单');
                        return;
                    }
                    break;
                case 'hx':
                    if($('.game_tab .tab_box li.active').length<2){
                        pop('下注内容不正确，请重新下注单');
                        return;
                    }
                    break;
                default:
                    if(!$('.game_tab .tab_box li.active').length){
                        pop('下注内容不正确，请重新下注单');
                        return;
                    }
                    break;
            }
            var str = '';
            var totalMoney = 0;
            var totalBet = 0;
            $("#bcountVal").attr('data-hall',hall);
            switch (betType){
                case 'lm':
                case 'zxbz':
                case 'lx':
                case 'lw':
                    hall=1;
                    var titleType = $("#six-"+betType+" div.swiper-slide-active").attr('data-target-type');
                    var title = $("#six-"+betType+" div.swiper-slide-active").attr('data-target-num');
                    var money = $('.bet-money').val();
                    var unitPrice='';
                    var ruleArr=[];
                    $.each($('.game_tab .tab_box li.active'),function(k,v){
                        ruleArr.push($(v).attr('data-num'));
                        unitPrice = $(v).parent().attr('data-target-odds');
                    })
                    var ruleData = permutations(ruleArr,limitNum);
                    $.each(ruleData,function (i,j) {
                        var type = j.join(',');
                        str += '<p data-target-type="'+titleType+'" data-target-odds="'+unitPrice+'" data-target-money="'+money+'" data-target-num="'+type+'" class="mg_top10 color_55">【'+title+'-'+type+'】'+unitPrice+'*'+money+'</p>';
                        totalMoney = totalMoney*1 + money*1;
                        totalBet ++;
                    })
                    break;
                case 'hx':
                    hall=1;
                    var titleType = $("#six-"+betType+" div.swiper-slide-active").attr('data-target-type');
                    var title = $("#six-"+betType+" div.swiper-slide-active").attr('data-target-num');
                    var money = $('.bet-money').val();
                    var unitPrice=$("#oddsSpan").text();
                    var ruleArr=[];
                    $.each($('.game_tab .tab_box li.active'),function(k,v){
                        ruleArr.push($(v).attr('data-num'));
                    })
                    var type = ruleArr.join(',');
                    str += '<p data-target-type="'+titleType+'" data-target-odds="'+unitPrice+'" data-target-money="'+money+'" data-target-num="'+type+'" class="mg_top10 color_55">【'+title+'-'+type+'】'+unitPrice+'*'+money+'</p>';
                    totalMoney = totalMoney*1 + money*1;
                    totalBet ++;
                    break;
                case 'tm':
                    hall= $(".game_tab .tab_box div.lhc_show").attr('data-hall');
                    $("#bcountVal").attr('data-hall',hall);
                default:
                    hall=1;
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
                    break;
            }
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
                console.log(22);
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
                var halls = $("#bcountVal").attr('data-hall');
                $.ajax({
                    url: "<?php echo url('betting'); ?>",
                    data:  {'data':betDataArr,'cate':cate,'hall':halls},
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
                    //$(v).html(oddsArr[cate][play_id]['rate']);
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
        },300)
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
<script src="__JS__/wap/jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
<script src="__JS__/wap/swiper.min.js" type="text/javascript" charset="utf-8"></script>
<script src="__JS__/wap/time.js" type="text/javascript" charset="utf-8"></script>
<script src="__JS__/wap/index.js" type="text/javascript" charset="utf-8"></script>
<script>
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 4,
        spaceBetween: 0,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
    function setBoss(num) {
        var str = '';
        var bose ={
            'red':['01','02','07','08','12','13','18','19','23','24','29','30','34','35','40','45','46'],
            'blue':['03','04','09','10','14','15','20','25','26','31','36','37','41','42','47','48'],
            'green':['05','06','11','16','17','21','22','27','28','32','33','38','39','43','44','49']
        };
        $.each(bose,function (i,j) {
            if($.inArray(num,j) != -1){
                str =  i;
                return false;
            }
        })
        return str;
    }
</script>
</body>
</html>