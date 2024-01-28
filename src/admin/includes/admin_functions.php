<?php 
// Admin user variables
$admin_id = 0;
$isEditingUser = false;
$username = "";
$role = "";
$email = "";
// general variables
$errors = [];

// Topics variables
$topic_id = 0;
$isEditingTopic = false;
$topic_name = "";

/* - - - - - - - - - - 
-  Admin users actions
- - - - - - - - - - -*/
// if user clicks the create admin button
if (isset($_POST['create_admin'])) {
        createAdmin($_POST);
}
// if user clicks the Edit admin button
if (isset($_GET['edit-admin'])) {
        $isEditingUser = true;
        $admin_id = $_GET['edit-admin'];
        editAdmin($admin_id);
}
// if user clicks the update admin button
if (isset($_POST['update_admin'])) {
        updateAdmin($_POST);
}
// if user clicks the Delete admin button
if (isset($_GET['delete-admin'])) {
        $admin_id = $_GET['delete-admin'];
        deleteAdmin($admin_id);
}

/* - - - - - - - - - - 
-  Topic actions
- - - - - - - - - - -*/
// if user clicks the create topic button
if (isset($_POST['create_topic'])) { createTopic($_POST); }
// if user clicks the Edit topic button
if (isset($_GET['edit-topic'])) {
        $isEditingTopic = true;
        $topic_id = $_GET['edit-topic'];
        editTopic($topic_id);
}
// if user clicks the update topic button
if (isset($_POST['update_topic'])) {
        updateTopic($_POST);
}
// if user clicks the Delete topic button
if (isset($_GET['delete-topic'])) {
        $topic_id = $_GET['delete-topic'];
        deleteTopic($topic_id);
}

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * 
* - Returns all admin users and their corresponding roles
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
function getAdminUsers(){
        global $conn, $roles;
        $sql = "SELECT * FROM users WHERE role IS NOT NULL";
        $result = mysqli_query($conn, $sql);
        $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $users;
}
/* * * * * * * * * * * * * * * * * * * * *
* - Escapes form submitted value, hence, preventing SQL injection
* * * * * * * * * * * * * * * * * * * * * */
function esc(String $value){
        // bring the global db connect object into function
        global $conn;
        // remove empty space sorrounding string
        $val = trim($value); 
        $val = mysqli_real_escape_string($conn, $value);
        return $val;
}
// Receives a string like 'Some Sample String'
// and returns 'some-sample-string'
function makeSlug(String $string){
        $string = strtolower($string);
        $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
        return $slug;
}
/* - - - - - - - - - - - -
-  Admin users functions
- - - - - - - - - - - - -*/
/* * * * * * * * * * * * * * * * * * * * * * *
* - Receives new admin data from form
* - Create new admin user
* - Returns all admin users with their roles 
* * * * * * * * * * * * * * * * * * * * * * */
function createAdmin($request_values){
        global $conn, $errors, $role, $username, $email;
        $username = esc($request_values['username']);
        $email = esc($request_values['email']);
        $password = esc($request_values['password']);
        $passwordConfirmation = esc($request_values['passwordConfirmation']);

        if(isset($request_values['role'])){
                $role = esc($request_values['role']);
        }
        // form validation: ensure that the form is correctly filled
        if (empty($username)) { array_push($errors, "Uhmm...We gonna need the username"); }
        if (empty($email)) { array_push($errors, "Oops.. Email is missing"); }
        if (empty($role)) { array_push($errors, "Role is required for admin users");}
        if (empty($password)) { array_push($errors, "uh-oh you forgot the password"); }
        if ($password != $passwordConfirmation) { array_push($errors, "The two passwords do not match"); }
        // Ensure that no user is registered twice. 
        // the email and usernames should be unique
        $user_check_query = "SELECT * FROM users WHERE username='$username' 
                                                        OR email='$email' LIMIT 1";
        $result = mysqli_query($conn, $user_check_query);
        $user = mysqli_fetch_assoc($result);
        if ($user) { // if user exists
                if ($user['username'] === $username) {
                  array_push($errors, "Username already exists");
                }

                if ($user['email'] === $email) {
                  array_push($errors, "Email already exists");
                }
        }
        // register user if there are no errors in the form
        if (count($errors) == 0) {
                $password = md5($password);//encrypt the password before saving in the database
                $query = "INSERT INTO users (username, email, role, password, created_at, updated_at) 
                                  VALUES('$username', '$email', '$role', '$password', now(), now())";
                mysqli_query($conn, $query);

                $_SESSION['message'] = "Admin user created successfully";
                header('location: users');
                exit(0);
        }
}

