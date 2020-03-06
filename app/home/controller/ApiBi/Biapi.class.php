<?php

require "Des.php";	//�����ļ�


class Biapi extends JoDES{
	
    /*
	���ò���
	*/
	protected $key='AbH@BIUr';                                     //վ����Կ
	
	protected $WebSiteCode='c9204ead-b449-41e3-9043-038704ae9e88'; //վ��code
	
	protected $password='Zaqw1893'; 								//վ���û�����
	
	protected $biUrl = 'api.gebbs.net';
	// ���ת��
	 public function zzmoney($game,$user,$type,$money)          //�û����ת��  	��Ϸ��	�û���	ת��'IN'ת��'OUT'	ת�˽��
	{
		$t = time();
		$str_check = "platformCode=" . $game . '&userName=' . $user .'&userPassWord='.$this->password .'&TimeStamp='.$t;
		$str_encheck = $this->encode($str_check, $this->key);
		if ($type === 'IN')
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
	// ��ȡ���
	public function balances($game,$user)							//��Ǯ����ѯ���� ��Ϸ�� �û���  
	{
		$t=time();
		$pp=($this->encode('platformCode='.$game.'&userName='.$user.'&userPassWord='.$this->password.'&TimeStamp='.$t,$this->key));
		$url='http://'.$this->biUrl.'/Api/GetUserBalance?parameter='.$pp.'&WebSiteCode='.$this->WebSiteCode;
		$res=$this->https_request($url);
		return $res['retMsg'];
	}
	// ������Ϸ
	public function loginbi($game,$user,$gametype=null,$devices=null,$gameId = null, $gameName = null)
	{
		if ($devices == null && $this->isMobile())
			$devices = 1;
		$str = 'platformCode='.$game.'&userName='.$user.'&userPassWord='.$this->password;
		// �Ƿ�����Ϸ����
		if ($gametype != null)
			$str .= '&gameType='.$gametype;
		// �Ƿ�Ϊ�ֻ���
		if ($devices != 0)
			$str .= '&devices='.$devices;
		// �Ƿ���gameId������TTG
		if ($gameId != null)
			$str .='&gameId='.$gameId;
		// �Ƿ���gameName������TTG
		if ($gameName != null)
			$str .='&gameName='.$gameName;
		// ���ܲ���
		$str = $this->encode($str, $this->key);
		$url='http://'.$this->biUrl.'/Api/Login?parameter='.$str.'&WebSiteCode='.$this->WebSiteCode;
		return $url;
	}
	// ��ȡͶע��¼
	public function GetMerchantReport($platformCode, $StartTime, $EndTime, $TimeStamp, $PageIndex, $PageSize) {
        $Str = "platformCode=" . $platformCode . "&StartTime=" . $StartTime . "&EndTime=" . $EndTime . "&TimeStamp=" . $TimeStamp . "&PageIndex=" . $PageIndex . "&PageSize=" . $PageSize . "";
        $DesStr = ($this->encode($Str, $this->key));
		
        $url = 'http://report.gebbs.net/QueryApi/GetMerchantReport?parameter=' . $DesStr . '&WebSiteCode=' . $this->WebSiteCode; 
        $data_array = $this->https_request($url);
        return $data_array;
    }
	// ��ȡ�̻�ƽ̨���
	public function BusinessBalance(){
		$url='http://'.$this->biUrl.'/Api/BusinessBalance?WebSiteCode='.$this->WebSiteCode;
		$Business_data= $this->https_request($url);
		return $Business_data;
	}
	
	//�ӿ�������
	public function https_request($url,$data = null)
	{
		$curl = curl_init();//��������Ự
		curl_setopt($curl, CURLOPT_URL, $url);  //����ĵ�ַ
		
		//Ĭ��ִ��GET����
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);  //����ģʽΪget������
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE); //����ģʽΪget������
		
		//ִ��POST����
		if (!empty($data))
		{
			curl_setopt($curl, CURLOPT_POST, 1);   // ����POST����ʽ
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);  // ����POST����ʽ,���Ҽ���json����
		}
		
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  //ִ���Ժ󷵻��ļ���������ֱ�����
		
		//ִ������
		$output = curl_exec($curl);
		//�ر���Դ
		curl_close($curl);
		//�ɷ��ص�JSONת������
		$output=json_decode($output,true); 
		return $output;
	}
	
	/*�ƶ����ж�*/
	function isMobile()
	{ 
		// �����HTTP_X_WAP_PROFILE��һ�����ƶ��豸
		if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
		{
			return true;
		} 
		// ���via��Ϣ����wap��һ�����ƶ��豸,���ַ����̻����θ���Ϣ
		if (isset ($_SERVER['HTTP_VIA']))
		{ 
			// �Ҳ���Ϊflase,����Ϊtrue
			return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
		} 
		// �Բз����ж��ֻ����͵Ŀͻ��˱�־,�������д����
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
			// ��HTTP_USER_AGENT�в����ֻ�������Ĺؼ���
			if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
			{
				return true;
			} 
		} 
		// Э�鷨����Ϊ�п��ܲ�׼ȷ���ŵ�����ж�
		if (isset ($_SERVER['HTTP_ACCEPT']))
		{ 
			// ���ֻ֧��wml���Ҳ�֧��html��һ�����ƶ��豸
			// ���֧��wml��html����wml��html֮ǰ�����ƶ��豸
			if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
			{
				return true;
			} 
		} 
		return false;
	} 


}

?>