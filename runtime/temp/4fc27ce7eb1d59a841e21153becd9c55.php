<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:61:"/www/wwwroot/smgj/public/../app/admin/view/money/betting.html";i:1540450995;s:59:"/www/wwwroot/smgj/public/../app/admin/view/common/base.html";i:1527061064;s:58:"/www/wwwroot/smgj/public/../app/admin/view/common/nav.html";i:1523368392;}*/ ?>
<!DOCTYPE html>
<html lang="zh_ch">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="#" type="image/png">
    <title>后台管理系统</title>
    <link href="__CSS__/style.css" rel="stylesheet">
    <!--<link href="__CSS__/bootstrap.min.css" rel="stylesheet">-->
    <link href="__CSS__/style-responsive.css" rel="stylesheet">
    
<!--pickers css-->
<link rel="stylesheet" type="text/css" href="__JS__/bootstrap-datepicker/css/datepicker-custom.css" />
<link rel="stylesheet" type="text/css" href="__JS__/bootstrap-timepicker/css/timepicker.css" />
<link rel="stylesheet" type="text/css" href="__JS__/bootstrap-colorpicker/css/colorpicker.css" />
<link rel="stylesheet" type="text/css" href="__JS__/bootstrap-daterangepicker/daterangepicker-bs3.css" />
<link rel="stylesheet" type="text/css" href="__JS__/bootstrap-datetimepicker/css/datetimepicker-custom.css" />

    <script src="__JS__/jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="__JS__/layer.js" ></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="__JS__/html5shiv.js"></script>
    <script src="__JS__/respond.min.js"></script>
    <![endif]-->
</head>

<body class="sticky-header">

<section>
    <!-- left side start-->
    <div class="left-side sticky-left-side">

        <!--logo start-->
        <div class="logo">
            <a href="<?php echo url('Index/index'); ?>"><img src="__IMG__/logo.png" alt=""></a>
        </div>

        <div class="logo-icon text-center">
            <a href="<?php echo url('Index/index'); ?>"><img src="__IMG__/logo_icon.png" alt=""></a>
        </div>
        <!--logo  end-->


        <div class="left-side-inner">

            <!-- visible to small devices only -->
            <div class="visible-xs hidden-sm hidden-md hidden-lg">
                <div class="media logged-user">
                    <img alt="" src="__IMG__/photos/user-avatar.png" class="media-object">
                    <div class="media-body">
                        <h4><a><?php echo session('admin_login.username'); ?></a></h4>
                    </div>
                </div>
                <ul class="nav nav-pills nav-stacked custom-nav">
                    <li><a  data-toggle="modal" href="#myModal"><i class="fa fa-cog"></i> <span>修改密码</span></a></li>
                    <li><a href="<?php echo url('Login/out'); ?>"><i class="fa fa-sign-out"></i> <span>退出</span></a></li>
                </ul>
            </div>

            <!--左侧菜单 start-->
<ul class="nav nav-pills nav-stacked custom-nav">

    <?php if(is_array($menu_list) || $menu_list instanceof \think\Collection || $menu_list instanceof \think\Paginator): if( count($menu_list)==0 ) : echo "" ;else: foreach($menu_list as $key=>$vo): if(!(empty($vo['sub_menu']) || (($vo['sub_menu'] instanceof \think\Collection || $vo['sub_menu'] instanceof \think\Paginator ) && $vo['sub_menu']->isEmpty()))): ?>
    <li class="menu-list <?php if(($controllerName == $vo['control'])): ?>nav-active<?php endif; ?>"><a href="#"><i class="fa <?php echo $vo['icon']; ?>"></i><span><?php echo $vo['name']; ?></span></a>
        <ul class="sub-menu-list">
            <?php if(is_array($vo['sub_menu']) || $vo['sub_menu'] instanceof \think\Collection || $vo['sub_menu'] instanceof \think\Paginator): if( count($vo['sub_menu'])==0 ) : echo "" ;else: foreach($vo['sub_menu'] as $kk=>$vv): ?>
            <li <?php if(($actionName == $vv['act'])): ?> class="active" <?php endif; ?>><a href="<?php echo url("$vv[control]/$vv[act]"); ?>"><?php echo $vv['name']; ?></a></li>
           <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </li>
     <?php else: ?>
    <li class="menu-list}">
    <a href="<?php echo url("$vo[control]/$vo[act]"); ?>""><i class="fa <?php echo $vo['icon']; ?>"></i><span><?php echo $vo['name']; ?></span></a>
    </li>
      <?php endif; endforeach; endif; else: echo "" ;endif; ?>

