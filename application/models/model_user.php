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

Class Model_user extends CI_Model
{
    function login($nip, $password)
    {
        $this -> db -> select('nip, nama, password');
        $this -> db -> from('guru');
        $this -> db -> where('nip = ' . "'" . $nip . "'"); 
        $this -> db -> where('password = ' . "'" . MD5($password) . "'"); 
        $this -> db -> limit(1);

        $query = $this -> db -> get();

        if($query -> num_rows() == 1)
        {
            return $query->result();
        }
        else
        {
            return false;
        }

    }
            
    function check_password($nip, $passwd){
        $data = $this->db->query("select password from guru Where nip = '".$nip."'");
        $stored_passwd =  $data->row()->password;
        return (md5($passwd) === $stored_passwd)? true : false;
    }
            
    function update_password($nip, $passwd){
        $res = $this->db->update("guru", ['password' => md5($passwd)],['nip' => $nip]);
        return $res;
    }
}