<?php
	class Prodi_model extends CI_Model {
	
		//Function to fetch all prodi
        public function fetch_all_prodi(){
			$this->db->trans_start();
            $query = $this->db->get('himpunan');
			$this->db->trans_complete();

            return $query->result();
        }

		//Function to fetch prodi according to their id
		public function fetch_prodi_by_id($id){
			$this->db->trans_start();
            $query = $this->db->get_where('himpunan', array('id' => $id));
			$this->db->trans_complete();

            return $query->result();
        }

		//Function to fetch prodi acronyms
		public function fetch_akronim_prodi(){
			$this->db->trans_start();
			$this->db->select('akronim');
			$query = $this->db->get('himpunan');
			$this->db->trans_complete();

            return $query->result();
        }
		
		//Function to insert new prodi
        public function insert_prodi($akronim, $nama, $logo, $tanggal_mulai, $tanggal_selesai, $jam_mulai, $jam_selesai){
            $data = array(
				'akronim' => $akronim, 
				'nama' => $nama, 
				'logo' => $logo,
				'tanggal_mulai' => $tanggal_mulai,
				'tanggal_selesai' => $tanggal_selesai,
				'jam_mulai' => $jam_mulai,
				'jam_selesai' => $jam_selesai
			);

			$this->db->trans_start();
			$this->db->insert('himpunan', $data);
			$this->db->trans_complete();
			
			if ($this->db->trans_status() === FALSE)
			{
				return 'failed';
			} else {
				return 'success';
			}
        }
		
		//Function to update prodi according to their id
        public function update_prodi($id, $akronim, $nama, $logo, $tanggal_mulai, $tanggal_selesai, $jam_mulai, $jam_selesai){
            if($logo == '0'){	
				$data = array(
					'akronim' => $akronim, 
					'nama' => $nama,
					'tanggal_mulai' => $tanggal_mulai,
					'tanggal_selesai' => $tanggal_selesai,
					'jam_mulai' => $jam_mulai,
					'jam_selesai' => $jam_selesai
				);
			}else{
				$data = array(
					'akronim' => $akronim, 
					'nama' => $nama, 
					'logo' => $logo,
					'tanggal_mulai' => $tanggal_mulai,
					'tanggal_selesai' => $tanggal_selesai,
					'jam_mulai' => $jam_mulai,
					'jam_selesai' => $jam_selesai
				);
			}
			
			$this->db->trans_start();
			$this->db->update('himpunan', $data, array('id' => $id));
			$this->db->trans_complete();
			
			if ($this->db->trans_status() === FALSE)
			{
				return 'failed';
			} else {
				return 'success';
			}
        }
		
		//Function to delete prodi according to their id
		public function delete_prodi($id){
			$this->db->trans_start();
			$this->db->delete('himpunan', array('id' => $id));
			$this->db->trans_complete();
			
			if ($this->db->trans_status() === FALSE)
			{
				return 'failed';
			} else {
				return 'success';
			}
		}

		//Function to delete all prodi (unused)
		public function delete_all_prodi(){
			$this->db->trans_start();
			$this->db->empty_table('himpunan');
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
