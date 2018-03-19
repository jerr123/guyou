<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Friend_model extends CI_Model {

    /**
     * @name string TABLE_NAME Holds the name of the table in use by this model
     */
    const TABLE_NAME = 'friend';

    /**
     * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
     */
    const PRI_INDEX = 'friend_id';

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
	 * 是否好友校验
	 * @param Int $friend_user_id 好友的id
	 * @return Boolean 
	 */
	public function isFriend ($friend_user_id=NULL) {
		$user = $this->session->USER;
		$where['fri_user_id'] = $user['user_id'];
		if ($friend_user_id==NULL) {
			$where['friend_user_id'] = $this->input->post('friend_user_id', TRUE);
		}else{
			$where['friend_user_id'] = $friend_user_id;
		}
		$rs = $this->get($where);
		if ($rs) {
			return true;
		}else{
			return false;
		}
	}

    /**
     * 搜索好友
     */
    public function searchFriend () {
        $rd = array('status'=>-1);
        $searchKey = $this->input->post_get('param');
        if ($searchKey=='') die('{"status":3,"errmsg":"请输入搜索内容"}');
        $sql = "select * from {$this->db->dbprefix}user where user_nick like '%".addslashes($searchKey)."%' or user_mobile='{$searchKey}'";
        $rs = $this->db->query($sql)->result_array();
        if ($rs){
            $rd['status'] = 1;
            foreach ($rs as $k=>$v){
                $rs[$k]['user_mobile'] = substr($v['user_mobile'], 0, 5).'*****';
            }
            $rd['data'] = $rs;
        }else{
            $rd['status'] = 2;
            $rd['errmsg'] = '未找到';
        }
        echo json_encode($rd);
    }

    /**
     * 关联分页查询我的好友
     */
    public function getFriend ($per_page){
        $user = $this->session->USER;
        $onset = $this->uri->segment(4)!=''?$this->uri->segment(4):0;
        $sql = "select f.*,u.user_address as faddress,u.user_mobile as fmobile,u.user_nick as fnick,u.user_icon as ficon from {$this->db->dbprefix}friend f,{$this->db->dbprefix}user u where u.user_id=f.friend_user_id and f.fri_user_id={$user['user_id']}";
        if ($this->input->get_post('group_id')!='') $sql .= " and f.friend_group_id=".$this->input->get_post('group_id');
        $totalSql = "select count(*) as total from(".$sql.") as a";
        $total = $this->db->query($totalSql)->row_array();
        $sql .= " order by f.friend_id desc limit {$onset}, {$per_page}";
        $rs = $this->db->query($sql)->result_array();
        $rd['total'] = $total['total'];
        $rd['data'] = $rs;
        return $rd;
    }

    /**
     * 根据分组id 统计该分组人数
     */
    public function countFriendByGroup ($group_id=NULL) {
        $user = $this->session->USER;
        $where['fri_user_id'] = $user['user_id'];
        if ($group_id!==NULL) {
            $where['friend_group_id'] = $group_id;
        }
        $rs = $this->db->where($where)->from('friend')->count_all_results();
        return $rs;
    }
}

 ?>