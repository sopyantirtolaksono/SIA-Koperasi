<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1><?=!empty($data)?'Edit':'Tambah'?> Simpanan <?=ucwords($jenis)?></h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?=base_url('dashboard')?>">Dashboard</a></div>
        <div class="breadcrumb-item">Simpanan</div>
        <div class="breadcrumb-item"><?=ucwords($jenis)?></div>
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
                  <select class="form-control" required name="simpanan_anggota">
                    <option value="">-- Pilih Anggota -- </option>
                    <?php foreach ($list as $l) { ?>
                      <option <?=!empty($data) && $data->simpanan_anggota == $l->anggota_kode?'selected':''?> value="<?=$l->anggota_kode?>"><?=$l->anggota_nama?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Jumlah Setoran</label>
                  <input type="number" name="simpanan_jumlah" value="<?php if($jenis == "wajib"){ echo "50000";}elseif($jenis="pokok") {echo "100000";}elseif($jenis=="sukarela"){echo $data->simpanan_jumlah; } ?>" required class="form-control" placeholder="Masukan jumlah setoran" >
                </div>
              </div>

              <div class="col-md-12">
                <a href="#" class="btn btn-danger" onclick ="history.back(-1)">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
</div>