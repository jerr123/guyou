<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->userList();
    }

    /**
     * 用户列表
     */
    public function userList () {
    	$this->isAdminLogin();
    	$per_page = $this->input->get_post('set_per_page')!=''?$this->input->get_post('set_per_page'):10;
    	$info['per_page'] = $per_page;
    	$this->load->model('User_model', '', true);
    	$rs = $this->User_model->queryUserList($per_page);
    	$this->load->library('pagination');
    	
    	$config['base_url'] = site_url('admin/User/userList/page');
    	$config['total_rows'] = $rs['total'];
    	$config['per_page'] = $per_page;
    	//$config['uri_segment'] = 3;
    	//$config['num_links'] = 3;
    	//$config['full_tag_open'] = '<p>';
    	//$config['full_tag_close'] = '</p>';
    	$config['first_link'] = '&laquo';
    	$config['first_tag_open'] = '<li>';
    	$config['first_tag_close'] = '</li>';
    	$config['last_link'] = '&raquo';
    	$config['last_tag_open'] = '<li>';
    	$config['last_tag_close'] = '</li>';
    	$config['next_link'] = '&raquo;';
    	$config['next_tag_open'] = '<li>';
    	$config['next_tag_close'] = '</li>';
    	$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
    	$config['prev_link'] = '&laquo;';
    	$config['prev_tag_open'] = '<li>';
    	$config['prev_tag_close'] = '</li>';
    	$config['cur_tag_open'] = '<li class="active"><a href="#">';
    	$config['cur_tag_close'] = '</li>';
    	
    	$this->pagination->initialize($config);
    	
    	$data['page'] = $this->pagination->create_links();
    	$info['total_page'] = $this->pagination->get_total_page();
    	$info['total'] = $rs['total'];
    	$data['data'] = $rs['data'];
    	$data['info'] = $info;
    	$this->page->adminPage('user/userList',
        	array(
        		'header_param'=>array('title'=>'会员列表'),
        		'top_param'=>array('flag1'=>'yhgl','flag2'=>'hygl'),
        		'param'=>$data,
        		'footer_param'=>array()
        		)
        	);
    }

    /**
     * 用户充值处理
     */
    public function topupList () {
        $this->isAdminLogin();
        $per_page = $this->input->get_post('set_per_page')!=''?$this->input->get_post('set_per_page'):15;
        $info['per_page'] = $per_page;
        $this->load->model('User_model', '', true);
        $rs = $this->User_model->queryTopupList($per_page);
        $this->load->library('pagination');
        
        $config['base_url'] = site_url('admin/User/topupList/page');
        $config['total_rows'] = $rs['total'];
        $config['per_page'] = $per_page;
        //$config['uri_segment'] = 3;
        //$config['num_links'] = 3;
        //$config['full_tag_open'] = '<p>';
        //$config['full_tag_close'] = '</p>';
        $config['first_link'] = '&laquo';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = '&raquo';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '&raquo;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</li>';
        
        $this->pagination->initialize($config);
        
        $data['page'] = $this->pagination->create_links();
        $info['total_page'] = $this->pagination->get_total_page();
        $info['total'] = $rs['total'];
        //$info['unick']
        $data['data'] = $rs['data'];
        $data['info'] = $info;

        $this->page->adminPage('user/topupList',
            array(
                'header_param'=>array('title'=>'充值处理'),
                'top_param'=>array('flag1'=>'yhgl','flag2'=>'czcl'),
                'param'=>$data,
                'footer_param'=>array()
                )
            );
    }

    /**
     * 充值记录
     */
    /**
     * 用户充值处理
     */
    public function topupRecordList () {
        $this->isAdminLogin();
        $per_page = $this->input->get_post('set_per_page')!=''?$this->input->get_post('set_per_page'):15;
        $info['per_page'] = $per_page;
        $this->load->model('User_model', '', true);
        $rs = $this->User_model->queryTopupRecordList($per_page);
        $this->load->library('pagination');
        
        $config['base_url'] = site_url('admin/User/topupRecordList/page');
        $config['total_rows'] = $rs['total'];
        $config['per_page'] = $per_page;
        //$config['uri_segment'] = 3;
        //$config['num_links'] = 3;
        //$config['full_tag_open'] = '<p>';
        //$config['full_tag_close'] = '</p>';
        $config['first_link'] = '&laquo';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = '&raquo';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '&raquo;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</li>';
        
        $this->pagination->initialize($config);
        
        $data['page'] = $this->pagination->create_links();
        $info['total_page'] = $this->pagination->get_total_page();
        $info['total'] = $rs['total'];
        $data['data'] = $rs['data'];
        $data['info'] = $info;

        $this->page->adminPage('user/topupRecordList',
            array(
                'header_param'=>array('title'=>'充值记录'),
                'top_param'=>array('flag1'=>'yhgl','flag2'=>'czjl'),
                'param'=>$data,
                'footer_param'=>array()
                )
            );
    }
    /**
     * 收到钱充值成功
     */
    public function topupToSuccess () {
        $this->load->model('Topup_model', '', true);
        $this->Topup_model->topupToSuccess();
    }

    /**
     * 禁用该用户
     */
    public function stopUser () {
        header("Content-type:text/json");
        $this->isAjaxAdminLogin();
        $user_id = (int)$this->input->post('user_id');
        $this->load->model('User_model','', true);
        $rs = $this->User_model->update(array('user_state'=>2), $user_id);
        if ($rs !== false) {
            $rd['status'] = 1;
        }else{
            $rd['status'] = -2;
            $rd['errmsg'] = '网络错误';
        }
        echo json_encode($rd);
    }

    /**
     * 启用该用户
     */
    public function startUser () {
        header("Content-type:text/json");
        $this->isAjaxAdminLogin();
        $user_id = (int)$this->input->post('user_id');
        $this->load->model('User_model','', true);
        $rs = $this->User_model->update(array('user_state'=>1), $user_id);
        if ($rs !== false) {
            $rd['status'] = 1;
        }else{
            $rd['status'] = -2;
            $rd['errmsg'] = '网络错误';
        }
        echo json_encode($rd);
    }

    /**
     * 重置该用户的密码 
     */
    public function resetPass () {
        header("Content-type:text/json");
        $this->isAjaxAdminLogin();
        $user_id = (int)$this->input->post('user_id');
        $default_pass = md5('123456');
        $this->load->model('User_model','', true);
        $rs = $this->User_model->update(array('user_password'=>$default_pass), $user_id);
        if ($rs !== false) {
            $rd['status'] = 1;
        }else{
            $rd['status'] = -2;
            $rd['errmsg'] = '网络错误';
        }
        echo json_encode($rd);
    }

    /**
     * 删除用户
     */
    public function del () {
        header("Content-type:text/json");
        $this->isAjaxAdminLogin();
        $user_id = (int)$this->input->post('user_id');
        $this->load->model('User_model','', true);
        $rs = $this->User_model->delete($user_id);
        if ($rs) {
            $rd['status'] = 1;
        }else{
            $rd['status'] = -2;
            $rd['errmsg'] = '网络错误';
        }
        echo json_encode($rd);
    }
}

?>