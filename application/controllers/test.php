<?php
	if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class Test extends CI_Controller {
	
	    function __construct() {
	        parent::__construct();
	    }
	
	    function index() {
	    	$str = "@{user_id:3330703,nick:【业务充值皇冠S科技}+@{user_id:56268888,nick:QQ提醒}+@{user_id:714637354,nick:Co中ldStone}+SSSSSSS";
	    	if (preg_match_all("/@{user_id:(\d*),nick:([^\}\+]*)\}\+{1}/u",$str, $m, PREG_SET_ORDER)) {
	    		var_dump($m);
	    	}
	    	//$this->load->library('emoji');
	        //$this->load->view('welcome_message', $data);
	    }
	}

?>