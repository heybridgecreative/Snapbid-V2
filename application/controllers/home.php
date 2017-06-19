<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
    
		/* Helpers */
        $this->load->helper('url'); 
        $this->load->helper('date');
        
        /* Data */
        $data['title'] = "SnapBid Expedia Search";
        $data['pageClass'] = "search";
    
        /* Templating */
        $this->load->view('common/head', $data);
        $this->load->view('home');
	}
}
