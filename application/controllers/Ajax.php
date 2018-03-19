<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 这个文件是用于Ajax操作访问的
 */

class Ajax extends CI_Controller {

	public function __construct() {
		parent::__construct();
		header("Content-type:text/json");
		$this->isAjaxLogin();
		
	}

	public function index() {
		
	}

	/**
	 * 用户注册校验
	 */
	public function check_user() {
		$this->load->model('User_model', '', true);
		$rs = $this->User_model->check_user();
		echo json_encode($rs);
	}

	

	/////////////
	/// 用户操作相关  ///
	/////////////
	/**
	 * 发布动态
	 */
	public function publish_mood() {
		$this->load->model('Trends_model','',true);
		$rs = $this->Trends_model->publish_mood();
		echo json_encode($rs);
	}

	/**
	 * 获取好友列表
	 */
	public function getFriendAndGroup () {
		$this->load->model('User_model', '', true);
		$this->User_model->getFriendAndGroup();
	}

	/**
	 * 点赞
	 * @param int $app_type 应用类型 1日志2相册3动态
	 */
	public function like () {
		$rd = array('status'=>-1, 'errmsg'=>'点赞失败');
		$user = $this->session->USER;
		$data['like_user_id'] = $user['user_id'];
		$data['app_type'] = 3;
		//$data['app_type'] = (int)$this->input->post('app_type', TRUE);;	//动态
		$data['app_id'] = (int)$this->input->post('app_id', TRUE);
		$data['to_like_user_id'] = (int)$this->input->post('to_like_user_id', TRUE);
		$data['like_addtime'] = date("Y-m-d h:i:s");
		$this->load->model('Like_model', '', true);
		$rs = $this->Like_model->insert($data);
		if ($rs) {
			$rd['status'] = 1;
			//$rd['info'] = 
		}else{
			$rd['errmsg'] = "网络错误";
		}
		echo json_encode($rd);
	}

	/**
	 * 请求对应动态的点赞
	 * @param Int $app_id 日志动态或者相册id
	 * @param Int $app_type 1日志2相册3动态
	 */
	public function getLike () {
		$this->load->model('Like_model', '', true);
		$this->Like_model->getLike();
	}

	/**
	 * 取消点赞
	 */
	public function unLike () {
		$rd = array('status'=>-1);
		$id = $this->input->post('like_id', TRUE);
		$this->load->model('Like_model', '', true);
		$rs = $this->Like_model->delete($id);
		if ($rs){
			$rd['status'] = 1;
		}else{
			$rd['errmsg'] = "网络错误";
		}
		echo json_encode($rd);
	}

	/**
	 * 根据friend_user_id获取好友信息
	 * @param Int $friend_user_id 
	 */
	public function getFriendInfo () {
		$rd = array('status'=>-1);
		$this->load->model('Friend_model', '', true);
		if ($this->Friend_model->isFriend()){
			$where = (int)$$this->input->post('friend_user_id', TRUE);
			$this->load->model('User_model', '', true);
			$rs = $this->User_model->get($where);
			if ($rs){
				$rd['status'] = 1;
				$rd['data'] = $rs;
			}else{
				$rd['errmsg'] = '网络错误';
			}
		}else{
			$rd['errmsg'] = '权限错误';
		}
		echo json_encode($rd);
	}

	/**
	 * 根据user_id获取用户信息[非好友状态]
	 * 
	 * 只能获取user_nick user_sex user_province user_city
	 * 
	 */
	public function getUserPublicInfo () {
		$rd = array('status'=>-1);
		$select = 'user_nick,user_sex,user_province,user_city';
		$where = $this->input->post_get('user_id', TRUE);
		$this->load->model('User_model', '', true);
		$rs = $this->User_model->get($where, $select);
		if ($rs) {
			$rd['status'] = 1;
			$rd['data'] = $rs;
		}else{
			$rd['errmsg'] = '网络错误';
		}
		echo json_encode($rd);
	}

	/**
	 * 申请添加好友
	 */
	public function friendApply() {
		$rd = array('status'=>-1);
		$user = $this->session->USER;
		$this->load->model('Friend_model', '', true);
		if (!$this->Friend_model->isFriend($user['user_id'])) {
			$this->session->USER;
			$data['from_user_id'] = $user['user_id'];
			$data['to_user_id'] = $this->input->post('to_user_id', TRUE);
			$data['fri_apply_addtime'] = date("Y-m-d H:i:s");
			$this->checkEmpty($data, true);
			$this->load->model('Friend_apply_model', '', true);
			$rs = $this->Friend_apply_model->insert($data);
			if ($rs) {
				//生成提醒消息
				$fri_tx['fri_user_id'] = $data['to_user_id'];
				$fri_tx['review_pic'] = $user['user_icon'];
				$fri_tx['review_nick'] = $user['user_nick'];
                $fri_tx['fri_tx_content'] = "{$user['user_nick']},申请添加你为好友";
                $fri_tx['fri_tx_addtime'] = date("Y-m-d H:i:s");
				$rd['status'] = 1;
				$this->load->model('Fri_tx_model', '', true);
				if ($this->Fri_tx_model->insert($fri_tx)) {
					//记录日志
				}
			}else{
				$rd['errmsg'] = "网络错误";
			}
		}else{
			$rd['status'] = -2;
			$rd['errmsg'] = '你们已经是好友';
		}
		echo json_encode($rd);
	}

	/**
	 * 同意添加好友
	 */
	public function agreeFriendApply () {
		$rd = array('status'=>-1);
		$user = $this->session->USER;
		$id = $this->input->post('id');
		$this->load->model('Friend_apply_model', '', true);
		$apply = $this->Friend_apply_model->get($id);
		//$data['friend_group_id'] = (int)$this->input->post('friend_group_id', TRUE);
		$this->Friend_apply_model->update(array('fri_apply_state'=>2),$id);
		$data1['fri_user_id'] = $user['user_id'];
		$data1['friend_user_id'] = $apply['from_user_id'];
		$data1['friend_addtime'] = date("Y-m-d H:i:s");
		//
		$data2['fri_user_id'] = $apply['from_user_id'];
		$data2['friend_user_id'] = $user['user_id'];
		$data2['friend_addtime'] = date("Y-m-d h:i:s");
		$this->checkEmpty($data1, true);
		$this->load->model('Friend_model', '', true);
		$rs1 = $this->Friend_model->insert($data1);
		$rs2 = $this->Friend_model->insert($data2);
		if ($rs1 && $rs2) {
			//分组里面好友数量+1
/*			$this->load->model('Friend_group_model', '', true);
			if ($this->Friend_group_model->update(array('user_count'=>'user_count+1'), array('group_id'=>$data['friend_group_id']))) {
				//
			}else{
				//
			}*/
			$rd['status'] = 1;
			//生成提醒消息
			$fri_tx['fri_user_id'] = $data1['friend_user_id'];
			$fri_tx['review_pic'] = $user['user_icon'];
			$fri_tx['review_nick'] = $user['user_nick'];
            $fri_tx['fri_tx_content'] = "{$user['user_nick']},同意把你加为好友";
            $fri_tx['fri_tx_addtime'] = date("Y-m-d H:i:s");
			$this->load->model('Fri_tx_model', '', true);
			if ($this->Fri_tx_model->insert($fri_tx)) {
				//记录日志
			}
		}else{
			$rd['errmsg'] = '网络错误';
		}
		echo json_encode($rd);
	}

