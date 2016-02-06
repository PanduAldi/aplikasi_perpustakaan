<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_laporan extends CI_Model {

	// Get report peminjaman
	public function get_peminjaman($tgl1, $tgl2)
	{
		$this->db->where('tgl_pinjam >=', $tgl1);
		$this->db->where('tgl_pinjam <=', $tgl2);
		return $this->db->get('t_peminjaman');
	}

	//Get report pengembalian
	public function get_pengembalian($tgl1, $tgl2)
	{
		$this->db->select('t_pengembalian.*, t_peminjaman.tgl_pinjam, t_peminjaman.id_anggota');
		$this->db->from('t_pengembalian');
		$this->db->join('t_peminjaman', 't_peminjaman.kd_peminjaman = t_pengembalian.kd_peminjaman');
		$this->db->where('t_pengembalian.tgl_kembali >=', $tgl1);
		$this->db->where('t_pengembalian.tgl_kembali <=', $tgl2);
		return $this->db->get();
	}

	//get report anggota
	public function get_anggota($tgl1, $tgl2)
	{
		$this->db->where('tgl_daftar >=', $tgl1);
		$this->db->where('tgl_daftar <=', $tgl2);
		return $this->db->get('t_anggota');
	}

	//get report buku
	public function get_buku($tgl1, $tgl2)
	{
		$this->db->where('tgl_masuk >=', $tgl1);
		$this->db->where('tgl_masuk <=', $tgl2);

		return $this->db->get('t_buku');
	}

	// tampil detail anggota
	public function detail_anggota($id)
	{
		$this->db->where('id_anggota', $id);
		return $this->db->get('t_anggota');
	}

	public function detail_buku($id)
	{
		$this->db->where('kd_buku', $id);
		return $this->db->get('t_buku');
	}

}

/* End of file m_transaksi.php */
/* Location: ./application/models/m_transaksi.php */