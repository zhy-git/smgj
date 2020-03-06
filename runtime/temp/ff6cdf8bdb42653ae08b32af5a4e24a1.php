<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:57:"/www/wwwroot/smgj/public/../app/home/view/agent/link.html";i:1539574095;s:63:"/www/wwwroot/smgj/public/../app/home/view/common/index_top.html";i:1540627555;s:68:"/www/wwwroot/smgj/public/../app/home/view/common/index_siderbar.html";i:1541410557;}*/ ?>
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
	<script src="__JS__/jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="__JS__/jquery.validate.min.js"></script>
	<script src="__JS__/layer.js" ></script>
	<script src="__JS__/common.js" ></script>
	<script src="__JS__/clipboard.min.js" ></script>
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
							<h4 class="h4 padding_10 bor_b">推广链接</h4>
							<form action="" method="post" id="linkForm">
								<div class="padding_10 clearfix">
									<div class="left">
										用户类型：
										<i>
											<input type="radio" name="agent_user" id="agent_user3" value="1"/>
											<label for="agent_user">总代理</label>
										</i>
										<i>
											<input type="radio" name="agent_user" id="agent_user" value="2"/>
											<label for="agent_user">一级代理</label>
										</i>
										<i>
											<input type="radio" name="agent_user" id="agent_user2" value="3"/>
											<label for="agent_user">二级代理</label>
										</i>
										<i>
											<input type="radio" name="agent_user" id="agent_user1" value="0" checked/>
											<label for="agent_user1">普通用户</label>
										</i>
									</div>
									<div class="right">
										<span>彩票返点</span>
										<!--<select name="rebate">-->
											<!--<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ll): $mod = ($i % 2 );++$i;?>-->
											<!--<option value="<?php echo $ll['rebate']; ?>,<?php echo $ll['bonus']; ?>">返点：<?php echo $ll['rebate']; ?>  奖金：<?php echo $ll['bonus']; ?></option>-->
											<!--<?php endforeach; endif; else: echo "" ;endif; ?>-->
										<!--</select>-->
										<input type="text" name="back_rebate" placeholder="代理返点"/>
									</div>
								</div>
								<div class="padding_10">
									备注：<input type="text" name="remark" placeholder="备注不可不输入"/>
								</div>
								<div class="padding_10">
									<a href="javascript:;" id="createLink" class="btn marginleft30">生成链接</a>
								</div>
							</form>
							<div class="table_box">
								<table border="" cellspacing="" cellpadding="">
									<tr>
										<th>备注</th>
										<th>注册类型</th>
										<th>返点级别</th>
										<th>自动注册链接</th>
										<th>二维码</th>
										<th>操作</th>
									</tr>
									<?php if(!empty($addLink)): if(is_array($addLink) || $addLink instanceof \think\Collection || $addLink instanceof \think\Paginator): $i = 0; $__LIST__ = $addLink;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$all): $mod = ($i % 2 );++$i;?>
									<tr>
										<td><?php echo $all['remark']; ?></td>
										<td><?php echo $all['is_agent']; ?></td>
										<td><?php echo $all['back_rebate']; ?></td>
										<td ><a href="javascript:;" id="copyLink" class="text_ovf link_a"><?php echo $all['link']; ?></a></td>
										<td><img src="/<?php echo $all['qrcode']; ?>" alt="" width="120"></td>
										<td>
											<a href="javascript:;" id="copy" data-clipboard-text="<?php echo $all['link']; ?>" class="btn">复制</a>
											<a href="javascript:;" data-id="<?php echo $all['id']; ?>" id="del" class="btn dell_a">删除</a>
										</td>
									</tr>
									<?php endforeach; endif; else: echo "" ;endif; else: ?>
									<tr>
										<td colspan="5">暂无数据</td>
									</tr>
									<?php endif; ?>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="__JS__/laydate/laydate.js" type="text/javascript" charset="utf-8"></script>
<script src="__JS__/laydate.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript">
	var createLinkCheck = true;
    $(".agent").hover(function(){
        $("#agent_list").fadeIn(200);
    },function(){
        $("#agent_list").fadeOut(200);
    })
    $(".lottery_box_one").hover(function(){
        $("#lottery_list").fadeIn(200);
    },function(){
        $("#lottery_list").fadeOut(200);
    })
    $(".main-wrap").css("height",$(document).height()-180 );
    $('#createLink').click(function(){
        $('#linkForm').serialize();
        var self = $('#linkForm');
        var rules = {
                agent_user : {
                    required : true
                },
                remark : {
                    required : true,
                    rangelength : [1,10],

                },
                rebate : {
                    required : true
                }
            },
            messages = {
                agent_user : {
                    required : '请选择账号类型'
                },
                remark : {
                    required : '请输入备注信息',
                    rangelength : '备注只能填写10个字符',
                },
                rebate : {
                    required : '请选择返点等级'
                }
            };
        if(!check_validate(self,rules,messages).form()){
            return false;
        }
        if(createLinkCheck) {
            createLinkCheck = false;
            $.post("<?php echo url('createLink'); ?>", self.serialize(), success, "json");
            return false;
            function success(data) {
                if (data.code == 1) {
                    pop(data.msg, data.url, 1);
                } else {
                    pop(data.msg);
                    createLinkCheck = true;
                }
            }
        }
	})
    var delCheck = true;
	$('#del').click(function(){
	    var dataId = $(this).attr('data-id');
	    console.log(dataId);
        if(delCheck) {
            delCheck = false;
            $.post("<?php echo url('delLink'); ?>", {id:dataId}, success, "json");
            return false;
            function success(data) {
                if (data.code == 1) {
                    pop(data.msg, data.url, 1);
                } else {
                    pop(data.msg);
                    delCheck = true;
                }
            }
        }
	})
    $(document).ready(function(){
        var clipboard = new Clipboard('#copy');
        clipboard.on('success', function(e) {
            pop('复制成功');
        });
        clipboard.on('error', function(e) {
            alert("复制失败！请手动复制");
        });
    })
</script>
</body>
</html>
