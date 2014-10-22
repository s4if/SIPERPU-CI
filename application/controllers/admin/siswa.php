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

    function index(){
        $this->cek_login();
        $data_siswa = $this->siswa->get_data();
        $data = [
            'filter' => 'empty/empty/0',
            'data_siswa' => $data_siswa,
            'navbar' => $this->navbar(['nav_location' => 'admin']),
            'sidenav' => $this->sidenav(),
            'header' => $this->header(['title' => 'Tabel Siswa']),
            'footer'=> $this->footer()
         ];
         $this->load->view("admin/siswa/index",$data);
    }
    
    public function tambah(){
        $this->cek_login();
        $data = [
            'navbar' => $this->navbar(['nav_location' => 'admin']),
            'sidenav' => $this->sidenav(),
            'header' => $this->header(['title' => 'Tambah Siswa']),
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
            'header' => $this->header(['title' => 'Edit Siswa']),
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
            redirect('admin/siswa/');
        }
    }
    
    public function import(){
        $this->cek_login();
        $fileUrl = $_FILES['file']["tmp_name"];
        $res = $this->siswa->import_data($fileUrl);
        if($res){
            $this->session->set_flashdata("notices",[0 => "Import Data Berhasil!"]);
            redirect('admin/siswa');
        } else {
            $this->session->set_flashdata("errors",[0 => "Import Data Gagal!"]);
            redirect('admin/siswa');
        }
    }
    
    public function filter(){
        $this->cek_login();
        $filter = [
            'kelas' => $_POST['kelas'],
            'jurusan' => $_POST['jurusan'],
            'paralel' => $_POST['paralel']
        ];
        $str_filter = $_POST['kelas']."/".$_POST['jurusan']."/".$_POST['paralel'];
        $data_siswa = $this->siswa->get_filtered_data($filter);
        $data = [
            'filter' => $str_filter,
            'data_siswa' => $data_siswa,
            'navbar' => $this->navbar(['nav_location' => 'admin']),
            'sidenav' => $this->sidenav(),
            'header' => $this->header(['title' => 'Tabel Siswa']),
            'footer'=> $this->footer()
         ];
         $this->load->view("admin/siswa/index",$data);
    }
    
    public function hapus_banyak($kelas = 'empty', $jurusan = 'empty', $paralel = '0'){
        $this->cek_login();
        $filter = [];
        if(empty($_POST['kelas'])){
            $filter = [
                'kelas' => $kelas,
                'jurusan' => $jurusan,
                'paralel' => $paralel
            ];
        }else{
            $filter = [
                'kelas' => $_POST['kelas'],
                'jurusan' => $_POST['jurusan'],
                'paralel' => $_POST['paralel']
            ];
        }
        $data_siswa = $this->siswa->get_filtered_data($filter);
        $data = [
            'data_siswa' => $data_siswa,
            'navbar' => $this->navbar(['nav_location' => 'admin']),
            'sidenav' => $this->sidenav(),
            'header' => $this->header(['title' => 'Tabel Siswa']),
            'footer'=> $this->footer()
         ];
         $this->load->view("admin/siswa/hapus",$data);
    }
    
    public function do_hapus_banyak(){
        $this->cek_login();
        $arr_nis = (isset($_POST['hapus']))?$_POST['hapus']:[];
        $res = $this->siswa->delete_many_data($arr_nis);
        if($res >= 1){
            $this->session->set_flashdata("notices",[0 => "Hapus Data Berhasil!"]);
            redirect('admin/siswa');
        } else {
            $this->session->set_flashdata("errors",[0 => "Hapus Data Gagal!"]);
            redirect('admin/siswa/');
        }
    }
}