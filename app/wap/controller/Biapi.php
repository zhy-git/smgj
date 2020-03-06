<?php

namespace app\wap\controller;

use think\Controller;

class Biapi extends Controller
{
	

    protected $key='AbH@BIUr';

    protected $WebSiteCode='c9204ead-b449-41e3-9043-038704ae9e88';

    protected $password='Zaqw1893';

    protected $biUrl = 'api.gebbs.net';

	 public function zzmoney($game,$user,$type,$money,$is_open=0)
	{
        error_reporting(0);
		$t = time();
		$str_check = "platformCode=" . $game . '&userName=' . $user .'&userPassWord='.$this->password .'&TimeStamp='.$t;
		$str_encheck = $this->encode($str_check, $this->key);
		if (!$is_open)
		{
			$url = 'http://'.$this->biUrl.'/Api/Register?parameter=' . $str_encheck . '&WebSiteCode=' . $this->WebSiteCode;
			$res = $this->https_request($url);
		}
		
        $data = "platformCode=" . $game . '&userName=' . $user . '&transferType=' . $type . '&credit=' . $money.'&TimeStamp='.$t;
        $urlen = ($this->encode($data, $this->key));
        $url = 'http://'.$this->biUrl.'/Api/Transfer?parameter=' . $urlen . '&WebSiteCode=' . $this->WebSiteCode;
		
        $res = $this->https_request($url);
        if ($res['retCode'] === 0) {
            return true;
        } else {
            return false;
        }
	}

	public function balances($game,$user)
	{
        error_reporting(0);
		$t=time();
		$pp=($this->encode('platformCode='.$game.'&userName='.$user.'&userPassWord='.$this->password.'&TimeStamp='.$t,$this->key));
		$url='http://'.$this->biUrl.'/Api/GetUserBalance?parameter='.$pp.'&WebSiteCode='.$this->WebSiteCode;
		$res=$this->https_request($url);
		return $res['retMsg'];
	}

	public function loginbi($game,$user,$gametype=null,$devices=null,$gameId = null, $gameName = null)
	{
		if ($devices == null && $this->isMobile())
			$devices = 1;
		$str = 'platformCode='.$game.'&userName='.$user.'&userPassWord='.$this->password;

		if ($gametype != null)
			$str .= '&gameType='.$gametype;

		if ($devices != 0)
			$str .= '&devices='.$devices;

		if ($gameId != null)
			$str .='&gameId='.$gameId;

		if ($gameName != null)
			$str .='&gameName='.$gameName;

		$str = $this->encode($str, $this->key);
		$url='http://'.$this->biUrl.'/Api/Login?parameter='.$str.'&WebSiteCode='.$this->WebSiteCode;
		return $url;
	}

	public function GetMerchantReport($platformCode, $StartTime, $EndTime, $TimeStamp, $PageIndex, $PageSize) {
        $Str = "platformCode=" . $platformCode . "&StartTime=" . $StartTime . "&EndTime=" . $EndTime . "&TimeStamp=" . $TimeStamp . "&PageIndex=" . $PageIndex . "&PageSize=" . $PageSize . "";
        $DesStr = ($this->encode($Str, $this->key));
		
        $url = 'http://report.gebbs.net/QueryApi/GetMerchantReport?parameter=' . $DesStr . '&WebSiteCode=' . $this->WebSiteCode; 
        $data_array = $this->https_request($url);
        return $data_array;
    }

	public function BusinessBalance(){
		$url='http://'.$this->biUrl.'/Api/BusinessBalance?WebSiteCode='.$this->WebSiteCode;
		$Business_data= $this->https_request($url);
		return $Business_data;
	}
	

	public function https_request($url,$data = null)
	{
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		

		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		

		if (!empty($data))
		{
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		}
		
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		

		$output = curl_exec($curl);

		curl_close($curl);

		$output=json_decode($output,true);

		return $output;
	}
	

	function isMobile()
	{ 

		if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
		{
			return true;
		} 

		if (isset ($_SERVER['HTTP_VIA']))
		{ 

			return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
		} 

		if (isset ($_SERVER['HTTP_USER_AGENT']))
		{
			$clientkeywords = array ('nokia',
				'sony',
				'ericsson',
				'mot',
				'samsung',
				'htc',
				'sgh',
				'lg',
				'sharp',
				'sie-',
				'philips',
				'panasonic',
				'alcatel',
				'lenovo',
				'iphone',
				'ipod',
				'blackberry',
				'meizu',
				'android',
				'netfront',
				'symbian',
				'ucweb',
				'windowsce',
				'palm',
				'operamini',
				'operamobi',
				'openwave',
				'nexusone',
				'cldc',
				'midp',
				'wap',
				'mobile'
				); 

			if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
			{
				return true;
			} 
		} 

		if (isset ($_SERVER['HTTP_ACCEPT']))
		{ 

			if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
			{
				return true;
			} 
		} 
		return false;
	}

	/**********************************/


    public function encode($str, $key) {
        $str=str_replace('+','%2b',$str);
        $size = mcrypt_get_block_size(MCRYPT_DES, MCRYPT_MODE_CBC);
        $str = $this->pkcs5Pad($str, $size);
        $aaa = mcrypt_cbc(MCRYPT_DES, $key, $str, MCRYPT_ENCRYPT, $key);
        $ret = base64_encode($aaa);
        return urlencode($ret);
    }


    public function decode($str, $key) {
        $strBin = base64_decode($str);
        $str = mcrypt_cbc(MCRYPT_DES, $key, $strBin, MCRYPT_DECRYPT, $key);
        $str = $this->pkcs5Unpad($str);
        return $str;
    }

    function hex2bin($hexData) {
        $binData = "";
        for ($i = 0; $i < strlen($hexData); $i += 2) {
            $binData .= chr(hexdec(substr($hexData, $i, 2)));
        }
        return $binData;
    }

    function pkcs5Pad($text, $blocksize) {
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }

    function pkcs5Unpad($text) {
        $pad = ord($text {strlen($text) - 1});
        if ($pad > strlen($text))
            return false;

        if (strspn($text, chr($pad), strlen($text) - $pad) != $pad)
            return false;

        return substr($text, 0, - 1 * $pad);
    }

}


?>