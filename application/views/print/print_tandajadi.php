<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?= base_url() ?>assets/custom/css/custom_print.css">
    <title>Bukti Tanda Jadi</title>
</head>

<body style="font-size:13px;">
    <div class="container">
        <div class="row relative">
            <img src="<?= FCPATH."assets/uploads/images/properti/".$logo->logo_properti ?>" width="100px" class="d-inline-block relative" style="margin-left:60px">
            <div class="d-inline-block max-width">
                <ol class="inner text-center">
                    <li><small class="font-weight">KWITANSI PERUMAHAN</small></li>
                    <li><small class="font-weight"><?= $tandajadi->nama_properti ?></small></li>
                    <li><small class="font-weight"><?= $logo->alamat ?></small></li>
                </ol>
            </div>
        </div>
        <table class="bordered">
            <thead>
                <tr>
                    <th>Kavling</th>
                    <th>Pembeli</th>
                    <th>Kwitansi</th>
                    <th>Total Tagihan</th>
                    <th>Bayar</th>
                    <th>Tempo</th>
                    <th>Penerima</th>
                    <th>Total Bayar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $tandajadi->nama_unit; ?></td>
                    <td><?= $tandajadi->nama_lengkap; ?></td>
                    <td><?= $tandajadi->jenis_pembayaran; ?></td>
                    <td><?= number_format($tandajadi->total_tagihan,2,",",".") ?></td>
                    <td><?php $date = DateTime::createFromFormat("Y-m-d",$tandajadi->tgl_bayar); echo tanggal($date->format("d"),$date->format("m"),$date->format("Y")) ?></td>
                    <td><?php $date = DateTime::createFromFormat("Y-m-d",$tandajadi->tgl_jatuh_tempo); echo tanggal($date->format("d"),$date->format("m"),$date->format("Y")) ?></td>
                    <td><?= $tandajadi->pembuat; ?></td>
                    <td><?= number_format($tandajadi->total_bayar,2,",",".") ?></td>
                </tr>
                <tr>
                    <td colspan="7">NB -</td>
                    <td><?= number_format($tandajadi->total_bayar,2,",",".") ?></td>
                </tr>
            </tbody>
        </table>
        <div class="row relative">
            <div class="text-center abs" style="padding-top:80px;left:100px;">
                <small style="margin-bottom:70px;display:inline-block; margin-left:14px">Ttd</small><br>
                <small class="f-14"><?= $tandajadi->pembuat ?></small><br>
                <small>Penerima</small>
            </div>
            <div class="text-center abs" style="padding-top:50px;right:100px">
                <small style="margin-bottom:20px;display:inline-block;">Nganjuk, <?php echo tanggal(date("d"),date("m"),date("Y")) ?></small><br>
                <small style="margin-bottom:70px;display:inline-block; margin-left:40px">Ttd</small><br>
                <small class="f-14"><?= $tandajadi->nama_lengkap ?></small><br>
                <small>Pembeli</small>
            </div>
        </div>
    </div>
    <div class="absolute">
        <small class="d-inline-block">Pembuat : </small><small class="d-inline-block"><?= $tandajadi->pembuat ?></small>
    </div>
</body>

</html>