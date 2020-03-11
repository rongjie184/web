<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Url
{

	public function __construct()
	{

	}
	public static function alias($key){
	    $list = array(
	        'login' => '/index.php/admin/login',
	        'home'  => '/index.php/main',	      
	        'crontab_list'=>'/index.php/admin/crontab/crontab_list',
	        'crontab_add'=>'/index.php/admin/crontab/crontab_add',
	        'crontab_edit'=>'/index.php/admin/crontab/crontab_edit',
	        'paid_view'=>'/index.php/admin/paid/paid_view',
	        'game_list'=>'/index.php/admin/game/game_list',
	  
	    );	
	    
	    if (!isset($list[$key])) {
	        $key = 'home';
	    }
	    return $list[$key];
	}

}

/* End of file Urls.php */
/* Location: ./application/libraries/Urls.php */
