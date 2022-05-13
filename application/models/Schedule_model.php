<?php
	class Schedule_model extends CI_Model {
	
		//Function to fetch schedule
		public function fetch_schedule(){
			$this->db->trans_start();
            $query = $this->db->get('schedule');
			$this->db->trans_complete();

            return $query->row();
        }
		
		//Function to insert new schedule
		public function insert_schedule($startdate, $enddate, $starttime, $endtime){
            $data = array(
				'start_date' => $startdate,
				'end_date' => $enddate,
				'start_time' => $starttime,
				'end_time' => $endtime
			);

			$this->db->trans_start();
			$this->db->empty_table('schedule');
			$query = $this->db->insert('schedule', $data);
			$this->db->trans_complete();
			
			if ($this->db->trans_status() === FALSE)
			{
				return 'failed';
			} else {
				return 'success';
			}
        }

		//Function to delete schedule
		public function delete_schedule(){
			$this->db->trans_start();
			$this->db->empty_table('schedule');
		}
	}
?>
