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

?>
<?=$header?>
<?=$navbar?>
<div class="container-fluid">
    <div class="row">
        <?php if(empty($this->session->flashdata('notices')) === false){
            ?>
        <div class="alert alert-success alert-dismissible">
        <?php
            echo '<button type="button" class="close" data-dismiss="alert"><p>' . 
                    '<span aria-hidden="true">&times;</span><span class="sr-only">'.
                    'Close</span></button>'.
                    implode('</p><p>', $this->session->flashdata('notices')) . '</p>';	
            ?>
        </div>
        <?php
        }
        if(empty($this->session->flashdata('errors')) === false){
            ?>
        <div class="alert alert-warning alert-dismissible">
        <?php
            echo '<button type="button" class="close" data-dismiss="alert"><p>' . 
                    '<span aria-hidden="true">&times;</span><span class="sr-only">'.
                    'Close</span></button>'.
                    implode('</p><p>', $this->session->flashdata('errors')) . '</p></span></button>';	
            ?>
        </div>
        <?php
        } ?>
    </div>
    <div class="row">
        <div class="panel panel-info col-md-offset-4 col-md-4">
            <div class="panel-heading">
                <h3><p class="text-center">Data diri</p></h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal">
                    <div class="form-group error">
                        <label class="col-sm-3 control-label">NIS :</label>
                        <div class="col-sm-6">
                            <p class="form-control-static"><?=$siswa['nis'];?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nama :</label>
                        <div class="col-sm-6">
                            <p class="form-control-static"><?=$siswa['nama'];?></p>
                        </div>
                    </div>
                    <!-- -->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">P/L :</label>
                        <div class="col-sm-5">
                            <p class="form-control-static"><?=$siswa['jenis_kelamin'];?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kelas :</label>
                        <div class="col-sm-5">
                            <p class="form-control-static"><?=$siswa['kelas'];?>-<?=$siswa['jurusan'];?>-<?=$siswa['paralel'];?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-6">
                            <a class="btn btn-sm btn-primary" 
                               href="<?=base_url();?>presensi/konfirmasi/<?=$siswa['nis'];?>">OK</a>
                            <a class="btn btn-sm btn-warning" href="<?=base_url();?>presensi/index">Batal</a>
                        </div>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>
<?=$footer?>