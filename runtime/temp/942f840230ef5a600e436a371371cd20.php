<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:59:"/www/wwwroot/smgj/public/../app/home/view/center/index.html";i:1539416225;s:63:"/www/wwwroot/smgj/public/../app/home/view/common/index_top.html";i:1540627555;s:68:"/www/wwwroot/smgj/public/../app/home/view/common/index_siderbar.html";i:1541410557;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>个人中心</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta HTTP-EQUIV="Pragma" CONTENT="no-cache">
    <meta HTTP-EQUIV="Expires" CONTENT="-1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <link rel="shortcut icon" href="__IMG__/favicon.ico" />
    <link rel="bookmark" href="__IMG__/favicon.ico" type="image/x-icon"　/>
    <link rel="stylesheet" type="text/css" href="__CSS__/style.css"/>
    <link rel="stylesheet" type="text/css" href="__CSS__/skin.css"/>
    <link rel="stylesheet" type="text/css" href="__CSS__/common.css"/>
    <link rel="stylesheet" href="__CSS__/index.css">
    <link type="text/css" rel="stylesheet" href="__CSS__/chat-index.css">
    <link rel="stylesheet" type="text/css" href="__CSS__/index-index-inde.css"/>
    <link rel="stylesheet" type="text/css" href="__CSS__/index_sy.css"/>
    <script src="__JS__/jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="__JS__/jquery.validate.min.js"></script>
    <script src="__JS__/layer.js" ></script>
    <script src="__JS__/common.js" ></script>
    <style type="text/css">
        .subnaviarrow,.recharge_div,.subcontent,.addbankcard_form{display: none;}
        .subnaviarrow.active,.recharge_div.active,.subcontent.active{display: block;}
        .records_ul li{
            float: left;
            width: 25%;
            margin: 0 3%;
            border: 1px solid #D3D1D1;
            border-radius: 5px;
            padding: 10px;
        }
        .records_choose span{
            padding: 10px;
        }
        .records_choose select,.records_choose input{
            width: 300px;
            border-radius:5px ;
            border: 1px solid #D3D1D1;
            padding: 10px 5px;
        }
        .records_choose label{width: 70px;}
        .header .lotterys .show>a{height: 37px;line-height: 37px;}
        .header .menu2{left: 705px;}
        .logo2 {left: 0; }
        .info span{display: inline;}
        input[type="number"]{-moz-appearance:textfield;}
        input::-webkit-outer-spin-button,input::-webkit-inner-spin-button{-webkit-appearance: none !important;}
    </style>
</head>
<body>
<div id="appLoading" class="bet-loading" style="position: fixed; width: 100%; top: 200px; text-align: center; z-index: 3000; display: none;">
    <div class="spinner">
        <div class="three-bounce">
            <div class="one"></div>
            <div class="two">

            </div>
            <div class="three"></div>
        </div>
    </div>
