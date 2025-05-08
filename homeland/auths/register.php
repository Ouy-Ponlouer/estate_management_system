<?php

include "../configs/config.php";

session_start();
// Check if user is already logged in and redirect if needed
if (isset($_SESSION['name'])){
  header("Location: http://localhost/homeland");  // redirect to index page 
  exit;      // Always exit after redirect to prevent further execution
}

//  btn register start 
if (isset($_POST['btn_register'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = "INSERT INTO tbl_user (name, email, password) VALUES (:name, :email, :password)";
  $rs = $con->prepare($sql);//  Prepare the SQL with placeholders
  $rs->execute([           // passing an array of actual values to bind to those placeholders.
    ':name' => $name,
    ':email' => $email,
    ':password' => password_hash($password, PASSWORD_DEFAULT) 
  ]);
  if ($rs) {
  } else {
    echo '
          <script>
            alert("Register Fail");
          </script> 
        ';
  }
}
require "../includes/header.php";
?>
<div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(<?php echo base_url; ?>/images/hero_bg_2.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row align-items-center justify-content-center text-center">
      <div class="col-md-10">
        <h1 class="mb-2">Register</h1>
      </div>
    </div>
  </div>
</div>
<div class="site-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12" data-aos="fade-up" data-aos-delay="100">
        <h3 class="h4 text-black widget-title mb-3">Register</h3>
        <form action="register.php" method="POST" class="form-contact-agent">

          <div class="form-group">
            <label for="email">Username</label>
            <input type="username" name="name" id="username" class="form-control">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control">
          </div>
          <div class="form-group">
            <input type="submit" id="phone" name="btn_register" class="btn btn-primary" value="Register">
          </div>
        </form>
      </div>

    </div>
  </div>
</div>

<?php require "../includes/footer.php"; ?>
