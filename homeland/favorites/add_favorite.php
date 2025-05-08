<?php
require("../includes/header.php");
require("../configs/config.php");

if (isset($_POST['btn_add_fav'])) {
  $prop_id = $_POST['prop_id'];
  $user_id = $_POST['user_id'];
  $sql = "INSERT INTO `tbl_favorite` (`prop_id`,`user_id`) VALUES ('$prop_id','$user_id')";
  $stmt = $con->prepare($sql);
  $stmt->execute();
  if ($stmt){
    //  header("Location : ".base_url."/property-details.php?id='$prop_id'");
    echo "<script>window.location.href='" . base_url . "/property-details.php?id=$prop_id' </script>";

  }
}

//=========== button Delete favorite =================
if (isset($_POST['btn_delete_fav'])){
  $prop_id=$_POST['prop_id'];
  $user_id=$_POST['user_id'];

  $sql="DELETE FROM `tbl_favorite` WHERE prop_id='$prop_id' AND user_id='$user_id'";
  $stmt=$con->prepare($sql);
  $stmt->execute();
  if ($stmt){
    //  header("Location : ".base_url."/property-details.php?id='$prop_id'");
    echo "<script>window.location.href='" . base_url . "/property-details.php?id=$prop_id' </script>";

  }
 }

