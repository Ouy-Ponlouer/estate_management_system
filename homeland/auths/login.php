<?php

require("../configs/config.php");
session_start();
// $_SESSION['id']=-1;
// must to declear header.php after all possible redirects have been handled
// Check if user is already logged in and redirect if needed
if (isset($_SESSION['name'])){
  header("Location: http://localhost/homeland");
  exit;  // Always exit after redirect to prevent further execution
}

// ========== Login Start ==============//

if (isset($_POST['btn_login'])) {
  if (empty($_POST['email']) or empty($_POST['password'])) {
    echo '
          <script>
            alert("Please enter your email and password");
          </script> 
        ';
  } else {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT `id`,`name`,`email`, `password` FROM `tbl_user` WHERE email = :email"; //:email is a named placeholder, which will be safely replaced later (no SQL injection risk ✅
    $stmt = $con->prepare($sql);  // Prepare this SQL statement so I can safely pass values to it.
    $stmt->execute([              //SQL query, and securely binds the value of $email , safe way to avoid SQL injection — no need to manually escape input
      ':email'=>$email
    ]);

    $fetch =$stmt ->fetch(PDO::FETCH_ASSOC);  // Return the row as an associative array to $fetch, using column names as keys.
  
    if ($stmt->rowCount()>0){
      if (password_verify($password,$fetch['password'])){  //password_verify() is a built-in PHP function used to check if a user’s entered password matches a hashed password stored in the database
        
        $_SESSION['name']=$fetch['name'];
        $_SESSION['email']=$fetch['email'];
        $_SESSION['id']=$fetch['id'];
        header("Location: http://localhost/estate_management_system/homeland");
      }else{
        echo '
            <script>
              alert("Incorrect Password or email");
            </script> 
          ';
      }
    }else{
      echo '
          <script>
            alert("Login Fail");
          </script> 
        ';
    }
  }
}
// ========== Login End ==============//

require("../includes/header.php");

?>
<div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(<?php echo base_url; ?>/images/hero_bg_2.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row align-items-center justify-content-center text-center">
      <div class="col-md-10">
        <h1 class="mb-2">Log In</h1>
      </div>
    </div>
  </div>
</div>
<div class="site-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12" data-aos="fade-up" data-aos-delay="100">
        <h3 class="h4 text-black widget-title mb-3">Login</h3>
        <form action="login.php" method="post" class="form-contact-agent">
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control">
          </div>
          <div class="form-group">
            <input type="submit" name="btn_login" id="phone" class="btn btn-primary" value="Login">
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
<?php
include "../includes/footer.php";
?>