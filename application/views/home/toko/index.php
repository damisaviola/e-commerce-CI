<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-tittle px-5"><span class="px-2">Data Toko</span></h2>
    </div>
    <div class="row px-xl-5">
    <div class="col px-xl-5">
    <?php 
                    if($this->session->flashdata('msg')!=""){
                    ?>
                    <div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      
                        <?php echo $this->session->flashdata('msg');?>
                    </div>
                    <?php
                    }
                ?>
        <a href="<?php echo site_url('toko/add');?>" class="btn btn-sm btn-info float-left">Tambah Toko</a> <br> <br>
        <table  class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Toko</th>
                    <th scope="col">Logo</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no=1;
                foreach($toko as $val) { ?>
                <tr>
                    <th scope="row"><?php echo $no; ?></th>
                    <td><?php echo $val->namaToko; ?></td>
                    <td><img src="<?php echo base_url('assets/logo_toko/'.$val->logo); ?>" width="150" height="150"></td>
                    <td><?php echo $val->deskripsi; ?></td>
                    <td><div class="btn-group" role="group" arial-label="Basic example">
                        <a href="<?php echo site_url('toko/get_by_id/'.$val->idToko);?>" class="btn btn-secondary">Edit</a>
                        <a href="<?php echo site_url('produk/index/' .$val->idToko); ?>" class="btn btn-secondary">Kelola Toko</a>
                        <a href="<?php echo site_url('toko/delete/'.$val->idToko);?>" onClick="return confirm('Yakin akan hapus data ini?')" class="btn btn-secondary">Delete</a>
                    </div>
                 </td>
                </tr>
                <?php $no++;
            } ?>
            </tbody>
        </table>
    </div>
    </div>
</div>