<?php

namespace Vasyldorosh\PbnSatellite;

class Installer
{
    public static function postPackageInstall()
    {
        // copy blog
        $source = __DIR__ . '/../resources/blog';
        $dest = __DIR__ . '/../../../../blog';

        mkdir($dest, 0755);
        foreach (
            $iterator = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($source, \RecursiveDirectoryIterator::SKIP_DOTS),
                \RecursiveIteratorIterator::SELF_FIRST) as $item
        ) {
            if ($item->isDir()) {
                mkdir($dest . DIRECTORY_SEPARATOR . $iterator->getSubPathName());
            } else {
                copy($item, $dest . DIRECTORY_SEPARATOR . $iterator->getSubPathName());
            }
        }

        // copy .env
        file_put_contents(__DIR__ . '/../../../../.env', file_get_contents(__DIR__ . '/../resources/env'));

        // replace in index.php
        $indexFile = __DIR__ . '/../../../../index.php';
        $contentParserShortCode = ' require_once __DIR__."/vendor/autoload.php";' . "\n";
        $contentParserShortCode.= ' return (new \Vasyldorosh\PbnSatellite\PostRender)->replaceList($content);' . "\n";

        file_put_contents(
            $indexFile,
            str_replace('return $content', $contentParserShortCode, file_get_contents($indexFile))
        );
    }
}