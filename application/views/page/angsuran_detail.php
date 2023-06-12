<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Detail Data Angsuran</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?=base_url('dashboard')?>">Dashboard</a></div>
        <div class="breadcrumb-item">Detail Data Angsuran</div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <h5>Informasi Pinjaman <a href="<?=base_url('angsuran')?>" class="btn btn-sm btn-danger float-right">Kembali</a></h5>
            <hr>
            
              <b>Kode :</b> #<?=$data->pinjaman_kode?><br>
              <b>Nama :</b> <?=$data->anggota_nama?><br>
              <b>Jumlah Pinjaman :</b> Rp. <?=number_format($data->pinjaman_jumlah)?><br>
              <b>Tempo Pinjaman :</b> <?=$data->pinjaman_tempo?> Bulan<br>
              <b>Bunga Pinjaman :</b> <?=$data->pinjaman_bunga?>%<br>
              <b>Total Penagihan :</b> Rp. <?=number_format($data->pinjaman_total)?>

            
          </div>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body table-responsive">
            <table id="table" class="table table-bordered text-center table-striped">
              <thead>
                <th width="1%">Ke</th>
                <th>Pokok</th>
                <th>Denda</th>
                <th>Total</th>
                <th>#</th>
              </thead>
              <tbody>
                <?php 
                  $pokok = $data->pinjaman_total / $data->pinjaman_tempo;
                  for ($i=1; $i <= $data->pinjaman_tempo ; $i++) {
                  $cek = $this->db->get_where('angsuran',['angsuran_ke'=>$i,'angsuran_pinjaman'=>$data->pinjaman_kode])->row();
                ?>
                <tr>
                  <td><?=$i?></td>
                  <td>Rp. <?=number_format($pokok)?></td>
                  <td>
                    <?php 
                    if ($cek) { echo 'Rp. '.number_format($cek->angsuran_denda); }
                    else{ echo '<center><input type="number" class="form-control form-control-sm" min="0" onkeyup="return hitung(this.value,'.$i.')" onchange="return hitung(this.value,'.$i.')" style="width: 150px" required  id="denda'.$i.'"></center> '; }
                    ?>
                  </td>
                  <td>
                    <?php 
                    if ($cek) { echo 'Rp. '.number_format($cek->angsuran_total); }
                    else{ echo '<span id="texttotal'.$i.'">Rp. '.number_format($pokok).'</span><input type="hidden" class="form-control" id="total'.$i.'"> '; }
                    ?>
                  </td>
                  <td>
                    <?php if ($cek) { ?>
                      <span class="fa fa-check text-success"></span><br>
                      <small><?=date('H:i',strtotime($cek->angsuran_waktu))?>, <?=tanggal(date('Y-m-d',strtotime($cek->angsuran_waktu)))?></small>
                    <?php } else { ?> 
                      <button id="simpan<?=$i?>" type="button" onclick="return simpan('<?=$i?>')" class="btn btn-sm btn-info"><span class="fa fa-save"></span></button>
                    <?php }?>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
              <tfoot>

              </tfoot>
            </table>      
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script>
function confirmdelete(txt)
{
  Swal.fire({
    title: 'Apakah anda yakin ?',
    text: "Anda akan menghapus data simpanan ",
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yakin!'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.replace(txt);
    }
  })
}
  
function hitung(val,id)
{
  var pokok   = <?=$pokok?>;
  var jumlah  = parseInt(pokok)+parseInt(val)
  $('#texttotal'+id).text(formatRupiah(jumlah));
  $('#total'+id).val(jumlah);
}

function formatRupiah(angka){
  var number_string = angka.toString(),
  sisa              = number_string.length % 3,
  rupiah            = number_string.substr(0, sisa),
  ribuan            = number_string.substr(sisa).match(/\d{3}/g);
    
  if (ribuan) {
    separator = sisa ? '.' : '';
    rupiah += separator + ribuan.join('.');
  }
  return 'Rp. '+rupiah;
}
function simpan(id) {
  var denda = $('#denda'+id).val();
  var akhir = $('#total'+id).val();
  var pokok = <?=$pokok?>;
  var kode  = '<?=$data->pinjaman_kode?>';

  if (denda == '' || denda == null) {
     Swal.fire({
      title: 'Ops!',
      text: "Anda belum menentukan besaran denda untuk angsuran ke-"+id+", jika tidak ada denda maka masukan 0",
      icon: 'Info',
      confirmButtonColor: '#d33',
      confirmButtonText: 'Tutup'
    });
     return false;
  }

  for(var counter = 1; counter <= <?=$data->pinjaman_tempo?>; counter++){
    $('#simpan'+counter).hide();
  }

  Swal.fire({
    title: 'Apakah anda yakin ?',
    text: "Anda akan menambahkan data angsuran ke-"+id,
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yakin!'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({  
        url:"<?=base_url()?>dashboard/simpan_angsuran/"+kode,  
        method:"POST",  
        data:{'ke':id,'denda':denda,'total':akhir,'pokok':pokok}, 
        success:function(data)  
        { 
          console.log(data);
          if (data == 'oke') {
            Swal.fire({
              title: 'Berhasil',
              text: "Data angsuran berhasil disimpan",
              icon: 'success',
              showCancelButton: false,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Oke!'
            }).then((result) => {
              if (result.isConfirmed) {
                window.location.reload();
              }
            })
          }
          else
          {
            Swal.fire({
              title: 'Ops',
              text: "Data angsuran gagal disimpan",
              icon: 'error',
              showCancelButton: false,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Oke!'
            }).then((result) => {
              if (result.isConfirmed) {
                window.location.reload();
              }
            })
          }
        }  
      });
    }
    else
    {
      for(var counter = 1; counter <= <?=$data->pinjaman_tempo?>; counter++){
        $('#simpan'+counter).hide();
      }
    }
  })
}
</script>