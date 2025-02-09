<?php
// Configure error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', '/var/log/php/error.log');

// Simple browser console logging function
if (!function_exists('browserLog')) {
    function browserLog($message) {
        if (headers_sent()) {
            echo "<!--\n";
        }
        
        $jsonMessage = is_scalar($message) ? json_encode((string)$message) : json_encode($message);
        if ($jsonMessage === false) {
            $jsonMessage = json_encode('Error encoding message');
        }
        
        echo "<script>console.log({$jsonMessage});</script>\n";
        
        if (headers_sent()) {
            echo "-->\n";
        }
    }
}
