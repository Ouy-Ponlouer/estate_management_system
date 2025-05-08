<?php
require("includes/header.php");
require("configs/config.php");

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $sql = "SELECT * FROM `props` WHERE id ='$id'";
  $stmt = $con->prepare($sql);
  $stmt->execute();
  $detail = $stmt->fetch(PDO::FETCH_ASSOC); // cannot use FETCH_ASSOC cuz we want to get object  

  // ============ Related Image =================//
  $relate_img = "SELECT * FROM `related_image` WHERE prop_id ='$id'";
  $stmt_relate = $con->prepare($relate_img);
  $stmt_relate->execute();
  $related_images = $stmt_relate->fetchAll(PDO::FETCH_ASSOC);

  // =========== Related Property ==============//

  $sql_related_prop = "SELECT * FROM `props` WHERE home_type= '$detail[home_type]'";  // noted syntax
  $stmt_relate_p = $con->prepare($sql_related_prop);
  $stmt_relate_p->execute();
  $related_props = $stmt_relate_p->fetchAll(PDO::FETCH_OBJ);

  //============= Check Button Add to fav ============//

  // if (!isset($_SESSION["id"]) || empty($_SESSION["id"])) {
  //   header("Location: http://localhost/estate_management_system/homeland/auths/login.php");
  //   exit();
  // }else{
// if (!empty($_SESSION["id"])){
  // echo "This is session".$_SESSION["id"] ;
  $sql_check = "SELECT * FROM `tbl_favorite` WHERE prop_id='$id' AND user_id ='" . $_SESSION["id"] . "'";  // noted syntax
  $stmt_check = $con->prepare($sql_check);
  $stmt_check->execute();
  $fav_checks = $stmt_check->fetch(PDO::FETCH_OBJ);
  // }
// }else{

//   header("Location: http://localhost/estate_management_system/homeland");
// }



  // var_dump($fav_checks);
}


