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
            </div>
            <div class="col-sm-11 col-sm-offset-1">
                Rekap Semester : <?=$semester?> - <?=$tahun?> &MediumSpace;
                <a class="btn btn-sm btn-default" data-toggle="modal" data-target="#ModalSort">
                    <span class="glyphicon glyphicon-calendar"></span>
                    Ubah Semester
                </a>
                <form class="form-inline" name="myform" action="<?=base_url();?>admin/rekap/export_semester" method="POST">
                    <input type="hidden" name="semester" value="<?=$semester?>">
                    <input type="hidden" name="tahun" value="<?=$tahun?>">
                    <input type="hidden" name="filename" value="rekap-Semester-<?=$semester?>-<?=$tahun?>">
                       <a class="btn btn-sm btn-info" onclick="document.myform.submit()">
                    Export</a>
                </form>
                <div class="modal fade" id="ModalSort" tabindex="-1" role="dialog" aria-labelledby="ModalSort" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="ModalImportLabel>">Urut Berdasarkan :</h4>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <form role="form form-inline" method="post" action="<?=base_url();?>admin/rekap/redir_semester">
                                        <div class="form-group col-xs-12">
                                            <div class="col-xs-3">
                                                <label class="control-label">
                                                    <small>Semester : </small>
                                                </label>
                                            </div>
                                            <div class="input-group-sm col-xs-4">
                                                <select class="form-control" name="semester">
                                                    <option value="Ganjil">Ganjil</option>
                                                    <option value="Genap">Genap</option>
                                                </select>
                                                <input type="text" class="form-control hidden" name="url" value="semester">
                                            </div>
                                            <div class="col-xs-2">
                                                <label class="control-label">
                                                    <small>Tahun : </small>
                                                </label>
                                            </div>
                                            <div class="input-group-sm col-xs-3">
                                                <input type="text" class="form-control" name="tahun" value="<?=$tahun;?>">
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
            <div class=" col-sm-10 col-sm-offset-1">
                <table class="row-border" cellspacing="0" width="94%" id="data_table">
                    <thead>
                        <tr>
                            <td>Kelas</td>
                            <td>Jurusan</td>
                            <td>Paralel</td>
                            <td>Jumlah Siswa Hadir</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($data_siswa as $siswa){?>
                        <tr>
                        <td><?php echo $siswa['out_kelas'];?></td>
                        <td><?php echo $siswa['out_jurusan'];?></td>
                        <td><?php echo $siswa['out_paralel'];?></td>
                        <td><?php echo ($siswa['count'] === NULL)? 0:$siswa['count'];?></td>
                        </tr>
                        <?php
                        }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#data_table').dataTable({
            "scrollY":        "400px",
            "scrollCollapse": true,
            "paging":         false
        });
    } );
</script>
<?=$footer?>
