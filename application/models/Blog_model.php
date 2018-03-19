<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Blog_model extends CI_Model {

    /**
     * @name string TABLE_NAME Holds the name of the table in use by this model
     */
    const TABLE_NAME = 'blog';

    /**
     * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
     */
    const PRI_INDEX = 'blog_id';

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
     * getBlogById
     */
    public function getBlog ($id = NULL) {
        if ($id===NULL){
            $id = $this->input->post_get('blog_id');
        }
        $rs = $this->get($id);
        $rs['blog_content'] =  htmlspecialchars_decode($rs['blog_content']);
        return $rs;
    }
    /**
     * 校验是否对应user_id的日子
     */
    public function isMyBlog ($blog_id, $user_id = NULL) {
    	if ($user_id===NULL){
    		$user = $this->session->USER;
    		$user['user_id'] = $user['user_id'];
    	}
    	$where['user_id'] = $user_id;
    	$where['blog_id'] = $blog_id;
    	return $this->get($where);
    }

    /**
     * 分页获取用户自己的日志
     */
    public function getBlogList ($per_page, $user_id=NULL) {
    	if ($user_id===NULL) {
    		$user = $this->session->USER;
    		$user_id = $user['user_id'];
    	}
    	if ($this->input->post('goPageNO')!='') {
    		$onset = (int)$this->input->post('goPageNO', TRUE)*$per_page;
    	}else{
    		$onset = $this->uri->segment(4)!=''?$this->uri->segment(4):0;
    	}
    	$sql = "select b.*,bt.blog_type_name from {$this->db->dbprefix}blog b,{$this->db->dbprefix}blog_type bt where b.user_id={$user_id} and b.blog_type_id=bt.blog_type_id ";
    	//条件
    	if ($this->input->post('searchKey')!='') $sql .= "and b.blog_title like '%".addslashes($this->input->post('searchKey', TRUE))."%'";
    	//统计总数
    	$totalSql = "select count(*) as counts from(".$sql.") as a";

    	$query = $this->db->query($totalSql);
    	$total = $query->row_array();
        $sql .= "order by blog_id desc limit {$onset}, {$per_page}";
    	$query = $this->db->query($sql);
    	$rs = $query->result_array();
    	$rd['total'] = $total['counts'];
    	foreach ($rs as $k=>$v) {
            $rs[$k]['blog_content'] = htmlspecialchars_decode($v['blog_content']);
    		$rs[$k]['blog_addtime'] = date("Y-m-d" ,strtotime($v['blog_addtime']));
    	}
    	$rd['data'] = $rs;
        //var_dump($rd);
    	return $rd;
    }

    /**
     * 分页获取好友的日志
     */
    public function getFriendBlogList ($user_id) {
    	if ($user_id===NULL) {
    		$user = $this->session->USER;
    		$user_id = $user['user_id'];
    	}
    	$onset = $this->uri->segment(4)==''?$this->uri->segment(4):0;
    	$sql = "select b.*,bt.blog_type_name from {$this->db->dbprefix}blog b,{$this->db->dbprefix}blog_type bt where b.user_id={$user_id} ";
    	//条件
    	if ($this->input->post('searchKey')!='') $sql .= "and b.blog_title like '%".addslashes($this->input->post('searchKey', TRUE))."%'";
    	//统计总数
    	$totalSql = "select count(*) as counts from(".$sql.") as a";
    	$query = $this->db->query($totalSql);
    	$total = $query->row_array();
    	$query = $this->db->query($sql);
    	$rs = $query->result_array();
    	$rd['total'] = $total['counts'];
    	foreach ($rs as $k=>$v) {
    		$rs[$k]['blog_content'] = htmlspecialchars_decode($v['blog_content']);
    	}
    	$rd['data'] = $rs;
    	return $rd;
    }

    /**
     * 获取权限为公共的 日志
     */
    public function getMainPageBlog ($uid) {
        $where = array('user_id'=>$uid,'blog_rank'=>1);
        $rs = $this->db->order_by('blog_id', 'desc')->get_where('blog', $where)->result_array();
        return $rs;
    }

    /**
     * 用户日志统计
     */
    public function getUserCountAll () {
        //$this->db->count_result_all('blog');
    }
}
        
?>