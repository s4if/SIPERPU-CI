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

Class Model_guru extends CI_Model
{
    public function get_data($nip = "Empty"){
        $where = ($nip === "Empty")?"":"Where nip = ".$nip;
        $data = $this->db->query("select * from guru ".$where);
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
    
    public function data_exist($nip) {
        $query = $this->db->query("SELECT * FROM guru where nip ='".$nip."';");
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
                $this->db->query("REPLACE INTO guru (nip, nama, jenis_kelamin, password) "
                        . "VALUES ('".$row_data['nip']."', '".$row_data['nama']."', '".$row_data['jenis_kelamin']."', '".  md5('qwerty')."')");
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
    
    private function get_row_data($cellIterator){
        $field_name = [
            0 => 'nip',
            1 => 'nama',
            2 => 'jenis_kelamin'
        ];
        $row_data = [];
        $j = 0;
        foreach ($cellIterator as $cell) {
            $row_data[$field_name[$j]] = $cell->getValue();
            $j++;
        }
        return $row_data;
    }
}