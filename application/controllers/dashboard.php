<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->cekLogin();
	}

	public function index()
	{
		$data['title'] = "Dashboard";
		$this->template->display('dashboard', $data);
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login','refresh');
	}

	public function cekLogin()
	{
		if ($this->session->userdata('islogin')==false)
			redirect('login','refresh');
	}

	public function gantiPassword()
	{
		$data['title'] = "Ganti Password";
		$this->load->library('form_validation');
		$this->form_validation->set_rules('old', 'Old Password', 'required');
		$this->form_validation->set_rules('new', 'New Password', 'required|matches[conf]');
		$this->form_validation->set_rules('conf', 'Password Confirmation', 'required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" data-animate="fadeInLeft">','</div>');

		if ($this->form_validation->run()==true)
		{
			$this->load->model('m_crud');
			$cek = $this->m_crud->cekPassword('t_user', $this->session->userdata('username'));

			if ($cek->num_rows() > 0)
			{
				$old = md5($this->input->post('old'));
				$pass = $cek->row_array();

				if ($old == $pass['password'])
				{
					$this->db->where( 'id_user', $pass['id_user']);
					$this->db->update('t_user', array('password'=>md5($this->input->post('new'))));
					$this->session->set_flashdata('success', '<div class="alert alert-success">Password berhasil di update</div>');
					redirect('dashboard/gantiPassword','refresh');
				}
				else
				{
					$this->session->set_flashdata('gagal', '<div class="alert alert-danger">Password lama anda salah. Coba kembali..</div>');
					redirect('dashboard/gantiPassword');
				}

			}
		}

		$this->template->display('ganti_password', $data);
	}

}

/* End of file  */
/* Location: ./application/controllers/ */