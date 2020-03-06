<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Cache;
use think\Db;
/*------------公用函数start----------------------*/
//加密函数
function lock_url($txt,$key='tom_technology')
{
    $txt = $txt.$key;
    $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-=+";
    $nh = rand(0,64);
    $ch = $chars[$nh];
    $mdKey = md5($key.$ch);
    $mdKey = substr($mdKey,$nh%8, $nh%8+7);
    $txt = base64_encode($txt);
    $tmp = '';
    $i=0;$j=0;$k = 0;
    for ($i=0; $i<strlen($txt); $i++) {
        $k = $k == strlen($mdKey) ? 0 : $k;
        $j = ($nh+strpos($chars,$txt[$i])+ord($mdKey[$k++]))%64;
        $tmp .= $chars[$j];
    }
    return urlencode(base64_encode($ch.$tmp));
}
//解密函数
function unlock_url($txt,$key='tom_technology')
{
    $txt = base64_decode(urldecode($txt));
    $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-=+";
    $ch = $txt[0];
    $nh = strpos($chars,$ch);
    $mdKey = md5($key.$ch);
    $mdKey = substr($mdKey,$nh%8, $nh%8+7);
    $txt = substr($txt,1);
    $tmp = '';
    $i=0;$j=0; $k = 0;
    for ($i=0; $i<strlen($txt); $i++) {
        $k = $k == strlen($mdKey) ? 0 : $k;
        $j = strpos($chars,$txt[$i])-$nh - ord($mdKey[$k++]);
        while ($j<0) $j+=64;
        $tmp .= $chars[$j];
    }
    return trim(base64_decode($tmp),$key);
}
//curl 请求
function httpGet($url) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 500);
    // 为保证第三方服务器与微信服务器之间数据传输的安全性，所有微信接口采用https方式调用，必须使用下面2行代码打开ssl安全校验。
    // 如果在部署过程中代码在此处验证失败，请到 http://curl.haxx.se/ca/cacert.pem 下载新的证书判别文件。
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($curl, CURLOPT_URL, $url);

    $res = curl_exec($curl);
    curl_close($curl);

    return $res;
}
//从缓存中获取开奖号
function getNumberCache($name){
    $cache_name = 'number_'.$name;
    //$number = Cache::store('redis')->get($cache_name);
    $number = Cache::get($cache_name);
    if($number){
        return $number;
    }
}
// php将字符串分割成数组实现中文分词
function math($string,$code ='UTF-8'){
    if ($code == 'UTF-8') {
        $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
    } else {
        $pa = "/[\x01-\x7f]|[\xa1-\xff][\xa1-\xff]/";
    }
    preg_match_all($pa, $string, $t_string);
    $math=[];
    foreach($t_string[0] as $k=>$s){
        $math[]=$s;
    }
    return $math;
}
// sha1签名
function data_auth_sign($data) {
    //数据类型检测
    if(!is_array($data)){
        $data = (array)$data;
    }
    ksort($data); //排序
    $code = http_build_query($data); //url编码并生成query字符串
    $sign = sha1($code); //生成签名
    return $sign;
}
//一维转二维
function oneToTwo($data,$num){
    $count = count($data);
    $arr = array();
    for($y = 0; $y < $count/$num; $y++){
        for($x = 0; $x < $num; $x++){
            if(($y*$num+$x)<$count){
                $arr[$y][$x] = $data[$y*$num+$x];
            }
        }
    }
    return $arr;
}
//获取限制金额
function getBet($id,$type=false){
    $bet = Cache::get('bet_'.$id);
    if(!$bet){
        $bet = Db('bet')->find($id);
        Cache::tag('bet')->set('bet_'.$id,$bet);
    }
    if($type){
        return ['from'=>$bet['from'],'to'=>$bet['to']];
    }else{
        return $bet['from'].'-'.$bet['to'];
    }
}
//获取倍率
function getOdds($cate=1,$hall=1,$type=1,$rule=1){
    //$odds = Cache::get('odds_'.$cate.$type.$rule);
    //if(!$odds){
        $odds = Db('odds')
            ->where([
                'cate'=>$cate,
                'hall'=>$hall,
                'type'=>$type,
                'rule'=>$rule
            ])
           ->find(); //获取赔率
      //  Cache::tag('odds')->set('odds_'.$cate.$type.$rule,$odds);
   // }
//    if($hall!=1){
//        $bei = \think\Db::name('hall')->where(array('cate'=>$cate,'hall'=>$hall))->value('relatively_odd');
//        $odds['rate'] = $odds['rate']*$bei;
//    }
    return number_format($odds['rate'],3);
}
//记录明细
function addDetail($uid,$type,$money,$balance,$exp,$cate,$explain='',$hall=1,$single = 0){
    $data=[
        'uid'=>$uid,
        'type'=>$type,
        'money'=>$money,
        'balance'=>$balance,
        'cate'=>$cate,
        'exp'=>$exp,
        'explain'=>$explain,
        'hall'=>$hall,
        'single_id'=>$single
    ];
    $detail = new \app\admin\model\Detail($data);
    $detail->allowField(true)->save();
}
//根据表中的id 获取对应的值
function getTableName($table,$id,$name){
    $res = Db($table)->where('id',$id)->value($name);
    return $res;
}
/*------------公用函数end----------------------*/

/*------------后台start----------------------*/
//检测是后台登入
function isAdminLogin(){
    $user = session('admin_login');
    if (empty($user)) {
        return 0;
    } else {
        return session('admin_login_sign') == data_auth_sign($user) ? $user['uid'] : 0;
    }
}
function isHomeLogin(){
    $member = session('member_info');
    if (empty($member)) {
        return false;
    } else {
        return true;
    }

}
//判断时间戳是不是为0
function isTimeZero($time){
    if(strtotime($time)>0){
        return true;
    }else{
        return false;
    }
}
/*------------后台end----------------------*/
//获取基础赔率
function getPl($winId){
    $oddsList = getOddsList();
    $odds = $oddsList[$winId];
    return $odds;
}
function getOddsList(){
    $oddsList = Cache::get('odds_list');
    if(!$oddsList){
        $oddsListRe = Db::name('odds')->select();
        foreach ($oddsListRe as $olrk=>$olrv){
            $oddsList[$olrv['id']] = $olrv;
        }
        Cache::set('odds_list',$oddsList,60);
    }
    return $oddsList;
}
//获取用户赔率和返点 获取上级代理 获取上级赔率和返点
function getUserPl($uid){
    $whereData['id'] = $uid;
    $odds = Db('member')->where($whereData)->field('proxy_id,rebate,bonus,proxy_rebate,proxy_bonus')->cache(30)->find(); //获取赔率
    return $odds;
}
//计算当前玩法当前玩家每注奖金
function getBonus($pl,$userPl){
    if($pl['bonus'] == $userPl['bonus']){
        return $pl['rate'];
    }else{
        $a  = $pl['bonus'] - $userPl['bonus'];
        $aa = round(bcdiv($a,$pl['bonus'],20),16);
        $bb = round(bcmul($aa,$pl['rate'],20),16);
        $cc = round(bcsub($pl['rate'],$bb,4),3);
        return $cc;
    }
}
//计算返回上级多少钱
function getFanli($userPl,$money){
    if($userPl['rebate'] == $userPl['proxy_rebate']){
        return 0;
    }else{
        $a  = $userPl['proxy_rebate'] - $userPl['rebate'];
        $aa = round(bcdiv($a,100,20),16);
        $bb = bcmul($money,$aa,3);
        return $bb;
    }
}
//计算返回上级多少钱
function getZhongFanli($userPl,$money){
    if($userPl['bonus'] == $userPl['proxy_bonus']){
        return 0;
    }else{
        $a  = $userPl['proxy_bonus'] - $userPl['bonus'];
        $aa = round(bcdiv($a,$userPl['bonus'],20),16);
        $bb = round(bcmul($money,$aa,4),3);
        return $bb;
    }
}
//元角分厘转换
function denominationChange($num){
    $numlen = strlen($num);
    switch ($numlen){
        case 1:
            return 1;
            break;
        case 3:
            $num = 10;
            break;
        case 4:
            $num = 100;
            break;
        case 5:
            $num = 1000;
            break;
    }
    return $num;
}
//数字组合
function getCombinationToString($arr,$m){
    $result = array();
    if($m == 1){
        return $arr;
    }
    if($m == count($arr)){
        $result[] = implode(',',$arr);
        return $result;
    }
    $temp_firstelement = $arr[0];
    unset($arr[0]);
    $arr = array_values($arr);
    $temp_first1 = getCombinationToString($arr,$m - 1);
    foreach($temp_first1 as $s){
        $s = $temp_firstelement.','.$s;
        $result[] = $s;
    }
    unset($temp_first1);
    $temp_first2 = getCombinationToString($arr,$m);
    foreach($temp_first2 as $s){
        $result[] = $s;
    }
    unset($temp_first2);
    return $result;
}
/**
 * 将中文字符串分割为数组
 * @param  string $str 字符串
 * @return array       分割得到的数组
 */
