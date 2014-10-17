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
class Rekap extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('model_rekap','rekap');
    }

    function index(){
        $this->harian(date("Y-m-d"));
    }
    
    function harian($tanggal){
        $this->cek_login();
        if($tanggal === "null"){
            $tanggal = date("Y-m-d");
        }
        $data_siswa = $this->rekap->get_rekap_harian($tanggal);
        $data = [
            'tanggal' => $tanggal,
            'data_siswa' => $data_siswa,
            'navbar' => $this->navbar(['nav_location' => 'admin']),
            'sidenav' => $this->sidenav(),
            'header' => $this->header(['title' => 'Tabel Rekap Harian']),
            'footer'=> $this->footer()
         ];
         $this->load->view("admin/rekap/harian",$data);
    }
    
    public function redir_harian(){
        $url = $_POST['url'];
        $param = $_POST['param'];
        $params = explode("/", $param);
        $tanggal = $params[0]."-".$params[1]."-".$params[2];
        redirect('admin/rekap/'.$url."/".$tanggal, 'refresh');
    }
    
    public function export_harian(){
        $this->cek_login();
        $tanggal = $_POST['tanggal'];
        $data = $this->rekap->get_rekap_harian($tanggal);
        $this->export($data, $_POST['filename']);
    }
    
    private function export($data, $file_name){
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $rowCount = 1;
        $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, 'No');
        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, 'Kelas'); 
        $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, 'Jurusan');
        $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, 'Paralel');
        $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, 'Jumlah');
        $rowCount++;
        foreach ($data as $row){
            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $rowCount-1);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $row['out_kelas']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $row['out_jurusan']); 
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $row['out_paralel']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, ($row['count']==null)?0:$row['count']);
            $rowCount++;
        }
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$file_name.'.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save('php://output');
        exit;
    }
}