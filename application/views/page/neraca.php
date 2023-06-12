<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Data Neraca</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?=base_url('dashboard')?>">Dashboard</a></div>
        <div class="breadcrumb-item">Neraca</div>        
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body table-responsive">
            <a href="<?=base_url('neraca-add')?>" class="btn btn-primary">Tambah Data</a>
            <hr>
            <table id="table" class="table table-bordered text-center">
              <thead>
                <tr>
                  <th scope="col">Kode</th>
                  <th scope="col">Tanggal</th>
                  <th scope="col">Keterangan</th>
                  <th scope="col">Kode Akun</th>
                  <th scope="col">Debit</th>
                  <th scope="col">Kredit</th>
                  <th scope="col">Saldo</th>
                  <th scope="col">Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $no     = 1; 
                  $saldo  = 0;
                  foreach ($neraca as $row) { 
                  $saldo += $row->debit;
                  $saldo -= $row->kredit;
                  ?>
                  <tr>
                    <td><?=$row->kode?></td>
                    <td><?=tanggal($row->tanggal)?></td>
                    <td><?=ucwords($row->keterangan)?></td>
                    <td><?=$row->kode_akun?></td>
                    <td>Rp. <?=number_format($row->debit)?></td>
                    <td>Rp. <?=number_format($row->kredit)?></td>
                    <td>Rp. <?=number_format($saldo)?></td>
                    <td>                    
                      <a href="<?=base_url('neraca-edit/'.$row->jurnal_id)?>" class="btn btn-info btn-sm"><span class="fa fa-edit"></span></a>
                      <button type="button" onclick="return confirmdelete('<?=base_url('neraca-delete/'.$row->jurnal_id)?>','neraca')" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></button>
                    </td>
                  </tr>
                <?php } ?>               
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script>
function confirmdelete(txt,jenis)
{
  Swal.fire({
    title: 'Apakah anda yakin ?',
    text: "Anda akan menghapus data simpanan "+jenis,
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
  
</script>