<?php
    if (isset($_SESSION['user']) && ($_SESSION['user']['role'] != 'Admin' && $_SESSION['user']['role'] != 'Author')) {
        header('Location: ' . BASE_URL);
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link href="https://fonts.googleapis.com/css?family=Averia+Serif+Libre|Noto+Serif|Tangerine" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.8.0/ckeditor.js"></script>
<link rel="stylesheet" href="../static/css/admin_styling.css">