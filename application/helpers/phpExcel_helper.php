<?php


class PhpexcelRead extends MY_Controller{
	
	/**
     * 导入excel方法-
     * @return [type] [description]
     */
	public function leading($filename,$table){
		$this->load->library('PHPExcel');
		// $this->load->library('PHPExcel/IOFactory');
		$filename = DIR_ROOT.'uploads/bbb.xls';
		$start = strrpos(basename($filename),'.')+1;
		$ext = substr(basename($filename),$start);
		if($ext=='xls'){
			//引入excel文件

			$this->load->library('PHPExcel/Reader/PHPExcel_Reader_Excel5');
			$PHPReader = new PHPExcel_Reader_Excel5();
		}else if($ext=='xlsx'){ 

			$this->load->library('PHPExcel/Reader/PHPExcel_Reader_Excel2007');                
			$PHPReader=new PHPExcel_Reader_Excel2007(); 
		}

		
		$objPHPExcel = $PHPReader->load($filename);
		// return $objPHPExcel;
		$currentSheet=$objPHPExcel->getSheet(0); 
		
		$allColumn=$currentSheet->getHighestColumn();    //获取总列数             
		$allRow=$currentSheet->getHighestRow();			  //获取总行数

		for($currentRow=1;$currentRow<=$allRow;$currentRow++){  
			//从哪列开始，A表示第一列                              
		    for($currentColumn='A';$currentColumn<=$allColumn;$currentColumn++){                    
		    //数据坐标                    
		    $address=$currentColumn.$currentRow;                    //读取到的数据，保存到数组$arr中                    
		    $data[$currentRow][$currentColumn]=$currentSheet->getCell($address)->getValue();                
		    }            
		}           
		$str = $this->save_import($data,$allColumn,$table);        

		return $str;
		
	}

	/**
     * 保存导入的数据到指定的表中-
     * @return [type] [description]
     */       
	public function save_import($data,$allColumn,$table)
	{             
		$lastId=[];//可能涉及到两张表，这个数组用来存取插入一张表成功之后每次返回的主键id  

		//获取表的字段
		$sql = "select COLUMN_NAME from information_schema.COLUMNS where table_name = '{$table}'" ; 
       	$result = $this->db->query($sql)->result_array();
       	foreach($result as $key=>$val){
       		$columns[]=$val['COLUMN_NAME'];
       	}
       	array_shift($columns);
       	$columns = array_slice($columns,'0','-2');
       	// print_r($arr);
		foreach ($data as $k=>$v){               
			if($k > 1 && $v!=""){//因为第一行是标题，从第二行开始算起                                        
				for($i='A';$i<=$allColumn;$i++){
					$info[$k-1][]=$v[$i];
					$values = array_combine($columns,$info[$k-1]);	//合并数组，拼装成写入数据库数据		  
				} 
					// $result = $this->db->insert($table,$values); 
					// array_push($lastId, $this->db->insert_id());  //如果是2个表，将每次插入返回的最后一个id存入数组 
					// var_dump($lastId);               
			  	$arr[] =$values;                
			} 
			                          
		}
		var_dump($arr);
		// unset($info);  
		// unset($data);   
	}
}

// $sql = "INSERT INTO table VALUES(".$a.",".$b.")";
// mysql_query($sql);
// 

// 	$screenwriter=$v['K'];                    
			  // 	$info[$k-1]['screenwriter'] = $screenwriter;                                     
			  // 	$info1[$k-1]['addtime'] = strtotime($addtime);                                       
			  // 	$type_zh_tag=$v['M'];                    
			  // 	$info1[$k-1]['type_zh_tag'] = $type_zh_tag;                              
			  // 	$type_country=$v['N'];                    
			  // 	$info1[$k-1]['type_country'] = $type_country;                    
			  	// $result = $this->db->insert('content',$info1[$k-1]);                    
			  	// array_push($lastId, $this->db->insert_id());//将每次插入返回的最后一个id存入数组                     
			  	// $info[$k-1]['contentid']=$lastId[$k-2]; //拼接contentid                    
			  	// $this->db->where('contentid',$lastId[$k-1]['contentid'])->delete('content_other');//每次插入之前先清除                    
			  	// $this->db->insert('content_other',$info[$k-1]);	
		           //             
		           //                                   
	  	/*$result=$this->db->insert_batch('content', $info1); 当然也可以使用批量插入*/            
	  	// if($result){                
		  // 	unset($_SESSION['upload_excelfile_path']);                 
		  // 	unset($_SESSION['upload_excelfile_ext']);                 
		  // 	echo alert('数据导入成功',site_url($this->uri->slash_segment(1).'content/collect_manage'));            
	  	// }else{                
	  	// 	echo alert('数据导入失败',site_url($this->uri->slash_segment(1).'content/collect_manage'));            
	  	// }        