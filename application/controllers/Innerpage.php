<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Innerpage extends CI_Controller {

	CONST FOLDER = 'innerpage';

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		
	}

	public function ajaxPage($_page, $_param = '') {
		header('Content-Type: text/html');
		echo $this->load->view(self::FOLDER.'/'.$_page, $_param, true);
	}

	// 修改头像
	public function alterHeadimg() {
		$user = $this->session->USER;
		$this->load->model('User_model','', true);
		$data = $this->User_model->get($user['user_id']);
    	$this->ajaxPage('alter_headimg',$data);
    }

	// 修改基本信息子页
	public function alterBasicInfo() {
		//载入基本的用户信息
		$user = $this->session->USER;
		$this->load->model('User_model', '', true);
		$user = $this->User_model->get($user['user_id']);
		$data['user'] = $user;
		$this->ajaxPage('alter_basic_info',$data);
	}
    
	// [充值]支付宝子页面
    public function alipayNext() {
    	$user = $this->session->USER;
    	$user['user_id'] = $user['user_id'];
    	//生成备注码
    	$remark = '';
    	for ($i = 0; $i < 6; $i ++) {
    		$remark .= rand(0,9);
    	}
    	$top['remark'] = $remark;
    	$top['topup_type'] = 1;
    	$top['money'] = $this->input->get('money');
    	$top['alipay'] = $this->input->get('alipay');
    	$top['mobile'] = $this->input->get('mobile');
    	$top['user_id'] = $user['user_id'];
    	$top['topup_addtime'] = date('Y-m-d h:i:s');
    	if ($this->checkEmpty($top)!==true) {
    		header("Content-Type:text/json");
    		die('{"status":-1,"errmsg":"输入不正确"}');
    	}
    	$this->load->model('Topup_model', '', true);
    	$rs = $this->Topup_model->insert($top);
    	if (!$rs) {
    		header("Content-Type:text/json");
    		die('{"status":-1,"errmsg":"网络错误"}');
    	}
    	if ($top['money']<=100){
    		header("Content-type:text/json");
    		die('{"status":-1,"errmsg":"请输入大于100的金额，请检查"}');
    	}
    	$this->load->model('Config_model', '',true);
		$data['account']['receiverBankNo'] = $this->Config_model->getValue('receiverBankNo');
		$data['account']['receiver'] = $this->Config_model->getValue('receiver');
		$data['account']['receiverBankName'] = $this->Config_model->getValue('receiverBankName');
		$data['account']['alipayQRCode'] = $this->Config_model->getValue('alipayQRCode');
		$data['account']['alipayAccount'] = $this->Config_model->getValue('alipayAccount');
		$data['account']['companyName'] = $this->Config_model->getValue('companyName');
        $data['account']['randomCode'] = $remark;
        $data['account']['money'] = $top['money'];
    	$this->ajaxPage('alipay_next', $data);
    }

    //消息阅读
    public function envelopeRead () {
        $user = $this->session->USER;
        $id = $this->input->post('id');
        $this->load->model('Fri_tx_model', '', true);
        $data = $this->Fri_tx_model->getTx($id);
        $this->ajaxPage('envelope_read', $data);
    }

    // [充值]银行卡子页面
    public function bankNext() {
    	$user = $this->session->USER;
    	$user['user_id'] = $user['user_id'];
    	//生成备注码
    	$remark = '';
    	for ($i = 0; $i < 6; $i ++) {
    		$remark .= rand(0,9);
    	}
    	$top['remark'] = $remark;
    	$top['topup_type'] = 2;
    	$top['money'] = $this->input->get('money');
    	$top['remit_name'] = $this->input->get('remit_name');
    	$top['mobile'] = $this->input->get('mobile');
    	$top['user_id'] = $user['user_id'];
    	$top['topup_addtime'] = date('Y-m-d h:i:s');
    	$ck = $this->checkEmpty($top);
    	if ($ck!==true) {
    		header("Content-type:text/json");
    		die('{"status":-1,"errmsg":"输入不正确，请检查"}');
    	}
    	if ($top['money']<=100){
    		header("Content-type:text/json");
    		die('{"status":-1,"errmsg":"请输入大于100的金额，请检查"}');
    	}
    	$this->load->model('Topup_model', '', true);
    	$rs = $this->Topup_model->insert($top);
    	if (!$rs) {
    		header("Content-Type:text/json");
    		die('{"status":-1,"errmsg":"网络错误"}');
    	}
    	$this->load->model('Config_model', '',true);
		$data['account']['receiverBankNo'] = $this->Config_model->getValue('receiverBankNo');
		$data['account']['receiver'] = $this->Config_model->getValue('receiver');
		$data['account']['receiverBankName'] = $this->Config_model->getValue('receiverBankName');
		$data['account']['companyName'] = $this->Config_model->getValue('companyName');
        $data['account']['randomCode'] = $remark;
        $data['account']['money'] = $top['money'];
    	$this->ajaxPage('bank_next',$data);
    }



    // [钱包]提出B币
    public function withdrawBCoin() {
    	$user = $this->session->USER;
    	$this->load->model('Wallet_model', '', true);
    	$this->load->model('Bank_model', '', true);
    	$wallet = $this->Wallet_model->get(array('user_id'=>$user['user_id']));
    	
    	$bank = $this->Bank_model->get(array('user_id'=>$user['user_id']));
    	$to = '';
    	$bank_no = $bank['bank_no'];
    	$blen = strlen($bank_no)-1;
    	for ($i = 0; $i < 4; $i++) {
    		$to .= $bank_no[$blen];
    		$blen--;
    	}
    	$bank['bank_no'] = '****'.$to;
    	$data['wallet'] = $wallet;
    	$data['bank'] = $bank;
    	$this->ajaxPage('withdraw_bcoin', $data);
    }


    // [钱包] 钻石兑换B币
    public function changeToBCoin() {
    	$user = $this->session->USER;
    	$this->load->model('Config_model', '', true);
    	$this->load->model('Wallet_model', '', true);
    	$wallet = $this->Wallet_model->get(array('user_id'=>$user['user_id']));
    	$config = $this->Config_model->getValue('bdrant');
    	$data['bdrant'] = $config;
    	$data['wallet'] = $wallet;
    	$this->ajaxPage('changeto_bcoin', $data);

    }

    // [钱包] B币兑换钻石 
    public function changetoDiamond() {
    	$user = $this->session->USER;
    	$this->load->model('Config_model', '', true);
    	$this->load->model('Wallet_model', '', true);
    	$wallet = $this->Wallet_model->get(array('user_id'=>$user['user_id']));
    	$config = $this->Config_model->getValue('bdrant');
    	$data['bdrant'] = $config;
    	$data['wallet'] = $wallet;
    	$this->ajaxPage('changeto_diamond',$data);
    }


