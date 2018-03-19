<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Trends_model extends CI_Model {

    /**
     * @name string TABLE_NAME Holds the name of the table in use by this model
     */
    const TABLE_NAME = 'trends';

    /**
     * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
     */
    const PRI_INDEX = 'trends_id';

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
	 * 发布动态
	 */
	public function publish_mood () {
		$rd = array('status'=>-1,'errmsg'=>'发布动态失败');
		$length = mb_strlen(trim($this->input->post('content', TRUE)), 'utf8');
		/*if ($length>140) {
			$rd['errmsg'] = '字数过长';
		}else{*/
			$data['trends_content'] = $this->input->post('content', TRUE);
			$user = $this->session->USER;
			$data['user_id'] = $user['user_id'];
			$data['user_name'] = $user['user_nick'];
			$data['trends_addtime'] = date("Y-m-d h:i:s");
			//解析内容得到艾特的用户
			if (preg_match_all("/@{user_id:(\d*),user_nick:([^\}\+]*)\}\+{1}/u", $data['trends_content'], $matche_at_user) ) {
//                var_dump($matche_at_user);die();

				for ($i = 0; $i<count($matche_at_user[1]); $i++) {
					$at_user[$i]['user_id'] = $matche_at_user[1][$i];
					$at_user[$i]['user_nick'] = $matche_at_user[2][$i];
				}
			}
//            var_dump($at_user);die();
            $re_rs = preg_replace("/@({user_id:(\d*),user_nick:([^\}\+]*)\}\+{1})/u", '@<a href="/Common/mainPage?uid=${2}" data-id="${2}">$3</a>', $data['trends_content']);
//			echo$re_rs;die();
            $data['trends_content'] = $re_rs;
            $rs = $this->db->insert('trends', $data);
			if ($rs){
				$rd['status'] = 1;
                if (isset($at_user) ) {
                    foreach ($at_user as $atv) {
                        $at = array();
                        $at['user_id'] = $atv['user_id'];
                        $at['at_type'] = 1;
                        $at['id'] = $rs;
                        $this->db->insert('at', $at);
                    }
                }
			}else{
				$rd['errmsg'] = '网络错误';
			}
		//}
		return $rd;
	}

    /**
     * 
     */
    public function getMainPageTrands ($where) {
        return $this->db->get_where('trends', $where)->result_array();
    }

    /**
     * 首页异步加载说说数据
     */
    public function getTrandes ($user_id) {
        $rd['status'] = -1;
        $per_page = 10;
        $page = $this->input->post('page');
        if (!$page){
            $onset = 0;
        }else{
            $onset = ($page-1)*$per_page;
        }
//        $sql = "select t.*,u.user_icon as headimg,u.user_nick as unick from {$this->db->dbprefix}user u,{$this->db->dbprefix}friend f,{$this->db->dbprefix}trends t where t.user_id=u.user_id and f.friend_user_id=t.user_id and (t.user_id={$user_id} or f.fri_user_id={$user_id})";
        $sql = "select t.*,u.user_icon as headimg,u.user_nick as unick from gg38_trends t LEFT JOIN gg38_friend as f ON t.user_id=f.friend_user_id LEFT JOIN gg38_user as u ON u.user_id=t.user_id where (t.user_id=? or f.fri_user_id=?)";
        $sql .= " order by t.trends_id desc limit {$onset}, {$per_page}";
//        echo $sql;
        $trends = $this->db->query($sql, [$user_id, $user_id])->result_array();
        if ($trends){
            foreach ($trends as $k=>$v) {
                $csql = "select c.*,fu.user_icon as ficon,fu.user_id as fuid,fu.user_nick as fnick,tu.user_icon as ticon,tu.user_id as tuid,tu.user_nick as tnick from {$this->db->dbprefix}comment c,{$this->db->dbprefix}user fu,{$this->db->dbprefix}user tu where c.to_comment_user_id=tu.user_id and c.comment_user_id=fu.user_id and c.app_id={$v['trends_id']}";
                $csql .= " order by comment_id desc";
                $trends[$k]['comment'] = $this->db->query($csql)->result_array();
                // 点赞
                $likeSql = "select * from gg38_like where app_type=3 and app_id=? order by like_id asc";
                $likeData = $this->db->query($likeSql, [$v['trends_id']])->result_array();
                $trends[$k]['zans'] = $likeData;
                $trends[$k]['zanNum'] = count($likeData);
            }
            $rd['status'] = 1;
            $rd['data'] = $trends;
        }else{
            $rd['status'] = -2;
            $rd['errmsg'] = "没有数据了";
        }
        echo json_encode($rd);
    }
}

?>