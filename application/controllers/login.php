<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login
 *
 * @author s4if
 */
session_start();
class login extends MY_Controller {
    public function index(){
        if($this->session->userdata('logged_in'))
        {
            redirect('admin/home', 'refresh');
        }
        else
        {
            $this->load->helper('form');
            $data = [
                'header' => $this->header(['title' => 'Login SIPERPU']),
                'footer'=> $this->footer()
            ];
            $this->load->view("login/index",$data);
        }
        
    }
    
}
