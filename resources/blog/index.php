<?php

require __DIR__.'/../vendor/autoload.php';

use Vasyldorosh\PbnSatellite\PostStorage;
use Vasyldorosh\PbnSatellite\PostRender;

$alias = isset($_GET['alias']) ? $_GET['alias'] : null;
$post = $alias ? ((new PostStorage)->getPost($_GET['alias'])) : null;
if (empty($post)) {
    header("HTTP/1.0 404 Not Found");
    echo (new PostRender)->renderItem([
        'title' => 404,
        'seo_title' => 404,
        'seo_description' => 404,
        'content' => 'Page not found',
    ]);
} else {
    echo (new PostRender)->renderItem($post);
}