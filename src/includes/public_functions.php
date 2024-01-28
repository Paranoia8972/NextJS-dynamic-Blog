<?php
/* * * * * * * * * * * * * * *
 * Returns all published posts
 * * * * * * * * * * * * * * */
function getPublishedPosts()
{
    // use global $conn object in function
    global $conn;
    $userRole = getUserRole();
    if ($userRole == "Admin" || $userRole == "Author") {
        $sql = "SELECT * FROM posts";
    } else {
        $sql = "SELECT * FROM posts WHERE published=true";
    }
    $result = mysqli_query($conn, $sql);
    // fetch all posts as an associative array called $posts
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $final_posts = [];
    foreach ($posts as $post) {
        $post["topic"] = getPostTopic($post["id"]);
        array_push($final_posts, $post);
    }
    return $final_posts;
}
/* * * * * * * * * * * * * * *
 * Receives a post id and
 * Returns topic of the post
 * * * * * * * * * * * * * * */
function getPostTopic($post_id)
{
    global $conn;
    $sql = "SELECT * FROM topics WHERE id=
                           (SELECT topic_id FROM post_topic WHERE post_id=$post_id) LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $topic = mysqli_fetch_assoc($result);
    return $topic;
}
/* * * * * * * * * * * * * * * *
 * Returns all posts under a topic
 * * * * * * * * * * * * * * * * */
function getPublishedPostsByTopic($topic_id)
{
    global $conn;
    $topic_id = intval($topic_id); // Ensure $topic_id is an integer
    $sql = "SELECT * FROM posts ps
                       WHERE ps.id IN
                       (SELECT pt.post_id FROM post_topic pt
                               WHERE pt.topic_id=$topic_id GROUP BY pt.post_id
                               HAVING COUNT(1) = 1) AND ps.published=true";
    $result = mysqli_query($conn, $sql);
    // fetch all posts as an associative array called $posts
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $final_posts = [];
    foreach ($posts as $post) {
        $post["topic"] = getPostTopic($post["id"]);
        array_push($final_posts, $post);
    }
    return $final_posts;
}
/* * * * * * * * * * * * * * * *
 * Returns topic name by topic id
 * * * * * * * * * * * * * * * * */
function getTopicNameById($id)
{
    global $conn;
    $id = intval($id); // Ensure $id is an integer
    $sql = "SELECT name FROM topics WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    $topic = mysqli_fetch_assoc($result);
    if ($topic) {
        return $topic["name"];
    } else {
        return null;
    }
}
/* * * * * * * * * * * * * * *
 * Returns a single post
 * * * * * * * * * * * * * * */
function getPost($post_slug)
{
    global $conn;
    $sql = "SELECT * FROM posts WHERE slug='$post_slug' AND published=true";
    $result = mysqli_query($conn, $sql);

    // fetch query results as associative array.
    $post = mysqli_fetch_assoc($result);
    if ($post) {
        // get the topic to which this post belongs
        $post["topic"] = getPostTopic($post["id"]);
        // get the author of the post
        $post["author"] = getUsernameById($post["user_id"]);
    }

    return $post;
}
function getUserRole()
{
    // Start the session if it's not already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Check if the 'user' session variable is set
    if (isset($_SESSION["user"]) && isset($_SESSION["user"]["role"])) {
        return $_SESSION["user"]["role"];
    }

    return null;
}
/* * * * * * * * * * * *
 *  Returns all topics
 * * * * * * * * * * * * */
function getAllTopics()
{
    global $conn;
    $sql = "SELECT * FROM topics";
    $result = mysqli_query($conn, $sql);
    $topics = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $topics;
}

/****************
 * Commenting System
 ******************/
// Set logged in user id: This is just a simulation of user login. We haven't implemented user log in
// But we will assume that when a user logs in,
// they are assigned an id in the session variable to identify them across pages
$user_id = 1;
// connect to database
$db = mysqli_connect("192.168.178.67", "paranoia", "w187161e211!2#", "blog");
// get post with id 1 from database
$post_query_result = mysqli_query($db, "SELECT * FROM posts WHERE id=1");
$post = mysqli_fetch_assoc($post_query_result);

// Get all comments from database
if (isset($post["id"])) {
    $comments_query_result = mysqli_query(
        $db,
        "SELECT * FROM comments WHERE post_id=" .
            $post["id"] .
            " ORDER BY created_at DESC"
    );
    $comments = mysqli_fetch_all($comments_query_result, MYSQLI_ASSOC);
} else {
    // Handle the case where $post['id'] is not set
    // This could be setting $comments to an empty array, or showing an error message
    $comments = [];
}

