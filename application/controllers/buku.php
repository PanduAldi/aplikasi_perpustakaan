<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Buku extends CI_Controller {

	var $table = "t_buku";
	var $pk    = "kd_buku";

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('pagination','form_validation', 'upload'));
		$this->load->model('m_crud');
		$this->cekLogin();
	}

	public function index($offset=null)
	{
		$data['title'] = "Data Buku";
		$limit = 5;
		$data['buku'] = $this->m_crud->get_all($this->table, $limit, $offset)->result();

		// Pagination
		$config['base_url'] = site_url('buku/index/');
		$config['total_rows'] = $this->m_crud->count($this->table);
		$config['per_page'] = $limit;
		$config['uri_segment'] = 3;
		$config['num_links'] = 3;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = '&gt;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '&lt;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		
		$this->pagination->initialize($config);
		$data['paging'] = $this->pagination->create_links();


		//get data
		$this->template->display('buku/index', $data);

	}


	public function tambah()
	{
		$data['title'] = "Tambah Buku";
		$this->cekValidasi();

		if ($this->form_validation->run() == true)
		{
			//upload
			$config['upload_path'] = './assets/img/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']  = '2000';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';
			
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('cover')){
				$cover = "";
			}
			else{
				$cover = $_FILES['cover']['name'];
			}

			$record = array(
							 'kd_buku' => $this->input->post('kd_buku'),
							 'judul' => $this->input->post('judul'),
							 'penerbit' => $this->input->post('penerbit'),
							 'pengarang' => $this->input->post('pengarang'),
							 'deskripsi' => $this->input->post('deskripsi'),
							 'cover' => $cover,
							 'status' => 'y'
						   );

			$this->m_crud->insertData($this->table, $record);
			$this->session->set_flashdata('add_success', '<div class="alert alert-success" data-animate=""> Add Success</div>');
			redirect('buku');
		}

		$data['autonumber'] = $this->m_crud->autoNumber($this->table, $this->pk, 2, 'BUK');
		$this->template->display('buku/tambah', $data);

	}

	public function edit()
	{
		$data['title'] = "Edit";
		$id = $this->uri->segment(3);
		$this->cekValidasi();
		
		//get id
		$get_id = $this->m_crud->get_id($this->table, $this->pk, $id);

		if ($this->form_validation->run()==true)
		{
			//upload
			$config['upload_path'] = './assets/img/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']  = '100';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';
			
			$this->upload->initialize($config);
			if ( ! $this->upload->do_upload('cover')){
				$record = array(
								 'judul' => $this->input->post('judul'),
								 'penerbit' => $this->input->post('penerbit'),
								 'pengarang' => $this->input->post('pengarang'),
								 'deskripsi' => $this->input->post('deskripsi')
							   );
			}
			else{
				$cover = $_FILES['cover']['name'];
				$record = array(
								 'judul' => $this->input->post('judul'),
								 'penerbit' => $this->input->post('penerbit'),
								 'pengarang' => $this->input->post('pengarang'),
								 'deskripsi' => $this->input->post('deskripsi'),
								 'cover' => $cover							 
							   );
			
				$cover_id = $get_id->row_array();
				unlink("assets/img/".$cover_id['cover']);
			}

				$this->m_crud->updateData($this->table, $record, $this->pk, $id);
				$this->session->set_flashdata('update_success', '<div class="alert alert-warning"> Data Berhasil di update</div>');
				redirect('buku');
		}

			$data['buku'] = $get_id->result();
			$this->template->display('buku/edit', $data);
	}

	public function hapus()
	{
		$id_hapus = $this->input->post('id_hapus');
		$this->session->set_flashdata('delete_success', '<div class="alert alert-danger">Delete Data Success</div>');

		$id = $this->m_crud->get_id($this->table, $this->pk, $id_hapus)->row_array();
		unlink('assets/img/'.$id['cover']);

		$this->m_crud->deleteData($this->table, $this->pk, $id_hapus);
	}

	public function cariData()
	{
		$data['title'] = "Filter Data Buku";
		//set value
		$input = $this->input->post('cari');
		$this->db->like('kd_buku', $input);
		$this->db->or_like('judul', $input);
		$query = $this->db->get($this->table);

			$cek_data = $query->num_rows();

		if ($cek_data > 0)
		{
			$data['buku'] = $query->result();
			$this->template->display('buku/cari', $data);
			$this->session->set_flashdata('filter_success', '<div class="alert alert-success">Pencarian Sukses</div>');
		} 
		else {
			$data['message'] = '<div class="alert alert-danger">OOPs ... Data yang anda Cari Tidak ada</div>';
			$this->template->display('buku/tidakada', $data);
		}

	}

	public function cekValidasi()
	{
		$this->form_validation->set_rules('judul', 'Judul', 'required');
		$this->form_validation->set_rules('penerbit', 'Penerbit', 'required');
		$this->form_validation->set_rules('pengarang', 'Pengarang', 'required');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
		$this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
	}

	public function cekLogin()
	{
		if ($this->session->userdata('islogin')==false)
			redirect('login','refresh');
	}

}

/* End of file  */
/* Location: ./application/controllers/ */