<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud extends CI_Controller {

	//Create
	public function insert_inquiry(){
		//Set timezone
		date_default_timezone_set('Asia/Jakarta');

		$subject = $this->input->post('subject');
		$email = $this->input->post('email');
		$detail = $this->input->post('detail');

		$this->load->model('inquiry_model');
		$query = $this->inquiry_model->insert_inquiry($this->input->cookie('id'), $email, $subject, $detail, 'Baru', date("Y-m-d H:i:s"));

		//Set flashdata to inform user about inquiry result
		if($query == 'success'){
			$this->session->set_flashdata('query_result', 'Pesan berhasil dikirimkan.<br>Mohon tunggu balasan kami pada email yang anda berikan.');
		}else if($query == 'failed'){
			$this->session->set_flashdata('query_result', 'Pengiriman pesan gagal. Mohon coba kembali.');
		}else{
			$this->session->set_flashdata('query_result', 'Terjadi kesalahan pada sistem. Mohon coba kembali.');
		}
		
		redirect(site_url('contact'));
	}

	public function insert_candidate(){
		//Check whether or not the amount of candidates for the association has reached 2
		$this->load->model('candidate_model');
		if(count($this->candidate_model->fetch_candidate($this->input->post('himpunan_id'))) >= 2){
			$this->session->set_flashdata('query_result', 'Anda tidak dapat mendaftarkan lebih dari 2 pasangan calon untuk masing-masing himpunan.');
			redirect(site_url('/admin/candidate'));
		}
		
		//Setting file upload configs
		$config['upload_path']          = './public/img/candidates/'.strtolower($this->input->cookie('prodi'));
        $config['allowed_types']        = 'jpg|png';
        $config['max_size']             = 0;
        $config['max_width']            = 0;
        $config['max_height']           = 0;

        $this->upload->initialize($config);

		//Uploading the file and checking whether or not it succeeded
        if ( ! $this->upload->do_upload('foto_profil'))
        {
                //If failed, display error
				$error = array('error' => $this->upload->display_errors());
				
				//Inform admin about error
                //echo $error['error'];
				$this->session->set_flashdata('query_result', 'Foto profil tidak memenuhi syarat.');
				redirect(site_url('/admin/candidate'));
        }
        else
        {
				//Get file path
				$foto_profil = $this->upload->data('file_name');
				
                //Setting file upload configs
				$config['upload_path']          = './public/img/candidates/'.strtolower($this->input->cookie('prodi'));
				$config['allowed_types']        = 'jpg|png';
				$config['max_size']             = 0;
				$config['max_width']            = 0;
				$config['max_height']           = 0;

				$this->upload->initialize($config);

				//Uploading the file and checking whether or not it succeeded
				if ( ! $this->upload->do_upload('foto_ballot'))
				{
						//If failed, display error
						$error = array('error' => $this->upload->display_errors());
						
						//Inform admin about error
						//echo $error['error'];
						$this->session->set_flashdata('query_result', 'Foto ballot tidak memenuhi syarat.');
						redirect(site_url('/admin/candidate'));
				}
				else
				{
						//If success, fetch upload data and form data
						$himpunan_id = $this->input->post('himpunan_id');
						$nomor_urut_pasangan = $this->input->post('nomor_urut_pasangan');
						$calon_ketua = $this->input->post('calon_ketua');
						$calon_wakil_ketua = $this->input->post('calon_wakil_ketua');
						
						$foto_ballot = $this->upload->data('file_name');
						$slogan = $this->input->post('slogan');
						$visi = $this->input->post('visi');
						$misi = $this->input->post('misi');
						$link_instagram = $this->input->post('link_instagram');
		
						//Load model and insert new entry to database
						$query = $this->candidate_model->insert_candidate($himpunan_id, $nomor_urut_pasangan, $calon_ketua, $calon_wakil_ketua, $foto_profil, $foto_ballot, $slogan, $visi, $misi, $link_instagram);

						//Set flashdata to inform admin about query result
						if($query == 'success'){
							$this->session->set_flashdata('query_result', 'Pendaftaran pasangan calon baru berhasil.');
						}else if($query == 'failed'){
							$this->session->set_flashdata('query_result', 'Pendaftaran pasangan calon baru gagal.');
						}else{
							$this->session->set_flashdata('query_result', 'Terjadi kesalahan pada sistem. Mohon coba kembali.');
						}

						redirect(site_url('/admin/candidate'));
				}
        }
	}

	public function insert_voter(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$nama = $this->input->post('nama');
		$nim = $this->input->post('nim');
		$tahun_angkatan = $this->input->post('tahun_angkatan');
		$himpunan_id = $this->input->post('organisasi_mahasiswa');

		$this->load->model('voter_model');
		$query = $this->voter_model->insert_voter($username, $password, $nama, $nim, $tahun_angkatan, $himpunan_id);

		
		//Set flashdata to inform admin about query result
		if($query == 'success'){
			$this->session->set_flashdata('query_result', 'Penambahan pemberi suara berhasil.');
		}else if($query == 'failed'){
			$this->session->set_flashdata('query_result', 'Penambahan pemberi suara gagal.');
		}else{
			$this->session->set_flashdata('query_result', 'Terjadi kesalahan pada sistem. Mohon coba kembali.');
		}
		
		redirect(site_url('/admin/voter'));
	}

	public function insert_association(){
		//Setting file upload configs
		$config['upload_path']          = './public/img/association/';
        $config['allowed_types']        = 'jpg|png';
        $config['max_size']             = 0;
        $config['max_width']            = 0;
        $config['max_height']           = 0;

        $this->upload->initialize($config);

		//Uploading the file and checking whether or not it succeeded
        if ( ! $this->upload->do_upload('logo'))
        {
                //If failed, display error
				$error = array('error' => $this->upload->display_errors());
				
				//Inform admin about error
                //echo $error['error'];
				$this->session->set_flashdata('query_result', 'Foto himpunan tidak memenuhi syarat.');
				redirect(site_url('/admin/association'));
        }
        else
        {
				$nama = $this->input->post('nama');
				$akronim = $this->input->post('akronim');
				$logo = $this->upload->data('file_name');
				$tanggal_mulai = $this->input->post('tanggal_mulai');
				$tanggal_selesai = $this->input->post('tanggal_selesai');
				$jam_mulai = $this->input->post('jam_mulai');
				$jam_selesai = $this->input->post('jam_selesai');
				
				//Get file path, load model then update entry on database
				$this->load->model('prodi_model');
				$query = $this->prodi_model->insert_prodi($akronim, $nama, $logo, $tanggal_mulai, $tanggal_selesai, $jam_mulai, $jam_selesai);
        }
		//Set flashdata to inform admin about query result
		if($query == 'success'){
			$this->session->set_flashdata('query_result', 'Pendaftaran himpunan baru berhasil.');
		}else if($query == 'failed'){
			$this->session->set_flashdata('query_result', 'Pendaftaran himpunan baru gagal.');
		}else{
			$this->session->set_flashdata('query_result', 'Terjadi kesalahan pada sistem. Mohon coba kembali.');
		}

		redirect(site_url('/admin/association'));
	}

	public function insert_landing(){
		//Setting file upload configs
		$config['upload_path']          = './public/img/landing/';
        $config['allowed_types']        = 'jpg|png';
        $config['max_size']             = 0;
        $config['max_width']            = 0;
        $config['max_height']           = 0;

        $this->upload->initialize($config);

		//Uploading the file and checking whether or not it succeeded
        if ( ! $this->upload->do_upload('landing'))
        {
                //If failed, display error
				$error = array('error' => $this->upload->display_errors());
				
				//Inform admin about error
                //echo $error['error'];
				$this->session->set_flashdata('query_result', 'Foto tokoh tidak memenuhi syarat.');
				redirect(site_url('/admin/landing'));
        }
        else
        {
				$name = $this->input->post('name');
				$quote = $this->input->post('quote');
				$image = $this->upload->data('file_name');
				
				//Get file path, load model then update entry on database
				$this->load->model('landing_model');
				$query = $this->landing_model->insert_landing($name, $quote, $image);
        }
		
		//Set flashdata to inform admin about query result
		if($query == 'success'){
			$this->session->set_flashdata('query_result', 'Penambahan kutipan baru berhasil.');
		}else if($query == 'failed'){
			$this->session->set_flashdata('query_result', 'Penambahan kutipan baru gagal.');
		}else{
			$this->session->set_flashdata('query_result', 'Terjadi kesalahan pada sistem. Mohon coba kembali.');
		}

		redirect(site_url('/admin/landing'));
	}

	//Update
	public function update_inquiry($id){
		//Set timezone
		date_default_timezone_set('Asia/Jakarta');

		$note = $this->input->post('note');
		$status = $this->input->post('status');

		$this->load->model('inquiry_model');
		$query = $this->inquiry_model->update_inquiry($id, $note, $status, date("Y-m-d H:i:s"));

		//Set flashdata to inform admin about query result
		if($query == 'success'){
			$this->session->set_flashdata('query_result', 'Pembaharuan data permohonan berhasil.');
		}else if($query == 'failed'){
			$this->session->set_flashdata('query_result', 'Pembaharuan data permohonan gagal.');
		}else{
			$this->session->set_flashdata('query_result', 'Terjadi kesalahan pada sistem. Mohon coba kembali.');
		}

		redirect(site_url('/admin/inquiry'));
	}

	public function update_candidate($id){
		//Check whether or not the candidate's association has been changed and if so, whether the amount of candidates for the new association has reached 2
		$this->load->model('candidate_model');
		if($this->candidate_model->fetch_candidate_by_id($id)['0']->himpunan_id != $this->input->post('himpunan_id') && count($this->candidate_model->fetch_candidate($this->input->post('himpunan_id'))) >= 2){
			$this->session->set_flashdata('query_result', 'Anda tidak dapat mendaftarkan lebih dari 2 pasangan calon untuk masing-masing himpunan.');
			redirect(site_url('/admin/candidate'));
		}

		//Initialize variables
		$foto_profil = '0';
		$foto_ballot = '0';

		//Setting file upload configs
		$config['upload_path']          = './public/img/candidates/'.strtolower($this->input->cookie('prodi'));
        $config['allowed_types']        = 'jpg|png';
        $config['max_size']             = 0;
        $config['max_width']            = 0;
        $config['max_height']           = 0;

        $this->upload->initialize($config);

		//Uploading the file and checking whether or not it succeeded
        if ( ! $this->upload->do_upload('foto_profil'))
        {
                //If failed, display error
				$error = array('error' => $this->upload->display_errors());

                echo $error['error'];
        }
        else
        {
				//Get file path
				$foto_profil = $this->upload->data('file_name');
        }

		//Setting file upload configs
		$config['upload_path']          = './public/img/candidates/'.strtolower($this->input->cookie('prodi'));
		$config['allowed_types']        = 'jpg|png';
		$config['max_size']             = 0;
		$config['max_width']            = 0;
		$config['max_height']           = 0;

		$this->upload->initialize($config);

		//Uploading the file and checking whether or not it succeeded
		if ( ! $this->upload->do_upload('foto_ballot'))
		{
				//If failed, display error
				$error = array('error' => $this->upload->display_errors());

				echo $error['error'];
		}
		else
		{	
				$foto_ballot = $this->upload->data('file_name');
		}

		$himpunan_id = $this->input->post('himpunan_id');
		$nomor_urut_pasangan = $this->input->post('nomor_urut_pasangan');
		$calon_ketua = $this->input->post('calon_ketua');
		$calon_wakil_ketua = $this->input->post('calon_wakil_ketua');
		$slogan = $this->input->post('slogan');
		$visi = $this->input->post('visi');
		$misi = $this->input->post('misi');
		$link_instagram = $this->input->post('link_instagram');
		
		//Load model and update entry on database
		$query = $this->candidate_model->update_candidate($id, $himpunan_id, $nomor_urut_pasangan, $calon_ketua, $calon_wakil_ketua, $foto_profil, $foto_ballot, $slogan, $visi, $misi, $link_instagram);
		
		//Set flashdata to inform admin about query result
		if($query == 'success'){
			$this->session->set_flashdata('query_result', 'Perubahan data pasangan calon berhasil.');
		}else if($query == 'failed'){
			$this->session->set_flashdata('query_result', 'Perubahan data pasangan calon gagal.');
		}else{
			$this->session->set_flashdata('query_result', 'Terjadi kesalahan pada sistem. Mohon coba kembali.');
		}

		redirect(site_url('/admin/candidate'));
	}

	public function update_voter($id){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$nama = $this->input->post('nama');
		$nim = $this->input->post('nim');
		$tahun_angkatan = $this->input->post('tahun_angkatan');
		$himpunan_id = $this->input->post('organisasi_mahasiswa');

		$this->load->model('voter_model');
		$query = $this->voter_model->update_voter($id, $username, $password, $nama, $nim, $tahun_angkatan, $himpunan_id);
		
		//Set flashdata to inform admin about query result
		if($query == 'success'){
			$this->session->set_flashdata('query_result', 'Perubahan data pemberi suara berhasil.');
		}else if($query == 'failed'){
			$this->session->set_flashdata('query_result', 'Perubahan data pemberi suara gagal.');
		}else{
			$this->session->set_flashdata('query_result', 'Terjadi kesalahan pada sistem. Mohon coba kembali.');
		}

		redirect(site_url('/admin/voter'));
	}

	public function update_association($id){
		$logo = '0';

		//Setting file upload configs
		$config['upload_path']          = './public/img/association/';
        $config['allowed_types']        = 'jpg|png';
        $config['max_size']             = 0;
        $config['max_width']            = 0;
        $config['max_height']           = 0;

        $this->upload->initialize($config);

		//Uploading the file and checking whether or not it succeeded
        if ( ! $this->upload->do_upload('logo'))
        {
                //If failed, display error
				$error = array('error' => $this->upload->display_errors());

                echo $error['error'];
        }
        else
        {
				$logo = $this->upload->data('file_name');
        }

		$nama = $this->input->post('nama');
		$akronim = $this->input->post('akronim');
		$tanggal_mulai = $this->input->post('tanggal_mulai');
		$tanggal_selesai = $this->input->post('tanggal_selesai');
		$jam_mulai = $this->input->post('jam_mulai');
		$jam_selesai = $this->input->post('jam_selesai');
				
		//Get file path, load model then update entry on database
		$this->load->model('prodi_model');
		$query = $this->prodi_model->update_prodi($id, $akronim, $nama, $logo, $tanggal_mulai, $tanggal_selesai, $jam_mulai, $jam_selesai);
		
		//Set flashdata to inform admin about query result
		if($query == 'success'){
			$this->session->set_flashdata('query_result', 'Perubahan data himpunan berhasil.');
		}else if($query == 'failed'){
			$this->session->set_flashdata('query_result', 'Perubahan data himpunan gagal.');
		}else{
			$this->session->set_flashdata('query_result', 'Terjadi kesalahan pada sistem. Mohon coba kembali.');
		}

		redirect(site_url('/admin/association'));
	}

	public function update_background(){
		//Initialize variables
		$background = '0';

		//Setting file upload configs
		$config['upload_path']          = './public/img/background/';
        $config['allowed_types']        = 'jpg|png';
        $config['max_size']             = 0;
        $config['max_width']            = 0;
        $config['max_height']           = 0;

        $this->upload->initialize($config);

		//Uploading the file and checking whether or not it succeeded
        if ( ! $this->upload->do_upload('background'))
        {
                //If failed, display error
				$error = array('error' => $this->upload->display_errors());

                echo $error['error'];
        }
        else
        {
				//Get file path, load model then update entry on database
				$this->load->model('background_model');
				$query = $this->background_model->update_background($this->upload->data('file_name'));
        }
		
		//Set flashdata to inform admin about query result
		if($query == 'success'){
			$this->session->set_flashdata('query_result', 'Update gambar background berhasil.');
		}else if($query == 'failed'){
			$this->session->set_flashdata('query_result', 'Update gambar background gagal.');
		}else{
			$this->session->set_flashdata('query_result', 'Terjadi kesalahan pada sistem. Mohon coba kembali.');
		}

		redirect(site_url('/admin/background'));
	}

	/*public function update_schedule(){
		$startdate = $this->input->post('startdate');
		$starttime = $this->input->post('starttime');
		$enddate = $this->input->post('enddate');
		$endtime = $this->input->post('endtime');

		$this->load->model('schedule_model');
		$query = $this->schedule_model->insert_schedule($startdate, $enddate, $starttime, $endtime);

		//Set flashdata to inform admin about query result
		if($query == 'success'){
			$this->session->set_flashdata('query_result', 'Perubahan jadwal pemberian suara berhasil.');
		}else if($query == 'failed'){
			$this->session->set_flashdata('query_result', 'Perubahan jadwal pemberian suara gagal.');
		}else{
			$this->session->set_flashdata('query_result', 'Terjadi kesalahan pada sistem. Mohon coba kembali.');
		}

		redirect(site_url('/admin/schedule'));
	}*/
	
	public function update_landing($id){
		//Initialize variables
		$image = '0';

		//Setting file upload configs
		$config['upload_path']          = './public/img/landing/';
        $config['allowed_types']        = 'jpg|png';
        $config['max_size']             = 0;
        $config['max_width']            = 0;
        $config['max_height']           = 0;

        $this->upload->initialize($config);

		//Uploading the file and checking whether or not it succeeded
        if ( ! $this->upload->do_upload('landing'))
        {
                //If failed, display error
				$error = array('error' => $this->upload->display_errors());

                echo $error['error'];
        }
        else
        {
				$image = $this->upload->data('file_name');
        }

		$name = $this->input->post('name');
		$quote = $this->input->post('quote');

		//Get file path, load model then update entry on database
		$this->load->model('landing_model');
		$query = $this->landing_model->update_landing($id, $name, $quote, $image);
		
		//Set flashdata to inform admin about query result
		if($query == 'success'){
			$this->session->set_flashdata('query_result', 'Perubahan data kutipan berhasil.');
		}else if($query == 'failed'){
			$this->session->set_flashdata('query_result', 'Perubahan data kutipan gagal.');
		}else{
			$this->session->set_flashdata('query_result', 'Terjadi kesalahan pada sistem. Mohon coba kembali.');
		}

		redirect(site_url('/admin/landing'));
	}

	//Delete
	public function delete_inquiry($id){
		$this->load->model('inquiry_model');
		$query = $this->inquiry_model->delete_inquiry($id);

		//Set flashdata to inform admin about query result
		if($query == 'success'){
			$this->session->set_flashdata('query_result', 'Penghapusan pesan berhasil.');
		}else if($query == 'failed'){
			$this->session->set_flashdata('query_result', 'Penghapusan pesan gagal.');
		}else{
			$this->session->set_flashdata('query_result', 'Terjadi kesalahan pada sistem. Mohon coba kembali.');
		}

		redirect(site_url('/admin/inquiry'));
	}

	public function delete_candidate($id){
		$this->load->model('candidate_model');
		$query = $this->candidate_model->delete_candidate($id);

		//Set flashdata to inform admin about query result
		if($query == 'success'){
			$this->session->set_flashdata('query_result', 'Penghapusan data pasangan calon berhasil.');
		}else if($query == 'failed'){
			$this->session->set_flashdata('query_result', 'Penghapusan data pasangan calon gagal.');
		}else{
			$this->session->set_flashdata('query_result', 'Terjadi kesalahan pada sistem. Mohon coba kembali.');
		}

		redirect(site_url('/admin/candidate'));
	}

	public function delete_voter($id){
		$this->load->model('voter_model');
		$query = $this->voter_model->delete_voter($id);
		
		//Set flashdata to inform admin about query result
		if($query == 'success'){
			$this->session->set_flashdata('query_result', 'Penghapusan data pemberi suara berhasil.');
		}else if($query == 'failed'){
			$this->session->set_flashdata('query_result', 'Penghapusan data pemberi suara gagal.');
		}else{
			$this->session->set_flashdata('query_result', 'Terjadi kesalahan pada sistem. Mohon coba kembali.');
		}

		redirect(site_url('/admin/voter'));
	}

	public function delete_association($id){
		$this->load->model('prodi_model');
		$query = $this->prodi_model->delete_prodi($id);
		
		//Set flashdata to inform admin about query result
		if($query == 'success'){
			$this->session->set_flashdata('query_result', 'Penghapusan data himpunan berhasil.');
		}else if($query == 'failed'){
			$this->session->set_flashdata('query_result', 'Penghapusan data himpunan gagal.');
		}else{
			$this->session->set_flashdata('query_result', 'Terjadi kesalahan pada sistem. Mohon coba kembali.');
		}

		redirect(site_url('/admin/association'));
	}

	public function delete_landing($id){
		$this->load->model('landing_model');
		$query = $this->landing_model->delete_landing($id);
		
		//Set flashdata to inform admin about query result
		if($query == 'success'){
			$this->session->set_flashdata('query_result', 'Penghapusan kutipan halaman awal berhasil.');
		}else if($query == 'failed'){
			$this->session->set_flashdata('query_result', 'Penghapusan kutipan halaman awal gagal.');
		}else{
			$this->session->set_flashdata('query_result', 'Terjadi kesalahan pada sistem. Mohon coba kembali.');
		}

		redirect(site_url('/admin/landing'));
	}

	public function delete_voting_session(){
		$this->load->model('candidate_model');
		$query1 = $this->candidate_model->delete_candidate($id);

		$this->load->model('schedule_model');
		$query2 = $this->schedule_model->delete_schedule();

		$this->load->model('vote_model');
		$query3 = $this->vote_model->delete_all_vote();

		//Set flashdata to inform admin about query result
		if($query1 == 'success' && $query2 == 'success' && $query3 == 'success'){
			$this->session->set_flashdata('query_result', 'Penghapusan data pemilu berhasil.');
		}else{
			$this->session->set_flashdata('query_result', 'Penghapusan data pemilu gagal. Mohon coba kembali.');
		}

		redirect(site_url('/admin/schedule'));
	}
}
?>