/**
 * 照片相关
 */
	
	// 上传图片
	public function uploadImgs() {
        $user = $this->session->USER;
        $this->load->model('Album_model', '', true);
        if ($this->input->post_get("id")!='') {
            $album_id = $this->input->post_get('id');
            $data['choseAlbum'] = $album_id;
        }
        $data['album'] = $this->Album_model->getMyAlbum();
		$this->ajaxPage('upload_imgs', $data);

	}

	// 创建相册
	public function createAlbum() {
		$this->ajaxPage('create_album');

	}
	
	// 修改相册
	public function alterAlbum($_album_id = 0) {
		$this->ajaxPage('alter_album');
	}

/**
 * 日志相关
 */

	// 管理日志分类
	public function journalManageCategory() {
		$user = $this->session->USER;
		$this->load->model('Blog_type_model', '', true);
		$data['type'] = $this->Blog_type_model->getUserType();
		$this->ajaxPage('journal_manage_category',$data);
	}

	// 设置访问权限
	public function journalSetAuth($_journal_id = 0) {
		$user = $this->session->USER;
		
		$this->load->model('Blog_model', '', true);
		$data['bid'] = $this->input->get_post('bid');
		$auth = $this->Blog_model->get($data['bid']);
		$data['auth'] = $auth['blog_rank'];
		$this->ajaxPage('journal_set_auth', $data);
	}

	// 设置
	public function journalSetCategory($_journal_id = 0) {
		$user = $this->session->USER;
		$this->load->model('Blog_type_model', '', true);
		$this->load->model('Blog_model', '', true);

		$data['type'] = $this->Blog_type_model->getUserType();
		$data['bid'] = $this->input->get_post('bid');
		$type = $this->Blog_model->get($data['bid']);
		$data['type_id'] = $type['blog_type_id'];
		$this->ajaxPage('journal_set_category',$data);
	}


