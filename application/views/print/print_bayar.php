<?php $this->load->view('partials/print_header'); ?>
<section class="bayar">
  <h4 class="text-center">Pembayaran</h4>
  <div style="font-size: 15px; margin: 10px 0px;display:block;">Tagihan :
    <small style="font-weight: bold;"><?= number_format($bayar['total_tagihan'],2,',','.'); ?></small>
  </div>
  <div style="font-size: 15px; margin: 10px 0px;display:block;">Bayar :
    <small style="font-weight: bold;"><?= number_format($bayar['total_bayar'],2,',','.'); ?></small>
  </div>
  <div style="font-size: 15px; margin: 10px 0px;display:block;">Hutang :
    <small style="font-weight: bold;"><?= number_format($bayar['hutang'],2,',','.'); ?></small>
  </div>
  <div class="table">
    <table class="text-center p-table border-table" style="border:0px;">
      <thead>
        <tr>
          <th>Pembayaran</th>
          <th>Tanggal Bayar</th>
          <th>Pembuat</th>
          <th>Jumlah Bayar</th>
        </tr>
      </thead>
      <tbody style="padding: 20px 0px;">
        <tr>
          <td><?= $detail_bayar['nama_pembayaran'] ?></td>
          <td>
            <?php $date = DateTime::createFromFormat("Y-m-d H:i:s",$detail_bayar['tgl_bayar']); echo tanggal($date->format("d"),$date->format("m"),$date->format("Y")).' '.$date->format('H:i:s') ?>
          </td>
          <td><?= $detail_bayar['nama_lengkap'] ?></td>
          <td><?= number_format($detail_bayar['jumlah_bayar'],2,',','.'); ?></td>
        </tr>
        <tr>
          <td colspan="3"> Total :</td>
          <td> <?= number_format($detail_bayar['jumlah_bayar'],2,',','.');  ?></td>
        </tr>
        <tr>
          <td class="no-border" colspan="3"></td>
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