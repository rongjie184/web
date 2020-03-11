<?php

class InstModel extends CI_Model
{
    public $table;
    public $primary_key;
    // 字段
    public $fields;
    // 场景
    public $sences;
    public function __construct()
    {
        parent::__construct();
        $this->table       = 'inst';
        $this->primary_key = 'id';
        // 生效 字段设置
        $this->field();
        // 验证
        $this->rules();
    }

    public function field()
    {
        
    }
    public function rules()
    {
        // 场景
        $this->sences = array(
            'add' => array(
                'rolename'   => array('unique')     
            )
        );

    }


    /**
     * 检查 某主键id 该条记录的 某个字段 是否有值
     * @wanglindong
     * @DateTime    2016-11-24T11:31:22+0800
     * @param       [type]                   $data [description]
     * @return      [type]                         [description]
     */
    public function field_check($data)
    {
        $id    = $data['id'];
        $field = $data['field'];
        $row   = $this->get_one($id);
        if ($row[$field]) {
            return true;
        }
        return false;
    }

    /**
     * 增加一条记录
     * @wanglindong
     * @DateTime    2016-10-26T11:05:51+0800
     * @param       array                    $data [description]
     */
    public function add($data = array(),$table=null)
    {
        if(empty($table)){
            $table = $this->table;
        }
        $this->db->insert($table, $data);
        $id = $this->db->insert_id();
        // return $this->db->last_query();
        return $id;
    }
    /**
     * 根据条件获取一条记录
     * @wanglindong
     * @DateTime    2016-10-26T11:06:00+0800
     * @param       [type]                   $where 可以为数字 PRIMARYKEY字段, 也可以为数组 where 查询条件数组
     * @return      [type]                   [description]
     */
    public function get_one($where,$table=null)
    {   
        if(empty($table)){
            $table= $this->table;
        }
        // 当$where 不为数组时,当primary key = $where处理,但不可为空
        if (!is_array($where)) {
            $id    = (int) $where;
            $where = array();
            if ($id) {
                $where[$this->primary_key] = $id;
            } else {
                return array();
            }
        }
        $this->_where($where);
      //  $this->db->select()->from($this->table)->get()->row_array();
        $result = $this->db->select()->from($table)->get()->row_array();
        // return $this->db->last_query();
        return $result;
    }
    /**
     * 根据条件获取多条记录
     * @wanglindong
     * @DateTime    2016-10-26T11:06:11+0800
     * @param       [type]                   $where [description]
     * @param       integer                  $start [description]
     * @param       integer                  $end   [description]
     * @return      [type]                          [description]
     */
    public function get_all($where,$table=null,$start = 0, $end = 0)
    {
        if(empty($table)){
            $table = $this->table;
        }
        if ($start || $end) {
            $this->db->limit($end, $start);
        }
            //$this->db->order_by('add_time','desc');
        $this->_where($where);
        $result = $this->db->select()->from($table)->get()->result_array();
        // return $this->db->last_query($result);
        return $result;
    }

    public function get_city($where,$table=null)
    {
        if(empty($table)){
            $table = $this->table;
        }
     
        $this->_where($where);
        $result = $this->db->select()->from($table)->get()->result_array();
        // return $this->db->last_query($result);
        return $result;
    
    }

    /**
     * 根据in条件获取多条记录
     * @wanglindong
     * @DateTime    2016-10-26T11:06:11+0800
     * @param       [type]                   $where [description]
     * @param       integer                  $start [description]
     * @param       integer                  $end   [description]
     * @return      [type]                          [description]
     */
    public function get_in($table,$where,$columns)
    {
        
        $this->db->where_in($columns, $where);
        $result = $this->db->select()->from($table)->get()->result_array();
        // return $this->db->last_query($result);
        return $result;
    }
    /**
     * 获取符合条件的记录数
     * @wanglindong
     * @DateTime    2016-10-26T11:06:20+0800
     * @param       [type]                   $where [description]
     * @return      [type]                          [description]
     */
    public function count($where,$table=null)
    {
        if(empty($table)){
            $table = $this->table;
        }
        $this->_where($where);
        $num = $this->db->count_all_results($table);
        return $num;
    }
    //2表
    public function countw($where,$table=array(),$link)
    {
        $this->_where($where);
        $num = $this->db->select('count(*) AS num')->from($table['0'])->join($table['1'],$link,'left')->get()->row_array();
        // return $this->db->last_query();
        return $num['num'];
    }
    /**
     * 通用 处理where 条件
     * @wanglindong
     * @DateTime    2016-10-26T15:12:26+0800
     * @param       [type]                   $where [description]
     * @return      [type]                          [description]
     */
    public function _where($where)
    {
        if (!is_array($where)) {
            return;
        }
        if (isset($where['search']) && $where['search']) {

        $this->db->like($where['column'], $where['search'], 'both');
        // $this->db->or_like($where['column1'], $where['search1'], 'both');
        unset($where['column']);
        unset($where['search']);
        
        } 
        if (count($where)) {
            // return $where;
            $this->db->where($where);
        }
    }
    /**
     * 根据主键 编辑一条记录
     * @wanglindong
     * @DateTime    2016-10-26T11:06:31+0800
     * @param       [type]                   $data [description]
     * @param       [type]                   $aid  [description]
     * @return      [type]                         [description]
     */
    public function edit($data,$aid,$table=null)
    {
        if(!$table){
            $table = $this->table;
        }
        $this->db->where($this->primary_key, $aid);
        $result = $this->db->update($table, $data);
        // return $this->db->last_query();
        return $result;
    }

