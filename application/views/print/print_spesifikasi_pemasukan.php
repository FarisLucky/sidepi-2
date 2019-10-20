<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="<?= base_url() ?>assets/custom/css/custom_css.css">
  <title>Document</title>
</head>

<body>
  <div class="container">
    <h2 class="txt-center">Laporan Spesifik Pemasukan</h2>
    <table border="1">
      <thead>
        <tr>
          <th>No</th>
          <th>Pemasukan</th>
          <th>Kelompok</th>
          <th>Jumlah</th>
          <th>Harga</th>
          <th>Total Harga</th>
          <th>Pembuat</th>
          <th>Tgl Buat</th>
        </tr>
      </thead>
      <tbody>
        <?php $no= 1; foreach ($pemasukan as $key => $value) { ?>
        <tr>
          <td><?= $no; ?></td>
          <td><?= $value->nama_pemasukan; ?></td>
          <td><?= $value->nama_kelompok; ?></td>
          <td><?= $value->volume." ".$value->satuan ?></td>
          <td><?= $value->harga_satuan; ?></td>
          <td><?= $value->total_harga; ?></td>
          <td><?= $value->nama_lengkap; ?></td>
          <td><?= $value->tgl_buat; ?></td>
        </tr>
        <?php $no++; } ?>
      </tbody>
    </table>
  </div>
</body>

</html>