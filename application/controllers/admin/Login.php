<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->load->view('admin/login');
    }

    public function login () {
    	header("Content-type:text/json");
    	$rd = array('status'=>-1);
    	$username = $this->input->post('username');
    	if ($username=='') die('{"status":3,"errmsg":"请输入用户名"}');
    	$password = $this->input->post('password');
    	if ($password=='') die('{"status":2,"errmsg":"请输入密码"}');
    	$this->load->model('Admin_model','',true);
    	$admin = $this->Admin_model->get(array('admin_name'=>$username));
    	if ($admin){
    		if ($admin['admin_password']==md5($password)){
    			$this->session->GYADMIN = $admin;
    			unset($admin);
    			$rd['status'] = 1;
    		}else{
    			$rd['status'] = -2;
    			$rd['errmsg'] = '密码错误';
    		}
    	}else{
    		$rd['status'] = -3;
    		$rd['errmsg'] = '不存在的管理员';
    	}
    	echo json_encode($rd);
    }

    /**
     * 登出
     */
    public function logout () {
    	unset($_SESSION['GYADMIN']);
    	header("Location:".site_url('admin/Login/index'));
    }
}

?>