	/**
	 * 拒绝添加好友
	 */
	public function rejectFriendApply () {
		$rd = array('status'=>-1);
		$id = $this->input->post('id');
		$this->load->model('Friend_apply_model', '', true);
		$apply = $this->Friend_apply_model->get($id);
		$this->Friend_apply_model->update(array('fri_apply_state'=>3), $id);
		//生成提醒消息
		$user = $this->session->USER;
		$fri_tx['fri_user_id'] = $apply['from_user_id'];
		$fri_tx['review_pic'] = $user['user_icon'];
		$fri_tx['review_nick'] = $user['user_nick'];
		$fri_tx['fri_tx_content'] = "{$user['user_nick']},拒绝把你加为好友";
        $fri_tx['fri_tx_addtime'] = date("Y-m-d H:i:s");
		$this->load->model('Fri_tx_model', '', true);
		if ($this->Fri_tx_model->insert($fri_tx)) {
			//记录日志
		}
		$rd['status'] = 1;
		echo json_encode($rd);
	}

	/**
	 * 添加、创建分组
	 */
	public function addGroup () {
		$rd = array('status'=>-1);
		$user = $this->session->USER;
		$data['user_id'] = $user['user_id'];
		$data['friend_group_name'] = $this->input->post('friend_group_name', TRUE);
		$this->load->model('Friend_group_model', '', true);
		$rs = $this->Friend_group_model->insert($data);
		if ($rs) {
			$rd['status'] = 1;
			$rd['data']['group_id'] = $rs;
		}else{
			$rd['status'] = -2;
			$rd['errmsg'] = '网络错误';
		}
		echo json_encode($rd);
	}

	/**
	 * 修改分组
	 */
	public function alterGroup () {
		$rd = array('status'=>-1);
		$user = $this->session->USER;
		$this->load->model('Friend_group_model', '', true);
		//验证分组是否属于你
		if ($this->Friend_group_model->isMyGroup($this->input->post('group_id', TRUE))) {
			$where = (int)$this->input->post('group_id', TRUE);
			$data['friend_group_name'] = $this->input->post('friend_group_name', TRUE);
			$rs = $this->Friend_group_model->update($data, $where);
			if ($rs!==false) {
				$rd['status'] = 1;
			}else{
				$rd['status'] = -2;
				$rd['errmsg'] = '网络错误';
			}
		}else{
			$rd['status'] = -3;
			$rd['errmsg'] = '权限错误';
		}
		echo json_encode($rd);
	}

	/**
	 * 删除分组
	 */
	public function delGroup () {
		$rd = array('status'=>-1);
		$user = $this->session->USER;
		$this->load->model('Friend_group_model', '', true);
		//验证分组是否属于你
		if ($this->Friend_group_model->isMyGroup($this->input->post('group_id', TRUE))) {
			$where = (int)$this->input->post('group_id', TRUE);
			$rs = $this->Friend_group_model->delete($where);
			if ($rs) {
				$rd['status'] = 1;
			}else{
				$rd['status'] = -2;
				$rd['errmsg'] = '网络错误';
			}
		}else{
			$rd['status'] = -3;
			$rd['errmsg'] = '权限错误';
		}
		echo json_encode($rd);
	}

	/**
	 * 获取自己的分组信息
	 */
	public function getFriendGroup () {
		$rd = array('status'=>-1);
		$user = $this->session->USER;
		$where['user_id'] = $user['user_id'];
		$this->load->model('Friend_group_model', '', true);
		$rs = $this->Friend_group_model->get($where);
		if ($rs) {
			$rd['status'] = 1;
			$rd['data'] = $rs;
		}else{
			$rd['errmsg'] = '网络错误';
		}
		echo json_encode($rd);
	}

	/**
	 * 动态评论 或者回复 添加
	 */
	public function commentAdd () {
		$rd = array('status'=>-1);
		$user = $this->session->USER;
		$this->load->model('Friend_model', '', true);
		$this->load->model('Fri_tx_model', '', true);
		$to_comment_user_id = (int)$this->input->post('to_comment_user_id', TRUE);
		//验证该说说所有者跟评论者是否是好友
		if ( $this->Friend_model->isFriend()) {
			$data['comment_user_id'] = $user['user_id'];
			$data['comment_user_name'] = $user['user_name'];
			$data['comment_user_icon'] = $user['user_icon'];
			$data['app_type'] = 3;	//动态
			$data['app_id'] = $this->input->post('app_id', TRUE);
			//被评论者的user_id
			$data['to_comment_user_id'] = (int)$this->input->post('to_comment_user_id');
			$data['comment_content'] = $this->input->post('comment_content', TRUE);
			if ($this->input->post('parent_comment_id', TRUE)!='') $data['parent_comment_id'] = (int)$this->input->post('parent_comment_id', TRUE);
			$this->load->model('Comment_model', '', true);
			if ($this->Comment_model->insert($data)) {
				$rd['status'] = 1;
				//生成提醒消息
				$this->Fri_tx_model->build_comment_tx($data['to_comment_user_id']);
			}else{
				$rd['errmsg'] = '网络错误';
			}
		}else{
			$rd['status'] = -3;
			$rd['errmsg'] = '非好友不能评论';
		}
		echo json_encode($rd);
	}

	/**
	 * 删除评论或者回复
	 */
	public function commentDel () {
		$rd = array('status'=>-1);
		$user = $this->session->USER;
		$this->load->model('Friend_model', '', true);
		$this->load->model('Comment_model', '', true);
		$id = (int)$this->input->post('comment_id', TRUE);
		//验证该评论者是否属于自己
		if ($this->Comment_model->isMyComment($id)) {
			if ($this->Comment_model->delete($id)) {
				$rd['status'] = 1;
			}else{
				$rd['errmsg'] = '网络错误';
			}
		}else{
			$rd['status'] = -3;
			$rd['errmsg'] = '你没有权限';
		}
		echo json_encode($rd);
	}

