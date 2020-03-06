<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:73:"E:\phpStudy\PHPTutorial\WWW\smgj\public/../app/admin\view\money\cash.html";i:1539658830;s:74:"E:\phpStudy\PHPTutorial\WWW\smgj\public/../app/admin\view\common\base.html";i:1527061064;s:73:"E:\phpStudy\PHPTutorial\WWW\smgj\public/../app/admin\view\common\nav.html";i:1523368392;}*/ ?>
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
        
<!--body wrapper start-->
<div class="wrapper">
    <div class="row">
        <div class="col-md-12">
            <!--breadcrumbs start -->
            <ul class="breadcrumb panel">
                <li><a href="<?php echo url('Index/index'); ?>"><i class="fa fa-home"></i> 控制台</a></li>
                <li><a href="<?php echo url('index'); ?>">金额管理</a></li>
                <li class="active">提现记录</li>
            </ul>
            <!--breadcrumbs end -->
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading col-xs-12">

                    <form class="form-inline" action="<?php echo url(''); ?>">
                        <div class="form-group">
                            <div class="col-md-3">
                                <div class="input-group  custom-date-range">
                                    <input type="text" class="form-control form_datetime" value="<?php echo isset($_GET['from']) ? $_GET['from'] :  ''; ?>" name="from">
                                    <span class="input-group-addon">到</span>
                                    <input type="text" class="form-control form_datetime" value="<?php echo isset($_GET['to']) ? $_GET['to'] :  ''; ?>" name="to">
                                </div>
                            </div>
                            <select class="form-control" name="status">
                                <option value="0">提现状态</option>
                                <option value='1' <?php if((isset($_GET['status']) && $_GET['status'] == 1)): ?>selected<?php endif; ?>>审核中</option>
                                <option value='2' <?php if((isset($_GET['status']) && $_GET['status'] == 2)): ?>selected<?php endif; ?> >提现成功</option>
                                <option value='3' <?php if((isset($_GET['status']) && $_GET['status'] == 3)): ?>selected<?php endif; ?> >提现失败</option>
                            </select>
                            <select class="form-control" name="is_temporary">
                                <option value="0">用户</option>
                                <option value="1">游客</option>
                            </select>
                            <input type="text" name="gm_name" class="form-control" value="<?php echo isset($_GET['gm_name']) ? $_GET['gm_name'] :  ''; ?>" placeholder="用户账号">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                            <!--<a href="#"  class="btn btn-success ajax-get" onclick="recharge();"title="后台提现">后台提现</a>-->
                        </div>
                    </form>
                </header>

                <div class="panel-body">
                    <form class="ids" action="<?php echo url('delCash'); ?>" method="post">
                        <table class="table">
                            <thead>
                            <tr>
                                <!--<th><input class="check-all" type="checkbox"/></th>-->
                                <th>ID</th>
                                <th>昵称</th>
                                <th>金额</th>
                                <th>持卡人</th>
                                <th>卡号</th>
                                <th>银行</th>
                                <th>开户行</th>
                                <th>备注</th>
                                <th>操作时间</th>
                                <th>审核时间</th>
                                <th>提现状态</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                            <tr>
                                <!--<td><input class="ids" type="checkbox" value="<?php echo $v['id']; ?>" name="ids[]"/></td>-->
                                <td><?php echo $v['id']; ?></td>
                                <td><?php echo $v['member']['gm_name']; ?></td>
                                <td><?php echo $v['money']; ?></td>
                                <td><?php echo $v['username']; ?></td>
                                <td><?php echo $v['account_bank']; ?></td>
                                <td><?php echo $v['bank_name']; ?></td>
                                <td><?php echo $v['branch_name']; ?></td>
                                <td><?php echo $v['remark']; ?></td>
                                <td><?php if((isTimeZero($v['create_at']))): ?><?php echo $v['create_at']; endif; ?></td>
                                <td><?php if((isTimeZero($v['update_at']))): ?><?php echo $v['update_at']; endif; ?></td>
                                <?php if($v['status']==1): ?>
                                <td>审核中</td>
                                <?php elseif($v['status']==2): ?>
                                <td style="color:#65CEA7">提现成功</td>
                                <?php elseif($v['status']==3): ?>
                                <td style="color:red">提现失败</td>
                                <?php endif; ?>
                                <td>
                                    <?php if(($v['status'] == 1)): ?>
                                    <a href="#"   class="btn btn-success ajax-get" onclick="shenhe(1,'<?php echo $v['uid']; ?>','<?php echo $v['id']; ?>')" title="充值审核">通过</a>
                                    <a href="#"  class="btn btn-danger ajax-get" onclick="shenhe(2,'<?php echo $v['uid']; ?>','<?php echo $v['id']; ?>')" title="充值审核">不通过</a>
                                    <!--<a onclick="recharge('<?php echo $v['id']; ?>','<?php echo $v['member']['nickname']; ?>','<?php echo $v['money']; ?>');" class="fa fa-money" title="充值"></a>-->
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; endif; else: echo "" ;endif; ?>

                            </tbody>
                        </table>
                    </form>
                    <!--<a href="<?php echo url('delCash'); ?>" class="btn btn-sm btn-primary ajax-post confirm" target-form="ids">批量删除</a>-->
                    <div class="row-fluid">
                        <div class="span6">
                            <div class="dataTables_info" id="dynamic-table_info">
                                已提现次数：<?php echo $renshu; ?>&nbsp;&nbsp; 提现总额：<?php echo $total_money; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php echo $page; ?>
        </div>
    </div>
</div>

<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="rechargeModal" class="modal fade">
    <div class="modal-dialog" style="width:400px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">确认提现</h4>
            </div>
            <form class="form-horizontal form-post-addmoney" action="<?php echo url('adminWithdrawals'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-lg-3 col-sm-3 control-label">用户名</label>
                        <div class="col-lg-8">
                            <input type="text" name="gm_name" id="gm_name" class="form-control" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-lg-3 col-sm-3 control-label">提现金额</label>
                        <div class="col-lg-8">
                            <input type="text" name="money" id="money" class="form-control" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-lg-3 col-sm-3 control-label">提现备注</label>
                        <div class="col-lg-8">
                            <input type="text" name="remark" id="remark" class="form-control" value="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" id="rid" value=""/>
                    <button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
                    <button class="btn btn-primary " type="submit" target-form="form-post-addmoney">提交</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    function recharge() {
        $('#rechargeModal').modal('show');
    }
    function shenhe(type,uid,id) {
        $.ajax({
            type: "post",
            url: "<?php echo url('edit_withdrawal_status'); ?>",
            data: {'type':type,'uid':uid,'id':id},
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