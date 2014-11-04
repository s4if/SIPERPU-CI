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
 * Description of Guru
 *
 * @author s4if
 */

/**
 * @Entity @Table(name="guru")
 */
class Guru {
    
    /**
     * @Id @Column(type="string", length=15)
     **/
    protected $nip;

    /**
     * @Column(type="string", length=45)
     **/
    protected $nama;

    /**
     * @Column(type="string", length=512)
     **/
    protected $password;
    
    /**
     * @Column(type="string", length=1)
     **/
    protected $jenis_kelamin;
    
    public function getNip() {
        return $this->nip;
    }

    public function getNama() {
        return $this->nama;
    }

    public function checkPassword($password) {
        return ($this->password === $password);
    }

    public function getJenis_kelamin() {
        return $this->jenis_kelamin;
    }

    public function setNip($nip) {
        $this->nip = $nip;
    }

    public function setNama($nama) {
        $this->nama = $nama;
    }

    public function setPassword($password) {
        $this->password = md5($password);
    }

    public function setJenis_kelamin($jenis_kelamin) {
        $this->jenis_kelamin = $jenis_kelamin;
    }
    
}
