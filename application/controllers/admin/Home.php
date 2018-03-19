<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->isAdminLogin();
    }

    function index() {
        $this->load->model('User_model', '', true);
        $data['data'] = $this->User_model->countNum();
        $data['today'] = $this->User_model->countToday();
        $this->page->adminPage('home',
        	array(
        		'header_param'=>array(),
        		'top_param'=>array('flag1'=>'yygl','flag2'=>'sjtj'),
        		'param'=>$data,
        		'footer_param'=>array()
        		)
        	);
    }

    /**
     * 会员配置修改
     */
    public function vipLevel () {
        $this->load->model('Vip_level_model', '', true);
        $data['data'] = $this->Vip_level_model->get();
        $this->page->adminPage('sysAdmin/vipLevel',
            array(
                'header_param'=>array('title'=>'会员等级配置'),
                'top_param'=>array('flag1'=>'xtgl','flag2'=>'hypz'),
                'param'=>$data,
                'footer_param'=>array()
                )
            );
    }

    /**
     * 修改升级所需钻石
     */
    public function alterVipLevelNeed () {
        $this->isAjaxAdminLogin();
        $rd = array('status'=>-1);
        $vip_level_id = (int)$this->input->get_post('id', TRUE);
        $data['vip_level_need'] = (int)$this->input->post('value', TRUE);
        $this->load->model('Vip_level_model', '', true);
        $rs = $this->Vip_level_model->update($data, $vip_level_id);
        if ($rs!==false) {
            $rd['status'] = 1;
        }else{
            $rd['errmsg'] = '网络错误';
        }
        echo json_encode($rd);
    }

    /**
     * 修改会员能发的红包的钻石数量
     */
    public function alterVipNum () {
        $this->isAjaxAdminLogin();
        $rd = array('status'=>-1);
        $vip_level_id = (int)$this->input->get_post('id', TRUE);
        $data['vip_level_need'] = (int)$this->input->post('value', TRUE);
        $this->load->model('Vip_level_model', '', true);
        $rs = $this->Vip_level_model->update($data, $vip_level_id);
        if ($rs!==false) {
            $rd['status'] = 1;
        }else{
            $rd['errmsg'] = '网络错误';
        }
        echo json_encode($rd);
    }

    /**
     * 主配置
     */
    public function mainConfig () {
        $this->load->model('Config_model', '', true);
        $data['data'] = $this->Config_model->get();
        //var_dump($data);
        $this->page->adminPage('sysAdmin/mainConfig',
            array(
                'header_param'=>array('title'=>'常用配置','isWebUploader'=>1),
                'top_param'=>array('flag1'=>'xtgl','flag2'=>'cypz'),
                'param'=>$data,
                'footer_param'=>array()
                )
            );
    }

    /**
     * 修改住配置
     */
    public function alterConfig () {
        $this->isAjaxAdminLogin();
        $rd = array('status'=>-1);
        $config_id = (int)$this->input->get_post('id', TRUE);
        $data['field_value'] = $this->input->post('value', TRUE);
        $this->load->model('Config_model', '', true);
        $rs = $this->Config_model->update($data, $config_id);
        if ($rs!==false) {
            $rd['status'] = 1;
        }else{
            $rd['errmsg'] = '网络错误';
        }
        echo json_encode($rd);
    }

    /**
     * 上传转账用的支付宝二维码
     */
    public function uploadAlipayQRCode () {
        $this->isAjaxAdminLogin();
        $rd = array('status'=>-1);
        $config['upload_path'] = './uploads/alipayQRcode/';
        $config['allowed_types'] = 'gif|jpg|png';
        //$config['max_size']  = '100';
        $config['file_name'] = 'alipayQRcode';
        $config['overwrite'] = true;
        //$config['max_width']  = '1024';
        //$config['max_height']  = '768';
        
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('file')){
            $error = array('error' => $this->upload->display_errors());
            $rd['status'] = -2; //上传失败
            $rd['info'] = $error['error'];
        }
        else{
            $upload_data = $this->upload->data();
            $data = array('path'=>base_url().'uploads/alipayQRcode/'.$upload_data['file_name']);
            $rd['status'] = 1;
            $rd['info'] = '上传成功';
            $rd['data'] = $data;
        }
        echo json_encode ($rd);
    }

    /**
     * 管理员信息
     */
    public function info () {
        $data['data'] = $this->session->GYADMIN;
        $this->page->adminPage('info',
            array(
                'header_param'=>array(),
                'top_param'=>array('flag1'=>'xtgl','flag2'=>'grxx'),
                'param'=>$data,
                'footer_param'=>array()
                )
            );
    }
    
    /**
     * 提现管理
     */
    public function cashList () {
        $this->isAdminLogin();
        $per_page = $this->input->get_post('set_per_page')!=''?$this->input->get_post('set_per_page'):15;
        $info['per_page'] = $per_page;
        $this->load->model('User_model', '', true);
        $rs = $this->User_model->queryCashList($per_page);
        $this->load->library('pagination');
        
        $config['base_url'] = site_url('admin/User/chashList/page');
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

        $this->page->adminPage('user/cashList',
            array(
                'header_param'=>array('title'=>'提现管理'),
                'top_param'=>array('flag1'=>'yygl','flag2'=>'txgl'),
                'param'=>$data,
                'footer_param'=>array()
                )
            );
    }

    /**
     * 提现记录
     */
    public function cashRecordList () {
        $this->isAdminLogin();
        $per_page = $this->input->get_post('set_per_page')!=''?$this->input->get_post('set_per_page'):15;
        $info['per_page'] = $per_page;
        $this->load->model('User_model', '', true);
        $rs = $this->User_model->queryCashRecordList($per_page);
        $this->load->library('pagination');
        
        $config['base_url'] = site_url('admin/User/cashRecordList/page');
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

        $this->page->adminPage('user/cashRecordList',
            array(
                'header_param'=>array('title'=>'提现记录'),
                'top_param'=>array('flag1'=>'yygl','flag2'=>'txjl'),
                'param'=>$data,
                'footer_param'=>array()
                )
            );
    }

    /**
     * 提现成功操作
     */
    public function cashSuccess () {
        $this->load->model('User_model', '', true);
        $rs = $this->User_model->cashSuccess();
        header("Content-type:text/json");
        echo json_encode($rs);
    }

    /**
     * 管理员密码修改
     */
    public function alterPass () {
        header("Content-type:text/json");
        $admin = $this->session->GYADMIN;
        $this->load->model('Admin_model', '', true);
        $admin = $this->Admin_model->get($admin['admin_id']);
        $old = $this->input->post('old');
        $new = $this->input->post('new');
        //$confirm = $this->input->post('confirm');
        if ($new==''){
            $rd['status'] = -3;
            $rd['errmsg'] = '密码不能为空';
            die(json_encode($rd));
        }
        if (strlen($new)<6){
            $rd['status'] = -3;
            $rd['errmsg'] = '密码不能小于6位数';
            die(json_encode($rd));
        }
        if ($admin['admin_password']!=md5($old)){
            $rd['status'] = -2;
            $rd['errmsg'] = '原密码不正确';
            die(json_encode($rd));
        }
        $rs = $this->Admin_model->update(array('admin_password'=>$new),md5($admin['admin_id']) );
        if ($rs!==false){
            $rd['status'] = 1;
        }else{
            $rd['status'] = -4;
            $rd['errmsg'] = '操作失败,网络错误';
        }
        echo json_encode($rd);
    }
}

?>