<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function view($page = 'candidate')
	{
        if ( ! file_exists(APPPATH.'views/pages/admin/'.$page.'.php'))
        {
				//Redirect admin to error page whenever they try to access invalid page
                redirect('error');
        }

		//Redirect guest to error page whenever they try to access any of the admin pages without logging in
		if($this->input->cookie('role') == NULL || $this->input->cookie('role') == 'voter'){
			redirect('error');
		}else{
			//Create cookie to save username and make sure admin can access the admin page after logging in
			//$data['role'] = $this->input->cookie('role');
		}

		//Flushing query result displayer
		$data['query_result'] = NULL;

		//Getting query result from previous admin action
		if($this->session->flashdata('query_result') != NULL){
			$data['query_result'] = $this->session->flashdata('query_result');
		}

		//Set timezone
		date_default_timezone_set('Asia/Jakarta');

		//Get page name & background
		$data['title'] = strtolower($page);
		$data['background'] =  $this->get_background();

		//Fetching data from database according to the requested page
		switch ($page){
			case 'candidate':
				$data['query'] = $this->get_candidate();
				break;
			case 'voter':
				$data['query'] = $this->get_voter();
				break;
			case 'association':
				$data['query'] = $this->get_association();
				break;
			case 'schedule':
				$datatemp = $this->get_schedule();
				$data['start_date'] = $datatemp->start_date;
				$data['start_time'] = new DateTime($datatemp->start_time);
				$data['end_date'] = $datatemp->end_date;
				$data['end_time'] = new DateTime($datatemp->end_time);
				break;
			case 'landing':
				$data['query'] = $this->get_landing();
				break;
			case 'background':
				$data['query'] = $this->get_background();
				break;
			case 'inquiry':
				$data['query'] = $this->get_inquiry();
				break;
			case 'progress':
				$data['prodi'] = $this->get_association();
				$data['result'] = $this->get_vote();
				break;
			default:
		}

		//Loading pages and data
        $this->load->view('templates/adminheader', $data);
        $this->load->view('pages/admin/'.$page, $data);
        $this->load->view('templates/footer', $data);
	}

	public function action($page = 'admin', $id = '1')
	{
        if ( ! file_exists(APPPATH.'views/pages/admin/adminaction/'.$page.'.php'))
        {
				//Redirect admin to error page whenever they try to access invalid page
                redirect('error');
        }
		
		//Redirect guest to error page whenever they try to access any of the admin pages without logging in
		if($this->input->cookie('role') == NULL || $this->input->cookie('role') == 'voter'){
			redirect('error');
		}

		//Get page name & background
		$data['title'] = strtolower($page);
		$data['background'] =  $this->get_background();
		//Getting id of the entry for database query
		$data['id'] = $id;

		//Fetching data from database according to the requested page
		switch ($page){
			case 'insert_candidate':
				$data['prodi'] = $this->get_association();
				break;
			case 'update_candidate':
				$data['query'] = $this->get_candidate_by_id($id);
				$data['prodi'] = $this->get_association();
				break;
			case 'update_voter':
				$data['query'] = $this->get_voter_by_id($id);
				break;
			case 'update_association':
				$data['query'] = $this->get_association_by_id($id);
				break;
			case 'update_schedule':
				$data['query'] = $this->get_schedule();
				break;
			case 'update_landing':
				$data['query'] = $this->get_landing_by_id($id);
				break;
			case 'update_background':
				$data['query'] = $this->get_background();
				break;
			case 'update_inquiry':
				$data['query'] = $this->get_inquiry_by_id($id);
				break;
			default:
		}

		//Loading pages and data
        $this->load->view('templates/adminheader', $data);
        $this->load->view('pages/admin/adminaction/'.$page, $data);
        $this->load->view('templates/footer', $data);
	}

	public function filter($association = '')
	{
		//Redirect admin to error page whenever they try to access invalid page
		$error_check = 0;
		$assoc_list = $this->get_association();
		
        for($i = 0; $i < count($assoc_list); $i++){
			if ($assoc_list[$i]->id == $association)
			{
				$error_check = 1;
			}
		}
		if($error_check == 0){
			redirect('error');
		}
		
		//Redirect guest to error page whenever they try to access any of the admin pages without logging in
		if($this->input->cookie('role') == NULL || $this->input->cookie('role') == 'voter'){
			redirect('error');
		}

		//Get page name & background
		$data['title'] = 'progress';
		$data['background'] =  $this->get_background();

		//Fetching data from database according to the requested page
		$data['prodi'] = $this->get_association();
		$data['result'] = $this->get_vote_by_association($association);

		//Loading pages and data
        $this->load->view('templates/adminheader', $data);
        $this->load->view('pages/admin/progress', $data);
        $this->load->view('templates/footer', $data);
	}

	public function get_candidate(){
		$this->load->model('candidate_model');
		return $this->candidate_model->fetch_all_candidate();
	}

	public function get_voter(){
		$this->load->model('voter_model');
		return $this->voter_model->fetch_all_voter();
	}

	public function get_vote(){
		$this->load->model('vote_model');
		return $this->vote_model->fetch_all_vote();
	}

	public function get_association(){
		$this->load->model('prodi_model');
		return $this->prodi_model->fetch_all_prodi();
	}

	public function get_landing(){
		$this->load->model('landing_model');
		return $this->landing_model->fetch_landing();
	}

	public function get_inquiry(){
		$this->load->model('inquiry_model');
		return $this->inquiry_model->fetch_all_inquiries();
	}

	private function get_akronim_prodi(){
		$this->load->model('prodi_model');
		return $this->prodi_model->fetch_akronim_prodi();
	}

	private function decrypt($prodi){
		$c = $this->tally_result($prodi);

		//INT VERSION
		//$x = $this->manualpowmod($c, 802404, 2583615813769);

		//STRING VERSION
		$x = bcpowmod((string)$c, '802404', '2583615813769');

		$m = ((((int)$x - 1)/1607363) * 228116) % 1607363;

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
			$total = bcmod(bcmul((string)$total, (string)$query[$i]->votee),'2583615813769');
		}

		return $total;
	}

	private function get_candidates($prodi){
		$this->load->model('candidate_model');
		return $this->candidate_model->fetch_candidate($prodi);
	}

	private function get_count($prodi){
		$this->load->model('vote_model');
		$query = $this->vote_model->fetch_vote_by_prodi($prodi);

		return count($query);
	}

	public function get_candidate_by_id($id){
		$this->load->model('candidate_model');
		return $this->candidate_model->fetch_candidate_by_id($id);
	}

	public function get_voter_by_id($id){
		$this->load->model('voter_model');
		return $this->voter_model->fetch_voter_by_id($id);
	}

	public function get_vote_by_association($association){
		$this->load->model('vote_model');
		return $this->vote_model->fetch_vote_by_prodi($association);
	}

	public function get_association_by_id($id){
		$this->load->model('prodi_model');
		return $this->prodi_model->fetch_prodi_by_id($id);
	}

	public function get_inquiry_by_id($id){
		$this->load->model('inquiry_model');
		return $this->inquiry_model->fetch_inquiry_by_id($id);
	}

	public function get_schedule(){
		$this->load->model('schedule_model');
		return $this->schedule_model->fetch_schedule();
	}

	public function get_landing_by_id($id){
		$this->load->model('landing_model');
		return $this->landing_model->fetch_landing_by_id($id);
	}

	public function get_background(){
		$this->load->model('background_model');
		return $this->background_model->fetch_background();
	}
}
?>
