<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:75:"E:\phpStudy\PHPTutorial\WWW\smgj\public/../app/admin\view\member\robot.html";i:1539657702;s:74:"E:\phpStudy\PHPTutorial\WWW\smgj\public/../app/admin\view\common\base.html";i:1527061064;s:73:"E:\phpStudy\PHPTutorial\WWW\smgj\public/../app/admin\view\common\nav.html";i:1523368392;}*/ ?>
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
                <li><a href="<?php echo url('index'); ?>">会员管理</a></li>
                <li class="active">机器人信息</li>
            </ul>
            <!--breadcrumbs end -->
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading col-xs-12">

                    <form class="form-inline" action="<?php echo url(); ?>">
                        <!--<div class="form-group">-->
                                <!--<select name="cate" class="form-control ">-->
                                    <!--<option value="" >选择彩种</option>-->
                                    <!--<?php foreach($cates as $v): ?>-->
                                    <!--<option value="<?php echo $v['id']; ?>"  <?php if((isset($cate) && $cate == $v['id'] )): ?>selected="selected"<?php endif; ?>><?php echo $v['name']; ?></option>-->
                                    <!--<?php endforeach; ?>-->
                                <!--</select>-->
                            <!--</div>-->
                            <!--<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>-->
                        <a href="#"  class="btn btn-success ajax-get" onclick="recharge();"title="添加机器人">添加机器人</a>
                    </form>
                </header>

                <div class="panel-body">
                    <form class="ids" action="" method="post">
                        <table class="table">
                            <thead>
                            <tr>
                                <!--<th><input class="check-all" type="checkbox"/></th>-->
                                <th>机器人ID</th>
                                <th>头像</th>
                                <th>昵称</th>
                                <th>彩种</th>
                                <th>房间</th>
                                <th>状态</th>
                                <th>最低投注</th>
                                <th>最高投注</th>
                                <th>间隔时间</th>
                                <th>创建时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                            <tr>
                                <!--<td><input class="ids" type="checkbox" value="<?php echo $v['id']; ?>" name="ids[]"/></td>-->
                                <td><?php echo $v['id']; ?></td>
                                <td><img width="50" src="/uploads/<?php echo $v['logo']; ?>"></td>
                                <td><?php echo $v['nickname']; ?></td>
                                <td><?php echo $v['cate_name']; ?></td>
                                <td><?php echo $v['hall_name']; ?></td>
                                <td><?php if($v['status']==1): ?>开启<?php else: ?>关闭<?php endif; ?></td>
                                <td><?php echo $v['down']; ?></td>
                                <td><?php echo $v['up']; ?></td>
                                <td><?php echo $v['min_time']; ?>秒</td>
                                <td><?php echo $v['create_at']; ?></td>
                                <td> <a href="<?php echo url('robot_show',['id'=>$v['id']]); ?>" class="fa fa-edit" title="编辑"></a>
                                      <?php if($v['status']==0): ?>
                                    <a href="#"   class="btn btn-danger ajax-get" onclick="edit_open('<?php echo $v['id']; ?>',1)" title="开启">开启</a>
                                    <?php else: ?>
                                    <a href="#"   class="btn btn-success ajax-get" onclick="edit_open('<?php echo $v['id']; ?>',0)" title="关闭">关闭</a>
                                    <?php endif; ?>
                                </td>
                            <?php endforeach; endif; else: echo "" ;endif; ?>

                            </tbody>
                        </table>
                    </form>
                </div>
            </section>
            <?php echo $page; ?>
        </div>

    </div>
</div>
<!--body wrapper end-->
<!-- Modal -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="rechargeModal" class="modal fade">
    <div class="modal-dialog" style="width:400px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">添加机器人</h4>
            </div>
            <form class="form-horizontal form-post-addmoney" action="<?php echo url('member/add_robot'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-lg-3 col-sm-3 control-label">机器人昵称</label>
                        <div class="col-lg-8">
                            <input type="text" name="nickname"  class="form-control" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-lg-3 col-sm-3 control-label">头像</label>
                        <div class="col-lg-8">
                              <span class="file_p text-center" id="btn_logo">
                                       <label >点此选择图片</label>
                                       <img height="80px"   id="btn_logo_img" src="__IMG__/add-button.jpg"/><br />
                                       <input type="hidden" name="logo" value=""/>
                              </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-lg-3 col-sm-3 control-label">彩种</label>
                        <div class="col-lg-8">
                            <select name="cate" class="form-control ">
                                <option value="2">加拿大28</option>
                                <!--<?php foreach($cates as $v): ?>-->
                                <!--<option value="<?php echo $v['id']; ?>"  <?php if((isset($cate) && $cate == $v['id'] )): ?>selected="selected"<?php endif; ?>><?php echo $v['name']; ?></option>-->
                                <!--<?php endforeach; ?>-->
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-lg-3 col-sm-3 control-label">房间</label>
                        <div class="col-lg-8">
                            <select name="hall" class="form-control ">
                            <option value="2">1.65模式</option>
                            <option value="3">1.8模式</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-lg-3 col-sm-3 control-label">最低投注</label>
                        <div class="col-lg-8">
                            <input type="text" name="down" class="form-control" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-lg-3 col-sm-3 control-label">最高投注</label>
                        <div class="col-lg-8">
                            <input type="text" name="up"  class="form-control" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-lg-3 col-sm-3 control-label">间隔时间（秒）</label>
                        <div class="col-lg-8">
                            <input type="text" name="min_time"  class="form-control" value="">
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
<script type="text/javascript">
    function recharge() {
        $('#rechargeModal').modal('show');
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
<script type="text/javascript" src="__JS__/Plupload/plupload.full.min.js"></script>

<script type="text/javascript">

    var ids = new Array("btn_logo");

    $.each(ids,function(i,n){

        var self = this.toString();

        var uploader_avatar = new plupload.Uploader({

            runtimes: 'gears,html5,html4,silverlight,flash', //上传插件初始化选用那种方式的优先级顺序

            browse_button: self, // 上传按钮

            url: "<?php echo url('upload_one'); ?>", //远程上传地址

            flash_swf_url: '__DTSC__/Moxie.swf',//flash文件地址

            silverlight_xap_url: '__DTSC__/Moxie.xap', //silverlight文件地址

            filters: {

                max_file_size: '100mb', //最大上传文件大小（格式100b, 10kb, 10mb, 1gb）

                mime_types: [//允许文件上传类型

                    {title: "files", extensions: "jpg,png,gif,jpeg"}

                ]

            },

            multi_selection: false, //true:ctrl多文件上传, false 单文件上传

            init: {

                FilesAdded: function(up, files) { //文件上传前

                    uploader_avatar.start();

                },

                UploadProgress: function(up, file) { //上传中，显示进度条

                    var percent = file.percent;

                    $("#" + file.id).find('.bar').css({"width": percent + "%"});

                    $("#" + file.id).find(".percent").text(percent + "%");

                },

                FileUploaded: function(up, file, info) { //文件上传成功的时候触发

                    var data = eval("(" + info.response + ")");//解析返回的json数据

                    if(data.status == 1){

                        var img = self+'_img'

                        document.getElementById(img).src = '/uploads/'.data.pic;

                        document.getElementById(img).width = 200;

                        $('#'+self).find('i').remove();

                        $('#'+self).find('input').val(data.picd);

                    }else{

                        alert(data.error);

                    }

                },

                Error: function(up, err) { //上传出错的时候触发

                    alert(err.message);

                }

            }

        });

        uploader_avatar.init();

    })







</script>


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
