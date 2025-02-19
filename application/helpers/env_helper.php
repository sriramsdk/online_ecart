<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('env')) {
    function env($key, $default = null) {
        $filePath = FCPATH . '.env';

        if (!file_exists($filePath)) {
            return $default;
        }

        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0) continue;

            list($envKey, $envValue) = explode('=', $line, 2);
            if (trim($envKey) === $key) {
                return trim($envValue, '"');
            }
        }

        return $default;
    }
}
