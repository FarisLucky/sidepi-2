<?php $this->load->view('partials/print_header'); ?>
<div class="container" id="print_spr">
  <div class="title text-center">
    <h3>Surat Pemesanan Rumah</h3>
  </div>
  <div class="content">
    <small class="mb-1 d-inline-block">Yang bertanda tangan dibawah ini :</small>
    <ol class="inner">
      <li><small class="d-inline-block mr-2">Nama : </small><small
          class="font-weight d-inline-block"><?= $konsumen['nama_lengkap'] ?></small></li>
      <li><small class="d-inline-block mr-2">Alamat : </small><small
          class="font-weight d-inline-block"><?= $konsumen['alamat'] ?></small></li>
      <li><small class="d-inline-block mr-2"><?= $konsumen['id_type'] ?> : </small><small
          class="font-weight d-inline-block"><?= $konsumen['id_card'] ?></small></li>
    </ol>
    <div class="row mt-2">
      <small class="d-inline-block">Dengan ini menyatakan telah memesan tanah dan atau bangunan kepada <small
          class="font-weight-1"><?= $unit['nama_properti'] ?></small> sebagai berikut :</small>
    </div>
    <ol class="list">
      <li>
        <small class="mr-2">Tahap Tanah : </small><small class="font-weight-1">Luas <?= $unit['luas_tanah'] ?></small>
      </li>
      <li>
        <small class="mr-2 mt-2">Tahap Bangunan : </small><small class="font-weight-1">Luas
          <?= $unit['luas_bangunan'] ?></small>
      </li>
      <li>
        <small class="mr-2">Yang terletak di kavling No. <small
            class="font-weight-1"><?= $unit['nama_unit'] ?></small></small>
      </li>
      <li>
        <small class="d-block">Dengan harga yang diperhitungkan sebagai berikut :</small>
        <ol class="mt-2 inner">
          <li>
            <input type="checkbox"><small class="d-inline-block mr-2">Tanah dan/atau Bangunan : </small>
          </li>
          <li>
            <input type="checkbox"><small class="d-inline-block mr-2">PPN (Pajak Pertambahan Nilai) : </small>
          </li>
          <li>
            <input type="checkbox"><small class="d-inline-block mr-2">Biaya Akte Jual Beli (PPAT) : </small>
          </li>
          <li>
            <input type="checkbox"><small class="d-inline-block mr-2">BBN (Bea Balik Nama) : </small>
          </li>
        </ol>
      </li>
    </ol>
    <div class="row">
      <small class="mr-2 font-weight-1"><?= $spr['setting_spr'] ?></small>
    </div>
    <br>
    <table class="no-border">
      <tbody class="unborder">
        <tr>
          <td>
            <div style="width: 150px;position: relative;text-align: center;">
              <div style="position: relative;">Pengembang</div>
              <div style="position: relative;top: 100px;font-weight:bold;"><?= strtoupper($img->pemilik) ?></div>
            </div>
          </td>
          <td>
            <div style="width: 150px;position: relative;text-align: center;">
              <div style="position: relative;">Sales</div>
              <div style="position: relative;top: 100px;font-weight:bold;"><?= strtoupper($pembuat) ?></div>
            </div>
          </td>
          <td>
            <div style="width: 150px;position: relative;text-align: center;">
              <div style="position: relative;">Pemesan</div>
              <div style="position: relative;top: 100px;font-weight:bold;"><?= strtoupper($konsumen['nama_lengkap']) ?>
              </div>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<?php $this->load->view('partials/print_footer'); ?>