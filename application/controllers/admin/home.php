<?php

/* 
 * The MIT License
 *
 * Copyright 2014 s4if.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Home extends MY_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('model_user','user');
    }

    function index(){
        if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            $data = [
                'name' => $session_data['nama'],
                'navbar' => $this->navbar(['nav_location' => 'admin']),
                'sidenav' => $this->sidenav(),
                'header' => $this->header(['title' => 'Beranda Admin']),
                'footer'=> $this->footer()
             ];
             $this->load->view("admin/index",$data);
        }
        else
        {
            redirect('login', 'refresh');
        }
        
    }
  
    function logout(){
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('admin/home', 'refresh');
    }
  
    public function password(){
        $this->cek_login();
        $data = [
            'navbar' => $this->navbar(['nav_location' => 'admin']),
            'sidenav' => $this->sidenav(),
            'header' => $this->header(['title' => 'Ganti Password']),
            'footer'=> $this->footer()
        ];
        $this->load->view("admin/edit_passwd",$data);
        
    }
  
    public function ch_passwd(){
        $this->cek_login();
        $strd_passwd = $this->input->post('stored_password', TRUE);
        $new_passwd = $this->input->post('new_password', TRUE);
        $co_passwd = $this->input->post('confirm_password', TRUE);
        if($new_passwd === $co_passwd){
            $sess_data = $this->session->userdata('logged_in');
            $nip = $sess_data['nip'];
            if($this->user->check_password($nip,$strd_passwd)){
                $this->excecute_passwd($nip, $new_passwd);
            }else{
                $this->session->set_flashdata("errors",[0 => "Maaf, Password lama anda salah. Silahkan cek kembali!"]);
                redirect('admin/home/password', 'refresh');
            }
        }else{
            $this->session->set_flashdata("errors",[0 => "Maaf, Password baru dan konfirmasi password tidak sama. Silahkan cek kembali!"]);
            redirect('admin/home/password', 'refresh');
        }
    }
    
    private function excecute_passwd($nip, $new_passwd){
        $res = $this->user->update_password($nip, $new_passwd);
        if($res){
            $this->session->set_flashdata("notices",[0 => "Password sudah berhasil diganti."]);
                redirect('admin/home', 'refresh');
        }else{
            $this->session->set_flashdata("errors",[0 => "Maaf, Password lama anda salah. Silahkan cek kembali!"]);
            redirect('admin/home/password', 'refresh');
        }
    }
}