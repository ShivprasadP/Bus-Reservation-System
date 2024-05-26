<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Seating Arrangement</title>
    <link rel="stylesheet" href="styles/seat-arrangement.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  </head>
  <body>
    <?php
        if (isset($_GET['booked']) && $_GET['booked'] == 'true') {
            echo "<script>
                alert('Seat booked successfully');
                window.location.href='seat_arrangment.php';
            </script>";
        }
    ?>
    <?php include 'navbar.php'; ?>

    <form id="booking-form">
      <div class="seat-form">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="from">From</label>
              <select class="form-control" id="from">
                <option value="Select Location">Select Location</option>
                <?php
                  include_once("includes/db.php");

                  // Fetch unique from_location values
                  $stmt = $conn->prepare("SELECT DISTINCT from_location FROM bus_schedule");
                  $stmt->execute();
                  $result = $stmt->get_result();
                  $fromLocations = $result->fetch_all(MYSQLI_ASSOC);

                  // Fetch stops values
                  $stmt = $conn->prepare("SELECT stops FROM bus_schedule");
                  $stmt->execute();
                  $result = $stmt->get_result();
                  $stops = $result->fetch_all(MYSQLI_ASSOC);

                  // Fetch to_location values
                  $stmt = $conn->prepare("SELECT DISTINCT to_location FROM bus_schedule");
                  $stmt->execute();
                  $result = $stmt->get_result();
                  $toLocations = $result->fetch_all(MYSQLI_ASSOC);

                  // Combine from_location, to_location and stops into one array
                  $locations = [];
                  foreach ($fromLocations as $location) {
                    $locations[] = $location['from_location'];
                  }
                  foreach ($toLocations as $location) {
                    $locations[] = $location['to_location'];
                  }
                  foreach ($stops as $stop) {
                    $stopLocations = explode(',', $stop['stops']);
                    foreach ($stopLocations as $location) {
                      $location = trim($location);
                      if (!in_array($location, $locations)) {
                        $locations[] = $location;
                      }
                    }
                  }

                  // Sort locations in alphabetical order
                  sort($locations);

                  // Output options
                  foreach ($locations as $location) {
                    echo '<option value="' . $location . '">' . $location . '</option>';
                  }
                ?>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="to">To</label>
              <select class="form-control" id="to">
                <option value="Select Location">Select Location</option>
                <?php
                  include_once("includes/db.php");

                  // Fetch unique from_location values
                  $stmt = $conn->prepare("SELECT DISTINCT from_location FROM bus_schedule");
                  $stmt->execute();
                  $result = $stmt->get_result();
                  $fromLocations = $result->fetch_all(MYSQLI_ASSOC);

                  // Fetch stops values
                  $stmt = $conn->prepare("SELECT stops FROM bus_schedule");
                  $stmt->execute();
                  $result = $stmt->get_result();
                  $stops = $result->fetch_all(MYSQLI_ASSOC);

                  // Fetch to_location values
                  $stmt = $conn->prepare("SELECT DISTINCT to_location FROM bus_schedule");
                  $stmt->execute();
                  $result = $stmt->get_result();
                  $toLocations = $result->fetch_all(MYSQLI_ASSOC);

                  // Combine from_location, to_location and stops into one array
                  $locations = [];
                  foreach ($fromLocations as $location) {
                    $locations[] = $location['from_location'];
                  }
                  foreach ($toLocations as $location) {
                    $locations[] = $location['to_location'];
                  }
                  foreach ($stops as $stop) {
                    $stopLocations = explode(',', $stop['stops']);
                    foreach ($stopLocations as $location) {
                      $location = trim($location);
                      if (!in_array($location, $locations)) {
                        $locations[] = $location;
                      }
                    }
                  }

                  // Sort locations in alphabetical order
                  sort($locations);

                  // Output options
                  foreach ($locations as $location) {
                    echo '<option value="' . $location . '">' . $location . '</option>';
                  }
                ?>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <button id="view" type="button">View Bus</button>
          </div>
        </div>
      </div>

      <div class="bus-book">
        <div class="bus-layout">
          <div class="bus-number"></div>
        </div>
        <div class="booking-summary">
          <h2>Booking Summary</h2>
          <p>Selected Seats: <span id="selected-seats"></span></p>
          <div class="row">
            <p class="mr-5">Price per Seat: <span id="price-per-seat"></span></p>
            <p>Total: <span id="total"></span></p>
          </div>
          <div class="row">
            <p class="col-6 text-left">Date: <span id="date"></span> </p>
            <p>Time: <span id="time"></span></p>
          </div>
          <p>Bus Number: <span id="bus-num"></span></p>
          <button type="submit" id="book">Book Now</button>

          <?php
      if (session_status() == PHP_SESSION_NONE) {
        session_start(); // Start the session
      }

      include_once("includes/db.php");

      $userId = $_SESSION['user_id']; // Get user_id from session

      $stmt = $conn->prepare("SELECT * FROM bookings WHERE user_id = ?");
      $stmt->bind_param("s", $userId);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0) {
        // User has bookings, show the button
    ?>
        <!-- Button to Open the Modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#bookingModal">
          Open Booking Details
        </button>
    <?php
      }
    ?>
        </div>
      </div>
    </form>

    

    <?php
        if (session_status() == PHP_SESSION_NONE) {
            session_start(); // Start the session
        }

        include_once("includes/db.php");

        $userId = $_SESSION['user_id']; // Get user_id from session

        $stmt = $conn->prepare("SELECT * FROM bookings WHERE user_id = ?");
        $stmt->bind_param("s", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
    ?>

    <!-- The Modal -->
    <div class="modal" id="bookingModal">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Booking Details</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <table class="table mt-4 table-bordered">
              <thead>
                <tr>
                  <th>From</th>
                  <th>To</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                  <tr>
                    <td><?php echo $row['from_location']; ?></td>
                    <td><?php echo $row['to_location']; ?></td>
                    <td><a class='btn btn-primary' href="generate_pdf.php?booking_id=<?php echo $row['id']; ?>"><i class='fas fa-file-pdf'></i></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>

        </div>
      </div>
    </div>

    <!-- Scripts -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
      $('#view').click(function() {
        var fromLocation = $('#from').val();
        var toLocation = $('#to').val();

        // Clear existing seat classes
        $(".seat").removeClass("booked selected");

        $.ajax({
          url: 'check_schedule.php',
          type: 'POST',
          data: {
            from_location: fromLocation,
            to_location: toLocation
          },
          success: function(response) {
            var data = JSON.parse(response);
            if (data.bus_number) {
              $('.bus-number').text(data.bus_number);
              $('#bus-num').text(data.bus_number);
              $('#price-per-seat').text(data.price_increase * (data.num_stops+1));
              $('#date').text(data.date);
              $('#time').text(data.departure_time);

              // Fetch booked seats
              $.ajax({
                url: 'fetch_booked_seats.php',
                type: 'GET',
                data: {
                  bus_number: data.bus_number
                },
                success: function(response) {
                  var bookedSeats = JSON.parse(response);

                  document.querySelectorAll(".seat").forEach(function (seat) {
                    if (bookedSeats.includes(seat.dataset.seatNumber)) {
                      seat.classList.add("booked");
                    }
                  });
                }
              });
            } else {
              $('.bus-number').text('No bus found for this route.');
            }
          }
        });
      });
    </script>

    <script>
      document.getElementById('booking-form').addEventListener('submit', function(e) {
        e.preventDefault();

        const selectedSeats = Array.from(
          document.querySelectorAll(".seat.selected")
        ).map((seat) => seat.dataset.seatNumber);
        const selectedSeatsString = selectedSeats.join(", ");

        // Get the other values from the form
        const pricePerSeat = document.getElementById('price-per-seat').textContent;
        const total = $('#total').text();
        const date = document.getElementById('date').textContent;
        const time = document.getElementById('time').textContent;
        const busNumber = document.getElementById('bus-num').textContent;
        const from = $('#from').val();
        const to = $('#to').val();

        // Send the data to the server
        fetch('book_seats.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
          },
          body: new URLSearchParams({
            selected_seats: selectedSeatsString,
            price_per_seat: pricePerSeat,
            total: total,
            date: date,
            time: time,
            bus_number: busNumber,
            from_location: from,
            to_location: to
          }),
        })
        .then(response => response.text())
        .then(data => console.log(data))
        .catch((error) => {
          console.error('Error:', error);
        });
      });
    </script>
    
    <script>
      const busLayout = document.querySelector(".bus-layout");

      for (let i = 0; i < 12; i++) {
        const row = document.createElement("div");
        row.className = "row";

        for (let j = 0; j < 4; j++) {
          // Replace the second and third seats in the first row with aisle seats
          if (i === 0 && (j == 0 || j == 1)) {
            const aisle = document.createElement("div");
            aisle.className = "aisle";
            row.appendChild(aisle);
            continue;
          }

          const seat = document.createElement("div");
          if (i === 0 && (j == 2 || j == 3)) {
            seat.className = "seat driver-conductor";
          } else {
            seat.className = "seat";
          }
          // Add the seat number as a data attribute
          seat.dataset.seatNumber = `${i}${String.fromCharCode(65 + j)}`; // 1A, 1B, 1C, 1D, etc.

          const img = document.createElement("img");
          img.className = "img";
          img.src = "images/car-seat.png";
          img.alt = "";
          seat.appendChild(img);

          if (j === 2) {
            const aisle = document.createElement("div");
            aisle.className = "aisle";
            row.appendChild(aisle);
          }

          row.appendChild(seat);
        }

        busLayout.appendChild(row);
      }
    </script>

    <script>
      document.querySelectorAll(".seat").forEach(function (seat) {
        seat.addEventListener("click", function () {
          if (
            !this.classList.contains("unavailable") &&
            !this.classList.contains("booked")
          ) {
            if (this.classList.contains("selected")) {
              this.classList.remove("selected");
            } else {
              this.classList.add("selected");
            }

            const selectedSeatsElement = document.getElementById("selected-seats");
            const totalElement = document.getElementById("total");
            const pricePerSeatElement = document.getElementById("price-per-seat");

            const selectedSeats = Array.from(document.querySelectorAll(".seat.selected")).map((seat) => seat.dataset.seatNumber);
            const selectedSeatsString = selectedSeats.join(", ");
            selectedSeatsElement.textContent = selectedSeatsString;

            const pricePerSeat = parseFloat(pricePerSeatElement.textContent);
            const total = selectedSeats.length * pricePerSeat;
            totalElement.textContent = '₹' + total.toFixed(2);
          }
        });
      });
    </script>
  </body>
</html>
