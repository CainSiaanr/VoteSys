<?php
	class Candidate_model extends CI_Model {
	
		//Function to fetch all candidate
        public function fetch_all_candidate(){
			$this->db->trans_start();
			$this->db->select('pasangan_calon.*, himpunan.akronim AS nama_himpunan');
			$this->db->join('himpunan', 'himpunan.id = pasangan_calon.himpunan_id');
			$this->db->order_by('nama_himpunan', 'ASC');
			$this->db->order_by('nomor_urut_pasangan', 'ASC');
            $query = $this->db->get('pasangan_calon');
			$this->db->trans_complete();

            return $query->result();
        }

		//Function to fetch candidates according to their organzation
		public function fetch_candidate($himpunan_id){
			$this->db->trans_start();
			$this->db->select('pasangan_calon.*, himpunan.akronim AS nama_himpunan');
			$this->db->join('himpunan', 'himpunan.id = pasangan_calon.himpunan_id');
			$this->db->where('pasangan_calon.himpunan_id', $himpunan_id);
			$this->db->order_by('nomor_urut_pasangan', 'ASC');
            $query = $this->db->get('pasangan_calon');
			$this->db->trans_complete();

            return $query->result();
        }

		//Function to fetch candidates according to their id
		public function fetch_candidate_by_id($id){
			$this->db->trans_start();
			$this->db->select('pasangan_calon.*, himpunan.akronim AS nama_himpunan');
			$this->db->join('himpunan', 'himpunan.id = pasangan_calon.himpunan_id');
            $query = $this->db->get_where('pasangan_calon', array('pasangan_calon.id' => $id));
			$this->db->trans_complete();

            return $query->result();
        }
		
		//Function to insert new candidate(s)
		public function insert_candidate($himpunan_id, $nomor_urut_pasangan, $calon_ketua, $calon_wakil_ketua, $foto_profil, $foto_ballot, $slogan, $visi, $misi, $link_instagram){
            $data = array(
				'himpunan_id' => $himpunan_id, 
				'nomor_urut_pasangan' => $nomor_urut_pasangan, 
				'calon_ketua' => $calon_ketua, 
				'calon_wakil_ketua' => $calon_wakil_ketua, 
				'foto_profil' => $foto_profil, 
				'foto_ballot' => $foto_ballot, 
				'moto_slogan' => $slogan, 
				'visi' => $visi, 
				'misi' => $misi,
				'link_instagram' => $link_instagram
			);

			$this->db->trans_start();
			$this->db->insert('pasangan_calon', $data);
			$this->db->trans_complete();
			
			if ($this->db->trans_status() === FALSE)
			{
				return 'failed';
			} else {
				return 'success';
			}
        }

		//Function to update candidate informaton
		public function update_candidate($id, $himpunan_id, $nomor_urut_pasangan, $calon_ketua, $calon_wakil_ketua, $foto_profil, $foto_ballot, $slogan, $visi, $misi, $link_instagram){
			if($foto_profil != '0' && $foto_ballot != '0'){	
				$data = array(
					'himpunan_id' => $himpunan_id, 
					'nomor_urut_pasangan' => $nomor_urut_pasangan, 
					'calon_ketua' => $calon_ketua, 
					'calon_wakil_ketua' => $calon_wakil_ketua, 
					'foto_profil' => $foto_profil, 
					'foto_ballot' => $foto_ballot, 
					'moto_slogan' => $slogan, 
					'visi' => $visi, 
					'misi' => $misi,
					'link_instagram' => $link_instagram
				);
			}else if($foto_profil == '0' && $foto_ballot == '0'){
				$data = array(
					'himpunan_id' => $himpunan_id, 
					'nomor_urut_pasangan' => $nomor_urut_pasangan, 
					'calon_ketua' => $calon_ketua, 
					'calon_wakil_ketua' => $calon_wakil_ketua, 
					'moto_slogan' => $slogan, 
					'visi' => $visi, 
					'misi' => $misi,
					'link_instagram' => $link_instagram
				);
			}else if($foto_profil == '0' && $foto_ballot != '0'){
				$data = array(
					'himpunan_id' => $himpunan_id, 
					'nomor_urut_pasangan' => $nomor_urut_pasangan, 
					'calon_ketua' => $calon_ketua, 
					'calon_wakil_ketua' => $calon_wakil_ketua, 
					'foto_ballot' => $foto_ballot, 
					'moto_slogan' => $slogan, 
					'visi' => $visi, 
					'misi' => $misi,
					'link_instagram' => $link_instagram
				);
			}else if($foto_profil != '0' && $foto_ballot == '0'){
				$data = array(
					'himpunan_id' => $himpunan_id, 
					'nomor_urut_pasangan' => $nomor_urut_pasangan, 
					'calon_ketua' => $calon_ketua, 
					'calon_wakil_ketua' => $calon_wakil_ketua,
					'foto_profil' => $foto_profil,  
					'moto_slogan' => $slogan, 
					'visi' => $visi, 
					'misi' => $misi,
					'link_instagram' => $link_instagram
				);
			}

			$this->db->trans_start();
			$this->db->update('pasangan_calon', $data, array('id' => $id));
			$this->db->trans_complete();
			
			if ($this->db->trans_status() === FALSE)
			{
				return 'failed';
			} else {
				return 'success';
			}
		}

		//Function to delete candidate(s)
		public function delete_candidate($id){
			$this->db->trans_start();
			$this->db->where('id', $id);
			$this->db->delete('pasangan_calon', array('id' => $id));
			$this->db->trans_complete();

            if ($this->db->trans_status() === FALSE)
			{
				return 'failed';
			} else {
				return 'success';
			}
		}

		//Function to delete all candidates
		public function delete_all_candidate(){
			$this->db->trans_start();
			$query = $this->db->empty_table('pasangan_calon');
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
