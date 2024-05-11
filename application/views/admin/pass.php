<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manajemen Kategori</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manajemen Kategori</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Ubah Password Admin</h3>
              </div>

              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" method="POST" action="<?php echo site_url('adminpanel/save');?>">
              <input type="hidden" class="form-control" value="<?php echo $admin->idAdmin;?>" name="id">  
                <div class="card-body">
                <?php 
                    if($this->session->flashdata('msg')!=""){
                    ?>
                    <div class="alert alert-info alert-warning">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      
                        <?php echo $this->session->flashdata('msg');?>
                    </div>
                    <?php
                    }
                ?>
                  <div class="form-group row">
                    <label for="nama" class="col-sm-4 col-form-label">Password Lama</label>
                    <div class="col-sm-8">
                      <input type="password" class="form-control" id="nama" name="passwordLama" placeholder="Nama Kategori">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="nama" class="col-sm-4 col-form-label">Password Baru</label>
                    <div class="col-sm-8">
                      <input type="password" class="form-control" id="nama" name="passwordBaru" placeholder="Nama Kategori">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="nama" class="col-sm-4 col-form-label">Konfirmasi Password Baru</label>
                    <div class="col-sm-8">
                      <input type="password" class="form-control" id="nama" name="passwordKonfirm" placeholder="Nama Kategori">
                    </div>
                  </div>
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info float-right">Simpan</button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
        </div>
    </div>
    </div>
  </div>