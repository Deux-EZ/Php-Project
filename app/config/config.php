<?php

class Config {
    private static $config = [];

    public static function init() {
        $envFile = __DIR__ . '/../../.env';
        if (file_exists($envFile)) {
            $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
                    list($key, $value) = explode('=', $line, 2);
                    self::$config[trim($key)] = trim($value);
                }
            }
        }
    }

    public static function get($key, $default = null) {
        return self::$config[$key] ?? $default;
    }
}

Config::init();

if (!Config::get('APP_URL')) {
    die('APP_URL no está configurado en el archivo .env');
}