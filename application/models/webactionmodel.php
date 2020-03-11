<?php
	class WebactionModel extends CI_Model{

    function __construct()
    {
        parent::__construct();
    }
    function get_login_user_action() {
        return true;
    }

    function get_showlist($parentid) {
        $this->db->order_by('order','asc');
        $this->db->order_by('id');
        $arr['show'] = 1;
        if($parentid){
            $arr['pid'] = $parentid;

            return $this->db->select()->where($arr)->get('web_priv')->result_array();
        }else{
            $arr['pid'] = 0;
            return $this->db->select()->where($arr)->get('web_priv')->result_array();
        }
    }

    function get_action($parentid,$isgame=0) {

        $arr['pid'] = intval($parentid);
        $arr['game'] = $isgame;
        return $this->db->select()->where($arr)->get('web_priv')->result_array();

    }

    function get_action_by_id($id) {
            $arr['id'] = $id;
            return $this->db->select()->where($arr)->get('web_priv')->row_array();
    }


    function edit_action($data,$action_id) {
        if($action_id){
            $this->db->where('id', $action_id);
            return $this->db->update('web_priv', $data);
        }
        return array();
    }

    /**
     * 根据条件获得一条记录
     * @param  [type] $where [description]
     * @return [type]        [description]
     */
    function action_exist($where){

        return $this->db->select()->where($where)->get('web_priv')->row_array();

    }
    function add_action($data) {
        return $this->db->insert('web_priv', $data);
    }
    /**
     * 获得所有顶级权限
     * @return [type] [description]
     */
	function parentlists() {

          return $this->db->select('id,name')->from('web_priv')->where(array('pid'=>0))->get()->result_array();
    }

    /**
     * 获取 权限列表分页
     * @param  [type]  $start [description]
     * @param  integer $end   [description]
     * @param  array   $where [description]
     * @return [type]         [description]
     */
    public function get_list_page($start, $end=0,$where=array()) {
        if(count($where)){
            if($where['search']) {
                $this->db->like('name',$where['search']);
                $this->db->or_like('code',$where['search']);
            }
        }
        return $this->db->select()->order_by('id','DESC')->from('web_priv')->limit($end, $start)->get()->result_array();
    }
    /**
     * 获取权限列表总数
     * @param  [type] $where [description]
     * @return [type]        [description]
     */
    public function action_count($where) {
        if(count($where)){
            if($where['search']) {
                $this->db->like('name',$where['search']);
                $this->db->or_like('code',$where['search']);
            }
        }
        return $this->db->count_all_results('web_priv');
        //echo $this->db->last_query();
        
    }
}

?>