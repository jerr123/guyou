<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Adv extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        //
    }

    /**
     * 广告位列表
     */
    public function AdPositionList () {
    	$this->isAdminLogin();
    	$per_page = $this->input->get_post('set_per_page')!=''?$this->input->get_post('set_per_page'):10;
    	$info['per_page'] = $per_page;
    	$this->load->model('Adv_model', '', true);
    	$rs = $this->Adv_model->queryAdPositionList($per_page);
    	$this->load->library('pagination');
    	
    	$config['base_url'] = site_url('admin/Adv/AdPositionList/page');
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
    	$this->page->adminPage('adv/adPositionList',
        	array(
        		'header_param'=>array('title'=>'广告位'),
        		'top_param'=>array('flag1'=>'yygl','flag2'=>'ggw'),
        		'param'=>$data,
        		'footer_param'=>array()
        		)
        	);
    }

    /**
     * 广告编辑
     */
    public function advEdit () {
    	$this->load->model('Adv_model','', true);
    	$id = (int)$this->input->post_get('id', TRUE);
    	$data['data'] = $this->Adv_model->get($id);
    	$this->page->adminPage('adv/advEdit',
    		array(
        		'header_param'=>array('title'=>'广告编辑','isWebUploader'=>1),
        		'top_param'=>array('flag1'=>'yygl','flag2'=>'ggw'),
        		'param'=>$data,
        		'footer_param'=>array('isWebUploader'=>1)
        		)
    		);
    }


    /**
     * 广告 单图片上传
     */
    public function uploadAdvPic () {
    	$rd = array('status'=>-1);
    	$config['upload_path'] = './uploads/adv/';
    	$config['allowed_types'] = 'gif|jpg|png';
    	//$config['max_size']  = '100';
    	$config['file_name'] = 'adv_img_'.(int)$this->input->post_get('adv_id');
    	$config['overwrite'] = true;
    	//$config['max_width']  = '1024';
    	//$config['max_height']  = '768';
    	
    	$this->load->library('upload', $config);

    	if ( ! $this->upload->do_upload('file')){
    		$error = array('error' => $this->upload->display_errors());
    		$rd['status'] = -2;	//上传失败
    		$rd['info'] = $error['error'];
    	}
    	else{
    		$upload_data = $this->upload->data();
    		$data = array('path'=>base_url().'uploads/adv/'.$upload_data['file_name']);
    		$rd['status'] = 1;
    		$rd['info'] = '上传成功';
    		$rd['data'] = $data;
    	}
    	echo json_encode ($rd);
    }

    /**
     * 广告编辑
     */
    public function exeAdvEdit () {
    	$rd = array('status'=>-1);
    	$id = (int)$this->input->post('adv_id', TRUE);
    	$data['advertiser_name'] = $this->input->post('advertiser_name', TRUE); 
    	$data['advertiser_mobile'] = $this->input->post('advertiser_mobile', TRUE); 
    	$data['adv_start'] = $this->input->post('adv_start', TRUE); 
    	$data['adv_end'] = $this->input->post('adv_end', TRUE);
    	$data['adv_img'] = $this->input->post('adv_img', TRUE);
    	$data['adv_state'] = 2;
    	$this->load->model('Adv_model', '', true);
    	$rs = $this->Adv_model->update($data,$id);
    	if ($rs!==false){
    		$rd['status'] = 1;
    	}
    	echo json_encode($rd);
    }

    /**
     * 广告位停用
     */
    public function advStop () {
    	$rd = array('status'=>-1, 'errmsg'=>'网络错误');
    	$id = (int)$this->input->get('id', TRUE);
    	$data['adv_state'] = 3;	//广告位停用
    	$this->load->model('Adv_model', '', true);
    	$rs = $this->Adv_model->update($data,$id);
    	if ($rs!==false){
    		$rd['status'] = 1;
    	}
    	echo json_encode($rd);
    }

    /**
     * 广告启用
     */
    public function advStart () {
    	$rd = array('status'=>-1, 'errmsg'=>'网络错误');
    	$id = (int)$this->input->get('id', TRUE);
    	$data['adv_state'] = 2;	//广告停用
    	$this->load->model('Adv_model', '', true);
    	$rs = $this->Adv_model->update($data,$id);
    	if ($rs!==false){
    		$rd['status'] = 1;
    	}
    	echo json_encode($rd);
    }

    /**
     * 广告重置
     */
    public function advReset () {
    	$rd = array('status'=>-1, 'errmsg'=>'网络错误');
    	$id = (int)$this->input->get('id', TRUE);
    	$data['advertiser_name'] = '';
    	$data['advertiser_mobile'] = ''; 
    	$data['adv_start'] = ''; 
    	$data['adv_end'] = '';
    	$data['adv_img'] = '';
    	$data['adv_state'] = 1;
    	$this->load->model('Adv_model', '', true);
    	$rs = $this->Adv_model->update($data,$id);
    	if ($rs!==false){
    		$rd['status'] = 1;
    	}
    	echo json_encode($rd);
    }
}

?>