/**
 * 朋友相关
 */

	// 朋友分组管理
	public function friendGroupManage() {
        $user = $this->session->USER;
        $this->load->model('Friend_group_model', '', true);
        $where['user_id'] = $user['user_id'];
        $data['data'] = $this->Friend_group_model->get($where);
		$this->ajaxPage('friend_group_manage', $data);
	}

    // 添加好友通知
    public function addFriendNoti() {
        $user = $this->session->USER;
        $per_page = 3;
        $this->load->model('Friend_apply_model', '', true);
        $rs = $this->Friend_apply_model->getApply($per_page);
        $info['per_page'] = $per_page;
        $this->load->library('pagination');
        
        $config['base_url'] = site_url(self::FOLDER.'addFriendNoti/page');
        $config['total_rows'] = $rs['total'];
        $config['per_page'] = $per_page;
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['next_link'] = '下一页';
        $config['next_tag_open'] = '';
        $config['next_tag_close'] = '';
        $config['num_tag_open'] = '';
        $config['num_tag_close'] = '';
        $config['prev_link'] = '上一页';
        $config['prev_tag_open'] = '';
        $config['prev_tag_close'] = '';
        $config['cur_tag_open'] = '<a class="active">';
        $config['cur_tag_close'] = '</a>';
        
        $this->pagination->initialize($config);
        
        $data['page'] = $this->pagination->create_links();
        $info['total_page'] = $this->pagination->get_total_page();
        $info['total'] = $rs['total'];
        $info['user_id'] = $user['user_id'];
        $data['data'] = $rs['data'];
        $data['info'] = $info;
        $this->ajaxPage('add_friend_noti',$data);
    }

    /** 分页获取数据 */
    public function addFriendNotiPage () {
        $user = $this->session->USER;
        $per_page = 3;
        $this->load->model('Friend_apply_model', '', true);
        $rs = $this->Friend_apply_model->getApply($per_page);
        $info['per_page'] = $per_page;
        $this->load->library('pagination');
        
        $config['base_url'] = site_url(self::FOLDER.'addFriendNoti/page');
        $config['total_rows'] = $rs['total'];
        $config['per_page'] = $per_page;
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['next_link'] = '下一页';
        $config['next_tag_open'] = '';
        $config['next_tag_close'] = '';
        $config['num_tag_open'] = '';
        $config['num_tag_close'] = '';
        $config['prev_link'] = '上一页';
        $config['prev_tag_open'] = '';
        $config['prev_tag_close'] = '';
        $config['cur_tag_open'] = '<a class="active">';
        $config['cur_tag_close'] = '</a>';
        
        $this->pagination->initialize($config);
        
        $data['page'] = $this->pagination->create_links();
        $info['total_page'] = $this->pagination->get_total_page();
        $info['total'] = $rs['total'];
        $info['user_id'] = $user['user_id'];
        $data['data'] = $rs['data'];
        $data['info'] = $info;
        $this->ajaxPage('add_friend_noti_page', $data);
    }

    /*----------------------------------------------
     *          登录后的首页异步加载数据相关
     ------------------------------------------------*/
	/** 访客 */
    public function visitorPage () {
        $user = $this->session->USER;
        $per_page = 5;
        $this->load->model('User_visitor_model', '', true);
        $rs = $this->User_visitor_model->getVisitorPage($per_page);
        $info['per_page'] = $per_page;
        $this->load->library('pagination');
        
        $config['base_url'] = site_url(self::FOLDER.'visitorPage/page');
        $config['total_rows'] = $rs['total'];
        $config['per_page'] = $per_page;
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['next_link'] = '下一页';
        $config['next_tag_open'] = '';
        $config['next_tag_close'] = '';
        $config['num_tag_open'] = '';
        $config['num_tag_close'] = '';
        $config['prev_link'] = '上一页';
        $config['prev_tag_open'] = '';
        $config['prev_tag_close'] = '';
        $config['cur_tag_open'] = '<a class="active">';
        $config['cur_tag_close'] = '</a>';
        
        $this->pagination->initialize($config);
        
        $data['page'] = $this->pagination->create_links();
        $info['total_page'] = $this->pagination->get_total_page();
        $info['total'] = $rs['total'];
        $info['user_id'] = $user['user_id'];
        $data['data'] = $rs['data'];
        $data['info'] = $info;
        $this->ajaxPage('visitor_page', $data);
    } 


    // 注册页面填写图形验证码界面
    public function fillGuicode($_phone = NULL) {
        $this->ajaxPage('fill_guicode', array('phone' => $_phone));
    }

}

/* End of file Innerpage.php */
/* Location: ./application/controllers/Innerpage.php */