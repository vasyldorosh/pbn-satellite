<?php

namespace Vasyldorosh\PbnSatellite;

class Config
{
    /**
     * @return string
     */
    public static function getEnvFile():string
    {
        return __DIR__ . '/../../../../.env';
    }

    /**
     * @return string
     */
    public static function getData(): array
    {
        var_dump(self::getEnvFile());
        die();

        $data = [];
        $content = file(self::getEnvFile());
        foreach ($content as $item) {
            if (substr_count($item, '=')) {
                list($key, $value) = explode('=', $item);
                $data[$key] = $value;
            }
        }

        return $data;
    }

    /**
     * @param string $key
     * @return string|null
     */
    public static function get(string $key):? string
    {
        $data = self::getData();
        return isset($data[$key]) ? $data[$key] : null;
    }

}