function mb_str_split($str){
    return preg_split('/(?<!^)(?!$)/u', $str );
}
//大小判断
function dxJudgment($max,$num){
    if($num>=$max){
        return '大';
    }
    return '小';
}
//大小和判断
function dxhJudgment($he,$max,$num){
    if($num == $he){
        return '和';
    }else{
        if($num>=$max){
            return '大';
        }
        return '小';
    }
}
//单双判断
function dsJudgment($num){
    if($num%2==0){
        return '双';
    }
    return '单';
}
//大小单双判断
function dxdsJudgment($max,$num){
    if($num%2==0){
        if($num>$max){
            return '大双';
        }
        return '小双';
    }else{
        if($num>$max){
            return '大单';
        }
        return '小单';
    }
}
//龙虎和判断
function lhhJudgment($num,$num2){
    if($num>$num2){
        return '龙';
    }elseif($num<$num2){
        return '虎';
    }
    return '和';
}
//庄闲判断
function zxJudgment($num,$num2){
    if($num>$num2){
        return '庄';
    }elseif($num<$num2){
        return '闲';
    }
}
//判断三个号码的状态
function judge_three($number_arr){
    sort($number_arr);
    $arr_num = array_count_values($number_arr);
    if($number_arr[0]==$number_arr[1] && $number_arr[1] ==$number_arr[2]){
        $first_three= "豹子";
        return  $first_three;
    }elseif ($number_arr[0]+1==$number_arr[1] && $number_arr[1]+1 ==$number_arr[2]){
        $first_three= "顺子";
        return  $first_three;
    }elseif(in_array(2,$arr_num)){
        $first_three= "对子";
        return  $first_three;
    }elseif (abs($number_arr[0]-$number_arr[1]) == 1 ||abs($number_arr[0]-$number_arr[2]) == 1 ||abs($number_arr[1]-$number_arr[2]) == 1 ){
        $first_three= "半顺";
        return  $first_three;
    }elseif (abs($number_arr[0]-$number_arr[1]) >1 &&abs($number_arr[0]-$number_arr[2]) > 1 &&abs($number_arr[1]-$number_arr[2]) > 1 ){
        $first_three= "杂六";
        return  $first_three;
    }
}
//计算（时间和期数）
function setCarStageTime(){
    //计算下期的数字
    $whereData['end_time'] = array('gt',time());
    $a = Db::name('car_stage')->where($whereData)->find();
    $endTime = $a['end_time']-time();
    return ['stage_next'=>$a['stage'],'dateline'=>$endTime,'endBetTime'=>$a['end_bet_time']];
}
//计算（时间和期数）
function setCqSscStageTime(){
    //计算下期的数字
    $whereData['end_time'] = array('gt',time());
    $a = Db::name('cqssc_stage')->where($whereData)->find();
    $endTime = $a['end_time']-time();
    return ['stage_next'=>$a['stage'],'dateline'=>$endTime,'endBetTime'=>$a['end_bet_time']];
}
//计算（时间和期数）
function setXyftStageTime(){
    //计算下期的数字
    $whereData['end_time'] = array('gt',time());
    $a = Db::name('xyft_stage')->where($whereData)->find();
    $endTime = $a['end_time']-time();
    return ['stage_next'=>$a['stage'],'dateline'=>$endTime,'endBetTime'=>$a['end_bet_time']];
}
//计算（时间和期数）
function setMsscStageTime(){
    //计算下期的数字
    $whereData['end_time'] = array('gt',time());
    $a = Db::name('mssc_stage')->where($whereData)->find();
    $endTime = $a['end_time']-time();
    return ['stage_next'=>$a['stage'],'dateline'=>$endTime,'endBetTime'=>$a['end_bet_time']];
}
//计算（时间和期数）
function setMssscStageTime(){
    //计算下期的数字
    $whereData['end_time'] = array('gt',time());
    $a = Db::name('msssc_stage')->where($whereData)->find();
    $endTime = $a['end_time']-time();
    return ['stage_next'=>$a['stage'],'dateline'=>$endTime,'endBetTime'=>$a['end_bet_time']];
}
//计算（时间和期数）
function setJsksStageTime(){
    //计算下期的数字
    $whereData['end_time'] = array('gt',time());
    $a = Db::name('jsks_stage')->where($whereData)->find();
    $endTime = $a['end_time']-time();
    return ['stage_next'=>$a['stage'],'dateline'=>$endTime,'endBetTime'=>$a['end_bet_time']];
}
//计算（时间和期数）
function setPcddStageTime(){
    //计算下期的数字
    $whereData['end_time'] = array('gt',time());
    $a = Db::name('pcdd_stage')->where($whereData)->find();
    $endTime = $a['end_time']-time();
    return ['stage_next'=>$a['stage'],'dateline'=>$endTime,'endBetTime'=>$a['end_bet_time']];
}
function setJndebStageTime(){
    //计算下期的数字
    $whereData['end_time'] = array('gt',time());
    $a = Db::name('jndeb_stage')->where($whereData)->find();
    $endTime = $a['end_time']-time();
    return ['stage_next'=>$a['stage'],'dateline'=>$endTime,'endBetTime'=>$a['end_bet_time']];
}
//计算（时间和期数）
function setGdsyxwStageTime(){
    //计算下期的数字
    $whereData['end_time'] = array('gt',time());
    $a = Db::name('gdsyxw_stage')->where($whereData)->find();
    $endTime = $a['end_time']-time();
    return ['stage_next'=>$a['stage'],'dateline'=>$endTime,'endBetTime'=>$a['end_bet_time']];
}
//计算（时间和期数）
function setXyncStageTime(){
    //计算下期的数字
    $whereData['end_time'] = array('gt',time());
    $a = Db::name('xync_stage')->where($whereData)->find();
    $endTime = $a['end_time']-time();
    return ['stage_next'=>$a['stage'],'dateline'=>$endTime,'endBetTime'=>$a['end_bet_time']];
}
//计算（时间和期数）
function setXglhcStageTime(){
    //计算下期的数字
    $whereData['end_time'] = array('gt',time());
    $a = Db::name('xglhc_stage')->where($whereData)->find();
    $endTime = $a['end_time']-time();
    return ['stage_next'=>$a['stage'],'dateline'=>$endTime,'endBetTime'=>$a['end_bet_time']];
}
function getShuXiang($num){
    $shuxing['01'] = '狗';$shuxing['13'] = '狗';$shuxing['25'] = '狗';$shuxing['37'] = '狗';$shuxing['49'] = '狗';
    $shuxing['02'] = '鸡';$shuxing['14'] = '鸡';$shuxing['26'] = '鸡';$shuxing['38'] = '鸡';$shuxing['50'] = '鸡';
    $shuxing['03'] = '猴';$shuxing['15'] = '猴';$shuxing['27'] = '猴';$shuxing['39'] = '猴';$shuxing['51'] = '猴';
    $shuxing['04'] = '羊';$shuxing['16'] = '羊';$shuxing['28'] = '羊';$shuxing['40'] = '羊';$shuxing['52'] = '羊';
    $shuxing['05'] = '马';$shuxing['17'] = '马';$shuxing['29'] = '马';$shuxing['41'] = '马';$shuxing['53'] = '马';
    $shuxing['06'] = '蛇';$shuxing['18'] = '蛇';$shuxing['30'] = '蛇';$shuxing['42'] = '蛇';$shuxing['54'] = '蛇';
    $shuxing['07'] = '龙';$shuxing['19'] = '龙';$shuxing['31'] = '龙';$shuxing['43'] = '龙';$shuxing['55'] = '龙';
    $shuxing['08'] = '兔';$shuxing['20'] = '兔';$shuxing['32'] = '兔';$shuxing['44'] = '兔';$shuxing['56'] = '兔';
    $shuxing['09'] = '虎';$shuxing['21'] = '虎';$shuxing['33'] = '虎';$shuxing['45'] = '虎';$shuxing['57'] = '虎';
    $shuxing['10'] = '牛';$shuxing['22'] = '牛';$shuxing['34'] = '牛';$shuxing['46'] = '牛';$shuxing['58'] = '牛';
    $shuxing['11'] = '鼠';$shuxing['23'] = '鼠';$shuxing['35'] = '鼠';$shuxing['47'] = '鼠';$shuxing['59'] = '鼠';
    $shuxing['12'] = '猪';$shuxing['24'] = '猪';$shuxing['36'] = '猪';$shuxing['48'] = '猪';$shuxing['60'] = '猪';
    return $shuxing[$num];
}
/*------------重庆时时彩start------------------*/
//重庆时时彩 总和-龙虎和
function cqsscZhlhh($numbers,$kjNumber){
    $sumNum = array_sum($kjNumber);
    switch ($numbers){
        case '总和大':
            $zhong = '大';
            $returnData['win_id'] = 1;
            $result = dxJudgment(23,$sumNum);
            break;
        case '总和小':
            $zhong = '小';
            $returnData['win_id'] = 1;
            $result = dxJudgment(23,$sumNum);
            break;
        case '总和单':
            $zhong = '单';
            $returnData['win_id'] = 1;
            $result = dsJudgment($sumNum);
            break;
        case '总和双':
            $zhong = '双';
            $returnData['win_id'] = 1;
            $result = dsJudgment($sumNum);
            break;
        case '龙':
            $zhong = '龙';
            $returnData['win_id'] = 2;
            $result = lhhJudgment($kjNumber[0],$kjNumber[4]);
            break;
        case '虎':
            $zhong = '虎';
            $returnData['win_id'] = 3;
            $result = lhhJudgment($kjNumber[0],$kjNumber[4]);
            break;
        case '和':
            $zhong = '和';
            $returnData['win_id'] = 4;
            $result = lhhJudgment($kjNumber[0],$kjNumber[4]);
            break;
        default :
            $returnData['error_code'] = 501;
            return $returnData;
            break;
    }
    if($zhong === $result){
        $returnData['win'] = 1;
    }else{
        $returnData['win'] = 0;
    }
    return $returnData;
}
//重庆时时彩 第一球-第五球
function cqsscBall($numbers,$kjNumber,$type){
    switch ($type){
        case 2:
            $kjNumber = $kjNumber[0];
            break;
        case 3:
            $kjNumber = $kjNumber[1];
            break;
        case 4:
            $kjNumber = $kjNumber[2];
            break;
        case 5:
            $kjNumber = $kjNumber[3];
            break;
        case 6:
            $kjNumber = $kjNumber[4];
            break;
    }
    switch ($numbers){
        case '大':
            $returnData['win_id'] = 5;
            $result = dxJudgment(5,$kjNumber);
            break;
        case '小':
            $returnData['win_id'] = 5;
            $result = dxJudgment(5,$kjNumber);
            break;
        case '单':
            $returnData['win_id'] = 5;
            $result = dsJudgment($kjNumber);
            break;
        case '双':
            $returnData['win_id'] = 5;
            $result = dsJudgment($kjNumber);
            break;
        default :
            $returnData['win_id'] = 6;
            $result = $kjNumber;
            break;
    }
    if($numbers === $result){
        $returnData['win'] = 1;
    }else{
        $returnData['win'] = 0;
    }
    return $returnData;
}
//重庆时时彩 前中后三
function cqsscQzhsan($numbers,$kjNumber,$type){
    switch ($type){
        case 7:
            $kjNumber = array_slice($kjNumber,0,3);
            break;
        case 8:
            $kjNumber = array_slice($kjNumber,1,3);
            break;
        case 9:
            $kjNumber = array_slice($kjNumber,2,3);
            break;
    }
    $result = judge_three($kjNumber);
    switch ($result){
        case '豹子':
            $returnData['win_id'] = 7;
            break;
        case '顺子':
            $returnData['win_id'] = 8;
            break;
        case '对子':
            $returnData['win_id'] = 9;
            break;
        case '半顺':
            $returnData['win_id'] = 10;
            break;
        case '杂六':
            $returnData['win_id'] = 11;
            break;
    }
    if($numbers === $result){
        $returnData['win'] = 1;
    }else{
        $returnData['win'] = 0;
    }
    return $returnData;
}
/*------------重庆时时彩end------------------*/

