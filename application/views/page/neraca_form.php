<div class="main-content">
  <section class="section">
  
    <div class="section-header">
      <h1>
        <?= !empty($data) ? 'Edit' : 'Tambah' ?> Neraca
      </h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active">
          <a href="<?=base_url('dashboard')?>">Dashboard</a>
        </div>
        <div class="breadcrumb-item">
          Neraca
        </div>
        <div class="breadcrumb-item">
          <?=!empty($data) ? 'Edit' : 'Tambah' ?>
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
                  <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= !empty($data) ? $data->tanggal : date('Y-m-d') ?>" required>
                </div>
              </div>
              <div class="form-group">
                <label for="keterangan" class="col-form-label">Keterangan</label>
                <div>
                  <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= !empty($data) ? $data->keterangan : '' ?>" required>
                </div>
              </div>
              <hr>
              <table class="table table-bordered table-hover">
                <tr>
                  <th>Kode</th>                    
                  <th>debit</th>
                  <th>Kredit</th>
                  <th>#</th>
                </tr>
                <tr>
                  <td>
                    <select name="kode_akun" class="form-control">
                      <option value="">Pilih Akun</option>
                      <?php foreach ($akuns as $akun) { ?>
                        <option value="<?=$akun->kode?>" <?=!empty($data) && $data->kode_akun == $akun->kode ? 'selected' : ''?>><?=$akun->kode?> - <?=$akun->nama?></option>
                      <?php } ?>
                    </select>                                              
                  </td>
                  <td>
                    <input type="number" class="form-control" id="debit" value="0">
                  </td>
                  <td>
                    <input type="number" class="form-control" id="kredit" value="0">
                  </td>
                  <td>
                    <button type="button" class="btn btn-primary" id="tambah_akun">Tambah</button>
                  </td>
                </tr>
                <tfoot>
                  <tr>
                    <td>Total</td>
                    <td>
                      <span id="total_debit"></span>
                    </td>
                    <td>
                      <span id="total_kredit"></span>                          
                    </td>
                    <td></td>
                  </tr>
                </tfoot>
              </table>
              
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

<!-- import jquery from cdn -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

<script>
  $(document).ready(function(){
    var total_debit = 0;
    var total_kredit = 0;

    $('#tambah_akun').click(function(){
      var kode_akun = $('select[name="kode_akun"]').val();
      var debit = $('input[id="debit"]').val();
      var kredit = $('input[id="kredit"]').val();

      if(kode_akun == ''){
        alert('Pilih akun terlebih dahulu');
        return false;
      }
      if(debit == '' && kredit == ''){
        alert('Masukan nilai debit atau kredit');
        return false;
      }

      var html = '<tr>';
      html += '<td> <input type="text" class="form-control" name="kode[]" value="'+kode_akun+'" readonly></td>';
      html += '<td> <input type="number" class="form-control" name="debit[]" value="'+debit+'" readonly></td>';
      html += '<td> <input type="number" class="form-control" name="kredit[]" value="'+kredit+'" readonly></td>';
      html += '<td><button type="button" class="btn btn-danger hapus_akun">Hapus</button></td>';
      html += '</tr>';

      $('table').append(html);
      $('input[name="debit"]').val(0);
      $('input[name="kredit"]').val(0);
      $('select[name="kode_akun"]').val('');

      total_debit += parseInt(debit);
      total_kredit += parseInt(kredit);

      $('#total_debit').html(total_debit);
      $('#total_kredit').html(total_kredit);
    });

    $('table').on('click', '.hapus_akun', function(){
      $(this).parent().parent().remove();
      var debit = $(this).parent().parent().find('td:eq(1)').html();
      var kredit = $(this).parent().parent().find('td:eq(2)').html();

      total_debit -= parseInt(debit);
      total_kredit -= parseInt(kredit);

      $('#total_debit').html(total_debit);
      $('#total_kredit').html(total_kredit);
    });
  });
</script>