</div>
<div class="main-body skin_red" style="right: 0px;">
    <div class="header">
    <div class="header-top clearfix">
        <div class="header_top_center">
            <div class="logo2">
                <img src="__IMG__/logo.png" alt="最专业彩票网" height="53">
            </div>

            <div class="menu2">
                <span>欢迎您：<i><?php echo $memInfo['name']; ?></i></span>

                <span id="skinPanel">
                                     余额显示<img class="padding_lr10" src="__IMG__/ye.png" alt="" />
			                        <ul>
			                        	<li>钱包余额：<span>￥<?php echo $memMoney['money']; ?></span></li>
			                        	<!--<li>AG余额：<span>￥<?php echo $memMoney['ag_money']; ?></span></li>-->
			                        	<!--<li>SS余额：<span>￥<?php echo $memMoney['bb_money']; ?></span></li>-->
			                        </ul>
			    			</span>
                <?php if(!session('member_info.is_temporary')): ?>
                <span><a href="<?php echo url('Center/index'); ?>"> 额度转换</a><img class="padding_lr5" src="__IMG__/ed.png" alt="" /></span> <!----> <br> <!---->
                <?php endif; ?>
            </div>

            <div class="menu3">
                <a href="<?php echo url('Account/recharge'); ?>" class="" style="padding-right: 10px;">充值&提现</a>
                <a href="<?php echo url('Login/out'); ?>" class="logout">退出</a>
            </div>
        </div>
    </div>

    <div class="header-middle lotterys">
        <div class="show">
            <ul class="clearfix lottery_box" >
                <li class="lottery_box_one">
                    <a	>彩票游戏</a>
                    <ul id="lottery_list" >
                        <li><a href="<?php echo url('Pcdd/index',['cate'=>1,'hall'=>1]); ?>"><img src="__IMG__/icon06.png" alt="" /> PC蛋蛋 </a></li>
                        <li><a href="<?php echo url('Jndeb/index',['cate'=>2,'hall'=>1]); ?>"><img src="__IMG__/icon07.png" alt="" /> 加拿大28 </a></li>
                        <li><a href="<?php echo url('Car/index',['cate'=>5,'hall'=>1]); ?>"><img src="__IMG__/icon01.png" alt="" /> 北京赛车</a></li>
                        <li><a href="<?php echo url('Xyft/index',['cate'=>7,'hall'=>1]); ?>"><img src="__IMG__/icon03.png" alt="" /> 幸运飞艇</a></li>
                        <li><a href="<?php echo url('Cqssc/index',['cate'=>3,'hall'=>1]); ?>"><img src="__IMG__/icon02.png" alt="" /> 重庆时时彩</a></li>
                        <li><a href="<?php echo url('Xglhc/index',['cate'=>8,'hall'=>1]); ?>"><img src="__IMG__/icon09.png" alt="" /> 香港六合彩</a></li>
                        <li><a href="<?php echo url('Mssc/index',['cate'=>6,'hall'=>1]); ?>"><img src="__IMG__/icon08.png" alt="" /> 极速赛车</a></li>
                        <li><a href="<?php echo url('Msssc/index',['cate'=>4,'hall'=>1]); ?>"><img src="__IMG__/icon07.png" alt="" /> 极速时时彩</a></li>
                    </ul>
                </li>
                <li><a href="<?php echo url('Index/index'); ?>">首页</a></li>
                <!--<li><a href="<?php echo url('Car/index'); ?>">游戏大厅</a></li>-->
                <!--<li><a href="<?php echo url('Real/index?type=AG'); ?>" target="_blank">真人娱乐</a></li>-->
                <!--<li><a href="<?php echo url('Real/index?type=SS'); ?>" target="_blank">体育投注</a></li>-->
                <?php if(!session('member_info.is_temporary')): ?>
                <li><a href="<?php echo url('Center/index'); ?>">个人中心</a></li>
                <?php if(session('member_info.is_proxy')): ?>
                <li class="agent">
                    <a href="<?php echo url('Agent/index'); ?>">代理中心</a>
                    <ul id="agent_list" >
                        <li><a href="<?php echo url('Agent/index?type=add'); ?>"><img src="__IMG__/ico101.png" alt="" />新增用户</a></li>
                        <li><a href="<?php echo url('Agent/index?type=link'); ?>"><img src="__IMG__/ico102.png" alt="" />推广链接</a></li>
                        <li><a href="<?php echo url('Agent/index?type=report'); ?>"><img src="__IMG__/ico103.png" alt="" />盈亏报表</a></li>
                        <li><a href="<?php echo url('Agent/index?type=betRecord'); ?>"><img src="__IMG__/ico104.png" alt="" />投注记录</a></li>
                        <li><a href="<?php echo url('Agent/index?type=accountRecord'); ?>"><img src="__IMG__/ico105.png" alt="" />账变记录</a></li>
                        <li><a href="<?php echo url('Agent/index?type=manageTeam'); ?>"><img src="__IMG__/ico105.png" alt="" />团队管理</a></li>
                    </ul>
                </li>
                <?php else: ?>
                <li><a href="<?php echo url('Agent/index?type=accountRecord'); ?>">账变记录</a></li>
                <?php endif; endif; ?>
                <li><a href="<?php echo url('Download/index'); ?>">客服端下载</a></li>
            </ul>
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
                    <div><label>账号：</label><span id="userinfo_name"><?php echo $memInfo['name']; ?></span></div>
                    <div>
                        <label>彩票余额：</label><span class="balance" id="memMoney"><?php echo bcadd($memMoney['money'],0,2); ?></span>
                    </div>
                    <!--<div>-->
                        <!--<label>AG余额：</label><span class="balance" id="memAgMoney"><?php echo $memMoney['ag_money']; ?></span>-->
                        <!--<a href="javascript:void(0)" title="点击刷新消息" id="refreshRealMoneyAg" onclick="refreshRealMoney('AG')">-->
                            <!--<img alt="点击刷新消息" src="__IMG__/refresh.png" width="18" height="18" title="点击刷新消息">-->
                        <!--</a>-->
                    <!--</div>-->
                    <!--<div>-->
                        <!--<label>SS余额：</label><span class="balance" id="memBbMoney"><?php echo $memMoney['bb_money']; ?></span>-->
                        <!--<a href="javascript:void(0)" title="点击刷新消息" id="refreshRealMoneySs" onclick="refreshRealMoney('SS')">-->
                            <!--<img alt="点击刷新消息" src="__IMG__/refresh.png" width="18" height="18" title="点击刷新消息">-->
                        <!--</a>-->
                    <!--</div>-->
                    <div>
                        <label>未结金额：</label><span class="betting" id="memUnMoney"><?php echo bcadd($memMoney['unpaid_money'],0,2); ?></span>
                        <a href="javascript:void(0)" title="点击刷新消息" id="refreshMoney" onclick="refreshMoney()"><img alt="点击刷新消息" src="__IMG__/refresh.png" width="18" height="18" title="点击刷新消息"></a>
                    </div>
                </div>
            </li>
            <li class="r-wrap r-nowrap1 link">
                <a href="<?php echo url('Center/index'); ?>" class="r-bg personal_a">个人中心</a> <img src="__IMG__/msg_new2.png" class="new" >
            </li>
            <li class="r-wrap r-nowrap1"><div>最新注单</div></li>
        </ul>
    </div>
    <div class="sider-col2"><!---->

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
</script>
        <div class="content-wrap" style="width: 1000px;border: 1px solid #D2D2D2;">
            <div class="content">
                <div class="sub-wrap clearfix">
                    <div class="center-page">
                        <div class="memberheader">
                            <div class="useravatar floatleft">
                                <img src="__IMG__/userlogo.jpg" width="84" height="83" alt="">
                            </div>
                            <div class="memberinfo floatleft">
                                <h1 class="floatleft">您好, <span id="userName" class="blue"><?php echo $memInfo['name']; ?></span></h1>
                                <!--<div class="balance floatleft">-->
                                    <!--<div class="balancevalue floatleft">-->
                                        <!--中心钱包 : <span class="blue"><span class="balanceCount">0</span> 元</span>-->
                                    <!--</div>-->
                                    <!--<div class="floatright margintop7 marginright10 marginleft5 pointer">-->
                                        <!--<a href="javascript:;"><img src="__IMG__/btnrefresh.jpg" width="16" height="17" alt=""></a>-->
                                    <!--</div>-->
                                <!--</div>-->
                                <div class="gap5"></div>
                                <p>彩票网投领导者·实力铸就品牌·诚信打造一切·相信品牌的力量</p>
                                <!--<p>最后登录：<span id="loginTime">2018-01-23 09:38:14</span></p>-->
                            </div>
                        </div>
                        <div class="membersubnavi">
                            <!--<div class="subnavi blue">-->
                                <!--<a href="javascript:void(0)">额度转换</a>-->
                                <!--<div class="subnaviarrow active" >-->
                                <!--</div>-->
                            <!--</div>-->
                            <div class="subnavi blue">
                                <a href="javascript:void(0)">密码设置</a>
                                <div class="subnaviarrow active"></div>
                            </div>
                            <div class="subnavi blue">
                                <a href="javascript:void(0)">资金密码</a>
                                <div class="subnaviarrow "></div>
                            </div>
                        </div>
                        <!--<div class="recharge_div active">-->
                            <!--<form id="changeMoneyForm" action="<?php echo url('changeMoney'); ?>">-->
                                <!--<div class="records margintop20">-->
                                <!--<h4 class="h4 padding_10 bor_b">钱包中心</h4>-->
                                <!--<ul class="clearfix records_ul mg_top40">-->
                                    <!--<li>钱包余额：<span class="red1"><?php echo $memMoney['money']; ?></span></li>-->
                                    <!--<li>AG余额：<span class="red1"><?php echo $memMoney['ag_money']; ?></span></li>-->
                                    <!--<li>SS余额：<span class="red1"><?php echo $memMoney['bb_money']; ?></span></li>-->
                                <!--</ul>-->
                                <!--<h4 class="h4 padding_10 bor_b mg_top40">游戏平台转账</h4>-->
                                <!--<div class="records_choose">-->
								    	<!--<span>-->
								    		<!--<label for="">转账从：</label>-->
								    		<!--<select name="type" id="moneySel">-->
								    			<!--<option value="1">钱包余额</option>-->
								    			<!--<option value="2">AG余额</option>-->
								    			<!--<option value="3">SS余额</option>-->
								    		<!--</select>-->
								    	<!--</span>-->
                                        <!--<span>-->
								    		<!--<label for="">转账到：</label>-->
								    		<!--<select name="typeSec" id="moneySelSec">-->
								    			<!--<option value="2">AG余额</option>-->
								    			<!--<option value="3">SS余额</option>-->
								    		<!--</select>-->
								    	<!--</span>-->
                                <!--</div>-->
                                <!--<div class="records_choose">-->
								       	<!--<span>-->
									    	<!--<label for="">转账金额：</label>-->
									    	<!--<input type="number" name="money" value="" maxlength="6" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" />-->
								    	<!--</span>-->
                                <!--</div>-->
                                <!--<div class="records_choose">-->
								    	<!--<span>-->
									    	<!--<label for="">资金密码：</label>-->
									    	<!--<input type="password" name="money_password" value="" />-->
								    	<!--</span>-->
                                <!--</div>-->
                                <!--<p><input type="button" name="" id="changeMoney" value="提交" class="btn marginleft30" /></p>-->
                            <!--</div>-->
                            <!--</form>-->
                        <!--</div>-->
                        <div class="recharge_div active">
                            <div class="subcontent1 margintop20">
                                <form class="el-form formpanel margintop20" id="resetLoginPass"><!---->
                                    <div class="el-form-item wd-row is-required"><!---->
                                        <div class="el-form-item__content">
                                            <div class="wd-col1">当前密码：</div>
                                            <div class="wd-col2"><input type="password" name="oldpassword" class="textfield1"></div><!---->
                                        </div>
                                    </div>
                                    <div class="el-form-item wd-row is-required"><!---->
                                        <div class="el-form-item__content">
                                            <div class="wd-col1">新密码：</div>
                                            <div class="wd-col2"><input type="password" name="password" class="textfield1"></div><!---->
                                        </div>
                                    </div>
                                    <div class="el-form-item wd-row is-required"><!---->
                                        <div class="el-form-item__content">
                                            <div class="wd-col1">确认密码：</div>
                                            <div class="wd-col2">
                                                <input type="password" name="repassword" class="textfield1"></div><!---->
                                        </div>
                                    </div>
                                    <div class="wd-row" style="text-align: center;">
                                        <div><input type="button" id="subLogin" value="提交" class="c-button"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="recharge_div">
                            <div class="subcontent1 margintop20">
                                <form class="el-form formpanel margintop20" id="setMoneyPass">
                                    <div class="el-form-item wd-row is-required" id="oldMoneyPass">
                                        <div class="el-form-item__content">
                                            <div class="wd-col1">当前资金密码：</div>
                                            <div class="wd-col2"><input type="password" name="oldpassword" class="textfield1"></div><!---->
                                        </div>
                                    </div>
                                    <div class="el-form-item wd-row is-required"><!---->
                                        <div class="el-form-item__content">
                                            <div class="wd-col1">资金密码：</div>
                                            <div class="wd-col2"><input type="password" name="newpassword" class="textfield1"></div><!---->
                                        </div>
                                    </div>
                                    <div class="el-form-item wd-row is-required">
                                        <div class="el-form-item__content">
                                            <div class="wd-col1">重复密码：</div>
                                            <div class="wd-col2">
                                                <input type="password" name="renewpassword" class="textfield1"></div>
                                        </div>
                                    </div>
                                    <div class="wd-row" style="text-align: center;">
                                        <div><input type="button" id="subSetMoney" value="提交" class="c-button"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="cont-sider"><!----></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(".membersubnavi .subnavi ").click(function(){
        var index =$(this).index();
        $(this).children(".subnaviarrow").addClass("active");
        $(this).siblings().children(".subnaviarrow").removeClass("active");
        $(".recharge_div").eq(index).addClass("active").siblings().removeClass("active");
    })
    $(".tabs .tab").click(function(){
        var index =$(this).index()-1;
        $(this).addClass("tabactive").siblings().removeClass("tabactive");
        $(".subcontent").eq(index).addClass("active").siblings().removeClass("active");
    })
    $(".addbankcard_img").click(function(){
        $(".addbankcard_form").show();
        $(".addbankcard").hide();
    })
    $(".lottery_box_one").hover(function(){
        $("#lottery_list").fadeIn(200);
    },function(){
        $("#lottery_list").fadeOut(200);
    })
    $(".agent").hover(function(){
        $("#agent_list").fadeIn(200);
    },function(){
        $("#agent_list").fadeOut(200);
    })
    function checkMoneyPass(){
        $.ajax({
            url: "<?php echo url('checkMoneyPass'); ?>",
            data:{type:1},
            type: 'POST',
            dataType: "json",
            success: function (data) {
                if(data.code == 0){
                    $(".membersubnavi .subnavi:eq(2)").click();
                    $('#oldMoneyPass').css('display','none');
                    pop(data.msg);
                }else{
                    $('#oldMoneyPass').css('display','block');
                }
            }
        });
    }
    $(".membersubnavi .subnavi:eq(0)").click(function(){
        checkMoneyPass();
    });
    $(function(){
        setTimeout(function(){
            checkMoneyPass();
        },1000);
        $('#moneySel').change(function(){
            var str = '';
            var val = $(this).val();
            switch (val){
                case '2':
                    str += '<option value="1">钱包余额</option>';
                    break;
                case '3':
                    str += '<option value="1">钱包余额</option>';
                    break;
                default:
                    str += '<option value="2">AG余额</option>';
                    str += '<option value="3">SS余额</option>';
                    break;
            }
            $('#moneySelSec').html(str);
        });
        var subCheck = true;
        $("#changeMoney").click(function(){
            $('#changeMoneyForm').serialize();
            var self = $('#changeMoneyForm'),
                rules = {
                    type : {
                        required : true
                    },
                    typeSec : {
                        required : true
                    },
                    money_password : {
                        required : true,
                        rangelength : [6,6],
                        stringCheck : true
                    },
                    money : {
                        required : true,
                        isIntAndGtZero : true
                    }
                },
                messages = {
                    type : {
                        required : '请选择转账类型'
                    },
                    typeSec : {
                        required : '请选择转账类型'
                    },
                    money_password : {
                        required : '请输入资金密码',
                        rangelength : '密码长度6位数'
                    },
                    money : {
                        required : '请输入金额',
                        isIntAndGtZero : '输入金额格式不正确'
                    }
                };
            if(!check_validate(self,rules,messages).form()){
                return false;
            }
            if(subCheck) {
                subCheck = false;
                $.ajax({
                    url:"<?php echo url('changeMoney'); ?>",
                    type: "POST",
                    data:self.serialize(),
                    success : function(data) {
                        if (data.code == 1) {
                            pop(data.msg,data.url,3);
                        } else {
                            pop(data.msg);
                            subCheck = true;
                        }
                    },
                    error: function() {
                        //warningMessage("查询失败")
                    },
                    beforeSend: function() {
                        index = layer.load(0, {shade: [0.5, '#393D49']});
                        //$('#reportList').html('<tr><td colspan="13"><img src="/static/home/img/803.gif"><br>正在查询</td></tr>');
                    },
                    complete: function() {
                        layer.close(index);
                    }
                })
            }
        });
        var subSetMoneyCheck = true;
        $('#subSetMoney').click(function () {
            var self = $('#setMoneyPass');
            if($('#id').css('display') == 'none'){
                var rules = {
                    newpassword : {
                        required : true,
                        rangelength : [6,6],
                        stringCheck : true
                    },
                    renewpassword : {
                        required : true,
                        rangelength : [6,6],
                        equalTo : '#setMoneyPass input[name=password]'
                    }
                };
            }else{
                var rules = {
                    oldpassword : {
                        required : true,
                        rangelength : [6,6],
                        stringCheck : true
                    },
                    newpassword : {
                        required : true,
                        rangelength : [6,6],
                        stringCheck : true
                    },
                    renewpassword : {
                        required : true,
                        rangelength : [6,6],
                        equalTo : '#setMoneyPass input[name=newpassword]'
                    }
                };
            }
            var messages = {
                oldpassword : {
                    required : '请输入原始资金密码',
                    rangelength : '密码长度需要6位',
                    stringCheck : '密码只能包含英文、数字、下划线'
                },
                newpassword : {
                    required : '请输入密码',
                    rangelength : '密码长度需要6位',
                    stringCheck : '密码只能包含英文、数字、下划线'
                },
                renewpassword : {
                    required : '两次密码输入不一致',
                    rangelength : '两次密码输入不一致',
                    equalTo : '两次密码输入不一致'
                }
            };
            if(!check_validate(self,rules,messages).form()){
                return false;
            }
            if(subSetMoneyCheck) {
                subSetMoneyCheck = false;
                $.post("<?php echo url('subMoneyReset'); ?>", self.serialize(), success, "json");
                return false;
                function success(data) {
                    if (data.code == 1) {
                        pop(data.msg);
                        self[0].reset();
                    } else {
                        pop(data.msg);
                    }
                    subSetMoneyCheck = true;
                }
            }
        })
        var subLoginCheck = true;
        $("#subLogin").click(function(){
            $('#resetLoginPass').serialize();
            var self = $('#resetLoginPass'),
                rules = {
                    oldpassword : {
                        required : true,
                        rangelength : [6,12],
                        stringCheck : true
                    },
                    password : {
                        required : true,
                        rangelength : [6,12],
                        stringCheck : true
                    },
                    repassword : {
                        required : true,
                        rangelength : [6,12],
                        equalTo : '#resetLoginPass input[name=password]'
                    }
                },
                messages = {
                    oldpassword : {
                        required : '请输入原始密码',
                        rangelength : '密码长度6到12之间',
                        stringCheck : '密码只能包含英文、数字、下划线'
                    },
                    password : {
                        required : '请输入密码',
                        rangelength : '密码长度6到12之间',
                        stringCheck : '密码只能包含英文、数字、下划线'
                    },
                    repassword : {
                        required : '两次密码输入不一致',
                        rangelength : '两次密码输入不一致',
                        equalTo : '两次密码输入不一致'
                    }
                };
            if(!check_validate(self,rules,messages).form()){
                return false;
            }
            if(subLoginCheck) {
                subLoginCheck = false;
                $.post("<?php echo url('subLoginReset'); ?>", self.serialize(), success, "json");
                return false;
                function success(data) {
                    if (data.code == 1) {
                        pop(data.msg);
                        self[0].reset();
                    } else {
                        pop(data.msg);
                    }
                    subLoginCheck = true;
                }
            }
        })
    });

</script>
</body>
</html>
