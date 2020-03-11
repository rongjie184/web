<?php

class CrcModel extends CI_Model
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
        $this->table       = 'crc_user';
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
        $id = $this->db->insert_id();
        return $id;
    }
    /**
     * 根据条件获取一条记录
     * @wangrongjie
     * @DateTime    2018-06-06T11:06:31+0800
     * @param       [type]                   $where 可以为数字 PRIMARYKEY字段, 也可以为数组 where 查询条件数组
     * @return      [type]                   [description]
     */
    public function get_one($uid)
    {
       $sql = "select * from crc_user cu right join web_user wu on cu.uid=wu.uid where  wu.uid=".$uid;
	   
	   $result=$this->db->query($sql)->row_array();
		//echo $this->db->last_query();
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
        //$sql = "select * from web_user wu left join crc_user cu on cu.uid=wu.uid where wu.role_id !=3";
		$sql = "select * from crc_user cu right join web_user wu on cu.uid=wu.uid where wu.role_id !=3";

		if (isset($where['search']) && $where['search']) {
			$search=$where['search'];
			$sql.=" and (wu.uname like '%".$search."%' or wu.account like '%".$search."%' or wu.email like '%".$search."%' or wu.phone like '%".$search."%')";
		}
		if(isset($where['role_id']) && $where['role_id']){
			$sql.=" and wu.role_id= ".$where['role_id'];		
		}

		if(isset($where['company_id']) && $where['company_id']){
			$sql.=" and cu.company_id= ".$where['company_id'];		
		}
		if(isset($where['sex_id']) && $where['sex_id']){
			$sql.=" and cu.sex= ".$where['sex_id'];		
		}
		if(isset($where['group_id']) && $where['group_id']){
			$sql.=" and cu.group_id= ".$where['group_id'];		
		}
		if(isset($where['area_id']) && $where['area_id']){
			$sql.=" and cu.area_id= ".$where['area_id'];		
		}
		if(isset($where['city_id']) && $where['city_id']){
			$sql.=" and cu.city_id= ".$where['city_id'];		
		}
		if(isset($where['province_id']) && $where['province_id']){
			$sql.=" and cu.province_id= ".$where['province_id'];		
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
       $sql = "select * from crc_user cu right join web_user wu on cu.uid=wu.uid where wu.role_id !=3";
		if (isset($where['search']) && $where['search']) {
			$search=$where['search'];
			$sql.=" and (wu.uname like '%".$search."%' or wu.account like '%".$search."%' or wu.email like '%".$search."%' or wu.phone like '%".$search."%')";
		}
		if(isset($where['role_id']) && $where['role_id']){
			$sql.=" and wu.role_id= ".$where['role_id'];		
		}
		if(isset($where['company_id']) && $where['company_id']){
			$sql.=" and cu.company_id= ".$where['company_id'];		
		}
		if(isset($where['sex_id']) && $where['sex_id']){
			$sql.=" and cu.sex= ".$where['sex_id'];		
		}
		if(isset($where['group_id']) && $where['group_id']){
			$sql.=" and cu.group_id= ".$where['group_id'];		
		}
		if(isset($where['area_id']) && $where['area_id']){
			$sql.=" and cu.area_id= ".$where['area_id'];		
		}
		if(isset($where['city_id']) && $where['city_id']){
			$sql.=" and cu.city_id= ".$where['city_id'];		
		}
		if(isset($where['province_id']) && $where['province_id']){
			$sql.=" and cu.province_id= ".$where['province_id'];		
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
     * 根据条件获取多条记录
     * @wangrongjie
     * @DateTime    2018-06-06T11:06:31+0800
     * @param       [type]                   $where [description]
     * @param       integer                  $start [description]
     * @param       integer                  $end   [description]
     * @return      [type]                          [description]
     */
    public function get_all_tj($where, $start = 0, $end = 0,$orderby)
    {
        //$sql = "select * from web_user wu left join crc_user cu on cu.uid=wu.uid where wu.role_id !=3";
		$sql = "select * from crc_user cu right join web_user wu on cu.uid=wu.uid ";
		
		if((isset($where['items_id']) && $where['items_id'])||(isset($where['inis_id']) && $where['inis_id'])||(isset($where['items']) && $where['items'])){
			$sql.=" left join crc_items ci on ci.uid=cu.uid";		
		}
		
		$sql.=" where wu.role_id !=3";

		if(isset($where['items_id']) && $where['items_id']){
			$sql.=" and ci.items_id=".$where['items_id'];		
		}

		if(isset($where['items']) && $where['items']){
			$sql.=" and ci.items_id in (".$where['items'].")";		
		}

		if(isset($where['inis_id']) && $where['inis_id']){
			$sql.=" and ci.inis_id=".$where['inis_id'];		
		}
		if(isset($where['company_id']) && $where['company_id']){
			$sql.=" and cu.company_id= ".$where['company_id'];		
		}
		if(isset($where['work_year']) && $where['work_year']){
			$sql.=" and cu.work_year>= ".$where['work_year'];		
		}
		
		if(isset($where['area_id']) && $where['area_id']){
			$sql.=" and cu.area_id= ".$where['area_id'];		
		}
		if(isset($where['city_id']) && $where['city_id']){
			$sql.=" and cu.city_id= ".$where['city_id'];		
		}
		if(isset($where['province_id']) && $where['province_id']){
			$sql.=" and cu.province_id= ".$where['province_id'];		
		}

		if(isset($where['null']) && $where['null']){
			$sql.=" and cu.items_num <0 ";		
		}


        $sql.=" group by cu.uid";
		if(isset($orderby) && $orderby){
			$sql.="  order by wu.uid ".$orderby;		
		} 

		
   //  echo $sql;

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
    public function count_tj($where)
    {
      $sql = "select * from crc_user cu right join web_user wu on cu.uid=wu.uid ";
		
		if((isset($where['items_id']) && $where['items_id'])||(isset($where['inis_id']) && $where['inis_id'])||(isset($where['items']) && $where['items'])){
			$sql.=" left join crc_items ci on ci.uid=cu.uid";		
		}
		
		$sql.=" where wu.role_id !=3";

		if(isset($where['items_id']) && $where['items_id']){
			$sql.=" and ci.items_id=".$where['items_id'];		
		}

		if(isset($where['items']) && $where['items']){
			$sql.=" and ci.items_id in (".$where['items'].")";		
		}

		if(isset($where['inis_id']) && $where['inis_id']){
			$sql.=" and ci.inis_id=".$where['inis_id'];		
		}
		if(isset($where['company_id']) && $where['company_id']){
			$sql.=" and cu.company_id= ".$where['company_id'];		
		}
		if(isset($where['work_year']) && $where['work_year']){
			$sql.=" and cu.work_year>= ".$where['work_year'];		
		}
		
		if(isset($where['area_id']) && $where['area_id']){
			$sql.=" and cu.area_id= ".$where['area_id'];		
		}
		if(isset($where['city_id']) && $where['city_id']){
			$sql.=" and cu.city_id= ".$where['city_id'];		
		}
		if(isset($where['province_id']) && $where['province_id']){
			$sql.=" and cu.province_id= ".$where['province_id'];		
		}

		if(isset($where['null']) && $where['null']){
			$sql.=" and cu.items_num <0 ";		
		}

        $sql.=" group by cu.uid";
		if(isset($orderby) && $orderby){
			$sql.="  order by wu.uid ".$orderby;		
		} 
		$query = $this->db->query($sql);
        $num = $query->num_rows(); 
        return $num;
    }




	/**
     * 根据条件获取多条记录
     * @wangrongjie
     * @DateTime    2018-06-06T11:06:31+0800
     * @param       [type]                   $where [description]
     * @return      [type]                          [description]
     */
    public function get_all_excle($where,$orderby)
    {
		
		$sql = "select * from crc_user cu right join web_user wu on cu.uid=wu.uid ";
		
		if((isset($where['items_id']) && $where['items_id'])||(isset($where['inis_id']) && $where['inis_id'])||(isset($where['items']) && $where['items'])){
			$sql.=" left join crc_items ci on ci.uid=cu.uid";		
		}
		
		$sql.=" where wu.role_id !=3";

		if(isset($where['items_id']) && $where['items_id']){
			$sql.=" and ci.items_id=".$where['items_id'];		
		}

		if(isset($where['items']) && $where['items']){
			$sql.=" and ci.items_id in (".$where['items'].")";		
		}

		if(isset($where['inis_id']) && $where['inis_id']){
			$sql.=" and ci.inis_id=".$where['inis_id'];		
		}
		if(isset($where['company_id']) && $where['company_id']){
			$sql.=" and cu.company_id= ".$where['company_id'];		
		}
		if(isset($where['work_year']) && $where['work_year']){
			$sql.=" and cu.work_year>= ".$where['work_year'];		
		}
		
		if(isset($where['area_id']) && $where['area_id']){
			$sql.=" and cu.area_id= ".$where['area_id'];		
		}
		if(isset($where['city_id']) && $where['city_id']){
			$sql.=" and cu.city_id= ".$where['city_id'];		
		}
		if(isset($where['province_id']) && $where['province_id']){
			$sql.=" and cu.province_id= ".$where['province_id'];		
		}

		if(isset($where['null']) && $where['null']){
			$sql.=" and cu.items_num <0 ";		
		}



        $sql.=" group by cu.uid";
		if(isset($orderby) && $orderby){
			$sql.="  order by wu.uid ".$orderby;		
		} 
	    $result= $this->db->query($sql)->result_array();
        return $result;



    }


}
 