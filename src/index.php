<?php
ini_set("display_errors", "1");
ini_set("display_startup_errors", "1");
error_reporting(E_ALL);

require_once "config.php";
require_once ROOT_PATH . "/includes/head_section.php";
require_once ROOT_PATH . "/includes/public_functions.php";
require_once ROOT_PATH . "/includes/registration_login.php";

$posts = getPublishedPosts();
?>
<!-- og meta -->
<meta property="og:type" content="article" />
<meta property="og:title" content="Encryptopia Blog" />
<meta property="og:description"
   content="A unique space where technology meets creativity. Here, we dive into the fascinating world of servers, web development, Raspberry Pis, Arduino, and much more. I believe in the power of self-hosting and aim to provide insightful content that fuels your passion for technology. Join me to explore, learn, and grow in the realm of digital possibilities." />
<meta property="og:url" content="https://blog.encryptopia.dev" />
<meta property="og:image" content="https://blog.encryptopia.dev/static/images/og-image.webp" />
<meta property="og:image:alt" content="Encryptopia Blog" />
<meta property="og:image:width" content="1200" />
<meta property="og:image:height" content="627" />
<!-- twitter meta -->
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="@paranoia8972" />
<meta name="twitter:creator" content="@paranoia8972" />
<meta name="twitter:title" content="Encryptopia Blog" />
<meta name="twitter:description"
   content="Encryptopia. A unique space where technology meets creativity. Here, we dive into the fascinating world of servers, web development, Raspberry Pis, Arduino, and much more. I believe in the power of self-hosting and aim to provide insightful content that fuels your passion for technology. Join me to explore, learn, and grow in the realm of digital possibilities." />
<meta name="twitter:image" content="https://blog.encryptopia.dev/static/images/og-image.webp" />
<meta name="twitter:image:alt" content="Encryptopia Blog" />
<title>
   <?php echo SITE_NAME; ?> | Home
</title>
</head>
<body>
   <?php include ROOT_PATH . "/includes/navbar.php"; ?>
   <?php include ROOT_PATH . "/includes/banner.php"; ?>
   <div class="container">
      <div class="content" role=”main”>
         <h2 class="content-title border-bottom">Recent Articles</h2>
         <div class="row">
            <?php foreach ($posts as $post): ?>
               <div class="col-md-4">
                  <div class="post" style="margin-left: 0px;">
                     <img class="rounded-3 img-fluid post_image"
                        src="<?php echo BASE_URL . "/static/images/" . $post["image"]; ?>"
                        alt="<?php echo $post["slug"]; ?>">
                     <a href="post/<?php echo $post["slug"]; ?>">
                        <div class="post_info">
                           <h3>
                              <?php echo $post["title"]; ?>
                           </h3>
                           <div class="info">
                              <span class="date">
                                 <?php echo date("F j, Y ", strtotime($post["created_at"])); ?>
                              </span>
                           </div>
                           <?php if (isset($post["topic"]["name"])): ?>
                              <a href="<?php echo BASE_URL . "/topic/" . $post["topic"]["id"]; ?>" class="btn category">
                                 <?php echo $post["topic"]["name"]; ?>
                              </a>
                           <?php endif; ?>
                        </div>
                     </a>
                  </div>
               </div>
            <?php endforeach; ?>
         </div>
      </div>
   </div>
   <?php include ROOT_PATH . "/includes/footer.php"; ?>
   </html>