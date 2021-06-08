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
require_once('../class/device.class.php');
require_once('../class/inventory.class.php');
$bppClass = new BppClass();
$invClass = new Inventory();
$devClass = new DeviceClass();
//  dump(isset($_GET['tanggal']));
if (isset($_GET['device_ids'])) {
  $devs = $devClass->get_with_type_by_id($_GET['device_ids']);
} else {
  // $bpp_s = $bppClass->get_all_bpp();
  $devs = null;
}
// dd($bpp_s);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Stock Opname Check</title>

  <link rel="stylesheet" href="../assets/css/bootstrap5.min.css">
  <link rel="stylesheet" href="../assets/css/bpp-report.css">
</head>

<body>
  
  <table class="table table-sm table-bordered">
    <thead>
      <tr>
        <th>Nama device</th>
        <th>Quantity fisik</th>
        <th>Quantity database</th>
        <th>Selisih</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        if (isset($devs)) {
          foreach ($devs as $dev ) { ?>
            <tr>
              <td><?= $dev['type_name'] ?> type_code=<?= $dev['type_code'] ?> device_serial=<?= $dev['device_serial'] ?></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
    <?php }
        }
      ?>
    </tbody>
  </table>

  <script>
    window.PagedConfig = {
      // auto: false,
        // Setelah halaman ke render maka tampilkan dialog print
        after: (flow) => { window.print(); },
    };
  </script>
  <script src="../assets/js/paged.polyfill.js"></script>
</body>

</html>