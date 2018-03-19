<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Fri_tx_model extends CI_Model {

    /**
     * @name string TABLE_NAME Holds the name of the table in use by this model
     */
    const TABLE_NAME = 'fri_tx';

    /**
     * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
     */
    const PRI_INDEX = 'fri_tx_id';

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
     * 获取消息详情
     */
    public function getTx ($id = NULL) {
        $rd = array('status'=>-1);
        if ($id === NULL){
            $id = $this->input->post('id');
        }
        $user = $this->session->USER;
        $sql = "select t.*,uf.user_nick as fnick,uf.user_icon as ficon from {$this->db->dbprefix}user uf,{$this->db->dbprefix}fri_tx t where t.review_user_id=uf.user_id and t.fri_tx_id={$id}";
        $rs = $this->db->query($sql)->row_array();
        if ($rs['fri_user_id']!=$user['user_id']){
            $rd['status'] = -2;
            $rd['errmsg'] = '权限错误';
        }else{
            $rd['status'] = 1;
            $rd['data'] = $rs;
        }
        return $rd;

    }
    /**
     * 消息分页查询
     */
    public function queryTxPage ($per_page) {
        $onset = $this->uri->segment(4)!=''?$this->uri->segment(4):0;
        //$sql = "select t.*,ut.user_nick,uf.user_id,uf.user_nick, from {$this->db->dbprefix}fri_tx t,{$this->db->dbprefix}user uf {$this->db->dbprefix}user ut where t.fri_user_id=ut.user_id and t.review_user_id=uf.user_id";
        $sql = "select t.*,uf.user_nick,uf.user_id from {$this->db->dbprefix}fri_tx t,{$this->db->dbprefix}user uf where t.review_user_id=uf.user_id";
        $totalSql = "select count(*) as total from (".$sql.") as a";
        $total = $this->db->query($totalSql)->row_array();
        $sql .= " order by t.fri_tx_id desc limit {$onset}, {$per_page}";
        $rs = $this->db->query($sql)->result_array();
        $rd['total'] = $total['total'];
        $rd['data'] = $rs;
        return $rd;
    }

    /**
     * 未读消息统计
     */
    public function tx_unread_count() {
        $user = $this->session->USER;
        $num = $this->db->where(array('fri_user_id'=>$user['user_id'], 'fri_tx_state'=>1))->from('fri_tx')->count_all_results();
        return $num;
    }

    /**
     * 生成提醒消息
     */
    public function build_pri_tx ($data = array('fri_tx_type'=>1)) {
    	$user = $this->session->USER;
    	$fri_tx['fri_user_id'] = $data['fri_user_id'];
		$fri_tx['review_user_id'] = $user['user_id'];
		$fri_tx['review_pic'] = $user['user_icon'];
		$fri_tx['review_nick'] = $user['user_nick'];
		$fri_tx['fri_tx_content'] = $data['fri_tx_content'];
		$fri_tx['fri_tx_type'] = $data['fri_tx_type'];
		return $this->insert($fri_tx);
    }

    /**
     * 生成系统消息
     */
    public function build_sys_pri_tx ($data = array('fri_tx_type'=>3)) {
        $user = $this->session->USER;
        $fri_tx['fri_user_id'] = $data['fri_user_id'];
        $fri_tx['review_user_id'] = $user['user_id'];
        $fri_tx['review_pic'] = $user['user_icon'];
        $fri_tx['review_nick'] = $user['user_nick'];
        $fri_tx['fri_tx_content'] = $data['fri_tx_content'];
        $fri_tx['fri_tx_type'] = $data['fri_tx_type'];
        return $this->insert($fri_tx);
    }

    /**
     * 评论提醒信息
     */
    public function build_comment_tx ($fri_user_id) {
    	$user = $this->session->USER;
    	$fri_tx['fri_user_id'] = $fri_user_id;
    	$fri_tx['fri_tx_content'] = "{$user['nick']},评论了你的动态";
    	$fri_tx['fri_tx_type'] = 1;
		return $this->build_pri_tx($fri_tx);
    }
}
        
?>