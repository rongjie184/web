<?php

class FuncModel extends CI_Model
{
   
    public function __construct()
    {
        parent::__construct();
       
    }

    /**
     * 增加一条记录
     * @wangrongjie
     * @DateTime    2018-05-29T11:06:20+0800
     * @param       array                    $data [description]
     */
    public function add($table,$data = array())
    {
        $this->db->insert($table,$data);
        $id = $this->db->insert_id();
       // return $this->db->last_query();
        return $id;
    }
    /**
     * 根据条件获取一条记录
     * @wangrongjie
      * @DateTime    2018-06-05T11:06:20+0800
     * @param       [type]                   $where 可以为数字 PRIMARYKEY字段, 也可以为数组 where 查询条件数组
     * @return      [type]                   [description]
     */
    public function get_one($table,$where)
    {  
        $this->_where($where);
        $result = $this->db->select()->from($table)->get()->row_array();
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
    public function get_all($table,$where, $start = 0, $end = 0)
    {
        if ($start || $end) {
            $this->db->limit($end, $start);
        }
        $this->_where($where);
        $result = $this->db->select()->from($table)->get()->result_array();
        return $result;
    } 
    /**
     * 获取符合条件的记录数
     * @wangrongjie
      * @DateTime    2018-06-05T11:06:20+0800
     * @param       [type]                   $where [description]
     * @return      [type]                          [description]
     */
    public function count($table,$where)
    {
        $this->_where($where);
        $num = $this->db->count_all_results($table);
        return $num;
    }
    /**
     * 通用 处理where 条件
     * @wangrongjie
      * @DateTime    2018-06-05T11:06:20+0800
     * @param       [type]                   $where [description]
     * @return      [type]                          [description]
     */
    public function _where($where)
    {
        if (!is_array($where)) {
            return;
        }
		//组别
		if (isset($where['gnames']) && $where['gnames']) {
            $this->db->like('gname', $where['gnames'], 'both');
            unset($where['gnames']);
        } 
		//工作内容
		if (isset($where['wnames']) && $where['wnames']) {
            $this->db->like('wname', $where['wnames'], 'both');
            unset($where['wnames']);
        } 
        //SMO公司名称
		if (isset($where['cnames']) && $where['cnames']) {
            $this->db->like('cname', $where['cnames'], 'both');
            unset($where['cnames']);
        } 
		//申办方公司名称
		if (isset($where['snames']) && $where['snames']) {
            $this->db->like('sname', $where['snames'], 'both');
            unset($where['snames']);
        } 
		
		//CRO公司名称
		if (isset($where['crnames']) && $where['crnames']) {
            $this->db->like('crname', $where['crnames'], 'both');
            unset($where['crnames']);
        } 

		//CRA名称
		if (isset($where['cranames']) && $where['cranames']) {
            $this->db->like('cra_name', $where['cranames'], 'both');
            unset($where['cranames']);
        } 

		//项目进度名称
		if (isset($where['pnames']) && $where['pnames']) {
            $this->db->like('name', $where['pnames'], 'both');
            unset($where['pnames']);
        } 

		//项目进度名称
		if (isset($where['names']) && $where['names']) {
            $this->db->like('name', $where['names'], 'both');
            unset($where['names']);
        } 


		if (isset($where['crc']) && $where['crc']) {
            $this->db->where('role_id !=', 3);
            unset($where['crc']);
        } 

        if (count($where)) {
            $this->db->where($where);
        }
    }
    /**
     * 编辑一条记录
     * @wangrongjie
     * @DateTime    2018-06-05T11:06:20+0800
     * @param       [type]                   $data [description]
     * @param       [type]                   $aid  [description]
     * @return      [type]                         [description]
     */
    public function edit($table,$data, $where)
    {
        $this->db->where($where);
        $result = $this->db->update($table, $data);
        return $result;
    }

	/**
     * 根据多条主键 编辑记录
     * @wangrongjie
     * @DateTime    2018-06-05T11:31:22+0800
     * @param       [type]                   $data [description]
     * @param       [type]                   $wherein  [description]
     * @return      [type]                         [description]
     */
    public function edit_wherein($table,$data, $wherein=array())
    { 
        $this->_where($where);
		if(count($wherein)>0){
			$this->db->where_in('id',$wherein);
		}
        $result = $this->db->update($table, $data);
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
     * 根据条件获取多条记录
     * @wangrongjie
     * @DateTime    2018-06-11T11:06:31+0800
     * @param       [type]                   $where [description]
     * @param       integer                  $start [description]
     * @param       integer                  $end   [description]
     * @return      [type]                          [description]
     */
    public function get_all_gl($table,$where, $start = 0, $end = 0)
    {
        if($table=='crc_news'){
			$sql="select n.* from ".$table." cn left join news n on n.id=cn.news_id where 1";
		}elseif($table=='crc_inits'){
			$sql="select n.*,cn.items_id,cn.section_id from ".$table." cn left join inst n on n.id=cn.inits_id left join dept d on cn.section_id=d.id where 1";
		
		}elseif($table=='crc_items'){
			$sql="select n.*,cn.enter_time,cn.out_time,cn.inis_id from  ".$table." cn left join items n on n.id=cn.items_id where 1";
		}
		if (isset($where['title']) && $where['title']) {
			$search=$where['title'];
			$sql.=" and (n.title like '%".$search."%' or n.ftitle like '%".$search."%')";
		}
		if (isset($where['itemname']) && $where['itemname']) { 
			$itemname=$where['itemname'];
			$sql.=" and (n.name like '%".$itemname."%' or n.shortname like '%".$itemname."%')";
		}

		if (isset($where['inisname']) && $where['inisname']) {
			$inisname=$where['inisname'];
			$sql.=" and (n.inisname like '%".$inisname."%' or n.shortname like '%".$inisname."%')";
		}
		if(isset($where['company_id']) && $where['company_id']){
			$sql.=" and n.company_id= ".$where['company_id'];		
		}

		if(isset($where['smo_company']) && $where['smo_company']){
			$sql.=" and n.smo_company= ".$where['smo_company'];		
		}

		if(isset($where['uid']) && $where['uid']){
			$sql.=" and cn.uid= ".$where['uid'];		
		}
		if(isset($where['type']) && $where['type']){
			$sql.=" and cn.type= ".$where['type'];		
		}

		if(isset($where['area_id']) && $where['area_id']){
			$sql.=" and n.area_id= ".$where['area_id'];		
		}
		if(isset($where['city_id']) && $where['city_id']){
			$sql.=" and n.city_id= ".$where['city_id'];		
		}
		if(isset($where['province_id']) && $where['province_id']){
			$sql.=" and n.province_id= ".$where['province_id'];		
		}

		if($table=='crc_items'){
			$sql.=" order by cn.items_id desc";
		}

		if($table=='crc_inits'){
			$sql.=" order by cn.inits_id desc";
		}


		if($start&&$end){$sql.=" limit ".$start.",".$end;}
		
	    $result= $this->db->query($sql)->result_array();
        return $result;

    }
    /**
     * 获取符合条件的记录数
     * @wangrongjie
     * @DateTime    2018-06-11T11:06:31+0800
     * @param       [type]                   $where [description]
     * @return      [type]                          [description]
     */
    public function count_gl($table,$where)
    {
        if($table=='crc_news'){
			$sql="select n.* from ".$table." cn left join news n on n.id=cn.news_id where 1";
		}elseif($table=='crc_inits'){
			$sql="select n.*,cn.items_id,cn.section_id from ".$table." cn left join inst n on n.id=cn.inits_id left join dept d on cn.section_id=d.id where 1";
		
		}elseif($table=='crc_items'){
			$sql="select n.*,cn.enter_time,cn.out_time,cn.inis_id from  ".$table." cn left join items n  on n.id=cn.items_id where 1";
		}
		if (isset($where['title']) && $where['title']) {
			$search=$where['title'];
			$sql.=" and (n.title like '%".$search."%' or n.ftitle like '%".$search."%')";
		}
		if (isset($where['itemname']) && $where['itemname']) { 
			$itemname=$where['itemname'];
			$sql.=" and (n.name like '%".$itemname."%' or n.shortname like '%".$itemname."%')";
		}

		if (isset($where['inisname']) && $where['inisname']) {
			$inisname=$where['inisname'];
			$sql.=" and (n.inisname like '%".$inisname."%' or n.shortname like '%".$inisname."%')";
		}
		if(isset($where['company_id']) && $where['company_id']){
			$sql.=" and n.company_id= ".$where['company_id'];		
		}

		if(isset($where['smo_company']) && $where['smo_company']){
			$sql.=" and n.smo_company= ".$where['smo_company'];		
		}

		if(isset($where['uid']) && $where['uid']){
			$sql.=" and cn.uid= ".$where['uid'];		
		}
		if(isset($where['type']) && $where['type']){
			$sql.=" and cn.type= ".$where['type'];		
		}

		if(isset($where['area_id']) && $where['area_id']){
			$sql.=" and n.area_id= ".$where['area_id'];		
		}
		if(isset($where['city_id']) && $where['city_id']){
			$sql.=" and n.city_id= ".$where['city_id'];		
		}
		if(isset($where['province_id']) && $where['province_id']){
			$sql.=" and n.province_id= ".$where['province_id'];		
		}

		$query = $this->db->query($sql);
        $num = $query->num_rows(); 
        return $num;
    }



	/**
     * 根据条件获取多条记录 省市区
     * @wangrongjie
     * @DateTime    2018-06-14T11:06:31+0800
     * @param       [type]                   $where [description]
     * @param       integer                  $start [description]
     * @param       integer                  $end   [description]
     * @return      [type]                          [description]
     */
    public function get_all_ssq($table,$where, $start = 0, $end = 0)
    {
       
	   if((isset($where['search']) && $where['search'])&&$table){
		   if($table=='city'){
			   $sql="select * from ".$table." where name like '%".$where['search']."%' or short_name like '%".$where['search']."%' or id like '%".$where['search']."%' or parent_id like '%".$where['search']."%' ";
		   
		   }else{
			   $sql="select * from ".$table." where name like '%".$where['search']."%' or short_name like '%".$where['search']."%' or id like '%".$where['search']."%' ";
		   
		   }
		   
	   
	   }
	   if((isset($table) && $table)&&($where['search']==null||$where['search']=='')){
		    $sql="select * from ".$table." where 1";
	   }
	   if(isset($where['status']) && $where['status']){
		    $sql.=" and status=".$where['status'];
	   }


		if($start&&$end){$sql.=" limit ".$start.",".$end;}
		
	    $result= $this->db->query($sql)->result_array();
        return $result;

    }
    /**
     * 获取符合条件的记录数 省市区
     * @wangrongjie
     * @DateTime    2018-06-14T11:06:31+0800
     * @param       [type]                   $where [description]
     * @return      [type]                          [description]
     */
    public function count_ssq($table,$where)
    {
       
         if((isset($where['search']) && $where['search'])&&$table){
		   if($table=='city'){
			   $sql="select * from ".$table." where name like '%".$where['search']."%' or short_name like '%".$where['search']."%' or id like '%".$where['search']."%' or parent_id like '%".$where['search']."%' ";
		   
		   }else{
			   $sql="select * from ".$table." where name like '%".$where['search']."%' or short_name like '%".$where['search']."%' or id like '%".$where['search']."%' ";
		   
		   }
		   
	   
	   }
	    if((isset($table) && $table)&&($where['search']==null||$where['search']=='')){
		    $sql="select * from ".$table." where 1";
	   }
	   if(isset($where['status']) && $where['status']){
		    $sql.=" and status=".$where['status'];
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
     * @param       integer                  $start [description]
     * @param       integer                  $end   [description]
     * @return      [type]                          [description]
     */
    public function get_all_gt($where, $start = 0, $end = 0)
    {
       
		$sql = "select cc.id,cc.crname,cc.cra_name,ici.items_id,ici.inis_id,ici.cro_id,ici.status from cro_company cc left join item_cro_inis ici on cc.id=ici.cro_id where ici.items_id=".$where['items_id']." and ici.inis_id=".$where['inits_id']." and  ici.status=1";
		if (isset($where['cranames']) && $where['cranames']) {
			$search=$where['cranames'];
			$sql.=" and (cc.cra_name like '%".$search."%')";
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
    public function count_gt($where)
    {
      $sql = "select * from cro_company cc left join item_cro_inis ici on cc.id=ici.cro_id where ici.items_id=".$where['items_id']." and ici.inis_id=".$where['inits_id']." and  ici.status=1";
		if (isset($where['cranames']) && $where['cranames']) {
			$search=$where['cranames'];
			$sql.=" and (cc.cra_name like '%".$search."%')";
		}

		$query = $this->db->query($sql);
        $num = $query->num_rows(); 
        return $num;
    }
	

   /**
   **方案管理
   **/
	function count_pro_check($where){
		$sql = "select * from items_pro_base ipb  left join items it on it.id=ipb.items_id ";
		if (isset($where['items_id']) && $where['items_id']) {
			$items_id=$where['items_id'];
			$sql.=" and it.items_id=".$items_id;
		}
		if (isset($where['test_id']) && $where['test_id']) {
			$test_id=$where['test_id'];
			$sql.=" and ip.test_id=".$test_id;
		}
		if (isset($where['meddle_type']) && $where['meddle_type']) {
			$meddle_type=$where['meddle_type'];
			$sql.=" and ipb.meddle_type=".$meddle_type;
		}
		if (isset($where['use_methods']) && $where['use_methods']) {
			$use_methods=$where['use_methods'];
			$sql.=" and ipb.use_methods=".$use_methods;
		}
		$query = $this->db->query($sql);
        $num = $query->num_rows(); 
        return $num;
	
	}
    /**
   **方案管理
   **/
	function get_all_pro_check($where, $start = 0, $end = 0){
		$sql = "select * from items_pro_base ipb  left join items it on it.id=ipb.items_id ";
			if (isset($where['items_id']) && $where['items_id']) {
			$items_id=$where['items_id'];
			$sql.=" and it.items_id=".$items_id;
		}
		if (isset($where['test_id']) && $where['test_id']) {
			$test_id=$where['test_id'];
			$sql.=" and it.test_id=".$test_id;
		}
		if (isset($where['meddle_type']) && $where['meddle_type']) {
			$meddle_type=$where['meddle_type'];
			$sql.=" and ipb.meddle_type=".$meddle_type;
		}
		if (isset($where['use_methods']) && $where['use_methods']) {
			$use_methods=$where['use_methods'];
			$sql.=" and ipb.use_methods=".$use_methods;
		}
		if($start&&$end){$sql.=" limit ".$start.",".$end;}
		
	    $result= $this->db->query($sql)->result_array();
        return $result;
	
	}











}
