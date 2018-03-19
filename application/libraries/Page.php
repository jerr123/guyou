<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page {
	public $CI;

	public function __construct() {
		$this->CI =& get_instance();
	}
	
	/**
	 * 载入一个页面，根据参数进行自动载入
	 * @param  String $_page   载入的页面
	 * @param array $_params 
	 *  head_param     头部参数
	 *	foot_param     底部参数
	 *	header         上部页面
	 *	header_param   上部参数
	 *	footer         下部页面
	 *	footer_param   下部参数
	 *	page_param     页面参数
	 * 
	 */
	public function page($_page = NULL, $_params = array()) {
		if ($_page == NULL)
			die('You don\'t fill the \'_page\' param.');
		
		$this->CI->load->view('template/head', array_key_exists('head_param', $_params) ? $_params['head_param'] : '', false);

		if (array_key_exists('header', $_params))
			$this->CI->load->view('template/'.$_params['header'], array_key_exists('header_param', $_params) ? $_params['header_param'] : '', false);

		$this->CI->load->view($_page, array_key_exists('page_param', $_params) ? $_params['page_param'] : '', false);

		if (array_key_exists('footer', $_params))
			$this->CI->load->view('template/'.$_params['footer'], array_key_exists('footer_param', $_params) ? $_params['footer_param'] : '', false);			

		$this->CI->load->view('template/foot', array_key_exists('foot_param', $_params) ? $_params['foot_param'] : '', false);
	}


	/**
	 * 获取内部页面，返回页面内容
	 * @param  [type] $_page   [description]
	 * @param  array  $_params [description]
	 * @return [type]          [description]
	 */
	public function innerPage($_page = NULL, $_params = array()) {

	}

	/**
	 * 加载后台页面
	 * @param String $_page 主体页面
	 * @param Array $_params 参数
	 *  header_param	头部参数
	 *  top_param	顶部参数
	 *  param 	主体参数
	 *  footer_param	底部参数
	 */
	public function adminPage ($_page=null,$_params = array(), $isTop=true) {
		if ($_page==null) die('You don\'t fill the \'_page\' param.');
		$this->CI->load->view('admin/template/header',array_key_exists('header_param', $_params)?$_params['header_param']:NULL);
		if ($isTop){
			$this->CI->load->view('admin/template/top',$_params['top_param']);
		}
		$this->CI->load->view('admin/'.$_page, array_key_exists('param', $_params)?$_params['param']:NULL);
		if ($isTop){
			$this->CI->load->view('admin/template/buttom',array_key_exists('buttom_param', $_params)?$_params['buttom_param']:'');
		}
		$this->CI->load->view('admin/template/footer', array_key_exists('footer_param', $_params)?$_params['footer_param']:NULL);

	}

}