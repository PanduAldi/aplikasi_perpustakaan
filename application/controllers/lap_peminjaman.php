<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  
  class Lap_peminjaman extends CI_Controller {
  
  	public function __construct()
  	{
  		parent::__construct();
  		$this->load->model('m_laporan');
     
      if ($this->session->userdata("islogin") == false) {
         redirect('login','refresh');
      }
  	}

  	public function index()
  	{
  		$data['title'] = "Laporan Peminjaman";
  		$this->template->display('laporan/peminjaman', $data);
  	}

  	public function get_report()
  	{
      $tgl1 = $this->input->post('tgl1');
      $tgl2 = $this->input->post('tgl2');

  		//show table
  		$cek = $this->m_laporan->get_peminjaman($tgl1, $tgl2);

  		if ($cek->num_rows() == 0) 
  		{
  			echo "";
  		}
  		else
  		{
  			$data['tampil_data'] = $cek->result();
  			$this->load->view('laporan/tampil_peminjaman', $data); 
  		}
  	}

    public function det_anggota()
    {
        $id = $this->input->post('id_anggota');

        //show detail anggota
        $cek = $this->m_laporan->detail_anggota($id)->row();

        echo $cek->nim."|".$cek->nama."|".$cek->alamat;

    }

    public function det_buku()
    {
        $id = $this->input->post('kd_buku');

        $cek = $this->m_laporan->detail_buku($id)->row();

        echo $cek->judul."|".$cek->penerbit."|".$cek->pengarang;
    }

  
  }
  
  /* End of file lap_anggota.php */
  /* Location: ./application/controllers/lap_anggota.php */  