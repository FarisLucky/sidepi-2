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
  <header class="kop">
    <table style="border:0px;text-align:center;">
      <tr>
        <td style="border:0px;width:120px;">
          <img src="<?= FCPATH."assets/uploads/images/profil/".$img->logo_perusahaan ?>" class="img-kop">
        </td>
        <td style="border:0px;padding:10px;position:relative;">
          <h3><?= $img->nama ?></h3>
          <p><?= ucfirst($img->alamat) ?></p>
          <small><?= "email : ".ucfirst($img->email)." dan telepon : ".ucfirst($img->telepon) ?></small>
        </td>
      </tr>
    </table>
    <hr>
  </header>