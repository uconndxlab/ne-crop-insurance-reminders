<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New England Crop Insurance Stuff</title>



    <!-- bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="/css/app.css">
</head>

<body>
<header>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="#">Crop Insurance Alerts</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link
          <?php if ($_SERVER['REQUEST_URI'] == '/') : ?>
            active
          <?php endif; ?>
          " aria-current="page" href="/">Management Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="
          
          <?php if ($_SERVER['REQUEST_URI'] == '/profile') : ?>
            active
          <?php endif; ?>
          nav-link" href="/profile">My Grower Profile</a>
        </li>
      </ul>
    </div>
    <!-- login/logout -->
    <div class="d-flex">
        <?php if (isset($_SESSION['user_id'])) : ?>
            <span class="me-3">Welcome, <?php echo $_SESSION['firstname']; ?></span>
            <a href="/logout" class="btn btn-danger">Logout</a>
        <?php else : ?>
            <a href="/login" class="btn btn-primary me-2">Login</a>
            <a href="/register" class="btn btn-secondary">Register</a>
        <?php endif; ?>
    </div>
  </div>
</nav>
</header>

<main id="app" class="mt-4 mb-4">
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
  