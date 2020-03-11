<?php

class Patient extends MY_Controller
{
	//初始化
    public function __construct()
    {
        parent::__construct();
        // $this->output->enable_profiler(true);

    }

    /**
     * 患者列表-
     * @return [type] [description]
     */
    public function patient_list()
    {
    	$this->checkauth('patient_list');
    	$data['cdn'] = $this->cdn;
    	$this->load->model('instmodel');
    	$this->load->helper('Page');
    	
    	// 获取搜索条件
    	$where      = 'where u.state=0';
        $page_where = '';
    	$search     = trim($this->input->get_post('search'));
        if (isset($search) && $search) {
            $where .= " and u.uname like '%".$search."%'";
            $page_where      = 'search=' . $search;
        }

        $item = $this->input->get_post('xiangmu');
        if(isset($item) && $item){
        	$where .= " and i.id = $item";
        	$page_where      .= '&xiangmu=' . $item;
        }
        $where .=' and u.role_id = 1';
        // echo $where;
    	//查询到的总条数
    	$sql1 = "select count(*) as num from patient as p left join web_user as u on p.user_id=u.uid left join dept as d on p.dept = d.id left join items as i on p.itemid = i.id $where ";

        $count = $this->db->query($sql1)->row_array();

        $p = new page($count['num'],10,$page_where);
        $data['page']     = $p->show(); // 分页代码
        $data['search']   = $search;
        $data['item'] = $item;
        // echo $item;
        //
    	$limit = "limit $p->firstRow, $p->listRows";
    	$sql = "select p.id,p.sex,p.birth,u.uname,d.inst_name,d.name as dname,i.shortname,i.name as iname,p.status from patient as p left join dept as d on p.dept = d.id left join web_user as u on p.user_id=u.uid  left join items as i on p.itemid = i.id $where order by p.add_time desc $limit ";

        // $sql = "select p.id as pid,p.sex,p.birth,u.uname,u.uid asid,d.inst_name,d.name as dname,i.shortname,i.name as iname,u.state as status from web_user as u left join patient as p on p.user_id=u.uid left join dept as d on p.dept = d.id left join items as i on p.itemid = i.id $where order by p.add_time desc $limit ";

    	$result = $this->db->query($sql)->result_array();
    	// echo $this->db->last_query();
    	$data['userlist'] = $result;
    	$res = $this->instmodel->get_all($iwhere=null,$table='items');
    	$data['items'] = $res;
    	$this->load->view('admin/patient/patient_list',$data);
    }

    /**
     * 添加患者页面-
     * @return [type] [description]
     */
    
    public function add_patient()
    {
    	$this->checkauth('add_patient');
    	$data['cdn'] = $this->cdn;
    	$this->load->model('instmodel');
    	$data['shen'] = $this->instmodel->area();
    	$inst = $this->instmodel->get_all($iwhere='');
    	$data['inst'] = $inst;
        $uwhere = array('state'=>0);
    	$puser = $this->instmodel->get_all($uwhere,$table='web_user');
    	$data['puser'] = $puser;
        $jwhere = array('status'=>1);
    	$items = $this->instmodel->get_all($jwhere,$table='items');
    	$data['items'] = $items;
    	// var_dump($items);
    	$this->load->view('admin/patient/patient_add',$data);
    }

