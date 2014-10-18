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

Class Model_rekap extends CI_Model
{
    public function get_rekap_harian($tanggal){
        $query = $this->db->query("SELECT siswa.kelas as 'out_kelas', 
            siswa.jurusan as 'out_jurusan', 
            siswa.paralel as 'out_paralel',
            (select count(absen.nis)  
            from absen right join siswa on absen.nis = siswa.nis 
            where absen.tanggal  = '".$tanggal."' and
            siswa.kelas = out_kelas and
            siswa.jurusan = out_jurusan and
            siswa.paralel = out_paralel
            group by kelas, jurusan, paralel
            ) as 'count'
            from absen right join siswa on absen.nis = siswa.nis
            group by kelas, jurusan, paralel");
        return $query->result_array();
    }
    
    public function get_rekap_mingguan($tanggal_awal, $tanggal_akhir){
        $query = $this->db->query("SELECT siswa.kelas as 'out_kelas', 
            siswa.jurusan as 'out_jurusan', 
            siswa.paralel as 'out_paralel',
            (select count(absen.nis)  
            from absen right join siswa on absen.nis = siswa.nis 
            where (absen.tanggal between '".$tanggal_awal."' and '".$tanggal_akhir."') and
            siswa.kelas = out_kelas and
            siswa.jurusan = out_jurusan and
            siswa.paralel = out_paralel
            group by kelas, jurusan, paralel
            ) as 'count'
            from absen right join siswa on absen.nis = siswa.nis
            group by kelas, jurusan, paralel");
        return $query->result_array();
    }
    
    public function get_rekap_bulanan($bulan, $tahun){
        $query = $this->db->query("SELECT siswa.kelas as 'out_kelas', 
            siswa.jurusan as 'out_jurusan', 
            siswa.paralel as 'out_paralel',
            (select count(absen.nis)  
            from absen right join siswa on absen.nis = siswa.nis 
            where  month(absen.tanggal) = '".$bulan."' and 
            year(absen.tanggal) = '".$tahun."' and
            siswa.kelas = out_kelas and
            siswa.jurusan = out_jurusan and
            siswa.paralel = out_paralel
            group by kelas, jurusan, paralel
            ) as 'count'
            from absen right join siswa on absen.nis = siswa.nis
            group by kelas, jurusan, paralel");
        return $query->result_array();
    }
    
}
