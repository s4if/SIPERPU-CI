<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Verify_login extends MY_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->model('user','',TRUE);
  }

  function index()
  {
    //This method will have the credentials validation
    $this->load->library('form_validation');

    $this->form_validation->set_rules('nip', 'nip', 'trim|required|xss_clean');
    $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
	
    if($this->form_validation->run() == FALSE)
    {
        //Field validation failed.  User redirected to login page
        $data = [
            'header' => $this->header(['title' => 'Login SIPERPU']),
            'footer'=> $this->footer()
        ];
        $this->load->view("login/index",$data);
    }
    else
    {
      //Go to private area
      redirect('admin/home', 'refresh');
    }
    
  }
  
  function check_database($password)
  {
    //Field validation succeeded.  Validate against database
    $nip = $this->input->post('nip');
    
    //query the database
    $result = $this->user->login($nip, $password);
    
    if($result)
    {
      $sess_array = array();
      foreach($result as $row)
      {
        $sess_array = array(
          'nip' => $row->nip,
          'nama' => $row->nama
        );
        $this->session->set_userdata('logged_in', $sess_array);
      }
      return TRUE;
    }
    else
    {
      $this->form_validation->set_message('check_database', 'NIP atau Password Salah!');
      return false;
    }
  }
}