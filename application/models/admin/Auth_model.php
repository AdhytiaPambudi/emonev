<?php
	class Auth_model extends CI_Model{

		public function login($data){
			
			$query = $this->db->get_where('m_user', array('username' => $data['username']));
			if ($query->num_rows() == 0){
				return false;
			}
			else{
				//Compare the password attempt with the password we have stored.
				$result = $query->row_array();
			    $validPassword = password_verify($data['userpwd'], $result['userpwd']);
			    if($validPassword){
			        return $result = $query->row_array();
			    }
				
			}
		}

		public function change_pwd($data, $id){
			$this->db->where('id_user', $id);
			$this->db->update('ms_user', $data);
			return true;
		}

		public function update($data){
			$ctgl = date("Y-m-d H:i:s");
			$sql = "UPDATE ms_user SET st_login=1, last_login='$ctgl' WHERE email='" .$data['email'] ."' ";
			$this->db->query($sql);
			return true;
		}

		public function update_out($id2){
			$ctgl = date("Y-m-d H:i:s");
			$sql = "UPDATE ms_user SET st_login=0, last_logout='$ctgl' WHERE id_user='$id2'";
			$this->db->query($sql);
			return true;
		}

	}

?>