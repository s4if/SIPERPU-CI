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
 * Description of Siswa
 *
 * @author s4if
 */

/**
 * @Entity @Table(name="siswa")
 */
class Siswa {
    
    /**
     * @Id @Column(type="string", length=15) 
     * @OneToMany(targetEntity="Absen", mappedBy="nis_siswa")
     **/
    protected $nis;

    /**
     * @Column(type="string", length=45)
     **/
    protected $nama;
    
    /**
     * @Column(type="string", length=4)
     **/
    protected $kelas;
    
    /**
     * @Column(type="string", length=4)
     **/
    protected $jurusan;
    
    /**
     * @Column(type="integer")
     **/
    protected $paralel;
    
    /**
     * @Column(type="string", length=2)
     **/
    protected $jenis_kelamin;
    
    /**
     * 
     * @OneToMany(targetEntity="Absen", mappedBy="nis_siswa")
     **/
    protected $absen_siswa;
    
    public function getNis() {
        return $this->nis;
    }

    public function getNama() {
        return $this->nama;
    }

    public function getKelas() {
        return $this->kelas;
    }

    public function getJurusan() {
        return $this->jurusan;
    }

    public function getParalel() {
        return $this->paralel;
    }

    public function getJenis_kelamin() {
        return $this->jenis_kelamin;
    }

    public function setNis($nis) {
        $this->nis = $nis;
    }

    public function setNama($nama) {
        $this->nama = $nama;
    }

    public function setKelas($kelas) {
        $this->kelas = $kelas;
    }

    public function setJurusan($jurusan) {
        $this->jurusan = $jurusan;
    }

    public function setParalel($paralel) {
        $this->paralel = $paralel;
    }

    public function setJenis_kelamin($jenis_kelamin) {
        $this->jenis_kelamin = $jenis_kelamin;
    }
    
}
