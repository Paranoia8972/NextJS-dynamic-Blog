<?php
include "config.php";
include "includes/public_functions.php";

$uri = $_SERVER["REQUEST_URI"];
$uriParts = explode('/', $uri);
$post_slug = end($uriParts);
$posts = getPublishedPosts();

if (isset($post_slug)) {
    $post = getPost($post_slug);
}
$topics = getAllTopics();
include "includes/head_section.php";
?>
<!-- og meta -->
<meta property="og:type" content="article" />
<meta property="og:title" content="<?php echo $post["title"]; ?>" />
<meta property="og:url" content="<?php echo BASE_URL . "/post/" . $post["slug"]; ?>" />
<meta property="og:description" content="<?php echo $post["description"]; ?>" />
<meta property="og:image" content="<?php echo BASE_URL . "/static/images/" . $post["image"]; ?>" />
<meta property="og:image:alt" content="<?php echo $post["description"]; ?>" />
<meta property="og:image:width" content="1200" />
<meta property="og:image:height" content="630" />
<meta property="og:article:published_time" content="<?php echo $post["created_at"]; ?>" />
<meta property="og:article:modified_time" content="<?php echo $post["updated_at"]; ?>" />
<meta property="og:article:author" content="<?php echo $post['author']; ?>" />
<meta property="og:article:section" content="<?php echo $post["topic"]; ?>" />
<meta property="og:article:tag" content="<?php echo $post["keywords"]; ?>" />
<!-- twitter meta -->
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="@paranoia8972" />
<meta name="twitter:creator" content="@paranoia8972" />
<meta name="twitter:title" content="<?php echo $post["title"]; ?>" />
<meta name="twitter:description" content="<?php echo $post["description"]; ?>" />
<meta name="twitter:image" content="<?php echo BASE_URL . "/static/images/" . $post["image"]; ?>" />
<meta name="twitter:image:alt" content="<?php echo $post["description"]; ?>" />
<title>
    <?php echo $post["title"]; ?> | Encryptopia Blog
</title>
</head>

<body>
    <?php include ROOT_PATH . "/includes/navbar.php"; ?>
    <!-- Page content-->
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8">
                <!-- Post content-->
                <article>
                    <!-- Post header-->
                    <header class="mb-4">
                        <?php if ($post["published"] == false): ?>
                            <h2 class="post-title">Sorry... This post has not been published</h2>
                        <?php else: ?>
                            <!-- Post title-->
                            <h1 class="post-title fw-bolder mb-1">
                                <?php echo $post[
                                    "title"
                                ]; ?>
                            </h1>
                            <!-- Post meta content-->
                            <div class="text-muted fst-italic mb-2">Posted on January 1, 2023 by Start Bootstrap</div>
                            <!-- Post categories-->
                            <a class="badge bg-secondary text-decoration-none link-light" href="#!">Web Design</a>
                            <a class="badge bg-secondary text-decoration-none link-light" href="#!">Freebies</a>
                        </header>
                        <!-- Preview image figure-->
                        <figure class="mb-4"><img class="img-fluid rounded"
                                src="<?php echo BASE_URL . "/static/images/" . $post["image"]; ?>"
                                alt="<?php echo $post["slug"]; ?>" /></figure>
                        <div class="post-body-div">
                            <?php echo html_entity_decode(
                                $post["body"]
                            ); ?>
                        </div>
                    </article>
                    <!-- Comments section - Soon! -->
                </div>
                <!-- Side widgets-->
                <div class="col-lg-4">
                    <!-- Categories widget-->
                    <div class="card mb-4">
                        <div class="card-header">Topics</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <ul class="list-unstyled mb-0">
                                        <?php foreach ($topics as $topic): ?>
                                            <a href="<?php echo BASE_URL .
                                                "/topic/" .
                                                $topic["id"]; ?>">
                                                <?php echo $topic[
                                                    "name"
                                                ]; ?>
                                            </a>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Description -->
                    <div class="card mb-4">
                        <div class="card-header">Description</div>
                        <div class="card-body">
                            <?php echo $post["description"]; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <!-- Footer-->
    <?php include ROOT_PATH . "/includes/footer.php"; ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <!-- Javascripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="static/js/scripts.js"></script>
    <!-- Bootstrap Javascript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="static/js/scripts.js"></script>
    </html>