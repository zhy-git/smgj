<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:64:"/www/wwwroot/smgj/public/../app/home/view/report/noterecord.html";i:1540543466;}*/ ?>
<html>
<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
	<title>历史记录</title>
	<meta name="renderer" content="webkit" />
	<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" >
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link rel="stylesheet" type="text/css" href="__CSS__/common.css"/>
	<link href="__CSS__/style.css" rel="stylesheet" type="text/css" />
	<link href="__CSS__/balls.css" rel="stylesheet" type="text/css" />
	<link href="__CSS__/skin.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="__CSS__/index.css"/>
</head>
<body class="iframe-body">
<div class="sub-wrap clearfix">
	<div class="cp-box1 center-page list_one_tab">
		<div class="search-bar" id="searchTab">
			<ul class="search_box clearfix">
				<li class="marginleft10">
					开始日期：<input id="StartTime" class="inp date" type="text">
					结束日期：<input id="EndTime" class="inp date" type="text">
				</li>
				<li><button type="button" class="btn" id="querybutton">查询</button></li>
			</ul>
		</div>
		<table id="preWeekTable" class="u-table2 play_tab_10">
			<thead>
			<tr>
				<th width="16%">日期</th>
				<th width="16%">注数</th>
				<th width="16%">下注金额</th>
				<th width="16%">返水</th>
				<th width="16%">盈亏</th>
				<th width="">查看注单</th>
			</tr>
			</thead>
			<tbody id="betCon">
				<tr class="trcolor"><td colspan="6"><div>  暂无数据</div></td></tr>
			</tbody>
		</table>
		<div style="text-align: center;" id="BetTable_paginate"></div>
	</div>
	<div class="cp-box1 list_two_tab">
		<div style="padding: 5px 0px; text-align: right;">
			<a href="javascript:void(0)" class="two_a">返回</a>
		</div>
		<table class="u-table2 play_tab_10">
			<thead>
			<tr><th width="16%">游戏</th> <th width="16%">注数</th> <th width="16%">下注金额</th> <th width="16%">返水</th> <th width="16%">盈亏</th> <th width="">查看注单</th></tr>
			</thead>
			<tbody id="cateList">
			</tbody>
		</table>
	</div>
	<div class="cp-box1 list_three_tab">
		<div id="params_dev" style="padding: 5px 0px; text-align: right;">
			<input type="hidden" id="betDate" value="">
			<!--<select>-->
				<!--<option value="80">秒速赛车</option>-->
				<!--<option value="50">北京赛车(PK10)</option>-->
				<!--<option value="82">秒速飞艇</option>-->
				<!--<option value="1">重庆时时彩</option>-->
				<!--<option value="81">秒速时时彩</option>-->
				<!--<option value="84">幸运蛋蛋</option>-->
				<!--<option value="85">幸运六合彩</option>-->
				<!--<option value="66">PC蛋蛋</option>-->
				<!--<option value="70">香港六合彩</option>-->
				<!--<option value="30">福彩3D</option>-->
				<!--<option value="61">重庆幸运农场</option>-->
				<!--<option value="83">幸运快乐8</option>-->
				<!--<option value="21">广东11选5</option>-->
				<!--<option value="65">北京快乐8</option>-->
				<!--<option value="10">江苏骰宝(快3)</option>-->
				<!--<option value="60">广东快乐十分</option>-->
				<!--<option value="4">新疆时时彩</option>-->
				<!--<option value="5">天津时时彩</option>-->
			<!--</select>-->
			<span><a href="javascript:void(0)" class="three_a">返回</a></span>
		</div>
		<div>
			<table class="u-table2">
				<thead>
				<tr><th class="u-tb3-th2" style="width: 110px; height: 26px; font-size: 13px; color: rgb(118, 45, 8);">定单号</th>
					<th class="u-tb3-th2" style="width: 100px; height: 26px; font-size: 13px; color: rgb(118, 45, 8);">时间</th>
					<th class="u-tb3-th2" style="width: 180px; height: 26px; font-size: 13px; color: rgb(118, 45, 8);">类型</th>
					<th class="u-tb3-th2" style="width: 220px; height: 26px; font-size: 13px; color: rgb(118, 45, 8);">玩法</th>
					<th class="u-tb3-th2" style="height: 26px; font-size: 13px; color: rgb(118, 45, 8);">下注金额</th>
					<th class="u-tb3-th2" style="height: 26px; font-size: 13px; color: rgb(118, 45, 8);">退水</th>
					<th class="u-tb3-th2" style="width: 100px; height: 26px; font-size: 13px; color: rgb(118, 45, 8);">
						<span id="column_desc">结果</span>
					</th>
				</tr>
				</thead>
				<tbody id="dataList">
				</tbody>
			</table>
			<!--<div class="page_info">-->
				<!--<div class="megas512" style="text-align: center; margin-top: 15px;">-->
					<!--<div class="el-pagination el-pagination&#45;&#45;small">-->
						<!--<button type="button" class="btn-prev disabled">-->
							<!--<i class="el-icon el-icon-arrow-left"></i>-->
						<!--</button>-->
						<!--<ul class="el-pager"><li class="number active">1</li>&lt;!&ndash;&ndash;&gt;&lt;!&ndash;&ndash;&gt;&lt;!&ndash;&ndash;&gt;</ul>-->
						<!--<button type="button" class="btn-next disabled"><i class="el-icon el-icon-arrow-right"></i></button>-->
					<!--</div>-->
				<!--</div>-->
			<!--</div>-->
		</div>
	</div>
	<div class="cont-sider"><!----></div>
