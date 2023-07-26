<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?php bloginfo('name') ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
<?php get_header() ?>

  <!-- =======================================================
  * Template Name: Abuobaida Home Page
  * Template URL: abuobaida.sd
  * Author: Abuobaida
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<body>

  <!-- ======= Mobile nav toggle button ======= -->
  <i class="bi bi-list mobile-nav-toggle d-xl-none"></i>

  <!-- ======= Header ======= -->
  <header id="header">
    <div class="d-flex flex-column">

      <div class="profile">
        <img src="http://abuobaida.sd/wp-content/uploads/2021/07/WeChat-Image_20201219110230.jpg" alt="" class="img-fluid rounded-circle">
        <h1 class="text-light"><a href="/">Abuobaida Mustafa</a></h1>
        <div class="social-links mt-3 text-center">
          <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
          <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
          <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
          <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
          <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
        </div>
      </div>

      <nav id="navbar" class="nav-menu navbar">
        <ul>

          <li><a href='<?php if(is_404()){ echo "/#hero";} else{ echo "#hero";} ?>' class="nav-link scrollto active"><i class="bx bx-home"></i> <span>Home</span></a></li>
          <li><a href="<?php if(is_404()){ echo "/#about";} else{ echo "#about";} ?>" class="nav-link scrollto"><i class="bx bx-user"></i> <span>About</span></a></li>
          <li><a href="<?php if(is_404()){ echo "/#portfolio";} else{ echo "#portfolio";} ?>" class="nav-link scrollto"><i class="bx bx-book-content"></i> <span>Portfolio</span></a></li>
          <!-- <li><a href="#services" class="nav-link scrollto"><i class="bx bx-server"></i> <span>Services</span></a></li> -->
          <li><a href="<?php if(is_404()){ echo "/#contact";} else{ echo "#contact";} ?>" class="nav-link scrollto"><i class="bx bx-envelope"></i> <span>Contact</span></a></li>
          <li><a href="http://abuobaida.sd/wp-content/uploads/2021/07/Abuobaida-Mustafa.pdf" class="nav-link scrollto" target="_blank"><i class="bi bi-download"></i> <span>Download Resume</span></a></li>

        </ul>
      </nav><!-- .nav-menu -->
    </div>
  </header>
  <!-- End Header -->