	/**
	 * 创建相册
	 */
	public function addAlbum () {
		$rd = array('status'=>-1);
		$user = $this->session->USER;
		$this->load->model('Album_model', '', true);
		$data['user_id'] = $user['user_id'];
		$data['album_name'] = $this->input->post('album_name', TRUE);
		$data['album_desc'] = $this->input->post('album_desc', TRUE);
		$data['album_isshow'] = $this->input->post('album_isshow', TRUE);
		if ($this->input->post('album_head', TRUE)!='') $data['album_head'] = $this->input->post('album_head', TRUE);
		$data['album_addtime'] = date('Y-m-d H:i:s');
		$data['album_modtime'] = $data['album_addtime'];
		$rs = $this->Album_model->insert($data);
		if ($rs) {
			$rd['status'] = 1;
			$rd['data']['album_id'] = $rs;
		}else{
			$rd['status'] = '网络错误';
			//$rd['status'] = -2;
		}
		echo json_encode($rd);
	}

	/**
	 * 修改相册
	 */
	public function alterAlbum () {
		$rd = array('status'=>-1);
		$user = $this->session->USER;
		$album_id = (int)$this->input->post('album_id', TRUE);
		$this->load->model('Album_model', '', true);
		//验证相册是否属于自己
		if($this->Album_model->isMyAlbum($album_id, $user['user_id'])) {
			$data['user_id'] = $user['user_id'];
			$data['album_name'] = $this->input->post('album_name', TRUE);
			$data['album_desc'] = $this->input->post('album_desc', TRUE);
			$data['album_isshow'] = $this->input->post('album_isshow', TRUE);
			if ($this->input->post('album_head', TRUE)!='') $data['album_head'] = $this->input->post('album_head', TRUE);
			$data['album_modtime'] = date('Y-m-d H:i:s');
			$rs = $this->Album_model->update($data, $album_id);
			if ($rs!==false) {
				$rd['status'] = 1;
			}else{
				$rd['status'] = '网络错误';
				//$rd['status'] = -2;
			}
		}
		echo json_encode($rd);
	}

	/**
	 * 根据id获取相册信息
	 */
	public function getAlbumInfo () {
		$rd = array('status'=>-1);
		$user = $this->session->USER;
		$album_id = (int)$this->input->post('album_id', TRUE);
		$this->load->model('Album_model', '', true);
		if ($this->Album_model->isMyAlbum($album_id, $user['user_id']) ){
			//$select = 'album_id,album_name,album_desc,album_isshow,album_head';
			$rs = $this->Album_model->get($album_id);
			if ($rs) {
				$rd['status'] = 1;
				$rd['data'] = $rs;
			}else{
				$rd['errmsg'] = '网络错误';
			}
		}
		echo json_encode($rd);	
	}

	/**
	 * 删除相册
	 */
	public function delAlbum () {
		$rd = array('status'=>-1);
		$user = $this->session->USER;
		$album_id = (int)$this->input->post('album_id', TRUE);
		$this->load->model('Album_model', '', true);
		//验证相册是否属于自己
		if($this->Album_model->isMyAlbum($album_id, $user['user_id'])) {
			$rs = $this->Album_model->delete($album_id);
			if ($rs) {
				$rd['status'] = 1;
			}else{
				$rd['status'] = '网络错误';
				//$rd['status'] = -2;
			}
		}
		echo json_encode($rd);
	}

	/**
	 * 获取相册对应的照片
	 */
	public function getPhotoByAlbum () {
		$rd = array('status'=>-1);
		$user = $this->session->USER;
		$album_id = (int)$this->input->post('album_id', TRUE);
	}
	/**
	 * test
	 */
	public function test (){
		$this->load->view('test');
	}

