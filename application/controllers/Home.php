<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
	}


	public function index() {
		$this->unloginedHome();
	}


	/** 未登录的主页 */
	public function unloginedHome() {
		$this->page->page('uhome', array(
				'head_param' => array('_csss' => array('uhome')),
				'foot_param' => array('_scripts' => array('uhome'))
			)
		);

	}


	/** [主选项]登录后的主页[首页] */
	public function loginedHome($_subpage = 1) {
		$user = $this->session->USER;
		$this->load->model('User_model', '', true);
		$this->load->model('User_visitor_model', '', true);
		$this->load->model('Adv_model', '', true);
		$user = $this->User_model->get($user['user_id']);
		$adv = $this->Adv_model->get();
		$this->page->page('home', array(
			'head_param' => array('_csss' => array('home')),
			'header' => 'header',
			'page_param' => array('subpage'=> $_subpage, 'data'=>$user, 'adv'=>$adv),
			'foot_param' => array('_scripts' => array('home'))
			));
	}

	/** [主选项]好友 */
	public function friend() {
		$user = $this->session->USER;
		$this->load->model('Friend_model', '', true);
		$per_page = 16;
		$rs = $this->Friend_model->getFriend($per_page);
		$data['data'] = $rs['data'];
		$this->page->page('friend', array(
			'head_param' => array('_csss' => array('friend')),
			'header' => 'header',
			'page_param' => $data,
			'foot_param' => array('_scripts' => array('friend'))
			));	
	}

	/** 更多我的朋友界面 */
	public function moreFriend() {
		$user = $this->session->USER;
		$per_page = 20;
		$this->load->model('Friend_model', '', true);
		$rs = $this->Friend_model->getFriend($per_page);
		$info['per_page'] = $per_page;
        $this->load->library('pagination');
        
        $config['base_url'] = site_url('home/moreFriend/page');
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
        $info['user_id'] = $user['user_id'];
        $data['data'] = $rs['data'];
        $data['info'] = $info;
		$this->page->page('more_friend', array(
			'head_param' => array('_csss' => array('more_friend')),
			'header' => 'header',
			'page_param' => $data,
			'foot_param' => array('_scripts' => array('more_friend'))
			));		
	}


	/** 我的主页 */
	public function myhome() {
		$this->page->page('myhome', array(
			'head_param' => array('_csss' => array('myhome')),
			'header' => 'header'
			));
	}


	/**
	 * 图片查看
	 * @param int $photo_id 图片id
	 */
	public function getPhoto () {
		$user = $this->session->USER;
		$id = (int)$this->input->post_get('photo_id', TRUE);
		$this->load->model('Photo_model','',true);
		if ($this->Photo_model->isMyPhoto($id, $user['user_id'])){
			$rs = $this->Photo_model->get($id);
			header("Content-type:image/png");
			$img_uri = $rs['photo_path'];
			echo file_get_contents($img_uri);
		}else{
			$rd['status'] = -2;
			$rd['errmsg'] = '权限错误';
			echo json_encode($rd);
		}
	}

	/**
	 * 缩略图查看
	 * @param int $photo_id 图片id
	 */
	public function getPhotoThumb () {
		$user = $this->session->USER;
		$id = (int)$this->input->post_get('photo_id', TRUE);
		$this->load->model('Photo_model','',true);
		if ($this->Photo_model->isMyPhoto($id, $user['user_id'])){
			$rs = $this->Photo_model->get($id);
			header("Content-type:image/png");
			$img_uri = $rs['photo_thumb'];
			echo file_get_contents($img_uri);
		}else{
			$rd['status'] = -2;
			$rd['errmsg'] = '权限错误';
			echo json_encode($rd);
		}
	}


	/**
	 * 查看公开图片
	 * @param int $photo_id 图片id
	 */
	public function getCommonPhoto () {
		$user = $this->session->USER;
		$id = (int)$this->input->post_get('photo_id', TRUE);
		$this->load->model('Photo_model','',true);
		$this->load->model('Album_model','',true);
		$rs = $this->Photo_model->get($id);
		$album = $this->get($rs['album_id']);
		if ($album[0]['album_isshow']==1){
			header("Content-type:image/png");
			$img_uri = $rs['photo_path'];
			echo file_get_contents($img_uri);
		}else{
			$rd['status'] = -2;
			$rd['errmsg'] = '权限错误';
			echo json_encode($rd);
		}
	}

	/**
	 * 查看公开图片
	 * @param int $photo_id 图片id
	 */
	public function getCommonPhotoThumb () {
		$user = $this->session->USER;
		$id = (int)$this->input->post_get('photo_id', TRUE);
		$this->load->model('Photo_model','',true);
		$this->load->model('Album_model','',true);
		$rs = $this->Photo_model->get($id);
		$album = $this->Album_model->get($rs['album_id']);
		
		if ($album[0]['album_isshow']==1){
			header("Content-type:image/png");
			$img_uri = $rs['photo_thumb'];
			echo file_get_contents($img_uri);
		}else{
			$rd['status'] = -2;
			$rd['errmsg'] = '权限错误';
			echo json_encode($rd);
		}
	}



}
