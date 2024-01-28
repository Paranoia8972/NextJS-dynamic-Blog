<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include('../config.php');
include(ROOT_PATH . '/admin/includes/admin_functions.php');
include(ROOT_PATH . '/admin/includes/post_functions.php');
include(ROOT_PATH . '/admin/includes/head_section.php');
$posts = getAllPosts(); ?>

<title>Admin | Manage Posts</title>

</head>
        <body>
        <?php include(ROOT_PATH . '/admin/includes/navbar.php') ?>
        <div class="container content">
                <?php include(ROOT_PATH . '/admin/includes/menu.php') ?>
                <div class="table-div"  style="width: 80%;">
                        <?php include(ROOT_PATH . '/admin/includes/messages.php') ?>
                        <?php if (empty($posts)): ?>
                                <h1 style="text-align: center; margin-top: 20px;">No posts in the database.</h1>
                        <?php else: ?>
                                <table class="table">
                                                <thead>
                                                <th>Nr</th>
                                                <th>Title</th>
                                                <th>Author</th>
                                                <th>Description</th>
                                                <th>Views</th>
                                                <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] == "Admin"): ?>
                                                        <th><small>Publish</small></th>
                                                <?php endif ?>
                                                <th><small>Edit</small></th>
                                                <th><small>Delete</small></th>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($posts as $key => $post): ?>
                                                <tr>
                                                        <td><?php echo $key + 1; ?></td>
                                                        <td>
                                                                <a   target="_blank"
                                                                href="<?php echo BASE_URL . '/post/' . $post['slug'] ?>">
                                                                        <?php echo $post['title']; ?>     
                                                                </a>
                                                        </td>
                                                        <td><?php echo $post['author']; ?></td>
                                                        <td><?php echo $post['description']; ?></td>
                                                        <td><?php echo $post['views']; ?></td>
                                                        <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] == "Admin" ): ?>
                                                                <td>
                                                                <?php if ($post['published'] == true): ?>
                                                                        <a class="fa fa-check btn unpublish"
                                                                                href="posts?unpublish=<?php echo $post['id'] ?>">
                                                                        </a>
                                                                <?php else: ?>
                                                                        <a class="fa fa-times btn publish"
                                                                                href="posts?publish=<?php echo $post['id'] ?>">
                                                                        </a>
                                                                <?php endif ?>
                                                                </td>
                                                        <?php endif ?>

                                                        <td>
                                                                <a class="fa fa-pencil btn edit"
                                                                        href="create_post?edit-post=<?php echo $post['id'] ?>">
                                                                </a>
                                                        </td>
                                                        <td>
                                                                <a  class="fa fa-trash btn delete" 
                                                                        href="create_post?delete-post=<?php echo $post['id'] ?>">
                                                                </a>
                                                        </td>
                                                </tr>
                                        <?php endforeach ?>
                                        </tbody>
                                </table>
                        <?php endif ?>
                </div>
        </div>
</body>
</html>