</ul>
<!--左侧菜单 end-->

        </div>
    </div>
    <!-- left side end-->

    <!-- main content start-->
    <div class="main-content" >

        <!-- header section start-->
        <div class="header-section">

            <!--toggle button start-->
            <a class="toggle-btn"><i class="fa fa-bars"></i></a>
            <!--toggle button end-->

            <!--notification menu start -->
            <div class="menu-right">
                <ul class="notification-menu">

                    <li>
                        <a href="javascript:;"><span style=" padding: 5px;background-color: red;color: white; border-radius: 10px;" id="newMessage" data-target="0,0">0</span></a>
                        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <img src="__IMG__/photos/user-avatar.png" alt="" />
                            <?php echo session('admin_login.username'); ?>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                            <li><a  data-toggle="modal" href="#myModal"><i class="fa fa-cog"></i> <span>修改密码</span></a></li>
                            <li><a href="<?php echo url('Login/out'); ?>"><i class="fa fa-sign-out"></i>退出</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
            <!--notification menu end -->

        </div>
        <!-- header section end-->
        <!--提示信息-->
        <div id="top-alert" class="fixed alert alert-error">
            <button class="close fixed">&times;</button>
            <div class="alert-content">提示信息</div>
        </div>
        <!--提示信息end-->
        
<style>
    .h2_title {
        background: #00A3F0;
        height: 50px;
        line-height: 50px;
        font-size: 18px;
        color: #fff;
        padding: 0 10px;
    }
    .tzxx {
        padding: 10px 15px;
    }
    .zltable {
        width: 100%;
        margin: auto;
        margin-top: 10px;
        border-collapse: collapse;
    }
    .zltable td.bg {
        background: #6BCAF6;
        width: 85px;
    }
    .zltable td {
        display: block;
        float: left;
        font-size: 12px;
        width: 144px;
        white-space: nowrap;
        text-overflow: ellipsis;
        line-height: 40px;
        height: 40px;
        text-align: center;
        margin-top: -1px;
        margin-left: -1px;
        border-radius: 5px;
        border: 1px solid #00A3F0;
        overflow: hidden;
    }
    .zltable3 td.bg {
        width: 80px;
    }
    .zltable3 td {
        width: 115px;
    }
    .tzxxlist {
        border: 1px solid #00A3F0;
        border-radius: 5px;
        padding: 5px;
        background: #6BCAF6;
        height: 200px;
        line-height: 18px;
        overflow: auto;
        word-break: break-all;
    }
    .tzxx h4 {
        margin-top: 12px;
        font-size: 14px;
        font-weight: bold;
    }
    .close {
        float: right;
        font-size: 21px;
        font-weight: 700;
        line-height: 1;
        color: #000;
        text-shadow: 0 1px 0 #fff;
        filter: alpha(opacity=20);
        opacity: .2;
    }
    a.close {
        overflow: hidden;
        width: 22px;
        height: 22px;
        cursor: pointer;
        margin-top: 14px;
        background: url(__IMG__/tabico.png) no-repeat -42px 0;
        z-index: 9;
        text-indent: -9999px;
        opacity: 1;
    }
