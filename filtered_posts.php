<?php
ini_set("display_errors", "1");
ini_set("display_startup_errors", "1");
error_reporting(E_ALL);
include "config.php";
include "includes/public_functions.php";
include "includes/head_section.php";

$uri = $_SERVER["REQUEST_URI"];
$uriParts = explode('/', $uri);
$topic_id = end($uriParts);

if (isset($topic_id)) {
   $posts = getPublishedPostsByTopic($topic_id);
}

$topics = getAllTopics();
?>
<title>
   <?php echo SITE_NAME; ?> | Home
</title>
</head>

<body>
   <?php include ROOT_PATH . "/includes/navbar.php"; ?>
   <div class="container">
      <div class="content" style="display: flex;">
         <div class="posts" style="margin-right: 200px;">
            <h2 class="content-title border-bottom">
               Articles on <u>
                  <?php echo getTopicNameById($topic_id); ?>
               </u>
            </h2>
            <div class="row">
               <?php foreach ($posts as $post): ?>
                  <div class="col-md-4">
                     <div class="post" style="margin-left: 0px;">
                        <img class="rounded-3 img-fluid post_image"
                           src="<?php echo BASE_URL . "/static/images/" . $post["image"]; ?>"
                           alt="<?php echo $post["slug"]; ?>">
                        <a href="/post/<?php echo $post["slug"]; ?>">
                           <div class="post_info">
                              <h3>
                                 <?php echo $post["title"]; ?>
                              </h3>
                              <div class="info">
                                 <span class="date">
                                    <?php echo date("F j, Y ", strtotime($post["created_at"])); ?>
                                 </span>
                              </div>
                           </div>
                        </a>
                     </div>
                  </div>
               <?php endforeach; ?>
            </div>
         </div>
         <div class="post-sidebar" id="post-sidebar" style="position: fixed; right: 0; top: 150px;">
            <div class="card">
               <div class="card-header">
                  <h2>Topics</h2>
               </div>
               <div class="list-group">
                  <?php foreach ($topics as $topic): ?>
                     <a href="<?php echo BASE_URL . "/topic/" . $topic["id"]; ?>"
                        class="list-group-item list-group-item-action <?php echo $topic_id == $topic['id'] ? 'active' : ''; ?>">
                        <?php echo $topic["name"]; ?>
                     </a>
                  <?php endforeach; ?>
               </div>
            </div>
         </div>
      </div>
      <?php include ROOT_PATH . "/includes/footer.php"; ?>
      <script>
         window.addEventListener('scroll', function () {
            var sidebar = document.getElementById('post-sidebar');
            var topDistance = window.pageYOffset;
            if (topDistance > 150) {
               sidebar.style.top = '0px';
            } else {
               sidebar.style.top = (150 - topDistance) + 'px';
            }
         });
      </script>