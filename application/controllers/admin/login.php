<?php
class Login extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
		if($this->aauth->is_loggedin()){
			redirect('admin/dashboard');
		} else {
        	$this->load->view('admin/login');
    	}
	}
}
?>