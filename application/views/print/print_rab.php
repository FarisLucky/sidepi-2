<?php $this->load->view('partials/print_header');
?>
<section class="bayar">
  <h4 class="text-center">Rencana Anggaran Biaya (RAB) <?= ($rab->type == 'p') ? 'Properti' : 'Unit' ?></h4>
  <ol class="inner">
    <?php $no = 1; foreach ($kelompok_rab as $key1 => $value1) { 
        $detail_rab = getDataWhere("*","tbl_rab",["id_kelompok"=>$value1["id_kelompok"],"id_rab"=>$rab->id_rab])->result();
        if ($detail_rab != null) { ?>
    <li>
      <small class="f-14"><?php echo $no.". ".ucwords($value1["nama_kelompok"]); ?></small>
    </li>
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

          <?php } else { ?>
          <tr>
            <td colspan="6" class="text-center" style="padding:20px">Data Kosong</td>
          </tr>

          <?php } ?>
        </tbody>
      </table>
    </li>
    <?php $no++; } } ?>
    <li class="mt-2 text-right"><small class="f-14">Total Keseluruhan(Rp) : </small><small
        class="font-weight"><?= number_format($rab->total_anggaran,2,",",".") ?></small></li>
  </ol>

  <div class="absolute">
    <small class="d-inline-block">Pembuat : </small><small
      class="d-inline-block">&nbsp;<?= $pembuat["nama_lengkap"] ?></small>
  </div>
</section>
<?php $this->load->view('partials/print_footer'); ?>