<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template
{
	protected $_CI;

	public function __construct()
	{
        $this->_CI =& get_instance();
	}

	public function display($template, $data=null)
	{
		$data['_header'] = $this->_CI->load->view('header', $data, true);
		$data['_content'] = $this->_CI->load->view($template, $data, true);
		$this->_CI->load->view('/template.php', $data);
	}	

}

/* End of file libraryName.php */
/* Location: ./application/libraries/libraryName.php */