    /**
     * 添加患者-
     * @return [type] [description]
     */
    public function add_patient_do()
    {
    	$this->checkauth('add_patient');
    	$this->load->model('instmodel');
    	var_dump($_POST);
    	$pid = $this->input->post('patid');
    	$sex = $this->input->post('sex');
    	$birth = $this->input->post('birth');
    	$province = $this->input->post('province');
    	$city = $this->input->post('city');
    	$diagnosis = $this->input->post('diagnosis');
    	$diagnosis = implode('@',$diagnosis);
    	$items = $this->input->post('items');
    	$inst = $this->input->post('inst');
    	$dept = $this->input->post('dept');
    	$crc = $this->input->post('crcid');
        // $phone = $this->input->post('phone');
        $select_num = $this->input->post('select_num');
        $family = $this->input->post('family');
        $relation = $this->input->post('relation');
        $family_phone = $this->input->post('family_phone');
        $wechat = $this->input->post('wechat');


        $where = array('user_id'=>$pid);
        $is_pid = $this->instmodel->get_one($where,$table='patient');
        if($is_pid){
            go('/index.php/admin/patient/add_patient', '患者已经存在,请重新选择患者', GO_ERROR);
            exit;
        }
    	//需要添加的数据
    	$data = array('inst_id'=>$inst,'user_id'=>$pid,'sex'=>$sex,'birth'=>$birth,'province'=>$province,'city'=>$city,'diagnosis'=>$diagnosis,'itemid'=>$items,'dept'=>$dept,'crc'=>$crc,'phone'=>$phone,'select_num'=>$select_num,'family'=>$family,'relation'=>$relation,'family_phone'=>$family_phone,'wechat'=>$wechat,'add_time'=>time(),'status'=>1);
    	$result = $this->instmodel->add($data,$table='patient');
    	// echo $result;
    	if(!$result){
            go('/index.php/admin/patient/add_patient', '操作失败，请重新操作', GO_ERROR);
        } else {
            go('/index.php/admin/patient/patient_list', '操作成功', GO_SUCCESS);
        }

    }

    /**
     * 查看患者-
     * @return [type] [description]
     */
    public function detail_patient()
    {
    	$this->checkauth('patient_list');
    	$this->load->model('instmodel');
    	
    	$data['cdn'] = $this->cdn;
    	$id = intval($this->input->get('id'));
    	$sql = "select p.id,p.sex,p.birth,u.uname,u.uid,u.phone,d.inst_name,d.name as dname,i.shortname,i.name as iname,p.province,p.city,p.diagnosis,i.progress_id,i.id as jid,p.crc,p.itemid,p.select_num,p.family,p.relation,p.family_phone,p.wechat from patient as p left join dept as d on p.dept = d.id left join web_user as u on p.user_id=u.uid  left join items as i on p.itemid = i.id where p.id = $id order by p.add_time desc ";
    	$res = $this->db->query($sql)->row_array();
    	if(!$res){
    		echo '没有这个人';
    		exit;
    	}
    	//获取出生日期
    	$birth = card_to_birth($res['birth']);
    	$res['age'] = $birth;
    	//获取省市
    	$province = $this->instmodel->area_one($res['province'],$table='provinces');
    	$city = $this->instmodel->area_one($res['city'],$table='city');
    	$data['juzhudi'] = $province['name'].' '. $city['name'];
    	$data['pdesc'] = $res;
    	
    	//获取项目
    	// $items = $this->instmodel->join($res['progress_id'],$table=array('items',''));
    	$items = $this->instmodel->get_one($res['itemid'],$table='items');
    	$data['items'] = $items;
        // 项目进程
        $progress = $this->instmodel->get_one($items['progress_id'],$table='item_plan');
        $data['progress'] = $progress;
    	//诊断
    	$diagnosis = explode('@',$res['diagnosis']);
    	$data['diagnosis'] = $diagnosis;
        //判断是否入组
        // echo $res['uid'];
        $group_uid = array('user_id'=>$res['uid']);
        $is_group = $this->instmodel->get_one($group_uid,$table='entry_group');
        if($is_group){
            $data['is_group'] = 1;
        }else{
            $data['is_group'] = 0;
        }
        //crc
        $where = array('crc_user.uid'=>$res['crc']);
        $table = array('crc_user','crc_company','web_user');
        $link = array('crc_user.company_id=crc_company.id','crc_user.uid=web_user.uid');
        $columns ='web_user.uname,crc_company.cname';
        $crc = $this->instmodel->join_tj($where,$table,$link,$columns);
        $data['crc'] = $crc['0'];
        $uid = $res['uid'];
        $date = date('Ym',time());
        //月活跃度统计 MONTH
        $sql1 = "select count(*) as count from login_log where user_id=$uid and DATE_FORMAT(add_time,'%Y%m')=$date";
        $mcount = $this->db->query($sql1)->row_array();
        //季活跃度
        $season = ceil(date('n')/3);
        $jd_start = date('Ym',mktime(0,0,0,($season - 1)*3+1,1,date('Y')));
        $jd_end =  date('Ym',mktime(0,0,0,$season*3,1,date('Y')));

        $sql2 = "select count(*) as jd_count from login_log where user_id=$uid and (DATE_FORMAT(add_time,'%Y%m')>=$jd_start and DATE_FORMAT(add_time,'%Y%m')<=$jd_end)";

        $jcount = $this->db->query($sql2)->row_array();
        // 半年活跃度
        $year = floor(date('n')/6);
        $y_start = date('Ym',mktime(0,0,0,$year*6+1,1,date('Y')));
        $y_end = date('Ym',mktime(0,0,0,$year*6+6,1,date('Y')));
        $sql3 = "select count(*) as y_count from login_log where user_id=$uid and (DATE_FORMAT(add_time,'%Y%m')>=$y_start and DATE_FORMAT(add_time,'%Y%m')<=$y_end)";
        $ycount = $this->db->query($sql3)->row_array();
        $data['m_count'] = $mcount['count'];
        $data['j_count'] = $jcount['jd_count'];
        $data['y_count'] = $ycount['y_count'];
    	// var_dump($crc);
    	$this->load->view('admin/patient/patient_detail',$data);
    }

