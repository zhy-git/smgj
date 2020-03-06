<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:63:"/www/wwwroot/smgj/public/../app/wap/view/report/openresult.html";i:1540622621;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<title>开奖结果</title>
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
</head>
<body>
<header class="mui-bar mui-bar-nav">
	<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
	<h1 class="mui-title">开奖结果</h1>
</header>
<div class="mui-content ">
	<div class="lottery">
		<div class="mui-clearfix">
			<span class="lottery_select">
				<select name=""  id="historyQueryParamGameId">
					<?php if(is_array($cateList) || $cateList instanceof \think\Collection || $cateList instanceof \think\Paginator): $i = 0; $__LIST__ = $cateList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cll): $mod = ($i % 2 );++$i;?>
					<option value="<?php echo $cll['id']; ?>" <?php echo $cll['id']==$cate_id?'selected':''; ?>><?php echo $cll['name']; ?></option>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
			</span>
			<input style="width: 50%;height: 30px;margin: 0 " readonly="readonly" type="text" class="demo-input" id="historyQueryParamGameDate" placeholder="请选择日期"  id="test1">
		</div>
		<div class="note_tab">
			<table border="" cellspacing="" cellpadding="">
				<tr>
					<th>期数</th>
					<th>开奖号码</th>
				</tr>
				<tbody id="history_table"></tbody>
			</table>
		</div>
	</div>
