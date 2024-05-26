<?php 
  session_start();

  if(isset($_SESSION['user_id'])) {
    if($_SESSION['type'] == 1)
      header("Location: admin_dashboard.php");
    else
      header("Location: dashboard.php");
    exit;
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="styles/u_login_signup.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login and Signup</title>
  </head>
  <body>
    <?php include 'navbar.php'; ?>

    <div class="container">
      <input type="checkbox" id="flip" />
      <div class="cover">
        <!-- Front Side -->
        <div class="front">
          <img src="images/frontImg.jpg" alt="" />
        </div>
        <!-- Back Side -->
        <div class="back">
          <img class="backImg" src="images/backImg.jpg" alt="" />
        </div>
      </div>
      <!-- Login and Signup Forms -->
      <div class="forms">
        <!-- Login Form -->
        <div class="form-content">
          <div class="login-form">
            <div class="title">Login</div>
            <form action="login.php" method="POST">
              <div class="input-boxes">
                <div class="input-box">
                  <i class="fas fa-id-card"></i>
                  <input
                    type="text"
                    name="login_username"
                    placeholder="Enter your username"
                    required
                  />
                </div>
                <div class="input-box">
                  <i class="fas fa-lock"></i>
                  <input
                    type="password"
                    name="login_password"
                    placeholder="Enter your password"
                    required
                  />
                </div>
                <div class="text"><a href="#">Forgot password?</a></div>
                <div class="button input-box">
                  <input type="submit" name="login_submit" value="Submit" />
                </div>
                <div class="text sign-up-text">
                  Don't have an account? <label for="flip">Signup now</label>
                </div>
              </div>
            </form>
          </div>
          <!-- Signup Form -->
          <div class="signup-form">
            <div class="title">Signup</div>
            <form action="signup.php" method="POST">
              <div class="input-boxes">
                <div class="input-box">
                  <i class="fas fa-user"></i>
                  <input
                    type="text"
                    name="signup_name"
                    placeholder="Enter your name"
                    required
                  />
                </div>
                <div class="input-box">
                  <i class="fas fa-id-card"></i>
                  <input
                    type="text"
                    name="signup_username"
                    placeholder="Enter your username"
                    required
                  />
                </div>
                <div class="input-box">
                  <i class="fas fa-phone"></i>
                  <input
                    type="text"
                    name="signup_phone"
                    placeholder="Enter your phone number"
                    required
                  />
                </div>
                <div class="input-box">
                  <i class="fas fa-lock"></i>
                  <input
                    type="password"
                    name="signup_password"
                    placeholder="Enter your password"
                    required
                  />
                </div>
                <div class="button input-box">
                  <input type="submit" name="signup_submit" value="Submit" />
                </div>
                <div class="text sign-up-text">
                  Already have an account? <label for="flip">Login now</label>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
