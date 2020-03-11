<?php

/*
* @author zb.wang
* @date 2011-10-24
* @desc 分页类
*/
class Page extends CI_Controller{
    // 起始行数
    public $firstRow	;
    // 列表每页显示行数
    public $listRows	;
    // 页数跳转时要带的参数
    public $parameter  ;
    // 分页总页面数
    protected $totalPages  ;
    // 总行数
    protected $totalRows  ;
    // 当前页数
    protected $nowPage    ;
    // 分页的栏的总页数
    protected $coolPages   ;
    // 分页栏每页显示的页数
    protected $rollPage   ;
	// 分页显示定制
    protected $config  =	array('header'=>'条记录','prev'=>'上一页','next'=>'下一页','first'=>'第一页','last'=>'最后一页',
		//'theme'=>'<div class="pa-l">共 %totalRow% %header% 当前 %nowPage%/%totalPage% 页</div> <div class="pa-r"> %upPage%  %first%  %prePage%  %linkPage%  %nextPage% %end% %downPage%</div>');

        'theme'=>'<div class="col-sm-5"><div class="dataTables_info"  role="status" aria-live="polite">&nbsp;共 %totalRow% %header% 当前 %nowPage%/%totalPage% 页</div></div>
            <div class="col-sm-7"><div class="dataTables_paginate paging_simple_numbers" ><ul class="pagination">%upPage% %linkPage% %downPage%</ul></div></div>');

    /**
     +----------------------------------------------------------
     * 架构函数
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param array $totalRows  总的记录数
     * @param array $listRows  每页显示记录数
     * @param array $parameter  分页跳转的参数
     +----------------------------------------------------------
     */
    public function __construct($totalRows,$listRows,$parameter='') {
        $this->totalRows = $totalRows;
        $this->parameter = $parameter;
        $this->rollPage = 5;
        $this->listRows = !empty($listRows)?$listRows:30;
        $this->totalPages = ceil($this->totalRows/$this->listRows);     //总页数
        $this->coolPages  = ceil($this->totalPages/$this->rollPage);
        $this->nowPage  = !empty($_GET['p'])?$_GET['p']:1;
        if(!empty($this->totalPages) && $this->nowPage>$this->totalPages) {
            $this->nowPage = $this->totalPages;
        }
        $this->firstRow = $this->listRows*($this->nowPage-1);
    }

    public function setConfig($name,$value) {
        if(isset($this->config[$name])) {
            $this->config[$name]    =   $value;
        }
    }

    /**
     +----------------------------------------------------------
     * 分页显示输出
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     */
    public function show() {
        if(0 == $this->totalRows) return '';
        $p = 'p';
        $nowCoolPage      = ceil($this->nowPage/$this->rollPage);
        $url  =  $_SERVER['REQUEST_URI'].(strpos($_SERVER['REQUEST_URI'],'?')?'':"?").$this->parameter;
        $parse = parse_url($url);
        if(isset($parse['query'])) {
            parse_str($parse['query'],$params);
            unset($params[$p]);
            $url   =  $parse['path'].'?'.http_build_query($params);
        }
        //上下翻页字符串
        $upRow   = $this->nowPage-1;
        $downRow = $this->nowPage+1;
        if ($upRow>0){
            //$upPage="<a href='".$url."&".$p."=$upRow'>".$this->config['prev']."</a>";
            $upPage = '<li class="paginate_button previous"><a href="'.$url.'&'.$p.'='.$upRow.'" >上一页</a></li>';
        }else{
            //$upPage="<a>".$this->config['prev']."</a>";
            $upPage='<li class="paginate_button previous disabled" ><a href="#" >上一页</a></li>';
        }

        if ($downRow <= $this->totalPages){
            // $downPage="<a href='".$url."&".$p."=$downRow'>".$this->config['next']."</a>";
            $downPage = '<li class="paginate_button next"><a href="'.$url.'&'.$p.'='.$downRow.'"  >下一页</a></li>';
        }else{
            // $downPage="<a>".$this->config['next']."</a>";
            $downPage='<li class="paginate_button next disabled" ><a href="#"  >下一页</a></li>';
        }
        // << < > >>
        if($nowCoolPage == 1){
            $theFirst = "";
            $prePage = "";
        }else{
            $preRow =  $this->nowPage-$this->rollPage;
            $prePage = "<a href='".$url."&".$p."=$preRow' >上".$this->rollPage."页</a>";
            $theFirst = "<a href='".$url."&".$p."=1' >".$this->config['first']."</a>";
        }
        if($nowCoolPage == $this->coolPages){
            $nextPage = "";
            $theEnd="";
        }else{
            $nextRow = $this->nowPage+$this->rollPage;
            $theEndRow = $this->totalPages;
            $nextPage = "<a href='".$url."&".$p."=$nextRow' >下".$this->rollPage."页</a>";
            $theEnd = "<a href='".$url."&".$p."=$theEndRow' >".$this->config['last']."</a>";
        }
        // 1 2 3 4 5
        $linkPage = "";
        for($i=1;$i<=$this->rollPage;$i++){
            $page=($nowCoolPage-1)*$this->rollPage+$i;
            if($page!=$this->nowPage){
                if($page<=$this->totalPages){
                    //$linkPage .= "<a href='".$url."&".$p."=$page'>".$page."</a>";
                    $linkPage .='<li class="paginate_button "><a href="'.$url.'&'.$p.'='.$page.'" >'.$page.'</a></li>';
                }else{
                    break;
                }
            }else{
                if($this->totalPages != 1){
                    //$linkPage .= "<b>".$page."</b>";
                    $linkPage .='<li class="paginate_button active"><a href="#" >'.$page.'</a></li>';
                }
            }
        }
		if($linkPage==""){
			$linkPage='<li class="paginate_button active"><a href="#" >1</a></li>';
		}
        $pageStr	 =	 str_replace(
            array('%header%','%nowPage%','%totalRow%','%totalPage%','%upPage%','%downPage%','%first%','%prePage%','%linkPage%','%nextPage%','%end%'),
            array($this->config['header'],$this->nowPage,$this->totalRows,$this->totalPages,$upPage,$downPage,$theFirst,$prePage,$linkPage,$nextPage,$theEnd),$this->config['theme']);

        return $pageStr;
    }

}
?>