<div class="main-content">
  <section class="section">
  
    <div class="section-header">
      <h1>
        Edit Neraca
      </h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active">
          <a href="<?=base_url('dashboard')?>">Dashboard</a>
        </div>
        <div class="breadcrumb-item">
          Neraca          
        </div>
        <div class="breadcrumb-item">
          Edit
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <form method="post" action="">               
              <div class="form-group">
                <label for="tanggal" class="col-form-label">Tanggal</label>
                <div>
                  <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= !empty($data) ? $data->tanggal : '' ?>" required>
                </div>
              </div>
              <div class="form-group">
                <label for="keterangan" class="col-form-label">Keterangan</label>
                <div>
                  <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= !empty($data) ? $data->keterangan : '' ?>" required>
                </div>
              </div>
              <div class="form-group">
                <label for="kode" class="col-form-label">Kode Akun</label>
                <div>
                  <select name="kode" class="form-control">
                    <option value="">Pilih Akun</option>
                    <?php foreach ($akuns as $akun) { ?>
                      <option value="<?=$akun->kode?>" <?=!empty($data) && $data->kode_akun == $akun->kode ? 'selected' : ''?>><?=$akun->kode?> - <?=$akun->nama?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="debit" class="col-form-label">Debit</label>
                <div>
                  <input type="number" class="form-control" id="debit" name="debit" value="<?= !empty($data) ? $data->debit : '' ?>" required>
                </div>
              </div>
              <div class="form-group">
                <label for="kredit" class="col-form-label">Kredit</label>
                <div>
                  <input type="number" class="form-control" id="kredit" name="kredit" value="<?= !empty($data) ? $data->kredit : '' ?>" required>
                </div>
              </div>                                                  
              
              <div class="form-group">
                <a href="<?=base_url('neraca')?>" class="btn btn-danger">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>                
              </div>

            </form>
          </div>        
        </div>
      </div>
    </div>
  </section>                  
</div>