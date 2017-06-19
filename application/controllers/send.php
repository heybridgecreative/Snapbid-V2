<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class send extends CI_Controller {

	public function index()
	{
		/* Helpers */
        $this->load->helper('xml');
        $this->load->helper('url'); 
        $this->load->helper('date');
        
        /* Libraries */
        $this->load->library('session');
                
        $sessionData = $this->session->userdata('searchparams');
		print_r($sessionData);
		$data['sessionData'] = $sessionData;
		$data['location'] = $sessionData['location'];
		$data['datefrom'] = $sessionData['datef'];
		$data['dateto'] = $sessionData['datet'];

        /* Data */
        $header['title'] = "SnapBid - Send a Bid";
                    
        /* Templating */
        $header['pageClass'] = "result";
        $this->load->view('common/head', $header);
        $this->load->view('common/header', $header);
        $this->load->view('send', $data);
        $this->load->view('common/whymail');
        $this->load->view('common/footer');
	}  
}