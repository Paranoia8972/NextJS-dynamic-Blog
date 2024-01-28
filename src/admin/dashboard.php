<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if (!isset($_SESSION['user']['role']) || ($_SESSION['user']['role'] != 'Admin' && $_SESSION['user']['role'] != 'Author')) {
    header('Location: /');
    exit;
}
include('../config.php');
$user_query = "SELECT COUNT(*) as count FROM users";
$user_result = mysqli_query($conn, $user_query);
$user_count = mysqli_fetch_assoc($user_result)['count'];

$post_query = "SELECT COUNT(*) as count FROM posts";
$post_result = mysqli_query($conn, $post_query);
$post_count = mysqli_fetch_assoc($post_result)['count'];

$image_query = "SELECT COUNT(image) as count FROM posts WHERE image IS NOT NULL";
$image_result = mysqli_query($conn, $image_query);
$image_count = mysqli_fetch_assoc($image_result)['count'];

$redirect_query = "SELECT COUNT(*) as count FROM redirects";
$redirect_result = mysqli_query($conn, $redirect_query);
$redirect_count = mysqli_fetch_assoc($redirect_result)['count'];

$topic_query = "SELECT COUNT(*) as count FROM topics";
$topic_result = mysqli_query($conn, $topic_query);
$topic_count = mysqli_fetch_assoc($topic_result)['count'];

include(ROOT_PATH . '/admin/includes/admin_functions.php');
include(ROOT_PATH . '/admin/includes/head_section.php');
?>

<title>Admin | Dashboard</title>

</head>
        <body>
                <div class="header">
                <div class="logo">
                        <a href="<?php echo BASE_URL .'/admin/dashboard' ?>">
                                <h1><?php echo SITE_NAME; ?> - Admin</h1>
                        </a>
                </div>
                <?php if (isset($_SESSION['user'])): ?>
                        <div class="user-info">
                                <span><?php echo $_SESSION['user']['username'] ?></span> &nbsp; &nbsp; 
                                <a href="<?php echo BASE_URL . '/logout'; ?>" class="logout-btn">logout</a>
                        </div>
                <?php endif ?>
                </div>
                <div class="container content">        
                        <h1 class="greeting">
                                <?php
                                $hour = date('H');
                                $username = isset($_SESSION['user']) ? $_SESSION['user']['username'] : 'you are not logged in!';

                                if ($hour >= 5 && $hour < 10 ) {
                                        echo "Good Morning, {$username}!";
                                } else if ($hour >= 10 && $hour < 14) {
                                        echo "Good Day, {$username}!";
                                } else if ($hour >= 14 && $hour < 17) {
                                        echo "Good Afternoon, {$username}!";
                                } else if ($hour >= 17 && $hour < 22) {
                                        echo "Good Evening, {$username}!";
                                } else {
                                        echo "Good Night, {$username}!";
                                }
                                ?>
                        </h1>
                        <?php include(ROOT_PATH . '/admin/includes/menu.php') ?>
                                <p>User count: <?php echo $user_count; ?></p>
                                <p>Post count: <?php echo $post_count; ?></p>
                                <p>Image count: <?php echo $image_count; ?></p>
                                <p>Topic count: <?php echo $topic_count; ?></p>
                                <p>Redirect count: <?php echo $redirect_count; ?></p>
                        </div>
                </div>
        </body>
</html>