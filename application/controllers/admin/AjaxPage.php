<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class AjaxPage extends CI_Controller {

    function __construct() {
        parent::__construct();
        header("Content-type:text/html");
    }

    function index() {
        //
    }

    public function alterQRcode () {
    	$data['config_id'] = $this->input->post_get('id', TRUE);
    	$data['img'] = $this->input->post_get('img', TRUE);
    	echo $this->load->view('admin/ajaxPage/alterQRcode', $data, true);
    }


    public function topupDetail () {
    	$this->load->model('Topup_model', '', true);
    	$id = (int)$this->input->get_post('id');
    	$data = $this->Topup_model->getDetail($id);
    	echo $this->load->view('admin/ajaxPage/topupDetail', $data, true);
    }

    /**
     * 修改密码
     */
    public function alterPass () {
        $admin = $this->session->GYADMIN;
        $this->load->model('Admin_model', '', true);
        //$id = (int)$this->input->get_post('id');
        $data = $this->Admin_model->get($admin['admin_id']);
        echo $this->load->view('admin/ajaxPage/alterPass', $data, true);
    }
}

?>