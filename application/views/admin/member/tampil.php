<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manajemen Member</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manajemen Member</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Member</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

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

                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Username</th>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>No Telp</th>
                      <th>Alamat</th>
                      <th>Status Aktif</th>
                      <th style="width: 250px">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $no=1;
                    foreach($member as $val){
                    ?>
                    <tr>
                      <td><?php echo $no++;?></td>
                      <td><?php echo $val->username;?></td>
                      <td><?php echo $val->namaKonsumen;?></td>
                      <td><?php echo $val->email;?></td>
                      <td><?php echo $val->tlpn;?></td>
                      <td><?php echo $val->alamat;?></td>
                      <td><?php if($val->statusAktif=='Y'){echo "Aktif";}else{echo "Tidak Aktif";} ?></td>
                      <td>
                      <a href="<?php echo site_url('member/ubah_status/'.$val->idKonsumen);?>" class="btn btn-warning ">Ubah Status</a>
                      <a href="<?php echo site_url('member/delete/'.$val->idKonsumen);?>" onClick="return confirm('Yakin akan hapus data ini?')" class="btn  btn-danger ">Hapus</button>
                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
             
            </div>
            <!-- /.card -->

            
          </div>
        </div>
        <!-- /.row -->
       
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>