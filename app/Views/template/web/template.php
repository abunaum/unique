<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Minecraft Graphics | Designs & Templates</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="Bootstrap Ecommerce" name="keywords">
  <meta content="Bootstrap Ecommerce" name="description">

  <!-- Favicon -->
  <link href="images/favicon.ico" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet">

  <!-- CSS Libraries -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

  <!-- Template Stylesheet -->
  <link href="css/style.css" rel="stylesheet">
</head>

<body>
  <!-- Top Header Start -->
  <div class="container">
    <header class="header_section">
      <nav class="navbar navbar-expand-lg custom_nav-container ">
        <a class="navbar-brand" href="<?= base_url() ?>">
          <img src="images/header-logo.png" alt="" />
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class=""> </span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ">
            <div class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle active" data-toggle="dropdown">Templates</a>
              <div class="dropdown-menu">
                <?php
                $db      = \Config\Database::connect();
                $menu = $db->table('menu')->get()->getResult();
                ?>
                <?php
                foreach ($menu as $m) :
                ?>
                  <a href="<?= base_url('category/' . $m->id) ?>" class="dropdown-item"><?= $m->nama; ?></a>
                <?php endforeach; ?>
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
                <img src="images/id.png" alt="flag" class="mr-2 " title="Indonesia"> ID <i class="fa fa-angle-down ml-2" aria-hidden="true"></i>
              </a>
              <div class="dropdown-menu">
                <a href="<?= base_url('en') ?>" class="dropdown-item">
                  <img src="images/uk.png" class="mr-2" alt="flag">
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
              <li><a href="<?= base_url('layanan') ?>">Ketentuan Layanan</a></li>
              <li><a href="<?= base_url('privasi') ?>">Kebijakan Privasi</a></li>
              <li><a href="<?= base_url('tentang') ?>">Tentang Kami</a></li>
              <?php
              $db      = \Config\Database::connect();
              $menu = $db->table('menu')->get()->getResult();
              ?>
              <?php
              foreach ($menu as $m) :
              ?>
                <li><a href="<?= base_url('category/' . $m->id) ?>"><?= $m->nama; ?></a></li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
        <div class="row payment">
          <div class="col-md-12 pl-md-0">
            <div class="payment-method">
              <h3>Saluran Pembayaran</h3>
              <img height="65" src="images/qris.png" />
              <img height="65" src="images/bca.png" />
              <img height="65" src="images/bri.png" />
              <img height="65" src="images/bni.png" />
              <img height="65" src="images/maybank.png" />
              <img height="65" src="images/mandiri.png" />
              <img height="65" src="images/cimb.png" />
              <img height="65" src="images/permata.png" />
              <img height="65" src="images/alfamart.png" />
              <img height="65" src="images/alfamidi.png" />
              <img height="65" src="images/paypal.png" />
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
            <p>Copyright &copy; <?= date('Y') ?> Uniqie</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Sub Footer Ends Here -->

  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

</body>

</html>