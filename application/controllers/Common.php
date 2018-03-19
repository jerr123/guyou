<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common extends CI_Controller {

	CONST FOLDER = 'common/';

	public function __construct() {
		parent::__construct();
		
	}

	public function index() {
		
	}

///////
//相册 //
///////


	/** 相片相册界面 */
	public function photo() {
		$user = $this->session->USER;
		$this->load->model('Album_model', '', TRUE);
		$this->load->model('Photo_model', '', TRUE);
		$album = $this->Album_model->getMyAlbum();
		foreach ($album as $k=>$v) {
			$album[$k]['photo_count'] = $this->Photo_model->countPhotoByAlbum($v['album_id']);
		}
		$data['data'] = $album;
		$this->page->page(self::FOLDER.'photo', array(
			'head_param' => array('_csss' => array(self::FOLDER.'photo')),
			'header' => 'header',
			'page_param' => $data,
			'foot_param' => array('_scripts' => array(self::FOLDER.'photo'))
			));
	}


	/* 查看相册的相片 */
	public function photoView() {
		$user = $this->session->USER;
		$id = $this->input->post_get('album_id');
		$this->load->model('Photo_model', '', true);
		$this->load->model('Album_model', '', true);
		$data['data'] = $this->Photo_model->getPhotoByAlbum();
		$album = $this->Album_model->get($id);
		$data['album'] = $album[0];
		$this->page->page(self::FOLDER.'photo_view', array(
			'head_param' => array('_csss' => array(self::FOLDER.'photo_view')),
			'header' => 'header',
			'page_param' => $data,
			'foot_param' => array('_scripts' => array(self::FOLDER.'photo_view'))
			));
	}



///////
//日志 //
///////

	/** 日志界面 */
	public function journal() {
		$user = $this->session->USER;
		$per_page = 10;
    	$info['per_page'] = $per_page;
    	$this->load->model('Blog_model', '', true);
    	$this->load->model('Blog_type_model', '', true);
    	$rs = $this->Blog_model->getBlogList($per_page);
    	$this->load->library('pagination');
    	
    	$config['base_url'] = site_url(self::FOLDER.'journal/page');
    	$config['total_rows'] = $rs['total'];
    	$config['per_page'] = $per_page;
    	$config['next_link'] = '下一页;';
    	$config['next_tag_open'] = '<li>';
    	$config['next_tag_close'] = '</li>';
    	$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
    	$config['prev_link'] = '上一页;';
    	$config['prev_tag_open'] = '<li>';
    	$config['prev_tag_close'] = '</li>';
    	$config['cur_tag_open'] = '<li class="active"><a href="#">';
    	$config['cur_tag_close'] = '</a></li>';
    	
    	$this->pagination->initialize($config);
    	
    	$data['page'] = $this->pagination->create_links();
    	$info['total_page'] = $this->pagination->get_total_page();
    	$info['total'] = $rs['total'];
    	$data['data'] = $rs['data'];
    	$data['info'] = $info;
    	$bt = $this->Blog_type_model->getBlogTypeCount();
    	$data['blog_type'] = $bt['type'];
    	$data['blogCount'] = $bt['blogCount'];
    	$data['searchKey'] = $this->input->post('searchKey');
		$this->page->page(self::FOLDER.'journal', array(
			'head_param' => array('_csss' => array(self::FOLDER.'journal')),
			'header' => 'header',
			'page_param' => $data,
			'foot_param' => array('_scripts' => array(self::FOLDER.'journal'))
			));
	}
	

	/** 写日志 */
	public function writeJournal() {
		$user = $this->session->USER;
		$this->load->model('Blog_type_model', '', true);
		$this->load->model('Blog_model', '', true);
		$data['type'] = $this->Blog_type_model->getUserType();
		$blog_id = intval($this->input->post_get('blog_id'));
		if ($blog_id!=''){
			$blog = $this->Blog_model->get($blog_id);
			$blog['blog_content'] = htmlspecialchars_decode($blog['blog_content']);
			$data['blog'] = $blog;
		}
		$this->page->page(self::FOLDER.'write_journal', array(
			'head_param' => array('_csss' => array(self::FOLDER.'write_journal')),
			'header' => 'header',
			'page_param' => $data,
			'foot_param' => array('_scripts' => array(self::FOLDER.'write_journal'))
			));
	}

	/** 查看日志的界面 */
	public function viewJournal() {
		$user = $this->session->USER;
		$bid = $this->input->get_post('blog_id');
		$this->load->model('Blog_model', '', true);
		$data = $this->Blog_model->getBlog($bid);
		if ($data['user_id']!=$user['user_id']) {
			if ($data['blog_rank'] == 3) {
				$rd['status'] = -2;
				$rd['errmsg'] = "无法查看";
				header("Content-type:text/json");
				echo json_encode($rd);die();
			}else if ($data['blog_type'] == 2) {
				$this->load->model('Friend_model','', TRUE);
				if (!$this->isFriend($data['user_id'],$user['user_id'])){
					$rd['status'] = -3;
					$rd['errmsg'] = "没有权限查看";
					header("Content-type:text/json");
					echo json_encode($rd);die();
				}
			}
		}
		$this->page->page(self::FOLDER.'view_journal', array(
			'head_param' => array('_csss' => array(self::FOLDER.'view_journal')),
			'header' => 'header',
			'page_param' => $data,
			'foot_param' => array('_scripts' => array(self::FOLDER.'view_journal'))
			));
	}
	

/////////
//用户密码 //
/////////

	/** 注册 */
	public function register() {
		$this->page->page(self::FOLDER.'register', array(
			'head_param' => array('_csss' => array(self::FOLDER.'register')),
			'foot_param' => array('_scripts' => array(self::FOLDER.'register'))
			));
	}


	/** 密码找回 */
	public function forgetPassword() {
		$this->page->page(self::FOLDER.'forgetpass', array(
			'head_param' => array('_csss' => array(self::FOLDER.'forgetpass')),
			'foot_param' => array('_scripts' => array(self::FOLDER.'forgetpass'))
			));
	}

	/** 充值 */
	public function toTopUp() {
		
		$randPoint = rand(0,9).rand(0,9);
		$this->page->page(self::FOLDER.'topup', array(
			'head_param' => array('_csss' => array(self::FOLDER.'topup')),
			'page_param' => array('randPoint'=>$randPoint),
			'foot_param' => array('_scripts' => array(self::FOLDER.'topup'))
			));
	}


	/** To-Do 查看别人信息的主页 */
	public function mainPage() {
		$user = $this->session->USER;
		$uid = $this->input->get_post('uid');
		if ($uid=='') die();
		$this->load->model('User_model', '', true);
		$this->load->model('Blog_model', '', true);
		$this->load->model('Photo_model', '', true);
		$this->load->model('Album_model', '', true);
		$this->load->model('Trends_model', '', true);
		$this->load->model('User_visitor_model', '', true);
		$where['user_id'] = $uid;
		$trends = $this->Trends_model->getMainPageTrands($where);
		//var_dump($trends);
		foreach ($trends as $k=>$v) {
			//解析内容得到艾特的用户
			$trends[$k]['trends_content'] = preg_replace("/@{user_id:(\d*),user_nick:([^\}\+]*)\}\+{1}/u", '@<a href="'.site_url('common/mainPage').'?uid=$1'.'">$2</a>', $v['trends_content']);	 
		}
		$data['trends'] = $trends;
		$data['uinfo'] = $this->User_model->get($uid);
		$blog = $this->Blog_model->getMainPageBlog($uid);
		$photo = $this->Photo_model->getMainPagePhoto($uid);
		$data['blog'] = $blog;
		$data['photo'] = $photo;
		$data['user'] = $user;
		//更新我的主页访问次数
		$this->User_model->update(array('user_pv'=>($data['uinfo']['user_pv']+1) ),$uid);
		//记录访问记录
		$visitor['user_id'] = $uid;
		$visitor['user_visitor_id'] = $user['user_id'];
		$visitor['visitor_addtime'] = date("Y-m-d h:i:s");
		$this->User_visitor_model->insert($visitor);
		//var_dump($data);
		$this->page->page(self::FOLDER.'main_page', array(
			'head_param' => array('_csss' => array(self::FOLDER.'main_page')),
		    'header' => 'header',
		    'page_param' => $data,
			'foot_param' => array('_scripts' => array(self::FOLDER.'main_page'))
			));
	}


	/** To-Do 查看别人日志 ^^^ */

	/** To-Do 查看别人照片 ^^^ */



	// 管理朋友
	public function manageFriend() {
		$user = $this->session->USER;
		$per_page = 3;
        $this->load->model('Friend_model', '', true);
        $rs = $this->Friend_model->getFriend($per_page);
        $info['per_page'] = $per_page;
        $this->load->library('pagination');
        
        $config['base_url'] = site_url(self::FOLDER.'manageFriend/page');
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
        $this->load->model('Friend_group_model', '', true);
        $this->load->model('Friend_apply_model', '', true);
        $group = $this->Friend_group_model->get(array('user_id'=>$user['user_id']));
        foreach ($group as $k=>$v){
        	$group[$k]['user_count'] = $this->Friend_model->countFriendByGroup($v['group_id']);
        }
        //if (!$group) $group = array();
        $info['applyNum'] = $this->Friend_apply_model->getMyApplyCount();
        $data['group'] = $group;
        $info['total'] = $this->Friend_model->countFriendByGroup();
        $info['user_id'] = $user['user_id'];
        $data['data'] = $rs['data'];
        $data['info'] = $info;
		$this->page->page(self::FOLDER.'manage_friend', array(
			'head_param' => array('_csss' => array(self::FOLDER.'manage_friend')),
		    'header' => 'header',
		    'page_param' => $data,
			'foot_param' => array('_scripts' => array(self::FOLDER.'manage_friend'))
			));
	}
	
}
