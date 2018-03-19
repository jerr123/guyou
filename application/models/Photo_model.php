<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Photo_model extends CI_Model {

    /**
     * @name string TABLE_NAME Holds the name of the table in use by this model
     */
    const TABLE_NAME = 'photo';

    /**
     * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
     */
    const PRI_INDEX = 'photo_id';

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
     * 校验图片是否是自己的
     */
    public function isMyPhoto ($photo_id, $user_id=NULL) {
    	if ($user_id===NULL){
    		$user = $this->session->USER;
    		$user_id = $user['user_id'];
    	}
    	$where['photo_id'] = $photo_id;
    	$where['user_id'] = $user_id;
    	return $this->get($where);
    }

    /**
     * 获取相册对应的图片 
     * @param int $album_id 相册Id
     * 没有参数则获取该用户的所有图片数统计
     */
    public function countPhotoByAlbum ($album_id=NULL){
        $user = $this->session->USER;
        $where['user_id'] = $user['user_id'];
        if ($album_id!==NULL){
            $where['album_id'] = $album_id;
        }
        $rs = $this->db->where($where)->from('photo')->count_all_results();
        return $rs;
    }

    /**
     * 根据相册获取照片
     */
    public function getPhotoByAlbum ($id=NULL) {
        $user = $this->session->USER;
        $where['user_id'] = $user['user_id'];
        if ($id===NULL){
            $id = $this->input->post_get('album_id');
        }
        $where['album_id'] = $id;
        $rs = $this->db->get_where('photo', $where)->result_array();
        return $rs;
    }

    /**
     * 获取
     */
    public function getMainPagePhoto ($uid) {
        $user = $this->session->USER;
        $where['user_id'] = $uid;
        $i = 0; $rd = array();
        $rs = $this->db->order_by('photo_addtime', 'desc')->get_where('photo', $where)->result_array();
        foreach ($rs as $k=>$v){
            $gant = $this->db->get_where('album', array('album_id'=>$v['album_id']))->row_array();
            if ($gant['album_isshow']==1){
                $rd[$i] = $v;
                $i++;
            }
        }
        return $rd;
    }
}

?>