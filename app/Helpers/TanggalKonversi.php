<?php
function tanggalView($date)
{
  $tgl_view = date('d-m-Y',strtotime($date));
  return $tgl_view;
}
function tanggalController($date)
{
  $tgl_controller = date('Y-m-d',strtotime($date));
  return $tgl_controller;
}

?>
