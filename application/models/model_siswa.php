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
}