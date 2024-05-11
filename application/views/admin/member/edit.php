<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Form Edit Toko</span></h2>
    </div>    
    <div class="row px-xl-5">
    
        <div class="col-lg-7 mb-5">
        <?php 
      if($this->session->flashdata('error')!=""){
      ?>
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-ban"></i> Alert!</h5>
         <?php echo $this->session->flashdata('error');?>
      </div>
      <?php
      }
      ?>
      
      <?php 
if($this->session->flashdata('success')!=""){
?>
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-check"></i> Success!</h5>
    <?php echo $this->session->flashdata('success');?>
</div>
<?php
}
?>

            <div class="contact-form">
                <form method="POST" action="<?php echo site_url('member/update/');?>" enctype="multipart/form-data">
                <input type="hidden" class="form-control" value="<?php echo $konsumen->idKonsumen;?>" name="idKonsumen">
                    <div class="form-group">
                        <input type="text" class="form-control" value="<?php echo $konsumen->username;?>" name="username" id="name" placeholder="username" >
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" value="<?php echo $konsumen->namaKonsumen;?>" name="namaKonsumen" id="name" placeholder="Nama Konsumen" >
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" value="<?php echo $konsumen->alamat;?>" name="alamat" id="name" placeholder="Nama Alamat" >
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" value="<?php echo $konsumen->idKota;?>" name="idKota" id="name" placeholder="Id Kota" >
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" value="<?php echo $konsumen->email;?>" name="email" id="name" placeholder="email" >
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" value="<?php echo $konsumen->tlpn;?>" name="tlpn" id="emfail" placeholder="telepon" >
                        <p class="help-block text-danger"></p>
                    </div>     
                    <div class="form-group">
                        <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
