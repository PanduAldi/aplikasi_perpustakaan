<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengembalian extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('m_crud');

		//akses validasi
		if ($this->session->userdata('islogin') == false) 
			redirect('login','refresh');
	}

	public function index()
	{
		$data['title'] = "Data Pengembalian";

		$this->template->display('transaksi/pengembalian', $data);
	}

	public function simpan()
	{
		$primary = $this->input->post('kd_peminjaman');
		$kd_buku = $this->input->post('kd_buku');

		// insert to t_pngembalian
		$record = array(
							'kd_peminjaman' => $primary,
							'kd_buku' => $kd_buku,
							'tgl_kembali' => $this->input->post('tgl_kembali'),
							'denda' => $this->input->post('denda'),
							'petugas' => $this->input->post('petugas')
						);	
		$this->m_crud->insertData('t_pengembalian', $record);
	
		//update buku
		$this->m_crud->updateData('t_buku', array('status' => 'y'), 'kd_buku', $kd_buku);

		//update status peminjaman
		$this->m_crud->updateData('t_peminjaman', array('status' => 'y'), 'kd_buku', $kd_buku);
	}

	public function cariData()
	{
		$id = $this->input->post('id_anggota');
		$cek = $this->m_crud->data_peminjam($id);
		if ($cek->num_rows() == 0) 
		{
			echo "";
		}
		else
		{
			$data['bio'] = $cek->row();
			$data['cekdata'] = $cek->result();
			$data['tanggal'] = date("d M Y");
			$this->load->view('transaksi/caridata', $data);
		}

	}

}

/* End of file pengembalian.php */
/* Location: ./application/controllers/pengembalian.php */