/* - - - - - - - - - - 
-  Topics functions
- - - - - - - - - - -*/
// get all topics from DB
function getAllTopics() {
        global $conn;
        $sql = "SELECT * FROM topics";
        $result = mysqli_query($conn, $sql);
        $topics = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $topics;
}
function createTopic($request_values){
        global $conn, $errors, $topic_name;
        $topic_name = esc($request_values['topic_name']);
        // create slug: if topic is "Life Advice", return "life-advice" as slug
        $topic_slug = makeSlug($topic_name);
        // validate form
        if (empty($topic_name)) { 
                array_push($errors, "Topic name required"); 
        }
        // Ensure that no topic is saved twice. 
        $topic_check_query = "SELECT * FROM topics WHERE slug='$topic_slug' LIMIT 1";
        $result = mysqli_query($conn, $topic_check_query);
        if (mysqli_num_rows($result) > 0) { // if topic exists
                array_push($errors, "Topic already exists");
        }
        // register topic if there are no errors in the form
        if (count($errors) == 0) {
                $query = "INSERT INTO topics (name, slug) 
                                  VALUES('$topic_name', '$topic_slug')";
                mysqli_query($conn, $query);

                $_SESSION['message'] = "Topic created successfully";
                header('location: topics');
                exit(0);
        }
}
/* * * * * * * * * * * * * * * * * * * * *
* - Takes topic id as parameter
* - Fetches the topic from database
* - sets topic fields on form for editing
* * * * * * * * * * * * * * * * * * * * * */
function editTopic($topic_id) {
        global $conn, $topic_name, $isEditingTopic, $topic_id;
        $sql = "SELECT * FROM topics WHERE id=$topic_id LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $topic = mysqli_fetch_assoc($result);
        // set form values ($topic_name) on the form to be updated
        $topic_name = $topic['name'];
}
function updateTopic($request_values) {
        global $conn, $errors, $topic_name, $topic_id;
        $topic_name = esc($request_values['topic_name']);
        $topic_id = esc($request_values['topic_id']);
        // create slug: if topic is "Life Advice", return "life-advice" as slug
        $topic_slug = makeSlug($topic_name);
        // validate form
        if (empty($topic_name)) { 
                array_push($errors, "Topic name required"); 
        }
        // register topic if there are no errors in the form
        if (count($errors) == 0) {
                $query = "UPDATE topics SET name='$topic_name', slug='$topic_slug' WHERE id=$topic_id";
                mysqli_query($conn, $query);

                $_SESSION['message'] = "Topic updated successfully";
                header('location: topics');
                exit(0);
        }
}
// delete topic 
function deleteTopic($topic_id) {
        global $conn;
        $sql = "DELETE FROM topics WHERE id=$topic_id";
        if (mysqli_query($conn, $sql)) {
                $_SESSION['message'] = "Topic successfully deleted";
                header("location: topics");
                exit(0);
        }
}

/* * * * * * * * * * * * * * * * * * * * *
* - Takes admin id as parameter
* - Fetches the admin from database
* - sets admin fields on form for editing
* * * * * * * * * * * * * * * * * * * * * */
function editAdmin($admin_id)
{
        global $conn, $username, $role, $isEditingUser, $admin_id, $email;

        $sql = "SELECT * FROM users WHERE id=$admin_id LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $admin = mysqli_fetch_assoc($result);

        // set form values ($username and $email) on the form to be updated
        $username = $admin['username'];
        $email = $admin['email'];
}

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * 
* - Receives admin request from form and updates in database
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
function updateAdmin($request_values){
        global $conn, $errors, $role, $username, $isEditingUser, $admin_id, $email;
        // get id of the admin to be updated
        $admin_id = $request_values['admin_id'];
        // set edit state to false
        $isEditingUser = false;


        $username = esc($request_values['username']);
        $email = esc($request_values['email']);
        $password = esc($request_values['password']);
        $passwordConfirmation = esc($request_values['passwordConfirmation']);
        if(isset($request_values['role'])){
                $role = $request_values['role'];
        }
        // register user if there are no errors in the form
        if (count($errors) == 0) {
                //encrypt the password (security purposes)
                $password = md5($password);

                $query = "UPDATE users SET username='$username', email='$email', role='$role', password='$password' WHERE id=$admin_id";
                mysqli_query($conn, $query);

                $_SESSION['message'] = "Admin user updated successfully";
                header('location: users');
                exit(0);
        }
}
// delete admin user 
function deleteAdmin($admin_id) {
        global $conn;
        $sql = "DELETE FROM users WHERE id=$admin_id";
        if (mysqli_query($conn, $sql)) {
                $_SESSION['message'] = "User successfully deleted";
                header("location: users");
                exit(0);
        }
}

