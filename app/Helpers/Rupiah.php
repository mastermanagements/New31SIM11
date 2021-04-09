<?php
function Rupiah($angka)
{
  $rupiah = number_format($angka, 0, ".", ".");
  return $rupiah;
}
?>
