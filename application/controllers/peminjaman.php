<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman extends CI_Controller {

	var $table = "t_peminjaman";
	var $pk = "kd_peminjaman";

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('m_crud');
		$this->cekLogin();
	}

	public function index($limit=null, $offset=null)
	{
		$data['title'] = "Transaksi Peminjaman";
		$data['kd_peminjaman'] = $this->m_crud->autoNumber($this->table, $this->pk, 3, date('Ymd'));
		$data['tanggal_sekarang'] = date('Y-m-d');
		$data['tanggal_tempo'] = strtotime('+7 day', strtotime($data['tanggal_sekarang']));
		$data['tanggal_tempo'] = date('Y-m-d', $data['tanggal_tempo']);
		$data['anggota'] = $this->m_crud->get_all('t_anggota', $limit, $offset)->result();

		$this->template->display('transaksi/peminjaman', $data);
	}

	public function simpan()
	{
		$datatemp = $this->m_crud->get_temp();

		foreach ($datatemp AS $dat)
		{
			$record = array(
								'kd_peminjaman' => $this->input->post('kd_peminjaman'),
								'id_anggota' => $this->input->post('id_anggota'),
								'kd_buku' => $dat->kd_buku,
								'tgl_pinjam' => $this->input->post('tgl_pinjam'),
								'tgl_kembali' => $this->input->post('tgl_kembali'),
								'status' => 'n'
							);
		
			$this->m_crud->insertData($this->table, $record);
			$this->m_crud->updateData('t_buku', array('status' => 'n'), 'kd_buku', $dat->kd_buku);
			$this->m_crud->hapus_temp();
		}

		$this->session->set_flashdata('sukses', '<script>swal("Sukses !!", "Peminjaman berhasil disimpan", "success");</script>');
		redirect('peminjaman','refresh');
	}

	public function cariAnggota()
	{
		$id = $this->input->post('id_anggota');	

		$cari = $this->m_crud->get_id('t_anggota', 'id_anggota', $id)->row();

		echo $cari->nama;
	}


	public function cariBuku()
	{
		$kd_buku = $this->input->post('kd_buku');

		$buku = $this->m_crud->get_id('t_buku', 'kd_buku', $kd_buku)->row();

		echo $buku->judul."|".$buku->pengarang;

	}

	public function tampilBuku()
	{
		$data['tampil_buku'] = $this->m_crud->get_all('temp', null, null)->result();

		$this->load->view('transaksi/tampilbuku', $data);
	}

	public function tambahBuku()
	{
		$record  = array(
							'kd_buku' => $this->input->post('kd_buku'),
							'judul' => $this->input->post('judul'),
							'pengarang' => $this->input->post('pengarang')
						);

		$this->m_crud->insertData('temp', $record);
	}

	public function hapusBuku()
	{
		$id = $this->input->post('hapusid');

		$this->m_crud->deleteData('temp', 'kd_buku', $id);
	}

	public function cekLogin()
	{
		if ($this->session->userdata('islogin')==false)
			redirect('login','refresh');
	}

}

/* End of file peminjaman.php */
/* Location: ./application/controllers/peminjaman.php */