    /**
     * 获取地区列表记录
     * @wanglindong
     * @DateTime    2016-10-26T11:06:31+0800
     * @param       [type]                   $data [description]
     * @param       [type]                   $aid  [description]
     * @return      [type]                         [description]
     */
    public function area($table='provinces',$parent=null)
    {
        if(!empty($parent)){
           $this->db->where('parent_id',$parent);
        }
        // return $table;
        $result = $this->db->select()->from($table)->get()->result_array();
        return $result;
    }

    // public function area_one($where=array())
    // {
    //     $this->db->where_in('id',$where);
    //     $query = $this->db->select()->from('provinces')->get()->result_array();
    //     foreach ($query as $key => $val)
    //     {
    //         $arr[$key]['id'] =$val['id'];
    //         $arr[$key]['short_name'] =$val['short_name'];
    //     }
    //     // return $this->db->last_query();
        
    //     return $arr;
    // }

    /**
     * 获取单个省，市
     * @wanglindong
     * @DateTime    2016-10-26T11:06:31+0800
     * @param       [type]                   $data [description]
     * @param       [type]                   $aid  [description]
     * @return      [type]                         [description]
     */
    public function area_one($where,$table)
    {
        if (!is_array($where)) {
            $id    = (int) $where;
            $where = array();
            if ($id) {
                $where[$this->primary_key] = $id;
            } else {
                return array();
            }
        }
        $this->db->where($where);
        $query = $this->db->select()->from($table)->get()->row_array();
        return $query;
    }

    /**
     * 获取机构详情
     * @wanglindong
     * @DateTime    2016-10-26T11:06:31+0800
     * @param       [type]                   $data [description]
     * @param       [type]                   $aid  [description]
     * @return      [type]                         [description]
     */
    public function inst_get_one($where)
    {
        
        $this->_where($where);
        $result = $this->db->select()->from('inst_detail')->get()->result_array();
        return $result;
    }

    /**
     * 2表联查详情
     * @wanglindong
     * @DateTime    2016-10-26T11:06:31+0800
     * @param       [type]                   $data [description]
     * @param       [type]                   $aid  [description]
     * @return      [type]                         [description]
     */
    public function join($where,$table=array(),$link,$columns=null,$start=null,$end=null)
    {
        if ($start || $end) {
            $this->db->limit($end, $start);
        }
        //return $end;
        $this->_where($where);
        $result = $this->db->select($columns)->from($table['0'])->join($table['1'],$link,'left')->get()->result_array();
        // return $this->db->last_query();
        return $result;
    
    }

    //3表
    public function join_tj($where,$table=array(),$link,$columns=null,$start=null,$end=null)
    {
        if ($start || $end) {
            $this->db->limit($end, $start);
        }
        //return $end;
        $this->_where($where);
        $result = $this->db->select($columns)->from($table['0'])->join($table['1'],$link['0'],'left')->join($table['2'],$link['1'],'left')->get()->result_array();
        // return $this->db->last_query();
        return $result;
    
    }
    //3表
    public function count_p($where,$table=array(),$link,$w)
    {
        $this->_where($where);
        $num = $this->db->select($w)->from($table['0'])->join($table['1'],$link['0'],'left')->join($table['2'],$link['1'],'left')->get()->result_array();
        // return $this->db->last_query();
        return count($num);
    }

    //4表
    public function join_s($where,$table=array(),$link,$columns=null,$start=null,$end=null)
    {
        if ($start || $end) {
            $this->db->limit($end, $start);
        }
        //return $end;
        $this->_where($where);
        $result = $this->db->select($columns)->from($table['0'])->join($table['1'],$link['0'],'left')->join($table['2'],$link['1'],'left')->join($table['3'],$link['2'],'left')->get()->result_array();
        // return $this->db->last_query();
        return $result;
    
    }



    /**
     * 删除记录
     * @wangrongjie
     * @DateTime    2018-06-05T11:06:20+0800
     * @param       [type]                   $data [description]
     * @param       [type]                   $aid  [description]
     * @return      [type]                         [description]
     */
   function del_table($table,$where){
        $this->db->where($where);
        $this->db->delete($table);
    }


    /**
     * 身份证号获取出生日期
     * @wangrongjie
     * @DateTime    2018-06-05T11:06:20+0800
     * @param       [type]                   $data [description]
     * @param       [type]                   $aid  [description]
     * @return      [type]                         [description]
     */
    function card_to_birth($card,$type=null){
        if(empty($card)) return '';
        $date=strtotime(substr($card,6,8));
        if(!$type){        
            return date('Y-m-d',$date);
        }
        $today=strtotime('today');
        $diff=floor(($today-$date)/86400/365);
        //如果超过了出身月份加1
        $age=strtotime(substr($card,6,8).' +'.$diff.'years')>$today?($diff+1):$diff;
        return $age; 
    }



}
