<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Red_packet_model extends CI_Model {

    /**
     * @name string TABLE_NAME Holds the name of the table in use by this model
     */
    const TABLE_NAME = 'red_packet';

    /**
     * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
     */
    const PRI_INDEX = 'red_packet_id';

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
     * 发红包
     */
    public function diamonRedPacket($data,$user_id=NULL){
        if ($user_id===NULL){
            $user = $this->session->USER;
            $user_id = $user['user_id'];
        }
        $this->db->trans_start();
        $rs = $this->insert($data);
        $this->db->query("update {$this->db->dbprefix}user set can_send=2 where user_id={$user_id}");
        $this->db->query("update {$this->db->dbprefix}wallet set diamond=diamond-{$data['red_packet_num']} where user_id={$user_id}");
        $this->db->trans_complete();
        if ($this->db->trans_status()===false){
            return false;
        }else{
            return $rs;
        }
    }

    /**
     * 发红包 积分
     */
    public function pointRedPacket($data,$user_id=NULL){
        if ($user_id===NULL){
            $user = $this->session->USER;
            $user_id = $user['user_id'];
        }
        $this->db->trans_start();
        $rs = $this->insert($data);
        $this->db->query("update {$this->db->dbprefix}wallet set point=point-{$data['red_packet_num']} where user_id={$user_id}");
        $this->db->trans_complete();
        if ($this->db->trans_status()===false){
            return false;
        }else{
            return $rs;
        }
    }

    /**
     * 定时程序收益计算
     * 时间  每天00:00:00
     */
    public function inCome () {
        $config = $this->db->get('config')->result_array();
        //取出当天红包池的所有订单
        $where['rp_state'] = 1;
        $where['red_packet_addtime'] = '>'.date("Y-m-d");
        $rp = $this->get($where);
        foreach ($rp as $k => $v) {
            //计算他自己的收益
            if ($v['red_packet_type']==2) { //钻石
                $income = $v['red_packet_num']*$config['diamond'];
                //$this->db->trans_start();
                $this->db->query("update wallet set diamond=diamond+{$inCome} where user_id={$v['red_packet_from_user_id']}");
                $this->db->update('red_packet', array('rp_state'=>2), array('user_id'=>$v['red_packet_from_user_id']));
                //他的上一层的收益
                $point1 = $v['red_packet_num']*$config['firstAward'];
                $point2 = $v['red_packet_num']*$config['secondAward'];
                $point3 = $v['red_packet_num']*$config['thirdAward'];
                $n1 = $this->db->get_where('user', array('parent_user_id'=>$v['red_packet_from_user_id'],'user_state'=>1))->row_array();
                if ($n1){
                    $rs = $this->db->query("update wallet set point=point+{$point1} where user_id={$n1['user_id']}");
                    if (!$rs){
                        //记录日志
                    }else{
                        //记录账单
                        $billInfo = array(
                                'bill_type' => 3,//收益
                                'bill_currency' => 3,//积分
                                'transfer_frome_user_id' => 0,//系统
                                'transfer_to_user_id' => $n1['user_id'],//进入账户
                                'bill_amount' => $point1,
                                'bill_remark' => '系统收益',
                                'bill_addtime' => date('Y-m-d h:i:s')
                            );
                        $this->db->insert('bill',$billInfo);
                    }
                    //上面第二层
                    $n2 = $this->db->get_where('user', array('parent_user_id'=>$n1['user_id'],'user_state'=>1))->row_array();
                    if ($n2){
                        $rs = $this->db->query("update wallet set point=point+{$point2} where user_id={$n2['user_id']}");
                        if (!$rs){
                            //记录错误日志
                        }else{
                            //记录账单
                            $billInfo = array(
                                'bill_type' => 3,//收益
                                'bill_currency' => 3,//积分
                                'transfer_frome_user_id' => 0,//系统
                                'transfer_to_user_id' => $n2['user_id'],//进入账户
                                'bill_amount' => $point2,
                                'bill_remark' => '系统收益',
                                'bill_addtime' => date('Y-m-d h:i:s')
                                );
                            $this->db->insert('bill',$billInfo);
                        }
                        //第三层
                        $n3 = $this->db->get_where('user', array('parent_user_id'=>$n2['user_id'],'user_state'=>1))->row_array();
                        if ($n3){
                            $rs = $this->db->query("update wallet set point=point+{$point3} where user_id={$n3['user_id']}");
                            if (!$rs){
                                //记录日志
                            }else{
                                //记录账单
                                $billInfo = array(
                                    'bill_type' => 3,//收益
                                    'bill_currency' => 3,//积分
                                    'transfer_frome_user_id' => 0,//系统
                                    'transfer_to_user_id' => $n3['user_id'],//进入账户
                                    'bill_amount' => $point3,
                                    'bill_remark' => '系统收益',
                                    'bill_addtime' => date('Y-m-d h:i:s')
                                );
                                $this->db->insert('bill',$billInfo);
                            }
                        }else{
                            //第三个用户不存在
                        }
                    }else{
                        //第二个用户不存在
                    }
                }else{
                    //第一个用户不存在
                }
            }
        }
        //
        echo 'ok';
    }
}

?>