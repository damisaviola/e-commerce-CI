<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-tittle px-5"><span class="px-2">Data Produk</span></h2>
    </div>
    <div class="row px-xl-5">
        <div class="col-lg-12 mb-5">
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
            <a href="<?php echo site_url('produk/add/' .$idToko);?>" class="btn btn-sm btn-info float-left">Tambah Produk</a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Foto</th>
                        <th scope="col">harga</th>
                        <th scope="col">Stok</th>
                        <th scope="col">Berat</th>
                        <th scope="col">Deskripsi Produk</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no=1;
                    foreach($produk as $val) { ?>
                    <tr>
                        <th scope="row"><?php echo $no; ?></th>
                        <td><?php echo $val->namaProduk; ?></td>
                        <td><img src="<?php echo base_url('assets/foto_produk/'.$val->foto); ?>" width="150" height="110"></td>
                        <td><?php echo $val->harga; ?></td>
                        <td><?php echo $val->stok; ?></td>
                        <td><?php echo $val->berat; ?></td>
                        <td><?php echo $val->deskripsiProduk; ?></td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="<?php echo site_url('produk/get_by_id/'.$val->idProduk);?>" class="btn btn-secondary">Edit</a>
                                <a href="<?php echo site_url('produk/delete/'.$val->idProduk);?>" onClick="return confirm('Yakin akan hapus data ini?')" class="btn btn-secondary">Delete</a>
                            </div>
                        </td>
                    </tr>
                    <?php $no++; } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
