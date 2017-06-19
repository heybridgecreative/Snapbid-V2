<?php
class Pages extends CI_Controller {
	public function view($page = 'home')
	{
		if ( ! file_exists('application/views/'.$page.'.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}
		$data['title'] = ucfirst(str_replace("-", " ", $page)); // Capitalize the first letter
		$data['title'] .= " - Snapbid";
		
		$this->load->helper('date');
		
		$this->load->view('common/head', $data);
		$this->load->view('common/header');
		$this->load->view('common/searchbar');
		$this->load->view($page, $data);
		$this->load->view('common/whymail');
		$this->load->view('common/footer');
	}
}
?>