/*------------北京PK10start------------------*/
function carGyhqd($sum){
    $arr1 = array(3,4,5,6,7);
    $arr2 = array(8,9,10,11,12,13,14);
    $arr3 = array(15,16,17,18,19);
    if(in_array($sum, $arr1)){
        return 'A(3-7)';
    }elseif (in_array($sum, $arr2)) {
        return 'B(8-14)';
    }elseif (in_array($sum, $arr3)) {
        return 'C(15-19)';
    }else{
        return '';
    }
}
//北京PK10 总和-冠亚军
function carZhgyj($numbers,$kjNumber){
    $sumNum = $kjNumber[0]+$kjNumber[1];
    switch ($numbers){
        case '冠亚大':
            $zhong = '大';
            $result = dxJudgment(12,$sumNum);
            break;
        case '冠亚小':
            $zhong = '小';
            $result = dxJudgment(12,$sumNum);
            break;
        case '冠亚单':
            $zhong = '单';
            $result = dsJudgment($sumNum);
            break;
        case '冠亚双':
            $zhong = '双';
            $result = dsJudgment($sumNum);
            break;
        case 'A(3-7)':
        case 'B(8-14)':
        case 'C(15-19)':
            $zhong = $numbers;
            $result =carGyhqd($sumNum);
            break;
        default :
            $zhong = $numbers;
            $result = $sumNum;
            break;
    }
    if($zhong == $result){
        $returnData['win'] = 1;
    }else{
        $returnData['win'] = 0;
    }
    return $returnData;
}
//北京PK10 第一名-第十名
function carBall($numbers,$kjNumber,$type){
    switch ($type){
        case 1:
            switch ($numbers) {
                case '龙':
                case '虎':
                    $newKjNumber[0] = $kjNumber[0];
                    $newKjNumber[1] = $kjNumber[9];
                    $kjNumber = $newKjNumber;
                    break;
                default :
                    $kjNumber = $kjNumber[0];
                    break;
            }
            break;
        case 2:
            switch ($numbers) {
                case '龙':
                case '虎':
                    $newKjNumber[0] = $kjNumber[1];
                    $newKjNumber[1] = $kjNumber[8];
                    $kjNumber = $newKjNumber;
                    break;
                default :
                    $kjNumber = $kjNumber[1];
                    break;
            }
            break;
        case 3:
            switch ($numbers) {
                case '龙':
                case '虎':
                    $newKjNumber[0] = $kjNumber[2];
                    $newKjNumber[1] = $kjNumber[7];
                    $kjNumber = $newKjNumber;
                    break;
                default :
                    $kjNumber = $kjNumber[2];
                    break;
            }
            break;
        case 4:
            switch ($numbers) {
                case '龙':
                case '虎':
                    $newKjNumber[0] = $kjNumber[3];
                    $newKjNumber[1] = $kjNumber[6];
                    $kjNumber = $newKjNumber;
                    break;
                default :
                    $kjNumber = $kjNumber[3];
                    break;
            }
            break;
        case 5:
            switch ($numbers) {
                case '龙':
                case '虎':
                    $newKjNumber[0] = $kjNumber[4];
                    $newKjNumber[1] = $kjNumber[5];
                    $kjNumber = $newKjNumber;
                    break;
                default :
                    $kjNumber = $kjNumber[4];
                    break;
            }
            break;
        case 6:
            $kjNumber = $kjNumber[5];
            break;
        case 7:
            $kjNumber = $kjNumber[6];
            break;
        case 8:
            $kjNumber = $kjNumber[7];
            break;
        case 9:
            $kjNumber = $kjNumber[8];
            break;
        case 10:
            $kjNumber = $kjNumber[9];
            break;
    }
    switch ($numbers){
        case '大':
        case '小':
            $result = dxJudgment(6,$kjNumber);
            break;
        case '单':
        case '双':
            $result = dsJudgment($kjNumber);
            break;
        case '龙':
        case '虎':
            $result = lhhJudgment($kjNumber[0],$kjNumber[1]);
            break;
        case '庄':
        case '闲':
            $result = zxJudgment($kjNumber[0],$kjNumber[1]);
            break;
        case '大双':
        case '大单':
        case '小双':
        case '小单':
            $result = dxdsJudgment(6,$kjNumber);
            break;
        default :
            $result = $kjNumber;
            break;
    }
    if($numbers == $result){
        $returnData['win'] = 1;
    }else{
        $returnData['win'] = 0;
    }
    return $returnData;
}
/*------------北京PK10end------------------*/

