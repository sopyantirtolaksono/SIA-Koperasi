<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1><?= !empty($data) ? 'Edit' : 'Tambah'?> Akun Neraca</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?=base_url('dashboard')?>">Dashboard</a></div>
        <div class="breadcrumb-item">Akun</div>
        <div class="breadcrumb-item"><?=!empty($data)?'Edit':'Tambah'?></div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <form method="post" action="">
        <div class="card">
          <div class="card-body row">            
            <div class="col-md-6">
              <div class="form-group">
                <label>Kode</label>
                <input type="text" name="kode" value="<?=!empty($data)?$data->kode:''?>" required class="form-control" placeholder="Masukan kode akun" >
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" value="<?=!empty($data)?$data->nama:''?>" required class="form-control" placeholder="Masukan nama akun" >
              </div>
            </div>            
            
            <div class="col-md-12">
              <a href="<?=base_url('akun')?>" class="btn btn-danger">Batal</a>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </div>
        </div>
        </form>
      </div>
    </div>
  </section>
</div>