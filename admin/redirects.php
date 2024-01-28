<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include('../config.php');
include(ROOT_PATH . '/admin/includes/admin_functions.php');
include(ROOT_PATH . '/admin/includes/head_section.php');

$redirects = getAllRedirects();

if (isset($_POST['add_redirect'])) {
    $redirect_name = $_POST['redirect_name'];
    $redirect_destination = $_POST['redirect_destination'];
    addRedirect($redirect_name, $redirect_destination);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

if (isset($_POST['delete_redirect'])) {
    $redirect_id = $_POST['redirect_id'];
    deleteRedirect($redirect_id);
}

if (isset($_GET['edit-redirect'])) {
    $redirect = getRedirectById($_GET['edit-redirect']);
    $redirect_name = $redirect['name'];
    $redirect_destination = $redirect['destination'];
}

if (isset($_POST['update_redirect'])) {
    $redirect_id = $_POST['redirect_id'];
    $redirect_name = $_POST['redirect_name'];
    $redirect_destination = $_POST['redirect_destination'];
    updateRedirect($redirect_id, $redirect_name, $redirect_destination);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

?>

<title>Admin | Manage Redirects</title>

</head>
<body>
        <!-- admin navbar -->
        <?php include(ROOT_PATH . '/admin/includes/navbar.php') ?>
        <div class="container content">
                <!-- Left side menu -->
                <?php include(ROOT_PATH . '/admin/includes/menu.php') ?>

                <!-- Middle form - to create and edit -->
        <div class="action">
            <h1 class="page-title">Add/Delete Redirects</h1>
            <form method="post" action="<?php echo BASE_URL . '/admin/redirects'; ?>" >
                <!-- validation errors for the form -->
                <?php include(ROOT_PATH . '/includes/errors.php') ?>

                <!-- Redirect Name -->
                <input type="text" name="redirect_name" placeholder="Redirect Name" value="<?php echo isset($redirect_name) ? $redirect_name : ''; ?>">

                <!-- Redirect Destination -->
                <input type="text" name="redirect_destination" placeholder="Redirect Destination" value="<?php echo isset($redirect_destination) ? $redirect_destination : ''; ?>">

                <!-- Add Redirect Button -->
                <button type="submit" class="btn" name="add_redirect">Add Redirect</button>

            </form>
        </div>
        <!-- Display records from DB-->
<div class="table-div">
    <!-- Display notification message -->
    <?php include(ROOT_PATH . '/admin/includes/messages.php') ?>
    <?php if (empty($redirects)): ?>
        <h1>No redirects in the database.</h1>
    <?php else: ?>
        <table class="table">
            <thead>
                <th>N</th>
                <th>Redirect Name</th>
                <th>Redirect Destination</th>
                <th colspan="2">Action</th>
            </thead>
            <tbody>
                <?php foreach ($redirects as $key => $redirect): ?>
                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php echo $redirect['name']; ?></td>
                        <td><?php echo $redirect['destination']; ?></td>
                        <td>
                            <a class="fa fa-pencil btn edit"
                                href="redirects?edit-redirect=<?php echo $redirect['id'] ?>">
                            </a>
                        </td>
                        <td>
                            <!-- Delete Redirect Form -->
                            <form method="post" action="<?php echo BASE_URL . '/admin/redirects'; ?>" >
                                <button type="submit" name="delete_redirect" class="fa fa-trash btn delete"></button>
                                <input type="hidden" name="redirect_id" value="<?php echo $redirect['id']; ?>">
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    <?php endif ?>
</div>
<!-- // Display records from DB -->
</body>
</html>
