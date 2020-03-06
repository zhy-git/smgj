<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:59:"/www/wwwroot/smgj/public/../app/wap/view/index/hall_cl.html";i:1539763164;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>两面长龙</title>
		<link rel="icon" href="__IMG__/favicon.ico" type="image/x-icon">
        <link rel="shortcut icon" href="__IMG__/favicon.ico" type="image/x-icon" />
		<link href="__CSS__/wap_new/mui.min.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="__CSS__/wap_new/common.css"/>
		<link rel="stylesheet" type="text/css" href="__CSS__/wap_new/index.css"/>
		<style type="text/css">
			select{
				width: 100%;
				margin: 0;
				height: 30px;
				padding: 0;
				padding-left: 40%;
				font-weight: 600;
			}
			th{
				width: 50%;
			}
		</style>
	</head>
	<body>
		<header class="mui-bar mui-bar-nav">
		    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
		    <h1 class="mui-title">两面长龙</h1>
		</header>
		<div class="mui-content">
			<div class="table-box bg_ff">
				<?php if($cate==1 || $cate==2): ?>
					<p style="text-align: center;">最近10期开奖结果</p>
					<table border="" cellspacing="" cellpadding="">
						<?php if(is_array($openList) || $openList instanceof \think\Collection || $openList instanceof \think\Paginator): $i = 0; $__LIST__ = $openList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
						<tr>
							<td><?php echo $vo['stage']; ?>期</td>
							<?php if(is_array($vo['number']) || $vo['number'] instanceof \think\Collection || $vo['number'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['number'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
							<td><?php echo $v; ?></td>
							<?php endforeach; endif; else: echo "" ;endif; ?>
							<td>总和：<?php echo $vo['sum']; ?></td>
							<td><?php echo $vo['dx']; ?>、<?php echo $vo['ds']; ?></td>
							<!--<td>5期</td>-->
							<!--<td>5期</td>-->
						</tr>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</table>
				<?php elseif($cate==8): ?>
					<p style="text-align: center;">最近10期开奖结果</p>
					<table border="" cellspacing="" cellpadding="">
						<?php if(is_array($openList) || $openList instanceof \think\Collection || $openList instanceof \think\Paginator): $i = 0; $__LIST__ = $openList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
						<tr>
							<td><?php echo $vo['stage']; ?>期</td>
							<?php if(is_array($vo['number']) || $vo['number'] instanceof \think\Collection || $vo['number'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['number'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
								<td><?php echo $v; ?></td>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</tr>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</table>
				<?php else: ?>
					<table border="" cellspacing="" cellpadding="" id="stat_play_list">
						<!--<tr>-->
							<!--<th>-->
								<!--<select name="">-->
									<!--<option value="">彩种</option>-->
								<!--</select>-->
							<!--</th>-->
							<!--<th>期数</th>-->
						<!--</tr>-->
						<!--<tr>-->
							<!--<td>第三名 虎</td>-->
							<!--<td>5期</td>-->
						<!--</tr>-->
					</table>
				<?php endif; ?>
			</div>
		</div>
		<div class="msg-spring"></div>
		<script src="__JS__/wap_new/mui.min.js"></script>
		<script src="__JS__/wap_new/jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="__JS__/wap_new/index.js" type="text/javascript" charset="utf-8"></script>
		<script src="__JS__/jquery.validate.min.js"></script>
		<script src="__JS__/layer.js" ></script>
		<script src="__JS__/common.js" ></script>
	</body>
</html>
<script>
	var cate=<?php echo $cate; ?>;
    function aArrCreate(){
        var arr = [];
        arr[0] = [];
        arr[0] = arrCreate(10,0);
        arr[1] = [];
        arr[2] = [];
        arr[3] = [];
        return arr;
    }
	var dataIntegrationFun = {
        openList : <?php echo json_encode($openList); ?>,
    	list : '',
        listTs : '',
        setDataIntegration : function(_this){
        var data = dataIntegrationFun.openList;
        var list = new Array(10);
        for(var i=0;i<10;++i){
            list[i] = aArrCreate();
        }
        var listTs = new Array(3);
        listTs[0] = [];
        listTs[1] = [];
        listTs[2] = [];
        $.each(data,function(k,v){
            var openNumArr = [];
            var dx = '',
                ds = '',
                zh,
                boxNum = 25;
            openNumArr = v['number'].split(',');
            for(var i=0;i<10;++i){
                var sitek = parseInt(openNumArr[i])-1;
                list[i][0][sitek]++;
                if(list[i][1][list[i][1].length-1]){
                    if(list[i][1][list[i][1].length-1].split(',')[0] == openNumArr[i]){
                        list[i][1][list[i][1].length-1] += ','+openNumArr[i];
                    }else{
                        list[i][1].push(openNumArr[i]);
                    }
                }else{
                    list[i][1].push(openNumArr[i]);
                }
                dx = dxJudgment(6,openNumArr[i]);
                if(list[i][2][list[i][2].length-1]){
                    if(list[i][2][list[i][2].length-1].split(',')[0]==dx) {
                        list[i][2][list[i][2].length - 1] += ',' + dx;
                    }else{
                        list[i][2].push(dx);
                    }
                }else{
                    list[i][2].push(dx);
                }
                ds = dsJudgment(openNumArr[i]);
                if(list[i][3][list[i][3].length-1]){
                    if(list[i][3][list[i][3].length-1].split(',')[0]==ds) {
                        list[i][3][list[i][3].length - 1] += ',' + ds;
                    }else{
                        list[i][3].push(ds);
                    }
                }else{
                    list[i][3].push(ds);
                }
            }
            zh = openNumArr[0]*1+openNumArr[1]*1;
            if(listTs[0].length <= boxNum) {
                zh = zh.toString();
                if (listTs[0][listTs[0].length - 1]) {
                    if (listTs[0][listTs[0].length - 1].split(',')[0] == zh) {
                        listTs[0][listTs[0].length - 1] += ',' + zh;
                    } else {
                        listTs[0].push(zh);
                    }
                } else {
                    listTs[0].push(zh);
                }
            }
            if(listTs[1].length <= boxNum) {
                dx = dxJudgment(11,zh);
                if (listTs[1][listTs[1].length - 1]) {
                    if (listTs[1][listTs[1].length - 1].split(',')[0] == dx) {
                        listTs[1][listTs[1].length - 1] += ',' + dx;
                    } else {
                        listTs[1].push(dx);
                    }
                } else {
                    listTs[1].push(dx);
                }
            }
            if(listTs[2].length <= boxNum) {
                ds = dsJudgment(zh);
                if (listTs[2][listTs[2].length - 1]) {
                    if (listTs[2][listTs[2].length - 1].split(',')[0] == ds) {
                        listTs[2][listTs[2].length - 1] += ',' + ds;
                    } else {
                        listTs[2].push(ds);
                    }
                } else {
                    listTs[2].push(ds);
                }
            }
        });
        dataIntegrationFun.list = list;
        dataIntegrationFun.listTs = listTs;
    },
    getDataIntegration : function(_this){
        var a = $('#stat_qiu th.select').index(_this);
        var b = $('#stat_type th.select').index(_this);
        var boxNum = 25;
        var str;
        $.each(dataIntegrationFun.list[a][0],function(k,v){
            $('#specialListOne td:eq('+k+')').html(v);
        });
        if(b<3){
            boxNum --;
            $.each(dataIntegrationFun.list[a][b*1+1],function(k,v){
                str = '';
                var vArr = v.split(',');
                if(vArr.length>1){
                    $.each(vArr,function(k2,v2){
                        str += v2+'<br>';
                    })
                    $('#specialListTwo td:eq('+(boxNum - k)+')').html(str);
                }else{
                    $('#specialListTwo td:eq('+(boxNum - k)+')').html(v);
                }
            });
        }else{
            boxNum --;
            $.each(dataIntegrationFun.listTs[b-3],function(k,v){
                str = '';
                var vArr = v.split(',');
                if(vArr.length>1){
                    $.each(vArr,function(k2,v2){
                        str += v2+'<br>';
                    })
                    $('#specialListTwo td:eq('+(boxNum - k)+')').html(str);
                }else{
                    $('#specialListTwo td:eq('+(boxNum - k)+')').html(v);
                }
            });
        }
    },
    getCl : function(){
        var list = dataIntegrationFun.list;
        var listTs = dataIntegrationFun.listTs;
        if(cate==3 || cate==4){
            var listName = ['第一球','第二球','第三球','第四球','第五球'];
            var listTsName = [];
		}else{
            var listName = ['冠军','亚军','第三名','第四名','第五名','第六名','第七名','第八名','第九名','第十名'];
            var listTsName = ['冠、亚和','冠、亚和大小','冠、亚和单双'];
		}
        var listData = [];
        $.each(list,function(k,v){
            for (var i=1;i<4;i++){
                if(typeof(v[i][0]) != "undefined"){
                    var arr = v[i][0].split(',');
				}else{
                    var arr = [];
				}
                if(arr.length>2){
                    if(typeof(listName[k])!="undefined") {
                        listData.push(listName[k] + '-' + arr[0] + ',' + arr.length + '期');
                    }
                }
            }
        })
        $.each(listTs,function(k,v){
            var arr = v[0].split(',');
            if(arr.length>2){
                if(typeof(listTsName[k])!="undefined") {
                    listData.push(listTsName[k] + '-' + arr[0] + ',' + arr.length + '期');
                }
            }
        })
        if(listData.length){
            var str = '';
            $.each(listData,function(k,v){
                var dataContent = v.split(',');
                str += '<tr class="u-tb5-tr1"><td>'+dataContent[0]+'</td> <td class="statFont">'+dataContent[1]+'</td></tr>';
            })
            $('#stat_play_list').html(str);
        }
    }
    }
    dataIntegrationFun.setDataIntegration();
    setTimeout(function(){
        dataIntegrationFun.getCl();
	},300)
</script>