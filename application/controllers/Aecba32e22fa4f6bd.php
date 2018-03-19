<?php

/**
 * 这个是定时执行任务控制器
 * 控制器名采用md5加密的字符串生成
 * 控制器方法也采用md5加密生成的任意字符串
 * 
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Aecba32e22fa4f6bd extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        //echo md5(time().'1');
    }

    /**
     * 定时程序收益计算
     * 时间  每天00:00:00
     */
    public function de2149eadd7eb633d35710993b37fd71(){
    	//加载配置信息
    	$this->load->model('Config_model', '', true);
    	$this->load->model('Red_packet_model', '', true);
    	$config = $this->Config_model->get();
    	//取出当天红包池的所以订单
    	$where['rp_state'] = 1;
    	$where['red_packet_addtime'] = '>'.date("Y-m-d");
    	$rp = $this->Red_packet_model->get($where);
    	foreach ($rp as $k => $v) {
    		//计算他自己的收益
    		if ($v['red_packet_type']==2) {	//钻石
    			$income = $v['red_packet_num']*(1+$config['diamond']);
    			$this->
    		}
    	}
    }
}
        
?>