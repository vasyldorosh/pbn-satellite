<?php

namespace Vasyldorosh\PbnSatellite;

class Installer
{
    public static function postPackageInstall()
    {
        self::copyBlog();
        //$this->setup();
    }

    public static function copyBlog()
    {
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
    }
}