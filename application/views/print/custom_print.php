<?php
$base_file = $link;
header("Content-type: application/pdf");
header("Content-disposition: inline; filename=".$name);
header("Content-Transfer-Encoding: binary");
header('Accept-Ranges; bytes');
readfile($base_file);