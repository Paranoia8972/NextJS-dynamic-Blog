<?php
   include 'config.php';
   
   if(isset($_GET['name'])) {
       $name = $_GET['name'];
       $query = "SELECT destination FROM redirects WHERE name = '$name'";
       $result = mysqli_query($conn, $query);
   
       if(mysqli_num_rows($result) > 0) {
           $row = mysqli_fetch_assoc($result);
           header('Location: ' . $row['destination']);
           exit;
       } else {
           echo "No redirect found for the given name. Redirecting to the main website...";
           echo '<meta http-equiv="refresh" content="5;url=/">';
       }
   } else {
       echo "No redirect name provided. Redirecting to the main website...";
       echo '<meta http-equiv="refresh" content="5;url=/">';
   }
   ?>