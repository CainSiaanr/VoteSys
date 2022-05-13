<?php
	class Voter_model extends CI_Model {
		//fetch all student acoounts
        public function fetch_accounts(){
			//Starting transaction & fetching all accounts data
			$this->db->trans_start();
			$this->db->select('mahasiswa.*, himpunan.akronim AS organisasi_mahasiswa');
			$this->db->join('himpunan', 'himpunan.id = mahasiswa.himpunan_id');
            $query = $this->db->get('mahasiswa');
			$this->db->trans_complete();

            return $query->result();
        }
	
		//Function to fetch all voter
        public function fetch_all_voter(){
			$this->db->trans_start();
			$this->db->select('mahasiswa.*, himpunan.akronim AS organisasi_mahasiswa');
			$this->db->join('himpunan', 'himpunan.id = mahasiswa.himpunan_id');
			$this->db->where('mahasiswa.role', 'voter');
            $query = $this->db->get('mahasiswa');
			$this->db->trans_complete();

            return $query->result();
        }

		//Function to fetch voter according to their id
		public function fetch_voter_by_id($id){
			$this->db->trans_start();
			$this->db->select('mahasiswa.*, himpunan.akronim AS organisasi_mahasiswa');
			$this->db->join('himpunan', 'himpunan.id = mahasiswa.himpunan_id');
            $query = $this->db->get_where('mahasiswa', array('mahasiswa.id' => $id));
			$this->db->trans_complete();

            return $query->result();
        }
		
		//Function to insert new voter
        public function insert_voter($username, $password, $nama, $nim, $tahun_angkatan, $himpunan_id){
            $data = array(
				'username' => $username, 
				'password' => $password, 
				'nama' => $nama, 
				'nim' => $nim, 
				'tahun_angkatan' => $tahun_angkatan, 
				'himpunan_id' => $himpunan_id,
				'role' => 'voter'
			);

			$this->db->trans_start();
			$this->db->insert('mahasiswa', $data);
			$this->db->trans_complete();
			
			if ($this->db->trans_status() === FALSE)
			{
				return 'failed';
			} else {
				return 'success';
			}
        }
		
		//Function to update voter according to their id
        public function update_voter($id, $username, $password, $nama, $nim, $tahun_angkatan, $himpunan_id){
            $data = array(
				'username' => $username, 
				'password' => $password, 
				'nama' => $nama, 
				'nim' => $nim, 
				'tahun_angkatan' => $tahun_angkatan, 
				'himpunan_id' => $himpunan_id,
				'role' => 'voter'
			);
			
			$this->db->trans_start();
			$this->db->update('mahasiswa', $data, array('id' => $id));
			$this->db->trans_complete();
			
			if ($this->db->trans_status() === FALSE)
			{
				return 'failed';
			} else {
				return 'success';
			}
        }
		
		//Function to delete voter according to their id
		public function delete_voter($id){
			$this->db->trans_start();
			$this->db->delete('mahasiswa', array('id' => $id));
			$this->db->trans_complete();
			
			if ($this->db->trans_status() === FALSE)
			{
				return 'failed';
			} else {
				return 'success';
			}
		}

		//Function to delete all voter (unused)
		public function delete_all_voter(){
			$this->db->trans_start();
			$this->db->empty_table('mahasiswa');
			$this->db->trans_complete();
			
			if ($this->db->trans_status() === FALSE)
			{
				return 'failed';
			} else {
				return 'success';
			}
		}

	}
?>
