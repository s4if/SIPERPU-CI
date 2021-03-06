<?php

/* 
 * The MIT License
 *
 * Copyright 2014 s4if.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentatideal
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
            </div>
            <div class="col-md-12">
                <a class="btn btn-sm btn-info" data-toggle="modal" data-target="#ModalSort">
                    Filter
                </a>
                <div class="modal fade" id="ModalSort" tabindex="-1" role="dialog" aria-labelledby="ModalSort" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="ModalImportLabel>">Urut Berdasarkan :</h4>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <form role="form form-inline" method="post" action="<?=base_url();?>admin/siswa/hapus_banyak">
                                        <div class="form-group col-xs-12">
                                            <div class="col-xs-4">
                                                <label class="control-label">
                                                    <small>Kelas - Jurusan - Paralel :</small>
                                                </label>
                                            </div>
                                            <div class="input-group-sm col-xs-3">
                                                <select class="form-control" name="kelas">
                                                    <option value="empty" >--</option>
                                                    <option value="X">X</option>
                                                    <option value="XI">XI</option>
                                                    <option value="XII">XII</option>
                                                </select>
                                            </div>
                                            <div class="input-group-sm col-xs-3">
                                                <select class="form-control" name="jurusan">
                                                    <option value="empty" >--</option>
                                                    <option value="AP" >AP</option>
                                                    <option value="AK">AK</option>
                                                    <option value="PM">PM</option>
                                                    <option value="RPL">RPL</option>
                                                </select>
                                            </div>
                                            <div class="input-group-sm col-xs-2">
                                                <input type="text" class="form-control" name="paralel" value="0">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-6">
                                                <button type="submit" class="btn btn-sm btn-primary">OK</button>
                                                <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                &MediumSpace;
            </div>
            <form action="<?=  base_url()?>admin/siswa/do_hapus_banyak" name="myForm" method="post">
                <div class="table-responsive col-md-12">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <td><input type="checkbox" onClick="pilih_semua()" title="Pilih Semua"/></td>
                                <td>NIS</td>
                                <td>Nama</td>
                                <td>P/L</td>
                                <td>Kelas</td>
                                <td>Jurusan</td>
                                <td>Paralel</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data_siswa as $siswa){?>
                            <tr>
                                <td><input type="checkbox" name="hapus[]" value="<?=$siswa['nis'];?>"/></td>
                                <td><?php echo $siswa['nis'];?></td>
                                <td><?php echo $siswa['nama'];?></td>
                                <td><?php echo $siswa['jenis_kelamin'];?></td>
                                <td><?php echo $siswa['kelas'];?></td>
                                <td><?php echo $siswa['jurusan'];?></td>
                                <td><?php echo $siswa['paralel'];?></td>
                            </tr>
                            <?php
                            }?>
                        </tbody>
                    </table>
                </div>
                <div class="btn-group col-md-12">
                    <input type="submit" name="proses" class="btn btn-sm btn-danger" value="Hapus" onclick="return konfirmasi()"/>
                    <input type="reset" class="btn btn-sm btn-warning" value="Batal" name="reset"/>
                </div>
            </form>=
        </div>
    </div>
</div>
<?=$footer?>