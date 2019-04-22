<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Auth
 * @property Ion_auth|Ion_auth_model $ion_auth        The ION Auth spark
 * @property CI_Form_validation      $form_validation The form validation library
 */
class Admin extends MX_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(array('ion_auth', 'form_validation'));
		$this->load->helper(array('url', 'language'));
		date_default_timezone_set('Europe/Athens');

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('/auth');
	}


	/**
	 * Redirect if needed, otherwise display the user list
	 */


	public function index()
	{

		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('/admin/login', 'refresh');
		}
		else if (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
		}
		else
		{
			$this->data['title'] = 'Dashboard';
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$limit = 5;

			//Get latest posts
			$this->db->limit($limit);
			$this->db->order_by('post_id', 'DESC');
			$this->db->join('media as m', 'posts.post_image = m.media_id', 'left');
			$this->db->join('languages as l', 'posts.post_language = l.language_id');
			$this->db->join('post_types as pt', 'posts.post_type = pt.post_type_id');
			$this->data['posts'] = $this->db->get('posts')->result();

			//Get latest pages
			$this->db->limit($limit);
			$this->db->order_by('page_id', 'DESC');
			$this->db->join('languages as l', 'pages.page_language = l.language_id');
			$this->data['pages'] = $this->db->get('pages')->result();

			//Get latest post types
			$this->db->limit($limit);
			$this->db->order_by('post_type_id', 'DESC');
			$this->db->join('languages as l', 'post_types.post_type_language_id = l.language_id');
			$this->data['post_types'] = $this->db->get('post_types')->result();

			//Get latest post categories
			$this->db->limit($limit);
			$this->db->order_by('post_category_id', 'DESC');
			$this->db->join('languages as l', 'post_categories.post_category_language = l.language_id');
			$this->db->join('post_types as pt', 'post_categories.post_category_post_type = pt.post_type_id');
			$this->data['post_categories'] = $this->db->get('post_categories')->result();


			//list the users
			$this->data['users'] = $this->ion_auth->users()->result();
			foreach ($this->data['users'] as $k => $user)
			{
				$this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
			}

			$this->load->view('templates/header',$this->data);
			$this->load->view('dashboard');
			$this->load->view('templates/footer');


			//$this->_render_page('/admin/index', $this->data);
		}
	}

	/**
	 * Log the user in
	 */
	public function login()
	{

		$this->data['title'] = $this->lang->line('login_heading');

		// validate form input
		$this->form_validation->set_rules('identity', str_replace(':', '', $this->lang->line('login_identity_label')), 'required');
		$this->form_validation->set_rules('password', str_replace(':', '', $this->lang->line('login_password_label')), 'required');

		if ($this->form_validation->run() === TRUE)
		{
			// check to see if the user is logging in
			// check for "remember me"
			$remember = (bool)$this->input->post('remember');

			if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
			{
				//if the login is successful
				//redirect them back to the home page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect('/admin', 'refresh');
			}
			else
			{
				// if the login was un-successful
				// redirect them back to the login page
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('/admin/login', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
			}
		}
		else
		{
			// the user is not logging in so display the login page
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['identity'] = array('name' => 'identity',
				'id' => 'identity',
				'type' => 'text',
				'value' => $this->form_validation->set_value('identity'),
			);
			$this->data['password'] = array('name' => 'password',
				'id' => 'password',
				'type' => 'password',
			);

			$this->_render_page('/admin/login', $this->data);
		}
	}

	/**
	 * Log the user out
	 */
	public function logout()
	{
		$this->data['title'] = "Logout";

		// log the user out
		$logout = $this->ion_auth->logout();

		// redirect them to the login page
		$this->session->set_flashdata('message', $this->ion_auth->messages());
		redirect('/admin/login', 'refresh');
	}

	/**
	 * Change password
	 */
	public function change_password()
	{
		$this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
		$this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
		$this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

		if (!$this->ion_auth->logged_in())
		{
			redirect('/admin/login', 'refresh');
		}

		$user = $this->ion_auth->user()->row();

		if ($this->form_validation->run() === FALSE)
		{
			// display the form
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
			$this->data['old_password'] = array(
				'name' => 'old',
				'id' => 'old',
				'type' => 'password',
			);
			$this->data['new_password'] = array(
				'name' => 'new',
				'id' => 'new',
				'type' => 'password',
				'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
			);
			$this->data['new_password_confirm'] = array(
				'name' => 'new_confirm',
				'id' => 'new_confirm',
				'type' => 'password',
				'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
			);
			$this->data['user_id'] = array(
				'name' => 'user_id',
				'id' => 'user_id',
				'type' => 'hidden',
				'value' => $user->id,
			);

			// render
			$this->_render_page('/admin/change_password', $this->data);
		}
		else
		{
			$identity = $this->session->userdata('identity');

			$change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

			if ($change)
			{
				//if the password was successfully changed
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				$this->logout();
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('/admin/change_password', 'refresh');
			}
		}
	}

	/**
	 * Forgot password
	 */
	public function forgot_password()
	{
		// setting validation rules by checking whether identity is username or email
		if ($this->config->item('identity', 'ion_auth') != 'email')
		{
			$this->form_validation->set_rules('identity', $this->lang->line('forgot_password_identity_label'), 'required');
		}
		else
		{
			$this->form_validation->set_rules('identity', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');
		}


		if ($this->form_validation->run() === FALSE)
		{
			$this->data['type'] = $this->config->item('identity', 'ion_auth');
			// setup the input
			$this->data['identity'] = array('name' => 'identity',
				'id' => 'identity',
			);

			if ($this->config->item('identity', 'ion_auth') != 'email')
			{
				$this->data['identity_label'] = $this->lang->line('forgot_password_identity_label');
			}
			else
			{
				$this->data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
			}

			// set any errors and display the form
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->_render_page('/admin/forgot_password', $this->data);
		}
		else
		{
			$identity_column = $this->config->item('identity', 'ion_auth');
			$identity = $this->ion_auth->where($identity_column, $this->input->post('identity'))->users()->row();

			if (empty($identity))
			{

				if ($this->config->item('identity', 'ion_auth') != 'email')
				{
					$this->ion_auth->set_error('forgot_password_identity_not_found');
				}
				else
				{
					$this->ion_auth->set_error('forgot_password_email_not_found');
				}

				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("auth/forgot_password", 'refresh');
			}

			// run the forgotten password method to email an activation code to the user
			$forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

			if ($forgotten)
			{
				// if there were no errors
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("auth/login", 'refresh'); //we should display a confirmation page here instead of the login page
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("auth/forgot_password", 'refresh');
			}
		}
	}

	/**
	 * Reset password - final step for forgotten password
	 *
	 * @param string|null $code The reset code
	 */
	public function reset_password($code = NULL)
	{
		if (!$code)
		{
			show_404();
		}

		$user = $this->ion_auth->forgotten_password_check($code);

		if ($user)
		{
			// if the code is valid then display the password reset form

			$this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
			$this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

			if ($this->form_validation->run() === FALSE)
			{
				// display the form

				// set the flash data error message if there is one
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

				$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
				$this->data['new_password'] = array(
					'name' => 'new',
					'id' => 'new',
					'type' => 'password',
					'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
				);
				$this->data['new_password_confirm'] = array(
					'name' => 'new_confirm',
					'id' => 'new_confirm',
					'type' => 'password',
					'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
				);
				$this->data['user_id'] = array(
					'name' => 'user_id',
					'id' => 'user_id',
					'type' => 'hidden',
					'value' => $user->id,
				);
				$this->data['csrf'] = $this->_get_csrf_nonce();
				$this->data['code'] = $code;

				// render
				$this->_render_page('/admin/reset_password', $this->data);
			}
			else
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id'))
				{

					// something fishy might be up
					$this->ion_auth->clear_forgotten_password_code($code);

					show_error($this->lang->line('error_csrf'));

				}
				else
				{
					// finally change the password
					$identity = $user->{$this->config->item('identity', 'ion_auth')};

					$change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

					if ($change)
					{
						// if the password was successfully changed
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						redirect("auth/login", 'refresh');
					}
					else
					{
						$this->session->set_flashdata('message', $this->ion_auth->errors());
						redirect('/admin/reset_password/' . $code, 'refresh');
					}
				}
			}
		}
		else
		{
			// if the code is invalid then send them back to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth/forgot_password", 'refresh');
		}
	}

	/**
	 * Activate the user
	 *
	 * @param int         $id   The user ID
	 * @param string|bool $code The activation code
	 */
	public function activate($id, $code = FALSE)
	{
		if ($code !== FALSE)
		{
			$activation = $this->ion_auth->activate($id, $code);
		}
		else if ($this->ion_auth->is_admin())
		{
			$activation = $this->ion_auth->activate($id);
		}

		if ($activation)
		{
			// redirect them to the auth page
			$this->session->set_flashdata('success', 'User has been activated');
			redirect(base_url("admin/users"), 'refresh');
		}
		else
		{
			// redirect them to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("admin/forgot_password", 'refresh');
		}
	}

	/**
	 * Deactivate the user
	 *
	 * @param int|string|null $id The user ID
	 */
	public function deactivate($id = NULL)
	{
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			// redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
		}

		$id = (int)$id;

		$this->load->library('form_validation');
		$this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
		$this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');

		if ($this->form_validation->run() === FALSE)
		{
			// insert csrf check
			$this->data['csrf'] = $this->_get_csrf_nonce();
			$this->data['user'] = $this->ion_auth->user($id)->row();
			$this->load->view('templates/header',$this->data);
			$this->_render_page('/admin/deactivate_user');
			$this->load->view('templates/footer');

		}
		else
		{
			// do we really want to deactivate?
			if ($this->input->post('confirm') == 'yes')
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
				{
					return show_error($this->lang->line('error_csrf'));
				}

				// do we have the right userlevel?
				if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
				{

					$this->session->set_flashdata('success', 'User has been deactivated');
					$this->ion_auth->deactivate($id);
				}
			}

			// redirect them back to the auth page
			redirect('admin/users', 'refresh');
		}
	}

	public function register(){
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('/admin/login', 'refresh');
		}
			$this->create_user();
	}
	/**
	 * Create a new user
	 */
	public function create_user()
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('/admin/login', 'refresh');
		}
		$this->data['title'] = $this->lang->line('create_user_heading');

		//See the ion_auth config to check if allow_user_registration is TRUE
		if( ! $this->config->item('allow_user_registration', 'ion_auth')){

			if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
			{
				redirect('/admin', 'refresh');
			}

		}


		$tables = $this->config->item('tables', 'ion_auth');
		$identity_column = $this->config->item('identity', 'ion_auth');
		$this->data['identity_column'] = $identity_column;

		// validate form input
		$this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'trim|required');
		$this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'trim|required');
		if ($identity_column !== 'email')
		{
			$this->form_validation->set_rules('identity', $this->lang->line('create_user_validation_identity_label'), 'trim|required|is_unique[' . $tables['users'] . '.' . $identity_column . ']');
			$this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'trim|required|valid_email');
		}
		else
		{
			$this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'trim|required|valid_email|is_unique[' . $tables['users'] . '.email]');
		}
		$this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'trim');
		$this->form_validation->set_rules('company', $this->lang->line('create_user_validation_company_label'), 'trim');
		$this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
		$this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

		if ($this->form_validation->run() === TRUE)
		{
			$email = strtolower($this->input->post('email'));
			$identity = ($identity_column === 'email') ? $email : $this->input->post('identity');
			$password = $this->input->post('password');

			$additional_data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'company' => $this->input->post('company'),
				'phone' => $this->input->post('phone'),
			);
		}
		if ($this->form_validation->run() === TRUE && $this->ion_auth->register($identity, $password, $email, $additional_data))
		{
			// check to see if we are creating the user
			// redirect them back to the admin page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("auth", 'refresh');
		}
		else
		{
			// display the create user form
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$this->data['first_name'] = array(
				'name' => 'first_name',
				'class' => 'form-control',
				'id' => 'first_name',
				'type' => 'text',
				'value' => $this->form_validation->set_value('first_name'),
			);
			$this->data['last_name'] = array(
				'name' => 'last_name',
				'class' => 'form-control',
				'id' => 'last_name',
				'type' => 'text',
				'value' => $this->form_validation->set_value('last_name'),
			);
			$this->data['identity'] = array(
				'name' => 'identity',
				'class' => 'form-control',
				'id' => 'identity',
				'type' => 'text',
				'value' => $this->form_validation->set_value('identity'),
			);
			$this->data['email'] = array(
				'name' => 'email',
				'class' => 'form-control',
				'id' => 'email',
				'type' => 'text',
				'value' => $this->form_validation->set_value('email'),
			);
			$this->data['company'] = array(
				'name' => 'company',
				'class' => 'form-control',
				'id' => 'company',
				'type' => 'text',
				'value' => $this->form_validation->set_value('company'),
			);
			$this->data['phone'] = array(
				'name' => 'phone',
				'class' => 'form-control',
				'id' => 'phone',
				'type' => 'text',
				'value' => $this->form_validation->set_value('phone'),
			);
			$this->data['password'] = array(
				'name' => 'password',
				'class' => 'form-control',
				'id' => 'password',
				'type' => 'password',
				'value' => $this->form_validation->set_value('password'),
			);
			$this->data['password_confirm'] = array(
				'name' => 'password_confirm',
				'class' => 'form-control',
				'id' => 'password_confirm',
				'type' => 'password',
				'value' => $this->form_validation->set_value('password_confirm'),
			);


			$this->load->view('templates/header',$this->data);
			$this->load->view('/admin/create_user');
			$this->load->view('templates/footer');
		}
	}

	/**
	 * Edit a user
	 *
	 * @param int|string $id
	 */
	public function edit_user($id)
	{
		$this->data['title'] = $this->lang->line('edit_user_heading');

		if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id)))
		{
			redirect('/admin', 'refresh');
		}

		$user = $this->ion_auth->user($id)->row();
		$groups = $this->ion_auth->groups()->result_array();
		$currentGroups = $this->ion_auth->get_users_groups($id)->result();

		// validate form input
		$this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'trim|required');
		$this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'trim|required');
		$this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'trim|required');
		$this->form_validation->set_rules('company', $this->lang->line('edit_user_validation_company_label'), 'trim|required');

		if (isset($_POST) && !empty($_POST))
		{
			// do we have a valid request?
			if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
			{
				show_error($this->lang->line('error_csrf'));
			}

			// update the password if it was posted
			if ($this->input->post('password'))
			{
				$this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
				$this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
			}

			if ($this->form_validation->run() === TRUE)
			{
				$data = array(
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'company' => $this->input->post('company'),
					'phone' => $this->input->post('phone'),
				);

				// update the password if it was posted
				if ($this->input->post('password'))
				{
					$data['password'] = $this->input->post('password');
				}

				// Only allow updating groups if user is admin
				if ($this->ion_auth->is_admin())
				{
					// Update the groups user belongs to
					$groupData = $this->input->post('groups');

					if (isset($groupData) && !empty($groupData))
					{

						$this->ion_auth->remove_from_group('', $id);

						foreach ($groupData as $grp)
						{
							$this->ion_auth->add_to_group($grp, $id);
						}

					}
				}

				// check to see if we are updating the user
				if ($this->ion_auth->update($user->id, $data))
				{
					// redirect them back to the admin page if admin, or to the base url if non admin

				// Original line:	$this->session->set_flashdata('message', $this->ion_auth->messages());
				$this->session->set_flashdata('success','User information has been updated');

					if ($this->ion_auth->is_admin())
					{
						redirect(current_url(), 'refresh');
					}
					else
					{
						redirect('/admin', 'refresh');
					}

				}
				else
				{
					// redirect them back to the admin page if admin, or to the base url if non admin
					$this->session->set_flashdata('message', $this->ion_auth->errors());
					if ($this->ion_auth->is_admin())
					{
						redirect('/admin', 'refresh');
					}
					else
					{
						redirect('/admin', 'refresh');
					}

				}

			}
		}

		// display the edit user form
		$this->data['csrf'] = $this->_get_csrf_nonce();

		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		// pass the user to the view
		$this->data['user'] = $user;
		$this->data['groups'] = $groups;
		$this->data['currentGroups'] = $currentGroups;

		$this->data['email'] = array(
			'name'  => '',
			'class' => 'form-control',
			'id'    => 'first_name',
			'type'  => 'text',
			'value' => $user->email,
		);

		$this->data['first_name'] = array(
			'name'  => 'first_name',
			'class' => 'form-control',
			'id'    => 'first_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('first_name', $user->first_name),
		);
		$this->data['last_name'] = array(
			'name'  => 'last_name',
			'class' => 'form-control',
			'id'    => 'last_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('last_name', $user->last_name),
		);
		$this->data['company'] = array(
			'name'  => 'company',
			'class' => 'form-control',
			'id'    => 'company',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('company', $user->company),
		);
		$this->data['phone'] = array(
			'name'  => 'phone',
			'class' => 'form-control',
			'id'    => 'phone',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('phone', $user->phone),
		);
		$this->data['password'] = array(
			'name' => 'password',
			'class' => 'form-control',
			'id'   => 'password',
			'type' => 'password'
		);
		$this->data['password_confirm'] = array(
			'name'  => 'password_confirm',
			'class' => 'form-control',
			'id'   => 'password_confirm',
			'type' => 'password'
		);


		$this->load->view('templates/header',$this->data);
		$this->_render_page('/admin/edit_user', $this->data);
		$this->load->view('templates/footer');
	}
	public function users()
	{

		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('/auth/login', 'refresh');
		}
		else if (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
		}
		else
		{
			$this->data['title'] = 'All users';
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			//list the users
			$this->data['users'] = $this->ion_auth->users()->result();
			foreach ($this->data['users'] as $k => $user)
			{
				$this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
			}

			$this->load->view('templates/header',$this->data);
			$this->_render_page('/admin/users');
			$this->load->view('templates/footer');

		}
	}
	/**
	 * Create a new group
	 */
	public function create_group()
	{
		$this->data['title'] = $this->lang->line('create_group_title');

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('/admin', 'refresh');
		}

		// validate form input
		$this->form_validation->set_rules('group_name', $this->lang->line('create_group_validation_name_label'), 'trim|required|alpha_dash');

		if ($this->form_validation->run() === TRUE)
		{
			$new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
			if ($new_group_id)
			{
				// check to see if we are creating the group
				// redirect them back to the admin page
				$this->session->set_flashdata('success', 'New Group has been created');
				redirect(base_url('admin/edit_group/'.$new_group_id), 'refresh');
			}
		}
		else
		{
			// display the create group form
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$this->data['group_name'] = array(
				'name'  => 'group_name',
				'id'    => 'group_name',
				'class' =>  'form-control',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('group_name'),
			);
			$this->data['description'] = array(
				'name'  => 'description',
				'id'    => 'description',
				'class' =>  'form-control',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('description'),
			);

			$this->load->view('templates/header',$this->data);
			$this->_render_page('/admin/create_group');
			$this->load->view('templates/footer');
		}
	}

	/**
	 * Edit a group
	 *
	 * @param int|string $id
	 */
	public function edit_group($id)
	{
		// bail if no group id given
		if (!$id || empty($id))
		{
			redirect('/admin', 'refresh');
		}

		$this->data['title'] = $this->lang->line('edit_group_title');

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('/admin', 'refresh');
		}

		$group = $this->ion_auth->group($id)->row();

		// validate form input
		$this->form_validation->set_rules('group_name', $this->lang->line('edit_group_validation_name_label'), 'required|alpha_dash');

		if (isset($_POST) && !empty($_POST))
		{
			if ($this->form_validation->run() === TRUE)
			{
				$group_update = $this->ion_auth->update_group($id, $_POST['group_name'], $_POST['group_description']);

				if ($group_update)
				{
					$this->session->set_flashdata('success', 'Group has been updated');
				}
				else
				{
					$this->session->set_flashdata('message', $this->ion_auth->errors());
				}
				redirect(current_url(), 'refresh');
			}
		}

		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		// pass the user to the view
		$this->data['group'] = $group;

		$readonly = $this->config->item('admin_group', 'ion_auth') === $group->name ? 'readonly' : '';

		$this->data['group_name'] = array(
			'name'    => 'group_name',
			'id'      => 'group_name',
			'class' => 'form-control',
			'type'    => 'text',
			'value'   => $this->form_validation->set_value('group_name', $group->name),
			$readonly => $readonly,
		);
		$this->data['group_description'] = array(
			'name'  => 'group_description',
			'class' => 'form-control',
			'id'    => 'group_description',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('group_description', $group->description),
		);
		$this->load->view('templates/header',$this->data);
		$this->_render_page('/admin/edit_group', $this->data);
		$this->load->view('templates/footer');
	}

	/**
	 * @return array A CSRF key-value pair
	 */
	public function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}

	/**
	 * @return bool Whether the posted CSRF token matches
	 */
	public function _valid_csrf_nonce()
	{
		$csrfkey = $this->input->post($this->session->flashdata('csrfkey'));
		if ($csrfkey && $csrfkey === $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * @param string     $view
	 * @param array|null $data
	 * @param bool       $returnhtml
	 *
	 * @return mixed
	 */
	public function _render_page($view, $data = NULL, $returnhtml = FALSE)//I think this makes more sense
	{

		$this->viewdata = (empty($data)) ? $this->data : $data;

		$view_html = $this->load->view($view, $this->viewdata, $returnhtml);

		// This will return html on 3rd argument being true
		if ($returnhtml)
		{
			return $view_html;
		}
	}


	public function copy1(){


		$result = [];
		$i = 0;
		foreach ($list as $url) {
		// //	echo "<h2>$i</h2><div>".$this->parse($url)."</div><div style='height:20px;background:red;'></div>";
    //
    //
		// 	// 1. Link
		// 	$link = explode('https://www.erevna.gr/',$url);
		// 	$link = $link[1];
    //
		// 	// 2. Depth
		// 		$linkArr = explode('/',$link);
		// 		$depth = count($linkArr) - 1;
		// 		if($linkArr[0] == 'en'){
		// 			$lang = 'en';
		// 			$depth = $depth - 1;
		// 			$linkArr =  explode('en/', $link);
		// 			$link= $linkArr[1];
		// 		}else{
		//  // 3. Lang
		// 			$lang = 'gr';
		// 		}
    //
    //
		// 		// $result['page_link'] = $link;
		// 		// $result['page_language'] = $lang;
		// 		// $result['page_depth_level'] = $depth;
    //     //
		// 		// $this->db->insert('pages', $result);
		// 		//$i++;
			}



	}

	public function copy2()
	{
		$this->db->start_cache();
		$pages = $this->db->get('pages')->result();
		$this->db->stop_cache();
		$this->db->flush_cache();

		foreach ($pages as $page) {
			$link = $page->page_link;
			$linkArr = explode('/', $link);
			$remain = explode('/'.$linkArr[count($linkArr) - 1], $link);
			$parent = $remain[0];
			$this->db->start_cache();
			$this->db->where(['page_link'=>$parent.'.html']);


			$parent_id = $this->db->get('pages');
			if($parent_id->num_rows() > 0){
				$parent_id = $parent_id->row()->page_id;
			}else{
				echo "$link<br>";
				continue;
			}
			$this->db->stop_cache();
			$this->db->flush_cache();

			$this->db->start_cache();
			$this->db->where(['page_id'=>$page->page_id]);
			$this->db->set('page_parent_page_id', $parent_id);
			$this->db->update('pages');
			$this->db->stop_cache();
			$this->db->flush_cache();



		}
	}


public function menu($lang = "gr"){
	$this->db->where('page_language', $lang);
	$this->db->where('page_depth_level', 0);
	$pages0 = $this->db->get('pages')->result();

	$this->db->where('page_language', $lang);
	$this->db->where('page_depth_level', 1);
	$pages1 = $this->db->get('pages')->result();

	$this->db->where('page_language', $lang);
	$this->db->where('page_depth_level', 2);
	$pages2 = $this->db->get('pages')->result();

	$this->db->where('page_language', $lang);
	$this->db->where('page_depth_level', 3);
	$pages3 = $this->db->get('pages')->result();


	if($lang != 'gr'){
		$lang = $lang.'/';
	}else{
		$lang = '';
	}

	foreach ($pages3 as $item) {
		$ppid = $item->page_parent_page_id;
		//$menu[$ppid]
		$menu3[$ppid][$item->page_id]['title'] = $item->page_title;
		$menu3[$ppid][$item->page_id]['link'] = $item->page_link;

	}

	foreach($menu3 as $key => $value){
		$html = '<ul class="trd-dropdown-menu trd-dropdown-menu-2 trd-dropdown-menu-3">';
			foreach ($value as $item) {
				$html .= '<li><a href="'.base_url($lang.$item['link']).'">'.trim($item['title']).'</a></li>';
			}
			$html .= '</ul>';
			$menu3[$key]['html'] = $html;
	}

	foreach ($pages2 as $item) {
		$ppid = $item->page_parent_page_id;
		//$menu[$ppid]
		$menu2[$ppid][$item->page_id]['title'] = $item->page_title;
		$menu2[$ppid][$item->page_id]['link'] = $item->page_link;

	}


	foreach($menu2 as $key => $value){
		$html = '<ul class="trd-dropdown-menu trd-dropdown-menu-2">';
			foreach ($value as $index => $value) {

				(isset($menu3[$index]) ? $class = 'dropdown-submenu' : $class = '');
				$submenu = (isset($menu3[$index]) ? $menu3[$index]['html'] : '') ;
				$html .= '<li><a  href="'.base_url($lang.$value['link']).'">'.trim($value['title']).'</a>'.$submenu.'</li>';
			}
			$html .= '</ul>';
			$menu2[$key]['html'] = $html;
	}



	foreach ($pages1 as $item) {
		$ppid = $item->page_parent_page_id;
		//$menu[$ppid]
		$menu1[$ppid][$item->page_id]['title'] = $item->page_title;
		$menu1[$ppid][$item->page_id]['link'] = $item->page_link;

	}


	foreach($menu1 as $key => $value){
		$html = '<ul class="trd-dropdown-menu">';
			foreach ($value as $index => $value) {

				(isset($menu2[$index]) ? $class = 'dropdown-submenu' : $class = '');
				$submenu = (isset($menu2[$index]) ? $menu2[$index]['html'] : '') ;
				$html .= '<li><a  href="'.base_url($lang.$value['link']).'">'.trim($value['title']).'</a>'.$submenu.'</li>';
			}
			$html .= '</ul>';
			$menu1[$key]['html'] = $html;
	}

	foreach ($pages0 as $item) {
		$ppid = $item->page_parent_page_id;
		//$menu[$ppid]
		$menu0[$ppid][$item->page_id]['title'] = $item->page_title;
		$menu0[$ppid][$item->page_id]['link'] = $item->page_link;

	}

	foreach($menu0 as $key => $value){
		$html = '<ul class="nav navbar-nav trd-menus">';
			foreach ($value as $index => $value) {

				(isset($menu1[$index]) ? $class = 'dropdown-submenu' : $class = '');
				$submenu = (isset($menu1[$index]) ? $menu1[$index]['html'] : '') ;
				$html .= '<li><a  href="'.base_url($lang.$value['link']).'">'.trim($value['title']).'</a>'.$submenu.'</li>';
			}
			$html .= '</ul>';
			$menu0[$key]['html'] = $html;
			echo $html;
	}


}
	public function copy()
	{
		$this->db->where('page_parent_page_id', 0);
		$pages = $this->db->get('pages')->result();
		$i=0;

		foreach ($pages as $page) {
			// $title = trim($page->page_title);
			// echo "$page->page_title<br>";
			// // $this->db->where('page_id', $page->page_id);
			// // $this->db->set('page_title', $title);
			// // if($i < 0)
			// // {
			// // 	$i++;
			// // 	continue;
			// // }else{
			// // 	$i++;
			// // 	if($i > 115)
			// // 	break;
			// // }

			///////////
			if($page->page_language == 'en'){
				$lang = 'en/';
			}else{
				$lang = '';
			}
			echo "$page->page_language:$page->page_id <br>";
			$link = explode('.html', $page->page_link);
			$link = $link[0];
			//$title = $this->parse('https://www.erevna.gr/'.$lang.''.$link);
			//$content = $this->parse2('https://www.erevna.gr/'.$lang.''.$link);
			$content = $this->getMeta('https://www.erevna.gr/'.$lang.''.$link);
			$this->db->where('page_id',$page->page_id);
			//$this->db->set('page_content', $content);
			//$this->db->set('page_title', strip_tags($title));
			$this->db->set('page_meta_description',$content['description']);
			$this->db->set('page_meta_keywords',$content['keywords']);
			$this->db->set('page_custom_h1',$page->page_title);
			$this->db->set('page_meta_title',$content['title']);
			$this->db->update('pages');

		}

		echo "done";

	}

	public function parse($url){
		$html = new simple_html_dom();

    $html->load_file("$url");
		$el = false;
		foreach($html->find('.page-blog h1') as $e){
          $el = $e->innertext;
					break;
    }
		if(!$el){

		foreach($html->find('.page-blog h2') as $e){
          $el = $e->innertext;
					break;
    }
	}
	if(!$el){

		foreach($html->find('.page-blog h3') as $e){
          $el = $e->innertext;
					break;
    }
	}

		if(!$el){
			foreach($html->find('.page-item h1') as $e){
	          $el = $e->innertext;
						break;
	    }
		}

		if(!$el){
			foreach($html->find('.page-item h2') as $e){
	          $el = $e->innertext;
						break;
	    }
		}

		if(!$el){
			foreach($html->find('.page-item h3') as $e){
	          $el = $e->innertext;
						break;
	    }
		}

		return $el;
							// echo "<pre>";
							//   print_r( $arr );
							// echo "</pre>";
	}

	public function parse2($url){
		$html = new simple_html_dom();

    $html->load_file($url);
		$el = false;
		foreach($html->find('.page-blog ') as $e){
          $el = $e->innertext;
					break;
    }


		if(!$el){
			foreach($html->find('.page-item') as $e){
	          $el = $e->innertext;
						break;
	    }
		}


		if(!$el){
			foreach($html->find('.category-list') as $e){
	          $el = $e->innertext;
						break;
	    }
		}

		if(!$el){
			foreach($html->find('.items-leading') as $e){
	          $el = $e->innertext;
						break;
	    }
		}


		return $el;
							// echo "<pre>";
							//   print_r( $arr );
							// echo "</pre>";
	}

	public function getMeta($url){

		$html = new simple_html_dom();

    $html->load_file($url);
		$el = false;
		$el['description'] = $html->find(' meta[name=description]')[0]->content;
		$el['keywords'] = $html->find(' meta[name=keywords]')[0]->content;
		$el['title'] = $html->find(' title')[0]->content;
		return $el;

	}

	public function clear_cache($redirect){

	//Delete all webpages cache
	$files = scandir(APPPATH.'cache');

	$ignore_arr = ['.', '..', 'index.html', 'db'];
	foreach($files as $file){
			if(in_array($file, $ignore_arr))
				continue;
			else
				unlink(APPPATH.'cache/'.$file);
		}
			$this->session->set_flashdata('success','Cache has beed cleared!');

			$redirect = urldecode($redirect);
			$redirect = str_replace( "^%^", "/", $redirect);
			redirect($redirect);
}

public function sitemap($action = null){
		if (!$this->ion_auth->is_admin())
			redirect('/admin/login', 'refresh');


		if(!$action)
		{
			$this->load->view('templates/header');
			$this->load->view('sitemap');
			$this->load->view('templates/footer');
		}elseif($action == 'generate'){
			if($this->sitemap_generator() && $this->ror_generator()){
				$this->session->set_flashdata('success', 'Sitemaps were generated/updated');
			}else{
				$this->session->set_flashdata('danger', 'File(s) could not be created');
			}
			redirect('/admin/sitemap', 'refresh');
			// $this->load->view('templates/header');
			// $this->load->view('sitemap');
			// $this->load->view('templates/footer');
		}



		// if($duplicates)
		// 	$duplicate = "Some duplicate url's were found <br>";
		// 	echo "<pre>";
		// 	  print_r(  );
		// 	echo "</pre>";
	}

	private function sitemap_generator() {
		$freq = 'weekly';
		$file = 'sitemap.xml';
		$pf = fopen ($file, "w");
		if (!$pf) {
			$this->data['message'] = "Cannot create $file!";
			$this->load->view('templates/header', $this->data);
			$this->load->view('sitemap');
			$this->load->view('templates/footer');
			return;
		}
		file_put_contents($file, "");
		$start_url = base_url();
		fwrite ($pf, "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n" .
					 "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\"\n" .
					 "        xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"\n" .
					 "        xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9\n" .
					 "        http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">\n" .
					 "  <url>\n" .
					 "    <loc>$start_url</loc>\n" .
					 "    <lastmod>".date('Y-m-d')."T".date('H:i:sP')."</lastmod>\n" .
					 "    <changefreq>$freq</changefreq>\n" .
					 "  </url>\n");


		//table name to single
		$types = [
			'posts' => 'post',
			'pages' => 'page',
			'post_categories' => 'post_category',
			'post_types' => 'post_type'
		];

		$tables = ['posts', 'pages', 'post_types', 'post_categories'];
		foreach ($tables as $table) {
			$this->db->where($types[$table].'_index', 'Yes');
			$items[$table] = $this->db->get($table)->result();
		}

		$scanned = [];
		$duplicates = [];

		foreach ($items as $table => $value) {
			foreach ($value as $item) {
				$url = get_url( $types[$table] , $item->{$types[$table].'_id'} );
				$url = str_replace(base_url(), 'BASEURL', $url);
				$url = str_replace('/', '-tempslash-', $url);
				$url = urlencode($url);
				$url = str_replace('-tempslash-', '/', $url);
				$url = str_replace('BASEURL', base_url(),  $url);
				if(!in_array($url, $scanned)){
				fwrite ($pf, "  <url>\n" .
										 "    <loc>" . $url ."</loc>\n" .
										 "    <lastmod>".date('Y-m-d')."T".date('H:i:sP')."</lastmod>\n" .
										 "    <changefreq>$freq</changefreq>\n" .
										 "  </url>\n");
					 $scanned[] = $url;
				}else{
					$duplicates[] = urldecode($url);
				}

			}
		}

		fwrite ($pf, "</urlset>\n");
		fclose ($pf);

		//Create a compressed version of sitemap.xml
		if(file_exists($file.'.gz'))
			unlink($file.'.gz');

			$data = implode("", file($file));
			$gzdata = gzencode($data, 9);
			$fp = fopen($file.".gz", "w");
			fwrite($fp, $gzdata);
			fclose($fp);


		$dupFileName = 'duplicates.txt';
		if(file_exists($dupFileName))
			unlink($dupFileName);

		if($duplicates){
			$dupFile = fopen ($dupFileName, "w");
			$i = 1;

			foreach ($duplicates as $duplicate) {
				fwrite ($dupFile, "<div class='col-sm-12'><p>$i. <a href='$duplicate' target='_blank'>$duplicate</a></p></div>");
				$i++;
			}
			fclose ($dupFile);
		}

		return true;
	}


	private function ror_generator() {
		$this->load->helper('custom');
		$file = 'ror.xml';
		$pf = fopen ($file, "w");
		if (!$pf)
			return;

		file_put_contents($file, "");
		$start_url = base_url();
		fwrite ($pf, "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n" .
					 "<rss version=\"2.0\" xmlns:ror=\"http://rorweb.com/0.1/\" >\n" .
					 "<channel>\n" .
					 "<title>ROR Sitemap for ".base_url()."</title>\n" .
					 "<link>".base_url()."</link>\n");


		//Start with home pages for each language
		$languages = $this->db->get('languages')->result();
		foreach ($languages as $language) {

			if($language->language_default == '1')
				$link = base_url();
			else
				$link = base_url($lagnuage->language_slug);

			$html = file_get_html($link);

			// Find all images
			foreach($html->find('title') as $element) {
			       $title = $element->plaintext;
					 }
		 foreach($html->find('meta') as $element) {
			       if($element->name == 'description')
						 $description = $element->content;

					 }


					 fwrite ($pf,			 "<item>\n" .
		 						 "    <link>$link</link>\n" .
		 						 "    <title>$title</title>\n" .
		 						 "    <description>$description</description>\n" .
		 						 "    <ror:updatePeriod></ror:updatePeriod>\n" .
		 						 "    <ror:sortOrder>0</ror:sortOrder>\n" .
		 						 "    <ror:resourceOf>sitemap</ror:resourceOf>\n" .
		 						 "  </item>\n");
		}




		//table name default prefix
		$types = [
			'posts' => 'post',
			'pages' => 'page',
			'post_categories' => 'post_category',
			'post_types' => 'post_type'
		];


		// Title comlumns
		$titleColumns = [
			'posts' => 'post_title',
			'pages' => 'page_title',
			'post_categories' => 'post_category_name',
			'post_types' => 'post_type_name'
		];

		$tables = ['posts', 'pages', 'post_types', 'post_categories'];
		foreach ($tables as $table) {
			$this->db->where($types[$table].'_index', 'Yes');
			$items[$table] = $this->db->get($table)->result();
		}

		$scanned = [];
		$duplicates = [];

		foreach ($items as $table => $value) {
			foreach ($value as $item) {

				//Url preparation
				$url = get_url( $types[$table] , $item->{$types[$table].'_id'} );
				$url = str_replace(base_url(), 'BASEURL', $url);
				$url = str_replace('/', '-tempslash-', $url);
				$url = urlencode($url);
				$url = str_replace('-tempslash-', '/', $url);
				$url = str_replace('BASEURL', base_url(),  $url);

				if(!in_array($url, $scanned)){
					fwrite ($pf,			 "<item>\n" .
 							 "    <link>$url</link>\n" );

					 $scanned[] = $url;
				}else{
					$duplicates[] = urldecode($url);
					continue;
				}

				//Title preparation
				fwrite ($pf, "    <title>".$item->{$types[$table].'_meta_title'}."</title>\n" .
						 "    <description>".$item->{$types[$table].'_meta_description'}."</description>\n" .
						 "    <ror:updatePeriod></ror:updatePeriod>\n" .
						 "    <ror:sortOrder>".rand(1, 3)."</ror:sortOrder>\n" .
						 "    <ror:resourceOf>sitemap</ror:resourceOf>\n" .
						 "  </item>\n");
			}
		}

		fwrite ($pf, "</channel>\n");
		fwrite ($pf, "</rss>");
		fclose ($pf);


		return true;
	}

}
