<?php

require("../configs/config.php");
require("../includes/header.php");

if (isset($_POST['btn_request'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $author = $_POST['author'];
  $prop_id = $_POST['prop_id'];
  $user_id = $_POST['user_id'];
  $insert = "INSERT INTO `tbl_request` (`prop_id`,`user_id`,`name`,`email`,`phone`,`author`) VALUES ('$prop_id','$user_id','$name','$email','$phone','$author')";
  $stmt_re = $con->prepare($insert);
  $stmt_re->execute();
  if ($stmt_re){
    //  header("Location : ".base_url."/property-details.php?id='$prop_id'");
    echo "<script>window.location.href='" . base_url . "/property-details.php?id=$prop_id' </script>";

  }
}


$request_sql="SELECT * FROM `props` JOIN `tbl_request` ON props.id=tbl_request.prop_id  WHERE tbl_request.user_id='$_SESSION[id]'";
$stmt=$con->prepare($request_sql);

$stmt->execute();
$requsts=$stmt->fetchAll(PDO::FETCH_OBJ);
// echo var_dump($props);


?>
<div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(<?php echo base_url; ?>/images/hero_bg_2.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row align-items-center justify-content-center text-center">
      <div class="col-md-10">
        <h1 class="mb-2">Your Request</h1>
      </div>
    </div>
  </div>
</div>
<div class="site-section site-section-sm bg-light">
  <div class="container">

    <div class="row mb-5">
      <?php if (count($requsts) > 0) : ?>
        <?php foreach ($requsts as $requst) :  ?>
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="property-entry h-100 rounded">
              <?php   ?>
              <!-- ============ Valiation When click card  ================ -->

              <a href="../property-details.php?id=<?php echo $requst->prop_id; ?>"
                class="property-thumbnail">
                <div class="offer-type-wrap">
                  <span class="offer-type bg-<?php if ($requst->type == "rent") echo "success";
                                              else echo "danger"; ?>"><?php echo $requst->type ?></span>
                </div>
                <img src="<?php echo base_url?>/images/<?php echo $requst->image ?>" alt="Image" class="img-fluid">
              </a>
              <div class="p-4 property-body">
                <a href="#" class="property-favorite"><span class="icon-heart-o"></span></a>
                <h2 class="property-title"><a href="property-details.php?id=<?php echo $requst->id; ?>"><?php echo $requst->name ?></a></h2>
                <span class="property-location d-block mb-3"><span class="property-icon icon-room"></span><?php echo $requst->location ?></span>
                <strong class="property-price text-primary mb-3 d-block text-success">$<?php echo $requst->price ?></strong>
                <ul class="property-specs-wrap mb-3 mb-lg-0">
                  <li>
                    <span class="property-specs">Beds</span>
                    <span class="property-specs-number"><?php echo $requst->beds ?></span>

                  </li>
                  <li>
                    <span class="property-specs">Baths</span>
                    <span class="property-specs-number"><?php echo $requst->baths ?></span>

                  </li>
                  <li>
                    <span class="property-specs">SQ FT</span>
                    <span class="property-specs-number"><?php echo $requst->sq_ft ?></span>

                  </li>
                </ul>

              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else : ?>
        <div class=" text-danger ">NO DATA </div>
      <?php endif; ?>

    </div>
  </div>
</div>
<?php
include "../includes/footer.php";
?>