<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Wallet_model extends CI_Model {

    /**
     * @name string TABLE_NAME Holds the name of the table in use by this model
     */
    const TABLE_NAME = 'wallet';

    /**
     * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
     */
    const PRI_INDEX = 'wallet_id';

    /**
     * Retrieves record(s) from the database
     *
     * @param mixed $where Optional. Retrieves only the records matching given criteria, or all records if not given.
     *                      If associative array is given, it should fit field_name=>value pattern.
     *                      If string, value will be used to match against PRI_INDEX
     * @return mixed Single record if ID is given, or array of results
     */
    public function get($where = NULL,$select='*') {
        $this->db->select($select);
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
     * 加载钱包页面数据
     */
    public function loadWalletInfo($user_id=NULL){
    	if ($user_id===NULL){
    		$user = $this->session->USER;
    		$user_id = $user['user_id'];
    	}
    	$where['user_id'] = $user_id;
    	return $this->get($where);
    }

    /**
     * 检查是否还有b_icon 的b比
     */
    public function hasBIcon($b_icon=0, $user_id) {
    	if ($user_id===NULL){
    		$user = $this->session->USER;
    		$user_id = $user['user_id'];
    	}
    	$where['b_icon'] = '>='.$b_icon;
    	$where['user_id'] = $user_id;
    	return $this->get($where);	
    }

    /**
     * 检查是否还有diamond 
     */
    public function hasDiamond($diamond=0, $user_id=NULL) {
    	if ($user_id===NULL){
    		$user = $this->session->USER;
    		$user_id = $user['user_id'];
    	}
        $where['diamond'] = '>='.$diamond;
    	$where['user_id'] = $user_id;
        $rd = $this->get($where);
        //var_dump($rd);
    	return $rd;
    }

    /**
     * b币提现操作
     */
    public function toCash () {
    	$rd = array('status'=>-1);
    	$user = $this->session->USER;
        $b_icon = $this->input->post('b_icon', true);
        if ($b_icon=='') {
            $rd['status'] = -4;
            $rd['errmsg'] = '请输入提现金额';
            return $rd;
        }
    	$password = $this->input->post('password', true);
        $user = $this->db->get_where('user', array('user_id'=>$user['user_id']))->row_array();
        if ($user['user_state']==2){
            $rd['errmsg'] = "该用户被禁用";
            return $rd;
        }
        $wallet = $this->get(array('user_id'=>$user['user_id']));
    	//验证b币是否足够
    	if ($wallet['b_icon']>=$b_icon) {
            if ($user['user_password'] != md5($password)) {
                $rd['status'] = -5;
                $rd['errmsg'] = '密码错误';
                return $rd;
            }
            $rs = $this->db->get_where('bank', array('user_id'=>$user['user_id']))->row_array();
            $bank_id = $rs['bank_id'];
    		$wdata['b_icon'] = $wallet['b_icon'] - $b_icon;
    		$to_cash['bank_id'] = $bank_id;
    		$to_cash['user_id'] = $user['user_id'];
    		$to_cash['b_icon_num'] = $b_icon;
    		$to_cash['to_cash_addtime'] = date("Y-m-d h:i:s");
    		//事物
    		$this->db->trans_start();
    		$this->update($wdata, array('user_id'=>$user['user_id']));
    		$this->db->insert('to_cash', $to_cash);
    		$this->db->trans_complete();
    		if ($this->db->trans_status() === false){
    			$rd['status'] = -2;
    			$rd['errmsg'] = '网络错误,提现失败';
    		}else{
    			$rd['status'] = 1;
    		}
    	}else{
    		$rd['status'] = -3;
    		$rd['errmsg'] = '你没有那么多B币';
    	}
    	return $rd;
    }
}

?>