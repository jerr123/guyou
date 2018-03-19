<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pay extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        //
    }

    /**
     * 支付宝即时到账支付
     */
    public function alipay(){
    	$this->load->library('Alipay');
    	$this->alipay->quickPay(array());
    }

    /**
     * 支付宝即使到账回调
     * return_rul
     */
    public function return_url () {
    	$this->load->library('Alipay');
    	$this->alipay->return_url();
    }
}

?>