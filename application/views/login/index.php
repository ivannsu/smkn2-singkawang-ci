<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?= $title; ?> - SMK Negeri 2 Singkawang</title>
  <?= link_tag('assets/css/toastr/toastr.min.css'); ?>
  <?= link_tag('assets/css/spinner.css'); ?>
  <style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body {
    background-color: #f5f6fa;
    font-family: sans-serif;
  }

  .login-container {
    width: 350px;
    background-color: #ffffff;
    padding: 40px;
    margin: 0 auto;
    border: 1px solid #ccc;
    border-radius: 5px;
  }

  .login-heading {
    padding-top: 0px;
    padding-bottom: 20px;
  }

  .login-heading h3 {
    text-align: center;
  }

  input {
    width: 100%;
    outline: none;
    padding: 10px 20px;
    margin: 5px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
  }

  input:focus {
    border-color: #333;
  }

  .login-button {
    padding: 10px 20px;
    margin: 7px 0;
    width: 100%;
    border: 1px solid #ccc;
    background-color: #f5f6fa;
    border-radius: 4px;
    font-size: 0.8em;
    letter-spacing: 1px;
  }

  .login-button:hover {
    cursor: pointer;
    background-color: orange;
    color: #fff;
  }

  .img-container {
    text-align: center;
    padding-top: 70px;
    padding-bottom: 50px;
  }

  .img-container img {
    max-width: 170px;
  }

  </style>
  <script>
  let BASE_URL = '<?= base_url(); ?>'
  let SITE_URL = '<?= site_url(); ?>'
  </script>
  <script src="<?= base_url('assets/js/jquery/jquery-3.3.1.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/toastr/toastr.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/backend.js'); ?>"></script>
</head>
<body>
  <?php
  $this->load->view($content);
  ?>
</body>
</html>