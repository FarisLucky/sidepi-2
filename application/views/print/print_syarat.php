<?php
$base_file = base_url('assets/uploads/files/konsumen/'.$kons['file']);
header("Content-disposition: attachment; filename=".$kons['nama_kelompok'].".pdf");
header("Content-type: application/pdf");
readfile($base_file);