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
            <!-- Manage Bus Schedule Card -->
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card ml-4 mt-4">
                    <img src="images/seat Arrangement.svg" style="height: 14rem;" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">Manage Bus Schedule</h5>
                        <p class="card-text">"Your input is crucial. Please share your thoughts on how we can enhance our bus scheduling."</p>
                    </div>
                    <div class="card-body">
                        <center><a href="manage_bus_schedule.php" class="card-link">Manage Schedule</a></center>
                    </div>
                </div>
            </div>

            <!-- Manage Buses Card -->
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card ml-4 mt-4">
                    <img src="images/bus.svg"  style="height: 14rem;" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">Manage Buses</h5>
                        <p class="card-text">"We value your input. Please let us know how we can improve our bus management."</p>
                    </div>
                    <div class="card-body">
                        <center><a href="manage_bus.php" class="card-link">Manage Buses</a></center>
                    </div>
                </div>
            </div>

            <!-- Manage Drivers Card -->
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card ml-4 mt-4">
                    <img src="images/driver.svg"  style="height: 14rem;" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">Manage Drivers</h5>
                        <p class="card-text">"We appreciate your suggestions. Please share your thoughts on how we can better manage our drivers."</p>
                    </div>
                    <div class="card-body">
                        <center><a href="manage_drivers.php" class="card-link">Manage Drivers</a></center>
                    </div>
                </div>
            </div>

            <!-- Manage Conductors Card -->
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card ml-4 mt-4">
                    <img src="images/conductor.svg"  style="height: 14rem;" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">Manage Conductors</h5>
                        <p class="card-text">"Your opinion matters to us. Let us know how we can enhance our conductor management."</p>
                    </div>
                    <div class="card-body">
                        <center><a href="manage_conductors.php" class="card-link">Manage Conductors</a></center>
                    </div>
                </div>
            </div>

            <!-- View Feedback Card -->
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card ml-4 mt-4">
                    <img src="images/Feedback.svg"  style="height: 14rem;" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">Feedback</h5>
                        <p class="card-text">"Your feedback is important. Please tell us how we can make viewing feedback more efficient."</p>
                    </div>
                    <div class="card-body">
                        <center><a href="view_feedbacks.php" class="card-link">View Feedback</a></center>
                    </div>
                </div>
            </div>

        </div>
        </div>

    <!-- Cards end -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>