function getRedirectById($redirect_id) {
        global $conn;
        $sql = "SELECT * FROM redirects WHERE id=$redirect_id LIMIT 1";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_assoc($result);
    }

    function updateRedirect($redirect_id, $redirect_name, $redirect_destination) {
        global $conn;
        $sql = "UPDATE redirects SET name='$redirect_name', destination='$redirect_destination' WHERE id=$redirect_id";
        mysqli_query($conn, $sql);
    }
    function deleteRedirect($redirect_id) {
        global $conn;
        $sql = "DELETE FROM redirects WHERE id=$redirect_id";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['message'] = "Redirect successfully deleted";
            header("location: redirects");
            exit(0);
        }
    }
    
function addRedirect($redirect_name, $redirect_destination) {
    global $conn;
    // Check if the redirect name or destination is empty
    if(empty($redirect_name) || empty($redirect_destination)) {
        $_SESSION['message'] = "Redirect name or destination cannot be empty";
        return;
    }
    // Check if a redirect with the same name already exists
    $sql = "SELECT * FROM redirects WHERE name='$redirect_name'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0) {
        $_SESSION['message'] = "A redirect with this name already exists";
        return;
    }
    // If all checks pass, add the redirect
    $sql = "INSERT INTO redirects (name, destination) VALUES ('$redirect_name', '$redirect_destination')";
    $result = mysqli_query($conn, $sql);
    if ($result === false) {
        die(mysqli_error($conn));
    }
}
function getAllRedirects() {
        global $conn;
        $sql = "SELECT * FROM redirects"; // replace "redirects" with your actual table name
        $result = mysqli_query($conn, $sql);
        $redirects = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $redirects;
        if (isset($_POST['add_redirect'])) {
                $redirect_name = $_POST['redirect_name'];
                $redirect_destination = $_POST['redirect_destination'];
                $sql = "INSERT INTO redirects (name, destination) VALUES ('$redirect_name', '$redirect_destination')";
                $result = mysqli_query($conn, $sql);
                if ($result === false) {
                    die(mysqli_error($conn));
                }
            }
        }
    


        function handleUpload() {

                global $conn;

                // Initialize message variable
                $msg = "";
            
        // If delete button is clicked ...
        if (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $image = $_POST['image'];
    
        // Delete record from database
        $sql = "DELETE FROM images WHERE id='$id'";
        mysqli_query($conn, $sql);
    
        // Delete image file from folder
        unlink($_SERVER['DOCUMENT_ROOT']."/static/images/".$image);
        }
            
        // If upload button is clicked ...
        if (isset($_POST['upload'])) {
        // Get image name
        $image = $_FILES['image']['name'];
        // Get text
        $image_text = mysqli_real_escape_string($conn, $_POST['image_text']);
    
        // Check if image file is selected and image text is not empty
        if ($image != "" && $image_text != "") {
          // image file directory
          $target = $_SERVER['DOCUMENT_ROOT']."/static/images/".basename($image);
    
            $sql = "INSERT INTO images (image, image_text) VALUES ('$image', '$image_text')";
            // execute query
            mysqli_query($conn, $sql);
    
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                $msg = "Image uploaded successfully";
                // Redirect to upload
                header('Location: upload');
                exit;
              } else {
                $msg = "Failed to upload image";
              }
            } else {
              $msg = "Please select an image and enter image text";
            }
          }
        
          $result = mysqli_query($conn, "SELECT * FROM images");
              // Return the result
        return $result;
        }


?>
