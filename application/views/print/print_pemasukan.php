<?php $this->load->view('partials/print_header');
// var_dump($detail_bayar);
?>
<section class="bayar">
  <h4 class="text-center">Pemasukan</h4>
  <div class="table">
    <table class="text-center p-table border-table" style="border:0px;">
      <thead>
        <tr>
          <th>Pengeluaran</th>
          <th>Kelompok</th>
          <th>Tanggal buat</th>
          <th>Jumlah</th>
          <th>Harga Satuan</th>
          <th>Total Harga</th>
        </tr>
      </thead>
      <tbody style="padding: 20px 0px;">
        <tr>
          <td><?= $detail_bayar['nama_pemasukan'] ?></td>
          <td><?= $detail_bayar['nama_kelompok'] ?></td>
          <td>
            <?php $date = DateTime::createFromFormat("Y-m-d",$detail_bayar['tgl_buat']); echo tanggal($date->format("d"),$date->format("m"),$date->format("Y")) ?>
          </td>
          <td><?= $detail_bayar['volume']." ".$detail_bayar["satuan"] ?></td>
          <td><?= number_format($detail_bayar['harga_satuan'],2,',','.'); ?></td>
          <td><?= number_format($detail_bayar['total_harga'],2,',','.'); ?></td>
        </tr>
        <tr>
          <td colspan="5"> Total :</td>
          <td> <?= number_format($detail_bayar['total_harga'],2,',','.');  ?></td>
        </tr>
        <tr>
          <td class="no-border" colspan="5"></td>
          <td class="no-border">
            <div style="margin-top: 70px;">
              <small style="font-size: 15px;height: 120px;display:block;">Pembuat</small>
              <small style="font-size: 15px; font-weight: bold;"><?= $detail_bayar['nama_lengkap'] ?></small>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</section>
<?php $this->load->view('partials/print_footer'); ?>