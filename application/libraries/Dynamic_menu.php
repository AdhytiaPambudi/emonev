<?php
/**
 *
 * Dynmic_menu.php
 *
 */
class Dynamic_menu {
    private $ci;                // for CodeIgniter Super Global Reference.
    private $id_menu        = 'id="menu"';
    private $class_menu     = 'class="menu"';
    private $class_parent   = 'class="parent"';
    private $class_last     = 'class="last"';
    // --------------------------------------------------------------------
    /**
     * PHP5        Constructor
     *
     */
    function __construct()
    {
        $this->ci =& get_instance();    // get a reference to CodeIgniter.
    }
    // --------------------------------------------------------------------
    /**
     * build_menu($table, $type)
     *
     * Description:
     *
     * builds the Dynaminc dropdown menu
     * $table allows for passing in a MySQL table name for different menu tables.
     * $type is for the type of menu to display ie; topmenu, mainmenu, sidebar menu
     * or a footer menu.
     *
     * @param    string    the MySQL database table name.
     * @param    string    the type of menu to display.
     * @return    string    $html_out using CodeIgniter achor tags.
     */
	 
	function buildmenu ($parentId=0)
	{
		$data 	= $this->ci->encrypt->decode($this->ci->session->userdata('mn'));	

		$dtMenu = array();				
		// if ($data != ''){
		$this->ci->load->model('Template_model', 'temp_model');
		$menuData = $this->ci->temp_model->getMenuItems($data);
		
		return $this->getMenu ($parentId, $menuData);
	}
	
	function getMenu ($parentId, $menuData)
	{
		$menu 	= array();
		$html 	= '';
		
		if (isset($menuData['parents'][$parentId]))
		{
			$html = '<ul>';
			foreach ($menuData['parents'][$parentId] as $itemId)
			{
				$html .= '<li>' . $menuData['items'][$itemId]['title'];

				// find childitems recursively
				$html .= $this->getMenu($itemId, $menuData);

				$html .= '</li>';
			}
			$html .= '</ul>';
		}

		return $html;
		
/*
		foreach ($res as $row) {
			
			if (in_array($row['parent_id'], $dtMenu)) {
				$dtMenu[$row['parent_id']]['child'][] = $row;
			}
			else {
				$dtMenu[$row['parent_id']]['name'] = $row['parentName'];
				$dtMenu[$row['parent_id']]['child'][] = $row;
			
			}
		}
		} */
		// return $dtMenu;
	}
	
