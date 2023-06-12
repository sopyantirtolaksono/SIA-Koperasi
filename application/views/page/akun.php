<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Data Akun</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?=base_url('dashboard')?>">Dashboard</a></div>
        <div class="breadcrumb-item">Akun</div>        
      </div>
    </div>
    <!-- <span>
        1.1 Aktiva Lancar 
        1.2 Aktiva Tetap 
        2.1 Kewajiban 
        3.1 Modal 
        3.2 Prive 
        4.1 Pendapatan 
        5.1 Beban
      </span> -->
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body table-responsive">
            <a href="<?=base_url('akun-add')?>" class="btn btn-primary">Tambah Data</a>
            <hr>
            <table id="table" class="table table-bordered text-center">
              <thead>
                <tr>
                  <th scope="col">Kode</th>
                  <th scope="col">Nama</th>                  
                  <th scope="col">Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $no     = 1; 
                  $saldo  = 0;
                  foreach ($akuns as $row) {           
                  ?>
                  <tr>
                    <td><?=$row->kode?></td>                    
                    <td><?=$row->nama?></td>                    
                    <td>                    
                      <a href="<?=base_url('akun-edit/'.$row->kode)?>" class="btn btn-info btn-sm"><span class="fa fa-edit"></span></a>
                      <button type="button" onclick="return confirmdelete('<?=base_url('akun-delete/'.$row->kode)?>','akun')" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></button>
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