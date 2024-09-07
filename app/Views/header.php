<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $captcha_response = $_POST['g-recaptcha-response'];

  if (!$captcha_response) {
    echo "Please complete the CAPTCHA.";
  } else {
    $secret_key = "6LdYgCAqAAAAAN8SME6rILvn3TR2fxT1lqxoFIkb";

    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = [
      'secret' => $secret_key,
      'response' => $captcha_response
    ];
    $options = [
      'http' => [
        'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
        'method' => 'POST',
        'content' => http_build_query($data)
      ]
    ];
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    $result_json = json_decode($result);
    if ($result_json && $result_json->success) {
      echo "CAPTCHA is valid. Proceed with login process.";
    } else {
      echo "Failed to verify CAPTCHA. Please try again.";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('img/apple-icon.png') ?>">
  <link rel="icon" type="image/png" href="<?= base_url('images/' . $yogi->tab_icon) ?>">
  <title>
    <?= $yogi->nama_website ?>
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="<?= base_url('css/nucleo-icons.css') ?>" rel="stylesheet" />
  <link href="<?= base_url('css/nucleo-svg.css') ?>" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="<?= base_url('css/nucleo-svg.css') ?>" rel="stylesheet" />

  <!-- CSS Files -->
  <link id="pagestyle" href="<?= base_url('css/argon-dashboard.css?v=2.0.4') ?>" rel="stylesheet" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
  <style>
    #map {
      height: 500px;
      width: 100%;
    }

    .button-container {
      margin-top: 10px;
      position: relative;
    }

    .autocomplete-list {
      border: 1px solid #ccc;
      border-top: none;
      max-height: 150px;
      overflow-y: auto;
      position: absolute;
      background: white;
      width: 100%;
      z-index: 1000;
    }

    .autocomplete-list div {
      padding: 10px;
      cursor: pointer;
    }

    .autocomplete-list div:hover {
      background-color: #e9e9e9;
    }

    body {
      display: flex;
    }

    .main-content {
      flex: 2;
    }

    .navbar {
      position: fixed;
      top: 0;
      /* Pastikan ini lebih tinggi dari elemen lain */
    }
  </style>



</head>