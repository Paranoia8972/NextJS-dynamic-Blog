<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include('../config.php');
include(ROOT_PATH . '/admin/includes/admin_functions.php');
include(ROOT_PATH . '/admin/includes/head_section.php'); 

$result = handleUpload();

?>
      
<!DOCTYPE html>
<html>
<head>
<title>Admin | Image upload</title>
<style type="text/css">
   #content{
        width: 50%;
        margin: 20px auto;
        border: 1px solid #cbcbcb;
   }
   form{
        width: 50%;
        margin: 20px auto;
   }
   form div{
        margin-top: 5px;
   }
   #img_div{
        width: 80%;
        padding: 5px;
        margin: 15px auto;
        border: 1px solid #cbcbcb;
   }
   #img_div:after{
        content: "";
        display: block;
        clear: both;
   }
   img{
        float: left;
        margin: 5px;
        width: 300px;
        height: 140px;
   }
</style>
</head>
<body>
          <!-- admin navbar -->
          <?php include(ROOT_PATH . '/admin/includes/navbar.php') ?>
        <div class="container content">
                <!-- Left side menu -->
                <?php include(ROOT_PATH . '/admin/includes/menu.php') ?>

                <!-- Middle form - to create and edit -->
                <div class="action">
<div id="content">
  <?php
  while ($row = mysqli_fetch_array($result)) {
    echo "<div id='img_div'>";
      echo "<img src='/static/images/".$row['image']."' >";
      echo "<p>".$row['alt']."</p>";
      echo "<form method='POST' action='upload'>";
      echo "<input type='hidden' name='id' value='".$row['id']."'>";
      echo "<input type='hidden' name='image' value='".$row['image']."'>";
      echo "<button type='submit' name='delete'>Delete</button>";
      echo "</form>";
    echo "</div>";
  }
?>
  <form method="POST" action="upload" enctype="multipart/form-data">
        <input type="hidden" name="size" value="1000000">
        <div>
          <input type="file" name="image">
        </div>
        <div>
      <textarea 
        id="text" 
        cols="40" 
        rows="4" 
        name="image_text" 
        placeholder="Image alt"></textarea>
        </div>
        <div>
                <button type="submit" name="upload">POST</button>
        </div>
  </form>
</div>
</body>
</html>
