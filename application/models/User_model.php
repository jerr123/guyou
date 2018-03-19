<?php

class User_model extends CI_Model {
	

	 /**
     * @name string TABLE_NAME Holds the name of the table in use by this model
     */
    const TABLE_NAME = 'user';

    /**
     * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
     */
    const PRI_INDEX = 'user_id';

    /**
     * 表前缀
     */
    //const PRIFIX = $db['default']['dbprefix'];

    /**
     * Retrieves record(s) from the database
     *
     * @param mixed $where Optional. Retrieves only the records matching given criteria, or all records if not given.
     *                      If associative array is given, it should fit field_name=>value pattern.
     *                      If string, value will be used to match against PRI_INDEX
     * @return mixed Single record if ID is given, or array of results
     */
    public function get($where = NULL, $select = NULL) {
        if ($select !== NULL) {
        	$this->db->select($select);
        }else{
        	$this->db->select('*');	
        }
        $this->db->from(self::TABLE_NAME);
        if ($where !== NULL) {
            if (is_array($where)) {
                foreach ($where as $field=>$value) {
                    $this->db->where($field, $value);
                }
            } else {
                $this->db->where(self::PRI_INDEX, $where);
            }
        }
        $result = $this->db->get()->result_array();
        if ($result) {
            if ($where !== NULL) {
                return array_shift($result);
            } else {
                return $result;
            }
        } else {
            return false;
        }
    }

