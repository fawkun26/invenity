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
if (isset($_GET['jenis'])) {
  if ($_GET['jenis'] == 'bpp_history') {
    if (isset($_GET['history'])) {
      $bpp_s = $bppClass->get_all_bpp_by_bpp_history_nomor($_GET['history']);
    } else {
      $bpp_s = $bppClass->get_all_bpp();
    }
  } elseif ($_GET['jenis'] == 'bpp') {
    if (isset($_GET['tanggal'])) {
      $bpp_s = $bppClass->get_all_bpp_by_tanggal($_GET['tanggal']);
    } elseif (isset($_GET['bulan'])) {
      $bpp_s = $bppClass->get_all_bpp_by_bulan($_GET['bulan']);
    } elseif (isset($_GET['tahun'])) {
      $bpp_s = $bppClass->get_all_bpp_by_tahun($_GET['tahun']);
    } else {
      $bpp_s = $bppClass->get_all_bpp();
    }
  }
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
      <div class="col-8 d-flex align-items-center">
        <div class="title h3 fw-bold text-uppercase mb-0">
          <div class="title-span-1 mb-05" style="font-size: 18px;">PERUSAHAAN UMUM DAERAH AIR MINUM</div>
          <div class="title-span-2 mb-05">TIRTA ALBANTANI</div>
          <div class="title-span-3 mb-05" style="font-size: 18px; letter-spacing: 3px;">KABUPATEN SERANG</div>
        </div>
      </div>
      <div class="col-4 text-end">
        <img class="logo" src="../assets/images/logo-2.svg" alt="">
      </div>
      <div class="hr-5  mt-1" style="background-color: #8acfe6;"></div>
    </div>
  </header>


  <div class="footer">
    <div class="footer-address d-flex justify-content-center align-items-center">Jl. Raya Sentul Desa Kendayakan Kecamatan Keragilan Serang Telp. (0254) 201443 Fax. (0254) 201443</div>
    <div class="footer-web d-flex justify-content-center align-items-center"><?= substr($invClass->get_web_address(), 4) ?></div>
  </div>


  <main class="pt-5" style="padding-bottom: 12rem;">
    <div class="subtitle text-center">
      <h2 id="title" class="fw-bold text-uppercase text-decoration-underline">bukti permintaan dan pengeluaran barang (BPP)</h2>
      <p class="text-capitalize">dimintal oleh bagian: ..............................................</p>
    </div>

    <table class="table table-sm table-bordered border-black mb-0" id="table">
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
          <tr class="align-middle break-inside-avoid">
            <td style="text-align: center; width: 54px;"><?= $bpp['request_quantity'] ?></td>
            <td style="text-align: center; width: 54px;"><?= $bpp['request_unit'] ?></td>
            <td><?= $bpp['type_name'] ?> (<?= $bpp['type_code'] ?>) (<?= $bpp['device_serial'] ?>)</td>
            <td><?= $bpp['request_description'] ?></td>
            <td style="text-align: center; width: 54px;"><?= $bpp['out_quantity'] ?></td>
            <td><?= $bpp['out_unit'] ?></td>
            <td><?= $bpp['type_name'] ?> (<?= $bpp['type_code'] ?>) (<?= $bpp['device_serial'] ?>)</td>
            <td style="text-align: center; width: 54px;"><?= $bpp['out_total'] ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
    <table class="table table-sm table-bordered border-black break-inside-avoid" style="margin-top: -1px;">
      <tbody>
        <tr>
          <td rowspan="3" class="align-middle text-center" style="border-right-color: transparent; width: 170px;">
            dipergunakan untuk:
          </td>
          <td style="border-bottom-width: 1px; border-bottom-color: transparent;">
            <hr class="mb-0 bg-black opacity-100 mt-4">
          </td>
        </tr>
        <tr>
          <td>
            <hr class="mb-0 bg-black opacity-100">
          </td>
        </tr>
      </tbody>
    </table>

    <!-- ttd -->
    <?php
    $setting['diminta'] = '______________';
    $setting['diterima'] = '______________';
    $setting['kasubag_logistik'] = '______________';
    $setting['gm_teknik_1'] = '______________';
    $setting['gm_teknik_2'] = '______________';
    $setting['kabag'] = '______________';
    if ($_GET['jenis'] == 'bpp_history') {
      if (isset($_SESSION['bpp_history_report_setting'])) {
        $setting = $_SESSION['bpp_history_report_setting'];
      }
    }
    if ($_GET['jenis'] == 'bpp') {
      if (isset($_SESSION['bpp_report_setting'])) {
        $setting = $_SESSION['bpp_report_setting'];
      }
    }
    ?>
    <div class="ttd-wrapper break-inside-avoid" id="ttd_wrapper">
      <div class="row g-0 w-100 ttd border border-black">
        <div class="col-3 py-2 border-end border-black text-center d-flex justify-content-between align-items-center flex-column">
          <div>
            Diterima oleh: Tgl.
          </div>
          <hr style="width: 80%; margin-top: -20px; opacity: 1;">
          <div>
            ( <?= $setting['diminta'] ?> )
          </div>
        </div>
        <div class="col-6 py-2 border-end border-black text-center">
          <div>
            Disetujui oleh: Tgl.
          </div>
          <div class="row g-0 h-100" style="padding-bottom: 1.25rem;">
            <div class="col d-flex flex-column justify-content-between align-items-center">
              <div>GM. Teknik</div>
              <div>( <?= $setting['gm_teknik_1'] ?>)</div>
            </div>
            <div class="col d-flex flex-column justify-content-between align-items-center">
              <div></div>
              <div>( <?= $setting['gm_teknik_2'] ?>)</div>
            </div>
          </div>
        </div>
        <div class="col-3 py-2 text-capitalize text-center d-flex flex-column justify-content-between align-items-center">
          <div>
            mengetahui kabag. teknik perencanaan & logistik
          </div>
          <div>
            ( <?= $setting['kabag'] ?> )
          </div>
        </div>
      </div>
      <div class="row g-0 w-100 ttd border border-black border-top-0">
        <div class="col-6 py-2 text-center border-end border-black d-flex flex-column justify-content-between align-items-center">
          <div>
            Barang yang diminta telah diterima
          </div>
          <div>
            ( <?= $setting['diterima'] ?> )Tgl.
          </div>
        </div>
        <div class="col-6 py-2 text-center d-flex flex-column justify-content-between align-items-center">
          <div>
            Dikeluarkan oleh: <br>
            Kasubag Logistik
          </div>
          <div>
            ( <?= $setting['kasubag_logistik'] ?> )Tgl.
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="../assets/js/jquery-1.11.3.min.js"></script>
  <script>
    // documentation on https://www.pagedjs.org/documentation/ atau https://www.npmjs.com/package/pagedjs
    window.PagedConfig = {
      // auto: false, 
      // // Sebelum halaman di render
      // before: () => {
      //   return new Promise((resolve, reject) => {
      //     if (tableHeight > 500) {

      //     } else {
      //       resolve();
      //     }
      //   });
      // },
      // Setelah halaman di render 
      after: (flow) => {
        const ttdWrapper = document.getElementById('ttd_wrapper');
        const footers = document.querySelectorAll('.footer');
        Array.from(footers).forEach(function(el, index) {
          console.log('index: ', index);
          console.log('parent: ', el.parentElement.nodeName);
          console.log('parent: ', el.parentElement.classList.contains('pagedjs_margin-content'));
          if (el.parentElement.classList.contains('pagedjs_margin-content')) {
            el.style.display = 'flex';
          }
        })
        ttdWrapper.classList.add('position-absolute', 'bottom-0', 'w-100');
        // barulah tampilkan dialog print
        // window.print();
      },
    };
  </script>
  <script src="../assets/js/paged.polyfill.js"></script>
</body>

</html>