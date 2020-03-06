<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:57:"/www/wwwroot/smgj/public/../app/wap/view/agent/share.html";i:1541492865;}*/ ?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>分享二维码</title>
		<link rel="icon" href="__IMG__/wap_new/favicon.ico" type="image/x-icon">
		<link rel="shortcut icon" href="__IMG__/wap_new/favicon.ico" type="image/x-icon" />
		<link href="__CSS__/wap_new/mui.min.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="__CSS__/wap_new/common.css"/>
		<link rel="stylesheet" type="text/css" href="__CSS__/wap_new/index.css"/>
	</head>
	<body>
		<header class="mui-bar mui-bar-nav">
		    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
		    <h1 class="mui-title">分享二维码</h1>
		</header>
		<div class="mui-content ">
			<?php if(!(empty($shareList) || (($shareList instanceof \think\Collection || $shareList instanceof \think\Paginator ) && $shareList->isEmpty()))): if(is_array($shareList) || $shareList instanceof \think\Collection || $shareList instanceof \think\Paginator): $i = 0; $__LIST__ = $shareList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
			<div class="text-center padding_t50">
				<img class="share-code" src="/<?php echo $vo['qrcode']; ?>" alt="" />
				<h4 class="mg_top20 text-center" id="copy" onclick="" data-clipboard-text="<?php echo $vo['link']; ?>" style="padding: 10px;background: #00A3F0;color: #fff; "><?php echo $vo['remark']; ?><span style="font-size: 10px;">（点击复制链接）</span></h4>
			</div>
			<?php endforeach; endif; else: echo "" ;endif; else: ?>
			<div class="text-center padding_t50">您还没有推广链接</div>
			<?php endif; ?>
		</div>
		
		<div class="msg-spring"></div>
		<script src="__JS__/wap_new/mui.min.js"></script>
		<script src="__JS__/wap_new/jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="__JS__/wap_new/index.js" type="text/javascript" charset="utf-8"></script>
		<script src="__JS__/clipboard.min.js" ></script>
		<script src="__JS__/layer.js" ></script>
		<script>
            $(document).ready(function(){
                var clipboard = new Clipboard('#copy');
                clipboard.on('success', function(e) {
                    layer.msg('复制成功');
                });
                clipboard.on('error', function(e) {
                    alert("复制失败！请手动复制");
                });
            })
		</script>
	</body>

</html>