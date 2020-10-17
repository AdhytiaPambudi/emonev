<?php

	class Opd_model extends CI_Model{



		public function add_opd($data){

			$this->db->insert('sys_group', $data);

			return true;

		}



		public function get_all_opds(){

			$this->db->where('id_group !=', 1);
			$this->db->order_by("nm_group", "asc");
			$query = $this->db->get('sys_group');

			return $result = $query->result_array();

		}



		public function get_opd_by_id($id){

			$query = $this->db->get_where('sys_group', array('id_group' => $id));
			
			$data = array();
			$hasil = "";

			// SETTING TAHUN ANGGARAN
			$this->db->select('thn_ang');
			$querysysclient = $this->db->get('sys_sclient');
			$rowsysclient = $querysysclient->row();
			if (isset($rowsysclient))
			{
				$data['thn_ang'] = $rowsysclient->thn_ang;
			}

			$totalRecord = $query->num_rows();
			
			$i = 0;
			foreach ($query->result() as $row)
			{
				$i++;
				if ($i < $totalRecord)
				{
					$hasil .= $row->id_menu . ',';				
				} else 
				{
					$hasil .= $row->id_menu;				
				}
			}
			$data['nm_group'] = $row->nm_group;
			$data['menu_permission'] = $hasil;


			return $result = $data;

		}



		public function edit_opd($data, $id){

			$this->db->where('id_group', $id);

			$this->db->update('sys_group', $data);

			return true;

		}



	}



?>