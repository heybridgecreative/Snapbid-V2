<?php
class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
		$this->aauth->control('viewAdmin');
    }

    function index()
    {
        if(!$this->aauth->is_loggedin()){
			redirect('admin/login');
		} else {
				$this->load->view('admin/common/head');
				$this->load->view('admin/common/nav');
				$this->load->view('admin/dashboard');

    	}    
	}
}
?>