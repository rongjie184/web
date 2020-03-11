<?php
class Crontab extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('crontabmodel');
		
	}

    /**
     * 游戏列表
     * @return [type] [description]
     */
    function crontab_list() {
        $this->checkauth('crontab_list');

		$data['cdn'] = $this->cdn;
        $gname = trim($this->input->get_post('gname'));

        $this->load->helper('Page');
		// $where['del'] = 0;
		$where = array();
        if(isset($gname) && $gname){
            $where['gname'] = $gname;
            $page_url .= '&gname='.$gname;
        }
        $count = $this->crontabmodel->count($where);
        $p = new Page ( $count, 20 ,$page_url);
        $data['page'] = $p->show();// 分页代码
        $data['gname'] = $gname;
        $list = $this->crontabmodel->get_all($where,$p->firstRow,$p->listRows);
        $this->load->model('companymodel');
        foreach($list as $key=>$value){
            $firm_id = $value['firm_id'];
            if($firm_id){
                $company = $this->companymodel->get_one($firm_id);
                $list[$key]['cpname'] = $company['cpname'];
            }
        }
        $data['list'] = $list;
		$data['store_path'] = $this->sysconfig->keystore;
		$this->load->view($this->view_path,$data);
    }

    function crontab_add() {
        $this->checkauth('crontab_add');
        $data['cdn'] = $this->cdn;
        $this->load->view($this->view_path,$data);
    }
    /**
     * 添加权限-处理
     */
    function crontab_add_do() {

        $this->checkauth('crontab_add');

        $type = intval($this->input->post('type'));
        $name = $this->input->post('name');
        $hour = intval($this->input->post('hour'));
        $minute = $this->input->post('minute');
        $content = $this->input->post('content');
        $status = $this->input->post('status');
        $file_name = $this->input->post('file_name');

        $status = $status ==1?1:0;
        if($minute==0 && $hour==0 && $type==2){
            go(Url::alias('crontab_add'),'频率方式,执行小时和分钟不可同时为0!');
        }    
        $this->load->model('crontabmodel');
        $data = array('type'=>$type,'name'=>$name,'hour'=>$hour,'minute'=>$minute,'content'=>$content,'status'=>$status,'file_name'=>$file_name);
        if(!$this->crontabmodel->add($data))
        {
            go(Url::alias('crontab_add'),'添加失败，请重新添加');
        }else{
          go(Url::alias('crontab_list'),'添加成功',GO_SUCCESS);
        }
    }
   function crontab_edit() {
        $this->checkauth('crontab_list');
        $data['cdn'] = $this->cdn;
        $id=$this->input->get('id');
        $crontab = $this->crontabmodel->get_one($id);
        if(!$crontab){
            go(Url::alias('crontab_list'),'未知脚本!');
        }
        $data['crontab_info'] = $crontab;
        $this->load->view($this->view_path,$data);
    }
    /**
     * 添加权限-处理
     */
    function crontab_edit_do() {

        $this->checkauth('crontab_list');

        $id =$this->input->post('id');
        $crontab = $this->crontabmodel->get_one($id);
        if(!$crontab){
            go(Url::alias('crontab_list'),'未知脚本!');
        }
        $type = intval($this->input->post('type'));
        $name = $this->input->post('name');
        $hour = intval($this->input->post('hour'));
        $minute = $this->input->post('minute');
        $content = $this->input->post('content');
        $status = $this->input->post('status');
        $file_name = $this->input->post('file_name');
        $status = $status ==1?1:0;
        $this->load->model('crontabmodel');
        if($minute==0 && $hour==0 && $type==2){
            go(Url::alias('crontab_edit').'?id='.$id,'频率方式,执行小时和分钟不可同时为0!');
        }        
        $data = array('type'=>$type,'name'=>$name,'hour'=>$hour,'minute'=>$minute,'content'=>$content,'status'=>$status,'file_name'=>$file_name);
        if(!$this->crontabmodel->edit($data,$id))
        {
            go(Url::alias('crontab_edit').'?id='.$id,'修改失败，请重新修改');
        }else{
          go(Url::alias('crontab_list'),'修改成功',GO_SUCCESS);
        }
    }

    function crontab_plan(){

        $this->checkauth('crontab_plan');
        $search = trim($this->input->post('search'));
        $list = $this->crontabmodel->get_all(array('status'=>1,'search'=>$search));
        $plan = array();
        foreach($list as $value){
            // 固定时间
            if($value['type']==1){
                $time = strtotime(date("Y-m-d ".$value['hour'].":".$value['minute'].":00",time()));
                $plan[] = array('time'=>$time,'file_name'=>$value['file_name'],'name'=>$value['name']);
            }
            // 频率执行
            if($value['type']==2){

                $today_start = strtotime(date('Y-m-d 00:00:00',time()));
                $today_end = strtotime(date('Y-m-d 00:00:00',time()+24*3600));
                $intval = $value['hour']*3600+$value['minute']*60;

                for($i=$today_start+$intval;$i<$today_end;$i+=$intval){
                    $plan[] = array('time'=>$i,'file_name'=>$value['file_name'],'name'=>$value['name']);
                }
            }
        }
        usort($plan,'array_sort_plan');
        $data['list'] = $plan;
        $data['search'] = $search;

        $this->load->helper('Page');
        $p = new Page ( count($plan), count($plan) ,'');
        $data['page'] = $p->show();// 分页代码
        $this->load->view($this->view_path,$data);
    }

}