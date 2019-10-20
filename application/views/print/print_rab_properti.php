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
      <img src="<?= FCPATH."assets/uploads/images/properti/".$logo["logo_properti"] ?>" width="100px"
        class="d-inline-block relative" style="margin-left:60px">
      <div class="d-inline-block max-width">
        <ol class="inner text-center">
          <li><small class="font-weight">Rencana Anggaran Biaya (RAB) <?= ucfirst($rab->type) ?></small></li>
          <li class="mb-1"><small class="font-weight"> <?= ucwords($logo["nama_properti"]) ?></small></li>
          <li><small class="font-weight"><?= $logo["alamat"] ?></small></li>
        </ol>
      </div>
    </div>
    <hr>
    <ol class="inner">
      <li class=""><small class="f-14"><?php echo strtoupper("* Penggunaan Tanah"); ?></small></li>
      <li class="">
        <ol>
          <?php  ?>
          <li class=""><small class="f-14">Tanah Efektif : </small><small
              class="f-14"><?php echo $rab->tanah_effective ?></small></li>
          <li class=""><small class="f-14">Sarana : </small><small class="f-14"><?php echo $rab->sarana ?></small></li>
          <?php ?>
        </ol>
      </li>
      <?php $no = 1; foreach ($kelompok_rab as $key1 => $value1) { 
                    $detail_rab = getDataWhere("*","tbl_detail_rab",["id_kelompok"=>$value1["id_kelompok"],"id_rab"=>$rab->id_rab])->result(); ?>
      <li><small class="f-14"><?php echo $no.". ".$value1["nama_kelompok"]; ?></small></li>
      <li>
        <table class="bordered">
          <thead class="green-light">
            <tr>
              <th>No</th>
              <th>Nama Pekerjaan</th>
              <th>Volume</th>
              <th>Satuan</th>
              <th>Harga Satuan (Rp)</th>
              <th>Harga Total (Rp)</th>
            </tr>
          </thead>
          <tbody>
            <?php if($detail_rab != null) { $total = 0; $no=1; foreach ($detail_rab as $key => $value) { ?>
            <tr>
              <td><?= $no ?></td>
              <td><?= $value->nama_detail ?></td>
              <td><?= $value->volume; ?></td>
              <td><?= $value->satuan; ?></td>
              <td><?= number_format($value->harga_satuan,2,",",".") ?></td>
              <td><?= number_format($value->total_harga,2,",",".") ?></td>
            </tr>
            <?php $total += $value->total_harga;$no++; } ?>
            <tr>
              <td colspan="5" class="text-center" style="padding:10px">Total Biaya <?= $value1["nama_kelompok"] ?></td>
              <td><?= number_format($total,2,",",".") ?></td>
            </tr>
            <?php }else{ ?>
            <tr>
              <td colspan="6" class="text-center" style="padding:20px">Data Kosong</td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </li>
      <?php $no++; } ?>
      <li class="mt-2 text-right"><small class="f-14">Total Keseluruhan(Rp) : </small><small
          class="font-weight"><?= number_format($rab->total_anggaran,2,",",".") ?></small></li>
    </ol>

    <div class="absolute">
      <small class="d-inline-block">Pembuat : </small><small
        class="d-inline-block">&nbsp;<?= $pembuat["nama_lengkap"] ?></small>
    </div>
</body>

</html>