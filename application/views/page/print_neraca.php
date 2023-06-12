<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <title>Cetak Laporan Neraca</title>
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
        <span style="font-family: arial; font-size: 20px;">Laporan Neraca</span><br>
        <span style="font-family: arial;">Periode Tahun : <?= date('Y') ?></span>
      </div>


      <div class="row">
        <div class="col">
          <div class="float-left">
            Aktiva
          </div>
        </div>
        <div class="col">
          <div class="float-right">
            Pasiva
          </div>
        </div>
      </div>
      <br>
      <br>

      <table class="table table-bordered">
        <thead>
          <tr>
            <th style="width:200px">Keterangan</th>
            <th>Saldo</th>
            <th style="width:200px">Keterangan</th>
            <th>Saldo</th>
          </tr>
        </thead>
        <tr>
          <td><b>Aktiva Lancar</b></td>
          <td></td>
          <td><b>Kewajiban</b></td>
          <td></td>
        </tr>
        <?php
        $total_aktiva = 0;
        $total_pasiva = 0;
        $countNeraca  = count($neraca);

        for($i=0; $i<$countNeraca; $i++){
          $total_aktiva += $neraca[$i]->debit;
          $total_pasiva += $neraca[$i]->kredit;                             
          ?>
          <tr>                                                            
            <?php if( isset($aktiva_lancar[$i]) ){ ?>
              <td><?= $aktiva_lancar[$i]->nama ?></td>
              <td>Rp. <?=number_format($aktiva_lancar[$i]->debit) ?></td>
            <?php }else{ ?>
              <td></td>
              <td></td>
            <?php } ?>                    

            <?php if( isset($kewajiban[$i]) ){ ?>
              <td><?= $kewajiban[$i]->nama ?></td>
              <td>Rp. <?=number_format($kewajiban[$i]->kredit) ?></td>
            <?php }else{ ?>
              <td></td>
              <td></td>
            <?php } ?>                    
          </tr>
          <?php 
        } 
        ?>

        <tr>
          <td><b>Aktiva Tetap</b></td>
          <td></td>
          <td><b>Modal</b></td>
          <td></td>
        </tr>

        <?php for($i=0; $i<$countNeraca; $i++){ ?>
          <tr>                                                          
            <?php if( isset($aktiva_tetap[$i]) ){ ?>
              <td><?= $aktiva_tetap[$i]->nama ?></td>
              <td>Rp. <?=number_format($aktiva_tetap[$i]->debit) ?></td>
            <?php }else{ ?>
              <td></td>
              <td></td>
            <?php } ?>                

            <?php if( isset($modal[$i]) ){ ?>
              <td><?= $modal[$i]->nama ?></td>
              <td>Rp. <?=number_format($modal[$i]->kredit) ?></td>
            <?php }else{ ?>
              <td></td>
              <td></td>
            <?php } ?>                                        
          </tr> 
        <?php } ?>

        <tfoot>
          <tr>
            <td>Total Aktiva</td>
            <td>Rp. <?= number_format($total_aktiva) ?></td>
            <td>Total Pasiva</td>
            <td>Rp. <?= number_format($total_pasiva) ?></td>
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