    function menu_panel ($table = 'm_menu', $type = '2')
    {
        $data   = $this->ci->encrypt->decode($this->ci->session->userdata('mn'));
        
        $dtMenu = array();
        $menu   = array();
        
        $q      = "SELECT * FROM m_menu WHERE id IN  (".$data.") order by kode";
        
        
        
		$query 	= $this->ci->db->query($q);
        
        //vdebug($query->num_rows());
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $menu[$row->id]['id']            = $row->id;
                $menu[$row->id]['title']        = $row->nama;
                $menu[$row->id]['link']            = $row->link_type;
                $menu[$row->id]['page']            = $row->page_id;
                $menu[$row->id]['module']        = $row->module_name;
                $menu[$row->id]['url']            = $row->url;
                // $menu[$row->id_menu]['uri']            = $row->uri;
                // $menu[$row->id]['dyn_group']    = $row->dyn_group_id;
                $menu[$row->id]['position']        = $row->position;
                $menu[$row->id]['target']        = $row->target;
                $menu[$row->id]['parent']        = $row->parent_id;
                $menu[$row->id]['is_parent']    = $row->is_parent;
                $menu[$row->id]['show']            = $row->aktif;
                $menu[$row->id]['icon']            = $row->icon;
            }
        }

        $query->free_result();
        
        // ----------------------------------------------------------------------
        
		// $menu= array_values($menu);
		
        // now we will build the dynamic menus.
        $html_out  = ""; //"\t".'<div '.$this->id_menu.'>'."\n";
        /**
         * check $type for the type of menu to display.
         *
         * ( 0 = top menu ) ( 1 = horizontal ) ( 2 = vertical ) ( 3 = footer menu ).
         */
        switch ($type)
        {
            case 0:            // 0 = top menu
                break;
            case 1:            // 1 = horizontal menu
                $html_out .= "\t\t".'<ul '.$this->class_menu.'>'."\n";
                break;
            case 2:            // 2 = sidebar menu
                $html_out .= "<ul class='metismenu' id='menu1'>";
				break;
            case 3:            // 3 = footer menu
                break;
            default:        // default = horizontal menu
                $html_out .= "\t\t".'<ul '.$this->class_menu.'>'."\n";
                break;
        }
        
        // loop through the $menu array() and build the parent menus.
        // for ($i = 1; $i < count($menu); $i++)
		foreach($menu as $i => $item)
        {
            if (is_array($menu[$i]))    // must be by construction but let's keep the errors home
            {
                if ($menu[$i]['show'] && $menu[$i]['parent'] == 0)    // are we allowed to see this menu?
                {
                    if ($menu[$i]['is_parent'] == TRUE)
                    {
                        $ql     = "SELECT *, CASE WHEN parent_id > 0 THEN (select parent_id from m_menu a where a.id = b.id) 
                                  ELSE 0 END AS baseP FROM m_menu b WHERE url = '".$this->ci->uri->segment(1)."'";

						$qry 	= $this->ci->db->query($ql)->row();
						
						$pClass 	= ( ($qry->baseP > 0 && $qry->baseP == $menu[$i]['id']) || ($qry->baseP == 0 && $qry->parent_id == $menu[$i]['id'])) ? "active" : ""; 
						$collapseP 	= ( ($qry->baseP > 0 && $qry->baseP == $menu[$i]['id']) || ($qry->baseP == 0 && $qry->parent_id == $menu[$i]['id'])) ? "open" 	: ""; 
                        $collapse 	= ( ($qry->baseP > 0 && $qry->baseP == $menu[$i]['id'])) ? "open" 	: ""; 
                        // vdebug($collapse);
                        // $html_out .= '<li class="'.$pClass.'has-sub'.$collapse.'"><a href="'.base_url().$menu[$i]['url'].'"><span>'.$menu[$i]['title'].'</span></a>';
                        $html_out .= '<li class="'.$pClass.'" style="border-top:0.5px solid #ccc;margin:0px;"><a style="font-size:10pt;" href="#" class="has-arrow '.$pClass.'"><span class="'.$menu[$i]['icon'].'"></span><span class="mini-click-non"> '.$menu[$i]['title'].'</span></a>';
                        $html_out .= $this->get_childs($menu, $i, $collapseP, $collapse);
                        $html_out .= '</li>'."\n";
                    }
                    else {
                        // $html_out .= "\t\t\t\t".'<li>'.anchor($menu[$i]['url'], '<span>'.$menu[$i]['title'].'</span>');
                        $sel        = ($this->ci->uri->segment(1)==$menu[$i]['url']) ? "active" : "";
                        $html_out .= '<li class="'.$pClass.'" style="border-top:0.5px solid #ccc;margin:0px;"><a style="font-size:10pt;" class="'.$pClass.'" href="'.base_url().$menu[$i]['url'].'" aria-expanded="false"  aria-hidden="true"><span class="'.$menu[$i]['icon'].'"></span><span class="mini-click-non"> '.$menu[$i]['title'].'</span></a>';
                        $html_out .= '</li>'."\n";
                    }
                    // loop through and build all the child submenus.
                    
                }
                
            }
            else
            {
                exit (sprintf('menu nr %s must be an array', $i));
            }
        }
        $html_out .= "\t\t".'</ul>' . "\n";
        // $html_out .= "\t".'</div>' . "\n";
        return $html_out;
    }
    
    
    function menu_mobile ($table = 'm_menu', $type = '2')
    {
        $data   = $this->ci->encrypt->decode($this->ci->session->userdata('mn'));
        
        $dtMenu = array();
        $menu   = array();
        
        $q      = "SELECT * FROM m_menu WHERE id IN  (".$data.") order by kode";
        
        
        
		$query 	= $this->ci->db->query($q);
        
        //vdebug($query->num_rows());
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $menu[$row->id]['id']            = $row->id;
                $menu[$row->id]['title']        = $row->nama;
                $menu[$row->id]['link']            = $row->link_type;
                $menu[$row->id]['page']            = $row->page_id;
                $menu[$row->id]['module']        = $row->module_name;
                $menu[$row->id]['url']            = $row->url;
                // $menu[$row->id_menu]['uri']            = $row->uri;
                // $menu[$row->id]['dyn_group']    = $row->dyn_group_id;
                $menu[$row->id]['position']        = $row->position;
                $menu[$row->id]['target']        = $row->target;
                $menu[$row->id]['parent']        = $row->parent_id;
                $menu[$row->id]['is_parent']    = $row->is_parent;
                $menu[$row->id]['show']            = $row->aktif;
                $menu[$row->id]['icon']            = $row->icon;
            }
        }

        $query->free_result();
        
        // ----------------------------------------------------------------------
        
		// $menu= array_values($menu);
		
        // now we will build the dynamic menus.
        $html_out  = ""; //"\t".'<div '.$this->id_menu.'>'."\n";
        /**
         * check $type for the type of menu to display.
         *
         * ( 0 = top menu ) ( 1 = horizontal ) ( 2 = vertical ) ( 3 = footer menu ).
         */
        switch ($type)
        {
            case 0:            // 0 = top menu
                break;
            case 1:            // 1 = horizontal menu
                $html_out .= "\t\t".'<ul '.$this->class_menu.'>'."\n";
                break;
            case 2:            // 2 = sidebar menu
                $html_out .= "<ul class='mobile-menu-nav' id='menu1'>";
				break;
            case 3:            // 3 = footer menu
                break;
            default:        // default = horizontal menu
                $html_out .= "\t\t".'<ul '.$this->class_menu.'>'."\n";
                break;
        }
        
        // loop through the $menu array() and build the parent menus.
        // for ($i = 1; $i < count($menu); $i++)
		foreach($menu as $i => $item)
        {
            if (is_array($menu[$i]))    // must be by construction but let's keep the errors home
            {
                if ($menu[$i]['show'] && $menu[$i]['parent'] == 0)    // are we allowed to see this menu?
                {
                    if ($menu[$i]['is_parent'] == TRUE)
                    {
                        $ql     = "SELECT *, CASE WHEN parent_id > 0 THEN (select parent_id from m_menu a where a.id = b.id) 
                                  ELSE 0 END AS baseP FROM m_menu b WHERE url = '".$this->ci->uri->segment(1)."'";
                                  
                                  
						$qry 	= $this->ci->db->query($ql)->row();
                        
						
						$pClass 	= ( ($qry->baseP > 0 && $qry->baseP == $menu[$i]['id']) || ($qry->baseP == 0 && $qry->parent_id == $menu[$i]['id'])) ? "active" : ""; 
						$collapseP 	= ( ($qry->baseP > 0 && $qry->baseP == $menu[$i]['id']) || ($qry->baseP == 0 && $qry->parent_id == $menu[$i]['id'])) ? "open" 	: ""; 
                        $collapse 	= ( ($qry->baseP > 0 && $qry->baseP == $menu[$i]['id'])) ? "open" 	: ""; 
                        // vdebug($collapse);
                        // $html_out .= '<li class="'.$pClass.'has-sub'.$collapse.'"><a href="'.base_url().$menu[$i]['url'].'"><span>'.$menu[$i]['title'].'</span></a>';
                        $html_out .= '<li><a href="#" class="has-arrow"><span class="'.$menu[$i]['icon'].'"></span><span class="mini-click-non"> '.$menu[$i]['title'].'</span></a>';
                        $html_out .= $this->get_childs($menu, $i, $collapseP, $collapse);
                        $html_out .= '</li>'."\n";
                    }
                    else {
                        // $html_out .= "\t\t\t\t".'<li>'.anchor($menu[$i]['url'], '<span>'.$menu[$i]['title'].'</span>');
                        $sel        = ($this->ci->uri->segment(1)==$menu[$i]['url']) ? "active" : "";
                        $html_out .= '<li class="'.$sel.'"><a href="'.base_url().$menu[$i]['url'].'" aria-expanded="false"  aria-hidden="true"><span class="'.$menu[$i]['icon'].'"></span><span class="mini-click-non"> '.$menu[$i]['title'].'</span></a>';
                        $html_out .= '</li>'."\n";
                    }
                    // loop through and build all the child submenus.
                    
                }
                
            }
            else
            {
                exit (sprintf('menu nr %s must be an array', $i));
            }
        }
        $html_out .= "\t\t".'</ul>' . "\n";
        // $html_out .= "\t".'</div>' . "\n";
        return $html_out;
    }



	    /**
     * get_childs($menu, $parent_id) - SEE Above Method.
     *
     * Description:
     *
     * Builds all child submenus using a recurse method call.
     *
     * @param    mixed    $menu    array()
     * @param    string    $parent_id    id of parent calling this method.
     * @return    mixed    $html_out if has subcats else FALSE
     */
    function get_childs($menu, $parent_id, $collapseP='', $collapse='')
    {
        $has_subcats = FALSE;
        $html_out  = '';

        // $html_out .= "\n\t\t\t\t".'<div>'."\n";
        $html_out .= '<ul class="submenu-angle" aria-expanded="true">';
        // $html_out .= '<ul>';
        // for ($i = 1; $i <= count($menu); $i++)
		foreach($menu as $i => $item)
        {

            if ($menu[$i]['show'] && $menu[$i]['parent'] == $parent_id)    // are we allowed to see this menu?
            {
				$pClass 	= ($this->ci->uri->segment(1)==$menu[$i]['url']) ? "active" 	: "";

				// $collapseP 	= ($this->ci->uri->segment(1)==$menu[$i]['url']) ? "open" 		: "";
				$sel 		= ($this->ci->uri->segment(1)==$menu[$i]['url']) ? "selected" 	: "";
				
                $has_subcats = TRUE;
                if ($menu[$i]['is_parent'] == TRUE)
                {
					// $html_out .= "\t\t\t\t\t\t".'<li>'.anchor($menu[$i]['url'].' '.$this->class_parent, '<span>'.$menu[$i]['title'].'</span>');
                    $html_out .= '<li class="'.$pClass.'"><a style="font-size:8pt;" href="#" class="has-arrow '.$pClass.'"><span class="mini-sub-pro">'.$menu[$i]['title'].'</span></a>';
                    $html_out .= $this->get_childs($menu, $i, $collapseP, $collapse);
                    $html_out .= '</li>' . "\n";
                }
                else
                {
                    $html_out .= '<li class="'.$pClass.'"><a style="font-size:8pt;" class="'.$pClass.'"  href="'.base_url().$menu[$i]['url'].'" aria-expanded="false" aria-hidden="true"><span class="mini-sub-pro">'.$menu[$i]['title'].'</span></a>';
                    $html_out .= '</li>' . "\n";
                }
                // Recurse call to get more child submenus.
            }
        }
        $html_out .= "\t\t\t\t\t".'</ul>' . "\n";
        
         // $html_out .= "\t\t\t\t".'</div>' . "\n";
        return ($has_subcats) ? $html_out : FALSE;
    }
}
// ------------------------------------------------------------------------
// End of Dynamic_menu Library Class.
// ------------------------------------------------------------------------
/* End of file Dynamic_menu.php */
/* Location: ../application/libraries/Dynamic_menu.php */  