	/**
	 * 处理上传投降
	 */
	public function uploadIcon () {
		$rd = array('status'=>-1);
        $config['upload_path'] = './uploads/icon/temp/';
        $config['allowed_types'] = 'gif|jpg|png';
        //$config['max_size']  = '100';
        //$config['file_name'] = 'alipayQRcode';
        //$config['overwrite'] = true;
        //$config['max_width']  = '1024';
        //$config['max_height']  = '768';
        $config['max_size'] = 1024*2;
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('file')){
            $error = array('error' => $this->upload->display_errors());
            $rd['status'] = -2; //上传失败
            $rd['info'] = $error['error'];
        }
        else{
            $upload_data = $this->upload->data();
            $data = array('path'=>base_url().'uploads/icon/temp/'.$upload_data['file_name']);
            //var_dump($upload_data);
            $data['w'] = $upload_data['image_width'];
            $data['h'] = $upload_data['image_height'];
            $data['source'] = $upload_data['full_path'];
            $data['file_name'] = $upload_data['file_name'];
            $rd['status'] = 1;
            $rd['info'] = '上传成功';
            $rd['data'] = $data;
        }
        echo json_encode ($rd);
	}

	/**
	 * 裁剪头像
	 */
	public function cropIcon () {
		$rd['status'] = -1;
		$file_name = $this->input->post('file_name');
		//$source = $this->input->post('source');
		$source = './uploads/icon/temp/'.$file_name;
		$x = $this->input->post('x');
		$y = $this->input->post('y');
		$w = $this->input->post('w');
		$h = $this->input->post('h');
		//$new_image = './uploads/icon/'.$user['user_id'];//str_replace('/temp', '', $source);
		$new_image = str_replace('/temp', '', $source);
		//获取图片信息
		$tpm = getimagesize($source);
		$imgInfo['w'] = $tpm[0];
		$imgInfo['h'] = $tpm[1];
		$imgInfo['type'] = $tpm[2];
		if ( ($x+$w) > $imgInfo['w'] | ($y+$h) > $imgInfo['h'] ) {
			//裁剪超出范围
			$rd['status'] = -2;
			$rd['errmsg'] = '超出裁剪范围';
		}else{
			$back = '';
			switch ($imgInfo['type']) {
				case '1':			//gif
					$back = imagecreatefromgif($source);
					break;			//jpg
				case '2':
					$back = imagecreatefromjpeg($source);
					break;
				case '3':			//png
					$back = imagecreatefrompng($source);
					break;
				default:
					# code...
					break;
			}
			$cutimg = imagecreatetruecolor($w, $h);
			/** 用imagecopyresampled() 函数进行裁剪 */
			imagecopyresampled($cutimg, $back, 0, 0, $x, $y, $w, $h, $w, $h);
			imagedestroy($back);
			switch ($imgInfo['type']) {
				case '1':
					$result = imagegif($cutimg,$new_image);
					break;
				case '2':
					$result = imagejpeg($cutimg,$new_image);
					break;
				case '3':
					$result = imagepng($cutimg,$new_image);
					break;
			}
			imagedestroy($cutimg);
			
			$icon = base_url().'uploads/icon/'.$file_name;
			//裁剪的图片放数据库
			$user = $this->session->USER;
			$this->load->model('User_model', '', true);
			$rs = $this->User_model->update(array('user_icon'=>$icon), $user['user_id']);
			if ($rs!==false) {
				$rd['status'] = 1;
				//删除图片
				unlink($source);
			}else{
				$rd['errmsg'] = '网络错误';
			}
			//echo $new_image;
		}
		echo json_encode($rd);
/*		$config['image_library'] = 'GD2';
		$config['source_image'] = $this->input->post('source');
		//$config['width'] = 100;//$this->input->post('w');
		//$config['height'] = 100;$this->input->post('h');
		$config['x_axis'] = 100;//$this->input->post('x');
		$config['y_axis'] = $this->input->post('y');
		$config['new_image'] = './uploads/icon/';
		$this->load->library('image_lib');
		$this->image_lib->initialize($config);
		if ( $this->image_lib->crop() ){
			$data['photo_thumb'] = $config['new_image'];
		}else{
			$rd['errmsg'] = $this->image_lib->display_errors();
		}*/
	}

	/**
	 * 上传照片 处理多图上传
	 */
	public function uploadPhoto () {
		$rd = array('status'=>-1);
		$user = $this->session->USER;
		$config['upload_path'] = './uploads/photo/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']  = '2048';
		//$config['max_width']  = '1024';
		//$config['max_height']  = '768';
		$data['user_id'] = $user['user_id'];
		$data['album_id'] = (int)$this->input->post_get('album_id', TRUE);
		if ($data['album_id']=='') {
			$rd['status'] = -4;
			$rd['errmsg'] = '请选择相册';
			die(json_encode($rd));
		}
		//检查相册是否属于自己
		$this->load->model('Album_model', '', true);
		$this->load->model('Photo_model', '', true);
		if ($this->Album_model->isMyAlbum($data['album_id'],$user['user_id'])){
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('file')){
				$error = array('error' => $this->upload->display_errors());
				$rd['errmsg'] = $error['error'];
				//var_dump($error);
			}
			else{
				$upload_data = $this->upload->data();

				if (isset($upload_data[0])){
					$return = true;
					$this->load->library('image_lib');
					foreach ($upload_data as $k=>$v){
						/** 生成缩略图 */
						$config = array();
						$config['image_library'] = 'gd2';
						$config['source_image'] = $v['full_path'];
						//$config['create_thumb'] = TRUE;
						$config['maintain_ratio'] = TRUE;
						$config['width']     = 267;
						$config['height']   = 200;
						$config['new_image'] = $v['file_path'].'photo_thumb/'.$v['file_name'];
						//$config['dynamic_output'] = true;
						$this->image_lib->initialize($config);
						

						if ( $this->image_lib->resize() ){
							$data['photo_thumb'] = $config['new_image'];
						}else{
							$rd['errmsg'] = $this->image_lib->display_errors();
						}
						$data['photo_path'] = $v['full_path'];
						$data['photo_name'] = $v['client_name'];
						$data['photo_addtime'] = date("Y-m-d h:i:s");
						$rs = $this->Photo_model->insert($data);
						if (!$rs){
							$return = false;
						}
					}
					if ($return){
						$rd['status'] = 1;
						$this->Album_model->update(array('album_modtime'=>date("Y-m-d h:i:s")), $data['album_id']);
					}else{
						$rd['status'] = -2;
						$rd['errmsg'] = '有图片插入失败';
					}
				}else{
					/** 生成缩略图 */
					$this->load->library('image_lib');
					$config = array();
					$config['image_library'] = 'gd2';
					$config['source_image'] = $upload_data['full_path'];
						//$config['create_thumb'] = TRUE;
					$config['maintain_ratio'] = TRUE;
					$config['width']     = 267;
					$config['height']   = 200;
					$config['new_image'] = $upload_data['file_path'].'photo_thumb/'.$upload_data['file_name'];
						//$config['dynamic_output'] = true;
					$this->image_lib->initialize($config);


					if ( $this->image_lib->resize() ){
						$data['photo_thumb'] = $config['new_image'];
					}else{
						$rd['errmsg'] = $this->image_lib->display_errors();
					}
					$data['photo_path'] = $upload_data['full_path'];
					$data['photo_name'] = $upload_data['client_name'];
					$data['photo_addtime'] = date("Y-m-d h:i:s");
					$rs = $this->Photo_model->insert($data);
					if ($rs){
						$rd['status'] = 1;
						$this->Album_model->update(array('album_modtime'=>date("Y-m-d h:i:s")), $data['album_id']);
					}else{
						$rd['status'] = -3;
						$rd['errmsg'] = '网络错误';
					}
				}
				
			}	
		}else{
			$rd['status'] = -4;
			$rd['errmsg'] = '不是你的相册';
		}
		echo json_encode($rd);
		
	}

	/**
	 * 改修照片名字
	 */
	public function alterImgName () {
		$rd = array('status'=>-1);
		$user = $this->session->USER;
		$photo_id = (int)$this->input->post('img_id', TRUE);
		$img_name = $this->input->post('img_name');
		$this->load->model('Photo_model', '', true);
		//检查照片是否是自己的
		if ($this->Photo_model->isMyPhoto($photo_id, $user['user_id']) ) {
			$rs = $this->Photo_model->update(array('photo_name'=>$img_name), $photo_id);
			if ($rs!==false){
				$rd['status'] = 1;
			}else{
				$rd['status'] = -3;
				$rd['errmsg'] = '网络错误';
			}
		}else{
			$rd['status'] = -4;
			$rd['errmsg'] = '权限错误';
		}
		echo json_encode($rd);
	}

	/**
	 * 设为封面
	 */
	public function setAlbumCover() {
		$rd = array('status'=>-1);
		$user = $this->session->USER;
		$photo_id = (int)$this->input->post('img_id', TRUE);
		$this->load->model('Photo_model', '', true);
		$this->load->model('Album_model', '', true);
		$photo = $this->Photo_model->get($photo_id);
		//检查照片是否是自己的
		if ( $photo['user_id']==$user['user_id'] ) {
			$rs = $this->Album_model->update(array('album_head'=>$photo_id),$photo['album_id']);
			if ($rs!==false) {
				$rd['status'] = 1;
			}else{
				$rd['status'] = -2;
				$rd['errmsg'] = '网络错误';
			}
		}else{
			$rd['status'] = -3;
			$rd['errmsg'] = '不是你的照片';
		}
		echo  json_encode($rd);
	}

	/**
	 * 删除照片
	 */
	public function delPhoto () {
		$rd = array('status'=>-1);
		$user = $this->session->USER;
		$photo_id = (int)$this->input->post('photo_id', TRUE);
		$this->load->model('Photo_model', '', true);
		//获取照片信息
		$photo = $this->Photo_model->get($photo_id);
		if ($photo['user_id']!=$user['user_id']) {
			$rd['status'] = -4;
			$rd['errmsg'] = '不是你的照片';
			die(json_encode($rd));
		}
		if ($photo){
			//删除本地文件
			if (unlink($photo['photo_path']) ){
				if ($this->Photo_model->delete($photo_id)) {
					$rd['status'] = 1;
				}else{
					$rd['errmsg'] = '网络错误';
				}	
			}else{
				$rd['status'] = -2;
				$rd['errmsg'] = '删除本地文件失败';
			}
		}else{
			$rd['status'] = -3;
			$rd['errmsg'] = '照片不存在';
		}
		echo json_encode($rd);
	}

	//////////////////
	///  日志相关  ///
	/////////////////
	
	
	/**
	 * 获取日志分类
	 */
	public function getBlogType () {
		$rd = array('status'=>-1);
		$user = $this->session->USER;
		$this->load->model('Blog_type_model', '' ,true);
		$where['user_id'] = $user['user_id'];
		$rs = $this->Blog_type_model->get($where);
		if ($rs) {
			$rd['data'] = $rs;
		}else{
			$rd['status'] = -2;
			$rd['errmsg'] = '你还没有分类';
		}
		echo  json_encode($rd);
	}

	/**
	 * 添加日志分类
	 */
	public function addBlogType () {
		$rd = array('status'=>-1);
		$user = $this->session->USER;
		$data['user_id'] = $user['user_id'];
		$data['blog_type_name'] = $this->input->post('blog_type_name', TRUE);
		$this->checkEmpty($data, true);
		$this->load->model('Blog_type_model', '', true);
		$rs = $this->Blog_type_model->insert($data);
		if ($rs) {
			$rd['status'] = 1;
			$rd['data']['type_id'] = $rs;
		}else{
			$rd['errmsg'] = '网络错误';
		}
		echo json_encode($rd);
	}

	/**
	 * 日志类别修改
	 */
	public function alterBlogType () {
		$rd = array('status'=>-1);
		$user = $this->session->USER;
		$blog_type_id = (int)$this->input->post('type_id', TRUE);
		$this->load->model('Blog_type_model', '', TRUE);
		//检查分类是否属于自己
		if ($this->Blog_type_model->isMyBlogType($blog_type_id, $user['user_id'])) {
			$data['blog_type_name'] = $this->input->post('blog_type_name', TRUE);
			$rs = $this->Blog_type_model->update($data, $blog_type_id);
			if ($rs!==false) {
				$rd['status'] = 1;
			}else{
				$rd['errmsg'] = '网络错误';
			}
		} else {
			$rd['errmsg'] = '非法修改';
		}

		echo json_encode($rd);
	}

	/**
	 * 修改日志属于的类别
	 */
	public function alterBlogBelong() {
		$user = $this->session->USER;
		$this->load->model('Blog_model','',true);
		$bid = intval($this->input->post_get('id'));
		$tid = intval($this->input->post_get('blog_type_id'));
		if ($this->Blog_model->isMyBlog($bid, $user['user_id'])) {
			$rs = $this->Blog_model->update(array('blog_type_id'=>$tid),$bid);
			if ($rs!==false) {
				$rd['status'] = 1;
			}else{
				$rd['status'] = -2;
				$rd['errmsg'] = '网络错误';
			}
		}else{
			$rd['status'] = -3;
			$rd['errmsg'] = '权限错误';
		}
		echo json_encode($rd);
	}

	/**
	 * 日志类别删除
	 */
	public function delBlogType () {
		$rd = array('status'=>-1);
		$user = $this->session->USER;
		$blog_type_id = (int)$this->input->post('blog_id', TRUE);
		//验证日志类别是否属于自己
		$this->load->model('Blog_type_model', '', TRUE);
		if ($this->Blog_type_model->isMyBlogType($blog_type_id, $user['user_id'])) {
			$rs = $this->Blog_type_model->delete($blog_type_id);
			if ($rs) {
				$rd['status'] = 1;
			}else{
				$rd['errmsg'] = '网络错误';
			}
		}else{
			$rd['status'] = -3;
			$rd['errmsg'] = '没有权限';
		}
		echo json_encode($rd);
	}

	/**
	 * 日志保密程度修改
	 */
	public function alterBlogRank () {
		$rd = array('status'=>-1);
		$user = $this->session->USER;
		$blog_id = (int)$this->input->post('blog_id', TRUE);
		$this->load->model('Blog_model', '', true);
		if ($this->Blog_model->isMyBlog($blog_id, $user['user_id'])) {
			$data['blog_rank'] = $this->input->post('blog_rank');
			$rs = $this->Blog_model->update($data, $blog_id);
			if ($rs!==false) {
				$rd['status'] = 1;
			}else{
				$rd['errmsg'] = '网络错误';
			}
		}else{
			$rd['status'] = -2;
			$rd['errmsg'] = '权限错误';
		}
		echo json_encode($rd);
	}

	/**
	 * 设置为私密日志 $blog_rank = 3
	 */
	public function alterBlogRankTo3 () {
		$rd = array('status'=>-1);
		$user = $this->session->USER;
		$blog_id = (int)$this->input->post('blog_id', TRUE);
		$this->load->model('Blog_model', '', true);
		if ($this->Blog_model->isMyBlog($blog_id, $user['user_id'])) {
			$data['blog_rank'] = 3;
			$rs = $this->Blog_model->update($data, $blog_id);
			if ($rs!==false) {
				$rd['status'] = 1;
			}else{
				$rd['errmsg'] = '网络错误';
			}
		}else{
			$rd['status'] = -2;
			$rd['errmsg'] = '权限错误';
		}
		echo json_encode($rd);
	}

	/**
	 * 日志放入回收站
	 */
	public function toRecycle () {
		$rd = array('status'=>-1);
		$user = $this->session->USER;
		$blog_id = (int)$this->input->post('blog_id', TRUE);
		$this->load->model('Blog_model', '', true);
		if ($this->Blog_model->isMyBlog($blog_id, $user['user_id'])) {
			$data['blog_state'] = 2;
			$rs = $this->Blog_model->update($data, $blog_id);
			if ($rs!==false) {
				$rd['status'] = 1;
			}else{
				$rd['errmsg'] = '网络错误';
			}
		}else{
			$rd['status'] = -2;
			$rd['errmsg'] = '权限错误';
		}
	}

	/**
	 * 日志删除
	 */
	public function delBlog () {
		$rd = array('status'=>-1);
		$user = $this->session->USER;
		$blog_id = (int)$this->input->post('blog_id', TRUE);
		$this->load->model('Blog_model', '', true);
		if ($this->Blog_model->isMyBlog($blog_id, $user['user_id'])) {
			$rs = $this->Blog_model->delete($blog_id);
			if ($rs) {
				$rd['status'] = 1;
			}else{
				$rd['errmsg'] = '网络错误';
			}
		}else{
			$rd['status'] = -2;
			$rd['errmsg'] = '权限错误';
		}
		echo json_encode($rd);
	}

	/**
	 * 个人资料修改[没有头像]
	 */
	public function alterUserInfo () {
		$rd = array('status'=>-1);
		$user = $this->session->USER;
		//$data['user_nick'] = $this->input->post('user_nick', TRUE);
		$data['user_email'] = $this->input->post('user_email', TRUE);
		$data['user_sex'] = $this->input->post('user_sex', TRUE);
		$data['user_birth'] = $this->input->post('user_birth', TRUE);
		$data['user_star'] = $this->input->post('user_star', TRUE);
		$data['user_address'] = $this->input->post('user_address', TRUE);
		//$data['province_id'] = (int)$this->input->post('province_id', TRUE);
		//$data['city_id'] = (int)$this->input->post('city_id', TRUE);
		//$data['qu_id'] = (int)$this->input->post('qu_id', TRUE);
		$this->load->model('User_model', '', true);
		$rs = $this->User_model->update($data, $user['user_id']);
		if ($rs!==false) {
			$rd['status'] = 1;
		}else{
			$rd['status'] = -2;
			$rd['status'] = '网络错误';
		}
		echo json_encode($rd);
	}

	/**
	 * 钻石红包V3
	 */
	public function v3RedPacket () {
		$rd = array('status'=>-1);
		$user = $this->session->USER;
		//红包类型
		$red_packet_type = 4;
		$this->load->model('Red_packet_model', '', true);
		$this->load->model('User_model', '', true);
		$this->load->model('Vip_level_model', '', true);
		$this->load->model('Wallet_model', '', true);
		$user = $this->User_model->get($user['user_id']);
		if ($red_packet_type>$user['user_level']) {
			$rd['status'] = 2;	//VIP不够
			$rd['errmsg'] = '会员等级不够,请升级会员';
			echo json_encode($rd);
			die();
		}
		if ($user['user_level']==4){
			//检查发送的次数
			if ($user['can_send']==1){
				$rs = $this->Vip_level_model->get($red_packet_type);
				$wallet = $this->Wallet_model->get(array('user_id'=>$user['user_id']));
				if ($wallet['diamond']<$rs['red_packet_num']){
					$rd['status'] = -4;
					$rd['errmsg'] = '钻石不足,请充值';
					echo json_encode($rd);
					die();
				}
				$data['red_packet_type'] = $red_packet_type;
				$data['red_packet_num'] = $rs['red_packet_num'];
				$data['red_packet_from_user_id'] = $user['user_id'];
				$data['red_packet_addtime'] = date("Y-m-d h:i:s");
				$rs = $this->Red_packet_model->diamonRedPacket($data, $user['user_id']);
				if ($rs) {
					$rd['status'] = 1;
					$rd['data']['red_packet_id'] = $rs;
					//生成账单
					$this->load->model('Bill_model', '' ,true);
					$this->Bill_model->redPacketBill($data['red_packet_num'], 2);
				}else{
					$rd['status'] = -2;
					$rd['errmsg'] = '网络错误';
				}
			}else{
				$rd['status'] = -3;
				$rd['errmsg'] = '已经发过了';
			}
		}else{
			$rd['status'] = 3;	//VIP不够
			$rd['errmsg'] = '只有钻石会员,才能发该红包';
		}
		echo json_encode($rd);
	}

	/**
	 * 钻石红包V2
	 */
	public function v2RedPacket () {
		$rd = array('status'=>-1);
		$user = $this->session->USER;
		//红包类型
		$red_packet_type = 3;
		$this->load->model('Red_packet_model', '', true);
		$this->load->model('User_model', '', true);
		$this->load->model('Vip_level_model', '', true);
		$user = $this->User_model->get($user['user_id']);
		if ($red_packet_type>$user['user_level']) {
			$rd['status'] = 2;	//VIP不够
			$rd['errmsg'] = '会员等级不够,请升级会员';
			echo json_encode($rd);
			die();
		}
		
		if ($user['user_level']==$red_packet_type){
			//检查发送的次数
			if ($user['can_send']==1){
				$rs = $this->Vip_level_model->get($red_packet_type);
				$wallet = $this->Wallet_model->get(array('user_id'=>$user['user_id']));
				if ($wallet['diamond']<$rs['red_packet_num']){
					$rd['status'] = -4;
					$rd['errmsg'] = '钻石不足,请充值';
					echo json_encode($rd);
					die();
				}
				$data['red_packet_type'] = $red_packet_type;
				$data['red_packet_num'] = $rs['red_packet_num'];
				$data['red_packet_from_user_id'] = $user['user_id'];
				$data['red_packet_addtime'] = date("Y-m-d h:i:s");
				$rs = $this->Red_packet_model->diamonRedPacket($data, $user['user_id']);
				if ($rs) {
					$rd['status'] = 1;
					$rd['data']['red_packet_id'] = $rs;
					//生成账单
					$this->load->model('Bill_model', '' ,true);
					$this->Bill_model->redPacketBill($data['red_packet_num'], 2);
				}else{
					$rd['status'] = -2;
					$rd['errmsg'] = '网络错误';
				}
			}
		}else{
			$rd['status'] = 3;	//VIP不够
			$rd['errmsg'] = '只有黄金会员,才能发该红包';
		}
		echo json_encode($rd);
	}

	/**
	 * 钻石红包V1
	 */
	public function v1RedPacket () {
		$rd = array('status'=>-1);
		$user = $this->session->USER;
		//红包类型
		$red_packet_type = 2;
		$this->load->model('Red_packet_model', '', true);
		$this->load->model('User_model', '', true);
		$this->load->model('Vip_level_model', '', true);
		$user = $this->User_model->get($user['user_id']);
		if ($red_packet_type>$user['user_level']) {
			$rd['status'] = 2;	//VIP不够
			$rd['errmsg'] = '会员等级不够,请升级会员';
			echo json_encode($rd);
			die();
		}
		if ($user['user_level']==$red_packet_type){
			//检查发送的次数
			if ($user['can_send']==1){
				$rs = $this->Vip_level_model->get($red_packet_type);
				$wallet = $this->Wallet_model->get(array('user_id'=>$user['user_id']));
				if ($wallet['diamond']<$rs['red_packet_num']){
					$rd['status'] = -4;
					$rd['errmsg'] = '钻石不足,请充值';
					echo json_encode($rd);
					die();
				}
				$data['red_packet_type'] = $red_packet_type;
				$data['red_packet_num'] = $rs['red_packet_num'];
				$data['red_packet_from_user_id'] = $user['user_id'];
				$data['red_packet_addtime'] = date("Y-m-d h:i:s");
				$rs = $this->Red_packet_model->diamonRedPacket($data, $user['user_id']);
				if ($rs) {
					$rd['status'] = 1;
					$rd['data']['red_packet_id'] = $rs;
					//生成账单
					$this->load->model('Bill_model', '' ,true);
					$this->Bill_model->redPacketBill($data['red_packet_num'], 2);
				}else{
					$rd['status'] = -2;
					$rd['errmsg'] = '网络错误';
				}
			}
		}else{
			$rd['status'] = 3;	//VIP不够
			$rd['errmsg'] = '只有普通会员才能发该红包';
		}
		echo json_encode($rd);
	}



	/**
	 * 发红包
	 */
	public function pointRedPacket () {
		$rd = array('status'=>-1);
		$user = $this->session->USER;
		//红包类型
		$this->load->model('Red_packet_model', '', true);
		$this->load->model('User_model', '', true);
		$this->load->model('Wallet_model', '', true);
		$this->load->model('Config_model', '', true);
		$pointNum = $this->Config_model->getValue('pointNum');
		$wallet = $this->Wallet_model->get(array('user_id'=>$user['user_id']));
		$user = $this->User_model->get($user['user_id']);
		//校验当前用户是否有权限发当前红包已经是否能发
		if ($pointNum<=$wallet['point']){

			$data['red_packet_type'] = 1;
			$data['red_packet_num'] = $pointNum;
			$data['red_packet_from_user_id'] = $user['user_id'];
			$data['red_packet_addtime'] = date("Y-m-d h:i:s");
			$rs = $this->Red_packet_model->pointRedPacket($data);
			if ($rs) {
				$rd['status'] = 1;
				$rd['data']['red_packet_id'] = $rs;
				//生成账单
				$this->load->model('Bill_model', '' ,true);
				$this->Bill_model->redPacketBill($data['red_packet_num'], 3);
			}else{
				$rd['status'] = -2;
				$rd['errmsg'] = '网络错误';
			}
		}else{
			$rd['status'] = -3;
			$rd['errmsg'] = '积分不足';
		}
		echo json_encode($rd);
	}

	/*--------------------------------------------------
			钱包相关
	---------------------------------------------------*/
	/**
     * b币换钻石 10b币=1钻石=1元 兑换钻石
     */
    public function BIconToDiamond () {
    	$rd = array('status'=>-1);
		$user = $this->session->USER;
		$diamond = $this->input->post('diamond', TRUE);
		$this->load->model('Wallet_model', '', true);
		$this->load->model('Config_model', '', true);
		$rant = $this->Config_model->getValue('bdrant');
		$wallet = $this->Wallet_model->get(array('user_id'=>$user['user_id']));
		if ($diamond<=0){
			die('{"status":-2,"errmsg":"钻石必须大于零"}');
		}
		$b_icon = $diamond*$rant;
		//检查当前用户是否还有这么多b_icon
		if ($wallet['b_icon']>=$b_icon) {
			$data['b_icon'] = $wallet['b_icon']-$b_icon;
			$data['diamond'] = $wallet['diamond']+$diamond;
			$where['user_id'] = $user['user_id'];
			$rs = $this->Wallet_model->update($data, $where);
			if ($rs!==false) {
				$rd['status'] = 1;
			}else{
				$rd['status'] = -2;
				$rd['errmsg'] = '网络错误';
			}
		}else{
			$rd['status'] = -3;
			$rd['errmsg'] = 'b币不足';
		}
		echo json_encode($rd);
    }

    /**
     * 钻石换b币 1b币=1*rant 兑换B币
     */
    public function DiamondToBIcon () {
    	$rd = array('status'=>-1);
		$user = $this->session->USER;
		$this->load->model('Wallet_model', '', true);
		$this->load->model('Config_model', '', true);
		$rant = $this->Config_model->getValue('bdrant');
		$wallet = $this->Wallet_model->get(array('user_id'=>$user['user_id']));
		$b_icon = $this->input->post('b_icon', TRUE);
		if ($b_icon<=0){
			die('{"status":-2,"errmsg":"必须大于零"}');
		}
		$diamond = $b_icon/$rant;
		//检查当前用户是否还有这么多diamond
		if ($wallet['diamond']>=$diamond) {
			$data['b_icon'] = $wallet['b_icon']+$b_icon;
			$data['diamond'] = $wallet['diamond']-$diamond;
			$where['user_id'] = $user['user_id'];
			$rs = $this->Wallet_model->update($data, $where);
			if ($rs!==false) {
				$rd['status'] = 1;
			}else{
				$rd['status'] = -2;
				$rd['errmsg'] = '网络错误';
			}
		}else{
			$rd['status'] = -3;
			$rd['errmsg'] = '钻石不足';
		}
		echo json_encode($rd);
    }

    /**
     * b币提现
     */
    public function BIconToCash () {
    	$user = $this->session->USER;
    	$this->load->model('Fri_tx_model', '', true);
    	$this->load->model('Wallet_model', '', true);
    	$rd = $this->Wallet_model->toCash();
    		//生成提醒信息
    	if ($rd['status']==1){
    		$user = $this->session->USER;
    		$fri_tx['fri_user_id'] = $user['user_id'];
    		$fri_tx['fri_tx_content'] = "{$user['user_nick']},你的提现申请提交成功";
    		$fri_tx['fri_tx_type'] = 3;
    		$this->Fri_tx_model->build_sys_pri_tx($fri_tx);
    	}

    	echo json_encode($rd);
    }

	/**
	 * 充值
	 */
	/*-----------------------------------------------------
			会员升级相关
	------------------------------------------------------*/
	/**
	 * 会员升级
	 */
	public function levelUp () {
		$rd = array('status'=>-1);
		$user = $this->session->USER;
		$this->load->model('User_model', '', true);
		$this->load->model('Wallet_model', '', true);
		$this->load->model('Vip_level_model', '', true);
		$user = $this->User_model->get($user['user_id']);
		$to_level = (int)$this->input->post('to_level', TRUE);
		if ($to_level>4) die('{"status":-2,"errmsg":"错误"}');
		//if ($to_level>) die('{"status":-2,"errmsg":"错误"}');
		$user_info = $user;
		//$user_info = $this->User_model->canLevelUp($to_level, $user['user_id']);
		if ($user['user_level']<$to_level){
			if ($user_info['user_level']+3==$to_level) {
				$level_need = $this->Vip_level_model->getNeed($to_level-2);
				$level_need = $level_need+$this->Vip_level_model->getNeed($to_level-1);
				$level_need = $level_need+$this->Vip_level_model->getNeed($to_level);
			}else if ($user_info['user_level']+2==$to_level){
				$level_need = $this->Vip_level_model->getNeed($to_level-1);
				$level_need = $level_need+$this->Vip_level_model->getNeed($to_level);
			}else{
				$level_need = $this->Vip_level_model->getNeed($to_level);
			}
			//检查升级所用b币够不够
			if ($this->Wallet_model->hasBIcon($level_need, $user['user_id'])) {
				$rd = $this->User_model->vipLevelUp($to_level, $level_need);
				//生成账单
				$this->load->model('Bill_model', '' ,true);
				$bill_data['bill_type'] = 6;
				$bill_data['bill_currency'] = 2;
				$bill_data['transfer_frome_user_id'] = $user['user_id']; 
				$bill_data['transfer_to_user_id'] = 0;
				$bill_data['bill_amount'] = $level_need;
				$bill_data['bill_addtime'] = date("Y-m-d h:i:s");
				$bill_data['bill_remark'] = "昵称：{$user_nick},手机：{$user['user_mobile']}于{$data['bill_addtime']}，开通/升级会员,花费{$billdata['bill_amount']}钻石";
				$this->Bill_model->insert($bill_data);
			}else{
				$rd['status'] = -4;
				$rd['errmsg'] = '余额不足';
			}
		}else{
			$rd['status'] = -5;
			$rd['errmsg'] = '你已经是钻石会员了';
		}
		echo json_encode($rd);
	}


	/**
	 * 充值钻石
	 */
	public function topUp () {
		$rd = array('status'=>-1);
		$user = $this->session->USER;
		$data['topup_type'] = (int)$this->input->post('topup_type', TRUE);
		$data['money'] = $this->input->post('money', TRUE);
		$data['mobile'] = $this->input->post('mobile', TRUE);
		$data['topup_addtime'] = date("Y-m-d h:i:s");
		if ($data['topup_type']==1){	//支付宝
			$data['alipay'] = $this->input->post('alipay', TRUE);
		}else{
			$data['remit_name'] = $this->input->post('remit_name', TRUE);
		}
		$data['user_id'] = $user['user_id'];
		$this->checkEmpty($data, true);
		$this->load->model('Topup_model', '',true);
		if ($this->Topup_model->insert($data)) {
			$rd['status'] = 1;
			
		}else{
			$rd['status'] = -2;
			$rd['errmsg'] = '网络错误';
		}
		echo json_encode($rd);
	}

	/*--------------------------------------------------------
			设置
	----------------------------------------------------------*/
	/**
	 * 修改密码
	 */
	public function alterPass () {
		$this->load->model('User_model', '', true);
		$rs = $this->User_model->alterPass();
		echo json_encode($rs);
	}
	/**
	 * 设置银行卡
	 */
	public function bindingBank(){
		$rd = array('status'=>-1);
		$user = $this->session->USER;
		$this->load->model('Bank_model', '', true);
		$data['user_id'] = $user['user_id'];
		//$data['user_name'] = $user['user_nick'];
		$data['bank_no'] = $this->input->post('card', TRUE);
		$data['bank_name'] = $this->input->post('bank_name', TRUE);
		$data['bank_user_name'] = $this->input->post('truename', TRUE);
		if ($data['bank_user_name']==''){
			$rd['status'] = -4;
			$rd['errmsg'] = '开户名不能为空';
			die(json_encode($rd));
		}
		if ($data['bank_name']==''){
			$rd['status'] = -5;
			$rd['errmsg'] = '开户银行不能为空';
			die(json_encode($rd));
		}

		if (!preg_match('/^(\d{16}|\d{19})$/', $data['bank_no'])) {
			$rd['status'] = -3;
			$rd['errmsg'] = '你输入的银行卡号不正确,请检查';
			die(json_encode($rd));
		}
		$data['bank_addtime'] = date("Y-m-d h:i:s");
		$where = array('user_id'=>$user['user_id']);
		if ( $this->Bank_model->get($where) ){
			$rs = $this->Bank_model->update($data, $where);
			if ($rs!==false) {
				$rd['status'] = 1;
			}else{
				$rd['status'] = -2;
				$rd['errmsg'] = '网络错误';
			}
		}else{
			if ($this->Bank_model->insert($data)) {
				$rd['status'] = 1;
			}else{
				$rd['status'] = -2;
				$rd['errmsg'] = '网络错误';
			}
		}
		
		echo json_encode($rd);
	}

	/**
	 * 搜索好友
	 */
	public function searchFriend () {
		$this->load->model('Friend_model', '', TRUE);
		$this->Friend_model->searchFriend();
	}


	/**
	 * 打招呼
	 */
	public function addHi () {
		$user = $this->session->USER;
		$this->load->model('Hi_model', '', true);
		$data['hi_from_user_id'] = $user['user_id'];
		$data['hi_to_user_id'] = $this->input->post('to_user_id');
		$data['hi_content'] = $this->input->post('hi_content');
		$rs = $this->Hi_model->insert($data);
		if ($rs) {
			$rd['status'] = 1;
			$rd['data']['hi_id'] = $rs;
		}else{
			$rd['errmsg'] = '网络错误';
		}
		echo json_encode($rd);
	}

	/**
	 * 直接修改好友分组
	 */
	public function changeToGroup () {
		$rd['status'] = -1;
		$user = $this->session->USER;
		$toGroup = intval($this->input->post_get('group_id'));
		$cuid = intval($this->input->post_get('fid'));
		$this->load->model('Friend_model','',true);
		if ($this->Friend_model->isFriend($cuid, $user['user_id'])){
			$this->load->model('Friend_group_model','',true);
			$up['friend_group_id'] = $toGroup;
			$where['fri_user_id'] = $user['user_id'];
			$where['friend_user_id'] = $cuid;
			$rs = $this->Friend_model->update($up, $where);
			if ($rs!==false){
				$rd['status'] = 1;
			}else{
				$rd['status'] = -2;
				$rd['errmsg'] = '网络错误';
			}
		}else{
			$rd['errmsg'] = '权限错误';
		}
		echo  json_encode($rd);
	}

	/**
	 * 删除好友
	 */
	public function delFriend () {
		$id = $this->input->post('fid');
		$user = $this->session->USER;
		$this->load->model('Friend_model', '', true);
		if ($this->Friend_model->isFriend($id, $user['user_id'])) {
			$rs1 = $this->Friend_model->delete(array('friend_user_id'=>$id, 'fri_user_id'=>$user['user_id']));
			$rs2 = $this->Friend_model->delete(array('friend_user_id'=>$user['user_id'], 'fri_user_id'=>$id));
			if ($rs1 && $rs2){
				$rd['status'] = 1;
			}else{
				$rd['status'] = -2;
				$rd['errmsg'] = '网络错误';
			}
		}else{
			$rd['status'] = -3;
			$rd['errmsg'] = '错误,不是你的好友';
		}
		echo json_encode($rd);
	}

	/**
	 * 可能认识的人
	 */
	public function mayFriends () {
		$this->load->model('User_model', '', true);
		$this->User_model->maybeFriend();
	}

	/**
	 * 我的度友
	 */
	public function myDuFriend () {
		$this->load->model('User_model','',TRUE);
		$rs = $this->User_model->myDuFriend();
		echo json_encode($rs);
	}

	/**
	 * 首页说说数据异步加载
	 */
	public function refreshDynamics(){
		$user = $this->session->USER;
		$this->load->model('Trends_model','', true);
        $this->Trends_model->getTrandes($user['user_id']);
	}

	////////////
	// 页面加载相关 //
	////////////





}
