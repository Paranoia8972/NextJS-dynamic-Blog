<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include('../config.php');
include(ROOT_PATH . '/admin/includes/admin_functions.php');
include(ROOT_PATH . '/admin/includes/post_functions.php');
include(ROOT_PATH . '/admin/includes/head_section.php'); 
$topics = getAllTopics();  
?>

<script src="https://cdn.tiny.cloud/1/h2w5rgpp6vxo2wd21iyxkwuth2ano47yparetlhecb9fiszm/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<title>Admin | Create Post</title>

</head>
        <body>
                <?php include(ROOT_PATH . '/admin/includes/navbar.php') ?>
                <div class="container content">
                <?php include(ROOT_PATH . '/admin/includes/menu.php') ?>
                <div class="action create-post-div">
                        <h1 class="page-title">Create/Edit Post</h1>
                        <form method="post" enctype="multipart/form-data" action="<?php echo BASE_URL . '/admin/create_post'; ?>" >
                        <?php include(ROOT_PATH . '/includes/errors.php'); ?>
                        <?php if ($isEditingPost === true): ?>
                        <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                        <?php endif; ?>

                                <input type="text" name="title" value="<?php echo $title; ?>" placeholder="Title">
                                <input type="text" name="description" value="<?php echo $description; ?>" placeholder="Description">
                                <label style="float: left; margin: 5px auto 5px;">Featured image</label>
                                <input type="file" name="featured_image" >
                                <textarea name="body" id="editor">
<header>
    <p>Short description about the post. (Lorem ipsum dolor sit amet consectetur adipisicing elit.)</p>

    <h1>Blog Post Title</h1>
    <p>Published on: <time datetime="2023-01-01">January 1, 2023</time></p>
    <p><img src="https://placekitten.com/980/290" alt="Cat"></p>

    <P>Longer text. (Lorem ipsum dolor sit amet consectetur.
    Deserunt, assumenda vero? Numquam, facilis sint.
    Ut eaque quis officia fugit nobis?)</P>
</header>

<article>

</br>

    <h2>About this project</h2>
    <p>
        This is the introduction of your blog post. Provide a brief overview of what the post is about.
    </p>
    <h2>Steps / Content</h2>
    <ol>
        <li>First</li>
        <li>Second</li>
        <li>Third</li>
        <li>Fourth</li>
        <li>Fith</li>
    </ol>

    <section>
        <h2>Section Heading</h2>
        <p>
            Lorem ipsum dolor sit, amet consectetur adipisicing.
            Consectetur maxime error et quibusdam reprehenderit voluptatibus.
            Error dolorem culpa in laudantium. Illum, exercitationem?
            Fugiat deleniti, ducimus ipsa repudiandae debitis id!
            Ducimus vel maiores, nobis minima reiciendis quidem.
        </p>
    </section>
    <section>
        <h2>Another Section Heading</h2>
        <p>
            Lorem ipsum dolor, sit amet consectetur adipisicing elit.
            Est, asperiores accusantium voluptatum ipsum laborum nesciunt blanditiis.
            Odio provident deleniti optio pariatur voluptatibus velit omnis!
            Ipsam quas, asperiores tenetur sed voluptate pariatur aliquid.
            Esse placeat sit minima architecto eaque magni maiores.
            Commodi aspernatur praesentium cum corrupti autem tenetur in!
            Non ipsam commodi numquam mollitia quam praesentium assumenda.
        </p>
    </section>
    <section>
        <h2>Other things</h2>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing.</p>
        <ol>
            <li>First</li>
            <li>Second</li>
            <li>Third</li>
            <li>Fourth</li>
            <li>Fith</li>
        </ol>
    </section>
    </br>
    <section>
        <h2>Ending sentence</h2>
        <p>Lorem ipsum dolor sit amet.
        Placeat, deleniti. Laborum, ipsam cupiditate.</p>

</article>
                                </textarea>
                                <select name="topic_id">
                                        <option value="" selected disabled>Choose topic</option>
                                        
                                        <?php foreach ($topics as $topic): ?>
                                                <option value="<?php echo $topic['id']; ?>">
                                                        <?php echo $topic['name']; ?>
                                                </option>
                                        <?php endforeach ?>
                                </select>
                                
                                <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] == "Admin"): ?>
                                    <?php if ($published == true): ?>
                                        <label for="publish">
                                            Publish
                                            <input type="checkbox" value="1" name="publish" checked="checked">&nbsp;
                                        </label>
                                    <?php else: ?>
                                        <label for="publish">
                                            Publish
                                            <input type="checkbox" value="1" name="publish">&nbsp;
                                        </label>
                                    <?php endif ?>
                                <?php endif ?>
                                
                                <?php if ($isEditingPost === true): ?> 
                                        <button type="submit" class="btn" name="update_post">UPDATE</button>
                                <?php else: ?>
                                        <button type="submit" class="btn" name="create_post">Save Post</button>
                                <?php endif ?>

                        </form>
                </div>
                </div>
                <script>
tinymce.init({
  selector: 'textarea',
  plugins: 'wordcount autosave charmap code codesample emoticons image importcss preview save searchreplace table template link lists accordion',
  toolbar: 'undo redo  | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent accordion | link image | codesample code preview',
});
</script>
        </body>
</html>