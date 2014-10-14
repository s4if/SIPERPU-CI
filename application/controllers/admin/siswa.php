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
class Siswa extends MY_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->model("model_siswa","siswa");
  }

  function index()
  {
    if($this->session->userdata('logged_in'))
    {
        $data_siswa = $this->siswa->get_data();
        $data = [
            'data_siswa' => $data_siswa,
            'navbar' => $this->navbar(['nav_location' => 'admin']),
            'sidenav' => $this->sidenav(),
            'header' => $this->header(['title' => 'Tabel Guru']),
            'footer'=> $this->footer()
         ];
         $this->load->view("admin/siswa/index",$data);
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
                $this->session->set_flashdata("errors",[0 => "Akses Ditolak, Harap Login Dulu!"]);
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
        $this->load->view("admin/siswa/tambah",$data);
    }
    
    public function do_add(){
        $this->cek_login();
        $data_insert = $_POST;
        if($this->siswa->data_exist($_POST['nis'])){
            $this->session->set_flashdata("errors",[0 => "Maaf, NIS yang dimasukkan sudah terpakai!"]);
            redirect('admin/siswa/tambah');
        }else{
            $res = $this->siswa->insert_data('siswa', $data_insert);
            if($res >= 1){
                $this->session->set_flashdata("notices",[0 => "Tambah Data Berhasil!"]);
                redirect('admin/siswa');
            } else {
                $this->session->set_flashdata("errors",[0 => "Tambah Data Gagal!"]);
                redirect('admin/siswa/tambah');
            }
        }
    }
    
    public function edit($nis){
        $this->cek_login();
        $raw = $this->siswa->get_data($nis);
        $data_siswa = $raw[0];
        $data = [
            'siswa' => $data_siswa,
            'navbar' => $this->navbar(['nav_location' => 'admin']),
            'sidenav' => $this->sidenav(),
            'header' => $this->header(['title' => 'Edit Guru']),
            'footer'=> $this->footer()
        ];
        $this->load->view("admin/siswa/edit",$data);
    }
    
    public function do_edit(){
        $this->cek_login();
        $nis = $_POST['nis'];
        $data_insert = $_POST;
        $res = $this->siswa->update_data('siswa', $data_insert, ['nis' => $nis]);
        if($res >= 1){
            $this->session->set_flashdata("notices",[0 => "Edit Data Berhasil!"]);
            redirect('admin/siswa');
        } else {
            $this->session->set_flashdata("errors",[0 => "Edit Data Gagal!"]);
            redirect('admin/siswa/edit/'.$nis);
        }
    }
    
    public function hapus($nis){
        $this->cek_login();
        $where = ['nis' => $nis];
        $res = $this->siswa->delete_data('siswa', $where);
        if($res >= 1){
            $this->session->set_flashdata("notices",[0 => "Hapus Data Berhasil!"]);
            redirect('admin/siswa');
        } else {
            $this->session->set_flashdata("errors",[0 => "Hapus Data Gagal!"]);
            redirect('admin/siswa/edit/'.$nis);
        }
    }
}