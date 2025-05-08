<?php

require("../configs/config.php");
require("../includes/header.php");
$fav_sql="SELECT * FROM `props` JOIN `tbl_favorite` ON props.id=tbl_favorite.prop_id  WHERE tbl_favorite.user_id='$_SESSION[id]'";
$stmt=$con->prepare($fav_sql);

$stmt->execute();
$favorites=$stmt->fetchAll(PDO::FETCH_OBJ);
// echo var_dump($props);


?>
<div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(<?php echo base_url; ?>/images/hero_bg_2.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row align-items-center justify-content-center text-center">
      <div class="col-md-10">
        <h1 class="mb-2">Favorite</h1>
      </div>
    </div>
  </div>
</div>
<div class="site-section site-section-sm bg-light">
  <div class="container">

    <div class="row mb-5">
      <?php if (count($favorites) > 0) : ?>
        <?php foreach ($favorites as $favorite) :  ?>
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="property-entry h-100 rounded">
              <?php   ?>
              <!-- ============ Valiation When click card  ================ -->

              <a href="../property-details.php?id=<?php echo $favorite->prop_id; ?>"
                class="property-thumbnail">
                <div class="offer-type-wrap">
                  <span class="offer-type bg-<?php if ($favorite->type == "rent") echo "success";
                                              else echo "danger"; ?>"><?php echo $favorite->type ?></span>
                </div>
                <img src="<?php echo base_url?>/images/<?php echo $favorite->image ?>" alt="Image" class="img-fluid">
              </a>
              <div class="p-4 property-body">
                <a href="#" class="property-favorite"><span class="icon-heart-o"></span></a>
                <h2 class="property-title"><a href="property-details.php?id=<?php echo $favorite->id; ?>"><?php echo $favorite->name ?></a></h2>
                <span class="property-location d-block mb-3"><span class="property-icon icon-room"></span><?php echo $favorite->location ?></span>
                <strong class="property-price text-primary mb-3 d-block text-success">$<?php echo $favorite->price ?></strong>
                <ul class="property-specs-wrap mb-3 mb-lg-0">
                  <li>
                    <span class="property-specs">Beds</span>
                    <span class="property-specs-number"><?php echo $favorite->beds ?></span>

                  </li>
                  <li>
                    <span class="property-specs">Baths</span>
                    <span class="property-specs-number"><?php echo $favorite->baths ?></span>

                  </li>
                  <li>
                    <span class="property-specs">SQ FT</span>
                    <span class="property-specs-number"><?php echo $favorite->sq_ft ?></span>

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