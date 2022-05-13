<?php
	class Landing_model extends CI_Model {
	
		//Function to fetch landing page quote
		public function fetch_landing(){
			$this->db->trans_start();
            $query = $this->db->get('landing');
			$this->db->trans_complete();

            return $query->result();
        }

		//Function to fetch landing page quote according to their id
		public function fetch_landing_by_id($id){
			$this->db->trans_start();
            $query = $this->db->get_where('landing', array('id' => $id));
			$this->db->trans_complete();

            return $query->result();
        }
		
		//Function to insert landing page image
		public function insert_landing($name, $quote, $image){
            $data = array(
				'name' => $name, 
				'quote' => $quote,
				'image' => $image
			);

			$this->db->trans_start();
			$query = $this->db->insert('landing', $data);
			$this->db->trans_complete();
			
			if ($this->db->trans_status() === FALSE)
			{
				return 'failed';
			} else {
				return 'success';
			}
        }

		//Function to update landing page quote
		public function update_landing($id, $name, $quote, $image){
            if($image == '0'){
				$data = array(
					'id' => $id, 
					'name' => $name, 
					'quote' => $quote
				);
			}else{
				$data = array(
					'id' => $id, 
					'name' => $name, 
					'quote' => $quote,
					'image' => $image
				);
			}

			$this->db->trans_start();
			$query = $this->db->update('landing', $data, array('id' => $id));
			$this->db->trans_complete();
			
			if ($this->db->trans_status() === FALSE)
			{
				return 'failed';
			} else {
				return 'success';
			}
        }

		//Function to delete landing page quote according to their id
		public function delete_landing($id){
			$this->db->trans_start();
			$this->db->delete('landing', array('id' => $id));
			$this->db->trans_complete();
			
			if ($this->db->trans_status() === FALSE)
			{
				return 'failed';
			} else {
				return 'success';
			}
		}

		//Function to delete all landing images & quotes
		public function delete_all_landing(){
			$this->db->trans_start();
			$query = $this->db->empty_table('landing');
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
