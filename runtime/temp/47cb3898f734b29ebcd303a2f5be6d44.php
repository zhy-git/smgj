<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:65:"/www/wwwroot/smgj/public/../app/admin/view/member/robot_edit.html";i:1539658736;s:59:"/www/wwwroot/smgj/public/../app/admin/view/common/base.html";i:1527061064;s:58:"/www/wwwroot/smgj/public/../app/admin/view/common/nav.html";i:1523368392;}*/ ?>
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
                <li><a href="<?php echo url('Users/index'); ?>">机器人管理</a></li>
                <li class="active">编辑机器人</li>
            </ul>
            <!--breadcrumbs end -->
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    编辑机器人
                </header>
                <div class="panel-body">
                    <div class="form">
                       <form class="form-horizontal adminex-form userForm" action="<?php echo url('member/robot_edit'); ?>" method="post">

                                    <div class="form-group">
                                        <label  class="control-label col-lg-2">机器人昵称</label>
                                        <div class="col-lg-4">
                                            <input type="text" name="nickname"  class="form-control" value="<?php echo $data['nickname']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label  class="control-label col-lg-2">机器人头像</label>
                                        <div class="col-lg-8">
                                            <img height="100px"  src="/uploads/<?php echo $data['logo']; ?>"/><br />
                                            <p style="color:green"> 图片不要传太大，不然会影响加载速度哦</p>
                                          <span class="file_p text-center" id="btn_logo">
                                                   <label >点此选择图片</label>
                                                   <img height="100px"   id="btn_logo_img" src="__IMG__/add-button.jpg"/><br />
                                                   <input type="hidden" name="logo" value="<?php echo $data['logo']; ?>"/>
                                          </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label  class="control-label col-lg-2">彩种</label>
                                        <div class="col-lg-4">
                                            <select name="cate" class="form-control ">
                                                <!--<option value="" >选择彩种</option>-->
                                                <option value="2">加拿大28</option>
                                                <!--<?php foreach($cates as $v): ?>-->
                                                <!--<option value="<?php echo $v['id']; ?>"  <?php if((isset($data['cate']) && $data['cate'] == $v['id'] )): ?>selected="selected"<?php endif; ?>><?php echo $v['name']; ?></option>-->
                                                <!--<?php endforeach; ?>-->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label  class="control-label col-lg-2">房间</label>
                                        <div class="col-lg-4">
                                            <select name="hall" class="form-control ">
                                                <option value="" >选择房间</option>
                                                <!--<option value="1" <?php if((isset($data['hall']) && $data['hall'] == 1 )): ?>selected <?php endif; ?>>1号房间</option>-->
                                                <option value="2" <?php if((isset($data['hall']) && $data['hall'] == 2 )): ?>selected <?php endif; ?>>1.85模式</option>
                                                <option value="3" <?php if((isset($data['hall']) && $data['hall'] == 3 )): ?>selected <?php endif; ?>>1.6模式</option>
                                                <!--<option value="4" <?php if((isset($data['hall']) && $data['hall'] == 4 )): ?>selected <?php endif; ?>>4号房间</option>-->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label  class="control-label col-lg-2">最低投注</label>
                                        <div class="col-lg-4">
                                            <input type="text" name="down"  class="form-control" value="<?php echo $data['down']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label  class="control-label col-lg-2">最高投注</label>
                                        <div class="col-lg-4">
                                            <input type="text" name="up" class="form-control" value="<?php echo $data['up']; ?>">
                                        </div>
                                    </div>
                                   <div class="form-group">
                                       <label  class="control-label col-lg-2">间隔时间（秒）</label>
                                       <div class="col-lg-4">
                                           <input type="text" name="min_time" class="form-control" value="<?php echo $data['min_time']; ?>">
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <label  class="control-label col-lg-2">开启/关闭</label>
                                       <div class="col-lg-4">
                                           <input type="radio" name="status"  value="1"  <?php if($data['status']==1): ?> checked <?php endif; ?>>开启
                                           <input type="radio" name="status"  value="0" <?php if($data['status']==0): ?> checked <?php endif; ?>>关闭
                                       </div>
                                   </div>

                                <div class="form-group">
                                    <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                                    <button class="btn btn-primary " type="submit">保存</button>
                                </div>
                            </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<!--body wrapper end-->
<script src="__JS__/jquery-1.10.2.min.js"></script>
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

                        document.getElementById(img).src = '/uploads/'+data.pic;

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