    /**
     * 修改患者页-
     * @return [type] [description]
     */
    
    public function edit_patient()
    {
    	$this->checkauth('patient_list');
    	$this->load->model('instmodel');
    	$data['cdn'] = $this->cdn;
    	$pid = intval($this->input->get('id'));
    	$data['shen'] = $this->instmodel->area();
    	$inst = $this->instmodel->get_all($where='');
    	$data['inst'] = $inst;
        $patinfo = $this->instmodel->get_one($pid,$table='patient');
        $uwhere = array('uid'=>$patinfo['user_id']);
    	$puser = $this->instmodel->get_one($uwhere,$table='web_user');
    	$data['puser'] = $puser;
    	$items = $this->instmodel->get_all($where='',$table='items');
    	$data['items'] = $items;
    	
        $cwhere = array('uid'=>$patinfo['crc']);
        $crc = $this->instmodel->get_one($cwhere,$table='web_user');
        $data['crc'] = $crc;
    	$data['city'] = $this->instmodel->area($table='city',$patinfo['province']);
    	$dwhere = array('inst_id'=>$patinfo['inst_id']);
    	$data['dept'] = $this->instmodel->get_all($dwhere,$table='dept');
    	$data['patinfo'] = $patinfo;

    	$uid = $puser['uid'];
    	$this->load->view('admin/patient/patient_edit',$data);
    }

