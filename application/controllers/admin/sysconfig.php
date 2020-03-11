<?php
class Sysconfig extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }
    /**
     * 添加系统参数-表单
     */
    public function sysconfig_add()
    {
        $this->checkauth('sysconfig_add');
        $data['cdn']    = $this->cdn;
        $this->load->view('admin/sysconfig/sysconfig_add', $data);
    }
    /**
     * 添加系统参数-表单处理
     */
    public function sysconfig_add_do()
    {
        $this->checkauth('sysconfig_add');
        $stitle   = $this->input->post('stitle');
        $scontent = $this->input->post('scontent');
        $skey     = $this->input->post('skey');
        $sval     = $this->input->post('sval');

        $data = array('stitle' => $stitle, 'scontent' => $scontent, 'skey' => $skey, 'sval' => $sval);
        $ret  = $this->sysconfigmodel->sence_check($data, 'add');
        if (!$ret['status']) {
            go('/index.php/admin/sysconfig/sysconfig_add', $ret['err_info']);
        }
        if (!$this->sysconfigmodel->add($data)) {
            go('/index.php/admin/sysconfig/sysconfig_add', '添加失败，请重新添加');
        } else {
            go('/index.php/admin/sysconfig/sysconfig_set/', '添加成功', GO_SUCCESS);
        }
    }

    /**
     * 系统参数设置-表单
     * @return [type] [description]
     */
    public function sysconfig_set()
    {
        $this->checkauth('sysconfig_set');
        $list         = $this->sysconfigmodel->get_all();
        $data['list'] = $list;
        $data['cdn']  = $this->cdn;
        $this->load->view($this->view_path, $data);
    }

    /**
     * 统参数设置-表单
     * @return [type] [description]
     */
    public function sysconfig_set_do()
    {
        $this->checkauth('sysconfig_set');
        $sysconfig = $this->input->post('sysconfig');
        foreach ($sysconfig as $key => $value) {
            $this->sysconfigmodel->edit(array('sval' => $value), array('skey' => $key));
        }
        go('/index.php/admin/sysconfig/sysconfig_set/', '操作成功', GO_SUCCESS);
    }

    /**
     * ajax验证 skey是否重复
     * @return [type] [description]
     */
    public function sysconfig_skey_check()
    {
        $skey = $this->input->post('skey');
        $data = array('skey' => $skey);
        //  验证 skey
        $res = $this->sysconfigmodel->sence_check($data, 'add');
        $ret = array('valid' => (bool) $res['status'], 'message' => $res['err_info']);
        echo json_encode($ret);
    }

}
