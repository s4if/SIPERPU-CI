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
class Presensi extends MY_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->model("model_presensi","presensi");
    $this->load->model("model_siswa","siswa");
  }

    function index()
    {
        $this->session->unset_userdata('logged_in');
        session_destroy();
        $tanggal = date('l, d M Y');
        $waktu = date("H:i:s");
        $data_siswa = $this->presensi->fetch(date("Y/m/d"));
        $data = [
            'tanggal' => $tanggal,
            'waktu' => $waktu,
            'data_siswa' => $data_siswa,
            'navbar' => $this->navbar(['nav_location' => 'presensi']),
            'sidenav' => $this->sidenav(),
            'header' => $this->header(['title' => 'Laman Presensi']),
            'footer'=> $this->footer()
        ];
        $this->load->view("presensi/index",$data);
    }
    
    public function tambah(){
        $nis = $_POST['nis'];
        $tanggal = date('l, d M Y');
        $waktu = date("H:i:s");
        $ada = $this->siswa->data_exist($nis);
        if($ada){
            $data_siswa = $this->siswa->get_data($nis);
            $data = [
                'tanggal' => $tanggal,
                'waktu' => $waktu,
                'siswa' => $data_siswa[0],
                'navbar' => $this->navbar(['nav_location' => 'presensi']),
                'sidenav' => $this->sidenav(),
                'header' => $this->header(['title' => 'Laman Presensi']),
                'footer'=> $this->footer()
            ];
            $this->load->view("presensi/tambah",$data);
        }  else {
            $error = "Maaf, siswa dengan NIS : ".$nis." Tidak terdaftar. </br>"
                    . "Mohon periksa kembali NIS yang dimasukkan dan pastikan anda telah terdaftar.";
            $data = [
                'errors' => $error,
                'navbar' => $this->navbar(['nav_location' => 'presensi']),
                'sidenav' => $this->sidenav(),
                'header' => $this->header(['title' => 'Laman Presensi']),
                'footer'=> $this->footer()
            ];
            $this->load->view("presensi/error",$data);
        }
    }
    
    public function konfirmasi($nis){
        $tgl_input = date("Y-m-d");
        $waktu = date("H:i:s");
        $insert = [
            'nis' => $nis,
            'tanggal' => $tgl_input,
            'waktu' => $waktu
        ];
        
        if($this->presensi->data_exist($nis, $tgl_input)){
            $this->session->set_flashdata("errors",[0 => "Maaf, Anda sudah presensi hari ini.."]);
            redirect('presensi/index');
        }else{
            $res = $this->presensi->insert_data("absen",$insert);
            if($res >= 1){
                $this->session->set_flashdata("notices",[0 => "Presensi Berhasil!"]);
                redirect('presensi/index');
            } else {
                $this->session->set_flashdata("errors",[0 => "Presensi Gagal!"]);
                redirect('presensi/index');
            }
        }
    }
    
    public function hapus($nis){
        $tgl_input = date("Y-m-d");
        $where = ['nis' => $nis, 'tanggal' => $tgl_input];
        $res = $this->presensi->delete_data('absen', $where);
        if($res >= 1){
            $this->session->set_flashdata("notices",[0 => "Hapus Data Berhasil!"]);
            redirect('presensi/index');
        } else {
            $this->session->set_flashdata("errors",[0 => "Hapus Data Gagal!"]);
            redirect('presensi/index'.$nis);
        }
    }
    
    public function cari(){
        $nama = $_POST['nama'];
        $data_siswa = $this->presensi->search($nama);
        $data = [
            'data_siswa' => $data_siswa,
            'navbar' => $this->navbar(['nav_location' => 'presensi']),
            'sidenav' => $this->sidenav(),
            'header' => $this->header(['title' => 'Laman Presensi']),
            'footer'=> $this->footer()
        ];
        $this->load->view("presensi/cari",$data);
    }
}