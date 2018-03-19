<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Topup_model extends CI_Model {

    /**
     * @name string TABLE_NAME Holds the name of the table in use by this model
     */
    const TABLE_NAME = 'topup';

    /**
     * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
     */
    const PRI_INDEX = 'topup_id';

    /**
     * Retrieves record(s) from the database
     *
     * @param mixed $where Optional. Retrieves only the records matching given criteria, or all records if not given.
     *                      If associative array is given, it should fit field_name=>value pattern.
     *                      If string, value will be used to match against PRI_INDEX
     * @return mixed Single record if ID is given, or array of results
     */
    public function get($where = NULL, $select='*') {
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
     * 关联用户表查询
     */
    public function getDetail ($topup_id) {
    	$sql = "select t.*,u.user_mobile,u.user_nick from {$this->db->dbprefix}topup t,{$this->db->dbprefix}user u where t.flag=1 and t.user_id=u.user_id and t.topup_id=".$topup_id;
    	return $this->db->query($sql)->row_array();
    }

    /**
     * 
     */
    public function topupToSuccess () {
    	$rd = array('status'=>-1);
    	$id = (int)$this->input->post_get('id');
    	$info = $this->get($id);
        $user = $this->db->get_where('user', array('user_id'=>$info['user_id']))->row_array();
    	$this->db->trans_start();
    	$this->db->query("update {$this->db->dbprefix}wallet set diamond=diamond+{$info['money']} where user_id={$info['user_id']}");
    	$this->update(array('topup_state'=>2), array('topup_id'=>$id));
    	$this->db->trans_complete();
    	if ($this->db->trans_status()!==false){
    		$rd['status'] = 1;
            //生成账单
            $bill_data['bill_type'] = 1;
            $bill_data['bill_currency'] = 2;
            $bill_data['transfer_frome_user_id'] = $info['user_id']; 
            $bill_data['transfer_to_user_id'] = 0;
            $bill_data['bill_amount'] = $info['money'];
            $bill_data['bill_addtime'] = $info['topup_addtime'];
            $bill_data['bill_remark'] = "昵称：{$user['user_nick']},手机：{$user['user_mobile']}于{$bill_data['bill_addtime']}，充值{$bill_data['bill_amount']}钻石成功";
            $this->db->insert('bill', $bill_data);
    	}else{
    		$rd['status'] = -2;
    		$rd['status'] = '网络错误';
    	}
    	echo json_encode($rd);
    }
}

?>