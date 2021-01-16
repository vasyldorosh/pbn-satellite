<?php
require __DIR__.'/../vendor/autoload.php';
use App\PostStorage;
use App\PostRender;

$post = ((new PostStorage)->getPost($_GET['alias']));
if (empty($post)) {
    header("HTTP/1.0 404 Not Found");
} else {
    echo (new PostRender)->renderItem($post);
}