<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Useronline
* 
* Author:  A7SON
* Created:  21.04.2020 
* 
* Description:  Class to generate user online according to login status in the database
* 
*/
class Useronline {

	protected $ci;

	public function __construct()
	{
        $this->ci =& get_instance();
        $this->ci->load->model('admin/User_model','user_model');
	}

	public function generate_useronline(){

        $output = '<ul id="oluser" class="list">';
        $useronline = $this->ci->user_model->get_useronline();
		foreach($useronline as $user){
				$output .= '<li><strong>';
				$output .= $user['username'];
				$output .= '</strong></li>';
        }
        $output .= "</ul>";        
		return $output;
	}

}