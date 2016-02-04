<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lap_anggota extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_laporan');
		//cek login
		if ($this->session->userdata('islogin') == false)
			redirect('login','refresh');
	}

	public function index()
	{
		$data['title'] = "Laporan Anggota";
		$this->template->display('laporan/anggota', $data);
	}

	public function get_report()
	{
		$ex1 = explode("/", $this->input->post('tgl1'));
		$ex2 = explode("/", $this->input->post('tgl2'));

		$tgl1 = $ex1[2]."-".$ex1[0]."-".$ex1[1];
		$tgl2 = $ex2[2]."-".$ex2[0]."-".$ex2[1];
	
		$cek = $this->m_laporan->get_anggota($tgl1, $tgl2);

		//cek datanyal 
		if ($cek->num_rows == 0) 
		{
			echo "";
		}
		else
		{
			$data['tampil_data'] = $cek->result();
			$this->load->view('laporan/tampil_anggota', $data);
		}
		
	}

}

/* End of file lap_anggota.php */
/* Location: ./application/controllers/lap_anggota.php */