<?php
function rupiahView($angka)
{
  $rupiah = number_format($angka, 0, ".", ".");
  return $rupiah;
}
function rupiahController($angka)
{
  $rupiah = str_replace(".", "", $angka);
  return $rupiah;
}
?>
