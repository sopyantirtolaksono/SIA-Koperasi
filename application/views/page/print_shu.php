<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <title>Cetak Laporan SHU</title>
</head>
<body>
  <div class="card">
    <div class="card-body">          

      <div class="text-center">
        <span style="font-size: 30px; font-family: arial;"><b>Koperasi Arofah Kendal</b></span>
        <br>  
        <span style="font-size: 16px; font-family: arial;">Jl. Sekopek Tengah No. 1 , Plantaran Kaliwungu Selatan, Kendal</span><br>
        <span style="font-size: 16px; font-family: arial;">No Hp : 082298630697</span>
        <hr>
      </div>

      <div class="laporan text-center"> 
        <span style="font-family: arial; font-size: 20px;">Laporan SHU</span><br>
        <span style="font-family: arial;">Periode Tahun : <?= date('Y') ?></span>
      </div>
      <br>
      <!-- Settingan SHU -->
      <?php               
      $bagAnggota     = $data->pinjaman * 25/100;
      $cadangan       = $data->pinjaman * 30/100;
      $bagPengurus    = $data->pinjaman * 15/100;
      $bagPegawai     = $data->pinjaman * 10/100;
      $programDaerah  = $data->pinjaman * 10/100;
      $programSosial  = $data->pinjaman * 10/100;

      $shu = $bagAnggota + $cadangan + $bagPengurus + $bagPegawai + $programDaerah + $programSosial;
      ?>

      <table class="table table-bordered" style="font-size: 14px;">
        <thead>
          <tr>
            <th style="width:400px">Dibagi untuk</th>
            <th>Total</th>                  
          </tr>
        </thead>                
        <tbody>
          <tr>
            <td>Bagian Anggota</td>
            <td>Rp. <?= number_format($bagAnggota) ?></td>
          </tr>
          <tr>
            <td>Cadangan Koperasi</td>
            <td>Rp. <?= number_format($cadangan) ?></td>
          </tr>
          <tr>
            <td>Bagian Pengurus</td>
            <td>Rp. <?= number_format($bagPengurus) ?></td>
          </tr>
          <tr>
            <td>Bagian Pegawai/Karyawan</td>
            <td>Rp. <?= number_format($bagPegawai) ?></td>
          </tr>
          <tr>
            <td>Program Pembangunan Daerah Kerja</td>
            <td>Rp. <?= number_format($programDaerah) ?></td>
          </tr>
          <tr>
            <td>Program Sosial</td>
            <td>Rp. <?= number_format($programSosial) ?></td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td>Total</td>
            <td>Rp. <?= number_format($shu) ?></td>
          </tr>                    
        </tfoot>
      </table>

    </div>
  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>

<!-- <script>  
  window.onafterprint = window.close;
  window.print();
</script> -->