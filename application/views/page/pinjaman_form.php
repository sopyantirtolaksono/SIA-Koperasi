<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1><?=!empty($user)?'Edit':'Tambah'?> Pinjaman</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?=base_url('dashboard')?>">Dashboard</a></div>
        <div class="breadcrumb-item">Pinjaman</div>
        <div class="breadcrumb-item"><?=!empty($user)?'Edit':'Tambah'?></div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <form method="post" action="">
        <div class="card">
          <div class="card-body row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Anggota</label>
                <select class="form-control" required name="pinjaman_anggota">
                  <option value="">-- Pilih Anggota -- </option>
                  <?php foreach ($list as $l) { ?>
                    <option <?=!empty($data) && $data->pinjaman_anggota == $l->anggota_kode?'selected':''?> value="<?=$l->anggota_kode?>"><?=$l->anggota_nama?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Jumlah Pinjaman</label>
                <input type="number" name="pinjaman_jumlah" value="<?=!empty($data)?$data->pinjaman_jumlah:''?>" required class="form-control" placeholder="Masukan jumlah pinjaman" >
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Tempo Pinjaman</label>
                <input type="number" name="pinjaman_tempo" value="<?=!empty($data)?$data->pinjaman_tempo:''?>" required class="form-control" placeholder="Masukan tempo pinjaman dalam bulan" >
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Bunga Pinjaman</label>
                <input type="number" name="pinjaman_bunga" value="<?=!empty($data)?$data->pinjaman_bunga:''?>" required class="form-control" placeholder="Masukan bunga pinjaman" >
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Jaminan</label>
                <input type="text" name="pinjaman_jaminan" value="<?=!empty($data)?$data->pinjaman_jaminan:''?>" required class="form-control" placeholder="Masukan jaminan pinjaman (Tuliskan keterangan secara lengkap)" >
              </div>
            </div>
            
            <div class="col-md-12">
              <a href="<?=base_url('pinjaman')?>" class="btn btn-danger">Batal</a>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </div>
        </div>
        </form>
      </div>
    </div>
  </section>
</div>