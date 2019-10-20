<?php 
$this->load->view('partials/print_header');
?>

<div class="cover-text">
  <h3 class="text-center mb-1">Data Konsumen</h3>
  <table class="no-border">
    <tbody class="unborder">
      <tr>
        <td>
          <h4>Data Diri</h4>
        </td>
      </tr>
      <tr>
        <td class="w-tr">
          <small class="txt-title"><?= ucwords($rs_konsumen['id_type']) ?></small>
        </td>
        <td>
          <small class="txt-title">: <?= ucwords($rs_konsumen['id_card']) ?></small>
        </td>
      </tr>
      <tr>
        <td class="w-tr">
          <small class="txt-title">Nama Konsumen</small>
        </td>
        <td>
          <small class="txt-title">: <?= ucwords($rs_konsumen['nama_lengkap']) ?></small>
        </td>
      </tr>
      <tr>
        <td class="w-tr">
          <small class="txt-title">Jenis Kelamin</small>
        </td>
        <td>
          <small class="txt-title">: <?= $rs_konsumen['jenis_kelamin'] == 'l' ? 'Laki laki' : 'Perempuan'; ?></small>
        </td>
      </tr>
      <tr>
        <td class="w-tr">
          <small class="txt-title">Tanggal Lahir</small>
        </td>
        <td>
          <small class="txt-title">: <?php $d = DateTime::createFromFormat("Y-m-d",$rs_konsumen['tgl_lahir']); echo
          tanggal($d->format('d'),$d->format('m'),$d->format('Y')) ?></small>
        </td>
      </tr>
      <tr>
        <td class="w-tr">
          <small class="txt-title">Alamat</small>
        </td>
        <td>
          <small class="txt-title">: <?= $rs_konsumen['alamat']; ?></small>
        </td>
      </tr>
      <tr>
        <td class="w-tr">
          <small class="txt-title">Telepon</small>
        </td>
        <td>
          <small class="txt-title">: <?= $rs_konsumen['telp']; ?></small>
        </td>
      </tr>
      <tr>
        <td class="w-tr">
          <small class="txt-title">Status Nikah</small>
        </td>
        <td>
          <small class="txt-title">: <?= $rs_konsumen['status_nikah']; ?></small>
        </td>
      </tr>
      <tr>
        <td class="w-tr">
          <small class="txt-title">Email</small>
        </td>
        <td>
          <small class="txt-title">: <?= $rs_konsumen['email']; ?></small>
        </td>
      </tr>
      <tr>
        <td class="w-tr">
          <small class="txt-title">NPWP</small>
        </td>
        <td>
          <small class="txt-title">: <?= $rs_konsumen['npwp']; ?></small>
        </td>
      </tr>
      <tr>
        <td>
          <h4>Data Pasangan</h4>
        </td>
      </tr>
      <tr>
        <td class="w-tr">
          <small class="txt-title">Nama Pasangan</small>
        </td>
        <td>
          <small class="txt-title">: <?= $rs_konsumen['nama_pasangan']; ?></small>
        </td>
      </tr>
      <tr>
        <td class="w-tr">
          <small class="txt-title">Hubungan dengan konsumen</small>
        </td>
        <td>
          <small class="txt-title">: <?= $rs_konsumen['hubungan_pasangan']; ?></small>
        </td>
      </tr>
      <tr>
        <td class="w-tr">
          <small class="txt-title">Alamat Pasangan</small>
        </td>
        <td>
          <small class="txt-title">: <?= $rs_konsumen['alamat_pasangan']; ?></small>
        </td>
      </tr>
      <tr>
        <td class="w-tr">
          <small class="txt-title">Telepon Pasangan</small>
        </td>
        <td>
          <small class="txt-title">: <?= $rs_konsumen['telp_pasangan']; ?></small>
        </td>
      </tr>
      <tr>
        <td>
          <h4>Data Pekerjaan Konsumen</h4>
        </td>
      </tr>
      <tr>
        <td class="w-tr">
          <small class="txt-title">Nama Kantor</small>
        </td>
        <td>
          <small class="txt-title">: <?= $rs_konsumen['nama_perusahaan']; ?></small>
        </td>
      </tr>
      <tr>
        <td class="w-tr">
          <small class="txt-title">Telepon Kantor</small>
        </td>
        <td>
          <small class="txt-title">: <?= $rs_konsumen['telp_perusahaan']; ?></small>
        </td>
      </tr>
      <tr>
        <td class="w-tr">
          <small class="txt-title">Jenis Pekerjaan</small>
        </td>
        <td>
          <small class="txt-title">: <?= $rs_konsumen['jenis_pekerjaan']; ?></small>
        </td>
      </tr>
      <tr>
        <td class="w-tr">
          <small class="txt-title">Bidang Usaha</small>
        </td>
        <td>
          <small class="txt-title">: <?= $rs_konsumen['bidang_usaha']; ?></small>
        </td>
      </tr>
      <tr>
        <td class="w-tr">
          <small class="txt-title">Jabatan Pekerjaan</small>
        </td>
        <td>
          <small class="txt-title">: <?= $rs_konsumen['jabatan']; ?></small>
        </td>
      </tr>
      <tr>
        <td class="w-tr">
          <small class="txt-title">Alamat Kantor</small>
        </td>
        <td>
          <small class="txt-title">: <?= $rs_konsumen['alamat_perusahaan']; ?></small>
        </td>
      </tr>
      <tr>
        <td class="w-tr">
          <small class="txt-title">Nama Atasan</small>
        </td>
        <td>
          <small class="txt-title">: <?= $rs_konsumen['nama_atasan']; ?></small>
        </td>
      </tr>
      <tr>
        <td class="w-tr">
          <small class="txt-title">Telepon Atasan</small>
        </td>
        <td>
          <small class="txt-title">: <?= $rs_konsumen['telp_atasan']; ?></small>
        </td>
      </tr>
      <tr>
        <td class="w-tr">
          <h4>Data Pekerjaan Pasangan</h4>
        </td>
      </tr>
      <tr>
        <td class="w-tr">
          <small class="txt-title">Nama Kantor</small>
        </td>
        <td>
          <small class="txt-title">: <?= $rs_konsumen['kantor_pasangan']; ?></small>
        </td>
      </tr>
      <tr>
        <td class="w-tr">
          <small class="txt-title">Telepon Kantor</small>
        </td>
        <td>
          <small class="txt-title">: <?= $rs_konsumen['telp_kantor_pasangan']; ?></small>
        </td>
      </tr>
      <tr>
        <td class="w-tr">
          <small class="txt-title">Jenis Pekerjaan</small>
        </td>
        <td>
          <small class="txt-title">: <?= $rs_konsumen['pekerjaan_pasangan']; ?></small>
        </td>
      </tr>
      <tr>
        <td class="w-tr">
          <small class="txt-title">Bidang Usaha</small>
        </td>
        <td>
          <small class="txt-title">: <?= $rs_konsumen['bidang_usaha_p']; ?></small>
        </td>
      </tr>
      <tr>
        <td class="w-tr">
          <small class="txt-title">Jabatan Pekerjaan</small>
        </td>
        <td>
          <small class="txt-title">: <?= $rs_konsumen['jabatan_pasangan']; ?></small>
        </td>
      </tr>
      <tr>
        <td class="w-tr">
          <small class="txt-title">Alamat Kantor</small>
        </td>
        <td>
          <small class="txt-title">: <?= $rs_konsumen['alamat_kantor_pasangan']; ?></small>
        </td>
      </tr>
      <tr>
        <td class="w-tr">
          <small class="txt-title">Nama Atasan</small>
        </td>
        <td>
          <small class="txt-title">: <?= $rs_konsumen['nama_atasan_p']; ?></small>
        </td>
      </tr>
      <tr>
        <td class="w-tr">
          <small class="txt-title">Telepon Atasan</small>
        </td>
        <td>
          <small class="txt-title">: <?= $rs_konsumen['telp_atasan_p']; ?></small>
        </td>
      </tr>
      <tr>
        <td>
          <small class="txt-title">Photo</small>
          <?php if (!empty($rs_konsumen['foto_ktp'])) { ?>
          <img src="<?= FCPATH.'assets/uploads/images/konsumen/'.$rs_konsumen['foto_ktp'] ?>" max-width="150px"
            style="margin-top: 50px;border:1px solid black;" alt="">
          <?php } else { ?>
          <div style="width: 130px;height: 130px;border:1px solid black;text-align: center;margin-top: 50px;">
            photo</div>
          <?php } ?>
        </td>
      </tr>
    </tbody>
  </table>
</div>

<?php
$this->load->view('partials/print_footer');
?>