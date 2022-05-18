<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Savevote extends CI_Controller {

	public function save_vote($m){
		//Fetch form data
		//$m = $this->input->post('vote');

		//Set timezone
		date_default_timezone_set('Asia/Jakarta');

		$check = log((int)$m,10000);

		if ( ! preg_match('/^\d+$/', $check) ){
			$this->session->set_flashdata('query_result', 'Vote tidak valid.');
			redirect('vote');
		}

		if($this->check_voted($this->input->cookie('prodi'))){
			$this->session->set_flashdata('query_result', 'Vote tidak valid.');
			redirect('vote');
		}
		
		$p = '14759';  //'1117'; //'8069';

		$q = '12073'; //'1439'; //'8539';

		$n = '178185407'; //'1607363'; //'68901191';

		$n2 = '31750039267755649'; //'2583615813769';

		$g = '178185408'; //'1607365'; //'68901192';

		$lambda = '178158576'; //'802404'; //'68884584';

		$mu = '35104471'; //'228116'; //'4787859';

		$r = (string)random_int(1, 178185407);

		$c = bcmod(bcmul(bcpowmod($g,$m,$n2),bcpowmod($r,$n,$n2)),$n2);

		//$c = $m;

		//Load model and insert new entry to database
		$this->load->model('vote_model');
		//$data['query'] = $this->vote_model->insert_pail($this->input->cookie('voter_id'), $c);

		//TODO : REPLACE THIS ONE BELOW WITH THE VERSION ABOVE
		$data['query'] = $this->vote_model->insert_vote($this->input->cookie('id'), $c, $this->input->cookie('prodi'), date("Y-m-d H:i:s"));

		//Set flashdata to inform user about query result
		if($data['query'] == 'success'){
			$this->session->set_flashdata('query_result', 'Pemberian suara berhasil. Terima kasih atas partisipasi anda.');
		}else{
			$this->session->set_flashdata('query_result', 'Pemberian suara gagal. Mohon coba lagi.');
		}

		redirect('vote');
	}

	private function manualpowmod($int, $pow, $mod){
		$result = 1;
		for($i = 0; $i < $pow; $i++){
			$result = ($result * $int) % $mod;
		}

		return $result;
	}

	private function check_voted($prodi){
		$this->load->model('vote_model');
		$query = $this->vote_model->fetch_vote_by_prodi($prodi);

		foreach ($query as $row=>$value){
			//Checking vote history
			if($value->voter_id == $this->input->cookie('id')){
				return true;
			}
		}
		return false;
	}
}
?>
