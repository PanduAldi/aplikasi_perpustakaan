<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Petugas extends CI_Controller {

	var $table = 't_user';
	var $pk = 'id_user';

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('m_crud');
		$this->cekLogin();
	}

	public function index($limit=null, $offset=null)
	{
		$data['title'] = "Data Petugas";
		$data['petugas'] = $this->m_crud->get_all($this->table, $limit, $offset)->result();
		$this->template->display('petugas/index', $data);
	}

	public function tambah()
	{
		$data['title'] = 'Tambah Petugas';
		$this->cekValidasi();

		if ($this->form_validation->run()==true)
		{
			$record = array(
							  'id_user' => '',
							  'nama' => $this->input->post('nama'),
							  'username' => $this->input->post('username'),
							  'password' => md5($this->input->post('password')),
							  'level' => $this->input->post('level')
						   );

			$this->m_crud->insertData($this->table, $record);
			$this->session->set_flashdata('add_success', '<div class="alert alert-success">Data sukses ditambahkan</div>');
			redirect('petugas','refresh');
		}

		$this->template->display('petugas/tambah', $data);
	}

	public function edit()
	{
		$data['title'] = "Edit Petugas";
		$id = $this->uri->segment(3);
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('level', 'Level', 'required');

		if ($this->form_validation->run() == true)
		{
			$record = array(
					'nama' => $this->input->post('nama'),
					'username' => $this->input->post('username'),
					'level' => $this->input->post('level')
				);

			$this->session->set_flashdata('update_success', '<div class="alert alert-info">Data berhasil di update</div>');
			$this->m_crud->updateData($this->table, $record, $this->pk, $id);
			redirect('petugas','refresh');
		}

		$data['petugas'] = $this->m_crud->get_id($this->table, $this->pk, $id)->result();
		$this->template->display('petugas/edit', $data);
	}

	public function hapus()
	{
		$id = $this->input->post('id_hapus');
		$this->session->set_flashdata('delete_success', '<div class="alert alert-danger">Data terhapus</div>');
		$this->m_crud->deleteData($this->table, $this->pk, $id);
	}

	public function cekValidasi()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('level', 'Level', 'required');
	}

	public function resetPassword()
	{
		$id = $this->input->post('id_reset');
		$pass = md5($this->input->post('pass'));
		$this->m_crud->updateData($this->table, array('password'=>$pass), $this->pk, $id);
		$this->session->set_flashdata('reset_success','<div class="alert alert-success">Reset Password success. Password default anda sama dengan username.</div>');
	}

	public function cekLogin()
	{
		if ($this->session->userdata('islogin')==false)
			redirect('login','refresh');
	}
}

/* End of file  */
/* Location: ./application/controllers/ */