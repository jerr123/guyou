<?php
/**
 * 自己集成的云通讯封装类
 */
class YunSms {
	/**
	 * [$accountSid 主账号]
	 * @var string
	 */
	private $accountSid = '';
	/**
	 * [$accountToken 主账号令牌]
	 * @var string
	 */
	private $accountToken = '';
	private $appId = '';
	private $serverIP='app.cloopen.com';
	//请求端口，生产环境和沙盒环境一致
	private$serverPort='8883';

	//REST版本号，在官网文档REST介绍中获得。
	public $softVersion='2013-12-26';
	/**
	 * 
	 */
	public function __construct(){
		include_once(dirname(__FILE__).'/YunSms/yun_config.php');
		//echo dirname(__FILE__).'/YunSms/yun_config.php';
		$this->accountSid = $accountSid;
		$this->accountToken = $accountToken;
		$this->appId = $appId;
		$this->serverIP = $serverIP;
		$this->serverPort = $serverPort;
		$this->softVersion = $softVersion;
		include_once(dirname(__FILE__).'/YunSms/CCPRestSmsSDK.php');
	}

	/**
	 * 发送模板短信
	 */
	public function sendTemplateSMS ($to,$datas,$tempId) {
		// 初始化REST SDK
		//global $accountSid,$accountToken,$appId,$serverIP,$serverPort,$softVersion;
		$rest = new REST($this->serverIP,$this->serverPort,$this->softVersion);
		$rest->setAccount($this->accountSid,$this->accountToken);
		$rest->setAppId($this->appId);
		$result = $rest->sendTemplateSMS($to,$datas,$tempId);
		//var_dump($result);
		if ($result){
			if ($result->statusCode!=0) {
				$rd['status'] = -9;
				//print_r($result->statusMsg);
				$err = $result->statusMsg;
				$rd['errmsg'] = $err;
			}else{
				$rd = true;
			}
		}else{
			$rd['status'] = -8;
			$rd['errmsg'] = 'result error';
		}
		return $rd;
	}

	/**
	 * 发送验证码
	 */
	//public function sendVerify ($to, $)

	/**
	 * 生成验证码
	 */
	public function createCode ($length = 6) {
		for ($i = 0; $i < $length; $i++) { 
			$code .= rand(0, 9); 
		}
		return $code;
	}
}
?>