<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>View Route</title>
    <link rel="stylesheet" href="styles/schedule.css" />
  </head>
  <body>
    <?php include 'navbar.php' ?>

    <?php
    // Include database connection
    include_once("includes/db.php");
    ?>

    <div class="schedule-form">
      <form action="" method="post">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="from">From</label>
              <?php
              // Prepare and execute the query
              $stmt = $conn->prepare("SELECT DISTINCT from_location FROM bus_schedule");
              $stmt->execute();

              // Fetch the results
              $result = $stmt->get_result();
              $locations = $result->fetch_all(MYSQLI_ASSOC);
              ?>

              <select class="form-control" id="from" name="from">
                <option value="Select Location">Select Location</option>
                <?php foreach ($locations as $location): ?>
                  <option value="<?php echo $location['from_location']; ?>">
                    <?php echo $location['from_location']; ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="to">To</label>
              <?php
              // Prepare and execute the query
              $stmt = $conn->prepare("SELECT DISTINCT to_location FROM bus_schedule");
              $stmt->execute();

              // Fetch the results
              $result = $stmt->get_result();
              $locations = $result->fetch_all(MYSQLI_ASSOC);
              ?>

              <select class="form-control" id="to" name="to">
                <option value="Select Location">Select Location</option>
                <?php foreach ($locations as $location): ?>
                  <option value="<?php echo $location['to_location']; ?>">
                    <?php echo $location['to_location']; ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>
      </form>
      <br /><br /><br />
      <div class="row">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">From</th>
              <th scope="col">To</th>
              <th scope="col">Intermediary Stops</th>
              <th scope="col">Departure Time</th>
              <th scope="col">Date</th>
              <th scope="col">Bus Number</th>
            </tr>
          </thead>
          <?php 
            $fromLocation = $_POST['from'] ?? null;
            $toLocation = $_POST['to'] ?? null;

            if ($fromLocation == 'Select Location' && $toLocation == 'Select Location') {
              $stmt = $conn->prepare("SELECT * FROM bus_schedule");
            } else {
              $stmt = $conn->prepare("SELECT * FROM bus_schedule WHERE from_location = ? OR to_location = ?");
              $stmt->bind_param("ss", $fromLocation, $toLocation);
            }

            $stmt->execute();
            $result = $stmt->get_result();
            $schedules = $result->fetch_all(MYSQLI_ASSOC);
          ?>
          <tbody id="route-table-body">
            <?php foreach ($schedules as $schedule): ?>
              <tr>
                <td><?php echo $schedule['from_location']; ?></td>
                <td><?php echo $schedule['to_location']; ?></td>
                <td><?php echo $schedule['stops']; ?></td>
                <td><?php echo $schedule['departure_time']; ?></td>
                <td><?php echo $schedule['date']; ?></td>
                <td><?php echo $schedule['bus_number']; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
      $(document).ready(function() {
        $('#from, #to').change(function() {
          var from = $('#from').val();
          var to = $('#to').val();

          $.ajax({
            url: 'fetch_route_for_user.php',
            method: 'POST',
            data: { from: from, to: to },
            success: function(data) {
              $('#route-table-body').html(data);
            }
          });
        });

        // Trigger the change event manually to populate the table when the page loads
        $('#from').trigger('change');
      });
    </script>
  </body>
</html>