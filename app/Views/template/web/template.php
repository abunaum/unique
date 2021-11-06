<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Minecraft Graphics | Designs & Templates</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="Bootstrap Ecommerce" name="keywords">
  <meta content="Bootstrap Ecommerce" name="description">

  <!-- Favicon -->
  <link href="<?= base_url('images/favicon.ico') ?>" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet">

  <!-- CSS Libraries -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

  <!-- Template Stylesheet -->
  <link href="<?= base_url('css/style.css') ?>" rel="stylesheet">

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" id="theme-styles">
</head>

<body>
  <!-- Top Header Start -->
  <div class="container">
    <header class="header_section">
      <nav class="navbar navbar-expand-lg custom_nav-container ">
        <a class="navbar-brand" href="<?= base_url() ?>">
          <img src="<?= base_url('images/header-logo.png') ?>" alt="" />
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class=""> </span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ">
            <div class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle active" data-toggle="dropdown">Templates</a>
              <div class="dropdown-menu" id="menu">
              </div>
            </div>
            <div class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle active" data-toggle="dropdown">Discord</a>
              <div class="dropdown-menu">
                <a href="#" class="dropdown-item"><iframe src="https://discord.com/widget?id=638991760269377536&theme=dark" width="250" height="250" allowtransparency="true" frameborder="0" sandbox="allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"></iframe></a>
              </div>
            </div>
            <div class="nav-item dropdown">
              <a href="#" title="Language" class="nav-link" data-toggle="dropdown" aria-expanded="true">
                <img src="<?= base_url('images/id.png') ?>" alt="flag" class="mr-2 " title="Indonesia"> ID <i class="fa fa-angle-down ml-2" aria-hidden="true"></i>
              </a>
              <div class="dropdown-menu">
                <a href="<?= base_url('en') ?>" class="dropdown-item">
                  <img src="<?= base_url('images/uk.png') ?>" class="mr-2" alt="flag">
                  EN
                </a>
              </div>
            </div>
          </ul>
        </div>
      </nav>
  </div>
  </header>
  <?= $this->renderSection('content'); ?>

  <!-- Footer Starts Here -->
  <div class="container">
    <div class="footer">
      <div class="row">
        <div class="col-md-12">
          <h3 class="title">Tautan Cepat</h3>
          <div class="footer-menu">
            <ul>
              <div class="d-inline">
                <li><a href="<?= base_url('layanan') ?>">Ketentuan Layanan</a></li>
                <li><a href="<?= base_url('privasi') ?>">Kebijakan Privasi</a></li>
                <li><a href="<?= base_url('tentang') ?>">Tentang Kami</a></li>
              </div>
              <?php
              $db      = \Config\Database::connect();
              $menu = $db->table('menu')->get()->getResult();
              ?>
              <div class="d-inline" id="hal">
                <?php
                foreach ($menu as $m) :
                ?>
                  <li><a href="<?= base_url('category/' . $m->id) ?>"><?= $m->nama; ?></a></li>
                <?php endforeach; ?>
              </div>
            </ul>
          </div>
        </div>
        <div class="row payment">
          <div class="col-md-12 pl-md-0">
            <div class="payment-method">
              <h3>Saluran Pembayaran</h3>
              <img height="65" src="<?= base_url('images/qris.png') ?>" />
              <img height="65" src="<?= base_url('images/bca.png') ?>" />
              <img height="65" src="<?= base_url('images/bri.png') ?>" />
              <img height="65" src="<?= base_url('images/bni.png') ?>" />
              <img height="65" src="<?= base_url('images/maybank.png') ?>" />
              <img height="65" src="<?= base_url('images/mandiri.png') ?>" />
              <img height="65" src="<?= base_url('images/cimb.png') ?>" />
              <img height="65" src="<?= base_url('images/permata.png') ?>" />
              <img height="65" src="<?= base_url('images/alfamart.png') ?>" />
              <img height="65" src="<?= base_url('images/alfamidi.png') ?>" />
              <img height="65" src="<?= base_url('images/paypal.png') ?>" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer End Here -->
  <!-- Sub Footer Starts Here -->
  <div class="container">
    <div class="sub-footer">
      <div class="row">
        <div class="col-md-12">
          <div class="copyright-text">
            <p>Copyright &copy; <?= date('Y') ?> <?= $_SERVER['HTTP_HOST'] ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Sub Footer Ends Here -->

  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
  <script>
    url_item = '<?= base_url('api/cek_item') ?>';
    $.ajax({
      url: url_item,
      type: 'POST',
      async: true,
      dataType: 'json',
      success: function(data) {
        var hal = '';
        var count = 1;
        var i;
        $("#menu").empty();
        for (i = 0; i < data.length; i++) {
          menu += '<a href="<?= base_url('category') . '/' ?>' + data[i].id + '" class="dropdown-item">' + data[i].nama + '</a>';
          hal += '<li><a href="<?= base_url('category') . '/' ?>' + data[i].id + '">' + data[i].nama + '</a></li>';
        }
        $('#menu').html(menu);
        $('#hal').html(hal);
      }
    });

    var conn = new WebSocket('ws://localhost:5051');
    conn.onopen = function(e) {
      console.log("Connection established!");
    };

    conn.onmessage = function(e) {
      if (e.data == 'edit_item') {
        url_item = '<?= base_url('api/cek_item') ?>';
        $.ajax({
          url: url_item,
          type: 'POST',
          async: true,
          dataType: 'json',
          success: function(data) {
            var menu = '';
            var hal = '';
            var count = 1;
            var i;
            $("#menu").empty();
            for (i = 0; i < data.length; i++) {
              menu += '<a href="<?= base_url('category') . '/' ?>' + data[i].id + '" class="dropdown-item">' + data[i].nama + '</a>';
              hal += '<li><a href="<?= base_url('category') . '/' ?>' + data[i].id + '">' + data[i].nama + '</a></li>';
            }
            $('#menu').html(menu);
            $('#hal').html(hal);
          }
        });
      }
    };
  </script>
</body>

</html>