<?php
	class Vote_model extends CI_Model {
	
		//Function to fetch votes according to each association
		public function fetch_vote_by_prodi($himpunan_id){
			$this->db->trans_start();
			$this->db->select('voting_ballot.*, himpunan.akronim AS program_studi');
			$this->db->join('himpunan', 'himpunan.id = voting_ballot.himpunan_id');
			$this->db->where('voting_ballot.himpunan_id', $himpunan_id);
            $query = $this->db->get('voting_ballot');
			$this->db->trans_complete();

            return $query->result();
        }

		//Function to fetch all votes (for admin use only)
		public function fetch_all_vote(){
			$this->db->trans_start();
			$this->db->select('voting_ballot.*, himpunan.akronim AS program_studi');
			$this->db->join('himpunan', 'himpunan.id = voting_ballot.himpunan_id');
			$this->db->order_by('time_submitted', 'ASC');
            $query = $this->db->get('voting_ballot');
			$this->db->trans_complete();

            return $query->result();
        }
		
		//Function to insert new votes
		public function insert_vote($id, $votee, $himpunan_id, $time_submitted){
            $data = array(
				//'voteid' => $voteid,
				'voter_id' => $id,
				'votee' => $votee,
				'himpunan_id' => $himpunan_id,
				'time_submitted' => $time_submitted
			);

			$this->db->trans_start();
			$query = $this->db->insert('voting_ballot', $data);
			$this->db->trans_complete();
			
			if ($this->db->trans_status() === FALSE)
			{
				return 'failed';
			} else {
				return 'success';
			}
        }

		//Function to delete all votes
		public function delete_all_vote(){
			$this->db->trans_start();
			$query = $this->db->empty_table('voting_ballot');
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
