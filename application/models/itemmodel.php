<?php

class ItemModel extends CI_Model
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
        $this->table       = 'items';
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
    public function get_one($where)
    {
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
        $result = $this->db->select()->from($this->table)->get()->row_array();
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
    public function get_all($where, $start = 0, $end = 0,$orderby)
    {
		if ($start || $end) {
            $this->db->limit($end, $start);
        }
		if($orderby==null||$orderby=='null'){
			$orderby='desc';
		}
		$this->db->select($this->table.'.*')->from($this->table);

		if($where['cro_id']){
			$this->db->join('item_cro', $this->table.'.id = item_cro.items_id','left');
			$this->db->where('item_cro.cro_id ',$where['cro_id']);
			unset($where['cro_id']);
			
		}

		if($where['smo_id']){
			$this->db->join('item_smo', $this->table.'.id = item_smo.items_id','left');
			$this->db->where('item_smo.smo_id',$where['smo_id']);
			unset($where['smo_id']);
			
		}

	    //echo $this->db->last_query();
        $this->db->order_by($this->table.'.id',$orderby);
        $this->_where($where);
		$result =$this->db->get()->result_array();

		//echo $this->db->last_query();
		


       //$result = $this->db->select()->from($this->table)->get()->result_array();
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
		if($where['cro_id']){
			$this->db->join('item_cro', $this->table.'.id = item_cro.items_id','left');
			$this->db->where('item_cro.cro_id ',$where['cro_id']);
			unset($where['cro_id']);
		}

		if($where['smo_id']){
			$this->db->join('item_smo', $this->table.'.id = item_smo.items_id','left');
			$this->db->where('item_smo.smo_id',$where['smo_id']);
			unset($where['smo_id']);
		}



        $this->_where($where);
        $num = $this->db->count_all_results($this->table);
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

		if(isset($where['search']) && $where['search'] ){			
        	$this->db->like('name',$where['search'],'both');
			$this->db->or_like('shortname',$where['search'],'both');
			$this->db->or_like('item_number',$where['search'],'both');
			$this->db->or_like('exte_number',$where['search'],'both');
        	unset($where['search']);
        }

		if(isset($where['indications']) && $where['indications'] ){			
        	$this->db->like('indications',$where['indications'],'both');
        	unset($where['indications']);
        }
		 if(isset($where['inis_num']) && $where['inis_num'] ){
			 if($where['inis_num']==1){
				 $this->db->where('inis_num =1');
			 }else{
				 $this->db->where('inis_num >',$where['inis_num']);
			 }
        	unset($where['inis_num']);
        }

		 if(isset($where['status']) && $where['status'] ){
			 if($where['status']==3){
				 $this->db->where('status =0');
			 }else{
				 $this->db->where('status =',$where['status']);
			 }
        	unset($where['status']);
        }

		if(isset($where['start_timestamp']) && $where['start_timestamp'] ){
            $this->db->where('start_time >=',$where['start_timestamp']);
            unset($where['start_timestamp']);
        }

        if(isset($where['end_timestamp']) && $where['end_timestamp'] ){
            $this->db->where('start_time <',$where['end_timestamp']);
            unset($where['end_timestamp']); 
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
     * 根据多条主键 编辑记录
     * @wangrongjie
     * @DateTime    2018-06-05T11:31:22+0800
     * @param       [type]                   $data [description]
     * @param       [type]                   $wherein  [description]
     * @return      [type]                         [description]
     */
    public function edit_wherein($data, $wherein=array())
    { 
        $this->_where($where);
		if(count($wherein)>0){
			$this->db->where_in('id',$wherein);
		}
        $result = $this->db->update($this->table, $data);
        return $result;
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
		
		if($orderby==null||$orderby=='null'){
			$orderby='desc';
		}

		$this->db->select($this->table.'.*')->from($this->table);

		if($where['cro_id']){
			$this->db->join('item_cro', $this->table.'.id = item_cro.items_id','left');
			$this->db->where('item_cro.cro_id ',$where['cro_id']);
			unset($where['cro_id']);
			
		}

		if($where['smo_id']){
			$this->db->join('item_smo', $this->table.'.id = item_smo.items_id','left');
			$this->db->where('item_smo.smo_id',$where['smo_id']);
			unset($where['smo_id']);
			
		}

        
        $this->db->order_by($this->table.'.id',$orderby);
        
        $this->_where($where);
		//$this->db->select()->from($this->table)->get()->result_array();

		//echo $this->db->last_query();
       $result = $this->db->get()->result_array();
       return $result;



    }




}
