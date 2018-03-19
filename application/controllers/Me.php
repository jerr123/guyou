<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Me extends CI_Controller {

	CONST FOLDER = 'me/';

	public function __construct() {
		parent::__construct();
		
	}

	public function index() {
		$this->mehome();
	}


	/** 我的主页 */
	public function mehome() {
		$this->load->model('User_model','', true);
		$user = $this->session->USER;
		$data['user'] = $this->User_model->get($user['user_id']);
		$this->page->page('mehome', array(
			'head_param' => array('_csss' => array('mehome'), '_scripts' => array('mehome')),
			'page_param' => $data,
			'header' => 'header'
			));
	}


////////////////////////
//子页面(都采用Ajax方式以文本返回) //
////////////////////////

	/**
	 * AjaxOut页面异步访问
	 * @param  Array $_param 相关参数, _scripts, _csss 分别表示载入页面所需的脚本
	 * @param  Array $_page_param 页面参数
	 * @param  String $_page  载入的页面
	 * @return   None
	 */
	public function ajaxOut($_page, $_page_param = '') {
		header("Content-type: text/html");
		$pageHtml = $this->load->view(self::FOLDER.$_page, $_page_param, true);
		echo $pageHtml;
	}

	/**
	 * AjaxOut参数异步访问
	 * @param  Array $_param  参数
	 * @return   None
	 */
	public function ajaxParam($_param) {
		header('Content-type: text/json');
		echo json_encode($_param);
	}


	/** 我的主页[在架构载入完成后自动第一个请求入页面中] */
	public function home() {
		$this->ajaxOut('home', '');
	}

	public function param_home() {
		$this->ajaxParam(array('_scripts' => array(base_url('public/js/me/ home.js')), '_csss' => array(base_url('public/css/me/home.css'))));
	}



	/** 站内信 */
	public function envelope() {
		$user = $this->session->USER;
		$per_page = 10;
		$this->load->model('Fri_tx_model', '', true);
		$rs = $this->Fri_tx_model->queryTxPage($per_page);
		$this->load->library('pagination');
    	
    	$config['base_url'] = site_url(self::FOLDER.'envelope/page');
    	$config['total_rows'] = $rs['total'];
    	$config['per_page'] = $per_page;
    	$config['next_link'] = '下一页';
    	$config['last_link'] = false;
    	$config['first_link'] = false;
    	$config['next_tag_open'] = '<li>';
    	$config['next_tag_close'] = '</li>';
    	$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
    	$config['prev_link'] = '上一页';
    	$config['prev_tag_open'] = '<li>';
    	$config['prev_tag_close'] = '</li>';
    	$config['cur_tag_open'] = '<li class="active"><a href="#">';
    	$config['cur_tag_close'] = '</a></li>';
    	
    	$this->pagination->initialize($config);
    	
    	$data['page'] = $this->pagination->create_links();
    	$info['total_page'] = $this->pagination->get_total_page();
    	$info['total'] = $rs['total'];
    	$info['per_page'] = $per_page;
    	$data['data'] = $rs['data'];
    	$data['info'] = $info;
		
		$data['unreadNum'] = $this->Fri_tx_model->tx_unread_count();
		$this->ajaxOut('envelope', $data);
	}

	public function param_envelope() {
		$this->ajaxParam(array('_scripts' => array(base_url('public/js/me/envelope.js')), '_csss' => array(base_url('public/css/me/envelope.css'))));
	}



	/** 红包 */
	public function redpacket() {
		$this->load->model('Vip_level_model', '', true);
		$this->load->model('Config_model', '', true);
		$rs = $this->Vip_level_model->get();
		$data['v1'] = $rs[0];
		$data['v2'] = $rs[1];
		$data['v3'] = $rs[2];
		$data['pointNum'] = $this->Config_model->getValue('pointNum');
		$this->ajaxOut('redpacket',$data);
	}

	public function param_redpacket() {
		$this->ajaxParam(array('_scripts' => array(base_url('public/js/me/redpacket.js')), '_csss' => array(base_url('public/css/me/redpacket.css'))));
	}



	/** 钱包 */
	public function purse() {
		$user = $this->session->USER;
		$user_id = $user['user_id'];
		$this->load->model('Wallet_model', '', TRUE);
		$this->load->model('Topup_model', '', TRUE);
		$data['data'] = $this->Wallet_model->loadWalletInfo($user_id);
		$rs = $this->Topup_model->get(array('user_id'=>$user_id, 'topup_state'=>1),'money');
		$topup = 0;
		if ($rs){
			if (is_array($rs)){
				$topup += $rs['money'];
			}else{
				foreach ($rs as $k=>$v){
					$topup += $v['money'];
				}
			}
		}else{
			//
		}
		
		$data['data']['topuping'] = $topup;
		$this->ajaxOut('purse',$data);
	}

	public function param_purse() {
		$this->ajaxParam(array('_scripts' => array(base_url('public/js/me/purse.js')), '_csss' => array(base_url('public/css/me/purse.css'))));
	}



	/** 会员升级 */
	public function upgrade() {
		$this->load->model('Vip_level_model', '', true);
		$rs = $this->Vip_level_model->get();
		$data['v1'] = $rs[0];
		$data['v2'] = $rs[1];
		$data['v3'] = $rs[2];
		$this->ajaxOut('upgrade', $data);
	}

	public function param_upgrade() {
		$this->ajaxParam(array('_scripts' => array(base_url('public/js/me/upgrade.js')), '_csss' => array(base_url('public/css/me/upgrade.css'))));
	}



	/** [我的]度友 */
	public function friends() {
		$this->ajaxOut('friends');
	}

	public function param_friends() {
		$this->ajaxParam(array('_scripts' => array(base_url('public/js/me/friends.js')), '_csss' => array(base_url('public/css/me/friends.css'))));
	}



 	/** 账单记录 */
	public function transferRecord() {
		$user = $this->session->USER;
		$per_page = 10;
		$this->load->model('Bill_model', '', true);
		$rs = $this->Bill_model->getBillPage($per_page);
		$this->load->library('pagination');
    	
    	$config['base_url'] = site_url(self::FOLDER.'transferRecord/page');
    	$config['total_rows'] = $rs['total'];
    	$config['per_page'] = $per_page;
    	$config['next_link'] = '下一页';
    	$config['last_link'] = false;
    	$config['first_link'] = false;
    	$config['next_tag_open'] = '<li>';
    	$config['next_tag_close'] = '</li>';
    	$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
    	$config['prev_link'] = '上一页';
    	$config['prev_tag_open'] = '<li>';
    	$config['prev_tag_close'] = '</li>';
    	$config['cur_tag_open'] = '<li class="active"><a href="#">';
    	$config['cur_tag_close'] = '</a></li>';
    	
    	$this->pagination->initialize($config);
    	
    	$data['page'] = $this->pagination->create_links();
    	$info['total_page'] = $this->pagination->get_total_page();
    	$info['total'] = $rs['total'];
    	$info['startDate'] = $this->input->post_get('startDate');
    	$info['endDate'] = $this->input->post_get('endDate');
    	$info['per_page'] = $per_page;
    	$data['data'] = $rs['data'];
    	$data['info'] = $info;
		$this->ajaxOut('transferRecord', $data);
	}

	public function param_transferRecord() {
		$this->ajaxParam(array('_scripts' => array(base_url('public/js/me/transfer_record.js')), '_csss' => array(base_url('public/css/me/transfer_record.css'))));
	}



	/** 资料 */
	public function information() {
		$this->load->model('User_model', '', true);
		$data = $this->User_model->getMyDetailInfo();
		$this->ajaxOut('information', $data);
	}

	public function param_information() {
		$this->ajaxParam(array('_scripts' => array(base_url('public/js/me/information.js')), '_csss' => array(base_url('public/css/me/information.css'))));
	}



	/** 设置 */
	public function setting() {
		$this->ajaxOut('setting');
	}

	public function param_setting() {
		$this->ajaxParam(array('_scripts' => array(base_url('public/js/me/setting.js')), '_csss' => array(base_url('public/css/me/setting.css'))));
	}

}