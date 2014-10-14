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

/**
 * Description of model_presensi
 *
 * @author s4if
 */
class model_presensi extends CI_Model {
    //put your code here
    public function fetch($tanggal){
        $str_query = "select siswa.nis as 'nis', "
                . "siswa.nama as 'nama', siswa.kelas as 'kelas', "
                . "siswa.jurusan as 'jurusan', "
                . "siswa.paralel as 'paralel', "
                . "siswa.jenis_kelamin as 'jenis_kelamin' "
                . "from siswa cross join absen using (nis) "
                . "where absen.tanggal = '".$tanggal."' order by absen.waktu asc;";
        $data = $this->db->query($str_query);
        return $data->result_array();
    }
    
    public function insert_data($table_name, $data){
        $res = $this->db->insert($table_name, $data);
        return $res;
    }
    
    public function delete_data($table_name, $where){
        $res = $this->db->delete($table_name, $where);
        return $res;
    }
    
    public function data_exist($nis, $tanggal) {
        $query = $this->db->query("SELECT * FROM absen where nis ='".$nis."' and tanggal = '".$tanggal."'");
        $rows = $query->num_rows();
        if($rows == 1){
            return true;
        }else{
            return false;
        }
    }
    
    public function search($name){
        $strquery = "SELECT * FROM siswa where siswa.nama like '%".$name."%'";
        $query = $this->db->query($strquery);
        return $query->result_array();
    }
}
