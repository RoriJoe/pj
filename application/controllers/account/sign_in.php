<?php
/*
 * Sign_in Controller
 */
class Sign_in extends CI_Controller {

	/**
	 * Constructor
	 */
	function __construct()
	{
		parent::__construct();

		// Load the necessary stuff...
		$this->load->config('account/account');
		$this->load->helper(array('account/ssl', 'url'));
		$this->load->library(array('account/authentication', 'account/authorization','form_validation'));
		$this->load->model(array('account/account_model'));
	}

	/**
	 * Account sign in
	 *
	 * @access public
	 * @return void
	 */
	function index()
	{
		// Enable SSL?
		maintain_ssl($this->config->item("ssl_enabled"));

		// Redirect signed in users to homepage
		if ($this->authentication->is_signed_in()) redirect('menu/home');

		// Setup form validation
		$this->form_validation->set_error_delimiters('<span class="field_error">', '</span>');
		$this->form_validation->set_rules(array(
			array(
				'field' => 'username',
				'label' => 'username',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'password',
				'label' => 'password',
				'rules' => 'trim|required'
			)
		));

		// Run form validation
		if ($this->form_validation->run() === TRUE)
		{
			// Get user by username / email
			if ( ! $user = $this->account_model->get_by_username($this->input->post('username', TRUE)))
			{
				// Username / email doesn't exist
				$data['username_error'] = 'Username doesnt exist';
			}
			else
			{
				// Check password
				if ( ! $this->authentication->check_password($user->password, $this->input->post('password', TRUE)))
				{
					// Increment sign in failed attempts
					$this->session->set_userdata('sign_in_failed_attempts', (int)$this->session->userdata('sign_in_failed_attempts') + 1);

					$data['sign_in_error'] = 'Username and Password doesn\'t match';
				}
				else
				{
					// Clear sign in fail counter
					$this->session->unset_userdata('sign_in_failed_attempts');

					// Run sign in routine
					$this->authentication->sign_in($user->id, $this->input->post('sign_in_remember', TRUE));
				}
			}
		}

		// Load sign in view
		$this->load->view('form_login', isset($data) ? $data : NULL);
	}

}


/* End of file sign_in.php */
/* Location: ./application/account/controllers/sign_in.php */