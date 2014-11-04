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
 * Description of MY_Controller
 *
 * @author s4if
 */

// Same as bootstrap.php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class MY_Controller extends CI_Controller {
    
    protected $em;
            
    function __construct()
    {
        parent::__construct();
        //--------------------------------------------------------------------//
        // This MUST be SAME with bootstrap.php
        $isDevMode = true;
        $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/application/entities/"), $isDevMode);
        $conn = array(
            'driver'   => 'pdo_mysql',
            'user'     => 'root',
            'password' => 'zaraki',
            'dbname'   => 'siperpu_2',
        );

        // obtaining the entity manager
        $this->em = EntityManager::create($conn, $config);
    }
    
    public function header($data = []){
        return $this->load->view("core/header", $data, TRUE);
    }
    
    public function footer($data = []){
        return $this->load->view("core/footer", $data, true);
    }
    
    public function navbar($data = []){
        return $this->load->view("core/navbar", $data, true);
    }
    
    public function sidenav($data = []){
        return $this->load->view("core/sidenav", $data, true);
    }
    
    public function cek_login(){
        if($this->session->userdata('logged_in'))
        {
            return;
        }
        else
        {
            $this->session->set_flashdata("errors",[0 => "Akses dihentikan, Harap Login Dulu!"]);
            redirect('login', 'refresh');
        }
    }
}
