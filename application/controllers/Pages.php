<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

    public function view($page = 'landingpage')
	{
        if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php'))
        {
				//Redirect guest to error page whenever they try to access invalid page
				redirect('error');
        }

		//Redirect admins to admin page
		if($this->input->cookie('role') == 'admin'){
			redirect('admin/candidate');
		}

		//Get page name, background, & schedule
		$data['title'] = strtolower($page);
		$data['background'] =  $this->get_background();
		$data['schedule'] = $this->get_schedule();

		//Flushing query result displayer
		$data['query_result'] = NULL;

		//Getting query result from previous admin action
		if($this->session->flashdata('query_result') != NULL){
			$data['query_result'] = $this->session->flashdata('query_result');
		}

		//Set timezone
		date_default_timezone_set('Asia/Jakarta');

		//Fetching data from database according to the requested page
		switch ($page){
			case 'landingpage' : 
				$data['landing'] =  $this->get_landing();
				$data['key'] = array_rand($data['landing']);
			case 'home' :
				$data['prodi'] = $this->get_association();
				for($i = 0; $i < count($data['prodi']); $i++)
				{
					$data['candidate'][$i] = $this->get_candidates($data['prodi'][$i]->id);
				}
				break;
			case 'vote' :
				if($this->input->cookie('prodi') != null){
					$data['prodi'] = $this->get_association_by_id($this->input->cookie('prodi'));
					$data['enddate'] = new DateTime($data['prodi']['0']->tanggal_selesai." ".$data['prodi']['0']->jam_selesai);
	
					if(new DateTime(date("Y-m-d H:i:s")) > new DateTime($data['prodi']['0']->tanggal_mulai.$data['prodi']['0']->jam_mulai) && new DateTime(date("Y-m-d H:i:s")) < new DateTime($data['prodi']['0']->tanggal_selesai.$data['prodi']['0']->jam_selesai)){
						$data['candidate'] = $this->get_candidates($this->input->cookie('prodi')); 
					}else{
						$data['candidate'] = null;
					}
				}else{
					$data['prodi'] = null;
					$data['candidate'] = null;
				}

				if($this->input->cookie('role') == 'voter'){
					$data['role'] = $this->input->cookie('role');
				}else{
					$data['role'] = null;
				}

				if($this->check_voted($this->input->cookie('prodi'))){
					$data['voted'] = true;
				}else{
					$data['voted'] = false;
				}
				break;
			case 'votingresult':
				$data['prodi'] = $this->get_association();

				for($i = 0; $i < count($data['prodi']); $i++)
				{
					if(new DateTime(date("Y-m-d H:i:s")) > new DateTime($data['prodi'][$i]->tanggal_selesai.$data['prodi'][$i]->jam_selesai)){
						$data['candidate'][$i] = $this->get_candidates($data['prodi'][$i]->id);
						$data['result'][$i] = $this->decrypt($data['prodi'][$i]->id);
						$data['count'][$i] = $this->get_count($data['prodi'][$i]->id);
					}else{
						$data['candidate'][$i] = null;
						$data['result'][$i] = null;
						$data['count'][$i] = null;
					}
				}
				break;
			case 'contact':
				if($this->input->cookie('name') != null){
					$data['name'] = $this->input->cookie('name');
				}else{
					$data['name'] = null;
				}
			default:
		}
		
		//Loading pages and data
        if($data != null){
			$this->load->view('templates/header', $data);
			$this->load->view('pages/'.$page, $data);
			$this->load->view('templates/footer', $data);
		}else{
			$this->load->view('templates/header');
			$this->load->view('pages/'.$page);
			$this->load->view('templates/footer');
		}
	}

	private function get_background(){
		$this->load->model('background_model');
		return $this->background_model->fetch_background();
	}

	private function get_schedule(){
		$this->load->model('schedule_model');
		return $this->schedule_model->fetch_schedule();
	}

	private function get_landing(){
		$this->load->model('landing_model');
		return $this->landing_model->fetch_landing();
	}

	public function get_association(){
		$this->load->model('prodi_model');
		return $this->prodi_model->fetch_all_prodi();
	}

	private function get_candidates($prodi){
		$this->load->model('candidate_model');
		return $this->candidate_model->fetch_candidate($prodi);
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

	private function decrypt($prodi){
		$c = $this->tally_result($prodi);

		//INT VERSION
		//$x = $this->manualpowmod($c, 802404, 2583615813769);

		//STRING VERSION
		$x = bcpowmod((string)$c, '178158576', '31750039267755649');

		$m = bcmod(bcmul(bcdiv(bcsub($x,'1'),'178185407'),'35104471'),'178185407');

		return $m;
	}

	private function tally_result($prodi){
		$this->load->model('vote_model');
		$query = $this->vote_model->fetch_vote_by_prodi($prodi);

		//INT VERSION
		/*$total = 1;

		for($i = 0; $i < count($query); $i++)
		{
			$total = ($total * $query[$i]->votee) % 2583615813769;
		}*/

		//STRING VERSION
		$total = '1';

		for($i = 0; $i < count($query); $i++)
		{
			$total = bcmod(bcmul((string)$total, (string)$query[$i]->votee),'31750039267755649');
		}

		return $total;
	}

	private function get_count($prodi){
		$this->load->model('vote_model');
		$query = $this->vote_model->fetch_vote_by_prodi($prodi);

		return count($query);
	}

	private function manualpowmod($int, $pow, $mod){
		$result = 1;
		for($i = 0; $i < $pow; $i++){
			$result = ($result * $int) % $mod;
		}

		return $result;
	}

	public function get_association_by_id($id){
		$this->load->model('prodi_model');
		return $this->prodi_model->fetch_prodi_by_id($id);
	}
}
?>
