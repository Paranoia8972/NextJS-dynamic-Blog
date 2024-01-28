<?php if (isset($_SESSION['user']['username'])) { ?>
   <div class="logged_in_info">
      <span>Hiya,
         <?php echo $_SESSION['user']['username'] ?>!
      </span>
      |
      <span><a href="logout">Logout?</a></span>
   </div>
   <div class="banner" role=”banner” class="text">
      <div class="welcome_msg">
         <div class="container col-xxl-8 px-4 py-5">
            <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
               <div class="col-10 col-sm-8 col-lg-6">
               </div>
               <div class="col-lg-6">
                  <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3">A programming quote</h1>
                  <p class="lead">Programming is like writing a book... <br>
                     except if you miss a single comma on page 156 <br>
                     the whole thing makes no damn sense. <br>
                     <span>~ Unknown</span>
                  </p>
               </div>
            </div>
         </div>
      </div>
   </div>
<?php } else { ?>
   <div class="banner" role=”banner” class="text">
      <div class="welcome_msg">
         <div class="container col-xxl-8 px-4 py-5">
            <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
               <div class="col-10 col-sm-8 col-lg-6">
               </div>
               <div class="col-lg-6">
                  <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3">A programming quote</h1>
                  <p class="lead">Programming is like writing a book... <br>
                     except if you miss a single comma on page 156 <br>
                     the whole thing makes no damn sense. <br>
                     <span>~ Unknown</span>
                  </p>
                  <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                     <a href="register" type="button" class="btn btn-primary btn-lg px-4 me-md-2">Join us!</a>
                     <a type="button" href="login" class="btn btn-outline-secondary btn-lg px-4">Log in!</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
<?php } ?>
