<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:63:"/www/wwwroot/smgj/public/../app/wap/view/report/noterecord.html";i:1540780760;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<title>下注记录</title>
	<script src="__JS__/wap/mui.min.js"></script>
	<link href="__CSS__/wap/mui.min.css" rel="stylesheet"/>
	<link rel="stylesheet" type="text/css" href="__CSS__/wap/swiper.min.css"/>
	<link rel="stylesheet" type="text/css" href="__CSS__/wap/common.css"/>
	<link rel="stylesheet" type="text/css" href="__CSS__/wap/index.css"/>
	<script src="__JS__/wap/jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="__JS__/wap/swiper.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="__JS__/wap/time.js" type="text/javascript" charset="utf-8"></script>
	<script src="__JS__/wap/index.js" type="text/javascript" charset="utf-8"></script>
	<script src="__JS__/jquery.validate.min.js"></script>
	<script src="__JS__/layer.js" ></script>
	<script src="__JS__/common.js" ></script>
	<script type="text/javascript" charset="utf-8">
        mui.init();
	</script>
	<style>
		.displayNone{ display: none;}
	</style>
</head>
<body>
<header class="mui-bar mui-bar-nav">
	<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
	<h1 class="mui-title">下注记录</h1>
</header>
<div class="mui-content ">
	<div class="note_tab">
		<table border="" cellspacing="" cellpadding="">
			<tr>
				<th>时间</th>
				<th>笔数</th>
				<th>输赢</th>
			</tr>
			<tr>
				<th colspan="4">点击日期可查看下注详情</th>
			</tr>
			<tbody id="betCon"></tbody>
		</table>
	</div>
	<div class="note_tab displayNone">
		<table border="" cellspacing="" cellpadding="">
			<tr>
				<th>彩种</th>
				<th>笔数</th>
				<th>下注金额</th>
				<th>输赢</th>
			</tr>
			<tbody id="cateList"></tbody>
		</table>
	</div>
	<div class="note_tab displayNone">
		<table border="" cellspacing="" cellpadding="">
			<tr>
				<th>期号</th>
				<th>下注明细</th>
				<th>下注金额</th>
				<th>输赢</th>
			</tr>
			<tbody id="dataList"></tbody>
		</table>
	</div>
</div>
<script>
    var workData = {
        data : '',
        getData : function() {
            var from = getDate();
            var to = getDate(1);
			var url = "<?php echo url('betRecord'); ?>";
            $.ajax({
                url: url,
                type: "POST",
                data: {from: from, to: to},
                success: function(n) {
                    if (n.code == 1) {
                        workData.data = n.data;
                        var str = '';
                        $.each(n.data,function(k,v){
                            str += '<tr><td><a class="ShowBetDetailRecord" id="'+v.id+'" data-date="'+k+'" href="#" onclick="workData.detail(this)"><p>'+getChWeek(k)+'</p><p>'+k+'</p></a></td>';
                            str += '<td>'+v.bet+'</td>';
                            str += '<td>'+v.win+'</td>';
                            str += '</tr>';
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
            $('.note_tab').addClass('displayNone');
            $('.note_tab:eq(1)').removeClass('displayNone');
            var dataDate = $(_this).attr('data-date');
            var str = '';
            $.each(data[dataDate]['cate'],function(k,v){
                str += '<tr><td><a href="javascript:;" data-date="'+dataDate+'" data-cate="'+k+'" onclick="workData.list(this)" class="list_two">'+v.name+'-'+v.hall_name+'</a></td>';
                str += '<td><a href="javascript:;" data-date="'+dataDate+'" data-cate="'+k+'" onclick="workData.list(this)" class="list_two">'+v.bet+'</a></td>';
                str += '<td><a href="javascript:;" data-date="'+dataDate+'" data-cate="'+k+'" onclick="workData.list(this)" class="list_two">'+v.money+'</a></td>';
                str += '<td><a href="javascript:;" data-date="'+dataDate+'" data-cate="'+k+'" onclick="workData.list(this)" class="list_two">'+v.win+'</a></td></tr>';
            });
            $('#cateList').html(str);
        },
        list : function(_this){
            $('.note_tab').addClass('displayNone');
            $('.note_tab:eq(2)').removeClass('displayNone');
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
                str += '<tr><td class="f1">'+v.name+'-'+hall+'<br> 第&nbsp;<span style="color: rgb(41, 154, 38);">'+v.stage+'</span>&nbsp;期</td>';
                str += '<td class="f1 multiple">';
                str += '<span style="color: rgb(40, 54, 244);">'+v.title+'  '+v.number+' <span style="color: rgb(0, 0, 0);">@</span>';
                str += '<span style="color: red;">'+v.odds+'</span></span></td>';
                str += '<td class="f1">'+v.money+'</td>';
                if(v.z_money>0){
                    str += '<td class="f1"><span style="color: red;" title="开奖号码：'+v.open_number+'">'+accSub(v.z_money,v.money)+'</span></td></tr>';
                }else{
                    str += '<td class="f1"><span title="开奖号码：'+v.open_number+'">'+accSub(v.z_money,v.money)+'</span></td></tr>';
                }
            })
            $('#dataList').html(str);
        }
    }
    function p(s) {
        return s < 10 ? '0' + s: s;
    }
    function getDate(num){
        if(!num){
            num = 0;
		}
        var nowdate = new Date();
        var y = nowdate.getFullYear();
        var m = nowdate.getMonth()+num*1;
        var d = nowdate.getDate();
        return p(y)+'-'+p(m)+'-'+p(d);
    }
    $(function(){
        setTimeout(function(){
            workData.getData("<?php echo url('betRecord?page=1'); ?>");
		},1000)
	})
	// $('.note_tab').click(function(){
     //    $('.note_tab').hide();
	// 	$(this).show();
	// })
</script>
</body>
</html>