?>
<!--  banner start -->
<div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(images/hero_bg_2.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row align-items-center justify-content-center text-center">
      <div class="col-md-10">
        <span class="d-inline-block text-white px-3 mb-3 property-offer-type rounded">Property Details of</span>
        <h1 class="mb-2">625 S. Berendo St</h1>
        <p class="mb-5"><strong class="h2 text-success font-weight-bold">$1,000,500</strong></p>
      </div>
    </div>
  </div>
</div>
<!--  banner end  -->
<div class="site-section site-section-sm">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div>
          <div class="slide-one-item home-slider owl-carousel">
            <?php //foreach ($related_images as $related_image) :
            ?>
            <div><img src="<?php echo base_url?>/images/<?php echo $detail['image'] ?>" alt="Image" class="img-fluid"></div>
            <?php // endforeach; 
            ?>
          </div>
        </div>
        <div class="bg-white property-body border-bottom border-left border-right">
          <div class="row mb-5">
            <div class="col-md-6">
              <strong class="text-success h1 mb-3">$ <?php echo $detail['price'] ?></strong>
            </div>
            <div class="col-md-6">
              <ul class="property-specs-wrap mb-3 mb-lg-0  float-lg-right">
                <li>
                  <span class="property-specs">Beds</span>
                  <span class="property-specs-number"><?php echo $detail['beds'] ?></span>

                </li>
                <li>
                  <span class="property-specs">Baths</span>
                  <span class="property-specs-number"><?php echo $detail['baths'] ?></span>

                </li>
                <li>
                  <span class="property-specs">SQ FT</span>
                  <span class="property-specs-number"> <?php echo $detail['sq_ft'] ?></span>

                </li>
              </ul>
            </div>
          </div>
          <div class="row mb-5">
            <div class="col-md-6 col-lg-4 text-center border-bottom border-top py-3">
              <span class="d-inline-block text-black mb-0 caption-text">Home Type</span>
              <strong class="d-block"><?php echo str_replace("-", " ", $detail["home_type"])  ?></strong>
            </div>
            <div class="col-md-6 col-lg-4 text-center border-bottom border-top py-3">
              <span class="d-inline-block text-black mb-0 caption-text">Year Built</span>
              <strong class="d-block"><?php echo $detail['year_build'] ?></strong>
            </div>
            <div class="col-md-6 col-lg-4 text-center border-bottom border-top py-3">
              <span class="d-inline-block text-black mb-0 caption-text">Price/Sqft</span>
              <strong class="d-block"><?php echo $detail['price_sqft'] ?></strong>
            </div>
          </div>
          <h2 class="h4 text-black">More Info</h2>
          <p><?php echo $detail['description'] ?></p>

          <div class="row no-gutters mt-5">
            <div class="col-12">
              <h2 class="h4 text-black mb-3">Gallery</h2>
            </div>
            <?php foreach ($related_images as $related_image) : ?>
              <div class="col-sm-6 col-md-4 col-lg-3">

                <a href="images/<?php echo $related_image['image'] ?>" class="image-popup gal-item"><img src="images/<?php echo $related_image['image'] ?>" alt="Image" class="img-fluid"></a>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">

        <div class="bg-white widget border rounded">

          <h3 class="h4 text-black widget-title mb-3">Contact Agent</h3>
          <form action="user/request.php"method="post" class="form-contact-agent">
            <div class="form-group">
              <label for="name">Name</label>
              <input name="name" type="text" id="name" class="form-control">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input name="email" type="email" id="email" class="form-control">
            </div>
            <div class="form-group">
              <label for="phone">Phone</label>
              <input name="phone"type="text" id="phone" class="form-control">
            </div>
            
            <div class="form-group">
              <!-- <label for="phone">prop id</label> -->
              <input name="prop_id" type="hidden" value="<?php echo $detail['id'] ?>" id="phone" class="form-control">
            </div>
            <div class="form-group">
              <!-- <label for="phone">user id</label> -->
              <input name="user_id" type="hidden" value="<?php echo $_SESSION['id'] ?>" id="phone" class="form-control">
            </div>
            <div class="form-group">
              <!-- <label for="phone">Author id</label> -->
              <input name="author" type="hidden" value="<?php echo $detail['admin_name'] ?>" id="phone" class="form-control">
            </div>
            
            <div class="form-group">
              <input type="submit"name="btn_request" id="phone" class="btn btn-primary" value="Send Message">
            </div>
          </form>
        </div>

        <div class="bg-white widget border rounded">
          <h3 class="h4 text-black widget-title mb-3 ml-0">Share</h3>
          <div class="px-3" style="margin-left: -15px;">
            <a href="https://www.facebook.com/sharer/sharer.php?u=&quote=" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-facebook"></span></a>
            <a href="https://twitter.com/intent/tweet?text=&url=" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-twitter"></span></a>
            <a href="https://www.linkedin.com/sharing/share-offsite/?url=" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-linkedin"></span></a>
          </div>
        </div>
        <!--  Add to Favorite start  -->
        <div class="bg-white widget border rounded">
          <form action="favorites/add_favorite.php" method="post" class="form-contact-agent">
            <div class="form-group">
              <input type="hidden" name="prop_id" id="" value="<?php echo $detail['id']; ?>" class="form-control">
            </div>

            <div class="form-group">
              <input type="hidden" name="user_id" id="" value="<?php echo $_SESSION['id']; ?>" class="form-control">
            </div>

            <?php if($fav_checks): ?>
                <div class="form-group">
                  <input type="submit" name="btn_delete_fav" id="" class="btn btn-danger" value="Delete Favorite">
                </div>

              <?php else :  ?>
                <div class="form-group">
                  <input type="submit" name="btn_add_fav" id="" class="btn btn-primary" value="Add to Favorite">
                </div>
              <?php endif; ?>
          
          </form>
        </div>

      </div>

    </div>
  </div>
</div>

<div class="site-section site-section-sm bg-light">
  <div class="container">

    <div class="row">
      <div class="col-12">
        <div class="site-section-title mb-5">
          <h2>Related Properties</h2>
        </div>
      </div>
    </div>

    <div class="row mb-5">
      <?php foreach ($related_props as $related_prop) : ?>
        <div class="col-md-6 col-lg-4 mb-4">
          <div class="property-entry h-100">
            <a href="property-details.php?id=<?php echo $related_prop->id ?>"class="property-thumbnail">
              <div class="offer-type-wrap">
                <span class="offer-type bg-<?php if ($related_prop->type == "rent") echo "success";
                                            else echo "danger"; ?>"><?php echo $related_prop->type ?></span>
              </div>
              <img src="images/<?php echo $related_prop->image ?>" alt="Image" class="img-fluid">
            </a>
            <div class="p-4 property-body">
              <a href="#" class="property-favorite"><span class="icon-heart-o"></span></a>
              <h2 class="property-title"><a href="property-details.html"><?php echo $related_prop->name ?></a></h2>
              <span class="property-location d-block mb-3"><span class="property-icon icon-room"></span><?php echo $related_prop->location ?></span>
              <strong class="property-price text-primary mb-3 d-block text-success">$<?php echo $related_prop->price ?></strong>
              <ul class="property-specs-wrap mb-3 mb-lg-0">
                <li>
                  <span class="property-specs">Beds</span>
                  <span class="property-specs-number"><?php echo $related_prop->beds ?></span>

                </li>
                <li>
                  <span class="property-specs">Baths</span>
                  <span class="property-specs-number"><?php echo $related_prop->baths ?></span>

                </li>
                <li>
                  <span class="property-specs">SQ FT</span>
                  <span class="property-specs-number"><?php echo $related_prop->sq_ft ?></span>

                </li>
              </ul>

            </div>
          </div>
        </div>
      <?php endforeach; ?>

    </div>
  </div>

  <?php require("includes/footer.php") ?>