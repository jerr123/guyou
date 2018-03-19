<?php
/**
 * 支付宝快捷支付引入核心文件
 */
class Alipay {
	/**
	 * CI 
	 * @var [type]
	 */
	public $CI;
	/**
	 * 支付宝快捷支付配置信息
	 * @var array
	 */
	private $alipay_config = array();
	/**
	 * 构造函数
	 * function 
	 * @author yzk <2273716951@qq.com>
	 * @version  [version]
	 * @dateTime 2016-09-02T11:57:23+0800
	 */
	public function __construct(){
		$this->CI = & get_instance();
		//加载核心配置文件
		include_once(APPPATH.'libraries'.DIRECTORY_SEPARATOR.'Alipay'.DIRECTORY_SEPARATOR.'alipay_config.php');
		//加载核心文件
		include_once(dirname(__FILE__).'/Alipay/alipay_core.function.php');
		include_once(dirname(__FILE__).'/Alipay/alipay_md5.function.php');
		include_once(dirname(__FILE__).'/Alipay/alipay_notify.class.php');
		include_once(dirname(__FILE__).'/Alipay/alipay_submit.class.php');
		$this->alipay_config = $alipay_config;
	}

	/**
	 * 快捷支付
	 * @param Array $data 快捷支付用的订单信息
	 *        out_trade_no 订单编号
	 *        subject 订单名称
	 *        total_fee 金额
	 *        body 描述
	 */
	public function quickPay ($data = array('subject'=>'菇友网钻石充值','body'=>'菇友网钻石充值')) {
		$alipay_config = $this->alipay_config;
		/**************************请求参数**************************/
        //商户订单号，商户网站订单系统中唯一订单号，必填
		$out_trade_no = $data['out_trade_no'];

        //订单名称，必填
		$subject = $data['subject'];

        //付款金额，必填
		$total_fee = $data['total_fee'];

        //商品描述，可空
		$body = $data['body'];

		/************************************************************/

		//构造要请求的参数数组，无需改动
		$parameter = array(
			"service"       => $alipay_config['service'],
			"partner"       => $alipay_config['partner'],
			"seller_id"  => $alipay_config['seller_id'],
			"payment_type"	=> $alipay_config['payment_type'],
			"notify_url"	=> $alipay_config['notify_url'],
			"return_url"	=> $alipay_config['return_url'],

			"anti_phishing_key"=>$alipay_config['anti_phishing_key'],
			"exter_invoke_ip"=>$alipay_config['exter_invoke_ip'],
			"out_trade_no"	=> $out_trade_no,
			"subject"	=> $subject,
			"total_fee"	=> $total_fee,
			"body"	=> $body,
			"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
			//其他业务参数根据在线开发文档，添加参数.文档地址:https://doc.open.alipay.com/doc2/detail.htm?spm=a219a.7629140.0.0.kiX33I&treeId=62&articleId=103740&docType=1
        	//如"参数名"=>"参数值"
			);

		//建立请求
		$alipaySubmit = new AlipaySubmit($alipay_config);
		$html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
		//echo $html_text;

	}

	/**
	 * 支付宝页面回调验证
	 */
	public function checkReturn () {
		//计算得出通知验证结果
		$alipayNotify = new AlipayNotify($this->alipay_config);
		return $verify_result = $alipayNotify->verifyReturn();
	}

	/**
	 * 支付宝异步回调验证
	 */
	public function checkNotify () {
		//计算得出通知验证结果
		$alipayNotify = new AlipayNotify($this->alipay_config);
		return $verify_result = $alipayNotify->verifyNotify();
	}

	/**
	 * 页面回调处理
	 * return_url
	 */
	public function return_url () {
		$alipay_config = $this->alipay_config;
		//计算得出通知验证结果
		$alipayNotify = new AlipayNotify($alipay_config);
		$verify_result = $alipayNotify->verifyReturn();
		if($verify_result) {//验证成功
		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			//请在这里加上商户的业务逻辑程序代码

			//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
    		//获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

			//商户订单号

			$out_trade_no = $_GET['out_trade_no'];

			//支付宝交易号

			$trade_no = $_GET['trade_no'];

			//交易状态
			$trade_status = $_GET['trade_status'];


			if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
				//判断该笔订单是否在商户网站中已经做过处理
					//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
					//如果有做过处理，不执行商户的业务程序
			}
			else {
				echo "trade_status=".$_GET['trade_status'];
			}

			echo "验证成功<br />";

		//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——

		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		}
		else {
    		//验证失败
    		//如要调试，请看alipay_notify.php页面的verifyReturn函数
			echo "验证失败";
		}
	}


	/**
	 * 支付宝快捷支付 异步回调
	 * notify_url
	 */
	public function notify_url () {
		//计算得出通知验证结果
		$alipayNotify = new AlipayNotify($alipay_config);
		$verify_result = $alipayNotify->verifyNotify();

		if($verify_result) {//验证成功
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			//请在这里加上商户的业务逻辑程序代

	
			//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
	
    		//获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
	
			//商户订单号

			$out_trade_no = $_POST['out_trade_no'];

			//支付宝交易号

			$trade_no = $_POST['trade_no'];

			//交易状态
			$trade_status = $_POST['trade_status'];


    		if($_POST['trade_status'] == 'TRADE_FINISHED') {
				//判断该笔订单是否在商户网站中已经做过处理
					//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
					//请务必判断请求时的total_fee、seller_id与通知时获取的total_fee、seller_id为一致的
					//如果有做过处理，不执行商户的业务程序
				
				//注意：
				//退款日期超过可退款期限后（如三个月可退款），支付宝系统发送该交易状态通知

        		//调试用，写文本函数记录程序运行情况是否正常
        		//logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
    		}
    		else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
				//判断该笔订单是否在商户网站中已经做过处理
					//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
					//请务必判断请求时的total_fee、seller_id与通知时获取的total_fee、seller_id为一致的
					//如果有做过处理，不执行商户的业务程序
				
				//注意：
				//付款完成后，支付宝系统发送该交易状态通知

        		//调试用，写文本函数记录程序运行情况是否正常
        		//logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
    		}

			//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
        
			echo "success";		//请不要修改或删除
	
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		}
		else {
    		//验证失败
    		echo "fail";

    		//调试用，写文本函数记录程序运行情况是否正常
    		//logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
		}
	}
}

?>