<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Friend_apply_model extends CI_Model {

    /**
     * @name string TABLE_NAME Holds the name of the table in use by this model
     */
    const TABLE_NAME = 'friend_apply';

    /**
     * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
     */
    const PRI_INDEX = 'fri_apply_id';

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
     * 添加好友通知
     * 
     */
    public function getApply($per_page){
        $onset = $this->uri->segment(4)!=''?$this->uri->segment(4):0;
        $user = $this->session->USER;
        $sql = "select f.*,uf.user_address as faddress,uf.user_mobile as fmobile,uf.user_icon as ficon,uf.user_nick as fnick,uf.user_id as fid,ut.user_nick as tnick,ut.user_id as tid,ut.user_icon as ticon from {$this->db->dbprefix}friend_apply f,{$this->db->dbprefix}user ut,{$this->db->dbprefix}user uf where f.from_user_id=uf.user_id and ut.user_id=f.to_user_id and f.to_user_id={$user['user_id']}";
        $sqlTotal = "select count(*) as total from(".$sql.") as a";
        $total = $this->db->query($sqlTotal)->row_array();
        $sql .= " order by fri_apply_id desc limit {$onset}, {$per_page}";
        $rd['total'] = $total['total'];
        $rd['data'] = $this->db->query($sql)->result_array();
        return $rd;
    }

    /**
     * 获取新加好友消息统计
     */
    public function getMyApplyCount () {
        $user = $this->session->USER;
        $num = $this->db->where(array('to_user_id'=>$user['user_id'],'fri_apply_state'=>1))->from('friend_apply')->count_all_results();
        return $num;
    }
}
        

?>