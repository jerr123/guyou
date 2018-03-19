<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Blog extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        //
    }

    /**
     * 日志分页
     */

    /**
     * 写日志
     */
    public function addBlog () {
        header("Content-type:text/json");
        $rd = array('status'=>-1);
    	$user = $this->session->USER;
        if ($this->input->post_get('blog_id')!=''){
            $this->alterBlog();
            die();
        }
        $data['user_id'] = $user['user_id'];
    	//$data['user_id'] = 1;
    	$data['blog_title'] = $this->input->post('blog_title', TRUE);
    	$data['blog_type_id'] = $this->input->post('blog_type_id', TRUE);
        if ($data['blog_type_id']==''){
            $rd['errmsg'] = '请选择日志类型';
            echo json_encode($rd);
            die();
        }
    	$data['blog_content'] = htmlspecialchars($this->input->post('blog_content', TRUE));
    	if ($this->input->post('blog_rank', TRUE)!='') $data['blog_rank'] = $this->input->post('blog_rank', TRUE);
    	$data['blog_addtime'] = date("Y-m-d h:i:s");
    	$this->load->model('Blog_model', '', true);
    	$rs = $this->Blog_model->insert($data);
    	if ($rs) {
    		$rd['status'] = 1;
            $rd['data']['id'] = $rs;
    	}else{
    		$rd['errmsg'] = '网络错误';
    	}
        echo json_encode($rd);
    }

    /**
     * 日志修改
     */
    public function alterBlog () {
        header("Content-type:text/json");
    	$user = $this->session->USER;
    	$blog_id = (int)$this->input->post('blog_id', TRUE);
    	$this->load->model('Blog_model', '', true);
    	//验证日志是否属于该用户
    	if ($this->Blog_model->isMyBlog($blog_id, $user['user_id'])) {
    		$data['blog_title'] = $this->input->post('blog_title', TRUE);
    		$data['blog_type_id'] = $this->input->post('blog_type_id', TRUE);
    		$data['blog_content'] = htmlspecialchars($this->input->post('blog_content', TRUE));
    		if ($this->input->post('blog_rank', TRUE)!='') $data['blog_rank'] = $this->input->post('blog_rank', TRUE);
    		$data['blog_addtime'] = date("Y-m-d h:i:s");
    		$rs = $this->Blog_model->update($data, $blog_id);
    		if ($rs!==false) {
    			$rd['status'] = 1;
    		}else{
    			$rd['status'] = -2;
                $rd['errmsg'] = '网络错误';
    		}
    	}else{
    		$rd['status'] = -3;
            $rd['errmsg'] = '权限错误,不是你的日志';
    	}
        echo json_encode($rd);
    	
    }

}
        
?>