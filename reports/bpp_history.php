<?php
session_start();

/**
 * 	Check if user already logged in
 */
if (!isset($_SESSION['username']) && !isset($_SESSION['level'])) {
  // form filled -> process sign in and refresh if success
  if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['action']) && $_POST['action'] == "sign_in") {
    $userclass->sign_in($_POST['username'], $_POST['password']);
  }
  // form didn't fill / illegal request -> redirect to login page
  else {
    header("Location: ../index.php");
    die();
  }
}


require_once('../vendor/autoload.php');
require_once('../class/bpp.class.php');
require_once('../class/inventory.class.php');
$bppClass = new BppClass();
$invClass = new Inventory();
// Parameter BPP nya adalah bpp_history_nomor
if (isset($_GET['history'])) {
  $bpp_s = $bppClass->get_all_bpp_by_bpp_history_nomor($_GET['history']);
} else {
  $bpp_s = $bppClass->get_all_bpp();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BPP Reports</title>

  <link rel="stylesheet" href="../assets/css/bootstrap5.min.css">
  <link rel="stylesheet" href="../assets/css/bpp-report.css">
</head>

<body>
  <header class="header">
    <div class="row g-0 w-100">
      <div class="col-1">
        <img class="logo" src="../assets/images/logo.png" alt="">
      </div>
      <div class="col-1"></div>
      <div class="col-10">
        <h1 class="title fw-bold text-center text-uppercase">perusahaan daerah air minum <br> tirta albani <br> kabupaten serang</h1>
        <div class="location text-center fw-bold">
          <p><small><?= $invClass->setting_data("inventory_location"); ?></small></p>
        </div>
      </div>
      <div class="hr-2"></div>
      <div class="hr-1 mt-05"></div>
    </div>
  </header>

  <main>
    <div class="subtitle text-center mt-5">
      <h2 class=" fw-bold text-uppercase text-decoration-underline">bukti permintaan dan pengeluaran barang (BPP)</h2>
      <p class="text-capitalize">dimintal oleh bagian: ..............................................</p>
    </div>

    <table class="table table-sm table-bordered border-black">
      <thead class="thead text-capitalize text-center">
        <tr>
          <th colspan="3">yang diminta</th>
          <th rowspan="2" class="align-middle">uraian</th>
          <th colspan="4">dikeluarkan</th>
        </tr>
        <tr class="align-middle">
          <th>banyak</th>
          <th>satuan</th>
          <th>kode barang</th>
          <!--  -->
          <th>banyak</th>
          <th>satuan</th>
          <th>kode barang</th>
          <th>Jumlah</th>
        </tr>
      </thead>
      <tbody class="tbody">
        <?php foreach ($bpp_s as $key => $bpp) { ?>
          <tr class="align-middle">
            <td><?= $bpp['request_quantity'] ?></td>
            <td><?= $bpp['request_unit'] ?></td>
            <td><?= $bpp['type_name'] ?></td>
            <td><?= $bpp['request_description'] ?></td>
            <td><?= $bpp['request_quantity'] ?></td>
            <td><?= $bpp['out_quantity'] ?></td>
            <td><?= $bpp['out_unit'] ?></td>
            <td><?= $bpp['out_total'] ?></td>
          </tr>
        <?php } ?>
        <tr>
          <td colspan="2" rowspan="3" class="align-middle text-center" style="border-right-color: transparent">
            dipergunakan untuk:
          </td>
          <td colspan="6" style="border-bottom-width: 1px; border-bottom-color: transparent;">
            <hr class="mb-0 bg-black opacity-100 mt-4">
          </td>
        </tr>
        <tr>
          <td colspan="6">
            <hr class="mb-0 bg-black opacity-100">
          </td>
        </tr>
      </tbody>
    </table>
    <!-- ttd -->
    <div class="ttd-wrapper">
      <div class="row g-0 w-100 ttd border border-black">
        <div class="col-3 py-2 border-end border-black text-center">
          Diterima oleh: Tgl.
        </div>
        <div class="col-6 py-2 border-end border-black text-center">
          Disetujui oleh: Tgl.
        </div>
        <div class="col-3 py-2 text-capitalize text-center">
          mengetahui kabag. teknik perencanaan & logistik
        </div>
      </div>
      <div class="row g-0 w-100 ttd border border-black border-top-0">
        <div class="col-6 py-2 text-center border-end border-black">
          Barang yang diminta telah diterima
        </div>
        <div class="col-6 py-2 text-center">
          Dikeluarkan oleh: <br>
          Kasubag Logistik
        </div>
      </div>
    </div>
  </main>

  <script>
    window.PagedConfig = {
        // Setelah halaman ke render barulah tampilkan dialog print
        after: (flow) => { window.print(); },
    };
  </script>
  <script src="../assets/js/paged.polyfill.js"></script>
</body>

</html>