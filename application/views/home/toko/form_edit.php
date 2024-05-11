<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Form Edit Toko</span></h2>
    </div>    
    <div class="row px-xl-5">
        <div class="col-lg-7 mb-5">
        <?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-ban"></i> Alert!</h5>
        <?php echo $this->session->flashdata('error'); ?>
    </div>
<?php endif; ?>
            <div class="contact-form">
                <form method="POST" action="<?php echo site_url('toko/update');?>" enctype="multipart/form-data">
                <input type="hidden" class="form-control" value="<?php echo $toko->idToko;?>" name="id">
                    <div class="form-group">
                        <input type="text" class="form-control" value="<?php echo $toko->namaToko;?>" name="namaToko" id="name" placeholder="Nama toko">
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="form-group">
                        <input type="file" class="form-control" name="logo" id="emfail" >
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" value="<?php echo $toko->deskripsi;?>" rows="3" id="message" name="deskripsi" placeholder="Deskripsi" ></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
