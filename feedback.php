<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Feedback</title>
  </head>
  <body>
    <?php include 'navbar.php'; ?>

    <div class="container" style="margin-top: 100px">
      <div class="row">
        <!-- Bus Feedback Card -->
        <div class="col-lg-4 col-md-6 col-sm-12">
          <div class="card ml-4 mt-4">
            <img
              src="images/bus feedback.svg"
              style="height: 14rem"
              class="card-img-top"
              alt=""
            />
            <div class="card-body">
              <h5 class="card-title">Bus Feedback</h5>
              <p class="card-text">
                Your feedback helps us to improve our bus service for everyone.
              </p>
            </div>
            <div class="card-body">
              <center>
                <a href="bus feedback.php" class="card-link">Give Feedback</a>
              </center>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
          <!-- Driver Feedback Card -->
          <div class="card ml-4 mt-4">
            <img
              src="images/driver feedback.svg"
              style="height: 14rem"
              class="card-img-top"
              alt=""
            />
            <div class="card-body">
              <h5 class="card-title">Driver Feedback</h5>
              <p class="card-text">
                Your feedback on our drivers helps us to ensure a safe and
                pleasant journey for all.
              </p>
            </div>
            <div class="card-body">
              <center>
                <a href="driver feedback.php" class="card-link"
                  >Give Feedback</a
                >
              </center>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
          <!-- Conductor Feedback Card -->
          <div class="card ml-4 mt-4">
            <img
              src="images/conductor feedback.svg"
              style="height: 14rem"
              class="card-img-top"
              alt=""
            />
            <div class="card-body">
              <h5 class="card-title">Conductor Feedback</h5>
              <p class="card-text">
                Your feedback on our conductors helps us to provide better
                customer service.
              </p>
            </div>
            <div class="card-body">
              <center>
                <a href="conductor feedback.php" class="card-link"
                  >Give Feedback</a
                >
              </center>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