</div>
</div>
<script src="__JS__/jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
<script src="__JS__/laydate/laydate.js" type="text/javascript" charset="utf-8"></script>
<script src="__JS__/laydate.js" type="text/javascript" charset="utf-8"></script>
<script src="__JS__/common.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    //开始时间时间
    var start = laydate.render({
        elem: '#StartTime',
        min: -30,
        max: '2099-06-16 23:59:59',
        theme: '#86384e',
        type:'date',
        done: function (value, date, endDate) {
            end.config.min = {
                year: date.year,
                month: date.month - 1,
                date: date.date,
                hours: date.hours,
                minutes: date.minutes,
                seconds: date.seconds
            }; //开始日选好后，重置结束日的最小日期
            end.config.value = {
                year: date.year,
                month: date.month - 1,
                date: date.date,
                hours: date.hours,
                minutes: date.minutes,
                seconds: date.seconds
            }; //将结束日的初始值设定为开始日
        }
    });
    //结束时间
    var end = laydate.render({
        elem: '#EndTime',
        min: -30,
        max: '2099-06-16 23:59:59',
        theme: '#86384e',
        type:'date',
        done: function (value, date, endDate) {
            start.config.max = {
                year: date.year,
                month: date.month - 1,
                date: date.date,
                hours: date.hours,
                minutes: date.minutes,
                seconds: date.seconds
            }; //结束日选好后，重置开始日的最大日期
        }
    });
    function p(s) {
        return s < 10 ? '0' + s: s;
    }
    function today(){
        var nowdate = new Date();
        var y = nowdate.getFullYear();
        var m = nowdate.getMonth()+1;
        var d = nowdate.getDate();
        $('#EndTime').val(p(y)+'-'+p(m)+'-'+p(d));
        $('#StartTime').val(p(y)+'-'+p(m)+'-'+p(d));
    }
    $(function() {
        today();
        workData.getData("<?php echo url('betRecord?page=1'); ?>");
    });
    $('#querybutton').click(function(){
        workData.getData("<?php echo url('betRecord?page=1'); ?>");
    });
    var workData = {
        data : '',
        getData : function(page) {
            var from = $('#searchTab #StartTime').val();
            var to = $('#searchTab #EndTime').val();
            // var lotteryId = $('#searchTab #LotteryGameId').val();
            // var target = $('#searchTab #SelectTarget').val();
            // var loginId = $('#searchTab #LoginID').val();
            // var issueNum = $('#searchTab #IssueSerialNumber').val();
            if(page){
                var url = page;
            }else{
                var url = "<?php echo url('betRecord'); ?>";
            }
            $.ajax({
                url: url,
                type: "POST",
                //data: {from: from, to: to, lotteryId:lotteryId, target:target, loginId:loginId, issueNum:issueNum},
                data: {from: from, to: to},
                success: function(n) {
                    console.log(n);
                    if (n.code == 1) {
                        workData.data = n.data;
                        var str = '';
                        // $.each(n.data.data,function(k,v){
                        //     str += '<tr><td>'+v.create_at+'</td>';
                        //     str += '<td>'+v.notes+'</td>';
                        //     str += '<td>'+v.money+'</td>';
                        //     str += '<td>0%</td>';
                        //     str += '<td>'+v.z_money+'</td>';
                        //     str += '<td><a class="ShowBetDetailRecord" id="'+v.id+'" data-hashkey="3" href="#" onclick="detail(this)">详情</a></td></tr>';
                        // })
                        // $('#betCon').html(str);
                        // $('#BetTable_paginate').html(n.page);
                        // pageAjax();
                        $.each(n.data,function(k,v){
                            str += '<tr><td>'+k+'</td>';
                            str += '<td>'+v.bet+'</td>';
                            str += '<td>'+v.money+'</td>';
                            str += '<td>0%</td>';
                            str += '<td>'+v.win+'</td>';
                            str += '<td><a class="ShowBetDetailRecord" id="'+v.id+'" data-date="'+k+'" href="#" onclick="workData.detail(this)">详情</a></td></tr>';
                        })
                        $('#betCon').html(str);
                    }else{
                        $('#betCon').html('<tr class="even"><td valign="top" colspan="10" class="dataTables_empty">查无资料</td></tr>');
                    }
                },
                error: function() {
                    //warningMessage("查询失败")
                },
                beforeSend: function() {
                    //showloading()
                },
                complete: function() {
                    //hideloading()
                }
            })
        },
		detail : function (_this) {
            var data = workData.data;
            $(".list_one_tab").hide();
            $(".list_two_tab").show();
            var dataDate = $(_this).attr('data-date')
            var str = '';
            $.each(data[dataDate]['cate'],function(k,v){
                str += '<tr><td>'+v.name+'-'+v.hall_name+'</td>';
                str += '<td>'+v.bet+'</td>';
                str += '<td>'+v.money+'</td>';
                str += '<td>'+v.fan+'</td>';
                str += '<td>'+v.win+'</td>';
                str += '<td><a href="javascript:;" data-date="'+dataDate+'" data-cate="'+k+'" onclick="workData.list(this)" class="list_two">注单详情</a></td></tr>';
			})
            $('#cateList').html(str);
            $(_this).attr('id');
        },
		list : function(_this){
            $(".list_two_tab").hide();
            $(".list_three_tab").show();
            var str = '';
            var data = workData.data;
			var date = $(_this).attr('data-date');
            var cate = $(_this).attr('data-cate');
            var newDate = new Date();
            $.each(data[date]['cate'][cate]['data'],function(k,v) {
                var hall = '';
                if(v.cate==2){
                    if(v.hall==1){
                        hall='A盘';
                    }else if(v.hall==2){
                        hall="1.85模式";
                    }else if(v.hall==3){
                        hall="1.6模式";
                    }
                }else{
                    if(v.hall==1){
                        hall='A盘';
                    }else if(v.hall==2){
                        hall="B盘";
                    }
                }
                newDate.setTime(v['create_at'] * 1000);
                str += '<tr><td class="f1" style="word-wrap: break-word; word-break: break-all;">'+v.id+'</td>';
                str += '<td class="f1">'+newDate.format('yyyy-MM-dd h:m:s')+'</td>';
                str += '<td class="f1">'+v.name+'-'+hall+'<br> 第&nbsp;<span style="color: rgb(41, 154, 38);">'+v.stage+'</span>&nbsp;期</td>';
                str += '<td class="f1 multiple">';
                str += '<span style="color: rgb(40, 54, 244);">'+v.title+'  '+v.number+' <span style="color: rgb(0, 0, 0);">@</span>';
                str += '<span style="color: red;">'+v.odds+'</span></span></td>';
                str += '<td class="f1">'+v.money+'</td>';
                str += '<td class="f1">0  (0%)</td>';
                if(v.z_money>0){
                    str += '<td class="f1"><span style="color: red;" title="开奖号码：'+v.open_number+'">'+accSub(v.z_money,v.money)+'</span></td></tr>';
                }else{
                    str += '<td class="f1"><span title="开奖号码：'+v.open_number+'">'+accSub(v.z_money,v.money)+'</span></td></tr>';
                }
            })
			$('#dataList').html(str);
		}
    }
    function pageAjax(){
        $(".pagination a").click(function() {
            var page = $(this).attr("href");
            getData(page);
            //禁止A标签跳转
            return false;
        }) ;
    }
    Date.prototype.format = function(format) {
        var date = {
            "M+": this.getMonth() + 1,
            "d+": this.getDate(),
            "h+": this.getHours(),
            "m+": this.getMinutes(),
            "s+": this.getSeconds(),
            "q+": Math.floor((this.getMonth() + 3) / 3),
            "S+": this.getMilliseconds()
        };
        if (/(y+)/i.test(format)) {
            format = format.replace(RegExp.$1, (this.getFullYear() + '').substr(4 - RegExp.$1.length));
        }
        for (var k in date) {
            if (new RegExp("(" + k + ")").test(format)) {
                format = format.replace(RegExp.$1, RegExp.$1.length == 1
                    ? date[k] : ("00" + date[k]).substr(("" + date[k]).length));
            }
        }
        return format;
    }
    $(function(){
        //历史记录注单详情
        $(".list_two_tab").hide();
        $(".list_three_tab").hide();
        $(".two_a").click(function(){
            $(".list_one_tab").show();
            $(".list_two_tab").hide();
        })
        $(".three_a").click(function(){
            $(".list_two_tab").show();
            $(".list_three_tab").hide();
        })
    })
</script>
</body>
</html>