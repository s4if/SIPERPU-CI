<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user
 *
 * @author s4if
 */

Class Model_siswa extends CI_Model
{
    public function get_data($nis = "Empty"){
        $where = ($nis === "Empty")?"":"Where nis = ".$nis;
        $data = $this->db->query("select * from siswa ".$where);
        return $data->result_array();
    }
    
    public function insert_data($table_name, $data){
        $res = $this->db->insert($table_name, $data);
        return $res;
    }
    
    public function update_data($table_name, $data,$where){
        $res = $this->db->update($table_name, $data,$where);
        return $res;
    }
    
    public function delete_data($table_name, $where){
        $res = $this->db->delete($table_name, $where);
        return $res;
    }
    
    public function data_exist($nis) {
        $query = $this->db->query("SELECT * FROM siswa where nis ='".$nis."';");
        $rows = $query->num_rows();
        if($rows == 1){
            return true;
        }else{
            return false;
        }
    }
    
    public function import_data($file_url){
        $objPHPExcel = PHPExcel_IOFactory::load($file_url);
        $objWorksheet = $objPHPExcel->getActiveSheet();
        $i = 0;
        $this->db->trans_start();
        foreach ($objWorksheet->getRowIterator() as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(true);
            if($i>0){
                $row_data = $this->get_row_data($cellIterator);
                $this->db->query("REPLACE INTO siswa (nis, nama, jenis_kelamin, kelas, jurusan, paralel) "
                        . "VALUES ('".$row_data['nis']."', '".$row_data['nama']."', '"
                        .$row_data['jenis_kelamin']."', '" .$row_data['kelas']."', '"
                        .$row_data['jurusan']."', '".$row_data['paralel']."')");
            }
            $i++;
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            return false;
        }  else {
            return true;
        }
    }
    
    public function delete_many_data($arr_nis){
        $this->db->trans_start();
        foreach ($arr_nis as $nis) {
            $where = ['nis' => $nis];
            $this->db->delete('siswa', $where);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            return false;
        }  else {
            return true;
        }
    }
    
    private function get_row_data($cellIterator){
        $field_name = [
            0 => 'nis',
            1 => 'nama',
            2 => 'jenis_kelamin',
            3 => 'kelas',
            4 => 'jurusan',
            5 => 'paralel'
        ];
        $row_data = [];
        $j = 0;
        foreach ($cellIterator as $cell) {
            $row_data[$field_name[$j]] = $cell->getValue();
            $j++;
        }
        return $row_data;
    }
    
    public function get_filtered_data($params){
        $where = [];
        if($params['paralel'] === '0' && $params['jurusan'] === 'empty' &&  !($params['kelas'] === 'empty') ){
            $where = ['kelas' => $params['kelas']];
        }elseif ($params['paralel'] === '0' && $params['kelas'] === 'empty' &&  !($params['jurusan'] === 'empty')) {
            $where = ['jurusan' => $params['jurusan']];
        }elseif ($params['paralel'] === '0' && !($params['jurusan'] === 'empty') && !($params['kelas'] === 'empty')) {
            $where = ['kelas' => $params['kelas'], 'jurusan' => $params['jurusan']];
        }elseif ($params['kelas'] === 'empty' && !($params['jurusan'] === 'empty') && !($params['paralel'] === '0')) {
            $where = ['jurusan' => $params['jurusan'], 'paralel' => $params['paralel']];
        }elseif(!($params['paralel'] === '0') && !($params['jurusan'] === 'empty') && !($params['kelas'] === 'empty')){
            $where = ['kelas' => $params['kelas'], 'jurusan' => $params['jurusan'], 'paralel' => $params['paralel']];
        }else{
            
        }
        $query = $this->db->get_where("siswa",$where);
        return $query->result_array();
    }
}