    /**
     * 修改患者-
     * @return [type] [description]
     */
    public function edit_patient_do()
    {
    	$this->checkauth('add_patient');
    	$this->load->model('instmodel');
    	var_dump($_POST);
    	$id = $this->input->post('id');
    	// $pid = $this->input->post('patid');
    	$sex = $this->input->post('sex');
    	$birth = $this->input->post('birth');
    	$province = $this->input->post('province');
    	$city = $this->input->post('city');
    	$diagnosis = $this->input->post('diagnosis');
    	$diagnosis = implode('@',$diagnosis);
    	$items = $this->input->post('items');
    	$inst = $this->input->post('inst');
    	$dept = $this->input->post('dept');
    	$crc = $this->input->post('crcid');
        // $phone = $this->input->post('phone');
        $select_num = $this->input->post('select_num');
        $family = $this->input->post('family');
        $relation = $this->input->post('relation');
        $family_phone = $this->input->post('family_phone');
        $wechat = $this->input->post('wechat');
    	//需要添加的数据
    	$data = array('inst_id'=>$inst,'sex'=>$sex,'birth'=>$birth,'province'=>$province,'city'=>$city,'diagnosis'=>$diagnosis,'itemid'=>$items,'dept'=>$dept,'phone'=>$phone,'select_num'=>$select_num,'family'=>$family,'relation'=>$relation,'family_phone'=>$family_phone,'wechat'=>$wechat,'crc'=>$crc,'add_time'=>time(),'status'=>1);

    	$result = $this->instmodel->edit($data,$id,$table='patient');
    	// // echo $result;
    	if(!$result){
            go('/index.php/admin/patient/edit_patient?id='.$id, '操作失败，请重新操作', GO_ERROR);
        } else {
            go('/index.php/admin/patient/detail_patient?id='.$id, '操作成功', GO_SUCCESS);
        }
    }

    /**
     * 患者添加组别-
     * @return [type] [description]
     */
    public function entry_group()
    {
        $this->checkauth('entry_group');
        $this->load->model('instmodel');
        $uid = intval($this->input->get('id'));
        $jid = intval($this->input->get('jid'));
        $where = array('uid'=>$uid);
        $res = $this->instmodel->get_one($where,$table='web_user');
        $data['user'] = $res;
        $group = '';
        $data['group'] = $group;
        $this->load->view('admin/patient/entry_group',$data);
    }

    //临时添加组别
    public function add_group()
    {
        echo '0';
    }

    /**
     * 患者添加入组-
     * @return [type] [description]
     */
    public function entry_group_do()
    {
        $this->checkauth('entry_group');
        $this->load->model('instmodel');
        // var_dump($_POST);
        $uid = $this->input->post('uid');
        $jid = $this->input->post('jid');
        $time = strtotime($this->input->post('time'));
        $random = $this->input->post('random');
        $group = $this->input->post('dept_type');
        $data = array('user_id'=>$uid,'add_time'=>$time,'random'=>$random,'group'=>$group,'status'=>1);
        $res = $this->instmodel->add($data,$table='entry_group');
        if(!$res){
            go('/index.php/admin/patient/entry_group', '操作失败，请重新操作', GO_ERROR);
        } else {
            go('/index.php/admin/patient/pat_scheme?id='.$uid.'&jid='.$jid, '操作成功', GO_SUCCESS);
        }

    }

    /**
     * 患者添加组别-
     * @return [type] [description]
     */
    public function pat_scheme()
    {
        // $this->checkauth('add_patient');
        $this->load->model('instmodel');
        $uid = intval($this->input->get('id'));
        $jid = intval($this->input->get('jid'));

        $this->load->view('admin/patient/pat_scheme',$data);
    }

    /**
     * 患者关注资讯-
     * @return [type] [description]
     */
    public function information_list()
    {
    	// $this->checkauth('add_patient');
    	$this->load->model('instmodel');
    	$data['cdn'] = $this->cdn;
    	$this->load->helper('Page');
    	// 获取搜索条件
    	$where      = '';
        $page_where = '';
    	$search     = trim($this->input->get_post('search'));
        if (isset($search) && $search) {
            $where['search'] = $search;
            $where['column'] = 'web_user.uname'; 
            $page_where      = 'search=' . $search;
        }
        // 资讯关联news表
        $table = array('f_information','web_user');
    	$link = 'web_user.uid=f_information.uid';
        // $where['status'] ='1';
        //查询到的总条数
        $count            = $this->instmodel->countw($where,$table,$link);
        $p = new page($count,10,$page_where);
        $data['page']     = $p->show(); // 分页代码
        $data['search']   = $search;

    	$res = $this->instmodel->join($where,$table,$link,$columns,$p->firstRow,$p->listRows);
    	$data['info'] = $res;
    	// var_dump($res);
    	$this->load->view('admin/patient/info_list',$data);

    }
    /**
     * 患者活跃度-
     * @return [type] [description]
     */
    public function p_liveness()
    {
    	$this->load->model('instmodel');
    	$data['cdn'] = $this->cdn;
    	$this->load->helper('Page');
    	$id = $this->input->get('pid');
    	// $user = $this->instmodel->get_all($where='',$table='web_user');
    	var_dump($id);
    	$this->load->view('admin/patient/liveness_list',$data);
    }

