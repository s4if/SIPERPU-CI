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
class Guru extends MY_Controller {

    function __construct()
    {
      parent::__construct();
      $this->load->model("model_guru","guru");
    }

    function index()
    {
      if($this->session->userdata('logged_in'))
      {
          $data_guru = $this->guru->get_data();
          $data = [
              'data_guru' => $data_guru,
              'navbar' => $this->navbar(['nav_location' => 'admin']),
              'sidenav' => $this->sidenav(),
              'header' => $this->header(['title' => 'Tabel Guru']),
              'footer'=> $this->footer()
           ];
           $this->load->view("admin/guru/index",$data);
      }
      else
      {
        $this->session->set_flashdata("errors",[0 => "Akses Ditolak, Harap Login Dulu!"]);
        redirect('login', 'refresh');
      }
    }
    
    public function cek_login(){
        {
            if($this->session->userdata('logged_in'))
            {
                return;
            }
            else
            {
                $this->session->set_flashdata("errors",[0 => "Akses dihentikan, Harap Login Dulu!"]);
                redirect('login', 'refresh');
            }
         }
    }
  
    public function tambah(){
        $this->cek_login();
        $data = [
            'navbar' => $this->navbar(['nav_location' => 'admin']),
            'sidenav' => $this->sidenav(),
            'header' => $this->header(['title' => 'Tambah Guru']),
            'footer'=> $this->footer()
        ];
        $this->load->view("admin/guru/tambah",$data);
    }
    
    public function do_add(){
        $this->cek_login();
        $data_insert = $_POST;
        $data_insert['password'] = md5("qwerty");
        if($this->guru->data_exist($_POST['nip'])){
            $this->session->set_flashdata("errors",[0 => "Maaf, NIP yang dimasukkan sudah terpakai!"]);
            redirect('admin/guru/tambah');
        }else{
            $res = $this->guru->insert_data('guru', $data_insert);
            if($res >= 1){
                $this->session->set_flashdata("notices",[0 => "Tambah Data Berhasil!"]);
                redirect('admin/guru');
            } else {
                $this->session->set_flashdata("errors",[0 => "Tambah Data Gagal!"]);
                redirect('admin/guru/tambah');
            }
        }
    }
    
    public function edit($nip){
        $this->cek_login();
        $raw = $this->guru->get_data($nip);
        $data_guru = $raw[0];
        $data = [
            'guru' => $data_guru,
            'navbar' => $this->navbar(['nav_location' => 'admin']),
            'sidenav' => $this->sidenav(),
            'header' => $this->header(['title' => 'Edit Guru']),
            'footer'=> $this->footer()
        ];
        $this->load->view("admin/guru/edit",$data);
    }
    
    public function do_edit(){
        $this->cek_login();
        $nip = $_POST['nip'];
        $data_insert = $_POST;
        $res = $this->guru->update_data('guru', $data_insert, ['nip' => $nip]);
        if($res >= 1){
            $this->session->set_flashdata("notices",[0 => "Edit Data Berhasil!"]);
            redirect('admin/guru');
        } else {
            $this->session->set_flashdata("errors",[0 => "Edit Data Gagal!"]);
            redirect('admin/guru/edit/'.$nip);
        }
    }
    
    public function hapus($nip){
        $this->cek_login();
        $where = ['nip' => $nip];
        $res = $this->guru->delete_data('guru', $where);
        if($res >= 1){
            $this->session->set_flashdata("notices",[0 => "Hapus Data Berhasil!"]);
            redirect('admin/guru');
        } else {
            $this->session->set_flashdata("errors",[0 => "Hapus Data Gagal!"]);
            redirect('admin/guru/edit/'.$nip);
        }
    }
    
    public function import(){
        $fileUrl = $_FILES['file']["tmp_name"];
        $res = $this->guru->import_data($fileUrl);
        if($res){
            $this->session->set_flashdata("notices",[0 => "Import Data Berhasil!"]);
            redirect('admin/guru');
        } else {
            $this->session->set_flashdata("errors",[0 => "Import Data Gagal!"]);
            redirect('admin/guru');
        }
    }
}