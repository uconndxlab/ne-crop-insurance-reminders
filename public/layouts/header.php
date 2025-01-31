<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="USDA RMA and FSA Programs App">
    <!-- set the viewport to the width of the device -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USDA RMA and FSA Programs App</title>
    <!-- bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/banner.css">

    <!--fonts-->
    <link rel="stylesheet" href="https://use.typekit.net/nyu4feu.css">
    <link rel="stylesheet" href="https://use.typekit.net/lmy8hrr.css">

</head>

<body>
    <div id="uc-header">
        <div id="uconn-banner" class="alternative">
            <div id="uconn-header-container">
                <div class="row-container container">
                    <div class="row-fluid">
                        <div id="home-link-container">
                            <a id="home-link" href="https://uconn.edu/">
                                <span id="wordmark" aria-hidden="false">UConn</span>
                            </a>
                            <a id="home-link" href="https://uconn.edu/">
                                <span class="no-css">University of Connecticut school of</span>
                                <span id="university-of-connecticut">University of Connecticut</span>
                            </a>
                        </div>

                        <div id="button-container">
                            <div class="icon-container" id="icon-container-search">
                                <a id="uconn-search" class="btn" href="https://uconn.edu/search">
                                    <span class="no-css">Search University of Connecticut</span>

                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="20"
                                        viewBox="0 0 32 32" aria-hidden="true" class="banner-icon">
                                        <title>Search UConn</title>
                                        <path
                                            d="M28.072 24.749l-6.046-6.046c0.912-1.499 1.437-3.256 1.437-5.139 0-5.466-4.738-10.203-10.205-10.203-5.466 0-9.898 4.432-9.898 9.898 0 5.467 4.736 10.205 10.203 10.205 1.818 0 3.52-0.493 4.984-1.349l6.078 6.080c0.597 0.595 1.56 0.595 2.154 0l1.509-1.507c0.594-0.595 0.378-1.344-0.216-1.938zM6.406 13.258c0-3.784 3.067-6.853 6.851-6.853 3.786 0 7.158 3.373 7.158 7.158s-3.067 6.853-6.853 6.853-7.157-3.373-7.157-7.158z">
                                        </path>
                                    </svg>
                                </a>
                                <div id="uconn-search-tooltip" style="z-index: 99999 !important"></div>
                            </div>

                            <div class="icon-container" id="icon-container-az">
                                <a class="btn" id="uconn-az" href="https://uconn.edu/az"
                                    aria-haspopup="true" aria-controls="a-z-popup" aria-expanded="false">
                                    <span class="no-css">A to Z Index</span>

                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="20"
                                        viewBox="0 0 32 32" aria-hidden="true" class="banner-icon">
                                        <title>UConn A to Z Index</title>
                                        <path
                                            d="M5.345 8.989h3.304l4.944 13.974h-3.167l-0.923-2.873h-5.147l-0.946 2.873h-3.055l4.989-13.974zM5.152 17.682h3.579l-1.764-5.499-1.815 5.499zM13.966 14.696h5.288v2.56h-5.288v-2.56zM20.848 20.496l7.147-9.032h-6.967v-2.474h10.597v2.341l-7.244 9.165h7.262v2.466h-10.798v-2.466h0.004z">
                                        </path>
                                    </svg>
                                </a>
                                <div id="uconn-az-tooltip" style="z-index: 99999 !important"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

<header>
<div class="container d-flex align-items-center justify-content-between"  style="padding-top:30px;padding-bottom:30px;">
  <div>
    <p class="header-level-two">
    <a href="https://cahnr.uconn.edu/" class="link-offset-2">College of Agriculture, Health and Natural Resources</a>
    </p>
    <h1 class="header-level-one">
    <a href="/" class="link-offset-1">USDA RMA and FSA Program Deadlines
    </a>
    </h1>
   </div>
<!-- Navbar -->

<nav class="navbar navbar-expand-lg navbar-light">
  <div class="">
    <?php if (isset($_SESSION['user_id'])) : ?>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <?php endif; ?>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

      <?php if (isset($_SESSION['user_id'])) : ?>
        <?php if ($_SESSION['user_type'] == 'admin') : ?>
        <li class="nav-item">
          <a class="nav-link
          <?php if ($_SERVER['REQUEST_URI'] == '/') : ?>
            active
          <?php endif; ?>
          " aria-current="page" href="/">Management Dashboard</a>
        </li>
        <?php endif; ?>
        <li class="nav-item">
          <a class="
          
          <?php if ($_SERVER['REQUEST_URI'] == '/profile') : ?>
            active
          <?php endif; ?>
          nav-link" href="/profile">My Grower Profile</a>
        </li>

        <li class="nav-item"> <a href="/logout" class="btn btn-danger">Logout</a> </li>


      <?php endif; ?>
      <?php if (!isset($_SESSION['user_id'])) : ?>
        <li class="nav-item">
            <a href="/register" class="btn btn-primary">Register</a>
        </li>
        <?php endif; ?>
        </ul>
    </div>

  </div>
</nav>
</div>
<div class="d-flex justify-content-end container">
    <div id="google_translate_element"></div>
  </div>
</header>

<main id="app" class="mt-4 mb-4">
  <div class="container">
    <?php if (isset($_SESSION['error'])) : ?>
        <div class="alert alert-danger" role="alert">
            <?php 
                echo $_SESSION['error']; 
                unset($_SESSION['error']);
            ?>
            
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['success'])) : ?>
        <div class="alert alert-success" role="alert">
            <?php 
                echo $_SESSION['success']; 
                unset($_SESSION['success']);
            ?>
            
        </div>
    <?php endif; ?>
  </div>