// Receives a user id and returns the username
function getUsernameById($id)
{
    global $db;
    $result = mysqli_query(
        $db,
        "SELECT username FROM users WHERE id=" . $id . " LIMIT 1"
    );
    // return the username
    return mysqli_fetch_assoc($result)["username"];
}
// Receives a comment id and returns the username
function getRepliesByCommentId($id)
{
    global $db;
    $result = mysqli_query($db, "SELECT * FROM replies WHERE comment_id=$id");
    $replies = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $replies;
}
// Receives a post id and returns the total number of comments on that post
function getCommentsCountByPostId($post_id)
{
    global $db;
    $result = mysqli_query($db, "SELECT COUNT(*) AS total FROM comments");
    $data = mysqli_fetch_assoc($result);
    return $data["total"];
}
// If the user clicked submit on comment form...
if (isset($_POST["comment_posted"])) {
    global $db;
    // grab the comment that was submitted through Ajax call
    $comment_text = $_POST["comment_text"];
    // insert comment into database
    $sql =
        "INSERT INTO comments (post_id, user_id, body, created_at, updated_at) VALUES (1, " .
        $user_id .
        ", '$comment_text', now(), null)";
    $result = mysqli_query($db, $sql);
    // Query same comment from database to send back to be displayed
    $inserted_id = $db->insert_id;
    $res = mysqli_query($db, "SELECT * FROM comments WHERE id=$inserted_id");
    $inserted_comment = mysqli_fetch_assoc($res);
    // if insert was successful, get that same comment from the database and return it
    if ($result) {
        $comment =
            "<div class='comment clearfix'>
                                       <img src='profile.png' alt='' class='profile_pic'>
                                       <div class='comment-details'>
                                               <span class='comment-name'>" .
            getUsernameById($inserted_comment["user_id"]) .
            "</span>
                                               <span class='comment-date'>" .
            date("F j, Y ", strtotime($inserted_comment["created_at"])) .
            "</span>
                                               <p>" .
            $inserted_comment["body"] .
            "</p>
                                               <a class='reply-btn' href='#' data-id='" .
            $inserted_comment["id"] .
            "'>reply</a>
                                       </div>
                                       <!-- reply form -->
                                       <form action='post_details' class='reply_form clearfix' id='comment_reply_form_" .
            $inserted_comment["id"] .
            "' data-id='" .
            $inserted_comment["id"] .
            "'>
                                               <textarea class='form-control' name='reply_text' id='reply_text' cols='30' rows='2'></textarea>
                                               <button class='btn btn-primary btn-xs pull-right submit-reply'>Submit reply</button>
                                       </form>
                               </div>";
        $comment_info = [
            "comment" => $comment,
            "comments_count" => getCommentsCountByPostId(1),
        ];
        echo json_encode($comment_info);
        exit();
    } else {
        echo "error";
        exit();
    }
}
// If the user clicked submit on reply form...
if (isset($_POST["reply_posted"])) {
    global $db;
    // grab the reply that was submitted through Ajax call
    $reply_text = $_POST["reply_text"];
    $comment_id = $_POST["comment_id"];
    // insert reply into database
    $sql =
        "INSERT INTO replies (user_id, comment_id, body, created_at, updated_at) VALUES (" .
        $user_id .
        ", $comment_id, '$reply_text', now(), null)";
    $result = mysqli_query($db, $sql);
    $inserted_id = $db->insert_id;
    $res = mysqli_query($db, "SELECT * FROM replies WHERE id=$inserted_id");
    $inserted_reply = mysqli_fetch_assoc($res);
    // if insert was successful, get that same reply from the database and return it
    if ($result) {
        $reply =
            "<div class='comment reply clearfix'>
                                       <img src='profile.png' alt='' class='profile_pic'>
                                       <div class='comment-details'>
                                               <span class='comment-name'>" .
            getUsernameById($inserted_reply["user_id"]) .
            "</span>
                                               <span class='comment-date'>" .
            date("F j, Y ", strtotime($inserted_reply["created_at"])) .
            "</span>
                                               <p>" .
            $inserted_reply["body"] .
            "</p>
                                               <a class='reply-btn' href='#'>reply</a>
                                       </div>
                               </div>";
        echo $reply;
        exit();
    } else {
        echo "error";
        exit();
    }
}
?>
