<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:62:"/www/wwwroot/smgj/public/../app/wap/view/account/add_bank.html";i:1539063880;}*/ ?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>银行账号</title>
		<link rel="icon" href="__IMG__/favicon.ico" type="image/x-icon">
        <link rel="shortcut icon" href="__IMG__/favicon.ico" type="image/x-icon" />
		<link href="__CSS__/wap_new/mui.min.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="__CSS__/wap_new/common.css"/>
		<link rel="stylesheet" type="text/css" href="__CSS__/wap_new/index.css"/>
	</head>
	<body>
		<header class="mui-bar mui-bar-nav">
		    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
		    <h1 class="mui-title">银行账号</h1>
		</header>
		<div class="mui-content">
			<div class="bank-info bg_ff">
				<div class="padding_10 bor_b">
					<label for="">发卡银行</label>
					<select name="bank">
						<?php if(!(empty($banks) || (($banks instanceof \think\Collection || $banks instanceof \think\Paginator ) && $banks->isEmpty()))): if(is_array($banks) || $banks instanceof \think\Collection || $banks instanceof \think\Paginator): $i = 0; $__LIST__ = $banks;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
							<option value="<?php echo $vo['bank']; ?>"><?php echo $vo['bank']; ?></option>
							<?php endforeach; endif; else: echo "" ;endif; endif; ?>
					</select>
				</div>
				<div class="padding_10 bor_b">
					<label for="">支行</label>
					<input type="text" name="bank_branch" id="" value="" placeholder="请输入发卡支行"/>
				</div>
				<div class="padding_10 bor_b">
					<label for="">收款户名</label>
					<input type="text" name="bank_name" id="" value="" placeholder="请输入收款户名"/>
				</div>
				<div class="padding_10 bor_b">
					<label for="">收款账号</label>
					<input type="number" name="bank_num" id="" value="" placeholder="请输入银行卡号"/>
				</div>
				<div class="width90 text-center mg_top10">
				<a href="javascript:;" class="big_btn" onclick="add_bank()">确定</a>
			</div>
			</div>	
		</div>
		<div class="msg-spring"></div>
		<script src="__JS__/wap_new/mui.min.js"></script>
		<script src="__JS__/wap_new/jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="__JS__/wap_new/index.js" type="text/javascript" charset="utf-8"></script>
		<script src="__JS__/layer.js" ></script>
		<script>
			function add_bank() {
				var bank_name = $("select[name=bank]").val();
				var bank_branch = $("input[name=bank_branch]").val();
				var bank_user = $("input[name=bank_name]").val();
				var bank_num  = $("input[name=bank_num]").val();
				if(bank_name.length>20){
				    layer.msg('发卡银行不正确！');return false;
				}
				if(bank_branch.length>50){
				    layer.msg('支行过长，请简写');return false;
				}
				if(bank_user.length>20){
                    layer.msg('收款户名不正确！');return false;
				}
				if(bank_num.length>19){
                    layer.msg('收款账号不正确！');return false;
				}
				$.post("<?php echo url('addcard'); ?>",{bank:bank_name,bank_branch:bank_branch,fullName:bank_user,num:bank_num},function (data){
					console.log(data);
					if(data.code==1){
                        layer.msg(data.msg, {
                            icon: 1,
                            time: 1500 //2秒关闭（如果不配置，默认是3秒）
                        }, function(){
                            window.location.href=data.url;
                        });
                    }else{
					    layer.msg(data.msg);
					}
                })
            }
		</script>
	</body>
</html>