</div>
<script src="__JS__/laydate/laydate.js" type="text/javascript" charset="utf-8"></script>
<script src="__JS__/laydate.js" type="text/javascript" charset="utf-8"></script>
<script>
    var end = laydate.render({
        elem: '#historyQueryParamGameDate',
        min: -30,
        max: '2099-06-16 23:59:59',
        theme: '#86384e',
        type:'date',
        done: function (value, date, endDate) {
            getDataBuild.page = 1;
            getDataBuild.getData("<?php echo url('Report/openResult'); ?>");
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
        $('#historyQueryParamGameDate').val(p(y)+'-'+p(m)+'-'+p(d));
    }
    $(function(){
        $('#historyQueryParamGameId').change(function(){
            getDataBuild.page = 1;
            getDataBuild.getData("<?php echo url('Report/openResult'); ?>");
        });
        today();
        setTimeout(function(){
            getDataBuild.getData();
		},1000)
	});
	var getDataBuild = {
	    stop : true,
        page : 1,
        getData:function(){
        var cate = $('#historyQueryParamGameId').val();
        var date = $('#historyQueryParamGameDate').val();
        $.ajax({
            url: "<?php echo url('Report/openResult'); ?>",
            type: "POST",
            data: {cate: cate,date:date,page:getDataBuild.page},
            success: function(n) {
                console.log(n);
                if (n.data != null) {
                    getDataBuild.page ++;
                    var str = '';
                    if (cate == 3 || cate ==4){
                        $.each(n.data.data,function(k,v){
                            var numArr = v.number.split(',');
                            var date = new Date(v.create_time);
                            var time1 = date.getTime();
                            var awardArr = awardResults(numArr);
                            str += '<tr>';
                            str += '<td>';
                            str += '<p>'+v.stage+'</p>';
                            str += '<p class="mg_top10">'+v.create_time+'</p>';
                            str += '</td>';
                            str += '<td>';
                            str += '<p>';
                            str += '<i class="round1">'+parseInt(numArr[0])+'</i>';
                            str += '<i class="round1">'+parseInt(numArr[1])+'</i>';
                            str += '<i class="round1">'+parseInt(numArr[2])+'</i>';
                            str += '<i class="round1">'+parseInt(numArr[3])+'</i>';
                            str += '<i class="round1">'+parseInt(numArr[4])+'</i>';
                            str += '</p>';
                            str += '<p class="mg_top10">';
                            str += '<i class="squal1">'+awardArr[0]+'</i>';
                            str += '<i class="squal1">'+awardArr[1]+'</i>';
                            str += '<i class="squal1">'+awardArr[2]+'</i>';
                            str += '<i class="squal1">'+awardArr[3]+'</i>';
                            // str += '<i class="squal1">'+awardArr[4]+'</i>';
                            // str += '<i class="squal1">'+awardArr[5]+'</i>';
                            // str += '<i class="squal1">'+awardArr[6]+'</i>';
                            str += '</p>';
                            str += '</td>';
                            str += '</tr>';
                        });
                    }else if(cate == 5  || cate == 6 || cate == 7){
                        $.each(n.data.data,function(k,v){
                            var numArr = v.number.split(',');
                            var totalNum = parseInt(numArr[0])*1+parseInt(numArr[1])*1;
                            str += '<tr>';
                            str += '<td>';
                            str += '<p>'+v.stage+'</p>';
                            str += '<p class="mg_top10">'+v.create_time+'</p>';
                            str += '</td>';
                            str += '<td>';
                            str += '<p>';
                            str += '<i class="round2 bg'+parseInt(numArr[0])+'">'+parseInt(numArr[0])+'</i>';
                            str += '<i class="round2 bg'+parseInt(numArr[1])+'">'+parseInt(numArr[1])+'</i>';
                            str += '<i class="round2 bg'+parseInt(numArr[2])+'">'+parseInt(numArr[2])+'</i>';
                            str += '<i class="round2 bg'+parseInt(numArr[3])+'">'+parseInt(numArr[3])+'</i>';
                            str += '<i class="round2 bg'+parseInt(numArr[4])+'">'+parseInt(numArr[4])+'</i>';
                            str += '<i class="round2 bg'+parseInt(numArr[5])+'">'+parseInt(numArr[5])+'</i>';
                            str += '<i class="round2 bg'+parseInt(numArr[6])+'">'+parseInt(numArr[6])+'</i>';
                            str += '<i class="round2 bg'+parseInt(numArr[7])+'">'+parseInt(numArr[7])+'</i>';
                            str += '<i class="round2 bg'+parseInt(numArr[8])+'">'+parseInt(numArr[8])+'</i>';
                            str += '<i class="round2 bg'+parseInt(numArr[9])+'">'+parseInt(numArr[9])+'</i>';
                            str += '</p>';
                            str += '<p class="mg_top10">';
                            str += '<i class="squal1">'+totalNum+'</i>';
                            str += '<i class="squal1">'+dxJudgment(12,totalNum)+'</i>';
                            str += '<i class="squal1">'+dsJudgment(totalNum)+'</i>';
                            str += '<i class="squal1">'+lhhJudgment(parseInt(numArr[0]),parseInt(numArr[9]))+'</i>';
                            str += '<i class="squal1">'+lhhJudgment(parseInt(numArr[1]),parseInt(numArr[8]))+'</i>';
                            str += '<i class="squal1">'+lhhJudgment(parseInt(numArr[2]),parseInt(numArr[7]))+'</i>';
                            str += '<i class="squal1">'+lhhJudgment(parseInt(numArr[3]),parseInt(numArr[6]))+'</i>';
                            str += '<i class="squal1">'+lhhJudgment(parseInt(numArr[4]),parseInt(numArr[5]))+'</i>';
                            str += '</p>';
                            str += '</td>';
                            str += '</tr>';
                        });
                    }else if(cate == 11){
                        $.each(n.data.data,function(k,v){
                            var numArr = v.number.split(',');
                            var date = new Date(v.create_time);
                            var time1 = date.getTime();
                            var totalNum = parseInt(numArr[0])*1+parseInt(numArr[1])*1+parseInt(numArr[2])*1+parseInt(numArr[3])*1+parseInt(numArr[4])*1;
                            var lastHnum = totalNum.toString();
                            str += '<tr>';
                            str += '<td>';
                            str += '<p>'+v.stage+'</p>';
                            str += '<p class="mg_top10">'+v.create_time+'</p>';
                            str += '</td>';
                            str += '<td>';
                            str += '<p>';
                            str += '<i class="round1">'+parseInt(numArr[0])+'</i>';
                            str += '<i class="round1">'+parseInt(numArr[1])+'</i>';
                            str += '<i class="round1">'+parseInt(numArr[2])+'</i>';
                            str += '<i class="round1">'+parseInt(numArr[3])+'</i>';
                            str += '<i class="round1">'+parseInt(numArr[4])+'</i>';
                            str += '</p>';
                            str += '<p class="mg_top10">';
                            str += '<i class="squal1">'+totalNum+'</i>';
                            str += '<i class="squal1">'+dxhJudgment(30,totalNum)+'</i>';
                            str += '<i class="squal1">'+dsJudgment(totalNum)+'</i>';
                            str += '<i class="squal1">'+dxwJudgment(5,lastHnum.substr(lastHnum.length-1,1))+'</i>';
                            str += '<i class="squal1">'+lhhJudgment(parseInt(numArr[0]),parseInt(numArr[4]))+'</i>';
                            str += '<i class="squal1">'+dxhtsJudgment(6,11,parseInt(numArr[0]))+'</i>';
                            str += '<i class="squal1">'+dxhtsJudgment(6,11,parseInt(numArr[1]))+'</i>';
                            str += '<i class="squal1">'+dxhtsJudgment(6,11,parseInt(numArr[2]))+'</i>';
                            str += '<i class="squal1">'+dxhtsJudgment(6,11,parseInt(numArr[3]))+'</i>';
                            str += '<i class="squal1">'+dxhtsJudgment(6,11,parseInt(numArr[4]))+'</i>';
                            str += '</p>';
                            str += '</td>';
                            str += '</tr>';
                        });
                    }else if(cate == 9){
                        $.each(n.data.data,function(k,v){
                            var numArr = v.number.split(',');
                            var date = new Date(v.create_time);
                            var time1 = date.getTime();
                            var totalNum = parseInt(numArr[0])*1+parseInt(numArr[1])*1+parseInt(numArr[2])*1;
                            str += '<tr>';
                            str += '<td>';
                            str += '<p>'+v.stage+'</p>';
                            str += '<p class="mg_top10">'+v.create_time+'</p>';
                            str += '</td>';
                            str += '<td>';
                            str += '<p>';
                            str += '<i class="round3 "><img src="__IMG__/wap/Dice'+parseInt(numArr[0])+'.png" alt="" /></i>';
                            str += '<i class="round3 "><img src="__IMG__/wap/Dice'+parseInt(numArr[1])+'.png" alt="" /></i>';
                            str += '<i class="round3 "><img src="__IMG__/wap/Dice'+parseInt(numArr[2])+'.png"/></i>';
                            str += '</p>';
                            str += '<p class="mg_top10">';
                            str += '<i class="squal1">'+totalNum+'</i>';
                            str += '<i class="squal1">'+dxJudgment(11,totalNum)+'</i>';
                            str += '</p>';
                            str += '</td>';
                            str += '</tr>';
                        });
                    }else if(cate == 1 || cate==2){
                        $.each(n.data.data,function(k,v){
                            var numArr = v.number.split(',');
                            var date = new Date(v.create_time);
                            var time1 = date.getTime();
                            var totalNum = parseInt(numArr[0])*1+parseInt(numArr[1])*1+parseInt(numArr[2])*1;
                            str += '<tr>';
                            str += '<td>';
                            str += '<p>'+v.stage+'</p>';
                            str += '<p class="mg_top10">'+v.create_time+'</p>';
                            str += '</td>';
                            str += '<td>';
                            str += '<p>';
                            str += '<i class="round1">'+parseInt(numArr[0])+'</i>';
                            str += '<i class="round1">'+parseInt(numArr[1])+'</i>';
                            str += '<i class="round1">'+parseInt(numArr[2])+'</i>';
                            str += '</p>';
                            str += '<p class="mg_top10">';
                            str += '<i class="squal1">'+totalNum+'</i>';
                            str += '<i class="squal1">'+dxJudgment(14,totalNum)+'</i>';
                            str += '<i class="squal1">'+dsJudgment(totalNum)+'</i>';
                            // str += '<i class="squal1">'+jdjxJudgment(23,4,totalNum)+'</i>';
                            // str += '<i class="squal1">'+colorJudgment(totalNum)+'</span></i>';
                            str += '</p>';
                            str += '</td>';
                            str += '</tr>';
                        });
                    }else if(cate == 8){
                        $.each(n.data.data,function(k,v){
                            var numArr = v.number.split(',');
                            var date = new Date(v.create_time);
                            var time1 = date.getTime();
                            str += '<tr>';
                            str += '<td>';
                            str += '<p>'+v.stage+'</p>';
                            str += '<p class="mg_top10">'+v.create_time+'</p>';
                            str += '</td>';
                            str += '<td>';
                            str += '<p>';
                            str += '<i class="ball bg_'+setBoss(numArr[0])+'">'+parseInt(numArr[0])+'</i>';
                            str += '<i class="ball bg_'+setBoss(numArr[1])+'">'+parseInt(numArr[1])+'</i>';
                            str += '<i class="ball bg_'+setBoss(numArr[2])+'">'+parseInt(numArr[2])+'</i>';
                            str += '<i class="ball bg_'+setBoss(numArr[3])+'">'+parseInt(numArr[3])+'</i>';
                            str += '<i class="ball bg_'+setBoss(numArr[4])+'">'+parseInt(numArr[4])+'</i>';
                            str += '<i class="ball bg_'+setBoss(numArr[5])+'">'+parseInt(numArr[5])+'</i>';
                            str += '<strong class=" ">+</strong>';
                            str += '<i class="ball bg_'+setBoss(numArr[6])+'">'+parseInt(numArr[6])+'</i>';
                            str += '</p>';
                            str += '<p class="mg_top10">';
                            str += '<i class="squal1">'+getShuXiang(numArr[0])+'</i>';
                            str += '<i class="squal1">'+getShuXiang(numArr[1])+'</i>';
                            str += '<i class="squal1">'+getShuXiang(numArr[2])+'</i>';
                            str += '<i class="squal1">'+getShuXiang(numArr[3])+'</i>';
                            str += '<i class="squal1">'+getShuXiang(numArr[4])+'</i>';
                            str += '<i class="squal1 mg_r10">'+getShuXiang(numArr[5])+'</i>';
                            str += '<i class="squal1 mg_left10">'+getShuXiang(numArr[6])+'</i>';
                            str += '</p>';
                            str += '</td>';
                            str += '</tr>';
                        });
                    }else if(cate == 10){
                        $.each(n.data.data,function(k,v){
                            var numArr = v.number.split(',');
                            var date = new Date(v.create_time);
                            var time1 = date.getTime();
                            var totalNum = parseInt(numArr[0])*1+parseInt(numArr[1])*1+parseInt(numArr[2])*1+parseInt(numArr[3])*1+parseInt(numArr[4])*1+parseInt(numArr[5])*1+parseInt(numArr[6])*1+parseInt(numArr[7])*1;
                            var lastHnum = totalNum.toString();
                            str += '<tr>';
                            str += '<td>';
                            str += '<p>'+v.stage+'</p>';
                            str += '<p class="mg_top10">'+v.create_time+'</p>';
                            str += '</td>';
                            str += '<td>';
                            str += '<p>';
                            str += '<i class="round1">'+parseInt(numArr[0])+'</i>';
                            str += '<i class="round1">'+parseInt(numArr[1])+'</i>';
                            str += '<i class="round1">'+parseInt(numArr[2])+'</i>';
                            str += '<i class="round1">'+parseInt(numArr[3])+'</i>';
                            str += '<i class="round1">'+parseInt(numArr[4])+'</i>';
                            str += '<i class="round1">'+parseInt(numArr[5])+'</i>';
                            str += '<i class="round1">'+parseInt(numArr[6])+'</i>';
                            str += '<i class="round1">'+parseInt(numArr[7])+'</i>';
                            str += '</p>';
                            str += '<p class="mg_top10">';
                            str += '<i class="squal1">'+totalNum+'</i>';
                            str += '<i class="squal1">'+dxhJudgment(84,totalNum)+'</i>';
                            str += '<i class="squal1">'+dsJudgment(totalNum)+'</i>';
                            str += '<i class="squal1">'+dxwJudgment(5,lastHnum.substr(lastHnum.length-1,1))+'</i>';
                            str += '<i class="squal1">'+lhhJudgment(parseInt(numArr[0]),parseInt(numArr[7]))+'</i>';
                            str += '<i class="squal1">'+lhhJudgment(parseInt(numArr[1]),parseInt(numArr[6]))+'</i>';
                            str += '<i class="squal1">'+lhhJudgment(parseInt(numArr[2]),parseInt(numArr[5]))+'</i>';
                            str += '<i class="squal1">'+lhhJudgment(parseInt(numArr[3]),parseInt(numArr[4]))+'</i>';
                            str += '</p>';
                            str += '</td>';
                            str += '</tr>';
                        });
                    }
                    if(getDataBuild.page == 2){
                        $('#history_table').html(str);
					}else{
                        $('#history_table').append(str);
					}
                    // getDataBuild.page ++;
                }else{
                    //$('#openList').html('<tr class="trcolor"><td colspan="14"><div>   暂无数据</div></td></tr>');
                }
            },
            error: function() {
                //warningMessage("查询失败")
            },
            beforeSend: function() {
                //showloading()
            },
            complete: function() {
                setTimeout(function(){
                    getDataBuild.stop = true;
            	},1000)
            }
        })
    }
	}
	function getDate(timestamp){
        var date = new Date(timestamp);
        var M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1) + '-';
        var D = date.getDate() + ' ';
        var h = date.getHours() + ':';
        var m = date.getMinutes();
        return M+D+h+m;
	}
    $(window).scroll(function() {
        if ($(this).scrollTop() + $(window).height() + 10 >= $(document).height() && $(this).scrollTop() > 10) {
            if(getDataBuild.stop == true){
                getDataBuild.stop = false;
                getDataBuild.getData();
            }
        }
    });
    function awardResults(opennum){
        var returnData = [];
        returnData[0] = 0;
        $.each(opennum,function(k,v){
            returnData[0] = returnData[0]*1+v*1;
        });
        returnData[1] = dxJudgment(23,returnData[0]);
        returnData[2] = dsJudgment(returnData[0]);
        returnData[3] = lhhJudgment(opennum[0],opennum[4]);
        returnData[4] = calc(opennum[0],opennum[1],opennum[2]);
        returnData[5] = calc(opennum[1],opennum[2],opennum[3]);
        returnData[6] = calc(opennum[2],opennum[3],opennum[4]);
        return returnData;
    }
</script>
</body>
</html>