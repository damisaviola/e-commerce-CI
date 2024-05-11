<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Form Tambah Produk</span></h2>
    </div>    

        <div class="col-lg-7 mb-5">
        <?php 
if($this->session->flashdata('error') != "") {
?>
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-ban"></i> Alert!</h5>
    <?php echo $this->session->flashdata('error'); ?>
</div>
<?php
}
?>

            <div class="contact-form">
                <form method="POST" action="<?php echo site_url('produk/save');?>" enctype="multipart/form-data">
                <input type="hidden" name="idToko" value="<?php echo $idToko; ?>">
                    <div class="control-group">
                        <select class="form-control" name="kategori">
                            <?php foreach($kategori as $val){?>
                            <option value="<?php echo $val->idkat; ?>"><?php echo $val->namaKat;?></option>
                            <?php } ?>
                        </select>
                        <p class="help-block text-danger"></p>
                    </div>
                    
                    <div class="control-group">
                    <input type="text" class="form-control" name="namaProduk" id="name" placeholder="Nama Produk" >
                        <p class="help-block text-danger"></p>
                    </div>

                    <div class="control-group">
                        <input type="file" class="form-control" name="foto" id="emfail" placeholder="Gambar Produk" >
                        <p class="help-block text-danger"></p>
                    </div>

                    <div class="control-group">
                        <input type="text" class="form-control" name="harga" id="name" placeholder="Harga Produk" >
                        <p class="help-block text-danger"></p>
                    </div>

                    <div class="control-group">
                        <input type="text" class="form-control" name="stok" id="stok" placeholder="Jumlah Produk" >
                        <p class="help-block text-danger"></p>
                    </div>

                    <div class="control-group">
                        <input type="text" class="form-control" name="berat" id="berat" placeholder="Berat Produk" >
                        <p class="help-block text-danger"></p>
                    </div>

                    <div class="control-group">
                        <textarea type="text" class="form-control" name="deskripsiProduk" rows="3" id="message" placeholder="Deskripsi" ></textarea>
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