    /**
     * Inserts new data into database
     *
     * @param Array $data Associative array with field_name=>value pattern to be inserted into database
     * @return mixed Inserted row ID, or false if error occured
     */
    public function insert(Array $data) {
        if ($this->db->insert(self::TABLE_NAME, $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    /**
     * Updates selected record in the database
     *
     * @param Array $data Associative array field_name=>value to be updated
     * @param Array $where Optional. Associative array field_name=>value, for where condition. If specified, $id is not used
     * @return int Number of affected rows by the update query
     */
    public function update(Array $data, $where = array()) {
            if (!is_array($where)) {
                $where = array(self::PRI_INDEX => $where);
            }
        $this->db->update(self::TABLE_NAME, $data, $where);
        return $this->db->affected_rows();
    }

    /**
     * Deletes specified record from the database
     *
     * @param Array $where Optional. Associative array field_name=>value, for where condition. If specified, $id is not used
     * @return int Number of rows affected by the delete query
     */
    public function delete($where = array()) {
        if (!is_array($where)) {
            $where = array(self::PRI_INDEX => $where);
        }
        $this->db->delete(self::TABLE_NAME, $where);
        return $this->db->affected_rows();
    }


	/**
	 *  用户注册校验用户名[手机号码]是否存在
	 */
	public function check_user ($user_mobile='') {
		$rd = array('status'=>-1);
		if ($user_mobile=='') $user_mobile = $this->input->post('mobile', TRUE);
		$query = $this->db->get_where('user', array('user_mobile'=>$user_mobile));
		$rs = $query->row_array();
		if ($rs){
			$rd['status'] = 1;	//用户已经存在
		}else{
			$rd['status'] = 0;	//不存在
		}
		return $rd;
	}

	/**
	 *  用户注册校验用户名[昵称]是否存在
	 */
	public function check_nick ($user_nick='') {
		$rd = array('status'=>-1);
		if ($user_nick=='') $user_mobile = $this->input->post('user_nick', TRUE);
		$query = $this->db->get_where('user', array('user_nick'=>$user_nick));
		$rs = $query->row_array();
		if ($rs){
			$rd['status'] = 1;	//用户已经存在
		}else{
			$rd['status'] = 0;	//不存在
		}
		return $rd;
	}

	/**
	 * 登录
	 */
	public function login () {
		$rd = array('status'=>-1,'errmsg'=>'error');
		$this->load->library('Verify');
		$code = $this->input->post('code');
		$Verify = new Verify();
		if (!$Verify->check($code)) {
			$mobile = $this->input->post('mobile');
			
			$password = $this->input->post('password', TRUE);
			//取出密码
			$user = $this->get(array('user_mobile'=>$mobile));
			if ($user['user_state']==2) die('{"status":-3,"errmsg":"该用户被禁用"}');
			if ($user['user_password']==md5($password)){
				$this->session->USER = $user;
				$rd['status'] = 1;
				unset($user);
			}else{
				$rd['status'] = -2;
				$rd['errmsg'] = '密码错误';
			}
		}else{
			$rd['status'] = -3;
			$rd['errmsg'] = '验证码错误';
		}
		echo json_encode($rd);
	}

	/**
	 * 注册
	 */
	public function register() {
		$rd = array('status'=>-1,'errmsg'=>'error');
		//接收验证码
		$code = $this->input->post('code', TRUE);
		//获取session里面的验证码
		$pcode = $this->session->pcode;
		if (!$pcode['code']==$code) {
			die('{"status":"-5","errmsg":"短信验证码错误"}');
		}
		if ( !( ($pcode['code_time']+60*30)>=time()) ){
			die('{"status":"-6","errmsg":"短信验证码过期"}');
		}
		//验证短信
		if (true) {
			$data['user_mobile'] = $this->input->post('user_mobile', TRUE);
			$data['user_nick'] = $this->input->post('user_nick', TRUE);
			$checkPhone = $this->check_user($data['user_mobile']);

			if ($checkPhone['status']==1) die('{"status":"-5","errmsg":"该手机已经注册"}');
			$checkNick = $this->check_nick($data['user_nick']);
			if ($checkNick['status']==1) die('{"status":"-5","errmsg":"该昵称已经注册"}');
			$data['user_password'] = md5($this->input->post('user_password', TRUE));
			$data['user_addtime'] = date("Y-m-d h:i:s");
			if ($this->input->post('invitecode', TRUE)=='') die('{"status":-1,"errmsg":"请输入邀请码"}');
			$this->checkEmpty($data, true);
			//邀请码  得到推介人
			if ($this->input->post('invitecode', TRUE)!='') {
				$invitecode = $this->input->post('invitecode', TRUE);
				$query = $this->db->select("user_id")->get_where('user', array('user_invitecode'=>$invitecode));
				$rs = $query->row_array();
				if ($rs) {
					$data['recommend_user_id'] = $rs['user_id'];
				}else{
					die('{"status":-1,"errmsg":"不存在该邀请码"}');
				}
			}
			//生成邀请码
			$data['user_invitecode'] = md5($data['user_mobile'].time());

			
			// $data['user_email'] = $this->input->post('user_email', TRUE);
			// $data['user_sex'] = $this->input->post('user_sex', TRUE);
			// $data['user_icon'] = $this->input->post('user_icon', TRUE);
			// $data['user_birth'] = $this->input->post('user_birth', TRUE);
			// $data['user_star'] = $this->input->post('user_star', TRUE);
			// $data['user_address'] = $this->input->post('user_address', TRUE);
			$rs = $this->db->insert('user', $data);
			$user_id = $this->db->insert_id();
			if ($rs) {
				$rd['status'] = 1;
				unset($_SESSION['pcode']);
				//生成默认分组信息
				$query = $this->db->get('friend_def_group');
				$def_group = $query->result_array();
				$group['user_id'] = $user_id;
				foreach ($def_group as $k=>$v) {
					$group['group_name'] = '';
					$group['group_name'] = $v['friend_def_group_name'];
					$this->insert('friend_group', $group);
				}
				//生成钱包
				$wallet['user_id'] = $user_id;
				$this->db->insert('wallet', $wallet);
				//$rd['user_id'] = 
			}else{
				$rd['errmsg'] = '网络错误';
			}
		}else{
			$rd['errmsg'] = '验证码错误或者超时';
		}
		return $rd;
	}

	/**
	 * 找回密码
	 */
	public function forgetPassword () {
		$rd = array('status'=>-1,'errmsg'=>'error');
		//接收验证码
		$code = $this->input->post('code', TRUE);
		//获取session里面的验证码
		$pcode = $this->session->pcode;
		if ($pcode['code']!=$code) {
			die('{"status":"-5","errmsg":"短信验证码错误"}');
		}
		if ( !( ($pcode['code_time']+60*30)>=time()) ){
			die('{"status":"-6","errmsg":"短信验证码过期"}');
		}
		$mobile = $this->input->post('mobile');
		if ($this->get(array('user_mobile'=>$mobile))){
			$password = $this->input->post('password');
			$rs = $this->update(array('user_password'=>md5($password)));
			if ($rs!==false){
				$rd['status'] = 1;
			}else{
				$rd['status'] = -2;
				$rd['errmsg'] = '网络错误';
			}
		}else{
			$rd['errmsg'] = "该用户不存在";
		}
		echo json_encode($rd);
	}

	/**
	 * 修改密码
	 */
	public function alterPass () {
		$user = $this->session->USER;
		$old = $this->input->post('old', true);
		$new = $this->input->post('new');
		$confirm = $this->input->post('confirm');
		if ($confirm!=$new){
			$rd['status'] = -2;
			$rd['errmsg'] = '两次密码不一样';
			return $rd;
		}
		if (strlen($new)<6){
			$rd['status'] = -5;
			$rd['errmsg'] = '密码必须大于6位数';
			return $rd;
		}
		$user = $this->get($user['user_id']);
		if ($user['user_password']==md5($old) ) {
			$update['user_password'] = md5($new);
			$rs = $this->update($update, $user['user_id']);
			if ($rs!==false){
				$rd['status'] = 1;
			}else{
				$rd['status'] = -3;
				$rd['errmsg'] = '网络错误';
			}
		}else{
			$rd['status'] = -4;
			$rd['errmsg'] = '原密码不正确';
		}
		return $rd;
	}
	/**
	 * 获取用户自己的所有信息
	 */
	public function getMyDetailInfo () {
		$user = $this->session->USER;
		$sql = "select u.*,b.*,ru.user_nick as rnick,ru.user_id as ruid from {$this->db->dbprefix}user u,{$this->db->dbprefix}user ru,{$this->db->dbprefix}bank b where u.user_id=b.user_id and b.user_id=u.user_id and u.user_id={$user['user_id']} and ru.user_id=u.recommend_user_id";
		$info = $this->db->query($sql)->row_array();
		return $info;
	}

	/**
	 * 获取好友信息跟分组
	 */
	public function getFriendAndGroup () {
		$user = $this->session->USER;
		$sql = "select u.user_id,u.user_icon,u.user_nick,u.user_isonline,f.friend_group_id from {$this->db->dbprefix}user u, {$this->db->dbprefix}friend f where f.user_id=u.user_id and f.fri_user_id={$user['user_id']}";
		$query = $this->db->query($sql);
		$friends = $query->result_array();
		$query = $this->db->select("group_id,friend_group_name as group_name")->get_where('friend_group', array('user_id'=>$user['user_id']));
		$friend_group = $query->result_array();
		if ($friends){
			$rd['items'] = $friends;
			if ($friend_group){
				$rd['status'] = 1;
				$rd['groups'] = $friend_group;
			}else{
				$rd['status'] = 2;	//分组信息加载失败
			}
		}else{
			$rd['status'] = -2;
			$rd['errmsg'] = "好友信息拉取失败";
		}
		echo json_encode($rd);
	}

	/**
	 * 检查用户是否还能升级
	 */
	public function canLevelUp ($to_level=NULL, $user_id=NULL) {
		if ($to_level===NULL){
			$to_level = (int)$this->input->post('to_level', TRUE);
		}
		if ($user_id===NULL) {
			$user = $this->session->USER;
			$user_id = $user['user_id'];
		}
		//$select = 
		$where['user_level'] = "<".$to_level;
		$where['user_id'] = $user_id;
		return $this->get($where);
	}

	/**
	 * 会员升级
	 */
	public function vipLevelUp ($to_level, $need) {
		$user = $this->session->USER;
		$wallet['b_icon'] = 'b_icon-'.$need;
		$user['user_level'] = $to_level;
		$this->db->trans_start();
		//$this->update($user,$user['user_id']);
		$this->db->query("update {$this->db->dbprefix}user set user_level={$to_level} where user_id={$user['user_id']}");
		$this->db->query("update {$this->db->dbprefix}wallet set diamond=diamond-{$need} where user_id={$user['user_id']}");
		//$this->db->update('wallet', $wallet, array('user_id'=>$user['user_id']));
		$this->db->trans_complete();
		if ($this->db->trans_status()==false){
			$rd['status'] = -3;
			$rd['errmsg'] = '网络错误';
		}else{
			$rd['status'] = 1;
			//$rd['']
		}
		return $rd;
	}

	/**
	 * 我的度友[多条件分页查询]
	 */
	public function myDuFriend () {
		$user = $this->session->USER;
		$rs = $this->get($user['user_id']); 
		//第一层
		$where['recommend_user_id'] = $user_id;
		$rs['data'] = $this->get($where);
		foreach ($rs['data'] as $k=>$v) {
			$rs[$k] = $this->get($v['user_id']);
			//每一个用的下一层
			$next = $this->get(array('recommend_user_id'=>$v['user_id']));
			$rs[$k]['data'] = $next;
			foreach ($next as $nk=>$nv) {
				$rs[$k]['data'][$nk] = $this->get($nv['user_id']);
				//每一个用户的下一层
				$next1 = $this->get(array('recommend_user_id'=>$v['user_id']));
				$rs[$k]['data'][$nk]['data'] = $next1;
				foreach ($next1 as $nk1=>$nv1) {
					$rs[$k]['data'][$nk]['data'][$nk1] = $this->get($nv1['user_id']);
				}
			}
		}
		return $rs;
	}

	/**
	 * 可能认识的人
	 */
	public function maybeFriend ($user_id=NULL) {
		if ($user_id === NULL) {
			$user = $this->session->USER;
			$user_id = $user['user_id'];
		}
		$where['fri_user_id'] = $user['user_id'];
		$myFriend = $this->db->select('friend_id,friend_user_id as user_id')->get_where('friend', $where)->result_array();
		//朋友的朋友
		foreach ($myFriend as $k=>$v) {
			$where['fri_user_id'] = $v['user_id'];
			$myFriend1 = $this->db->select('friend_id,friend_user_id as user_id')->get_where('friend', $where)->result_array();
			foreach($myFriend1 as $k1=>$v1){
				$where['fri_user_id'] = $v1['user_id'];
				$myFriend2 = $this->db->select('friend_id,friend_user_id as user_id')->get_where('friend', $where)->result_array();
				foreach($myFriend2 as $k2=>$v2){
					$where['fri_user_id'] = $v2['user_id'];
					$myFriend3 = $this->db->select('friend_id,friend_user_id as user_id')->get_where('friend', $where)->result_array();
				}
			}
		}
		foreach ($myFriend2 as $k2=>$v2){
			$rs['r_'.$v2['user_id']] = 0;
			if (in_array($v2['user_id'], $myFriend)){
				$rs['r_'.$v2['user_id']] += 2;
				unset($myFriend[array_search($v2['user_id'], $myFriend)]);
			}
			if (in_array($v2['user_id'], $myFriend1)){
				$rs['r_'.$v2['user_id']] += 1;
				unset($myFriend2[array_search($v2['user_id'], $myFriend1)]);
			}
		}
		foreach ($myFriend1 as $k1=>$v1){
			$rs['r_'.$v1['user_id']] = 0;
		}
		asort($rs);
		$i = 0;
		foreach ($rs as $k=>$v){
			$id = str_replace('r_', '', $k);
			$data[$i] = $this->get($id);
			$i++;
		}
		$rd['status'] = 1;
		$rd['data'] = $i;
		echo json_encode($rd);
	}

	/**
	 * 共同好友简单算法 实现
	 * 	只到好友的好友
	 * 	算法可靠性不高
	 */
	public function commonFriend ($user_id=NULL) {
		if ($user_id === NULL) {
			$user = $this->session->USER;
			$user_id = $user['user_id'];
		}
		//得到该用户的好友
		$where['fri_user_id'] = $user['user_id'];
		$query = $this->db->select('friend_id,friend_user_id as user_id')->get_where('friend', $where);
		$friend1 = $query->result_array();
		$commonFriend = array(array()); $i=0;
		foreach ($friend1 as $f1k=>$f1v) {
			//得到第二层的第i个的每一个好友
			$where['fri_user_id'] = $f1v['user_id'];
			$query = $this->db->select('friend_id,friend_user_id as user_id')->get_where('friend', $where);
			$friend2 = $query->result_array();
			foreach ($friend2 as $f2k=>$f2v) {
				foreach ($friend1 as $f1bk=>$f1bv) {
					if ($f1bk<=$f1k) {
						break;
					}
					//得到第二层的第i+1个的每一个好友
					$where['fri_user_id'] = $f1bv['user_id'];
					$query = $this->db->select('friend_id,friend_user_id as user_id')->get_where('friend', $where);
					$friend2n = $query->result_array();
					foreach ($friend2n as $f2nk=>$f2nv) {
						//是否共同好友
						if ($f2v['user_id'] == $f2nv['user_id']) {
							$commonFriend[$i]['user_id'] = $f2v['user_id'];
							$commonFriend[$i]['common_count'] = 1;
							$i++;
							unset($friend2[$f2k]);
							unset($friend2n[$f2nk]);
							break;
						}
					}	
				}	
			}	
		}
		//查询可能认识的人的信息
		if (!empty($commonFriend)){
			foreach ($commonFriend as $k=>$v) {
				$data[$k] = $this->get($v['user_id']);
			}
			$rd['data'] = $data;
		}else{
			$rd['data'] = '';
		}
		return $rd;
	}

	

	

	/**
	 * 评论动态添加
	 */
	public function comment_mood_add () {

	}


	public function isUserExists() {

	}

	public function phoneValidated() {

	}

	public function deleteUser() {

	}

	public function alterUser() {

	}

	/*-----------------------------------------------------------------------------------------------
		后台管理部分
	------------------------------------------------------------------------------------------------*/
	/**
	 * 分页多条件查询用户
	 */
	public function queryUserList ($per_page=10) {
		$onset = $this->uri->segment(5)==''?0:$this->uri->segment(5);
		$sql = "select * from {$this->db->dbprefix}user where flag=1 ";
		$totalSql = "select count(*) as counts from(".$sql.") as a";
		$query = $this->db->query($totalSql);
		$total = $query->row_array();
		$sql .= " order by user_id desc limit {$onset}, {$per_page}";
		$query = $this->db->query($sql);
		$rd['data'] = $query->result_array();
		$rd['total'] = $total['counts'];
		return $rd;
	}


	/**
	 * 分页多条件查询代充值账单
	 */
	public function queryTopupList ($per_page=10) {
		$onset = $this->uri->segment(5)==''?0:$this->uri->segment(5);
		$sql = "select t.*,u.user_mobile,u.user_nick from {$this->db->dbprefix}topup t,{$this->db->dbprefix}user u where t.flag=1 and t.user_id=u.user_id and t.topup_state=1";
		$totalSql = "select count(*) as counts from(".$sql.") as a";
		if ($this->input->get_post('unick')!='') $sql .= " and u.user_nick like '%".addslashes($this->input->get_post('unick'))."%'";
		if ($this->input->get_post('umobile')!='') $sql .= " and u.user_mobile='".$this->input->get_post('umobile')."'";
		$query = $this->db->query($totalSql);
		$total = $query->row_array();
		$sql .= " order by t.topup_id desc limit {$onset}, {$per_page}";
		
		$query = $this->db->query($sql);
		$rd['data'] = $query->result_array();
		$rd['total'] = $total['counts'];
		return $rd;
	}
	
	/**
	 * 充值记录分页查询
	 */
	public function queryTopupRecordList ($per_page=10) {
		$onset = $this->uri->segment(5)==''?0:$this->uri->segment(5);
		$sql = "select t.*,u.user_mobile,u.user_nick from {$this->db->dbprefix}topup t,{$this->db->dbprefix}user u where t.flag=1 and t.user_id=u.user_id and t.topup_state=2";
		$totalSql = "select count(*) as counts from(".$sql.") as a";
		if ($this->input->get_post('unick')!='') $sql .= " and u.user_nick like '%".addslashes($this->input->get_post('unick'))."%'";
		if ($this->input->get_post('umobile')!='') $sql .= " and u.user_mobile=".$this->input->get_post('umobile');
		$query = $this->db->query($totalSql);
		$total = $query->row_array();
		$sql .= " order by t.topup_id desc limit {$onset}, {$per_page}";
		$query = $this->db->query($sql);
		$rd['data'] = $query->result_array();
		$rd['total'] = $total['counts'];
		return $rd;
	}

	/**
	 * 提现管理
	 */
	public function queryCashList ($per_page=10) {
		$onset = $this->uri->segment(5)==''?0:$this->uri->segment(5);
		$sql = "select c.*,b.bank_name,b.bank_no,b.bank_user_name,b.bank_addtime,u.user_mobile,u.user_nick from {$this->db->dbprefix}to_cash c,{$this->db->dbprefix}user u,{$this->db->dbprefix}bank b where c.user_id=u.user_id and b.bank_id=c.bank_id and c.to_cash_state=1";
		$totalSql = "select count(*) as counts from(".$sql.") as a";
		if ($this->input->get_post('unick')!='') $sql .= " and u.user_nick like '%".addslashes($this->input->get_post('unick'))."%'";
		if ($this->input->get_post('umobile')!='') $sql .= " and u.user_mobile='".$this->input->get_post('umobile')."'";
		$query = $this->db->query($totalSql);
		$total = $query->row_array();
		$sql .= " order by c.to_cash_id desc limit {$onset}, {$per_page}";
		
		$query = $this->db->query($sql);
		$rd['data'] = $query->result_array();
		$rd['total'] = $total['counts'];
		return $rd;
	}


	/**
	 * 分页多条件查询  提现记录
	 */
	public function queryCashRecordList ($per_page=10) {
		$onset = $this->uri->segment(5)==''?0:$this->uri->segment(5);
		$sql = "select c.*,b.bank_name,b.bank_no,b.bank_user_name,b.bank_addtime,u.user_mobile,u.user_nick from {$this->db->dbprefix}to_cash c,{$this->db->dbprefix}user u,{$this->db->dbprefix}bank b where c.user_id=u.user_id and b.bank_id=c.bank_id and c.to_cash_state=2";
		$totalSql = "select count(*) as counts from(".$sql.") as a";
		if ($this->input->get_post('unick')!='') $sql .= " and u.user_nick like '%".addslashes($this->input->get_post('unick'))."%'";
		if ($this->input->get_post('umobile')!='') $sql .= " and u.user_mobile='".$this->input->get_post('umobile')."'";
		$query = $this->db->query($totalSql);
		$total = $query->row_array();
		$sql .= " order by c.to_cash_id desc limit {$onset}, {$per_page}";
		
		$query = $this->db->query($sql);
		$rd['data'] = $query->result_array();
		$rd['total'] = $total['counts'];
		return $rd;
	}

	/**
	 * 提现成功操作
	 */
	public function cashSuccess () {
		$rd = array('status'=>-1);
		$id = $this->input->post('id');
		$rs = $this->db->update('to_cash', array('to_cash_state'=>2), array('to_cash_id'=>$id));
		if ($rs) {
			$rd['status'] = 1;
		}else{
			$rd['status'] = -2;
			$rd['errmsg'] = '网络错误，操作失败';
		}
		return $rd;
	}

	/*-----------------------------------------------------
	 * 		数据统计 
	 ------------------------------------------------------*/
	 /**
	  * 用户
	  */
	 public function countNum () {
	 	$rd['user'] = $this->db->count_all('user');
	 	$rd['photo'] = $this->db->count_all('photo');
	 	$rd['trends'] = $this->db->count_all('trends');
	 	$rd['blog'] = $this->db->count_all('blog');
	 	$rd['topup'] = $this->db->where(array('topup_state'=>2))->count_all_results('topup');
	 	return $rd;
	 }

	 /**
	  * 统计今天的
	  */
	 public function countToday() {
	 	$today = date("Y-m-d");
	 	$rd['user'] = $this->db->where(array('user_addtime'.'>='=>$today))->from('user')->count_all_results();
	 	$rd['photo'] = $this->db->where(array('photo_addtime'.'>='=>$today))->from('photo')->count_all_results();
	 	$rd['trends'] = $this->db->where(array('trends_addtime'.'>='=>$today))->from('trends')->count_all_results();
	 	$rd['blog'] = $this->db->where(array('blog_addtime'.'>='=>$today))->from('blog')->count_all_results();
	 	$rd['topup'] = $this->db->where(array('topup_state'=>2, 'topup_addtime'=>'>='.$today))->from('topup')->count_all_results();
	 	//$topupSql = "select * from {$this->db->dbprefix}topup where topup_addtime>={$today} and topup_state=2";
	 	//$count = $this->db->query("select sum(money) as money from(".$topupSql.") as a")->row_array();
	 	//$rd['topup'] = $count['money'];
	 	return $rd;
	 }

}