<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <link rel="icon" type="image/x-icon" href="<?= base_url('src/img/logo.png') ?>">
    <meta name="description" content="Sistem informasi koperasi ini merupakan sistem yang digunakan untuk mempermudah pelayanan dan pendataan koperasi simpan pinjam.">

    <title>Cetak Laporan SHU Perorangan</title>
</head>

<body onload="window.print()">
    <div class="card">
        <div class="card-body">
            <div style="text-align: center; line-height: 25px;">
                <span style="font-size: 30px; font-family: arial;"><b>Koperasi Arofah Kendal</b></span>
                <br>
                <span style="font-size: 16px; font-family: arial; font-weight: bold;">Jl. Sekopek Tengah No. 1 , Plantaran Kaliwungu Selatan, Kendal</span><br>
                <span style="font-size: 16px; font-family: arial; font-weight: bold;">No Hp : 082298630697</span>
                <hr style="border: 1px solid #000000;">
            </div>

            <div style="text-align: center; line-height: 25px;">
                <span style="font-family: arial; font-size: 20px; font-weight: bold;">Laporan SHU</span><br>
                <span style="font-family: arial; font-weight: bold;">Periode Tahun : <?= ($tahunp) ? $tahunp : date('Y'); ?></span>
            </div>
            <br>

            <table border="1px" cellspacing="0px" cellpadding="10px" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Anggota</th>
                        <th>Nama Anggota</th>
                        <th>SHU Simpanan</th>
                        <th>SHU Pinjaman</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $total_keseluruhan = 0;
                    foreach ($shu_perorangan as $shu_p) :
                        // shu_simpanan_perorangan = besar_simpanan / total_simpanan * 40% * jasa_shu_keseluruhan
                        $shu_simpanan = $shu_p['besar_simpanan'] / $total_simpanan * 40 / 100 * $shu_keseluruhan;

                        // shu_pinjaman_perorangan = besar_pinjaman / total_pinjaman * 15% * jasa_shu_keseluruhan
                        $shu_pinjaman = $shu_p['besar_pinjaman'] / $total_pinjaman * 15 / 100 * $shu_keseluruhan;

                        // total
                        $total = $shu_simpanan + $shu_pinjaman;
                        // total keseluruhan
                        $total_keseluruhan += $total;
                    ?>
                        <tr>
                            <td style="text-align: center;"><?= $no++; ?></td>
                            <td><?= $shu_p['anggota_kode']; ?></td>
                            <td><?= $shu_p['anggota_nama']; ?></td>
                            <td>Rp. <?= number_format($shu_simpanan); ?></td>
                            <td>Rp. <?= number_format($shu_pinjaman); ?></td>
                            <td>Rp. <?= number_format($total); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5" align="center">Total Keseluruhan</th>
                        <th>Rp. <?= number_format($total_keseluruhan); ?></th>
                    </tr>
                </tfoot>
            </table>
            <br><br><br>
            
            <div style="width: 100%; display: flex; justify-content: flex-end;">
                <div style="width: 200px; height: auto; text-align: center;">
                    <span>Kendal, <?= tanggal(date('Y-m-d')); ?></span>
                    <br><br><br><br><br>
                    <span>Bendahara</span>
                </div>
            </div>
        </div>
    </div>
</body>

</html>