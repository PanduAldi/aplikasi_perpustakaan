<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lap_buku extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_laporan');
	}

	public function index()
	{
		$data['title'] = "Laporan Buku";
		$this->template->display('laporan/buku', $data);
	}

	public function get_report()
	{
		$tgl1 = $this->input->post('tgl1');
		$tgl2 = $this->input->post('tgl2');

		$cek = $this->m_laporan->get_buku($tgl1, $tgl2);

		if ($cek->num_rows() == 0)
		{
			echo "";
		}
		else
		{
			$data['tampil_data'] = $cek->result();
			$this->load->view('laporan/tampil_buku', $data);
		}
	}
}

/* End of file lap_buku.php */
/* Location: ./application/controllers/lap_buku.php */