<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

	public function manage()
	{
		if(!$this->aauth->is_loggedin()){
			redirect('/');
		}

		if($this->input->post()){
			$name = $this->input->post('firstname');
			$name .= " ";
			$name .= $this->input->post('lastname');
			$this->aauth->set_user_var("name",$name);
		}

        /* Data */
        $data['title'] = "SnapBid Account Management";
        $data['pageClass'] = "manage";

		$this->load->view('common/head', $data);
		$this->load->view('common/header');
		$this->load->view('account/manage');
		$this->load->view('common/whymail');
		$this->load->view('common/footer');
		
	}

	public function dashboard()
	{
		if(!$this->aauth->is_loggedin()){
			redirect('/');
		}

		if($this->input->post()){
			$name = $this->input->post('firstname');
			$name .= " ";
			$name .= $this->input->post('lastname');
			$this->aauth->set_user_var("name",$name);
		}

		$userID = $this->aauth->get_user_id();
		$output['searches'] = $this->db->query("SELECT * FROM snapbid_searches where userID = $userID ORDER BY dateSearched DESC LIMIT 3");
		$output['views'] = $this->db->query("SELECT * FROM snapbid_views where userID = $userID ORDER BY dateViewed DESC LIMIT 3");

        /* Data */
        $data['title'] = "SnapBid Account Dashboard";
        $data['pageClass'] = "dashboard";

		$this->load->view('common/head', $data);
		$this->load->view('common/header');
		$this->load->view('account/dashboard', $output);
		$this->load->view('common/whymail');
		$this->load->view('common/footer');
		
	}

	public function activity()
	{
		if(!$this->aauth->is_loggedin()){
			redirect('/');
		}
		
        $this->load->helper('url'); 

        /* Data */
        $data['title'] = "SnapBid Account Activity";
        $data['pageClass'] = "trips-page dashboard";

		$userID = $this->aauth->get_user_id();
		$output['searches'] = $this->db->query("SELECT * FROM snapbid_searches where userID = $userID ORDER BY dateSearched DESC");
		$output['views'] = $this->db->query("SELECT * FROM snapbid_views where userID = $userID ORDER BY dateViewed DESC");

		$this->load->view('common/head', $data);
		$this->load->view('common/header');
		$this->load->view('account/activity', $output);
		$this->load->view('common/whymail');
		$this->load->view('common/footer');
		
	}

	public function trips()
	{
		if(!$this->aauth->is_loggedin()){
			redirect('/');
		}
		
        $this->load->helper('url'); 

        /* Data */
        $data['title'] = "SnapBid Account Trips";
        $data['pageClass'] = "trips-page dashboard";

		$output['trips'] = $this->aauth->get_user_var('tripIDs');
		$output['tripList'] = array_filter(explode(", ", $output['trips']));

		$this->load->view('common/head', $data);
		$this->load->view('common/header');
		$this->load->view('account/trips', $output);
		$this->load->view('common/whymail');
		$this->load->view('common/footer');
		
	}

	public function sign_out()
	{
		if(!$this->aauth->is_loggedin()){
			redirect('/');
		}
		$this->aauth->logout();
		redirect('/');
	}

	public function sign_in()
	{
		if($this->aauth->is_loggedin()){
			redirect('/account/dashboard');
		}
		if($this->input->post()){
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			if($this->input->post('remember') == 'TRUE'){
				$remember = TRUE;
			}else{
				$remember = FALSE;
			}
			if($this->aauth->login($email, $password, $remember)){
				redirect('/account/dashboard');
			}else{

        		/* Data */
        		$data['title'] = "SnapBid Sign In";
        		$data['pageClass'] = "signin-page";

				$this->load->view('common/head', $data);
				$this->load->view('common/header');
				$this->load->view('account/sign_in');
				$this->load->view('common/whymail');
				$this->load->view('common/footer');
			}
		}else{
        	/* Data */
        	$data['title'] = "SnapBid Sign In";
        	$data['pageClass'] = "signin-page";

			$this->load->view('common/head', $data);
			$this->load->view('common/header');
			$this->load->view('account/sign_in');
			$this->load->view('common/whymail');
			$this->load->view('common/footer');
		}
	}

	public function register()
	{
		if($this->aauth->is_loggedin()){
			redirect('/account/dashboard');
		}
		if($this->input->post()){
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$name = $this->input->post('name');

			if($this->aauth->create_user($email, $password, $name)){
				$this->aauth->info('Your account has been created successfully and is ready to use. You can use the Login form.');
				$this->aauth->login($email, $password);
				if($this->aauth->login($email, $password)){
					redirect('/account/dashboard');
				}else{

					$this->load->library('email');

            		$subject = 'Account Created';
            		$message = '<p>Thank you for creating an account on SnapBid</p>';

            		// Get full html:
            		$body =
						'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
						<html xmlns="http://www.w3.org/1999/xhtml">
						<head>
						    <meta http-equiv="Content-Type" content="text/html; charset='.strtolower(config_item('charset')).'" />
						    <title>'.html_escape($subject).'</title>
						    <style type="text/css">
						        body {
						            font-family: Arial, Verdana, Helvetica, sans-serif;
						            font-size: 16px;
						        }
						    </style>
						</head>
						<body>
						'.$message.'
						</body>
						</html>';
            		// Also, for getting full html you may use the following internal method:
            		//$body = $this->email->full_html($subject, $message);

           		 	$result = $this->email
               			->from('cmarsterson@gmail.com')
                		->reply_to('cmarsterson@gmail.com')    // Optional, an account where a human being reads.
                		->to('craigmarsterson@hotmail.com')
                		->subject($subject)
                		->message($body)
                		->send();

            		var_dump($result);
            		echo '<br />';
            		echo $this->email->print_debugger();

            		exit;
				
					$this->load->view('common/head');
					$this->load->view('common/header');
					$this->load->view('account/sign_in');
					$this->load->view('common/whymail');
					$this->load->view('common/footer');
				}
			}else{
				$this->load->view('common/head');
				$this->load->view('common/header');
				$this->load->view('common/searchbar');
				$this->load->view('register');
				$this->load->view('common/whymail');
				$this->load->view('common/footer');
			}
		}else{
			$this->load->view('common/head');
			$this->load->view('common/header');
			$this->load->view('common/searchbar');
			$this->load->view('register');
			$this->load->view('common/whymail');
			$this->load->view('common/footer');
		}
	}

	public function remind_password()
	{
		if($this->aauth->is_loggedin()){
			redirect('/account/dashboard');
		}
		if($this->input->post()){
			$email = $this->input->post('email');

			$this->aauth->remind_password($email);
			$this->aauth->info('The Account Verification mail will be sent to your email address.');

			$this->load->view('account/remind_password');
		}else{
			$this->load->view('account/remind_password');
		}
	}

	public function reset_password()
	{
		if($this->aauth->is_loggedin()){
			redirect('/account/dashboard');
		}
		if($this->input->post()){
			$user_id = $this->input->post('user_id');
			$ver_code = $this->input->post('verification_code');

			if($this->aauth->reset_password($user_id, $ver_code)){
				$this->aauth->info('A new password will be sent to your email address.');
			}else{
				$this->aauth->error('E-mail Address and Verification Code do not match.');
			}
			$this->load->view('account/reset_password');
		}else{
			$this->load->view('account/reset_password');
		}
	}
	public function update()
	{
		if(!$this->aauth->is_loggedin()){
			redirect('/account/sign_in');
		}
		if($this->input->post()){
			$user = $this->aauth->get_user();
			$user_id = $user->id;
			if(!$this->input->post('email')){
				$email = $this->input->post('email');
			}else{
				$email = FALSE;
			}
			if(!$this->input->post('password')){
				$password = $this->input->post('password');
			}else{
				$password = FALSE;
			}
			if(!$this->input->post('name')){
				$name = $this->input->post('name');
			}else{
				$name = FALSE;
			}
			if($email == FALSE AND $password == FALSE AND $name == FALSE){
				$this->load->view('account/update');
				return FALSE;
			}
			if($this->aauth->update_user($user_id, $email, $password, $name)){
				$this->aauth->info('Your account has been updated successfully.');
			}
			$this->load->view('account/update');
		}else{
			$this->load->view('account/update');
		}
	}
}
?>