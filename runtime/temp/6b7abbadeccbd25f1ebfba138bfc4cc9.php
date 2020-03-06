<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:61:"/www/wwwroot/smgj/public/../app/wap/view/account/pay_con.html";i:1539742117;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title><?php echo $wayInfo['title']; ?>存款</title>
		<link rel="icon" href="__IMG__/wap_new/favicon.ico" type="image/x-icon">
        <link rel="shortcut icon" href="__IMG__/wap_new/favicon.ico" type="image/x-icon" />
		<link href="__CSS__/wap_new/mui.min.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="__CSS__/wap_new/common.css"/>
		<link rel="stylesheet" type="text/css" href="__CSS__/wap_new/index.css"/>
	</head>
	<body>
		<header class="mui-bar mui-bar-nav">
		    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
		    <h1 class="mui-title"><?php echo $wayInfo['title']; ?>存款</h1>
		</header>
		<div class="mui-content">
			<div class="bank-info bg_ff">
				<div class="padding_10 bor_b">
					<label for="">收款户名</label>
					<input type="hidden" name="way_id" value="<?php echo $wayInfo['id']; ?>" disabled>
					<input type="text" name="" id="" value="<?php echo $wayInfo['sha1']; ?>" disabled placeholder="请输入<?php echo $wayInfo['title']; ?>名称"/>
				</div>
				<div class="padding_10 bor_b">
					<label for="">收款银行</label>
					<input type="text" name="" value="<?php echo (isset($wayInfo['pic']) && ($wayInfo['pic'] !== '')?$wayInfo['pic']:'无'); ?>" disabled placeholder="请输入<?php echo $wayInfo['title']; ?>账号"/>
				</div>
				<div class="padding_10 bor_b">
					<label for="">收款账号</label>
					<input type="text" name="" value="<?php echo $wayInfo['path']; ?>" disabled placeholder="请输入<?php echo $wayInfo['title']; ?>账号"/>
				</div>
				<div class="padding_10 bor_b">
					<label for="">存款金额</label>
					<input type="number" name="money" id="" value="" placeholder="请输入存款金额"/>
				</div>
				<div class="padding_10 bor_b">
					<label for="">付款人姓名</label>
					<input type="text" name="name" id="" value="" maxlength="25" placeholder="请输入付款人姓名"/>
				</div>
				<div class="padding_10 bor_b text-center">
					<img class="pay-code" src="<?php echo $wayInfo['qrcode']; ?>"/>
				</div>
				<div class="width90 text-center mg_top10">
				<a href="javascript:;" class="big_btn" onclick="chargeSub()">确定</a>
			</div>
			</div>	
		</div>
		<div class="msg-spring"></div>
		<script src="__JS__/wap_new/mui.min.js"></script>
		<script src="__JS__/wap_new/jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="__JS__/wap_new/index.js" type="text/javascript" charset="utf-8"></script>
		<script src="__JS__/layer.js" ></script>
		<script type="text/javascript">
            var chargeSubCheck = true;
            function chargeSub(form){
                var money = $('input[name=money]').val();
                var name = $('input[name=name]').val();
                var recharge = $('input[name=way_id]').val();
                if(money == ''){
                    layer.msg('金额不能为空');
                    return false;
                }
                if(money < 10){
                    layer.msg('充值金额不能低于10');
                    return false;
                }
                if(form == 'charge_form1'){
                    if(money > 5000000){
                        layer.msg('充值金额不能高于5000000');
                        return false;
                    }
                }else{
                    // if(money > 10000){
                    //     pop('充值金额不能高于10000');
                    //     return false;
                    // }
                }
                layer.confirm('是否确认提交订单', {
                    btn: ['确定','取消'] //按钮
                }, function(){
                    if(chargeSubCheck) {
                        chargeSubCheck = false;
                        $.post("<?php echo url('index'); ?>", {'recharge':recharge,'name':name,'money':money}, success, "json");
                        return false;
                        function success(data) {
                            if (data.code == 1) {
                                $('input[name=money]').val('');
                                $('input[name=name]').val('');
                                layer.msg('提交成功');
                                setTimeout(function(){
                                    chargeSubCheck = true;
                                },3000);
                            } else {
                                layer.msg(data.msg);
                                setTimeout(function(){
                                    chargeSubCheck = true;
                                },1000);
                            }

                        }
                    }
                }, function(){

                });
            }
		</script>
	</body>
</html>