/*------------江苏快三start------------------*/
//江苏快三 三军、大小
function jsksSjdx($numbers,$kjNumber){
    $sumNum = array_sum($kjNumber);
    switch ($numbers){
        case '大':
            $zhong = '大';
            $num = count(array_count_values($kjNumber));
            if($num == 1){
                $result = '小';
            }else{
                $result = dxJudgment(11,$sumNum);
            }
            if($zhong == $result){
                $returnData['win'] = 1;
            }else{
                $returnData['win'] = 0;
            }
            break;
        case '小':
            $zhong = '小';
            $num = count(array_count_values($kjNumber));
            if($num == 1){
                $result = '大';
            }else{
                $result = dxJudgment(11,$sumNum);
            }
            if($zhong == $result){
                $returnData['win'] = 1;
            }else{
                $returnData['win'] = 0;
            }
            break;
        default :
            if(array_search($numbers,$kjNumber)!==false){
                $returnData['win'] = 1;
            }else{
                $returnData['win'] = 0;
            };
            break;
    }
    return $returnData;
}
//江苏快三 围骰、全骰
function jsksWsqs($numbers,$kjNumber){
    $countArr = array_count_values($kjNumber);
    $num = count($countArr);
    if($num != 1){
        $returnData['win'] = 0;
        return $returnData;
    }
    switch ($numbers) {
        case '全骰':
            $returnData['win'] = 1;
            break;
        default :
            if($numbers == implode(',',$kjNumber)){
                $returnData['win'] = 1;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
    }
    return $returnData;
}
//点数
function jsksDs($numbers,$kjNumber){
    $sumNum = array_sum($kjNumber);
    if($sumNum == $numbers){
        $returnData['win'] = 1;
    }else{
        $returnData['win'] = 0;
    }
    return $returnData;
}
//长牌
function jsksCp($numbers,$kjNumber){
    $numArr = explode(',',$numbers);
    $countNum = count(array_count_values($numArr));
    if($countNum!=2 || count($numArr)!=2){
        $returnData['win'] = 0;
        return $returnData;
    }
    if(count(array_intersect($numArr,$kjNumber)) == 2){
        $returnData['win'] = 1;
    }else{
        $returnData['win'] = 0;
        return $returnData;
    }
    return $returnData;
}
//短牌
function jsksDp($numbers,$kjNumber){
    $numArr = explode(',',$numbers);
    $countNum = count(array_count_values($numArr));
    if($countNum!=1 || count($numArr)!=2){
        $returnData['win'] = 0;
        return $returnData;
    }
    if(count(array_intersect($numArr,$kjNumber)) == 2){
        $returnData['win'] = 1;
    }else{
        $returnData['win'] = 0;
        return $returnData;
    }
    return $returnData;
}
/*------------江苏快三end------------------*/

/*------------pc蛋蛋start------------------*/
function pcddHh($numbers,$kjNumber){
    switch ($numbers) {
        case '大':
        case '小':
            $sumNum = array_sum($kjNumber);
            $result = dxJudgment(14,$sumNum);
            if($result == $numbers){
                $returnData['win'] = 1;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case '单':
        case '双':
            $sumNum = array_sum($kjNumber);
            $result = dsJudgment($sumNum);
            if($result == $numbers){
                $returnData['win'] = 1;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case '大单':
        case '小单':
        case '大双':
        case '小双':
            $sumNum = array_sum($kjNumber);
            $result = dxdsJudgment(14,$sumNum);
            if($result == $numbers){
                $returnData['win'] = 1;
                return $returnData;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case '极大':
            $sumNum = array_sum($kjNumber);
            if($sumNum>=23){
                $returnData['win'] = 1;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case '极小':
            $sumNum = array_sum($kjNumber);
            if($sumNum<=4){
                $returnData['win'] = 1;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case '豹子':
            $sumNum = count(array_count_values($kjNumber));
            if($sumNum == 1){
                $returnData['win'] = 1;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
    }
    return $returnData;
}
//波色
function xyebTswf($numbers,$kjNumber){
    $sumNum =array_sum($kjNumber);
    $red = array(3,6,9,12,15,18,21,24);
    $green = array(1,4,7,10,16,19,22,25);
    $blue = array(2,5,8,11,17,20,23,26);
    switch ($numbers) {
        case '红':
            if(in_array($sumNum,$red)){
                $returnData['win'] = 1;
            }else{
                $returnData['win'] = 0;
            }
            break;
        case '绿':
            if(in_array($sumNum,$green)){
                $returnData['win'] = 1;
            }else{
                $returnData['win'] = 0;
            }
            break;
        case '蓝':
            if(in_array($sumNum,$blue)){
                $returnData['win'] = 1;
            }else{
                $returnData['win'] = 0;
            }
            break;
        case '豹子':
            if($kjNumber[0]==$kjNumber[1] && $kjNumber[1]==$kjNumber[2]){
                $returnData['win'] = 1;
            }else{
                $returnData['win'] = 0;
            }
            break;
        case '顺子':
            sort($kjNumber,SORT_NUMERIC);
            if($kjNumber[0]+1 ==$kjNumber[1] && $kjNumber[1]+1 == $kjNumber[2]){
                $returnData['win'] = 1;
            }else{
                $returnData['win'] = 0;
            }
            break;
        case '正顺':
            if($kjNumber[0]+1 ==$kjNumber[1] && $kjNumber[1]+1 == $kjNumber[2]){
                $returnData['win'] = 1;
            }else{
                $returnData['win'] = 0;
            }
            break;
        case '对子':
            $num = array_count_values($kjNumber);
            if(in_array(2, $num)){
                $returnData['win'] = 1;
            }else{
                $returnData['win'] = 0;
            }
            break;
        case '倒顺':
            if($kjNumber[2]+1 ==$kjNumber[1] && $kjNumber[1]+1 == $kjNumber[0]){
                $returnData['win'] = 1;
            }else{
                $returnData['win'] = 0;
            }
            break;
        case '半顺':
            if(abs($kjNumber[0]-$kjNumber[1])==1 || abs($kjNumber[1]-$kjNumber[2])==1 || abs($kjNumber[0]-$kjNumber[2])==1){
                $returnData['win'] = 1;
            }else{
                $returnData['win'] = 0;
            }
            break;
        case '乱顺':
            sort($kjNumber,SORT_NUMERIC);
            if($kjNumber[0]+1 ==$kjNumber[1] && $kjNumber[1]+1 == $kjNumber[2]){
                $returnData['win'] = 1;
            }else{
                $returnData['win'] = 0;
            }
            break;
    }
    return $returnData;
}

//判断大小单双组合
function pcddTm($numbers,$kjNumber){
    $sumNum = array_sum($kjNumber);
    if($numbers == $sumNum){
        $returnData['win'] = 1;
    }else{
        $returnData['win'] = 0;
    }
    return $returnData;
}

//计算开奖号结果
function getEightNum($number_arr){
    $one = array_slice($number_arr,0,6);
    $two = array_slice($number_arr,6,6);
    $three = array_slice($number_arr,12,6);
    $one = math(array_sum($one));
    $two = math(array_sum($two));
    $three = math(array_sum($three));
    //$arr = [end($one),end($two),end($three)];
    $arr = end($one).','.end($two).','.end($three);
    return $arr;
}
//计算加拿大28开奖结果
function getJndNum($number_arr){
    $one_arr    = [1,4,7,10,13,16];
    $two_arr    = [2,5,8,11,14,17];
    $three_arr  = [3,6,9,12,15,18];
    for ($i=1; $i <count($number_arr) ; $i++) {
        if(in_array($i,$one_arr)){
            $one[] = $number_arr[$i];
        }
        if(in_array($i,$two_arr)){
            $two[] = $number_arr[$i];
        }
        if(in_array($i,$three_arr)){
            $three[] = $number_arr[$i];
        }
    }
    $one = math(array_sum($one));
    $two = math(array_sum($two));
    $three = math(array_sum($three));
    $arr = end($one).','.end($two).','.end($three);
    return $arr;
}
/*------------pc蛋蛋end------------------*/
/*------------广东11选5start------------------*/
function gdsyxwZh($numbers,$kjNumber){
    $sumNum = array_sum($kjNumber);
    switch ($numbers){
        case '总和大':
            if($sumNum>30){
                $returnData['win'] = 1;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
        case '总和小':
            if($sumNum<30){
                $returnData['win'] = 1;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case '总和单':
            $result = dsJudgment($sumNum);
            if($result == '单'){
                $returnData['win'] = 1;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case '总和双':
            $result = dsJudgment($sumNum);
            if($result == '双'){
                $returnData['win'] = 1;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case '总和尾大':
            $result = substr($sumNum,-1);
            if($result>=5){
                $returnData['win'] = 1;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case '总和尾小':
            $result = substr($sumNum,-1);
            if($result<=4){
                $returnData['win'] = 1;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case '龙':
            if($kjNumber[0]>$kjNumber[4]){
                $returnData['win'] = 1;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case '虎':
            if($kjNumber[0]<$kjNumber[4]){
                $returnData['win'] = 1;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
    }
    return $returnData;
}
function gdsyxwBall($numbers,$kjNumber,$type){
    switch ($type){
        case 2:
            $kjNumber = $kjNumber[0];
            break;
        case 3:
            $kjNumber = $kjNumber[1];
            break;
        case 4:
            $kjNumber = $kjNumber[2];
            break;
        case 5:
            $kjNumber = $kjNumber[3];
            break;
        case 6:
            $kjNumber = $kjNumber[4];
            break;
    }
    switch ($numbers){
        case '大':
        case '小':
            if($kjNumber != 11){
                $result = dxJudgment(6,$kjNumber);
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case '单':
        case '双':
            if($kjNumber != 11){
                $result = dsJudgment($kjNumber);
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        default :
            $result = $kjNumber;
            break;
    }
    if($numbers === $result){
        $returnData['win'] = 1;
    }else{
        $returnData['win'] = 0;
    }
    return $returnData;
}
function gdsyxwYzy($numbers,$kjNumber){
    if(array_search($numbers,$kjNumber)!==false){
        $returnData['win'] = 1;
    }else{
        $returnData['win'] = 0;
        return $returnData;
    }
    return $returnData;
}
/*------------广东11选5end------------------*/

/*------------幸运农场start------------------*/
function xyncZh($numbers,$kjNumber){
    $sumNum = array_sum($kjNumber);
    switch ($numbers){
        case '总和大':
            if($sumNum>=85){
                $returnData['win'] = 1;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
        case '总和小':
            if($sumNum<=83){
                $returnData['win'] = 1;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case '总和单':
            $result = dsJudgment($sumNum);
            if($result == '单'){
                $returnData['win'] = 1;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case '总和双':
            $result = dsJudgment($sumNum);
            if($result == '双'){
                $returnData['win'] = 1;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case '总和尾大':
            $result = substr($sumNum,-1);
            if($result>=5){
                $returnData['win'] = 1;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case '总和尾小':
            $result = substr($sumNum,-1);
            if($result<=4){
                $returnData['win'] = 1;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
    }
    return $returnData;
}
function xyncBall($numbers,$kjNumber,$type){
    if($numbers!='龙' || $numbers!='虎'){
        switch ($type){
            case 2:
                $kjNumber = $kjNumber[0];
                break;
            case 3:
                $kjNumber = $kjNumber[1];
                break;
            case 4:
                $kjNumber = $kjNumber[2];
                break;
            case 5:
                $kjNumber = $kjNumber[3];
                break;
            case 6:
                $kjNumber = $kjNumber[4];
                break;
            case 7:
                $kjNumber = $kjNumber[5];
                break;
            case 8:
                $kjNumber = $kjNumber[6];
                break;
            case 9:
                $kjNumber = $kjNumber[7];
                break;
        }
    }
    switch ($numbers){
        case '大':
        case '小':
                $result = dxJudgment(11,$kjNumber);
            break;
        case '单':
        case '双':
                $result = dsJudgment($kjNumber);
            break;
        case '尾大':
        case '尾小':
            $result = dxJudgment(5,substr($kjNumber,-1));
            if($result == '大'){
                $result = '尾大';
            }else{
                $result = '尾小';
            }
            break;
        case '合数单':
        case '合数双':
            if(strlen($kjNumber)>1){
                $sumNum = $kjNumber[0] + $kjNumber[1];
            }else{
                $sumNum = $kjNumber;
            };
            $result = dsJudgment($sumNum);
            if($result == '单'){
                $result = '合数单';
            }else{
                $result = '合数双';
            }
            break;
        case '龙':
        case '虎':
            $result = lhhJudgment($kjNumber[0],$kjNumber[7]);
            break;
        case '中':
            $zhongArr = array('01','02','03','04','05','06','07');
            if(array_search($numbers,$zhongArr)!==false){
                $returnData['win'] = 1;
                return $returnData;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
        case '发':
            $zhongArr = array('08','09','10','11','12','13','14');
            if(array_search($numbers,$zhongArr)!==false){
                $returnData['win'] = 1;
                return $returnData;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
        case '白':
            $zhongArr = array('15','16','17','18','19','20');
            if(array_search($numbers,$zhongArr)!==false){
                $returnData['win'] = 1;
                return $returnData;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
        case '东':
            $zhongArr = array('01','05','09','13','17');
            if(array_search($numbers,$zhongArr)!==false){
                $returnData['win'] = 1;
                return $returnData;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
        case '南':
            $zhongArr = array('02','06','10','14','18');
            if(array_search($numbers,$zhongArr)!==false){
                $returnData['win'] = 1;
                return $returnData;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
        case '西':
            $zhongArr = array('03','07','11','15','19');
            if(array_search($numbers,$zhongArr)!==false){
                $returnData['win'] = 1;
                return $returnData;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
        case '北':
            $zhongArr = array('04','08','12','16','20');
            if(array_search($numbers,$zhongArr)!==false){
                $returnData['win'] = 1;
                return $returnData;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        default :
            $result = (int)$kjNumber;
            break;
    }
    if($numbers == $result){
        $returnData['win'] = 1;
    }else{
        $returnData['win'] = 0;
    }
    return $returnData;
}
/*------------幸运农场end------------------*/

/*------------香港六合彩start------------------*/
function xglhcTm($numbers,$kjNumber){
    $kjNumber = $kjNumber[6];
    switch ($numbers){
        case '特大':
        case '特小':
            if($kjNumber == 49){
                $returnData['win'] = 2;
                return $returnData;
            }else{
                $result = dxJudgment(25,$kjNumber);
                if($result == '大'){
                    $result = '特大';
                }else{
                    $result = '特小';
                }
                if($result == $numbers){
                    $returnData['win'] = 1;
                    return $returnData;
                }else{
                    $returnData['win'] = 0;
                    return $returnData;
                }
            }
            break;
        case '特单':
        case '特双':
            if($kjNumber == 49){
                $returnData['win'] = 2;
                return $returnData;
            }else{
                $result = dsJudgment($kjNumber);
                if($result == '单'){
                    $result = '特单';
                }else{
                    $result = '特双';
                }
                if($result == $numbers){
                    $returnData['win'] = 1;
                    return $returnData;
                }else{
                    $returnData['win'] = 0;
                    return $returnData;
                }
            }
            break;
        case '和大':
        case '和小':
            if($kjNumber == 49){
                $returnData['win'] = 2;
                return $returnData;
            }else{
                $he = $kjNumber[0]+$kjNumber[1];
                $result = dxJudgment(7,$he);
                if($result == '大'){
                    $result = '和大';
                }else{
                    $result = '和小';
                }
                if($result == $numbers){
                    $returnData['win'] = 1;
                    return $returnData;
                }else{
                    $returnData['win'] = 0;
                    return $returnData;
                }
            }
            break;
        case '和单':
        case '和双':
            if($kjNumber == 49){
                $returnData['win'] = 2;
                return $returnData;
            }else{
                $he = $kjNumber[0]+$kjNumber[1];
                $result = dsJudgment($he);
                if($result == '单'){
                    $result = '和单';
                }else{
                    $result = '和双';
                }
                if($result == $numbers){
                    $returnData['win'] = 1;
                    return $returnData;
                }else{
                    $returnData['win'] = 0;
                    return $returnData;
                }
            }
            break;
        case '尾大':
        case '尾小':
            if($kjNumber == 49){
                $returnData['win'] = 2;
                return $returnData;
            }else{
                $he = $kjNumber[1];
                $result = dxJudgment(5,$he);
                if($result == '大'){
                    $result = '尾大';
                }else{
                    $result = '尾小';
                }
                if($result == $numbers){
                    $returnData['win'] = 1;
                    return $returnData;
                }else{
                    $returnData['win'] = 0;
                    return $returnData;
                }
            }
            break;
        case '尾单':
        case '尾双':
            if($kjNumber == 49){
                $returnData['win'] = 2;
                return $returnData;
            }else{
                $result = dsJudgment($kjNumber[1]);
                if($result=='单'){
                    $result = '尾单';
                }else{
                    $result = '尾双';
                }
                if($result == $numbers){
                    $returnData['win'] = 1;
                    return $returnData;
                }else{
                    $returnData['win'] = 0;
                    return $returnData;
                }
            }
            break;
        case  '红波':
            $arr = array('01','02','07','08','12','13','18','19','23','24','29','30','34','35','40','45','46');//红
            if(array_search($kjNumber,$arr)!==false){
                $returnData['win'] = 1;
                return $returnData;
            } else {
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case  '蓝波':
            $arr = array('03','04','09','10','14','15','20','25','26','31','36','37','41','42','47','48');//蓝
            if(array_search($kjNumber,$arr)!==false){
                $returnData['win'] = 1;
                return $returnData;
            } else {
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case  '绿波':
            $arr = array('05','06','11','16','17','21','22','27','28','32','33','38','39','43','44','49');//绿
            if(array_search($kjNumber,$arr)!==false){
                $returnData['win'] = 1;
                return $returnData;
            } else {
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case '鼠':
        case '马':
        case '牛':
        case '羊':
        case '虎':
        case '猴':
        case '兔':
        case '鸡':
        case '龙':
        case '狗':
        case '蛇':
        case '猪':
            $result = xglhcSx($numbers,$kjNumber);
            if($result){
                $returnData['win'] = 1;
                return $returnData;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case '大单':
        case '大双':
        case '小单':
        case '小双':
            if($kjNumber == 49){
                $returnData['win'] = 2;
                return $returnData;
            }else{
                if($numbers == '大单'){
                    $arr = array('25','27','29','31','33','35','37','39','41','43','45','47');
                }else if($numbers == '大双'){
                    $arr = array('26','28','30','32','34','36','38','40','42','44','46','48');
                }else if($numbers == '小单'){
                    $arr = array('01','03','05','07','09','11','13','15','17','19','21','23');
                }else if($numbers == '小双'){
                    $arr = array('02','04','06','08','10','12','14','16','18','20','22','24');
                }
                if(array_search($kjNumber,$arr)!==false){
                    $returnData['win'] = 1;
                    return $returnData;
                }
                $returnData['win'] = 0;
                return $returnData;
            }
            break;

        default:
            if($kjNumber == $numbers){
                $returnData['win'] = 1;
                return $returnData;
            }
            $returnData['win'] = 0;
            return $returnData;
            break;
    }
}
function xglhcLm($numbers,$kjNumber){
    $sunNum = array_sum($kjNumber);
    $kjNumber = $kjNumber[6];
    switch ($numbers){
        case '特大':
        case '特小':
            if($kjNumber == 49){
                $returnData['win'] = 2;
                return $returnData;
            }else{
                $result = dxJudgment(25,$kjNumber);
                if($result == '大'){
                    $result = '特大';
                }else{
                    $result = '特小';
                }
                if($result == $numbers){
                    $returnData['win'] = 1;
                    return $returnData;
                }else{
                    $returnData['win'] = 0;
                    return $returnData;
                }
            }
            break;
        case '特单':
        case '特双':
            if($kjNumber == 49){
                $returnData['win'] = 2;
                return $returnData;
            }else{
                $result = dsJudgment($kjNumber);
                if($result == '单'){
                    $result = '特单';
                }else{
                    $result = '特双';
                }
                if($result == $numbers){
                    $returnData['win'] = 1;
                    return $returnData;
                }else{
                    $returnData['win'] = 0;
                    return $returnData;
                }
            }
            break;
        case '特合大':
        case '特合小':
            if($kjNumber == 49){
                $returnData['win'] = 2;
                return $returnData;
            }else{
                $he = $kjNumber[0]+$kjNumber[1];
                $result = dxJudgment(7,$he);
                if($result == '大'){
                    $result = '特合大';
                }else{
                    $result = '特合小';
                }
                if($result == $numbers){
                    $returnData['win'] = 1;
                    return $returnData;
                }else{
                    $returnData['win'] = 0;
                    return $returnData;
                }
            }
            break;
        case '特合单':
        case '特合双':
            if($kjNumber == 49){
                $returnData['win'] = 2;
                return $returnData;
            }else{
                $he = $kjNumber[0]+$kjNumber[1];
                $result = dsJudgment($he);
                if($result == '单'){
                    $result = '特合单';
                }else{
                    $result = '特合双';
                }
                if($result == $numbers){
                    $returnData['win'] = 1;
                    return $returnData;
                }else{
                    $returnData['win'] = 0;
                    return $returnData;
                }
            }
            break;
        case '特天肖':
        case '特地肖':
        case '特前肖':
        case '特后肖':
        case '特家肖':
        case '特野肖':
            if($numbers == '特天肖'){
                $arr = array('兔','马','猴','猪','牛','龙');
            }else if($numbers == '特地肖'){
                $arr = array('蛇','羊','鸡','狗','鼠','虎');
            }else if($numbers == '特前肖'){
                $arr = array('鼠','牛','虎','兔','龙','蛇');
            }else if($numbers == '特后肖'){
                $arr = array('马','羊','猴','鸡','狗','猪');
            }else if($numbers == '特家肖'){
                $arr = array('牛','马','羊','鸡','狗','猪');
            }else if($numbers == '特野肖'){
                $arr = array('鼠','虎','兔','龙','蛇','猴');
            }
            if(array_search(getShuXiang($kjNumber),$arr)!==false){
                $returnData['win'] = 1;
                return $returnData;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case '特大尾':
        case '特小尾':
            if($kjNumber == 49){
                $returnData['win'] = 2;
                return $returnData;
            }else{
                $he = $kjNumber[1];
                $result = dxJudgment(5,$he);
                if($result == '大'){
                    $result = '特大尾';
                }else{
                    $result = '特小尾';
                }
                if($result == $numbers){
                    $returnData['win'] = 1;
                    return $returnData;
                }else{
                    $returnData['win'] = 0;
                    return $returnData;
                }
            }
            break;
        case '特大单':
        case '特大双':
        case '特小单':
        case '特小双':
            if($kjNumber == 49){
                $returnData['win'] = 2;
                return $returnData;
            }else{
                if($numbers == '特大单'){
                    $arr = array('25','27','29','31','33','35','37','39','41','43','45','47');
                }else if($numbers == '特大双'){
                    $arr = array('26','28','30','32','34','36','38','40','42','44','46','48');
                }else if($numbers == '特小单'){
                    $arr = array('01','03','05','07','09','11','13','15','17','19','21','23');
                }else if($numbers == '特小双'){
                    $arr = array('02','04','06','08','10','12','14','16','18','20','22','24');
                }
                if(array_search($kjNumber,$arr)!==false){
                    $returnData['win'] = 1;
                    return $returnData;
                }
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case '总和单':
        case '总和双':
            $result = dsJudgment($sunNum);
            if($result == '单'){
                $result = '总和单';
            }else{
                $result = '总和双';
            }
            if($numbers == $result){
                $returnData['win'] = 1;
                return $returnData;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        default:
            $result = dxJudgment(175,$sunNum);
            if($result == '大'){
                $result = '总和大';
            }else{
                $result = '总和小';
            }
            if($numbers == $result){
                $returnData['win'] = 1;
                return $returnData;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
    }
}
function xglhcSb($numbers,$kjNumber){
    $kjNumber = $kjNumber[6];
    switch($numbers){
        case '红波':
            $arr = array('01','02','07','08','12','13','18','19','23','24','29','30','34','35','40','45','46');//红
            break;
        case '蓝波':
            $arr = array('03','04','09','10','14','15','20','25','26','31','36','37','41','42','47','48');//蓝
            break;
        case '绿波':
            $arr = array('05','06','11','16','17','21','22','27','28','32','33','38','39','43','44','49');//绿
            break;
        case '红单':
            $arr = array('01','07','13','19','23','29','35','45');//红
            break;
        case '红双':
            $arr = array('02','08','12','18','24','30','34','40','46');//红
            break;
        case '红大':
            $arr = array('29','30','34','35','40','45','46');//红
            break;
        case '红小':
            $arr = array('01','02','07','08','12','13','18','19','23','24');//红
            break;
        case '蓝单':
            $arr = array('03','09','15','25','31','37','41','47');//蓝
            break;
        case '蓝双':
            $arr = array('04','10','14','20','26','36','42','48');//蓝
            break;
        case '蓝大':
            $arr = array('25','26','31','36','37','41','42','47','48');//蓝
            break;
        case '蓝小':
            $arr = array('03','04','09','10','14','15','20');//蓝
            break;
        case '绿单':
            $arr = array('05','11','17','21','27','33','39','43','49');//绿
            break;
        case '绿双':
            $arr = array('06','16','22','28','32','38','44');//绿
            break;
        case '绿大':
            $arr = array('27','28','32','33','38','39','43','44','49');//绿
            break;
        case '绿小':
            $arr = array('05','06','11','16','17','21','22');//绿
            break;
        case '红大单':
            $arr = array('29','35','45');//红
            break;
        case '红大双':
            $arr = array('30','34','40','46');//红
            break;
        case '红小单':
            $arr = array('01','07','13','19','23');//红
            break;
        case '红小双':
            $arr = array('02','08','12','18','24');//红
            break;
        case '蓝大单':
            $arr = array('25','31','37','41','47');//蓝
            break;
        case '蓝大双':
            $arr = array('26','36','42','48');//蓝
            break;
        case '蓝小单':
            $arr = array('03','09','15');//蓝
            break;
        case '蓝小双':
            $arr = array('04','10','14','20');//蓝
            break;
        case '绿大单':
            $arr = array('27','33','39','43','49');//绿
            break;
        case '绿大双':
            $arr = array('28','32','38','44');//绿
            break;
        case '绿小单':
            $arr = array('05','11','17','21');//绿
            break;
        case '绿小双':
            $arr = array('06','16','22');//绿
            break;

    }
    if($numbers != '红波' && $numbers != '蓝波' && $numbers != '绿波'){
        if($kjNumber == 49){
            $returnData['win'] = 2;
            return $returnData;
        }
    }
    if(array_search($kjNumber,$arr)!==false){
        $returnData['win'] = 1;
        return $returnData;
    }else{
        $returnData['win'] = 0;
        return $returnData;
    }
}
function xglhcSx($numbers,$kjNumber){
    switch ($numbers){
        case '鼠':
            $arr = array('11','23','35','47');
            break;
        case '马':
            $arr = array('05','17','29','41');
            break;
        case '牛':
            $arr = array('10','22','34','46');
            break;
        case '羊':
            $arr = array('04','16','28','40');
            break;
        case '虎':
            $arr = array('09','21','33','45');
            break;
        case '猴':
            $arr = array('03','15','27','39');
            break;
        case '兔':
            $arr = array('08','20','32','44');
            break;
        case '鸡':
            $arr = array('02','14','26','38');
            break;
        case '龙':
            $arr = array('07','19','31','43');
            break;
        case '狗':
            $arr = array('01','13','25','37','49');
            break;
        case '蛇':
            $arr = array('06','18','30','42');
            break;
        case '猪':
            $arr = array('12','24','36','48');
            break;
    }
    if(array_search($kjNumber,$arr)!==false){
        return true;
    }else{
        return false;
    }
}
function xglhcTmtws($numbers,$kjNumber){
    $kjNumber = $kjNumber[6];
    switch ($numbers){
        case '0头':
            if($kjNumber[0] == 0){
                $returnData['win'] = 1;
                return $returnData;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case '1头':
            if($kjNumber[0] == 1){
                $returnData['win'] = 1;
                return $returnData;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case '2头':
            if($kjNumber[0] == 2){
                $returnData['win'] = 1;
                return $returnData;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case '3头':
            if($kjNumber[0] == 3){
                $returnData['win'] = 1;
                return $returnData;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case '4头':
            if($kjNumber[0] == 4){
                $returnData['win'] = 1;
                return $returnData;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case '1尾':
            if($kjNumber[1] == 1){
                $returnData['win'] = 1;
                return $returnData;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case '2尾':
            if($kjNumber[1] == 2){
                $returnData['win'] = 1;
                return $returnData;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case '3尾':
            if($kjNumber[1] == 3){
                $returnData['win'] = 1;
                return $returnData;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case '4尾':
            if($kjNumber[1] == 4){
                $returnData['win'] = 1;
                return $returnData;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case '5尾':
            if($kjNumber[1] == 5){
                $returnData['win'] = 1;
                return $returnData;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case '6尾':
            if($kjNumber[1] == 6){
                $returnData['win'] = 1;
                return $returnData;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case '7尾':
            if($kjNumber[1] == 7){
                $returnData['win'] = 1;
                return $returnData;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case '8尾':
            if($kjNumber[1] == 8){
                $returnData['win'] = 1;
                return $returnData;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case '9尾':
            if($kjNumber[1] == 9){
                $returnData['win'] = 1;
                return $returnData;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case '0尾':
            if($kjNumber[1] == 0){
                $returnData['win'] = 1;
                return $returnData;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
    }
}
function xglhcZm($numbers,$kjNumber){
    switch ($numbers){
        case '总大':
            $sumNum = array_sum($kjNumber);
            if($sumNum>=175){
                $returnData['win'] = 1;
                return $returnData;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case '总小':
            $sumNum = array_sum($kjNumber);
            if($sumNum<=174){
                $returnData['win'] = 1;
                return $returnData;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case '总单':
            $sumNum = array_sum($kjNumber);
            if(dsJudgment($sumNum)=='单'){
                $returnData['win'] = 1;
                return $returnData;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case '总双':
            $sumNum = array_sum($kjNumber);
            if(dsJudgment($sumNum)=='双'){
                $returnData['win'] = 1;
                return $returnData;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        default:
            array_pop($kjNumber);
            if(array_search($numbers,$kjNumber)){
                $returnData['win'] = 1;
                return $returnData;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
    }
}
function xglhcZmt($numbers,$kjNumber,$type){
    switch ($type){
        case 3://正一特
            $kjNumber = $kjNumber[0];
            break;
        case 4://正二特
            $kjNumber = $kjNumber[1];
            break;
        case 5://正三特
            $kjNumber = $kjNumber[2];
            break;
        case 6://正四特
            $kjNumber = $kjNumber[3];
            break;
        case 7://正五特
            $kjNumber = $kjNumber[4];
            break;
        case 8://正六特
            $kjNumber = $kjNumber[5];
            break;
    }
    switch ($numbers){
        case  '单':
            if($kjNumber == 49){
                $returnData['win'] = 2;
                return $returnData;
            }else {
                if (dsJudgment($kjNumber) == '单') {
                    $returnData['win'] = 1;
                    return $returnData;
                } else {
                    $returnData['win'] = 0;
                    return $returnData;
                }
            }
            break;
        case  '双':
            if($kjNumber == 49){
                $returnData['win'] = 2;
                return $returnData;
            }else {
                if (dsJudgment($kjNumber) == '双') {
                    $returnData['win'] = 1;
                    return $returnData;
                } else {
                    $returnData['win'] = 0;
                    return $returnData;
                }
            }
            break;
        case  '大':
            if($kjNumber == 49){
                $returnData['win'] = 2;
                return $returnData;
            }else {
                if ($kjNumber >= 25) {
                    $returnData['win'] = 1;
                    return $returnData;
                } else {
                    $returnData['win'] = 0;
                    return $returnData;
                }
            }
            break;
        case  '小':
            if($kjNumber == 49){
                $returnData['win'] = 2;
                return $returnData;
            }else {
                if ($kjNumber <= 24) {
                    $returnData['win'] = 1;
                    return $returnData;
                } else {
                    $returnData['win'] = 0;
                    return $returnData;
                }
            }
            break;
        case  '红':
            $arr = array('01','02','07','08','12','13','18','19','23','24','29','30','34','35','40','45','46');//红
            if(array_search($kjNumber,$arr)!==false){
                $returnData['win'] = 1;
                return $returnData;
            } else {
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case  '蓝':
            $arr = array('03','04','09','10','14','15','20','25','26','31','36','37','41','42','47','48');//蓝
            if(array_search($kjNumber,$arr)!==false){
                $returnData['win'] = 1;
                return $returnData;
            } else {
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case  '绿':
            $arr = array('05','06','11','16','17','21','22','27','28','32','33','38','39','43','44','49');//绿
            if(array_search($kjNumber,$arr)!==false){
                $returnData['win'] = 1;
                return $returnData;
            } else {
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case  '和大':
            if($kjNumber == 49){
                $returnData['win'] = 2;
                return $returnData;
            }else {
                $sum = $kjNumber[0]+$kjNumber[1];
                if ($sum >6) {
                    $returnData['win'] = 1;
                    return $returnData;
                } else {
                    $returnData['win'] = 0;
                    return $returnData;
                }
            }
            break;
        case  '和小':
            if($kjNumber == 49){
                $returnData['win'] = 2;
                return $returnData;
            }else {
                $sum = $kjNumber[0] + $kjNumber[1];
                if ($sum <= 6) {
                    $returnData['win'] = 1;
                    return $returnData;
                } else {
                    $returnData['win'] = 0;
                    return $returnData;
                }
            }
            break;
        case  '和单':
            if($kjNumber == 49){
                $returnData['win'] = 2;
                return $returnData;
            }else {
                if (dsJudgment($kjNumber[0] + $kjNumber[1]) == '单') {
                    $returnData['win'] = 1;
                    return $returnData;
                } else {
                    $returnData['win'] = 0;
                    return $returnData;
                }
            }
            break;
        case  '和双':
            if($kjNumber == 49){
                $returnData['win'] = 2;
                return $returnData;
            }else {
                if (dsJudgment($kjNumber[0] + $kjNumber[1]) == '双') {
                    $returnData['win'] = 1;
                    return $returnData;
                } else {
                    $returnData['win'] = 0;
                    return $returnData;
                }
            }
            break;
        default:
            if($numbers == $kjNumber){
                $returnData['win'] = 1;
                return $returnData;
            } else {
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
    }

}
function xglhcZmnum($numbers,$kjNumber,$type){
    switch ($type){
        case 13://正一
            $kjNumber = $kjNumber[0];
            break;
        case 14://正二
            $kjNumber = $kjNumber[1];
            break;
        case 15://正三
            $kjNumber = $kjNumber[2];
            break;
        case 16://正四
            $kjNumber = $kjNumber[3];
            break;
        case 17://正五
            $kjNumber = $kjNumber[4];
            break;
        case 18://正六
            $kjNumber = $kjNumber[5];
            break;
    }
    switch ($numbers){
        case '单码':
            if($kjNumber == 49){
                $returnData['win'] = 2;
                return $returnData;
            }else {
                if (dsJudgment($kjNumber) == '单') {
                    $returnData['win'] = 1;
                    return $returnData;
                } else {
                    $returnData['win'] = 0;
                    return $returnData;
                }
            }
            break;
        case '双码':
            if($kjNumber == 49){
                $returnData['win'] = 2;
                return $returnData;
            }else {
                if (dsJudgment($kjNumber) == '双') {
                    $returnData['win'] = 1;
                    return $returnData;
                } else {
                    $returnData['win'] = 0;
                    return $returnData;
                }
            }
            break;
        case '大码':
            if($kjNumber == 49){
                $returnData['win'] = 2;
                return $returnData;
            }else {
                if ($kjNumber >= 25) {
                    $returnData['win'] = 1;
                    return $returnData;
                } else {
                    $returnData['win'] = 0;
                    return $returnData;
                }
            }
            break;
        case '小码':
            if($kjNumber == 49){
                $returnData['win'] = 2;
                return $returnData;
            }else {
                if ($kjNumber <= 24) {
                    $returnData['win'] = 1;
                    return $returnData;
                } else {
                    $returnData['win'] = 0;
                    return $returnData;
                }
            }
            break;
        case '合单':
            if(dsJudgment($kjNumber[0]+$kjNumber[1])=='单'){
                $returnData['win'] = 1;
                return $returnData;
            } else {
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case '合双':
            if(dsJudgment($kjNumber[0]+$kjNumber[1])=='双'){
                $returnData['win'] = 1;
                return $returnData;
            } else {
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case '合大':
            if($kjNumber == 49){
                $returnData['win'] = 2;
                return $returnData;
            }else {
                if ($kjNumber[0] + $kjNumber[1] >= 7) {
                    $returnData['win'] = 1;
                    return $returnData;
                } else {
                    $returnData['win'] = 0;
                    return $returnData;
                }
            }
            break;
        case '合小':
            if($kjNumber == 49){
                $returnData['win'] = 2;
                return $returnData;
            }else {
                if ($kjNumber[0] + $kjNumber[1] <= 6) {
                    $returnData['win'] = 1;
                    return $returnData;
                } else {
                    $returnData['win'] = 0;
                    return $returnData;
                }
            }
            break;
        case '红波':
            $arr = array('01','02','07','08','12','13','18','19','23','24','29','30','34','35','40','45','46');//红
            if(array_search($kjNumber,$arr)!==false){
                $returnData['win'] = 1;
                return $returnData;
            } else {
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case '绿波':
            $arr = array('05','06','11','16','17','21','22','27','28','32','33','38','39','43','44','49');//绿
            if(array_search($kjNumber,$arr)!==false){
                $returnData['win'] = 1;
                return $returnData;
            } else {
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case '尾大':
            if($kjNumber == 49){
                $returnData['win'] = 2;
                return $returnData;
            }else {
                if ($kjNumber[1] >= 5) {
                    $returnData['win'] = 1;
                    return $returnData;
                } else {
                    $returnData['win'] = 0;
                    return $returnData;
                }
            }
            break;
        case '尾小':
            if($kjNumber == 49){
                $returnData['win'] = 2;
                return $returnData;
            }else {
                if ($kjNumber[1] <= 4) {
                    $returnData['win'] = 1;
                    return $returnData;
                } else {
                    $returnData['win'] = 0;
                    return $returnData;
                }
            }
            break;
    }
}
function xglhcWx($numbers,$kjNumber){
    switch ($numbers){
        case '金':
            $arr = array('01','02','15','16','23','24','31','32','45','46');

            break;
        case '木':
            $arr = array('05','06','13','14','27','28','35','36','43','44');
            break;
        case '水':
            $arr = array('03','04','11','12','19','20','33','34','41','42','49');
            break;
        case '火':
            $arr = array('07','08','21','22','29','30','37','38');
            break;
        case '土':
            $arr = array('09','10','17','18','25','26','39','40','47','48');
            break;
    }
    if(array_search($kjNumber,$arr)!==false){
        $returnData['win'] = 1;
        return $returnData;
    } else {
        $returnData['win'] = 0;
        return $returnData;
    }
}
function xglhcPtyxws($numbers,$kjNumber){
    switch ($numbers){
        case '鼠':
            $arr = array('11','23','35','47');
            break;
        case '马':
            $arr = array('05','17','29','41');
            break;
        case '牛':
            $arr = array('10','22','34','46');
            break;
        case '羊':
            $arr = array('04','16','28','40');
            break;
        case '虎':
            $arr = array('09','21','33','45');
            break;
        case '猴':
            $arr = array('03','15','27','39');
            break;
        case '兔':
            $arr = array('08','20','32','44');
            break;
        case '鸡':
            $arr = array('02','14','26','38');
            break;
        case '龙':
            $arr = array('07','19','31','43');
            break;
        case '狗':
            $arr = array('01','13','25','37','49');
            break;
        case '蛇':
            $arr = array('06','18','30','42');
            break;
        case '猪':
            $arr = array('12','24','36','48');
            break;
        case '0尾':
            $arr = array('10','20','30','40');
            break;
        case '1尾':
            $arr = array('01','11','21','31','41');
            break;
        case '2尾':
            $arr = array('02','12','22','32','42');
            break;
        case '3尾':
            $arr = array('03','13','23','33','43');
            break;
        case '4尾':
            $arr = array('04','14','24','34','44');
            break;
        case '5尾':
            $arr = array('05','15','25','35','45');
            break;
        case '6尾':
            $arr = array('06','16','26','36','46');
            break;
        case '7尾':
            $arr = array('07','17','27','37','47');
            break;
        case '8尾':
            $arr = array('08','18','28','38','48');
            break;
        case '9尾':
            $arr = array('09','19','29','39','49');
            break;
    }
    if(array_intersect($arr,$kjNumber)){
        $returnData['win'] = 1;
        return $returnData;
    } else {
        $returnData['win'] = 0;
        return $returnData;
    }
}
function xglhcZx($numbers,$kjNumber,$odds){
    switch ($numbers) {
        case '鼠':
            $arr = array('11', '23', '35', '47');
            break;
        case '马':
            $arr = array('05', '17', '29', '41');
            break;
        case '牛':
            $arr = array('10', '22', '34', '46');
            break;
        case '羊':
            $arr = array('04', '16', '28', '40');
            break;
        case '虎':
            $arr = array('09', '21', '33', '45');
            break;
        case '猴':
            $arr = array('03', '15', '27', '39');
            break;
        case '兔':
            $arr = array('08', '20', '32', '44');
            break;
        case '鸡':
            $arr = array('02', '14', '26', '38');
            break;
        case '龙':
            $arr = array('07', '19', '31', '43');
            break;
        case '狗':
            $arr = array('01', '13', '25', '37', '49');
            break;
        case '蛇':
            $arr = array('06', '18', '30', '42');
            break;
        case '猪':
            $arr = array('12', '24', '36', '48');
            break;
    }
    $a = array_intersect($kjNumber,$arr);
    if(count($a)>0){
        $returnData['win'] = 1;
        $returnData['odds'] = bcadd(1,bcmul(bcsub($odds,1,3),count($a),3),3);
        return $returnData;
    } else {
        $returnData['win'] = 0;
        return $returnData;
    }
}
function xglhcQsb($numbers,$kjNumber){
    $arr = array('01'=>'红波','02'=>'红波','07'=>'红波','08'=>'红波','12'=>'红波','13'=>'红波','18'=>'红波','19'=>'红波','23'=>'红波','24'=>'红波','29'=>'红波','30'=>'红波','34'=>'红波','35'=>'红波','40'=>'红波','45'=>'红波','46'=>'红波','03'=>'蓝波','04'=>'蓝波','09'=>'蓝波','10'=>'蓝波','14'=>'蓝波','15'=>'蓝波','20'=>'蓝波','25'=>'蓝波','26'=>'蓝波','31'=>'蓝波','36'=>'蓝波','37'=>'蓝波','41'=>'蓝波','42'=>'蓝波','47'=>'蓝波','48'=>'蓝波','05'=>'绿波','06'=>'绿波','11'=>'绿波','16'=>'绿波','17'=>'绿波','21'=>'绿波','22'=>'绿波','27'=>'绿波','28'=>'绿波','32'=>'绿波','33'=>'绿波','38'=>'绿波','39'=>'绿波','43'=>'绿波','44'=>'绿波','49'=>'绿波');//红
    $res = array();
    $res[0] = 0;
    $res[1] = 0;
    $res[2] = 0;
    for($i=0;$i<7;$i++){
        if($arr[$kjNumber[$i]]=='红波'){
            if($i == 6){
                $res[0] = $res[0]*1 + 1.5;
            }else{
                $res[0] ++;
            }
        }else if($arr[$kjNumber[$i]]=='蓝波'){
            if($i == 6){
                $res[1] = $res[1]*1 + 1.5;
            }else{
                $res[1] ++;
            }
        }else{
            if($i == 6){
                $res[2] = $res[2]*1 + 1.5;
            }else{
                $res[2] ++;
            }
        }
    }
    $result =  '和局';
    if($res[0] > $res[1] && $res[0] > $res[2]){
        $result =  '红波';
    }
    if($res[1] > $res[0] && $res[1] > $res[2]){
        $result =  '蓝波';
    }
    if($res[2] > $res[0] && $res[2] > $res[1]){
        $result =  '绿波';
    }
    switch ($numbers){
        case '红波':
        case '蓝波':
        case '绿波':
            if($result == '和局'){
                $returnData['win'] = 2;
                return $returnData;
            }else{
                if($numbers == $result){
                    $returnData['win'] = 1;
                    return $returnData;
                }else{
                    $returnData['win'] = 0;
                    return $returnData;
                }
            }
            break;
        case '和局':
            if($numbers == $result){
                $returnData['win'] = 1;
                return $returnData;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
    }
}
function xglhcZongx($numbers,$kjNumber){
    $arr = array('11'=>'鼠', '23'=>'鼠', '35'=>'鼠', '47'=>'鼠','05'=>'马', '17'=>'马', '29'=>'马', '41'=>'马','10'=>'牛', '22'=>'牛', '34'=>'牛', '46'=>'牛','04'=>'羊', '16'=>'羊', '28'=>'羊', '40'=>'羊','09'=>'虎', '21'=>'虎', '33'=>'虎', '45'=>'虎','03'=>'猴', '15'=>'猴', '27'=>'猴', '39'=>'猴','08'=>'兔', '20'=>'兔', '32'=>'兔', '44'=>'兔','02'=>'鸡', '14'=>'鸡', '26'=>'鸡', '38'=>'鸡','07'=>'龙', '19'=>'龙', '31'=>'龙', '43'=>'龙','01'=>'狗', '13'=>'狗', '25'=>'狗', '37'=>'狗', '49'=>'狗','06'=>'蛇', '18'=>'蛇', '30'=>'蛇', '42'=>'蛇','12'=>'猪', '24'=>'猪', '36'=>'猪', '48'=>'猪');
    $newArr = array();
    foreach ($kjNumber as $k=>$v){
       if(array_search($arr[$v],$newArr)!==false){
           $newArr[] = $v;
       }
    }
    $count = count($newArr);
    switch ($numbers){
        case '2肖':
            if($count == 2){
                $returnData['win'] = 1;
                return $returnData;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case '3肖':
            if($count == 3){
                $returnData['win'] = 1;
                return $returnData;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case '4肖':
            if($count == 4){
                $returnData['win'] = 1;
                return $returnData;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case '5肖':
            if($count == 5){
                $returnData['win'] = 1;
                return $returnData;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case '6肖':
            if($count == 6){
                $returnData['win'] = 1;
                return $returnData;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case '7肖':
            if($count == 7){
                $returnData['win'] = 1;
                return $returnData;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case '总肖单':
            if(dsJudgment($count) == '单'){
                $returnData['win'] = 1;
                return $returnData;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
        case '总肖双':
            if(dsJudgment($count) == '双'){
                $returnData['win'] = 1;
                return $returnData;
            }else{
                $returnData['win'] = 0;
                return $returnData;
            }
            break;
    }
}
function open_xuxiang($kjNumber){
    $arr = array('11'=>'鼠', '23'=>'鼠', '35'=>'鼠', '47'=>'鼠','05'=>'马', '17'=>'马', '29'=>'马', '41'=>'马','10'=>'牛', '22'=>'牛', '34'=>'牛', '46'=>'牛','04'=>'羊', '16'=>'羊', '28'=>'羊', '40'=>'羊','09'=>'虎', '21'=>'虎', '33'=>'虎', '45'=>'虎','03'=>'猴', '15'=>'猴', '27'=>'猴', '39'=>'猴','08'=>'兔', '20'=>'兔', '32'=>'兔', '44'=>'兔','02'=>'鸡', '14'=>'鸡', '26'=>'鸡', '38'=>'鸡','07'=>'龙', '19'=>'龙', '31'=>'龙', '43'=>'龙','01'=>'狗', '13'=>'狗', '25'=>'狗', '37'=>'狗', '49'=>'狗','06'=>'蛇', '18'=>'蛇', '30'=>'蛇', '42'=>'蛇','12'=>'猪', '24'=>'猪', '36'=>'猪', '48'=>'猪');
    $newArr=array();
    foreach ($kjNumber as $k=>$v){
        if(array_search($arr[$v],$newArr)===false){
            $newArr[]=$arr[$v];
        }
    }
    return $newArr;
}
function open_wei($kjNumber){
    $re=array();
    foreach ($kjNumber as $k => $v) {
        if(in_array($v,array('10','20','30','40'))){
            $re[] = '0尾';
        }
        if(in_array($v, array('01','11','21','31','41'))){
            $re[] = '1尾';
        }
        if(in_array($v, array('02','12','22','32','42'))){
            $re[] = '2尾';
        }
        if(in_array($v, array('03','13','23','33','43'))){
            $re[] = '3尾';
        }
        if(in_array($v, array('04','14','24','34','44'))){
            $re[] = '4尾';
        }
        if(in_array($v, array('05','15','25','35','45'))){
            $re[] = '5尾';
        }
        if(in_array($v, array('06','16','26','36','46'))){
            $re[] = '6尾';
        }
        if(in_array($v, array('07','17','27','37','47'))){
            $re[] = '7尾';
        }
        if(in_array($v, array('08','18','28','38','48'))){
            $re[] = '8尾';
        }
        if(in_array($v, array('09','19','29','39','49'))){
            $re[] = '9尾';
        }
    }
    return $re;
}
function xglhcElxz($numbers,$kjNumber,$num){
    $newArr = open_xuxiang($kjNumber);
    $number_arr =explode(',',$numbers);
    $re=[];
    foreach ($number_arr as $k => $v){
        if(in_array($v,$newArr)){
            $re[]= $v;
        }
    }
    if(count($re)==$num){
        $returnData['win']=1;
    }else{
        $returnData['win']=0;
    }
    return $returnData;
}
function xglhcWlz($numbers,$kjNumber,$num){
    $newArr = open_wei($kjNumber);
    $number_arr =explode(',',$numbers);
    foreach ($number_arr as $k => $v) {
        if(in_array($v,$newArr)){
            $re[]= $v;
        }
    }
    if(count($re)==$num){
        $returnData['win']=1;
    }else{
        $returnData['win']=0;
    }
    return $returnData;
}
function xglhcZxbz($numbers,$kjNumber,$num){
    $number_arr =explode(',',$numbers);
    $re=[];
    foreach ($number_arr as $k => $v) {
        if(!in_array($v,$kjNumber)){
            $re[]= $v;
        }
    }
    if(count($re)==$num){
        $returnData['win']=1;
    }else{
        $returnData['win']=0;
    }
    return $returnData;
}
function xglhcHxz($numbers,$kjNumber){
    $number = explode(',',$numbers);
    $kjNumber = $kjNumber[6];
    if($kjNumber=='49'){
        $returnData['win']=2;
    }else{
        $arr = array('11'=>'鼠', '23'=>'鼠', '35'=>'鼠', '47'=>'鼠','05'=>'马', '17'=>'马', '29'=>'马', '41'=>'马','10'=>'牛', '22'=>'牛', '34'=>'牛', '46'=>'牛','04'=>'羊', '16'=>'羊', '28'=>'羊', '40'=>'羊','09'=>'虎', '21'=>'虎', '33'=>'虎', '45'=>'虎','03'=>'猴', '15'=>'猴', '27'=>'猴', '39'=>'猴','08'=>'兔', '20'=>'兔', '32'=>'兔', '44'=>'兔','02'=>'鸡', '14'=>'鸡', '26'=>'鸡', '38'=>'鸡','07'=>'龙', '19'=>'龙', '31'=>'龙', '43'=>'龙','01'=>'狗', '13'=>'狗', '25'=>'狗', '37'=>'狗', '49'=>'狗','06'=>'蛇', '18'=>'蛇', '30'=>'蛇', '42'=>'蛇','12'=>'猪', '24'=>'猪', '36'=>'猪', '48'=>'猪');
        $result = $arr[$kjNumber];
        if(in_array($result,$number)){
            $returnData['win']=1;
        }else{
            $returnData['win']=0;
        }
    }
    return $returnData;
}
function xglhcLmsqz($numbers,$kjNumber){
    array_pop($kjNumber);//取开奖正码
    $number_arr = explode(',',$numbers);
    $re=[];
    foreach ($number_arr as $k => $v) {
        if(in_array($v, $kjNumber)){
            $re[]=$v;
        }
    }
    if(count($re)==3){
        $returnData['win']=1;
    }else{
        $returnData['win'] = 0;
    }
    return $returnData;
}
function xglhcLmsze($numbers,$kjNumber,$odds){
    array_pop($kjNumber);//取开奖正码
    $number_arr = explode(',',$numbers);
    $odds_arr = explode('/', $odds);
    $re=[];
    foreach ($number_arr as $k => $v) {
        if(in_array($v, $kjNumber)){
            $re[]=$v;
        }
    }
    if(count($re)==2){
        $returnData['win']=1;
        $returnData['odds'] =$odds_arr[0];
    }elseif (count($re)==3) {
        $returnData['win']=1;
        $returnData['odds'] =$odds_arr[1];
    }else{
        $returnData['win'] = 0;
    }
    return $returnData;
}
function xglhcLmeqz($numbers,$kjNumber){
    array_pop($kjNumber);//取开奖正码
    $number_arr = explode(',',$numbers);
    $re=[];
    foreach ($number_arr as $k => $v) {
        if(in_array($v, $kjNumber)){
            $re[]=$v;
        }
    }
    if(count($re)==2){
        $returnData['win']=1;
    }else{
        $returnData['win'] = 0;
    }
    return $returnData;
}
function xglhcLmezt($numbers,$kjNumber,$odds){
    $number_arr = explode(',',$numbers);
    $odds_arr = explode('/', $odds);
    $re=[];
    foreach ($number_arr as $k => $v) {
        if(in_array($v, $kjNumber)){
            $re[]=$v;
        }
        if($v==$kjNumber[6]){
            $re1[]=$v;
        }
    }
    if(count($re)==2 && count($re1)==1){
        $returnData['win']=1;
        $returnData['odds'] =$odds_arr[1];
    }elseif (count($re)==2 && count($re1)==0) {
        $returnData['win']=1;
        $returnData['odds'] =$odds_arr[0];
    }else{
        $returnData['win']=0;
    }
    return $returnData;
}
function xglhcLmtc($numbers,$kjNumber){
    $kjNumber1=$kjNumber;
    $number_arr = explode(',',$numbers);
    $re=[];
    $re1=[];
    array_pop($kjNumber1);
    foreach ($number_arr as $k => $v) {
        if(in_array($v,$kjNumber1 )){
            $re[]=$v;
        }
        if($v==$kjNumber[6]){
            $re1[]=$v;
        }
    }
    if(count($re)==1 && count($re1)==1){
        $returnData['win']=1;
    }else{
        $returnData['win']=0;
    }
    return $returnData;
}
function setBolls($num){
    $arr1 = array('01','02','07','08','12','13','18','19','23','24','29','30','34','35','40','45','46');//红
    $arr2 = array('03','04','09','10','14','15','20','25','26','31','36','37','41','42','47','48');//蓝
    $arr3 = array('05','06','11','16','17','21','22','27','28','32','33','38','39','43','44','49');//绿
    if(in_array($num,$arr1)){
        return 'bg_red';
    }elseif (in_array($num,$arr2)){
        return 'bg_blue';
    }elseif (in_array($num,$arr3)){
        return 'bg_green';
    }
}
/*------------香港六合彩end------------------*/