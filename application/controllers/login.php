<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	var $table = "t_user";
	var $pk = "id_user";

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('m_crud');

		//cek login
		if ($this->session->userdata('islogin')==true)
			redirect('dashboard','refresh');
	}

	public function index()
	{
		$data['title'] = "Panel Login";
		//set rule validate
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_error_delimiters('<div class="text-danger" data-animate="fadeInLeft">', '</div>');
		$this->form_validation->set_message('required', ' tidak boleh kosong');

		if ($this->form_validation->run()==true)
		{
			$username  = $this->input->post('username');
			$password  = md5($this->input->post('password'));
			//cek login
			$cek  = $this->m_crud->login($this->table, $username, $password);

			if($cek->num_rows() > 0)
			{
				//get data
				$get = $cek->row_array();

				$this->session->set_userdata('islogin', true);
				$this->session->set_userdata('username', $username);
				$this->session->set_userdata('level', $get['level']);
				$this->session->set_userdata('nama', $get['nama']);

					redirect('dashboard');
			}
			else
			{
				$this->session->set_flashdata('login_fail', '<div class="alert alert-danger">Username atau Password Anda Salah</div>');
				redirect('login','refresh');
			}
		}

		$this->template->display('login', $data);
	}

}

/* End of file  */
/* Location: ./application/controllers/ */