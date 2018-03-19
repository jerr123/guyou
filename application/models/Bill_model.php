<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bill_model extends CI_Model {

    /**
     * @name string TABLE_NAME Holds the name of the table in use by this model
     */
    const TABLE_NAME = 'bill';

    /**
     * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
     */
    const PRI_INDEX = 'bill_id';

    /**
     * Retrieves record(s) from the database
     *
     * @param mixed $where Optional. Retrieves only the records matching given criteria, or all records if not given.
     *                      If associative array is given, it should fit field_name=>value pattern.
     *                      If string, value will be used to match against PRI_INDEX
     * @return mixed Single record if ID is given, or array of results
     */
    public function get($where = NULL) {
        $this->db->select('*');
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
     * 生成充值账单
     */
    public function topUpBill ($bill_amount,$bill_remark=NULL) {
    	$user = $this->session->USER;
    	$data['bill_type'] = 1;
    	$data['bill_currency'] = 2;
    	$data['transfer_frome_user_id'] = 0; //系统
    	$data['transfer_to_user_id'] = $user_id;
    	$data['bill_amount'] = $bill_amount;
    	$data['bill_addtime'] = date("Y-m-d h:i:s");
    	if ($bill_remark===NULL) {
    		$data['bill_remark'] = "昵称：{$user_nick},手机：{$user['user_mobile']}于{$data['bill_addtime']}，充值了{$bill_amount}B币";
    	}
    	return $this->insert($data);
    }

    /**
     * 生成发红包账单
     */
    public function redPacketBill ($bill_amount, $bill_currency, $bill_remark=NULL) {
    	$user = $this->session->USER;
    	$data['bill_type'] = 2;
    	$data['bill_currency'] = $bill_currency;
    	$data['transfer_frome_user_id'] = $user_id; 
    	$data['transfer_to_user_id'] = 0;	//系统
    	$data['bill_amount'] = $bill_amount;
    	$data['bill_addtime'] = date("Y-m-d h:i:s");
    	if ($bill_remark===NULL) {
    		$data['bill_remark'] = "昵称：{$user_nick},手机：{$user['user_mobile']}于{$data['bill_addtime']}，发了{$bill_amount}的红包";
    	}
    	return $this->insert($data);
    }

    /**
     * 收益账单
     */
    public function inCome ($bill_amount, $bill_currency, $bill_remark=NULL) {
    	$user = $this->session->USER;
    	$data['bill_type'] = 3;
    	$data['bill_currency'] = 2;
    	$data['transfer_frome_user_id'] = 0; //系统
    	$data['transfer_to_user_id'] = $user_id;	
    	$data['bill_amount'] = $bill_amount;
    	$data['bill_addtime'] = date("Y-m-d h:i:s");
    	if ($bill_remark===NULL) {
    		$data['bill_remark'] = "昵称：{$user_nick},手机：{$user['user_mobile']}于{$data['bill_addtime']}，发了{$bill_amount}的红包";
    	}
    	return $this->insert($data);
    }

    /**
     * 转账账单
     */
    public function transferBill ($to_user_id,$bill_amount, $bill_currency, $bill_remark=NULL) {
    	$user = $this->session->USER;
    	$data['bill_type'] = 4;
    	$data['bill_currency'] = $bill_currency;
    	$data['transfer_frome_user_id'] = $user['user_id']; //系统
    	$data['transfer_to_user_id'] = $to_user_id;	
    	$data['bill_amount'] = $bill_amount;
    	$data['bill_addtime'] = date("Y-m-d h:i:s");
    	if ($bill_remark===NULL) {
    		$data['bill_remark'] = "昵称：{$user_nick},手机：{$user['user_mobile']}于{$data['bill_addtime']}，发了{$bill_amount}的红包";
    	}
    	return $this->insert($data);
    }

    /**
     * 提现账单
     */
    public function toCashBill ($bill_amount, $bill_currency=1, $bill_remark=NULL) {
    	$user = $this->session->USER;
    	$data['bill_type'] = 4;
    	$data['bill_currency'] = $bill_currency;
    	$data['transfer_frome_user_id'] = 0; //系统
    	$data['transfer_to_user_id'] = $user['user_id'];	
    	$data['bill_amount'] = $bill_amount;
    	$data['bill_addtime'] = date("Y-m-d h:i:s");
    	if ($bill_remark===NULL) {
    		$data['bill_remark'] = "昵称：{$user_nick},手机：{$user['user_mobile']}于{$data['bill_addtime']}，发了{$bill_amount}的红包";
    	}
    	return $this->insert($data);
    }

    /**
     * 分页获取用户账单数据数据
     */
    public function getBillPage ($per_page) {
        $user = $this->session->USER;
        $user_id = $user['user_id'];
        $onset = $this->uri->segment(4)!=''?$this->uri->segment(4):0;
        $sql = "select b.*,uf.user_nick as fnick,uf.user_id as fuid,ut.user_nick as tnick,ut.user_id as tuid from {$this->db->dbprefix}bill b,{$this->db->dbprefix}user uf,{$this->db->dbprefix}user ut where (b.transfer_frome_user_id={$user_id} or b.transfer_to_user_id={$user_id}) and ut.user_id=b.transfer_to_user_id and uf.user_id=b.transfer_frome_user_id";
        if ($this->input->post_get('startDate')!='') $sql .= " and bill_addtime>=".$this->input->post_get('startDate');
        if ($this->input->post_get('endDate')!='') $sql .= " and bill_addtime<=".$this->input->post_get('endDate');
        $totalSql = "select count(*) as total from (".$sql.") as a";
        $total = $this->db->query($totalSql)->row_array();
        $sql .= " order by bill_id desc limit {$onset}, {$per_page}";
        $rs = $this->db->query($sql)->result_array();
        $rd['total'] = $total['total'];
        $rd['data'] = $rs;
        return $rd;
    }
}

?>