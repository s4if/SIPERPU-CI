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
            <h2>Selamat datang : <?=$name ?></h2>
        </div>
    </div>
</div>
<?=$footer?>