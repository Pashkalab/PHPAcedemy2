<?php

require 'functions.php';

// $page = !empty($_GET['page']) ? $_GET['page'] : 'default';
$page = requestGet('page', 'default');

$file = "controller/{$page}.php";



$view = $page;
$action = requestGet('action');

if (!file_exists($file)) {
    $content = "<h1>404 - Error</h1>";
    require 'layout.phtml';
    die();
}

require $file;

ob_start();
require "views/{$view}.phtml";
$content = ob_get_clean();

require 'layout.phtml';