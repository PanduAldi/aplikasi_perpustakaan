<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota extends CI_Controller {

	var $table = "t_anggota";
	var $pk = "id_anggota";

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation', 'upload', 'pagination'));
		$this->load->model('m_crud');
		$this->cekLogin();
	}

	public function index($offset=null)
	{
		$data['title'] = "Data Anggota";
		$limit = 4;
		$data['anggota'] = $this->m_crud->get_all($this->table, $limit, $offset)->result();

		//pagination
		$config['base_url'] = site_url('anggota/index/');
		$config['total_rows'] = $this->m_crud->count($this->table);
		$config['per_page'] = $limit;
		$config['uri_segment'] = 3;
		$config['num_links'] = 3;
		$config['full_tag_open'] = '<ul class="pagination pagination-sm">';
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

		#display 
		$this->template->display('anggota/index', $data);
	}

	public function tambah()
	{
		$data['title'] = "Tambah Anggota";
		$this->cekValidasi();

		if ($this->form_validation->run()==true) 
		{
			//upload
			$config['upload_path'] = './assets/img/anggota/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']  = '2000';
				$config['max_width']  = '1024';
				$config['max_height']  = '768';
				
				$this->upload->initialize($config);
				if ( ! $this->upload->do_upload('foto')){
					$foto = "";
				}
				else{
					$foto = $_FILES['foto']['name'];
				}

				$record = array(
								 'id_anggota' => $this->input->post('id_anggota'),
								 'nim' => $this->input->post('nim'),
								 'nama' => $this->input->post('nama'),
								 'alamat' => $this->input->post('alamat'),
								 'tgl_daftar' => date("Y-m-d"),
								 'foto' => $foto
							   );	

				$this->m_crud->insertData($this->table, $record);
				$this->session->set_flashdata('add_success', '<div class="alert alert-success">Data berhasil di input</div>');
				redirect('anggota','refresh');
		}

		$data['autonumber'] = $this->m_crud->autoNumber($this->table, $this->pk, 3, date("Ymd"));
		$this->template->display('anggota/tambah', $data);
	}

	public function edit()
	{
		$data['title'] = "Edit Anggota";
		$id = $this->uri->segment(3);
		$query = $this->m_crud->get_id($this->table, $this->pk, $id);

		$this->cekValidasi();
		if ($this->form_validation->run()==true)
		{
			//upload
			$config['upload_path'] = './assets/img/anggota/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']  = '2000';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';

			$this->upload->initialize($config);
			if ( ! $this->upload->do_upload('foto')){
				$record = array(
								 'nim' => $this->input->post('nim'),
								 'nama' => $this->input->post('nama'),
								 'alamat' => $this->input->post('alamat')
					       	   );


			}
			else{
				$foto = $_FILES['foto']['name'];
				$record = array(
								 'nim' => $this->input->post('nim'),
								 'nama' => $this->input->post('nama'),
								 'alamat' => $this->input->post('alamat'),
								 'foto' => $foto
								);

				$unlink_id = $query->row_array();
				unlink('./assets/img/anggota/'.$unlink_id['foto']);
			}

			$this->m_crud->updateData($this->table, $record, $this->pk, $id);
			$this->session->set_flashdata('update_success','<div class="alert alert-waring"> Update anggota berhasil</div>');
			redirect('anggota');
		}

		$data['anggota'] = $query->result();
		$this->template->display('anggota/edit', $data);

	}

	public function hapus()
	{
		$id = $this->input->post('id_hapus');
		$detail = $this->m_crud->get_id($this->table, $this->pk, $id)->row_array();
		unlink("assets/img/anggota/".$detail['foto']);

		$this->m_crud->deleteData($this->table, $this->pk, $id);
		$this->session->set_flashdata('delete_success', '<div class="alert alert-danger">Data berhasil dihapus</div>');
	}

	public function cekValidasi()
	{
		$this->form_validation->set_rules('nim', 'Nim', 'required');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');		
	}

	public function cari()
	{
		$data['title'] = "Cari Anggota";
		$id = $this->input->post('cari');
		$this->db->like('nim', $id);
		$this->db->or_like('nama', $id);
		$query = $this->db->get($table);

		if ($query->num_rows() > 0) 
		{
			$data['anggota'] = $query->result();
			$this->template->display('anggota/cari', $data);
		}
		else
		{
			$data['message'] = '<div class="alert alert-info">Ooops!! keyword yang anda masukan tidak ada dalam database, Silahka mencoba kembali.</div>';
 			$this->template->display('anggota/tidakada', $data);
 		}
	}

	public function cekLogin()
	{
		if ($this->session->userdata('islogin') == false)
			redirect('login','refresh');
	}
}

/* End of file anggota.php */
/* Location: ./application/controllers/anggota.php */