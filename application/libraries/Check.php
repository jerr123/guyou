<?php 
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Check {
	/**
	 * @var  $CI ci
	 */
	public $CI;

	public function __construct () {
		$this->CI =& get_instance();
	}

	/**
	 * 是否好友校验
	 * @param Int $friend_user_id 好友的id
	 * @return Boolean 
	 */
	public function isFriend ($friend_user_id=NULL) {
		$this->CI->load->model('Friend_model','',true);
		$user = $this->CI->session->USER;
		$where['fri_user_id'] = $user['user_id'];
		if ($friend_user_id==NULL) {
			$where['friend_user_id'] = $this->CI->input->post('friend_user_id');
		}else{
			$where['friend_user_id'] = $friend_user_id;
		}
		$rs = $this->CI->Friend_model->get($where);
		if ($rs) {
			return true;
		}else{
			return false;
		}
	}
}