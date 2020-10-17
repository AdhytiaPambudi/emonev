<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Breadcrumbs
* 
* Author:  Ben Edmunds
* Created:  9.23.2009 
* 
* Description:  Class to create dynamic breadcrumbs according to the page setup in the database
* 
*/
class Breadcrumbs
{
	/**
	 * CodeIgniter global
	 *
	 **/
	private $ci;


	/**
	 * __construct
	 *
	 * @return void
	 * @author Ben Edmunds
	 **/
	public function __construct()
	{
		//Get an Instance of CodeIgniter
        $this->ci =& get_instance();
		//load model
        $this->ci->load->library('mybreadcrumb');

	}
	
	/**
	 * Breadcrumbs
	 *
	 * @return void
	 * @author Ben Edmunds
	 **/
	public function generate_breadcrumb()
	{
        // $ci=&get_instance();
        $i=1;
        $uri = $this->ci->uri->segment($i);
		$breadcrumb = '';
		
		//pull the current page from the model
        // $page = $this->ci->breadcrumbs_model->get_page(false,$uri);
        $query= $this->ci->db->get_where('sys_menu', array( 'url' => $uri));
        $page = $query->row();

        if (is_object($page) && $page->parent_id != 0){ //if the page is a child object
            $parent[0] = ($this->ci->db->get_where('sys_menu', array('id_menu' => $page->parent_id)))->row();
			if (isset($parent[0]->parent_id) && $parent[0]->parent_id != 0) { //if the parent is also a child object start the loop to find all the child objects
				$i = 1; //set the counter
				$final = false; //switch to turn off the loop
				while (!$final) {
                    $parent[$i] = ($this->ci->db->get_where('sys_menu', array('id_menu' => $parent[$i-1]->parent_id)))->row(); //get the parent from the model
					if ($parent[$i]->parent_id == ''){$final=true;} //if there are no more parents stop the loop
					$i++;
				}
			}
            krsort($parent); //reverse the array
            
			foreach ($parent as $breadcrumbItem) {
				if ($breadcrumbItem->url == ''){
					$this->ci->mybreadcrumb->add($breadcrumbItem->title, '#');					
				}
				else {
                	$this->ci->mybreadcrumb->add($breadcrumbItem->title, $breadcrumbItem->url);					
				}
            }
            
			if (isset($page->view)){
                $this->ci->mybreadcrumb->add($page->title, $page->url);
                
			}
			else {
                $this->ci->mybreadcrumb->add($page->title, base_url($page->url));
			}
        }
        else{
            $this->ci->mybreadcrumb->add($page->title, base_url($page->url));
        }

        $breadcrumb = $this->ci->mybreadcrumb->render();
		return $breadcrumb;
    }
}