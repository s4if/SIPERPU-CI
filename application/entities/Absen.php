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
 * Description of Absen
 *
 * @author s4if
 */

/**
 * @Entity @Table(name="absen")
 */
class Absen {

    /**
     * @Id @Column(type="integer") @GeneratedValue(strategy="IDENTITY")
     **/
    protected $id;

    /**
     * @Column(type="date")
     **/
    protected $tanggal;

    /**
     * @Column(type="time")
     **/
    protected $waktu;

    /**
     * @ManyToMany(targetEntity="Siswa")
     * @JoinTable(name="siswa_absen",
     * joinColumns={@JoinColumn(name="absen_id", referencedColumnName="id")},
     * inverseJoinColumns={@JoinColumn(name="siswa_nis", referencedColumnName="nis", unique=true)})
     **/
    protected $siswa;

    public function getId() {
        return $this->id;
    }

    public function getTanggal() {
        return $this->tanggal;
    }

    public function getWaktu() {
        return $this->waktu;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setTanggal($tanggal) {
        $this->tanggal = $tanggal;
    }

    public function setWaktu($waktu) {
        $this->waktu = $waktu;
    }

}
