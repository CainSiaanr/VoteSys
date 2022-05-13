<?php
	class Background_model extends CI_Model {
	
		//Function to fetch background image
		public function fetch_background(){
			$this->db->trans_start();
            $query = $this->db->get('background');
			$this->db->trans_complete();

            return $query->row();
        }
		
		//Function to insert new background image
		public function update_background($image){
            $data = array(
				'image' => $image
			);

			$this->db->trans_start();
			$this->db->empty_table('background');
			$this->db->insert('background', $data);
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
