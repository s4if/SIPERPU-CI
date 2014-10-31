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
<div class="container" style="margin-top:30px">
    <div class="col-md-4 col-md-offset-4">
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
        <div class="panel panel-primary">
            <div class="panel-heading"><h3 class="panel-title"><strong>Silahkan Login</strong></h3></div>
            <div class="panel-body">
                <?php echo validation_errors(); ?>
                <?php echo form_open('verify_login'); ?>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="NIP" name="nip" value="<?php echo isset($data['nip'])? $data['nip']:'';?>" required="true">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" name="password" required="true">
                    </div>
                    <button type="submit" class="btn btn-sm btn-default col-xs-4">Masuk</button>
                    <a href="<?= base_url()."presensi/"?>" class="btn btn-sm btn-warning col-xs-6 col-xs-offset-2">Halaman Presensi</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $footer ?>