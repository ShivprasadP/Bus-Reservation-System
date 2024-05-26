<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Conductor Feedback</title>
    <style>
      .form-container {
        /*add shadow*/
        box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.8);
        margin-top: 4%;
        padding: 30px;
      }
    </style>
  </head>
  <body>
    <?php 
      if (isset($_GET['success']) && $_GET['success'] == 1) {
        echo '<script>alert("Thank you for giving feedback to improve our services.");</script>';
      }
    ?>
    <?php include 'navbar.php'; ?>

    <div class="form-container">
      <form action="addConductorFeedback.php" method="POST">
        <center><h1>Conductor Feedback Form</h1></center>
        <br /><br />
        <div class="form-row">
          <div class="col-md-4 mb-3">
            <label for="validationServer01">First name</label>
            <input
              type="text"
              class="form-control"
              id="validationServer01" name="fname"
              placeholder="First name"
              required
            />
            <div class="valid-feedback"></div>
          </div>
          <div class="col-md-4 mb-3">
            <label for="validationServer02">Last name</label>
            <input
              type="text"
              class="form-control"
              id="validationServer02" name="lname"
              placeholder="Last name"
              required
            />
            <div class="valid-feedback"></div>
          </div>
          <div class="col-md-4 mb-3">
            <label for="validationServer03">Bus Number</label>
            <div class="input-group">
              <?php
              // Include database connection
              include_once("includes/db.php");

              // Prepare an SQL statement
              $stmt = $conn->prepare("SELECT bus_num FROM buses");

              // Execute the statement
              $stmt->execute();

              // Get the result
              $result = $stmt->get_result();
              ?>

              <select class="form-control" id="validationServer03" name="bus_num" aria-describedby="inputGroupPrepend3" required>
                <option selected disabled value="Select Option">Select Option</option>
                <?php
                // Check if there are any records
                if ($result->num_rows > 0) {
                  // Loop through the records
                  while($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['bus_num'] . '">' . $row['bus_num'] . '</option>';
                  }
                }
                ?>
              </select>

              <?php
              // Close the statement
              $stmt->close();
              ?>
              <div class="invalid-feedback"></div>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-6 mb-3">
            <label for="validationServer04">City</label>
            <input
              type="text"
              class="form-control"
              id="validationServer04" name="city"
              placeholder="City"
              required
            />
            <div class="invalid-feedback"></div>
          </div>
          <div class="col-md-3 mb-3">
            <label for="validationServer05">State</label>
            <input
              type="text"
              class="form-control"
              id="validationServer05" name="state"
              placeholder="State"
              required
            />
            <div class="invalid-feedback"></div>
          </div>
          <div class="col-md-3 mb-3">
            <label for="validationServer06">Zip</label>
            <input
              type="text"
              class="form-control"
              id="validationServer06" name="zip"
              placeholder="Zip"
              required
            />
            <div class="invalid-feedback"></div>
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-10 mb-3">
            <label for="validationServer07">Comments</label>
            <textarea
              class="form-control"
              id="validationServer07" name="comments"
              rows="5"
              placeholder="Comments"
              required
            ></textarea>
            <div class="invalid-feedback"></div>
          </div>
        </div>
        <center>
          <button class="btn btn-primary" type="submit">Submit form</button>
        </center>
      </form>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
    
    <script>
      document.querySelector('form').addEventListener('submit', function(event) {
        var firstName = document.getElementById('validationServer01');
        var lastName = document.getElementById('validationServer02');
        var busNumber = document.getElementById('validationServer03');
        var city = document.getElementById('validationServer04');
        var state = document.getElementById('validationServer05');
        var zip = document.getElementById('validationServer06');
        var comments = document.getElementById('validationServer07');

        validateField(firstName);
        validateField(lastName);
        validateField(busNumber);
        validateField(city);
        validateField(state);
        validateField(zip);
        validateField(comments);

        // If all fields are valid, submit the form
        if (firstName.classList.contains('is-valid') &&
          lastName.classList.contains('is-valid') &&
          busNumber.classList.contains('is-valid') &&
          city.classList.contains('is-valid') &&
          state.classList.contains('is-valid') &&
          zip.classList.contains('is-valid') &&
          comments.classList.contains('is-valid')) {
          // Form is valid, allow submission
        } else {
          // Form is not valid, prevent submission
          event.preventDefault();
        }
      });
    </script>
  </body>
</html>
