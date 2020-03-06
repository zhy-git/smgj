<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:59:"/www/wwwroot/smgj/public/../app/home/view/agent/report.html";i:1539401436;s:63:"/www/wwwroot/smgj/public/../app/home/view/common/index_top.html";i:1540627555;s:68:"/www/wwwroot/smgj/public/../app/home/view/common/index_siderbar.html";i:1541410557;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>代理中心</title>
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
						<div class="recharge_div active">
							<h4 class="h4 padding_10 bor_b">盈亏报表</h4>
							<form action="" id="yingkuiForm" method="post">
								<div class="padding_10">
									<span>用户名：<input name="username" type="text" /></span>
									<span class="marginleft30">
											时间
											<input type="text" readonly="readonly" class="demo-input" name="rangeTime" placeholder="请选择日期" id="rangeTime" lay-key="1">
										</span>
									<a href="javascript:;" id="querybutton" class="btn marginleft30">搜索</a>
								</div>
							</form>
							<div class="table_box">
								<table border="" cellspacing="" cellpadding="">
									<tr>
										<th>用户名</th>
										<th>级别</th>
										<th>充值</th>
										<th>提现</th>
										<th>投注</th>
										<th>撤单</th>
										<th>中奖</th>
										<th>返利</th>
										<th>活动</th>
										<th>转入</th>
										<th>转出</th>
										<th>其他</th>
										<th>回水</th>
										<th>返水</th>
										<th>盈亏</th>
										<!--<th>操作</th>-->
									</tr>
									<tbody id="reportList">
										<tr><td valign="top" colspan="12" class="dataTables_empty"><img src="__IMG__/803.gif"><br>正在查询</td></tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="__JS__/jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
<script src="__JS__/laydate/laydate.js" type="text/javascript" charset="utf-8"></script>
<script src="__JS__/laydate.js" type="text/javascript" charset="utf-8"></script>
<script src="__JS__/jquery.validate.min.js"></script>
<script src="__JS__/common.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
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
    laydate.render({
        elem: '#rangeTime',
		//type: true,
        theme: '#86384e',
        min: "<?php echo $time['start']; ?>",
        max: "<?php echo $time['end']; ?>",
        range: '~',
        format: 'y-M-d'
    });
    //删除
    $(".dell_a").click(function(){
        $(this).parent().parent().remove();
    })
    $(".main-wrap").css("height",$(document).height()-180 );
	$(function(){
        $('#querybutton').click(function(){
            getData("<?php echo url('yingkui'); ?>");
        });
        setTimeout(function(){
            $('#querybutton').click();
		},1000);
	});
    function getData(page){
        $('#yingkuiForm').serialize();
        var self = $('#yingkuiForm');
        if(page){
            var url = page;
        }else{
            var url = "<?php echo url('yingkui'); ?>";
        }
        $.ajax({
            url: url,
            type: "POST",
            data: self.serialize(),
            success: function(n) {
	//console.log(n);
                if(n.code == 1){
                    var str = '';
                    $.each(n.data,function(k,v){
                        str += '<tr>';
                        str += '<td>'+v.name+'</td>';
                        str += '<td>'+v.rebate+'</td>';
                        str += '<td>'+v.charge+'</td>';
                        str += '<td>'+v.cash+'</td>';
                        str += '<td>'+v.bet+'</td>';
                        str += '<td>'+v.cedan+'</td>';
                        str += '<td>'+v.win+'</td>';
                        str += '<td>'+v.back+'</td>';
                        str += '<td>'+v.act+'</td>';
                        str += '<td>'+v.in+'</td>';
                        str += '<td>'+v.out+'</td>';
                        str += '<td>'+v.other+'</td>';
                        str += '<td>'+v.self_back+'</td>';
                        str += '<td>'+v.proxy_back+'</td>';
                        str += '<td>'+accAdd(accAdd(accAdd(accAdd(accSub(v.win,v.bet),v.cedan),v.self_back),v.proxy_back),v.back)+'</td>';
                        str += '</tr>';
					});
                    $('#reportList').html(str);
                }else{
                    $('#reportList').html('<tr><td valign="top" colspan="16" class="dataTables_empty">查无资料</td></tr>');
                }
            },
            error: function() {
                //warningMessage("查询失败")
            },
            beforeSend: function() {
				$('#reportList').html('<tr><td colspan="16"><img src="/static/home/img/803.gif"><br>正在查询</td></tr>');
            },
            complete: function() {
                //hideloading()
            }
        })
    }
</script>
</body>
</html>
