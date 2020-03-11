<?php

class CrcresumesModel extends CI_Model
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
        $this->table       = 'crc_resumes';
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
       
    }


    /**
     * 检查 某主键id 该条记录的 某个字段 是否有值
     * @wangrongjie
     * @DateTime    2018-06-06T11:06:31+0800
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
     * @wangrongjie
     * @DateTime    2018-06-06T11:06:31+0800
     * @param       array                    $data [description]
     */
    public function add($data = array())
    {
        $this->db->insert($this->table, $data);
		//$this->db->insert_id();
		//echo $this->db->last_query();;
        $id = $this->db->insert_id();
        return $id;
    }
    /**
     * 根据条件获取一条记录
     * @wangrongjie
      * @DateTime    2018-06-05T11:06:20+0800
     * @param       [type]                   $where 可以为数字 PRIMARYKEY字段, 也可以为数组 where 查询条件数组
     * @return      [type]                   [description]
     */
    public function get_one($where)
    {  
        $this->_where($where);
        $result = $this->db->select()->from($this->table)->get()->row_array();
        return $result;
    }

	 /**
     * 根据条件获取多条记录
     * @wangrongjie
      * @DateTime    2018-06-05T11:06:20+0800
     * @param       [type]                   $where [description]
     * @param       integer                  $start [description]
     * @param       integer                  $end   [description]
     * @return      [type]                          [description]
     */
    public function get_rs_all($where)
    {
       
        $this->_where($where);
        $result = $this->db->select()->from($this->table)->get()->result_array();
        return $result;
    } 


    /**
     * 根据条件获取多条记录
     * @wangrongjie
     * @DateTime    2018-06-06T11:06:31+0800
     * @param       [type]                   $where [description]
     * @param       integer                  $start [description]
     * @param       integer                  $end   [description]
     * @return      [type]                          [description]
     */
    public function get_all($where, $start = 0, $end = 0)
    {
		$sql = "select cu.uid,cu.sex,cu.company_id,cu.work_year,cu.resumes_status,wu.uname,wu.email,wu.phone from crc_user cu left join web_user wu on cu.uid=wu.uid where 1";

		if (isset($where['search']) && $where['search']) {
			$search=$where['search'];
			$sql.=" and (wu.uname like '%".$search."%' or wu.account like '%".$search."%' or wu.email like '%".$search."%' or wu.phone like '%".$search."%')";
		}
		
		if(isset($where['company_id']) && $where['company_id']){
			$sql.=" and cu.company_id= ".$where['company_id'];		
		}
		if(isset($where['sex_id']) && $where['sex_id']){
			$sql.=" and cu.sex= ".$where['sex_id'];		
		}

		if(isset($where['work_year']) && $where['work_year']){
			$sql.=" and cu.work_year >= ".$where['work_year'];		
		}

		
		if($start&&$end){$sql.=" limit ".$start.",".$end;}
		
	    $result= $this->db->query($sql)->result_array();
        return $result;

    }
    /**
     * 获取符合条件的记录数
     * @wangrongjie
     * @DateTime    2018-06-06T11:06:31+0800
     * @param       [type]                   $where [description]
     * @return      [type]                          [description]
     */
    public function count($where)
    {
		$sql = "select cu.uid,cu.sex,cu.company_id,cu.work_year,cu.resumes_status,wu.uname,wu.email,wu.phone from crc_user cu left join web_user wu on cu.uid=wu.uid where 1";

		if (isset($where['search']) && $where['search']) {
			$search=$where['search'];
			$sql.=" and (wu.uname like '%".$search."%' or wu.account like '%".$search."%' or wu.email like '%".$search."%' or wu.phone like '%".$search."%')";
		}
		
		if(isset($where['company_id']) && $where['company_id']){
			$sql.=" and cu.company_id= ".$where['company_id'];		
		}
		if(isset($where['sex_id']) && $where['sex_id']){
			$sql.=" and cu.sex= ".$where['sex_id'];		
		}

		if(isset($where['work_year']) && $where['work_year']){
			$sql.=" and cu.work_year >= ".$where['work_year'];		
		}

		$query = $this->db->query($sql);
        $num = $query->num_rows(); 
        return $num;
    }
    /**
     * 通用 处理where 条件
     * @wangrongjie
     * @DateTime    2018-06-06T11:06:31+0800
     * @param       [type]                   $where [description]
     * @return      [type]                          [description]
     */
    public function _where($where)
    {
       
	    if (!is_array($where)) {
            return;
        }
        if (count($where)) {
            $this->db->where($where);
        }
    }
    /** 
     * 根据主键 编辑一条记录
     * @wangrongjie
     * @DateTime    2018-06-06T11:06:31+0800
     * @param       [type]                   $data [description]
     * @param       [type]                   $aid  [description]
     * @return      [type]                         [description]
     */
    public function edit($data, $aid)
    {
        $this->db->where($this->primary_key, $aid);
        $result = $this->db->update($this->table, $data);
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
   function del($where){
		$this->db->where($where);
		$this->db->delete($this->table);
	}



}
