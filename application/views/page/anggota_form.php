<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1><?=!empty($anggota)?'Edit':'Tambah'?> Data Anggota</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?=base_url('dashboard')?>">Dashboard</a></div>
        <div class="breadcrumb-item">Master</div>
        <div class="breadcrumb-item"><?=!empty($anggota)?'Edit':'Tambah'?> Data Anggota</div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <form method="post" action="">
          <div class="card">
            <div class="card-body row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Nomor Induk Kependudukan</label>
                  <input type="number" name="anggota_nik" value="<?=!empty($anggota)?$anggota->anggota_nik:''?>" required class="form-control" placeholder="Masukan nomor induk kependudukan" >
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Nama Lengkap</label>
                  <input type="text" name="anggota_nama" value="<?=!empty($anggota)?$anggota->anggota_nama:''?>" required class="form-control" placeholder="Masukan nama lengkap" >
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Tanggal Lahir</label>
                  <input type="date" name="anggota_tgllahir" value="<?=!empty($anggota)?$anggota->anggota_tgllahir:''?>" required class="form-control" >
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Pekerjaan</label>
                  <input type="text" name="anggota_pekerjaan" value="<?=!empty($anggota)?$anggota->anggota_pekerjaan:''?>" required class="form-control" placeholder="Masukan pekerjaan" >
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Nomor Handphone</label>
                  <input type="number" name="anggota_nohp" value="<?=!empty($anggota)?$anggota->anggota_nohp:''?>" required class="form-control" placeholder="Masukan nomor handphone" >
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <label>Alamat</label>
                  <input type="text" name="anggota_alamat" value="<?=!empty($anggota)?$anggota->anggota_alamat:''?>" required class="form-control" placeholder="Masukan alamat" >
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" name="anggota_password" class="form-control" <?=!empty($anggota)?'':'required placeholder="Masukan password"'?> <?=empty($anggota)?'':'placeholder="Masukan jika ingin mengubah"'?>>
                </div>
              </div>
              <div class="col-md-12">
                <a href="<?=base_url('anggota')?>" class="btn btn-danger">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
</div>