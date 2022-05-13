<?php
	class Inquiry_model extends CI_Model {
	
		//Function to fetch all inquiries
		public function fetch_all_inquiries(){
			$this->db->trans_start();
			$this->db->select('kontak.*, mahasiswa.nama AS sender');
			$this->db->join('mahasiswa', 'mahasiswa.id = kontak.sender_id');
			$this->db->order_by('last_changed', 'ASC');
            $query = $this->db->get('kontak');
			$this->db->trans_complete();

            return $query->result();
        }

		//Function to fetch inquiry according to their id
		public function fetch_inquiry_by_id($id){
			$this->db->trans_start();
			$this->db->select('kontak.*, mahasiswa.nama AS sender');
			$this->db->join('mahasiswa', 'mahasiswa.id = kontak.sender_id');
            $query = $this->db->get_where('kontak', array('kontak.id' => $id));
			$this->db->trans_complete();

            return $query->result();
        }
		
		//Function to insert new candidate(s)
		public function insert_inquiry($sender_id, $email, $subject, $detail, $status, $last_changed){
            $data = array(
				'sender_id' => $sender_id, 
				'email' => $email,
				'subject' => $subject, 
				'detail' => $detail, 
				'status' => $status, 
				'last_changed' => $last_changed
			);

			$this->db->trans_start();
			$this->db->insert('kontak', $data);
			$this->db->trans_complete();
			
			if ($this->db->trans_status() === FALSE)
			{
				return 'failed';
			} else {
				return 'success';
			}
        }

		//Function to update inquiry informaton
		public function update_inquiry($id, $note, $status, $last_changed){
			$data = array(
				'note' => $note, 
				'status' => $status, 
				'last_changed' => $last_changed
			);

			$this->db->trans_start();
			$this->db->update('kontak', $data, array('id' => $id));
			$this->db->trans_complete();
			
			if ($this->db->trans_status() === FALSE)
			{
				return 'failed';
			} else {
				return 'success';
			}
		}

		//Function to delete inquiry(ies)
		public function delete_inquiry($id){
			$this->db->trans_start();
			$this->db->where('id', $id);
			$this->db->delete('kontak', array('id' => $id));
			$this->db->trans_complete();

            if ($this->db->trans_status() === FALSE)
			{
				return 'failed';
			} else {
				return 'success';
			}
		}

		//Function to delete all inquiries
		public function delete_all_inquiry(){
			$this->db->trans_start();
			$query = $this->db->empty_table('kontak');
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
