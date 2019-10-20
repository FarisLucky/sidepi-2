<?php $this->load->view('partials/print_header');
// var_dump($detail_bayar);
?>
<section class="bayar">
  <h4 class="text-center">List Unit</h4>
  <div class="table">
    <table class="text-center p-table border-table" style="border:0px;">
      <thead>
        <tr>
          <th>Unit</th>
          <th>properti</th>
          <th>Luas Tanah</th>
          <th>Luas Bangunan</th>
          <th>Harga</th>
          <th>Status</th>
          <th>Alamat</th>
          <th>Deskripsi</th>
        </tr>
      </thead>
      <tbody style="padding: 20px 0px;">
        <?php foreach ($unit as $key => $value) {
          if ($value['status_unit'] == "bt") {
            $status = 'Belum Terjual';
          } elseif ($value['status_unit'] == 'b') {
            $status = 'Booking';
          } else {
            $status = 'Sudah Terjual';
          }  
        ?>
        <tr>
          <td><?= $value['nama_unit'] ?></td>
          <td><?= $value['nama_properti'] ?></td>
          <td><?= $value['luas_tanah']." ".$value['satuan_tanah'] ?></td>
          <td><?= $value['luas_bangunan']." ".$value['satuan_bangunan'] ?></td>
          <td><?= number_format($value['harga_unit'],2,',','.'); ?></td>
          <td><?= $status; ?></td>
          <td><?= $value['alamat_unit'] ?></td>
          <td><?= $value['deskripsi'] ?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</section>
<?php $this->load->view('partials/print_footer'); ?>