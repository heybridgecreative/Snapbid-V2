<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends CI_Controller {

	public function index()
	{

		/* Plugins */   
		$this->load->helper('geo_location'); 

		/* Helpers */
        $this->load->helper('url'); 
        $this->load->helper('date');
        
        /* Data */
        $data['title'] = "SnapBid";
        $data['pageClass'] = "home";

		/* Output */
		$ip = $this->input->ip_address();

        /* Templating */
        $this->load->view('common/head', $data);
        $this->load->view('common/header');
        $this->load->view('common/banner');
        $this->load->view('common/searchbar');
        $this->load->view('homepage');
		$this->load->view('common/extras');
        $this->load->view('common/whymail');
        $this->load->view('common/footer');
	}
}
