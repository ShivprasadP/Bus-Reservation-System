<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="/images/bus_reservation.jpg" type="image/x-icon" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.15.3/css/all.css"
    />
    <title>Bus Reservation System</title>
    <link rel="stylesheet" href="styles/navbar.css" />
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img
            src="images/bus_reservation.jpg"
            alt="Logo"
            width="50"
            height="50"
            class="d-inline-block object-fit-fill border rounded"
          />
          Bus Reservation System
        </a>

        <ul class="nav nav-underline justify-content-end">
          <?php if (!isset($_SESSION['user_id'])): ?>
            <li class="nav-item">
              <a class="nav-link" href="u_login_signup.html">Login</a>
            </li>
          <?php else: ?>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Logout</a>
            </li>
          <?php endif; ?>
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
        </ul>
      </div>
    </nav>
    <!-- Bootstrap Script -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  </body>
</html>