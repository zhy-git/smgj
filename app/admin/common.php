<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/8 0008
 * Time: 15:18
 */

/**
 * @param $code 返回码
 * @param $data 返回数据主题
 * @param $msg  返回消息
 */

function json_return($code,$msg,$data=""){
    exit(json_encode(array('ret'=>$code,'msg'=>$msg,'data'=>$data,)));
}

/**
 * 获取客户端IP地址
 * @param integer $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
 * @param boolean $adv 是否进行高级模式获取（有可能被伪装）
 * @return mixed
 */
function get_client_ip($type = 0,$adv=false) {
    $type       =  $type ? 1 : 0;
    static $ip  =   NULL;
    if ($ip !== NULL) return $ip[$type];
    if($adv){
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $arr    =   explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $pos    =   array_search('unknown',$arr);
            if(false !== $pos) unset($arr[$pos]);
            $ip     =   trim($arr[0]);
        }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip     =   $_SERVER['HTTP_CLIENT_IP'];
        }elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip     =   $_SERVER['REMOTE_ADDR'];
        }
    }elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip     =   $_SERVER['REMOTE_ADDR'];
    }
    // IP地址合法验证
    $long = sprintf("%u",ip2long($ip));
    $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
    return $ip[$type];
}

/**
 * 将xml转化为数组
 * @param $xml
 * @return mixed
 */

function xml_to_array($xml){

    $reg = "/<(\w+)[^>]*>([\\x00-\\xFF]*)<\\/\\1>/";

    if(preg_match_all($reg, $xml, $matches)){

        $count = count($matches[0]);

        for($i = 0; $i < $count; $i++){

            $subxml= $matches[2][$i];

            $key = $matches[1][$i];

            if(preg_match( $reg, $subxml )){

                $arr[$key] = xml_to_array( $subxml );

            }else{

                $arr[$key] = $subxml;

            }

        }

    }

    return $arr;

}

/**
 * curl POST
 * @param $curlPost
 * @param $url
 * @return mixed
 */

function curlPost($curlPost,$url){

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $url);

    curl_setopt($curl, CURLOPT_HEADER, false);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($curl, CURLOPT_NOBODY, true);

    curl_setopt($curl, CURLOPT_POST, true);

    curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);

    $return_str = curl_exec($curl);

    curl_close($curl);

    return $return_str;

}

/**
 * 返回随机整数
 * @param int $length
 * @param int $numeric
 * @return string
 *
 */
function random($length = 6 , $numeric = 0) {

    PHP_VERSION < '4.2.0' && mt_srand((double)microtime() * 1000000);

    if($numeric) {

        $hash = sprintf('%0'.$length.'d', mt_rand(0, pow(10, $length) - 1));

    } else {

        $hash = '';

        $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789abcdefghjkmnpqrstuvwxyz';

        $max = strlen($chars) - 1;

        for($i = 0; $i < $length; $i++) {

            $hash .= $chars[mt_rand(0, $max)];

        }

    }

    return $hash;

}

/**
 * @param $ip
 * @return mixed
 */

function get_city_id($ip){
    $url = 'http://ip.taobao.com/service/getIpInfo.php?ip='.$ip;
    $ch = curl_init ();
    curl_setopt ( $ch, CURLOPT_URL, $url );
    curl_setopt ( $ch, CURLOPT_POST, 1 );
    curl_setopt ( $ch, CURLOPT_HEADER, 0 );
    curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );//0如果成功只返回TRUE，自动输出返回的内容1如果成功只将结果返回，不自动输出任何内容。
    $result=curl_exec ( $ch );
    curl_close ( $ch );
    //return $result;
    $result = json_decode($result,true);
    $city = $result['data']['city'];
    return $city;
}

/**
 *添加个人信息
 */
function add_member_msg($uid,$content){
    $data['uid']     = $uid;
    $data['content'] = $content;
    $result = \think\Db::name('member_msg')->insert($data);
}

/**
 * 推送个人消息
 */

function push_one($target,$msg){
    $client = new \JPush\Client('4a998fe41bb56c6adfc6c2a3','00382559bc931004e9dd2d71');
    $client->push()
        ->setPlatform('all')
        ->addRegistrationId($target)
        ->setNotificationAlert($msg)
        ->send();
}
/**
 * 推送公告消息
 */
function push_all($msg){
     $client = new \JPush\Client('4a998fe41bb56c6adfc6c2a3','00382559bc931004e9dd2d71');
    $client->push()
        ->setPlatform('all')
        ->addAllAudience()
        ->setNotificationAlert($msg)
        ->send();
}