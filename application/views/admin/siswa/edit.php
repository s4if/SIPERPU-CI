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
        <div class="col-md-2">
            <?=$sidenav?>
        </div>
        <div class="col-md-10">
            <div class="container-fluid">
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
                <form class="form-horizontal" role="form" method="post" action="<?=base_url();?>admin/siswa/do_edit">
                    <div class="form-group error">
                        <label class="col-sm-3 control-label">NIS :</label>
                        <div class="col-sm-6 error">
                            <input type="text" class="form-control" name="nis" 
                                   placeholder="Masukkan NIS" value="<?=$siswa['nis']?>" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nama :</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="nama" 
                                   placeholder="Masukkan Nama" value="<?=$siswa['nama']?>" required="true">
                        </div>
                    </div>
                    <!-- -->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Jenis Kelamin :</label>
                        <div class="col-sm-5">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="jenis_kelamin" value="L" <?php 
                                    if(!empty($siswa['jenis_kelamin'])){
                                        if($siswa['jenis_kelamin']=='L'){
                                            echo 'checked';
                                        }
                                    }
                                    ?>>
                                    Laki - Laki
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="jenis_kelamin" value="P" <?php 
                                    if(!empty($siswa['jenis_kelamin'])){
                                        if($siswa['jenis_kelamin']=='P'){
                                            echo 'checked';
                                        }
                                    }
                                    ?>>
                                    Perempuan
                                </label>
                            </div>
                        </div>
                </div>
                <div class="form-group error">
                    <label class="col-sm-3 control-label">Kelas - Jurusan - Paralel :</label>
                    <div class="col-sm-2">
                        <select class="form-control" name="kelas">
                            <option value="X" <?php 
                                    if(!empty($siswa['kelas'])){
                                        if($siswa['kelas']=='X'){
                                            echo 'selected="true"';
                                        }
                                    }
                                    ?>>X</option>
                            <option value="XI" <?php 
                                    if(!empty($siswa['kelas'])){
                                        if($siswa['kelas']=='XI'){
                                            echo 'selected="true"';
                                        }
                                    }
                                    ?>>XI</option>
                            <option value="XII" <?php 
                                    if(!empty($siswa['kelas'])){
                                        if($siswa['kelas']=='XII'){
                                            echo'selected="true"';
                                        }
                                    }
                                    ?>>XII</option>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <select class="form-control" name="jurusan">
                            <option value="AP" <?php 
                                    if(!empty($siswa['jurusan'])){
                                        if($siswa['jurusan']=='AP'){
                                            echo 'selected="true"';
                                        }
                                    }
                                    ?>>AP</option>
                            <option value="AK" <?php 
                                    if(!empty($siswa['jurusan'])){
                                        if($siswa['jurusan']=='AK'){
                                            echo 'selected="true"';
                                        }
                                    }
                                    ?>>AK</option>
                            <option value="PM" <?php 
                                    if(!empty($siswa['jurusan'])){
                                        if($siswa['jurusan']=='PM'){
                                            echo 'selected="true"';
                                        }
                                    }
                                    ?>>PM</option>
                            <option value="RPL" <?php 
                                    if(!empty($siswa['jurusan'])){
                                        if($siswa['jurusan']=='RPL'){
                                            echo 'selected="true"';
                                        }
                                    }
                                    ?>>RPL</option>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="paralel" 
                               value="<?=$siswa['paralel']?>" required="true">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-6">
                        <button type="submit" class="btn btn-sm btn-primary">OK</button>
                        <a class="btn btn-sm btn-warning" href="<?=base_url();?>admin/siswa/index/">Cancel</a>
                    </div>
                </div>
            </form>  
        </div>
    </div>
</div>
</div>
</div>
<?=$footer?>