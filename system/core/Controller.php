<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2015, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		http://codeigniter.com/user_guide/general/controllers.html
 */
class CI_Controller {

	/**
	 * Reference to the CI singleton
	 *
	 * @var	object
	 */
	private static $instance;

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		self::$instance =& $this;

		// Assign all the class objects that were instantiated by the
		// bootstrap file (CodeIgniter.php) to local class variables
		// so that CI can run as one big super object.
		foreach (is_loaded() as $var => $class)
		{
			$this->$var =& load_class($class);
		}

		$this->load =& load_class('Loader', 'core');
		$this->load->initialize();
		log_message('info', 'Controller Class Initialized');
	}

	// --------------------------------------------------------------------

	/**
	 * Get the CI singleton
	 *
	 * @static
	 * @return	object
	 */
	public static function &get_instance()
	{
		return self::$instance;
	}

	/*********************************************
	 *		父控制器 常用方法
	 * ******************************************/
	//登录判断
	public function isLogin () {
		if ($this->session->USER==''){
			header("location:".site_url('Login/toLogin'));
		}
	}
	//ajax登录判断
	public function isAjaxLogin () {
		if ($this->session->USER=='') die('{"status":-999,"errmsg":"请先登录"}');
	}
	//检查权限
	public function checkPermission($grant) {
		$user = $this->session->USER;
		if ( empty($user) || in_array($grant, $user) ) exit();
	}
	//ajax权限检查
	public function checkAjaxPermission ( $grant ) {
		$user = $this->session->USER;
		if (empty($user) || in_array($grant, $user) ) die('{"status":-998');
	}

	//验证码生成
	public function getVerify () {
		$this->load->library('Verify');
		$config = array('length'=>4,'fontSize'=>20);
		$Verify = new Verify($config);
		$Verify->entry();
	}

	//验证验证码
	public function checkVerify () {
		$this->load->library('Verify');
		$Verify = new Verify();
		return $Verify->check($this->input->post_get('verify'));
	}

	public function checkEmpty ($data, $isDie=false) {
		foreach ($data as $k=>$v ) {
			if ($v=='' || $v==null){
				if ($isDie){
					die('{"status":-997,"errmsg":"请填写完整不能为空"}');
				}
				return $k;
			}
		}
		return true;
	}

	///////////////////////////////////////
	///			后台相关			//////
	///////////////////////////////////////
	
	//管理员登录判断
	public function isAdminLogin(){
		if ($this->session->GYADMIN==''){
			header("location:".site_url('admin/Login/index'));
		}
	}

	//管理员异步登录判断
	public function isAjaxAdminLogin () {
		if ($this->session->GYADMIN=='') die('{"status":-999,"errmsg":"请先登录"}');
	}
}