    /**
     * 关注的资讯-
     * @return [type] [description]
     */
    public function my_information()
    {
    	$this->load->model('instmodel');
    	$data['cdn'] = $this->cdn;
    	$this->load->helper('Page');
    	$uid = $this->input->get('id');
    	// 获取搜索条件
    	$where      = '';
    	$where = array('web_user.uid'=>$uid);
        $page_where = '';
    	// $search     = trim($this->input->get_post('search'));
        // if (isset($search) && $search) {
        //     $where['search'] = $search;
        //     $where['column'] = 'web_user.uname'; 
        //     $page_where      = 'search=' . $search;
        // }
        // var_dump($where);
        $table = array('f_information','web_user');
    	$link = 'web_user.uid=f_information.uid';
        $where['f_information.status'] ='1';
        //查询到的总条数
        $count            = $this->instmodel->countw($where,$table,$link);
        $p = new page($count,10,$page_where);
        $data['page']     = $p->show(); // 分页代码

    	$res = $this->instmodel->join($where,$table,$link,$columns='',$p->firstRow, $p->listRows);
    	$data['info'] = $res;
    	// var_dump($res);
    	$this->load->view('admin/patient/my_information',$data);
    }

    /**
     * 发表的资讯-
     * @return [type] [description]
     */
    public function publish_information()
    {
    	$this->load->model('instmodel');
    	$data['cdn'] = $this->cdn;
    	$this->load->helper('Page');
    	$uid = $this->input->get('id');
    	// 获取搜索条件
    	$where      = '';
    	$where = array('web_user.uid'=>$uid);
        $page_where = '';
    	// $search     = trim($this->input->get_post('search'));
        // if (isset($search) && $search) {
        //     $where['search'] = $search;
        //     $where['column'] = 'web_user.uname'; 
        //     $page_where      = 'search=' . $search;
        // }
        // var_dump($where);
        $table = array('news','web_user');
    	$link = 'web_user.uid=news.add_uid';
        // $where['status'] ='1';
        //查询到的总条数
        $count            = $this->instmodel->countw($where,$table,$link);
        $p = new page($count,10,$page_where);
        $data['page']     = $p->show(); // 分页代码

    	$res = $this->instmodel->join($where,$table,$link,$columns='',$p->firstRow, $p->listRows);
    	$data['info'] = $res;
    	// var_dump($res);
    	$this->load->view('admin/patient/p_information',$data);
    }

    //删除资讯
    public function change_parent_status()
    {
        $this->checkauth('add_patient');
        $data['cdn'] = $this->cdn;
        $this->load->model('funcmodel');
        $id = $this->input->get('id');
        $table = $this->input->get('table');
        if(empty($table)){
            $table= 'patient';
        }
        $where = array('id'=>$id);
        $data = array('status'=>0);
        $result = $this->funcmodel->edit($table,$data,$where);
        // var_dump($result);
        if(!$result){
            go('/index.php/admin/patient/patient_list', '删除失败，请重新删除', GO_ERROR);
        } else {
            go('/index.php/admin/patient/patient_list', '删除成功', GO_SUCCESS);
        }
    }
    /**
     * 资讯详情-
     * @return [type] [description]
     */
    public function detail_infomation()
    {
        $this->load->model('instmodel');
        $data['cdn'] = $this->cdn;
        $id = $this->input->get('id');
        $info = $this->instmodel->get_one($id,$table='news');
        $data['news'] = $info;

        $this->load->view('admin/patient/info_detail',$data);
    }


}