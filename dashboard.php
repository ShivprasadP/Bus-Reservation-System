<!-- 
Following Tania Ruscia's tutorial on creating your own responsive dropdown navigation bar. https://www.taniarascia.com/responsive-dropdown-navigation-bar/
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles/dashboard.css" />
    <link rel="stylesheet" href="styles/navbar.css" />
    <title>Bus Reservation System || Dashboard</title>
</head>
<body>
    <?php include 'navbar.php'; ?>

  <!-- Cards start -->
    <div class="container" style="margin-top: 100px;">
      <div class="row">
        <!-- Bus Schedule Card -->
        <div class="col-lg-3 col-md-6 col-sm-12">
          <div class="card ml-4 mt-4">
            <img src="images/Schedule.svg" style="height: 14rem;" class="card-img-top" alt="">
            <div class="card-body">
              <h5 class="card-title">Schedule of Buses</h5>
              <p class="card-text">The bus schedule is subject to change.</p>
            </div>
            <div class="card-body">
              <center><a href="schedule.php" class="card-link">See Schedule</a></center>
            </div>
          </div>
        </div>

        <!-- Seat Arrangement Card -->
        <div class="col-lg-3 col-md-6 col-sm-12">
          <div class="card ml-4 mt-4">
            <img src="images/Seat Arrangement.svg" style="height: 14rem;" class="card-img-top" alt="">
            <div class="card-body">
              <h5 class="card-title">Seat Arrangement</h5>
              <p class="card-text">Check the seat arrangement before booking.</p>
            </div>
            <div class="card-body">
              <center><a href="seat_arrangment.php" class="card-link">Check Seat Arrangement</a></center>
            </div>
          </div>
        </div>

        <!-- Feedback Card -->
        <div class="col-lg-3 col-md-6 col-sm-12">
          <div class="card ml-4 mt-4">
            <img src="images/Feedback.svg" style="height: 14rem;" class="card-img-top" alt="">
            <div class="card-body">
              <h5 class="card-title">Feedback</h5>
              <p class="card-text">We value your feedback. Please let us know how we can improve.</p>
            </div>
            <div class="card-body">
              <center><a href="feedback.php" class="card-link">Give Feedback</a></center>
            </div>
          </div>
        </div>

        <!-- Route Card -->
        <div class="col-lg-3 col-md-6 col-sm-12">
          <div class="card ml-4 mt-4">
            <img src="images/Route.svg" style="height: 14rem;" class="card-img-top" alt="">
            <div class="card-body">
              <h5 class="card-title">Route</h5>
              <p class="card-text">Check the bus route before booking.</p>
            </div>
            <div class="card-body">
              <center><a href="route.php" class="card-link">View Route</a></center>
            </div>
          </div>
        </div>
      </div>
    </div>

  <!-- Cards end -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>