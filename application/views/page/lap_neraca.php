<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Laporan Neraca</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?=base_url('dashboard')?>">Dashboard</a></div>
        <div class="breadcrumb-item">Laporan</div>
        <div class="breadcrumb-item">Neraca</div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">          

            <!-- Print -->
            <div class="row">
              <div class="col-md-4">
                <form method="get" action="<?=base_url('laporan-neraca')?>">
                  <label>Periode Tahun</label>
                  <div class="input-group">
                    <select class="form-control" name="tahun">
                      <?php foreach ($tgl as $d ): ?>
                        <?php 
                        $pecah = explode('-', $d->tanggal);
                        $tahun = $pecah[0]; 
                        ?>
                        <option value="<?= $tahun; ?>" <?= $tahun == date('Y') ? 'selected' : ''; ?>><?= $tahun; ?></option>
                      <?php endforeach ?>
                    </select>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></a>
                    </div>
                  </form>
                </div>
                <div class="col-md-8">
                  <div class="float-right mt-4">
                    <a href="<?=$url_cetak;?>" target="_blank" class="btn btn-primary">
                      <i class="fas fa-print"></i> Cetak Data
                    </a>
                  </div>
                </div>
              </div>

              <div class="text-center">
                <h1>Koperasi</h1>
                <h5>Neraca</h5>
                <span>Periode Tahun : <?= empty($tahunp) ? $tahun : $tahunp ; ?></span>
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

              <table class="table">
                <thead>
                  <tr>
                    <th style="width:400px">Keterangan</th>
                    <th>Saldo</th>
                    <th style="width:400px">Keterangan</th>
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
          </div>
        </div>
      </section>
    </div>