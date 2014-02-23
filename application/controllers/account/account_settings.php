<?php
/*
 * Account_settings Controller
 */
class Account_settings extends CI_Controller {

	/**
	 * Constructor
	 */
	function __construct()
	{
		parent::__construct();

		// Load the necessary stuff...
		$this->load->config('account/account');
		$this->load->helper(array('date', 'account/ssl', 'url'));
		$this->load->library(array('account/authentication', 'account/authorization', 'form_validation'));
		$this->load->model(array('account/account_model', 'account/account_details_model'));
	}

	/**
	 * Account settings
	 */
	function index()
	{
		// Enable SSL?
		maintain_ssl($this->config->item("ssl_enabled"));

		// Redirect unauthenticated users to signin page
		if ( ! $this->authentication->is_signed_in())
		{
			redirect('account/sign_in/?continue='.urlencode(base_url().'account/account_settings'));
		}

		// Retrieve sign in user
		$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
		$data['account_details'] = $this->account_details_model->get_by_account_id($this->session->userdata('account_id'));

		// Split date of birth into month, day and year
		if ($data['account_details'] && $data['account_details']->dateofbirth)
		{
			$dateofbirth = strtotime($data['account_details']->dateofbirth);
			$data['account_details']->dob_month = mdate('%m', $dateofbirth);
			$data['account_details']->dob_day = mdate('%d', $dateofbirth);
			$data['account_details']->dob_year = mdate('%Y', $dateofbirth);
		}

		// Setup form validation
		$this->form_validation->set_error_delimiters('<div class="field_error">', '</div>');
		$this->form_validation->set_rules(array
			(array(
				'field' => 'settings_email', 
				'label' => 'Email', 
				'rules' => 'trim|required|valid_email|max_length[160]'
				), 
			array(
				'field' => 'settings_fullname', 
				'label' => 'Nama Lengkap', 
				'rules' => 'trim|max_length[160]'
				), 
			array(
				'field' => 'settings_firstname', 
				'label' => 'Nama Depan', 
				'rules' => 'trim|max_length[20]'
				), 
			array(
				'field' => 'settings_lastname', 
				'label' => 'Nama Belakang', 
				'rules' => 'trim|max_length[20]'
				), 
			array(
				'field' => 'settings_phone', 
				'label' => 'Handphone', 
				'rules' => 'trim|max_length[15]'
				),
			array(
				'field' => 'settings_address', 
				'label' => 'Alamat', 
				'rules' => 'trim|max_length[200]'
				), 
			array(
				'field' => 'settings_postalcode', 
				'label' => 'Kode Pos', 
				'rules' => 'trim|max_length[5]'
				)
			));

		// Run form validation
		if ($this->form_validation->run())
		{
			// If user is changing email and new email is already taken
			if (strtolower($this->input->post('settings_email', TRUE)) != strtolower($data['account']->email) && $this->email_check($this->input->post('settings_email', TRUE)) === TRUE)
			{
				$data['settings_email_error'] = 'Email sudah digunakan';
			}
			// Detect incomplete birthday dropdowns
			elseif ( ! (($this->input->post('settings_dob_month') && $this->input->post('settings_dob_day') && $this->input->post('settings_dob_year')) || ( ! $this->input->post('settings_dob_month') && ! $this->input->post('settings_dob_day') && ! $this->input->post('settings_dob_year'))))
			{
				$data['settings_dob_error'] = 'Tanggal lahir belum lengkap';
			}
			else
			{
				// Update account email
				$this->account_model->update_email($data['account']->id, $this->input->post('settings_email', TRUE) ? $this->input->post('settings_email', TRUE) : NULL);

				// Update account details
				if ($this->input->post('settings_dob_month', TRUE) && 
					$this->input->post('settings_dob_day', TRUE) && 
					$this->input->post('settings_dob_year', TRUE)) $attributes['dateofbirth'] = mdate('%Y-%m-%d', strtotime($this->input->post('settings_dob_day', TRUE).'-'.$this->input->post('settings_dob_month', TRUE).'-'.$this->input->post('settings_dob_year', TRUE)));
					
				$attributes['fullname'] = $this->input->post('settings_fullname', TRUE) ? $this->input->post('settings_fullname', TRUE) : NULL;
				$attributes['firstname'] = $this->input->post('settings_firstname', TRUE) ? $this->input->post('settings_firstname', TRUE) : NULL;
				$attributes['lastname'] = $this->input->post('settings_lastname', TRUE) ? $this->input->post('settings_lastname', TRUE) : NULL;
				$attributes['phone'] = $this->input->post('settings_phone', TRUE) ? $this->input->post('settings_phone', TRUE) : NULL;
				$attributes['address'] = $this->input->post('settings_address', TRUE) ? $this->input->post('settings_address', TRUE) : NULL;
				$attributes['gender'] = $this->input->post('settings_gender', TRUE) ? $this->input->post('settings_gender', TRUE) : NULL;
				$attributes['postalcode'] = $this->input->post('settings_postalcode', TRUE) ? $this->input->post('settings_postalcode', TRUE) : NULL;
				$this->account_details_model->update($data['account']->id, $attributes);

				$data['settings_info'] = 'Setting Akun berhasil di update';
			}
		}

		$this->load->view('account/account_settings', $data);
	}

	/**
	 * Check if an email exist
	 *
	 * @access public
	 * @param string
	 * @return bool
	 */
	function email_check($email)
	{
		return $this->account_model->get_by_email($email) ? TRUE : FALSE;
	}

}


/* End of file account_settings.php */
/* Location: ./application/account/controllers/account_settings.php */