</style>
<!--body wrapper start-->
<div class="wrapper">
    <div class="row">
        <div class="col-md-12">
            <!--breadcrumbs start -->
            <ul class="breadcrumb panel">
                <li><a href="<?php echo url('Index/index'); ?>"><i class="fa fa-home"></i> 控制台</a></li>
                <li><a href="<?php echo url('index'); ?>">金额管理</a></li>
                <li class="active">投注记录</li>
            </ul>
            <!--breadcrumbs end -->
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading col-xs-12 ">
                    <form class="form-inline" action="<?php echo url('',array('id'=>$id)); ?>">
                        <div class="form-group">
                            <div class="col-md-5">
                                <div class="input-group  custom-date-range">
                                    <input type="text" class="form-control form_datetime" value="<?php echo isset($_GET['from']) ? $_GET['from'] :  ''; ?>" name="from" placeholder="开始时间">
                                    <span class="input-group-addon">到</span>
                                    <input type="text" class="form-control form_datetime" value="<?php echo isset($_GET['to']) ? $_GET['to'] :  ''; ?>" name="to" placeholder="结束时间">
                                </div>
                            </div>
                            <select name="cate" class="form-control ">
                                <option value="" >选择彩种</option>
                                <?php foreach($cates as $v): ?>
                                <option value="<?php echo $v['id']; ?>"  <?php if((isset($cate) && $cate == $v['id'] )): ?>selected="selected"<?php endif; ?>><?php echo $v['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <select class="form-control" name="hall">
                                <option value="0">盘面</option>
                                <option value="1" <?php if((isset($_GET['hall']) && $_GET['hall'] == 1)): ?>selected<?php endif; ?>>A盘</option>
                                <option value='2' <?php if((isset($_GET['hall']) && $_GET['hall'] == 2)): ?>selected<?php endif; ?>>B盘(1.85模式)</option>
                                <option value='2' <?php if((isset($_GET['hall']) && $_GET['hall'] == 3)): ?>selected<?php endif; ?>>C盘(1.6模式)</option>
                            </select>
                            <select class="form-control" name="code">
                                <option value="-1">中奖状态</option>
                                <option value="0" <?php if((isset($_GET['code']) && $_GET['code'] == 0)): ?>selected<?php endif; ?>>未中奖</option>
                                <option value='1' <?php if((isset($_GET['code']) && $_GET['code'] == 1)): ?>selected<?php endif; ?>>中奖</option>
                            </select>
                            <select class="form-control" name="is_temporary">
                                <option value="0">用户</option>
                                <option value="1">游客</option>
                            </select>
                            <input type="text" name="gm_name" class="form-control" value="<?php echo isset($_GET['gm_name']) ? $_GET['gm_name'] :  ''; ?>" placeholder="用户账号">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </header>

                <div class="panel-body">
                    <form class="ids" action="<?php echo url('del'); ?>" method="post">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>昵称/账号</th>
                                <th>期数</th>
                                <th>彩种</th>
                                <th>房间</th>
                                <th>玩法</th>
                                <th>开奖号码</th>
                                <th>号码</th>
                                <th>金额</th>
                                <th>中奖金额</th>
                                <th >赔率</th>
                                <th>状态</th>
                                <th>IP</th>
                                <th >时间</th>
                            </tr>
                            </thead>
                            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                            <tr>
                                <td><?php echo $v['id']; ?></td>
                                <td><?php echo $v['gm_name']; ?></td>
                                <td><?php echo $v['stage']; ?></td>
                                <td><?php echo $v['name']; ?></td>
                                <?php if($v['cate']!=2): ?>
                                    <td><?php echo $v['hall']==1?'A盘':'B盘'; ?></td>
                                <?php else: ?>
                                    <td><?php echo $v['hall']==1?'A盘':'群模式'; ?></td>
                                <?php endif; ?>
                                <td><?php echo $v['title']; ?></td>
                                <td><?php echo $v['open_number']; ?></td>
                                <td title="<?php echo $v['number']; ?>" style="max-width: 150px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;"><?php echo $v['number']; ?></td>
                                <td><?php echo $v['money']; ?></td>
                                <td><?php echo $v['z_money']; ?></td>
                                <td><?php echo $v['odds']; ?></td>
                                <?php if(($v['is_del'] == 0)): if(($v['state'] == 0)): ?>
                                            <td style="color:red">未开奖</td>
                                    <?php elseif(($v['state'] == 1 && $v['code'] == 1)): ?>
                                            <td style="color:#65CEA7">中奖</td>
                                    <?php else: ?>
                                            <td>未中奖</td>
                                    <?php endif; else: ?>
                                    <td>已撤单</td>
                                <?php endif; ?>
                                <td><?php echo $v['ip']; ?></td>
                                <td><?php echo date('Y-m-d H:i:s',$v['create_at']); ?></td>
                                <!--<td><a type="button" class="btn btn-success ajax-get" onclick="detail(<?php echo $v['id']; ?>)">其他</a></td>-->
                            </tr>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </table>

                    </form>
                    <div class="row-fluid">
                        <div class="span6">
                            <div class="dataTables_info" id="dynamic-table_info">
                                总投注次数：<?php echo $total_number; ?>&nbsp;&nbsp; 总投注金额：<?php echo $total_money; ?>&nbsp;&nbsp;总中奖金额：<?php echo $zj_money; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php echo $page; ?>
        </div>
    </div>
</div>
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="detailModal" class="modal fade">
    <div id="betDetail" class="bet_eject bet_eject2" style="width: 900px; background-color: #fff;margin: 10% auto;">
        <h2 class="h2_title"><a class="close" data-dismiss="modal"></a>投注详情</h2>
        <div id="betDetailData" class="tzxx">
            <table cellpadding="0" cellspacing="1" class="zltable zltable3">
                <tbody>
                <tr>
                    <td class="bg">游戏账号</td><td data-prop="UserInfoLoginID" class="betDetail_acount"></td>
                    <td class="bg">彩种</td><td data-prop="IssueLotteryName" class="betDetail_cate"></td>
                    <td class="bg">玩法</td><td data-prop="BetTypeName" class="betDetail_type"></td>
                    <td class="bg">投注奖期</td><td data-prop="IssueSerialNumber" class="betDetail_num"></td>
                </tr>
                <tr>
                    <td class="bg">投注时间</td><td data-prop="CreateTimeStr" class="bet-h1"><span class="spanOverflow betDetail_create_at"></span><div class="betDetail-bet-h-text"> <i class="betDetail-ico-up"></i></div></td>
                    <td class="bg">模式/倍数</td><td><span data-prop="UnitStr" class="betDetail_denomination"></span> / <span data-prop="Multiple" class="betDetail_multiple"></span>倍</td>
                    <td class="bg">位置</td><td id="betDetail-position" class="bet-h1"><span class="spanOverflow betDetail_wei"></span><div class="betDetail-bet-h-text"> <i class="betDetail-ico-up"></i></div></td>
                    <td class="bg">奖金</td>
                    <td class="bet-h1">
                        <span class="spanOverflow"><span data-prop="OddsDisplay" class="betDetail_bonus"></span><span data-prop="ReturnRate"></span></span>
                        <div class="betDetail-bet-h-text betDetail-bet-h-text2" id="oddsAndReturnRate"><i class="betDetail-ico-up betDetail-ico-up2"></i></div>
                    </td>
                </tr>
                <tr>
                    <td class="bg">注单编号</td><td data-prop="SerialNumber" class="betDetail_id"></td>
                    <td class="bg">总投注金额</td><td data-prop="Cost" class="betDetail_money"></td>
                    <td class="bg">状态</td><td data-prop="StateStr" class="noprize betDetail_code"></td>
                    <td class="bg"></td><td class="cancel"></td>
                </tr>
                <tr>
                    <td class="bg">中奖金额</td><td id="betDetail-prize" class="betDetail_zjmoney"></td>
                    <td class="bg">投注注数</td><td id="betDetail-Count" class="betDetail_notes"></td>

                    <td class="bg">开奖号码</td><td id="betDetail-winningNumber" class="bet-h1 betDetail_open_number"><span class="spanOverflow"></span><div class="betDetail-bet-h-text"> <i class="betDetail-ico-up"></i></div></td>
                    <td class="bg"></td><td><a href="javascript:void(0)" class="but createbetproposal" style="display: none;"></a></td>
                </tr>
                </tbody></table>
            <h4>投注码</h4>
            <div class="tzxxlist" id="betDetail-number" data-prop="Number"></div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function detail(id) {
        $.ajax({
            type: "post",
            url: "<?php echo url('detail'); ?>",
            data: {'id':id},
            dataType: "json",
            async: false,
            success: function(data) {
                $('.betDetail_acount').html(data.data.gm_name);
                $('.betDetail_cate').html(data.data.name);
                $('.betDetail_type').html(data.data.title);
                $('.betDetail_num').html(data.data.stage);
                $('.betDetail_create_at').attr('title',data.data.create_at);
                $('.betDetail_create_at').html(data.data.create_at);
                $('.betDetail_denomination').html(data.data.denomination);
                $('.betDetail_multiple').html(data.data.multiple);
                $('.betDetail_wei').html(data.data.wei);
                $('.betDetail_id').html(data.data.id);
                $('.betDetail_money').html(data.data.money);
                $('.betDetail_code').html(data.data.stateCn);
                $('.betDetail_bonus').attr('title',data.data.bonus);
                $('.betDetail_bonus').html(data.data.bonus);
                $('.betDetail_zjmoney').html(data.data.z_money);
                $('.betDetail_notes').html(data.data.notes);
                $('.betDetail_open_number').html(data.data.open_number);
                $('.tzxxlist').html(data.data.number);
                //var info = data.msg;
                //alert(info);
                //location.reload();
            }
        });
        $('#detailModal').modal('show');
    }
    function edit_open(uid,status) {
        $.ajax({
            type: "post",
            url: "<?php echo url('edit_open'); ?>",
            data: {'id':uid,'status':status},
            dataType: "json",
            async: false,
            success: function(data) {
                var info = data.msg;
                alert(info);
                location.reload();
            }
        });
    }
</script>
<style>
    .table>caption+thead>tr:first-child>th, .table>colgroup+thead>tr:first-child>th, .table>thead:first-child>tr:first-child>th, .table>caption+thead>tr:first-child>td, .table>colgroup+thead>tr:first-child>td, .table>thead:first-child>tr:first-child>td{
        text-align: center;
    }
    .table thead > tr > th, .table tbody > tr > th, .table tfoot > tr > th, .table thead > tr > td, .table tbody > tr > td, .table tfoot > tr > td{
        text-align: center;
    }
</style>
<!--body wrapper end-->

        <!--footer section start-->
        <footer class="sticky-footer">
           
        </footer>
        <!--footer section end-->

    </div>
    <!-- main content end-->
</section>

<!-- Modal -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
                <h4 class="modal-title">修改密码</h4>
            </div>
            <form class="form-horizontal form-post" action="<?php echo url('Users/psd'); ?>" method="post">
            <div class="modal-body">
                <div class="form-group">
                    <label  class="col-lg-2 col-sm-2 control-label">原密码</label>
                    <div class="col-lg-10">
                        <input type="password" name="old" class="form-control"  placeholder="">
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-lg-2 col-sm-2 control-label">新密码</label>
                    <div class="col-lg-10">
                        <input type="password" name="password" class="form-control"  placeholder="">
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-lg-2 col-sm-2 control-label">确认密码</label>
                    <div class="col-lg-10">
                        <input type="password" name="passwords" class="form-control"  placeholder="">
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
                <button class="btn btn-primary ajax-post" type="submit" target-form="form-post">提交</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- modal -->

<!-- Placed js at the end of the document so the pages load faster -->
<script src="__JS__/jquery-1.10.2.min.js"></script>
<script src="__JS__/jquery-ui-1.9.2.custom.min.js"></script>
<script src="__JS__/jquery-migrate-1.2.1.min.js"></script>
<script src="__JS__/bootstrap.min.js"></script>
<script src="__JS__/modernizr.min.js"></script>
<script src="__JS__/jquery.nicescroll.js"></script>


<!--pickers plugins-->
<script type="text/javascript" src="__JS__/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="__JS__/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="__JS__/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="__JS__/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="__JS__/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="__JS__/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>

<!--pickers initialization-->
<script src="__JS__/pickers-init.js"></script>


<!--common scripts for all pages-->
<script src="__JS__/scripts.js"></script>
<script src="__JS__/common.js"></script>
<audio id="sound" autoplay="autoplay" loop="loop" />
<script>
    setInterval(function(){
        $.ajax({
            url: "<?php echo url('getNewMessage'); ?>",
            type:'POST',
            dataType: "json",
            beforeSend:function(){ //触发ajax请求开始时执行

            },
            success: function(data){
                if(data){
                    var num = data['charge']*1+data['cash']*1;
                    $('#newMessage').attr('data-target',data['charge']+','+data['cash']);
                } else {
                    var num = 0;
                }
                if(num >=1){
                    $('#sound').attr('src','__IMG__/mp3/alert.mp3');
                }else{
                    $('#sound').attr('src','');
                }
                $('#newMessage').html(num);
            },
            error: function (textStatus) {

            },
            complete: function(){

            }
        });
    },3000);
    $('#newMessage').click(function(){
        var dataStr = $(this).attr('data-target');
        var dataArr = dataStr.split(',');
        var str = '';
        str += '<a href="javascript:;" onclick="abc(1)"><div>未读充值：'+dataArr[0]+'</div></a><a href="javascript:;" onclick="abc(2)"><div>未读提现：'+dataArr[1]+'</div></a>';
        layer.tips(str, '#newMessage', {
            tips: [1, '#3595CC'],
            time: 4000
        });
    })
    function abc(type){
        if(type==1){
            var url = "<?php echo url('money/recharge'); ?>";
        }else{
            var url = "<?php echo url('money/cash'); ?>";
        }
        window.location=url;
    }
</script>

</body>
</html>
