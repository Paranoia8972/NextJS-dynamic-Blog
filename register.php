<?php include "config.php"; ?>
<?php include "includes/registration_login.php"; ?>
<?php include "includes/head_section.php"; ?>
<title>
   <?php echo SITE_NAME; ?> | Sign up
</title>
</head>

<body>
   <div>
      <?php include ROOT_PATH . "/includes/navbar.php"; ?>

      <h2 class="position-absolute start-50 translate-middle">Register on
         <?php echo SITE_NAME; ?>
      </h2>
      <main class="form-signin w-100 m-auto mt-5">
         <div class="mt-5">
            <form>
               <?php include ROOT_PATH . "/includes/errors.php"; ?>
               <div class="form-floating">
                  <input type="text" class="form-control" id="floatingInput" name="username"
                     value="<?php echo $username; ?>" value="" placeholder="Username">
                  <label for="floatingInput">Username</label>
               </div>
               <div class="form-floating">
                  <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" id="floatingEmail"
                     placeholder="Email">
                  <label for="floatingEmail">Email</label>
               </div>
               <div class="form-floating">
                  <input type="password" name="password_1" class="form-control" id="floatingPassword"
                     placeholder="Password">
                  <label for="floatingPassword">Password</label>
               </div>
               <div class="form-floating">
                  <input type="password" name="password_2" class="form-control" id="floatingPassword"
                     placeholder="Password confirmation">
                  <label for="floatingPassword">Password confirmation</label>
               </div>
               <div class="form-check text-start my-3">
                  <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
                  <label class="form-check-label" for="flexCheckDefault">
                     Remember me
                  </label>
               </div>
               <button class="btn btn-primary w-100 py-2" type="submit" name="reg_user">Register</button>
               <p class="mt-3">
                  Already a member? <a href="login">Login</a>
               </p>
            </form>
         </div>
      </main>
      <?php include ROOT_PATH . "/includes/footer.php"; ?>
