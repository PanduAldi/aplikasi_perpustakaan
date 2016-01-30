<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_crud extends CI_Model {

	public function get_all($table, $limit, $offset)
	{
		return $this->db->get($table, $limit, $offset);
	}

	public function get_id($table, $pk, $id)
	{
		$this->db->where($pk, $id);
		return $this->db->get($table);
	}

	public function count($table)
	{
		return $this->db->count_all($table);
	}

	public function insertData($table, $record)
	{
		$this->db->insert($table, $record);
	}

	public function updateData($table, $record, $pk, $id)
	{
		$this->db->where($pk, $id);
		$this->db->update($table, $record);
	}

	public function deleteData($table, $pk, $id)
	{
		$this->db->where($pk, $id);
		$this->db->delete($table);
	}

	public function login($table, $username, $password)
	{
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		return $this->db->get($table);
	}

	public function cekPassword($table, $username)
	{
		$this->db->where('username', $username);
		return $this->db->get($table);
	}

	public function get_temp()
	{
		return $this->db->get('temp')->result();
	}

	public function hapus_temp()
	{
		$this->db->empty_table('temp');
	}

	public function autoNumber($table, $kolom, $lebar=0, $awalan=null)
	{
		$this->db->select($kolom);
		$this->db->limit(1);
		$this->db->order_by($kolom, 'desc');
		$this->db->from($table);
		$query = $this->db->get();

		$row = $query->result_array();
		$cek = $query->num_rows();

		if ($cek == 0)
			$nomor = 1;
		else
		{
			$nomor = intval(substr($row[0][$kolom], strlen($awalan)))+1;
		}

			if ($lebar > 0)
			{
				$result = $awalan.str_pad($nomor, $lebar, "0", STR_PAD_LEFT);
			}
			else
			{
				$result = $awalan.$nomor;
			}

			return $result;
	}

	// cari data peminjam untuk pengembalian buku
	public function data_peminjam($id)
	{
		$this->db->select('t_peminjaman.*, t_anggota.nama, t_buku.judul, t_buku.pengarang');
		$this->db->from('t_peminjaman');
		$this->db->join('t_anggota', 't_anggota.id_anggota = t_peminjaman.id_anggota');
		$this->db->join('t_buku', 't_buku.kd_buku = t_peminjaman.kd_buku');
		$this->db->where('t_peminjaman.status', 'n');
		$this->db->where('t_peminjaman.id_anggota', $id);
		return $this->db->get();
	}


}

/* End of file m_crud.php */
/* Location: ./application/models/m_crud.php */