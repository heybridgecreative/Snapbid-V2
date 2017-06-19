<?php
class CustomerService extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
		$load['sidebar'] = $this->load->view('customerservice/common/sidebar', NULL, TRUE);

		$this->load->view('common/head');
		$this->load->view('common/header');
		$this->load->view('common/searchbar');
        $this->load->view('customerservice/index', $load);
		$this->load->view('common/whymail');
		$this->load->view('common/footer');
    }

    function faqs()
    {
		$load['sidebar'] = $this->load->view('customerservice/common/sidebar', NULL, TRUE);
		
		$this->load->view('common/head');
		$this->load->view('common/header');
		$this->load->view('common/searchbar');
        $this->load->view('customerservice/faqs', $load);
		$this->load->view('common/whymail');
		$this->load->view('common/footer');
    }

    function terms()
    {
		$load['sidebar'] = $this->load->view('customerservice/common/sidebar', NULL, TRUE);
		
		$this->load->view('common/head');
		$this->load->view('common/header');
		$this->load->view('common/searchbar');
        $this->load->view('customerservice/terms', $load);
		$this->load->view('common/whymail');
		$this->load->view('common/footer');
    }

    function how()
    {
		$load['sidebar'] = $this->load->view('customerservice/common/sidebar', NULL, TRUE);
		
		$this->load->view('common/head');
		$this->load->view('common/header');
		$this->load->view('common/searchbar');
        $this->load->view('customerservice/how', $load);
		$this->load->view('common/whymail');
		$this->load->view('common/footer');
    }

    function joining()
    {
		$load['sidebar'] = $this->load->view('customerservice/common/sidebar', NULL, TRUE);
		
		$this->load->view('common/head');
		$this->load->view('common/header');
		$this->load->view('common/searchbar');
        $this->load->view('customerservice/joining', $load);
		$this->load->view('common/whymail');
		$this->load->view('common/footer');
    }

    function privacy()
    {
		$load['sidebar'] = $this->load->view('customerservice/common/sidebar', NULL, TRUE);
		
		$this->load->view('common/head');
		$this->load->view('common/header');
		$this->load->view('common/searchbar');
        $this->load->view('customerservice/privacy', $load);
		$this->load->view('common/whymail');
		$this->load->view('common/footer');
    }

    function recruit()
    {
		$load['sidebar'] = $this->load->view('customerservice/common/sidebar', NULL, TRUE);
		
		$this->load->view('common/head');
		$this->load->view('common/header');
		$this->load->view('common/searchbar');
        $this->load->view('customerservice/recruit', $load);
		$this->load->view('common/whymail');
		$this->load->view('common/footer');
    }

    function help()
    {
		$load['sidebar'] = $this->load->view('customerservice/common/sidebar', NULL, TRUE);
		
		$this->load->view('common/head');
		$this->load->view('common/header');
		$this->load->view('common/searchbar');
        $this->load->view('customerservice/help', $load);
		$this->load->view('common/whymail');
		$this->load->view('common/footer');
    }
}
?>