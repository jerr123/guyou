<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
	}

	public function index() {
		
	}

	public function register() {
		header('Content-type: text/json');
		$this->load->model('User_model', '', true);
		$rd = $this->User_model->register();

		echo json_encode($rd);
	}

	/**
	 * 登录
	 */
	public function login () {
		header('Content-type: text/json');
		$this->load->model('User_model', '', true);
		$this->User_model->login();
	}

	public function logout() {
		unset($_SESSION['USER']);
		header("Location:".site_url('Home/index'));
	}

	/**
	 * 发送找回密码验证码
	 */
	public function getForgetPassPhoneCode () {
		header("Content-type:text/json");
		$phone = $this->input->post_get('phone');
		if (isset($_SESSION['fpcode'])){
			$pcode = $this->session->pcode;
			if ( ($pcode['code_time']+60)>time()){
				die('{"status":-3,"errmsg":"发送过于频繁"}');
			}
		}
		$length = 6;
		$code = '';
		for ($i = 0; $i < $length; $i++) { 
			$code .= rand(0, 9); 
		}
		$datas = array($code,30);
		$this->load->library('YunSms');
		//$YumSms = new YunSms();
		$rs = $this->yunsms->sendTemplateSMS($phone, $datas,1);
		if ($rs===true) {
			//发送成功存入session
			$pcode['code'] = $code;
			$pcode['code_time'] = time();
			$_SESSION['fpcode'] = $pcode;
			$rd['status'] = 1;
		}else{
			$rd = $rs;
		}
		echo json_encode($rd);
	}

	public function forgetPassword() {
		$this->load->model('User_model','', true);
		$this->User_model->forgetPassword();
	}

	/**
	 * 发送注册的验证码
	 */
	public function getPhoneCode () {
		header("Content-type:text/json");
		$phone = $this->input->post_get('phone');
		if (isset($_SESSION['pcode'])){
			$pcode = $this->session->pcode;
			if ( ($pcode['code_time']+60)>time()){
				die('{"status":-3,"errmsg":"发送过于频繁"}');
			}
		}
		$length = 6;
		$code = '';
		for ($i = 0; $i < $length; $i++) { 
			$code .= rand(0, 9); 
		}
		$datas = array($code,30);
		$this->load->library('YunSms');
		//$YumSms = new YunSms();
		$rs = $this->yunsms->sendTemplateSMS($phone, $datas,1);
		if ($rs===true) {
			//发送成功存入session
			$pcode['code'] = $code;
			$pcode['code_time'] = time();
			$_SESSION['pcode'] = $pcode;
			$rd['status'] = 1;
		}else{
			$rd = $rs;
		}
		echo json_encode($rd);
	}
	
}
